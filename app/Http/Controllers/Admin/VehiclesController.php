<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VehicleProhibition;
use App\Http\Requests\Admin\Vehicle\StoreRequest;
use App\Http\Services\Invoice\InvoiceService;
use App\Http\Controllers\Controller;
use App\Http\Services\Vehicle\DTO\LockRequest;
use App\Http\Services\Vehicle\ProhibitionService;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Vehicle;
use App\Models\VehicleRegistration;
use App\Services\AttachmentService;
use App\Services\LocationService;
use App\tbl_activities;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VehiclesController extends Controller
{
    const PAYMENT_CATEGORY = 'vehicle_reg';

    public function store(StoreRequest $request, InvoiceService $invoiceService, ProhibitionService $prohibitionService, AttachmentService $attachmentService)
    {
        try {
            \DB::beginTransaction();
            $customer = Customer::findOrFail($request->customer_id);

            $chasicno=Input::get('chasicno');
            $vehiclebrand=Input::get('brand_id');
            $modelyear=Input::get('modelyear');
            $factoryname=Input::get('factory_id');
            $condition = Input::get('condition');
            $vehicle_work = Input::get('working_id');
            $factory_number = Input::get('factory_number');
            $category = Input::get('category');
            $corpusno = Input::get('corpusno');
            $engineno=Input::get('engineno');
            $fuel = Input::get('fuel');
            $color = Input::get('color');
            $weight = Input::get('weight');
            $weight_full = Input::get('weight_full');
            $supplier = Input::get('supplier');
            $lising = Input::get('lising_id');
            $type = Input::get('vehicle_type_id');
            $enginesize = Input::get('enginesize');
            $date = Input::get('date');
            $doc = Input::get('doc');

            $vehicle = new Vehicle;
            $vehicle->category = $category;
            $vehicle->chassisno = $chasicno;
            $vehicle->vehiclebrand_id = $vehiclebrand;
            $vehicle->modelyear  = $modelyear;
            $vehicle->owner_id  = $customer->id;
            $vehicle->area_id  = $customer->city_id;
            $vehicle->factory_id = $factoryname;
            $vehicle->engineno  = $engineno;
            $vehicle->corpusno  = $corpusno;
            $vehicle->factory_number = $factory_number;
            $vehicle->condition = $condition;
            $vehicle->working_for_id = $vehicle_work;
            $vehicle->fuel_id = $fuel;
            $vehicle->color_id = $color;
            $vehicle->weight_full = $weight_full;
            $vehicle->weight = $weight;
            $vehicle->supplier_id = $supplier;
            $vehicle->lising = $lising;
            $vehicle->enginesize = $enginesize;
            $vehicle->type = $type;
            $vehicle->save();

            $document = Document::findOrFail($request->input('doc'));
            if ($document->free_service) {
                $invoice = $invoiceService->makeFreeService($customer, static::PAYMENT_CATEGORY);
            } else if ($paymentTypeId = $request->input('payment_type_id')) {
                $invoice = $invoiceService->makePaidService($customer, static::PAYMENT_CATEGORY, $paymentTypeId);
            } else {
                $invoice = Invoice::findOrFail($request->input('invoice_id'));
            }

            /* @var VehicleRegistration $vehicleRegistration */
            $vehicleRegistration = $vehicle->registrations()->create([
                'action' => VehicleRegistration::TYPE_REGISTRATION,
                'note' => 'Yangi texnika',
                'doc' => $doc,
                'doc_note' => $request->input('doc-note'),
                'date' => date('Y-m-d', strtotime($date)),
                'owner_id' => $customer->id,
                'status' => 'active',
                'city_id' => $customer->city_id,
                'user_id' => auth()->id(),
                'total_amount' => $doc == 10 ? 0 : $invoice->amount / 100,
                'is_temporary' => $request->input('is_temporary', 0),
            ]);

            $invoiceService->markAsUsed($invoice, $vehicleRegistration);

            if ($vehicleRegistration->is_temporary) {
                $prohibitionService->lock(
                    new LockRequest(VehicleProhibition::DEFAULT_PROHIBITOR_ID, $vehicle, now()->toDateString(), '2019-04-17', '325-qaror')
                );
            }

            $active = new tbl_activities;
            $active->ip_adress = $_SERVER['REMOTE_ADDR'];
            $active->owner_id = $customer->id;
            $active->city_id = $customer->city_id;
            $active->user_id = auth()->id();
            $active->vehicle_id = $vehicle->id;
            $active->action_id = $vehicle->id;
            $active->action_type = 'vehicle_reg';
            $active->action = "Texnika ro'yhatdan o'tkazildi";
            $active->time = now();
            $active->save();

            if ($request->hasFile('reason-file')) {
                $attachmentService->upload($request->file('reason-file'), $vehicleRegistration);
            }

            \DB::commit();
            echo $vehicle->id;
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::debug($e->getMessage());
            throw $e;
        }
    }

    public function unregistered(Request $request)
    {
        $vehicleRegistrations = VehicleRegistration::unregged()->active()
                                       ->orderByDesc('date')->orderByDesc('created_at')
                                       ->when(!auth()->user()->isAdmin(), function (Builder $query) {
                                           return $query->where(function ($regionQuery) {
                                               return $regionQuery->whereIn('receiver_area_id', LocationService::getAllowedAreas()->pluck('id'))
                                                                  ->orWhereNull('receiver_area_id');
                                           });
                                       })
                                       ->where('unfit', 0)
                                       ->with(['vehicle.brand.vehicleType', 'customer.area.region', 'receiverRegion', 'receiverArea'])
                                       ->paginate();

        return view('vehicle.unregistered-list', [
            'vehicleRegistrations' => $vehicleRegistrations,
        ]);
    }
}
