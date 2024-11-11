<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\VehicleInspection\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Vehicle;
use App\Models\VehicleInspection;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleInspectionsController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_med';

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $vehicle = Vehicle::with(['brand.vehicleType', 'transportNumber'])->find($request->input('vehicle_id'));
        $customer = Customer::join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                            ->select('customers.*', 'ownership_forms.name as ownership_form')
                            ->with(['vehicles' => function ($query) {
                                $query->with(['brand.vehicleType', 'transportNumber']);
                            }])
                            ->find($request->input('customer_id') ?: optional($vehicle)->owner_id);

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), static::PAYMENT_CATEGORY);
        $payments = $invoiceService->paymentTypes(static::PAYMENT_CATEGORY, $servingInvoices->count() === 1 ? $servingInvoices->get(0) : null);

        return view('certificate.medadd', compact(
                'vehicle',
                'payments',
                'customer',
                'servingInvoices'
            ) + [
                'model' => new VehicleInspection,
                'invoiceCategory' => static::PAYMENT_CATEGORY,
            ]);
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        /* @var Customer $customer */
        $customer = Customer::findOrFail($request->customer_id);

        /* @var Vehicle $vehicle */
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        /* @var Invoice $invoice */
        if ($paymentTypeId = $request->input('payment_type_id')) {
            $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }


        $inspectionResult = $request->input('status');

        if ($request->input('type_id') == VehicleInspection::TYPE_MANDATORY) {
            $vehicle->inspections()->update(['condition' => VehicleInspection::STATUS_INACTIVE]);
        }

        $med = new VehicleInspection;
        $med->owner_id = $customer->id;
        $med->vehicle_id = $vehicle->id;
        $med->type_id = $request->input('type_id');
        $med->note = $request->input('note');
        $med->status = $inspectionResult;
        $med->total_amount = $invoice->amount / 100;
        $med->date = Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('givendate'))->toDateString();;
        $med->talonno = $request->input('talonnumber');
        $med->condition = $inspectionResult === VehicleInspection::RESULT_PASS ? VehicleInspection::STATUS_ACTIVE : VehicleInspection::STATUS_INACTIVE;
        $med->user_id = auth()->id();
        $med->type = $invoice->type_id;
        $med->save();

        $invoiceService->markAsUsed($invoice, $med);

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->owner_id = $customer->id;
        $active->user_id = auth()->id();
        $active->city_id = $customer->city_id;
        $active->vehicle_id = $vehicle->id;
        $active->action_id = $med->id;
        $active->action_type = 'vehicle_med';
        $active->action = "Texnik ko'rikdan o'tkazildi";
        $active->time = now()->toDateTimeString();
        $active->save();

        return redirect('/certificate/medlist')->with('message', 'Successfully Submitted');
    }
}
