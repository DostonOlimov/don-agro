<?php

namespace App\Http\Controllers;

use App\Exports\FullReportExport;
use App\Http\Requests;
use App\Models\Application;
use App\Models\Area;
use App\Models\CropData;
use App\Models\CropsGeneration;
use App\Models\CropsName;
use App\Models\CropsType;
use App\Models\Invoice;
use App\Models\ListRegion;
use App\Models\OrganizationCompanies;
use App\Models\PaymentCategory;
use App\Models\PreparedCompanies;
use App\Models\ProductionType;
use App\Models\Region;
use App\Models\RequiredAmount;
use App\Models\Requirement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use NunoMaduro\Collision\Adapters\Phpunit\State;

//use NunoMaduro\Collision\Adapters\Phpunit\State;

class ReportController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    // main excel export
    public function excel_export(Request $request)
    {
        $data = $this->getReport($request);
        $data = $data->latest('id')
            ->get();
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ReportExport($data), 'hisobot.xlsx');
    }
    // main excel export
    public function excel_city_export(Request $request)
    {
        $crop = $request->input('crop');
        $name = CropsName::find($crop)->name;
        $data = $this->getCityReport($request);
        $measure_type = ($crop == 20 or $crop == 8) ? trans('message.dona') : trans('message.tonna');

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CityReportExport($data,$name,$measure_type), 'hisobot.xlsx');
    }

    public function report(Request $request)
    {
        $app_type_selector = $request->input('app_type_selector');
        $city = $request->input('city');
        $region = $request->input('region');
        $crop = $request->input('crop');
        $type = $request->input('type');
        // $generation = $request->input('generation');
        $from = $request->input('from');
        $till = $request->input('till');
        $organization = $request->input('organization');
        $prepared = $request->input('prepared');
        $country = $request->input('country');
        $year = $request->input('year');

        if($organization or $prepared){
            $organization = OrganizationCompanies::find($organization);
            $prepared = PreparedCompanies::find($prepared);
            $city = $region = null;
        }

        $apps = $this->getReport($request);
        $apps = $apps->latest('id')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['app_number' => $request->input('app_number')])
            ->appends(['till' => $till])
            ->appends(['from' => $from])
            ->appends(['city' => $city])
            ->appends(['region' => $region])
            ->appends(['organization' => $organization])
            ->appends(['prepared' => $prepared])
            ->appends(['country' => $country])
            ->appends(['crop' => $crop])
            ->appends(['type' => $type])
            // ->appends(['generation' => $generation])
            ->appends(['year' => $year]);

        $states = DB::table('tbl_states')->where('country_id',  234)->get()->toArray();
        $crop_names = DB::table('crops_name')->get()->toArray();
        $cities = '';
        $types = '';
        // $generations = '';
        if($city){
            $cities = DB::table('tbl_cities')->where('state_id',$city)->get()->toArray();
        }
        // if($crop){
        //     $types = DB::table('crops_type')->where('crop_id',$crop)->get()->toArray();
        //     $generations = DB::table('crops_generation')->where('crop_id',$crop)->get()->toArray();
        // }

        $names = DB::table('crops_name')->get();
        $countries = DB::table('tbl_countries')->get();
        $years = CropData::getYear();

        return view('reports.full_report', compact(
            'apps',
            'from',
            'till',
            'city',
            'region',
            'crop',
            'type',
            // 'generation',
            'states',
            'organization',
            'prepared',
            'country',
            'crop_names',
            'types',
            // 'generations',
            'cities',
            'names',
            'years',
            'year',
            'countries'
        ));
    }
    public function region_report(Request $request)
    {
        $crop = $request->input('crop');
        $year = $request->input('year');

        if (!$crop) {
            $crop = 13;
        }

        $crop_names = DB::table('crops_name')->get()->toArray();
        $name = CropsName::find($crop)->name;
        $years = CropData::getYear();
        $measure_type = ($crop == 20 or $crop == 8) ? trans('message.dona') : trans('message.tonna');

        $app_states = $this->getCityReport($request);

        return view('reports.region_report', compact('app_states','name','years','year','crop','crop_names','measure_type'));
    }
    public function company_report (Request $request)
    {
        $app_type_selector = $request->input('app_type_selector');
        $year = $request->input('year');
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');

        if (!$crop) {
            $crop = 13;
        }
        $states = Region::with('areas')
            ->with('areas.companies')
            ->with('areas.companies.application')
            ->with('areas.companies.application.crops')
            ->with('areas.companies.application.tests')
            ->with('areas.companies.application.tests.result')
            ->whereHas('areas.companies.application', function ($query) use ($crop,$year) {
                $query->whereHas('crops', function ($subQuery) use ($crop,$year) {
                    $subQuery = $subQuery->where('name_id', $crop);
                    if($year){
                        $subQuery->where('year',$year);
                    }
                });
            })
            ->with(['areas.companies' => function ($q) use ($crop,$year) {
                $q->whereHas('application', function ($query) use ($crop,$year) {
                    $query->whereHas('crops', function ($subQuery) use ($crop,$year) {
                        $subQuery = $subQuery->where('name_id', $crop);
                        if($year){
                            $subQuery->where('year',$year);
                        }
                    });
                });
            }])
            ->get();

        $years = CropData::getYear();
        $crop_names = DB::table('crops_name')->get()->toArray();
        $name = CropsName::find($crop)->name;
        $measure_type = ($crop == 20 or $crop == 8) ? trans('message.dona') : trans('message.tonna');


        return view('reports.company_report ', compact('states','name','crop','crop_names','measure_type','years','year'));
    }

    public function save_amount(Request $request)
    {

        $city_id = $request->input('city_id');
        $crop_id = $request->input('crop_id');
        $year = session('year') ?  session('year') : date('Y');
        $amount = $request->input('amount');
        $result = RequiredAmount::where('state_id',$city_id)
            ->where('crop_id',$crop_id)
            ->where('year',$year)
            ->first();
        if($amount > 0 ){
            if($result){
                $result->required_amount = $amount;
                $result->save();
            }else{
                $new_result = new RequiredAmount();
                $new_result->state_id = $city_id;
                $new_result->crop_id = $crop_id;
                $new_result->year = $year;
                $new_result->required_amount = $amount;
                $new_result->save();
            }
        }

        return response()->json(['message' => 'Answer saved successfully']);
    }
    // get data for full report
    private function getReport( $request)
    {
        $app_type_selector = $request->input('app_type_selector');
        $city = $request->input('city');
        $region = $request->input('region');
        $crop = $request->input('crop');
        $type = $request->input('type');
        // $generation = $request->input('generation');
        $from = $request->input('from');
        $till = $request->input('till');
        $organization= $request->input('organization');
        $prepared= $request->input('prepared');
        $country= $request->input('country');
        $year= $request->input('year');
        if($organization or $prepared)
        {
            $city = $region = null;
        }

        $apps = Application::with('organization')
            ->with('organization.city')
            ->with('organization.city.region')
            ->with('prepared')
            ->with('crops')
            ->with('crops.country')
            ->with('crops.name')
            ->with('crops.type')
            // ->with('crops.generation')
            ->with('decision')
            ->with('tests')
            ->with('tests.result')
            ->with('tests.result.certificate')
            ->whereIn('status',[Application::STATUS_ACCEPTED,Application::STATUS_FINISHED]);

        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps = $apps->whereDate('date', '>=', $fromTime)
                ->whereDate('date', '<=', $tillTime);
        }
        if ($city) {
            $apps = $apps->whereHas('organization', function ($query) use ($city) {
                $query->whereHas('city', function ($query) use ($city) {
                    $query->where('state_id', '=', $city);
                });
            });
        }
        if ($region) {
            $area = Area::find($region);
            if($city and $area->state_id == $city){
                $apps = $apps->whereHas('organization', function ($query) use ($region) {
                    $query->where('city_id', '=', $region);
                });
            }
        }

        if ($organization) {
            $apps = $apps->whereHas('organization', function ($query) use ($organization) {
                $query->where('id', '=', $organization);
            });
        }
        if ($prepared) {
            $apps = $apps->whereHas('prepared', function ($query) use ($prepared) {
                $query->where('id', '=', $prepared);
            });
        }
        if ($country) {
            $apps = $apps->whereHas('crops', function ($query) use ($country) {
                $query->where('country_id', '=', $country);
            });
        }
        if ($year) {
            $apps = $apps->whereHas('crops', function ($query) use ($year) {
                $query->where('year', '=', $year);
            });
        }
        if ($crop) {
            $apps = $apps->whereHas('crops', function ($query) use ($crop) {
                $query->where('name_id', '=', $crop);
            });
        }
        if ($type) {
            $crop_type = CropsType::find($type);
            if($crop and $crop_type->crop_id == $crop){
                $apps = $apps->whereHas('crops', function ($query) use ($type) {
                    $query->where('type_id', '=', $type);
                });
            }
        }
       /*  if ($generation) {
            $crop_generation = CropsGeneration::find($generation);
            if($crop and $crop_generation->crop_id == $crop){
                $apps = $apps->whereHas('crops', function ($query) use ($generation) {
                    $query->where('generation_id', '=', $generation);
                });
            }
        } */
        if (!is_null($app_type_selector)) {

            if($app_type_selector == 3){
                $apps = $apps->doesntHave('tests.result');
            }else{
                $apps = $apps->whereHas('tests.result', function ($query) use ($app_type_selector) {
                    $query->where('type', '=', $app_type_selector);
                });
            }
        }
        $apps->when($request->input('app_number'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->orWhere('app_number', $searchQuery);
            });
        });
        $apps->when($request->input('s'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->whereHas('crops', function ($query) use ($searchQuery) {
                    $query->where('party_number', 'like', '%' . addslashes($searchQuery) . '%');
                });

            });
        });

        return $apps;
    }

    // get city data
    private function getCityReport( $request)
    {
        $year =  session('year') ?  session('year') : date('Y');
        $crop = $request->input('crop');
        $hosil_yili = $request->input('year');

        if (!$crop) {
            $crop = 13;
        }
        $app_states = Region::select(
            'tbl_states.id as state_id',
            'tbl_states.name as state_name',
            'required_amount.required_amount as required_amount',
            DB::raw('COUNT(applications.id) as application_count'),
            DB::raw('SUM((CASE WHEN crop_data.measure_type = 2 THEN amount * 0.001 ELSE amount END)) as total_amount'),
            DB::raw('SUM((CASE WHEN final_results.type = 2 THEN (CASE WHEN crop_data.measure_type = 2 THEN amount * 0.001 ELSE amount END) ELSE 0 END)) as total_amount_type_2'),
            DB::raw('SUM((CASE WHEN final_results.type IS NULL THEN (CASE WHEN crop_data.measure_type = 2 THEN amount * 0.001 ELSE amount END) ELSE 0 END)) as total_amount_type_3'),
            DB::raw('SUM((CASE WHEN final_results.type = 0 THEN (CASE WHEN crop_data.measure_type = 2 THEN amount * 0.001 ELSE amount END) ELSE 0 END)) as total_amount_type_4')
        )
            ->leftJoin('tbl_cities', 'tbl_states.id', '=', 'tbl_cities.state_id')
            ->leftJoin('organization_companies', 'tbl_cities.id', '=', 'organization_companies.city_id')
            ->leftJoin('applications', 'organization_companies.id', '=', 'applications.organization_id')
            ->leftJoin('crop_data', function($join) use ($crop,$hosil_yili){
                $join->on('applications.crop_data_id', '=','crop_data.id');
                    $join->where('crop_data.name_id', '=', $crop);
                if($hosil_yili){
                        $join->where('crop_data.year', '=', $hosil_yili);
                }
            })
            ->leftJoin('required_amount', function($join) use ($crop,$year) {
                $join->on('required_amount.state_id', '=', 'tbl_states.id')
                    ->where('required_amount.crop_id', '=', $crop)
                    ->where('required_amount.year', '=', $year);
            })
            ->leftjoin("test_programs","test_programs.app_id","=","applications.id")
            ->leftjoin("final_results","final_results.test_program_id","=","test_programs.id")
            ->where('applications.app_number','!=',0)
            ->whereYear('applications.date',$year)
            ->groupBy('tbl_states.id', 'tbl_states.name','required_amount.required_amount')
            ->orderBy('application_count', 'desc')
            ->get();

        return $app_states;
    }

}
