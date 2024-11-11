<?php

namespace App\Http\Controllers\Admin;

use App\CustomerCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleRegistration\StoreRequest;
use App\Http\Requests\Admin\VehicleRegistration\UnregisterRequest;
use App\Http\Services\Customer\Service as CustomerService;
use App\Http\Services\Invoice\InvoiceService;
use App\Http\Services\Vehicle\VehicleService;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Document;
use App\Models\FuelType;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\Vehicle;
use App\Models\VehicleInspection;
use App\Models\VehicleRegistration;
use App\Services\AttachmentService;
use App\Services\LocationService;
use App\tbl_activities;
use App\tbl_supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;


class VehicleRegistrationsController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_reg';

    /* @var AttachmentService $attachmentService */
    private $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }

    public function create(Request $request, InvoiceService $invoiceService)
    {
        $vehicleId = $request->input('vehicle_id');
        $BHM = $invoiceService::BHM();

        $payment_a = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'agregat']])->get()->first();
        $payment_v = $payment_t = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'vehicle']])->get()->first();

        $owner = Customer::find($request->input('customer_id'));
        $servingInvoices = $invoiceService->servableInvoices($owner, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        $categories = \Cache::remember('cust-categories', 60 * 60, function () {
            return CustomerCategories::all();
        });
        $colors = Color::all();

        $suppliers = \Cache::remember('suppliers', 60 * 60, function () {
            return tbl_supplier::all();
        });

        $fuels = \Cache::remember('fuel-type', 60 * 60, function () {
            return FuelType::all();
        });

        $documents = Document::where('service', Document::SERVICE_REGISTRATION)->orderBy('name')->get();
        $vehicle = \DB::table('tbl_vehicles')
                      ->select('tbl_vehicles.id as vehicle_id', 'tbl_vehicle_types.vehicle_type as typename', 'tbl_vehicles.engineno', 'tbl_vehicle_brands.vehicle_brand as brandname', 'tbl_vehicles.type as vehicletype')
                      ->leftjoin('tbl_vehicle_brands', 'tbl_vehicle_brands.id', '=', 'tbl_vehicles.vehiclebrand_id')
                      ->leftjoin('tbl_vehicle_types', 'tbl_vehicle_types.id', '=', 'tbl_vehicle_brands.vehicle_id')
                      ->where('tbl_vehicles.id', '=', $vehicleId)->get()->first();


        return view('registration.add', compact(
            'payment_v', 'payment_a', 'BHM', 'payment_t',
            'vehicle', 'owner', 'servingInvoices',
            'categories', 'colors', 'suppliers', 'fuels', 'documents'
        ));
    }

    public function create_two(Request $request, InvoiceService $invoiceService)
    {
        $vehicleId = $request->input('vehicle_id');
        $BHM = $invoiceService::BHM();

        $payment_a = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'agregat']])->get()->first();
        $payment_v = $payment_t = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'vehicle']])->get()->first();

        $owner = Customer::find($request->input('customer_id'));
        $servingInvoices = $invoiceService->servableInvoices($owner, $request->input('invoice_id'), static::PAYMENT_CATEGORY);

        $documents = Document::where('service', Document::SERVICE_REGISTRATION)->orderBy('name')->get();
        $vehicle = \DB::table('tbl_vehicles')
            ->select('tbl_vehicles.id as vehicle_id', 'tbl_vehicle_types.vehicle_type as typename', 'tbl_vehicles.engineno', 'tbl_vehicle_brands.vehicle_brand as brandname', 'tbl_vehicles.type as vehicletype')
            ->leftjoin('tbl_vehicle_brands', 'tbl_vehicle_brands.id', '=', 'tbl_vehicles.vehiclebrand_id')
            ->leftjoin('tbl_vehicle_types', 'tbl_vehicle_types.id', '=', 'tbl_vehicle_brands.vehicle_id')
            ->where('tbl_vehicles.id', '=', $vehicleId)->get()->first();


        return view('registration.pere-register-form', compact(
            'payment_v', 'payment_a', 'BHM', 'payment_t',
            'vehicle', 'owner', 'servingInvoices',
            'categories', 'colors', 'suppliers', 'fuels', 'documents'
        ));
    }

    public function pere_register_store(Request $request)
    {
        $user = auth()->user();
        $new_customer = Customer::findOrFail($request->new_customer_id);
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $old_customer = Customer::findOrFail($vehicle->owner_id);
        $folder = 'reason-files'  . DIRECTORY_SEPARATOR . now()->toDateString();
        $fileName = bin2hex(random_bytes(32)) . '.' .$request->file('reason-file')->getClientOriginalExtension();
        $request->file('reason-file')->storeAs($folder, $fileName);
        \DB::table('vehicle_register_requests')
        ->insert([
            'vehicle_id'=>$vehicle->id,
            'sell_owner_id'=>$old_customer->id,
            'buy_owner_id'=>$new_customer->id,
            'request_date'=>date('Y-m-d H:i:s'),
            'req_user_id'=>$user->id,
            'sell_city_id'=>$old_customer->city_id,
            'buy_city_id'=>$new_customer->city_id,
            'reason_file'=>now()->toDateString().'/'.$fileName,
            'status'=>'processing',
            'doc'=>$request->doc,
            'doc_note'=>$request->input('doc-note'),
            'note'=>$request->note,
        ]);
        echo $vehicle->id;
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if ($vehicle->status == 'regged' || $vehicle->lock_status == 'lock'){
            return back()->with('fail', 'Bu texnika qayta ro`yxatga olish xolatida emas!' );
        }
        if ($paymentTypeId = $request->input('payment_type_id')) {
            $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
        } else {
            $invoice = Invoice::findOrFail($request->input('invoice_id'));
        }

        $reg = new VehicleRegistration;
        $reg->action = VehicleRegistration::TYPE_REGISTRATION;
        $reg->note = $request->note;
        $reg->date = Carbon::createFromFormat(USER_DATE_FORMAT, $request->input('regdate'));
        $reg->owner_id = $customer->id;
        $reg->vehicle_id = $vehicle->id;
        $reg->total_amount = $invoice->amount / 100;
        $reg->status = 'active';
        $reg->city_id = $customer->city_id;
        $reg->outof = 0;
        $reg->unfit = 0;
        $reg->doc = $request->doc;
        $reg->doc_note = $request->input('doc-note');
        $reg->user_id = auth()->id();
        $reg->save();

        $invoiceService->markAsUsed($invoice, $reg);

        $vehicle->status = VehicleRegistration::TYPE_REGISTRATION;
        $vehicle->owner_id = $customer->id;
        $vehicle->save();

        $vehicle->registrations()
                ->where([['status', 'active'], ['action', VehicleRegistration::TYPE_UNREGISTRATION]])
                ->update(['status' => 'inactive']);

        if ($request->hasFile('reason-file')) {
            $this->attachmentService->upload($request->file('reason-file'), $reg);
        }

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->owner_id = $customer->id;
        $active->city_id = $customer->city_id;
        $active->vehicle_id = $vehicle->id;
        $active->action_id = $reg->id;
        $active->action_type = 'vehicle_reg';
        $active->action = "Texnika ro'yxatga olindi";
        $active->time = now();
        $active->user_id = auth()->id();
        $active->save();

        echo $vehicle->id;
    }

    public function unregisterForm(Request $request, VehicleService $vehicleService, InvoiceService $invoiceService)
    {
        $vehicles = $vehicleService->getUnregistrables($request->input('customer_id'), $request->input('vehicle_id'), ['technicalPassport', 'vehicleCertificate', 'lastTransportNumber']);
        $customer = Customer::find($request->input('customer_id') ?: optional($vehicles->get(0))->owner_id);
//        $paymentTypes = PaymentType::where([['category', '=', 'vehicle_out']])->get();
        return view('registration.sub', compact('vehicles', 'customer'));
    }

    public function unregister(UnregisterRequest $request, InvoiceService $invoiceService, CustomerService $taxPayerService)
    {
        /* @var Vehicle $vehicle */

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $customer = Customer::findOrFail($request->customer_id);

//        /* @var Invoice $invoice */
//        if ($paymentTypeId = $request->input('payment_type_id')) {
//            $invoice = $invoiceService->makePaidService($customer, 'vehicle_out', $paymentTypeId);
//        } else {
//            $invoice = Invoice::findOrFail($request->invoice_id);
//        }

        $registration = new VehicleRegistration;
        $registration->action = VehicleRegistration::TYPE_UNREGISTRATION;
        $registration->date = today();
        $registration->owner_id = $customer->id;
        $registration->city_id = $customer->city_id;
        $registration->status = 'active';
        $registration->total_amount = 0;
        $registration->vehicle_id = $vehicle->id;
        $registration->doc_note = $request->input('doc-note');
        $registration->user_id = auth()->id();

        if ($rawPhone = $request->input('receiver_phone')) {
            $registration->receiver_phone = cleanPhone($rawPhone);
        }

        foreach ([
           'doc', 'note', 'outof', 'unfit', 'receiver_region_id', 'receiver_area_id', 'receiver_address', 'receiver_tax_id'
        ] as $field) {
            $registration->{$field} = Arr::get($request->validated(), $field);
        }

        try {
            \DB::beginTransaction();
            $registration->save();

//            $invoiceService->markAsUsed($invoice, $registration);

            $vehicle->registrations()
                ->where([['status', 'active'], ['action', VehicleRegistration::TYPE_REGISTRATION]])
                ->update(['status' => 'inactive']);

            if ($registration->unfit) {
                $vehicle->condition = 'unfit';
            }

            $vehicle->transportNumber()->update(['status' => 'inactive']);
            $vehicle->technicalPassport()->update(['status' => 'inactive']);
            $vehicle->vehicleCertificate()->update(['status' => 'inactive']);
            $vehicle->inspections()->update(['condition' => VehicleInspection::STATUS_INACTIVE]);

            $vehicle->owner_id = null;
            $vehicle->status = 'unregged';
            $vehicle->save();

            $active = new tbl_activities;
            $active->ip_adress = $_SERVER['REMOTE_ADDR'];
            $active->action_id = $registration->id;
            $active->owner_id = $customer->id;
            $active->city_id = $customer->city_id;
            $active->vehicle_id = $vehicle->id;
            $active->action_type = 'vehicle_reg';
            $active->action = "Texnika ro'yxatdan chiqarildi";
            $active->time = now()->toDateTimeString();
            $active->user_id = auth()->id();
            $active->save();

            $taxId = $request->input('receiver_tax_id');
            $newCustomer = null;
            if ($taxId) {
                $newCustomer = $taxPayerService->getTaxpayerData([
                    strlen($taxId) === 9 ? 'tin' : 'pinfl' => $taxId
                ]);
            }
            \DB::commit();

            if ($request->hasFile('reason-file')) {
                $this->attachmentService->upload($request->file('reason-file'), $registration);
            }

            return [
                'status' => 'ok',
                'message' => '',
                'reference' => $registration->outof && $registration->outof
                    ? null
                    : view('registration._reference', [
                        'registration' => $registration->fresh(),
                        'vehicle' => $vehicle,
                        'oldCustomer' => $customer,
                        'newCustomer' => $newCustomer,
                    ])->render(),
            ];
        } catch (\Exception $e) {
            \DB::rollback();

            return response($e->getTraceAsString().' '.$e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function pere_register_list(Request $request)
    {
        $vr_requests = \DB::table('vehicle_register_requests');
        $user = auth()->user();
        $search = $request->input('s');
        $type = $request->get('type');
        if (!auth()->user()->isAdmin() && $type == 'incoming') {
            $vr_requests->where('vehicle_register_requests.sell_city_id', $user->city_id);
        } elseif (!auth()->user()->isAdmin() && $type == 'outgoing') {
            $vr_requests->where('vehicle_register_requests.buy_city_id', $user->city_id);
        }
        $vr_requests = $vr_requests
            ->join('customers as old_cus', 'old_cus.id', '=', 'vehicle_register_requests.sell_owner_id')
            ->join('customers as new_cus', 'new_cus.id', '=', 'vehicle_register_requests.buy_owner_id')
            ->join('tbl_vehicles', 'tbl_vehicles.id', '=', 'vehicle_register_requests.vehicle_id')
            ->join('tbl_vehicle_brands', 'tbl_vehicle_brands.id', '=', 'tbl_vehicles.vehiclebrand_id')
            ->join('tbl_cities as old_city', 'old_city.id', '=', 'vehicle_register_requests.sell_city_id')
            ->join('tbl_cities as new_city', 'new_city.id', '=', 'vehicle_register_requests.buy_city_id')
            ->join('documents', 'documents.id', '=', 'vehicle_register_requests.doc')
            ->select([
                'old_cus.f_name as old_owner',
                'new_cus.f_name as new_owner',
                'tbl_vehicle_brands.vehicle_brand',
                'old_city.name as old_dist',
                'new_city.name as new_dist',
                'documents.name as doc_type',
                'vehicle_register_requests.request_date',
                'vehicle_register_requests.response_date',
                'vehicle_register_requests.reason_file',
                'vehicle_register_requests.status',
                'vehicle_register_requests.doc_note',
                'vehicle_register_requests.note',
                'vehicle_register_requests.vehicle_id',
                'vehicle_register_requests.sell_owner_id',
                'vehicle_register_requests.buy_owner_id',
                'vehicle_register_requests.message',
                'vehicle_register_requests.id'
            ]);
        if (isset($search)){
            $vr_requests = $vr_requests->where('tbl_vehicle_brands.vehicle_brand', '=', $search);
        }
        $vr_requests = $vr_requests->paginate(20);
        if ($type == 'incoming') {
            $view = 'registration.pere-register-list';
        } else {
            $view = 'vehicle.pere-register-list';
        }
        return view($view, compact('vr_requests', 'search'));
    }

    public function pere_register_action(Request $request)
    {
        $user = auth()->user();
        if ($request->input('action') == 'reject'){
            \DB::table('vehicle_register_requests')
                ->where('id', '=', $request->input('id'))
                ->update([
                    'message' => $request->input('message'),
                    'resp_user_id' => $user->id,
                    'response_date' => date('Y-m-d H:i:s'),
                    'status' => 'rejected'
                ]);
            return $request->input('id');
        } elseif ($request->input('action') == 'accept') {
            \DB::table('vehicle_register_requests')
                ->where('id', '=', $request->input('id'))
                ->update([
                    'resp_user_id' => $user->id,
                    'response_date' => date('Y-m-d H:i:s'),
                    'status' => 'accepted'
                ]);
            $vehicle_id = \DB::table('vehicle_register_requests')
                ->where('id', '=', $request->input('id'))->value('vehicle_id');
            $customer_id = \DB::table('vehicle_register_requests')
                ->where('id', '=', $request->input('id'))->value('sell_owner_id');
            $vehicle = Vehicle::findOrFail($vehicle_id);
            $customer = Customer::findOrFail($customer_id);

            $registration = new VehicleRegistration;
            $registration->action = VehicleRegistration::TYPE_UNREGISTRATION;
            $registration->date = today();
            $registration->owner_id = $customer->id;
            $registration->city_id = $customer->city_id;
            $registration->status = 'active';
            $registration->total_amount = 0;
            $registration->vehicle_id = $vehicle->id;
            $registration->doc_note = $request->input('doc-note');
            $registration->user_id = auth()->id();
            try {
                \DB::beginTransaction();
                $registration->save();
                $vehicle->registrations()
                    ->where([['status', 'active'], ['action', VehicleRegistration::TYPE_REGISTRATION]])
                    ->update(['status' => 'inactive']);

                $vehicle->transportNumber()->update(['status' => 'inactive']);
                $vehicle->technicalPassport()->update(['status' => 'inactive']);
                $vehicle->vehicleCertificate()->update(['status' => 'inactive']);
                $vehicle->inspections()->update(['condition' => VehicleInspection::STATUS_INACTIVE]);

                $vehicle->owner_id = null;
                $vehicle->status = 'unregged';
                $vehicle->save();

                $active = new tbl_activities;
                $active->ip_adress = $_SERVER['REMOTE_ADDR'];
                $active->action_id = $registration->id;
                $active->owner_id = $customer->id;
                $active->city_id = $customer->city_id;
                $active->vehicle_id = $vehicle->id;
                $active->action_type = 'vehicle_reg';
                $active->action = "Texnika ro'yxatdan chiqarildi";
                $active->time = now()->toDateTimeString();
                $active->user_id = auth()->id();
                $active->save();
                \DB::commit();
                return $vehicle_id;
            } catch (\Exception $e) {
                \DB::rollback();
                return response($e->getTraceAsString().' '.$e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function register_accept_form(Request $request, InvoiceService $invoiceService)
    {
        $vehicle_id = \DB::table('vehicle_register_requests')
            ->where('id', '=', $request->input('id'))->value('vehicle_id');
        $owner_id = \DB::table('vehicle_register_requests')
            ->where('id', '=', $request->input('id'))->value('buy_owner_id');
        $vehicle = Vehicle::findOrFail($vehicle_id);
        $v_brand = \DB::table('tbl_vehicle_brands')->where('id', '=', $vehicle->vehiclebrand_id)->get()->first();
        $v_type = \DB::table('tbl_vehicle_types')->where('id', '=', $v_brand->vehicle_id)->get()->first();
        $v_working = \DB::table('vehicle_works_fors')->where('id', '=', $v_brand->working_type_id)->get()->first();
        $v_factory = \DB::table('vehicle_factories')->where('id', '=', $vehicle->factory_id)->get()->first();
        if ($vehicle->type == 'vehicle') {
            $v_fuel = \DB::table('tbl_fuel_types')->where('id', '=', $vehicle->fuel_id)->get()->first();
        } else {
            $v_fuel = null;
        }
        $v_color = \DB::table('tbl_colors')->where('id', '=', $vehicle->color_id)->get()->first();
        if ($vehicle->type == 'vehicle' || $vehicle->type == 'tirkama') {
            $vehicle_c = \DB::table('technical_passports')->where([['vehicle_id', '=', $vehicle_id], ['status', '=', 'active']])->orderBy('id', 'desc')->get()->first();
        } else {
            $vehicle_c = \DB::table('vehicle_certificates')->where('vehicle_id', '=', $vehicle_id)->orderBy('id', 'desc')->get()->first();
        }
        $BHM = $invoiceService::BHM();

        $payment_a = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'agregat']])->get()->first();
        $payment_v = $payment_t = \DB::table('tbl_payment_types')->where([['category', '=', static::PAYMENT_CATEGORY], ['code', '=', 'new'], ['key_payment', '=', 'vehicle']])->get()->first();

        $owner = Customer::find($owner_id);
        $servingInvoices = $invoiceService->servableInvoices($owner, $request->input('invoice_id'), static::PAYMENT_CATEGORY);
        if (!empty($owner)) {
            $v_city = \DB::table('tbl_cities')->where('id', '=', $owner->city_id)->get()->first();
        } else {
            $v_city = null;
        }
        if (!empty($v_city)) {
            $v_region = \DB::table('tbl_states')->where('id', '=', $v_city->state_id)->get()->first();
        } else {
            $v_region = null;
        }
        return view('vehicle.pere-register-form',
            compact(
                'vehicle',
                'owner',
                'view_id',
                'v_type',
                'v_brand',
                'v_factory',
                'v_working',
                'v_city',
                'v_region',
                'v_fuel',
                'v_color',
                'vehicle_c',
                'payment_v', 'payment_a', 'BHM', 'payment_t',
                'servingInvoices'
            )
        );
    }

    public function register_accept_store(Request $request)
    {

    }
}
