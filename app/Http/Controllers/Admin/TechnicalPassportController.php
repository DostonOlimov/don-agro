<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TechnicalPassport\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\TechnicalPassport;
use App\Models\Vehicle;
use App\Services\PdfGeneratorTexPass;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TechnicalPassportController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_pass';

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $title = 'Texnik passport berish';
        $seriesNumber = generateSeriesNumber('technical_passports');

        $documents = Document::where('service', 'technical-passport')->orderBy('name')->get();
        $vehicle = Vehicle::find($request->input('vehicle_id'));
        $customer = Customer::join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                            ->select('customers.*', 'ownership_forms.name as ownership_form')
                            ->find($request->input('customer_id') ?: optional($vehicle)->owner_id);

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        $payment_r = PaymentType::where([['category', '=', 'vehicle_pass'], ['code', '=', 'rec']])->get();
        $payment_n = PaymentType::where([['category', '=', 'vehicle_pass'], ['code', '=', 'new']])->first();

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
                'type' => 'passport',
                'invoiceCategory' => static::PAYMENT_CATEGORY
            ]);
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        $customer = Customer::findOrFail($request->customer_id);
        /* @var Document $document */
        $document = Document::findOrFail($request->doc);
        /* @var Vehicle $vehicle */
        $vehicle = Vehicle::where('owner_id', $customer->id)->findOrFail($request->transport);

        $series = $request->input('series');
        $number = $request->input('number');
        $action = $request->input('action');
        $tPassportId = $request->input('technical-passport-id');

        if (!$tPassportId) {
            if ($action == 'recover' || $document->id == 9) {
                $vehicle->technicalPassport()->update(['status' => 'inactive']);
            } elseif ($action == 'give' && $document->id == 9 && $vehicle->technicalPassport()->exists()) {
                return json_encode(['message' => 'active-technical-passport-exists']);
            }

            $tPassport = new TechnicalPassport;
        } else {
            $tPassport = TechnicalPassport::findOrFail($tPassportId);
//            $passportId = $tPassportId;
        }

        // =========
        /* @var Invoice $invoice */
        if ($document->free_service) {
            if ($request->input('technical-passport-id')) {
                $invoice = $tPassport->invoice;
            } else {
                $invoice = $invoiceService->makeFreeService($vehicle->customer, static::PAYMENT_CATEGORY);
            }
        } else if ($paymentTypeId = $request->input('payment_type_id')) {
            if ($request->input('technical-passport-id')) {
                $invoice = $tPassport->invoice;
            } else {
                $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
            }
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }
        // =========

        $tPassport->vehicle_id = $vehicle->id;
        $tPassport->owner_id = $customer->id;
        $tPassport->user_id = auth()->id();
        $tPassport->doc = $document->id;
        $tPassport->doc_note = Input::get('doc-note');

        if (!$tPassportId) {
            if ($document->free_service) {
                $tPassport->series = $series;
                $tPassport->number = $number;
            } else {
//                $seriesNumber = generateSeriesNumber('technical_passports');
                $tPassport->series = 'UZ-AA';
                $tPassport->number = (string)json_decode(json_encode(\DB::select('SELECT next VALUE FOR passport_number as number')),true)[0]['number'];
            }
        }

        $tPassport->total_amount = $invoice->amount / 100;
        $tPassport->paid_amount = $invoice->amount / 100;
        $tPassport->given_date = Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('given_date'))->toDateString();
        $tPassport->action = $action;
        $tPassport->payment_status = 'paid';
        $tPassport->payment_date = now()->toDateString();
        $tPassport->status = 'active';
        $tPassport->note = Input::get('note');
        $tPassport->recover_reason = Input::get('recover_reason');
        $tPassport->save();

        $invoiceService->markAsUsed($invoice, $tPassport);

        $activity = new tbl_activities;
        $activity->ip_adress = $_SERVER['REMOTE_ADDR'];
        $activity->owner_id =$customer->id;
        $activity->city_id = $customer->city_id;
        $activity->vehicle_id = $vehicle->id;
        $activity->user_id = auth()->id();
        $activity->action_id = $tPassport->id;
        $activity->action_type = 'technical_pass';
        $activity->action = "Texnika/Tirkama ga pasport berildi " . $tPassport->series . " " . $tPassport->number;
        $activity->time = now()->toDateTimeString();
        $activity->save();

        return json_encode(['id' => $tPassport->id, 'message' => 'success']);
    }
}
