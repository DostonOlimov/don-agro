<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleCertificate\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\Vehicle;
use App\Models\VehicleCertificate;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VehicleCertificatesController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_cer';

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $title = 'Texnik guvohnoma berish';
        $seriesNumber = generateSeriesNumber('vehicle_certificates');

        $documents = Document::where('service', Document::SERVICE_CERTIFICATE)->orderBy('name')->get();
        $payment_r = PaymentType::where([['category', '=', 'vehicle_cer'], ['code', '=', 'rec']])->get();
        $payment_n = PaymentType::where([['category', '=', 'vehicle_cer'], ['code', '=', 'new']])->first();

        $vehicle = Vehicle::find($request->vehicle_id);
        $customer = Customer::join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                            ->select('customers.*', 'ownership_forms.name as ownership_form')
                            ->find(optional($vehicle)->owner_id ?: $request->input('customer_id'));

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        return view('technical-passport.form', compact(
            'title',
            'seriesNumber',
            'vehicle',
            'customer',
            'documents',
            'servingInvoices',
            'payment_r',
            'payment_n'
        ) + [
            'type' => 'certificate',
            'invoiceCategory' => static::PAYMENT_CATEGORY
        ]);
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        /* @var Document $document */
        $document = Document::findOrFail($request->doc);

        /* @var Vehicle $vehicle */
        $vehicle = Vehicle::where('owner_id', $request->customer_id)->with('customer')->findOrFail($request->transport);

        $certificateId = Input::get('vehicle-certificate-id');

        $action = Input::get('action');

        if (!$certificateId) {
            if ($action == 'recover' || $document->id == 14) {
                $vehicle->vehicleCertificate()->update(['status' => 'inactive']);
            } elseif ($action == 'give' && $document->id == 14) {
                if ($vehicle->vehicleCertificate()->exists()) {
                    return json_encode(['message' => 'active-vehicle-certificate-exists']);
                }
            }

            $certificate = new VehicleCertificate;
        } else {
            $certificate = VehicleCertificate::findOrFail($request->input('vehicle-certificate-id'));
        }

        if (!$certificate->id) {
            $vehicle->vehicleCertificate()->update(['status' => 'inactive']);
        }

        // =========
        /* @var Invoice $invoice */
        if ($document->free_service) {
            if ($request->input('vehicle-certificate-id')) {
                $invoice = $certificate->invoice;
            } else {
                $invoice = $invoiceService->makeFreeService($vehicle->customer, static::PAYMENT_CATEGORY);
            }
        } else if ($paymentTypeId = $request->input('payment_type_id')) {
            if ($request->input('vehicle-certificate-id')) {
                $invoice = $certificate->invoice;
            } else {
                $invoice = $invoiceService->makePaidService($vehicle->customer, static::PAYMENT_CATEGORY, $paymentTypeId);
            }
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }
        // =========

        $series = Input::get('series');
        $number = Input::get('number');

        $certificate->vehicle_id = $vehicle->id;
        $certificate->owner_id = $vehicle->customer->id;

        if (!$certificateId) {
            if ($document->free_service) {
                $certificate->series = $series;
                $certificate->number = $number;
            } else {
                $seriesNumber = generateSeriesNumber('vehicle_certificates');
                $certificate->series = $seriesNumber->series;
                $certificate->number = $seriesNumber->number;
            }
        } else {
            $certificate->series = $series;
            $certificate->number = $number;
        }

        $certificate->total_amount = $invoice->amount / 100;
        $certificate->paid_amount = $invoice->amount / 100;
        $certificate->given_date = Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('given_date'))->toDateString();
        $certificate->action = $action;
        $certificate->doc = $document->id;
        $certificate->doc_note = Input::get('doc-note');
        $certificate->payment_status = 'paid';
        $certificate->payment_date = now()->toDateString();
        $certificate->status = 'active';
        $certificate->note = Input::get('note');
        $certificate->recover_reason = Input::get('recover_reason');
        $certificate->user_id = auth()->id();
        $certificate->save();

        $invoiceService->markAsUsed($invoice, $certificate);

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->owner_id = $vehicle->customer->id;
        $active->city_id = $vehicle->customer->city_id;
        $active->vehicle_id = $vehicle->id;
        $active->action_id = $certificate->id;
        $active->action_type = 'vehicle_cer';
        $active->user_id = auth()->id();
        $active->action = "Agregatga guvohnoma berildi " . $certificate->series . " " . $certificate->number;
        $active->time = now()->toDateTimeString();
        $active->save();

        return json_encode(['id' => $certificate->id, 'message' => 'success']);
    }
}
