<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Invoice\Payment\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Invoice;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        $payments = PaymentTransaction::when($request->input('date_from'), function ($query, $dateFrom) {
                       $query->whereDate('create_time', '>=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateFrom)->startOfDay());
                    })
                    ->when($request->input('date_to'), function ($query, $dateTo) {
                        $query->whereDate('create_time', '<=', Carbon::createFromFormat(USER_DATE_FORMAT, $dateTo)->endOfDay());
                    })
                    ->when($request->input('category_id'), function ($query, $categoryId) {
                        $query->where('category_id', $categoryId);
                    })
                    ->when($request->input('type_id'), function ($query, $typeId) {
                        $query->where('type_id', $typeId);
                    })
                    ->when($request->input('search'), function ($query, $search) {
                        $query->whereRaw("invoice_code like '%{$search}%'")->orWhere('invoice_id', $search);
                    })
                    ->with([
                        'invoice.customer', 'region', 'area', 'category', 'type'
                    ])
                    ->latest()->paginate();

        return view('admin.invoices.payments.list', [
            'payments' => $payments
        ]);
    }

    public function create(Request $request, InvoiceService $invoiceService)
    {
        return view('admin.invoices.payments.form', [
            'unpaidInvoices' => $invoiceService->unpaidInvoices(),
        ]);
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        $result = $invoiceService->pay($invoice);

        return response(['message' => $result ? 'ok' : 'fail'], $result ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
