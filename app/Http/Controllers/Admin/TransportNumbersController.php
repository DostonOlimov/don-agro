<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransportNumber\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Http\Services\TransportNumber\TransportNumberService;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Region;
use App\Models\Vehicle;
use App\tbl_activities;
use App\Models\TransportNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransportNumbersController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_num';

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $title = 'Davlat raqami berish';

        $payment_n = \DB::table('tbl_payment_types')->where([['category', '=', 'vehicle_num'], ['code', '=', 'new']])->get();
        $payment_r = \DB::table('tbl_payment_types')->where([['category', '=', 'vehicle_num'], ['code', '=', 'rec']])->get();

        $vehicle = Vehicle::find($request->input('vehicle_id'));

        $customerId = $vehicle ? $vehicle->owner_id : $request->input('customer_id');
        $customer = Customer::join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                            ->join('tbl_cities', 'tbl_cities.id', '=', 'customers.city_id')
                            ->select('customers.*', 'ownership_forms.name as ownership_form', 'tbl_cities.state_id')
                            ->find($customerId);

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        return view('transport-number.form', compact(
                'title',
                'payment_n',
                'payment_r',
                'customer',
                'vehicle',
                'servingInvoices'
            ) + [
                'BHM' => $invoiceService::BHM(),
                'states' => Region::when(auth()->user()->region_ids, function ($query) {
                    $query->whereIn('id', auth()->user()->region_ids);
                })->orderBy('name')->get(),
                'documents' => Document::where('service', Document::SERVICE_NUMBER)->orderBy('name')->get(),
            ]);
    }

    public function store(StoreRequest $request, TransportNumberService $service, InvoiceService $invoiceService)
    {
        /* @var Vehicle $vehicle*/
        $vehicle = Vehicle::with(['customer'])->findOrFail($request->input('vehicle_id'));

        /* @var Customer $customer */
        $customer = Customer::findOrFail($request->input('customer_id')); // $vehicle->customer ни урнига ишлатаан, чунки говнокод!

        $document = Document::findOrFail($request->doc);
        if ($document->free_service) {
            $invoice = $invoiceService->makeFreeService($customer, static::PAYMENT_CATEGORY);
        } else if ($paymentTypeId = $request->input('payment_type_id')) {
            $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }

        $action = $request->input('action');

        if ($action === $service::ACTION_ISSUE) {
            if (!$service->validToCreateVehicle($vehicle)) {
                return 'active-transport-number-exists';
            }
        }

        if ($action === $service::ACTION_RECOVER) {
            $service->disableOldEntities($vehicle);
        }

        $tNumber = new TransportNumber;
        $tNumber->vehicle_id = $vehicle->id;
        $tNumber->owner_id = $vehicle->owner_id;
        $tNumber->type = $request->input('type');
        $tNumber->series = $request->input('series');
        $tNumber->number = $request->input('number');
        $tNumber->code = $request->input('code');

        $tNumber->total_amount = $invoice->amount / 100;
        $tNumber->paid_amount = $invoice->amount / 100;
        $tNumber->given_date = Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('given_date'))->toDateString();
        $tNumber->action = $action;
        $tNumber->recover_reason = $request->input('recover_reason');
        $tNumber->doc = $request->input('doc');
        $tNumber->doc_note = $request->input('doc-note');
        $tNumber->status = 'active';
        $tNumber->payment_status = 'paid';
        $tNumber->payment_date = $invoice->updated_at;
        $tNumber->state_id = $request->input('state_id');
        $tNumber->user_id = auth()->id();
        $tNumber->save();

        $invoiceService->markAsUsed($invoice, $tNumber);

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->owner_id = $customer->id;
        $active->user_id = auth()->id();
        $active->city_id = $customer->city_id;
        $active->vehicle_id = $vehicle->id;
        $active->action_id = $tNumber->id;
        $active->action_type = 'technical_num';
        $active->action = "Davlat raqami berildi";
        $active->time = now()->toDateTimeString();
        $active->save();

        echo 'success';
    }
}
