<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VehicleProhibition;
use App\Http\Requests\Admin\Tm\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Tm;
use App\Models\Vehicle;
use App\tbl_activities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TmsController extends Controller
{
    public function create(Request $request, InvoiceService $invoiceService)
    {
        if (Input::get('id')) {
            $tm = \DB::table('tbl_tms')->where('id', '=', Input::get('id'))->get()->first();
            $vehicleId = $tm->vehicle_id;
            $ownerId = $tm->owner_id;
            $type = 'old';
            $tm_num = $tm->number;
        } else {
            $vehicleId = Input::get('vehicle_id');
            $ownerId = Input::get('owner_id');
            $type = 'new';
            $tm_num = \DB::table('tbl_tms')->orderBy('id', 'desc')->get()->first();
            if (empty($tm_num)) {
                $tm_num = 1;
            } else {
                $tm_num = \DB::table('tbl_tms')->orderBy('id', 'desc')->get()->first()->number + 1;
            }
        }

        $user = \Auth::user();
        $min = \DB::table('tbl_payment_types')->where('category', 'min')->get()->first();
        $payment = \DB::table('tbl_payment_types')->where('category', 'vehicle_tm')->first();

        $vehicle = Vehicle::select('tbl_vehicles.*', 'tbl_vehicle_types.id as vehicletype_id')
                      ->leftJoin('tbl_vehicle_brands', 'tbl_vehicle_brands.id', '=', 'tbl_vehicles.vehiclebrand_id')
                      ->leftJoin('tbl_vehicle_types', 'tbl_vehicle_types.id', '=', 'tbl_vehicle_brands.vehicle_id')
                      ->where('tbl_vehicles.id', $vehicleId)
                      ->where('tbl_vehicles.owner_id', $ownerId)
                      ->first();

        if (!empty($vehicle)) {
            $this->authorize('view', $vehicle);
//            $this->authorize('issueTm1', $vehicle);

            if ($vehicle->type == 'vehicle' || $vehicle->type == 'tirkama') {
                $document = getActiveTechPassport($vehicle->id);
            } else {
                $document = getActiveCertificate($vehicle->id);
            }

            $vehicle->passport_number = !empty($document) ? $document->number : 'Berilmagan';
            $vehicle->passport_series = !empty($document) ? $document->series : '';

            $vehicle->vehicle_type = getVehicleType($vehicle->vehicletype_id);
            $vehicle->brand = getVehicleBrands($vehicle->vehiclebrand_id);

            $registrationRecord = getLastRegistration($vehicle);
            $vehicle->registration_date = (!empty($registrationRecord) && $registrationRecord->action == 'regged') ? date('d.m.Y', strtotime($registrationRecord->date)) : 'Ro\'yxatga olinmagan';
        } else {
            $vehicle = new \stdClass;
        }

        /** @var Vehicle $vehicle */
        $lock = $vehicle->prohibitions()->where('status',  'active')->latest()->first();
        if ($lock && $vehicle->lock_status === 'lock') {
            $locker = \DB::table('vehicle_lockers')->where('id', '=', $lock->locker_id)->get()->first();
            $vehicle->locker = $locker->name;
            $vehicle->lock_date = $lock->date;
        } else {
            $vehicle->locker = null;
            $vehicle->lock_date = null;
        }

        if ($vehicle->type != 'agregat') {
            $number = \DB::table('transport_numbers')->where([
                ['status', 'active'],
                ['vehicle_id', $vehicleId],
                ['owner_id', $vehicle->owner_id]
            ])->get()->first();
            $vehicle->t_code = $number ? $number->code : null;
            $vehicle->t_series = $number ? $number->series : null;
            $vehicle->t_number = $number ? $number->number : null;
            $vehicle->t_number_type = $number ? $number->type : null;
        } else {
            $vehicle->t_code = null;
            $vehicle->t_series = null;
            $vehicle->t_number = null;
            $vehicle->t_number_type = null;
        }

        if ($user->role !== 'admin') {
            $user->role = \DB::table('tbl_accessrights')->where('id', '=', $user->role)->first()->name;
        }

        $customer = Customer::join('tbl_cities', 'tbl_cities.id', '=', 'customers.city_id')
                         ->join('tbl_states', 'tbl_states.id', '=', 'tbl_cities.state_id')
                         ->join('ownership_forms', 'ownership_forms.id', '=', 'customers.form')
                         ->where('customers.id', $ownerId)
                         ->select(
                             'customers.*',
                             'tbl_cities.name as city',
                             'tbl_states.name as state',
                             'ownership_forms.name as ownerform'
                         )->first();

        $servingInvoices = $invoiceService->servableInvoices($customer, $request->input('invoice_id'), VehicleProhibition::PAYMENT_CATEGORY);

        $title = "TM-1 ma'lumotnoma";
        return view('vehicle.tm-1', compact(
            'title',
            'vehicle',
            'user',
            'min',
            'payment',
            'type',
            'tm',
            'tm_num',
            'customer',
            'servingInvoices'
        ));
    }

    public function serveVehicles(Request $request)
    {
        return view('vehicle.invoice-tm-1', [
            'customer' => Customer::find($request->customer_id),
            'vehicles' => Vehicle::where('owner_id', $request->customer_id)
                                 ->with(['brand.vehicleType', 'transportNumber'])
                                 ->get(),
        ] + request()->query());
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        $customer = Customer::findOrFail($request->input('customer_id'));
        $vehicle = Vehicle::findOrFail($request->input('vehicle_id'));

        $this->authorize('view', $vehicle);

        /* @var Invoice $invoice */
        if ($paymentTypeId = $request->input('payment_type_id')) {
            $invoice = $invoiceService->makePaidService($customer, VehicleProhibition::PAYMENT_CATEGORY, $paymentTypeId);
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }

        $tmform = new Tm;
        $tmform->vehicle_id = $vehicle->id;
        $tmform->owner_id = $customer->id;
        $tmform->payment = $invoice->id;
        $tmform->number = Tm::max('id') + 1;
        $tmform->date = now()->toDateString();
        $tmform->user_id = auth()->id();
        $tmform->save();

        $invoiceService->markAsUsed($invoice, $tmform);

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->vehicle_id = $vehicle->id;
        $active->owner_id = $customer->id;

        $active->user_id = auth()->id();
        $active->action_id = $tmform->id;
        $active->action_type = 'vehicle_tm';
        $active->action = 'Texnika egasiga TM-1 ma\'lumotnoma berildi';
        $active->city_id = $customer->id;
        $active->time = now()->toDateTimeString();
        $active->save();

        echo $tmform->id;
    }
}
