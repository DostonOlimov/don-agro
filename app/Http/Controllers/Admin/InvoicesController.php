<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportInvoiceReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Level;
use App\Models\ListRegion;
use App\Models\PaymentCategory;
use App\Models\PaymentType;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    private $bhm;

    public function __construct()
    {
        $this->bhm = InvoiceService::BHM();
    }

    public function index(Request $request)
    {
        $query = Invoice::when($request->input('date_from'), function ($query, $dateFrom) {
                               $query->whereDate('created_at', '>=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateFrom)->startOfDay());
                           })
                           ->when($request->input('date_to'), function ($query, $dateTo) {
                               $query->whereDate('created_at', '<=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateTo)->endOfDay());
                           })
                           ->when($request->input('region_id'), function ($query, $regionId) {
                               $query->where('region_id', $regionId);
                           })
                           ->when($request->input('area_id'), function ($query, $areaId) {
                               $query->where('district_id', $areaId);
                           })
                           ->when($request->input('category_id'), function ($query, $categoryId) {
                               $query->where('category_id', $categoryId);
                           })
                           ->when($request->input('type_id'), function ($query, $typeId) {
                               $query->where('type_id', $typeId);
                           })
                           ->when($request->input('search'), function ($query, $search) {
                               $query->whereRaw("concat(lpad(district_id, 4, '0'), lpad(type_id, 2, '0'), invoice_id) like '%{$search}%'");
                           })
                           ->when($request->input('state'), function ($query, $state) {
                               if ($state === 'used') {
                                   $query->where('state', Invoice::STATE_PAID);
                               }
                           })
                           ->with(['customer', 'paymentType', 'paymentCategory', 'merchants'])
                           ->orderByDesc('created_at');

        if (auth()->user()->role !== 'admin') {
            $query->when(optional(auth()->user()->level)->position === Level::LEVEL_DISTRICT, function ($query) {
                      return $query->whereHas('area', function ($query) {
                          $query->whereIn('id', auth()->user()->area_ids);
                      });
                  })
                  ->when(optional(auth()->user()->level)->position === Level::LEVEL_REGION, function ($query) {
                      return $query->whereHas('region', function ($query) {
                          $query->whereIn('id', auth()->user()->region_ids);
                      });
                  });
        }

        $invoices = $query->paginate(20)->appends($request->query());

        return view('admin.invoices.list', compact('invoices'));
    }

    public function create(Request $request)
    {
        $paymentCategories = PaymentCategory::with('paymentTypes')
            ->where('val01', '<>', 'vehicle_out')->get()->map(function ($item) {
                return (object)[
                    'name' => $item->name1,
                    'id' => $item->id,
                    'types' => $item->paymentTypes->map(function ($type) use ($item) {
                            return [
                                'id' => $type->id,
                                'name' => $type->name,
                                'amount' => $type->payment,
                                'category_id' => $item->val01,
                            ];
                    }),
                ];
        })->keyBy('id');
        return view('admin.invoices.form', [
                'model' => new Invoice,
                'bhm' => $this->bhm,
                'customer' => Customer::find($request->input('customer_id')),
            ] + compact('paymentCategories'));
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        $invoice = new Invoice($request->validated());

        $customer = Customer::findOrFail($request->customer_id);
        $invoice->region_id = optional($customer->area)->listArea->int01;
        $invoice->district_id = $customer->area->list_id;

        $invoice->user_id = auth()->id();
        $invoice->tin = $customer->pinfl ?: $customer->inn;
        $invoice->type_id = $request->type_id;
        $invoice->amount = $this->bhm * PaymentType::where('id', $request->type_id)->value('payment'); // сумма тийинда курсатилган

        $invoice->save();

        if ($request->input('paid')) {
            $invoiceService->markAsPaid($invoice);
        }

        return $invoice->fresh(['customer', 'paymentType'])->append(['merchant', 'unique_id', 'base64QR']);
    }

    public function show($id)
    {
        return view('admin.invoices.show', [
            'invoice' => Invoice::with(['customer', 'paymentType'])->findOrFail($id)->append(['merchant', 'unique_id', 'base64QR'])
        ]);
    }

    public function serve($id)
    {
        /* @var Invoice $invoice */
        $invoice = Invoice::withTrashed()->findOrFail($id);

        return redirect()->route($invoice->paymentCategory->route, [
                'customer_id' => $invoice->customer->id,
            ] + ($invoice->trashed() ? [] : ['invoice_id' => $invoice->id]));
    }

    public function redo($id, InvoiceService $service)
    {
        /* @var Invoice $invoice */
        $invoice = Invoice::withTrashed()
                          ->whereIn('state', [Invoice::STATE_USED, Invoice::STATE_DELETED])
                          ->findOrFail($id);

        $service->markAsPaid($invoice);

        return $this->serve($id);
    }

    private function reportData(Request $request)
    {
        $reportPeriod = [
            Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('date_from', now()->startOfQuarter()->format(USER_DATE_FORMAT)))->startOfDay(),
            Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('date_to', now()->format(USER_DATE_FORMAT)))->endOfDay(),
        ];

        $regions = ListRegion::when(auth()->user()->region_ids, function ($query, $regionIds) {
                                 return $query->whereIn('id', Region::whereIn('id', $regionIds)->pluck('list_id'));
                             })
                             ->when($request->input('region_id'), function ($query, $regionId) {
                                 $query->where('id', $regionId);
                             })
                             ->when(optional(auth()->user()->level)->position === 'district', function ($query) {
                                 $query->with(['listAreas' => function ($query) {
                                     $query->when(auth()->user()->city_ids, function ($query, $cityIds) {
                                         $query->whereIn('id', Area::whereIn('id', $cityIds)->pluck('list_id'));
                                     });
                                 }]);
                             }, function ($query) {
                                 $query->with(['listAreas']);
                             })
                             ->get();

        $paymentCategories = PaymentCategory::with(['paymentTypes'])->get();

        $reportQuery = Invoice::query()
                              ->whereBetween('customer_invoices.created_at', $reportPeriod)
                              ->whereIn('region_id', $regions->pluck('id'))
                              ->whereIn('district_id', $regions->pluck('listAreas')->flatten()->pluck('id'))
                              ->select([
                                      'type_id',
                                      'region_id',
                                      'district_id as area_id',
                                      \DB::raw('ifnull(sum(case when customer_invoices.state in (' . Invoice::STATE_PAID . ', ' . Invoice::STATE_USED . ') then 1 end), 0) as paid_cnt'),
                                      \DB::raw('ifnull(sum(case when customer_invoices.state in (' . Invoice::STATE_PAID . ', ' . Invoice::STATE_USED . ') then customer_invoices.amount end), 0) as paid_sum'),
                                      \DB::raw('ifnull(sum(case when customer_invoices.state = ' . Invoice::STATE_USED . ' then 1 end), 0) as processed_cnt'),
                                      \DB::raw('ifnull(sum(case when customer_invoices.state = ' . Invoice::STATE_USED . ' then customer_invoices.amount end), 0) as processed_sum'),
                                  ])
                                  ->groupBy(['region_id', 'area_id', 'type_id']);

        return compact(
            'paymentCategories',
            'regions'
        ) + ['reportData' => $reportQuery->get()];
    }

    public function report(Request $request)
    {
        return view('admin.invoices.report.byregions', $this->reportData($request) + ['exporting' => false]);
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportInvoiceReport($this->reportData($request) + ['exporting' => true]), 'hisobot.xlsx');
    }

}
