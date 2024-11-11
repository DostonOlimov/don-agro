<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleProhibitionsController extends Controller
{
    public function unlock(Request $request)
    {
        $vehicle = Vehicle::whereDoesntHave('prohibition')
                          ->where('lock_status', Vehicle::STATE_LOCKED)
                          ->findOrFail($request->vehicle_id);
        $vehicle->lock_status = Vehicle::STATE_OPEN;
        $vehicle->save();

        return redirect()->route('vehicles.show', ['id' => $vehicle->id]);
    }
}
