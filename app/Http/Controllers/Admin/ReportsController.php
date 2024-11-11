<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FullReportExport;
use App\Http\Controllers\Controller;
use App\Services\LocationService;
use App\Http\Requests;
use App\Http\Services\Report\Service;
use App\Models\Area;
use App\Models\Level;
use App\Models\Region;
use App\Models\WorkingType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function byVehicleTypes(Request $request)
    {
        $title = 'Mavjud texnika - hisobot';
        $regions = Region::when(auth()->user()->region_ids, function ($query) {
            $query->whereIn('id', auth()->user()->region_ids);
        })->orderBy('name')->get();

        if ($selectedRegionId = $request->input('selected_region_id')) {
            $selectedRegion = $regions->firstWhere('id', $selectedRegionId);
            if (auth()->user()->isAdmin() || in_array(optional(auth()->user()->access)->position, ['country', 'region'])) {
                $areas = Area::where('state_id', $selectedRegion->id)->orderBy('name')->get();
            } else {
                $areas = Area::whereIn('id', auth()->user()->area_ids)->orderBy('name')->get();
            }

            $dataQuery = \DB::table('tbl_vehicles')
                ->join('tbl_vehicle_brands', 'tbl_vehicles.vehiclebrand_id', '=', 'tbl_vehicle_brands.id')
                ->when($areas, function ($query, $areas) {
                    $query->whereIn('tbl_vehicles.area_id', $areas->pluck('id'));
                })
                ->where('tbl_vehicles.status', 'regged')
                ->select([
                    'tbl_vehicles.area_id as area_id',
                    'tbl_vehicle_brands.working_type_id',
                    'tbl_vehicles.vehiclebrand_id as brand_id',
                    \DB::raw('count(*) as vehicle_cnt')
                ])->havingRaw('vehicle_cnt > 0');

            $data = (clone $dataQuery)->groupBy(['tbl_vehicles.area_id', 'tbl_vehicles.vehiclebrand_id', 'tbl_vehicle_brands.working_type_id'])->get();
            $areaData = (clone $dataQuery)->groupBy(['tbl_vehicles.area_id'])->get(); // @todo

            $workingTypes = WorkingType::whereIn('id', $data->pluck('working_type_id')->unique())
                ->with(['brands' => function ($query) use ($data) {
                    $query->whereIn('id', $data->pluck('brand_id')->unique());
                }])->get();

            return view('report.vehicle.types', compact(
                'title',
                'regions',
                'selectedRegion',
                'workingTypes',
                'areas',
                'data',
                'areaData'
            ));
        } else {
            return view('report.vehicle.types', compact('regions', 'title'));
        }
    }

    public function byVehicleTypesRespublic(Request $request)
    {
        $title = 'Mavjud texnika - hisobot';
        $regions = Region::get();

        $dateFrom = date('Y-m-d 00:00:01', strtotime($request->input('dateFrom')));
        $dateTo = date('Y-m-d 23:59:59', strtotime($request->input('dateTo')));
        $dataQuery = \DB::table('tbl_vehicles')
            ->join('tbl_cities', 'tbl_vehicles.area_id', '=', 'tbl_cities.id')
            ->join('tbl_states', 'tbl_cities.state_id', '=', 'tbl_states.id')
            ->join('tbl_vehicle_brands', 'tbl_vehicles.vehiclebrand_id', '=', 'tbl_vehicle_brands.id')
            ->where('tbl_vehicles.status', 'regged')
            ->select([
                'tbl_cities.state_id as area_id',
                'tbl_vehicle_brands.working_type_id',
                'tbl_vehicles.vehiclebrand_id as brand_id',
                \DB::raw('count(*) as vehicle_cnt')
            ])->havingRaw('vehicle_cnt > 0');

        $data = (clone $dataQuery)->groupBy(['tbl_cities.state_id', 'tbl_vehicles.vehiclebrand_id', 'tbl_vehicle_brands.working_type_id'])->get();
        $areaData = (clone $dataQuery)->groupBy(['tbl_cities.state_id'])->get(); // @todo

        $workingTypes = WorkingType::whereIn('id', $data->pluck('working_type_id')->unique())
            ->with(['brands' => function ($query) use ($data) {
                $query->whereIn('id', $data->pluck('brand_id')->unique());
            }])->get();

        return view('report.vehicle.respublic', compact(
            'title',
            'regions',
            'workingTypes',
            'data',
            'regions',
            'areaData'
        ));
    }

    public function showFullReportForm(Request $request, Service $reportService)
    {
        /* @var \App\User $user */
        $user = auth()->user();
        $regions = LocationService::getAllowedRegions($user)
            ->sortBy('name')
            ->loadCount(['vehicles' => function ($query) use ($user) {
                $query->whereHas('customer')
                    ->when(
                        !$user->isAdmin() && $user->level->position !== Level::LEVEL_COUNTRY,
                        function ($query) use ($user) {
                            $query->whereIn('area_id', LocationService::getAllowedAreas($user)->pluck('id'));
                        }
                    );
            }]);

        return view('reports.vehicles.full-report-form', [
            'regions' => $regions,
        ]);
    }

    public function fullReport(Request $request, Service $reportService)
    {
        return new FullReportExport($reportService->fullReportQuery());
    }
}
