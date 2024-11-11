<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Invoice\InvoiceService;
use App\Models\Customer;
use App\Http\Requests\Admin\DriverLicense\StoreRequest;
use App\Http\Services\DriverLicense\DriverLicenseService;
use App\Models\Document;
use App\Models\DriverLicence;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\tbl_activities;
use App\Http\Controllers\Controller;
use App\tbl_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DriverLicenseController extends Controller
{
    const PAYMENT_CATEGORY = 'driver_lic';

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $settings = settings();
//        dd(auth()->user()->isAdmin());
//        if (!$settings->driver_licenses_enabled && !auth()->user()->isAdmin()) {
//            return redirect('https://tm.uzagroteh.uz');
//        }

        $stateId = (array_filter(auth()->user()->region_ids) ?: [4121])[0];
        $title = "Haydovchilik guvohnomasi berish";

        $seriesNumber = '052913';


        $documents = Document::where('service', Document::SERVICE_DRIVER_LICENSE)->orderBy('name')->get();
        $min = \DB::table('tbl_payment_types')->where('category', '=', 'min')->get()->first();


        $payment_n = PaymentType::where([['category', '=', 'driver_lic'], ['code', '=', 'new'], ['key_payment', '=', 'new']])->first();
        $payment_u = PaymentType::where([['category', '=', 'driver_lic'], ['code', '=', 'new'], ['key_payment', '=', 'update']])->first();
        $payment_o = PaymentType::where([['category', '=', 'driver_lic'], ['code', '=', 'new'], ['key_payment', '=', 'outof']])->first();

        $payment_r = PaymentType::where([['category', 'driver_lic'], ['code', 'rec'], ['key_payment', '<>', '']])->get();

        $customer = Customer::join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                            ->select(\DB::raw('customers.*, ownership_forms.name as ownership_form'))
                            ->find(219);

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        return view('driver-licence.form', compact(
            'title',
            'seriesNumber',
            'customer',
            'documents',
            'min',
            'payment_n',
            'payment_u',
            'payment_o',
            'payment_r',
            'servingInvoices'
        ));
    }

    public function store(StoreRequest $request, DriverLicenseService $service, InvoiceService $invoiceService)
    {
        $settings = settings();
        if (!$settings->driver_licenses_enabled && !auth()->user()->isAdmin()) {
            return redirect('https://tm.uzagroteh.uz');
        }


        /* @var $customer Customer */
        $customer = Customer::findOrFail($request->customer_id);

        $type = [];

        foreach (Input::get('types') as $t) {
            if (!empty($t) && !empty($t['name']) && !empty($t['date']) && !empty($t['duration'])) {
                $type[] = ['name' => $t['name'], 'given_date' => $t['date'], 'duration' => $t['duration']];
            }
        }

        if ($dLicenseId = $request->input('driver-licence-id')) {
            $dLicence = DriverLicence::findOrFail($dLicenseId);
        } else {
            if (in_array($request->action, [$service::ACTION_REISSUE, $service::ACTION_UPDATE])) {
                $service->inactiveExisting($customer);
            } elseif ($request->action === $service::ACTION_ISSUE) {
                if ($customer->driverLicenses()->active()->exists()) {
                    return json_encode(['message' => 'active-driver-licence-exists']);
                }
            }

            $dLicence = new DriverLicence;
        }

        $dLicence->note = $request->note;
        $dLicence->owner_id = $customer->getKey();
        $dLicence->user_id = auth()->id();

        if (!$dLicence->getKey()) {
            $stateId = explode(',', auth()->user()->state_id ?: '4121')[0];
            $seriesNumber = generateSeriesNumber('driver_licences', $stateId);

            $dLicence->series = $seriesNumber->series;
            $dLicence->number = $seriesNumber->number;
            $dLicence->local_series = $seriesNumber->local_series;
            $dLicence->local_number = $seriesNumber->local_number;
        }

        $dLicence->status = DriverLicence::STATUS_ACTIVE;
        $dLicence->type = $type;
        $dLicence->action = $request->action;
        $dLicence->doc = $request->doc;
        $dLicence->doc_note = $request->input('doc-note');
        $dLicence->total_amount = $request->payment;
        $dLicence->paid_amount = $request->payment;
        $dLicence->given_date = $request->input('given_date', now());
        $dLicence->payment_status = 'paid';
        $dLicence->payment_date = now();
        $dLicence->recover_reason = $request->recover_reason;
        $dLicence->save();

        /* @var Invoice $invoice */
        if ($paymentTypeId = $request->input('payment_type_id')) {
            $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }

        $invoiceService->markAsUsed($invoice, $dLicence);

        $active = new tbl_activities;
        $active->ip_adress = $request->ip();
        $active->owner_id = $customer->id;
        $active->user_id = auth()->id();
        $active->city_id = $customer->city_id;
        $active->action_id = $dLicence->id;
        $active->action_type = 'driver_lic';
        $active->action = "Haydovchilik guhohnoma berildi";
        $active->time = now()->toDateTimeString();
        $active->save();

        return json_encode(['message' => 'success', 'id' => $dLicence->id]);
    }
}
