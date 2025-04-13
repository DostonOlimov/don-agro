<?php

namespace App\Http\Controllers;


use App\Filters\V1\ApplicationFilter;
use App\Models\Application;
use App\Models\ChigitResult;
use App\Models\ChigitTips;
use App\Models\ClientData;
use App\Models\Clients;
use App\Models\CropData;
use App\Models\CropsName;
use App\Models\CropsSelection;
use App\Models\CropsType;
use App\Models\Indicator;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryResultData;
use App\Models\OrganizationCompanies;
use App\Models\SertificateLaboratories;
use App\Models\SifatSertificates;
use App\Services\SearchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DefaultModels\tbl_activities;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class SifatSertificateController extends Controller
{

    public function applicationList(Request $request, ApplicationFilter $filter,SearchService $service)
    {
        $user_id = Auth::user()->id;

//        try {
            session(['crop'=>2]);

            $names = getCropsNames();
            $states = getRegions();
            $years = getCropYears();
            $all_status = getAppStatus();

            return $service->search(
                $request,
                $filter,
                Application::class,
                [
                    'crops',
                    'organization',
                    'prepared'
                ],
                compact('names', 'states', 'years','all_status'),
                'sifat_sertificate.list',
                [],
                false,
                null,
                null,
                ['app_type','=',2]
            );

//        } catch (\Throwable $e) {
//            // Log the error for debugging
//            \Log::error($e);
//            return $this->errorResponse('An unexpected error occurred', [], Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
    }


    // application addform
    public function addApplication($organization)
    {
        $names = CropsName::whereHas('sertificate_nds')->get();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $years = CropData::getYear();

        return view('sifat_sertificate.add',compact('organization','years','names','countries'));

    }


    // application store
    public function store(Request $request)
    {
        $user = Auth::user();

        // Define validation rules with camelCase attribute names
        $validatedData = $request->validate([
            'name' => 'required|int',
            'amount' => 'required',
        ]);

        $crop = CropData::create([
            'name_id'       => $request->input('name'),
            'country_id'    => $request->input('country'),
            'type_id'       => $request->input('type'),
            'kodtnved'      => $request->input('tnved'),
            'party_number'  => $request->input('party_number'),
            'measure_type'  => $request->input('measure_type'),
            'amount'        => $request->input('amount'),
            'year'          => $request->input('year'),
            'joy_soni'      => $request->input('joy_soni'),
            'made_date'     => $request->input('made_date'),
            'sxeme_number'  => 7,
        ]);

        $application = Application::create([
            'crop_data_id'     => $crop->id,
            'organization_id'  => $request->input('organization'),
            'prepared_id'      => 1,
            'type'             => Application::TYPE_1,
            'date'             => date('Y-m-d'),
            'status'           => Application::STATUS_FINISHED,
            'data'             => $request->input('data'),
            'app_type'         => 2,
            'created_by'       => $user->id,
        ]);

        \App\tbl_activities::create([
            'ip_adress'   => request()->ip(),
            'user_id'     => $user->id,
            'action_id'   => $application->id,
            'action_type' => 'app_add',
            'action'      => "Ariza qo'shildi",
            'time'        => now(),
        ]);

        return redirect()->route('sifat-sertificates.add_client',$application->id)->with('message', 'Successfully Submitted');
    }

    public function addClientData($id)
    {
        $transportType = ClientData::getType();
        $companyMarker = ClientData::getMarkerExist();

        return view('sifat_sertificate.client_data_add',compact('id','transportType','companyMarker'));

    }
    public function ClientDataStore(Request $request)
    {
        $app = Application::findOrFail($request->input('id'));

        $crop = ClientData::create([
            'app_id'       => $app->id,
            'transport_type'    => $request->input('transport_type'),
            'vagon_number'      => $request->input('number'),
            'yuk_xati'  => $request->input('yuk_xati'),
            'sender_name'  => $request->input('sender_name'),
            'sender_station'  => $request->input('sender_station'),
            'reciever_station'  => $request->input('reciever_station'),
            'sender_address'  => $request->input('sender_address'),
            'company_marker'  => $request->input('company_marker'),
        ]);

        return redirect()->route('sifat-sertificates.add_result',$request->input('id'))->with('message', 'Successfully Submitted');
    }

    public function addResult($id)
    {
        $app = Application::findOrFail($id);

        $types = LaboratoryResult::getType();
        $group = LaboratoryResult::getGroup();
        $flavour_types = LaboratoryResult::getFlaourTypes();

        if($app->crops->name->sertificate_type == 2){
            return view('sifat_sertificate.add_result2',compact('id','types','group','flavour_types'));
        }

        return view('sifat_sertificate.add_result',compact('id','types','group'));

    }
    public function ResultStore(Request $request)
    {
        $app = Application::findOrFail($request->input('id'));

        $crop = LaboratoryResult::create([
            'app_id'   => $app->id,
            'class'    => $request->input('group'),
            'type'      => $request->input('type') ?? $request->input('flavour'),
            'subtype'  => $request->input('subtype') ?? $request->input('smell'),
            'nature'  => $request->input('nature') ?? $request->input('kulligi'),
            'humidity'  => $request->input('humidity'),
            'falls_number'  => $request->input('falls_number') ?? $request->input('oqlik'),
            'kleykovina'  => $request->input('kleykovina'),
            'quality'  => $request->input('quality'),
            'elak_number'  => $request->input('elak_number'),
            'elak_result'  => $request->input('elak_result'),
            'clour'  => $request->input('colour'),
            'qoldiq_number'  => $request->input('qoldiq_number'),
            'qoldiq_result'  => $request->input('qoldiq_result'),
        ]);
        $data = [];

// Static data entries
        $dataEntries = [
            ['name' => "JAMI", 'value' => $request->input('jami1'), 'type' => 1],
            ['name' => 'MA\'DANLI', 'value' => $request->input('madan'), 'type' => 1],
            ['name' => "ZARARLI", 'value' => $request->input('zarar'), 'type' => 1]
        ];
        if($request->input('name1')){
            $dataEntries[] = ['name' => $request->input('name1'), 'value' => $request->input('value1'), 'type' => 1];
        }
        if($request->input('buzilgan')){
            $dataEntries[] = ['name' => "Buzilgan", 'value' => $request->input('buzilgan'), 'type' => 1];
        }
        if($request->input('siniq')){
            $dataEntries[] = ['name' => "Siniq", 'value' => $request->input('value1'), 'type' => 1];
        }
        if($request->input('archilmagan')){
            $dataEntries[] = ['name' => "Po'sti archilmagan", 'value' => $request->input('archilmagan'), 'type' => 1];
        }
        if($request->input('unsimon')){
            $dataEntries[] = ['name' => "Unsimon", 'value' => $request->input('unsimon'), 'type' => 1];
        }
        if($request->input('jami2')){
            $dataEntries[] = ['name' => "JAMI", 'value' => $request->input('jami2'), 'type' => 2];
        }

        // Add static entries to $data with app_id
        foreach ($dataEntries as $entry) {
            $data[] = array_merge($entry, ['app_id' => $app->id]);
        }

        // Dynamic data entries using a loop
        for ($i = 1; $i <= 3; $i++) {
            $name = $request->input('z_name' . $i);
            if ($name) {
                $data[] = [
                    'app_id' => $app->id,
                    'name'   => $request->input('z_name' . $i),
                    'value'  => $request->input('z_value' . $i),
                    'type'   => 2
                ];
            }
        }

        // Insert data if not empty
        if (!empty($data)) {
            LaboratoryResultData::insert($data);
        }
        return redirect()->route('/sifat-sertificates/list')
            ->with('message', 'Successfully Submitted');
    }

    public function showapplication($id)
    {
        $test = Application::findOrFail($id);
        $company = OrganizationCompanies::with('city')->findOrFail($test->organization_id);
        $formattedDate = formatUzbekDateInLatin($test->date);
        $nds_type = 1;
        if($test->crops->name_id == 25 and $test->crops->country_id == 243){
            $nds_type = 2;
        }
        $nds = $test->crops->name->sertificate_nds->where('type',$nds_type)->first();
        $director = SertificateLaboratories::where('state_id', $test->user->state_id)->first();

        // Generate QR code
        $url = route('sifat_sertificate.view', $id);
        $qrCode = QrCode::size(100)->generate($url);
        $t = 1;


        return view('sifat_sertificate.show', compact('test', 'nds','director','formattedDate','company', 'qrCode','t'));
    }

    public function edit($id)
    {
        $data = Application::findOrFail($id);
        $company = OrganizationCompanies::with('city')->findOrFail($data->organization_id);

        return view('sifat_sertificate.edit', compact('data', 'company'));
    }

    public function editData($id)
    {
        $data = Application::findOrFail($id);

        $names = DB::table('crops_name')->where('id','!=',1)->get()->toArray();
        $types = CropsType::where('crop_id',optional($data->crops)->name_id)->get();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $years = CropData::getYear();

        return view('sifat_sertificate.edit_data', compact('data','names','types','countries','years'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'tnved' => 'nullable|string',
            'party_number' => 'nullable|string',
            'amount' => 'required|numeric',
            'type' => 'nullable|integer',
            'joy_soni'=> 'nullable|string',
            'year' => 'required|integer',
            'country' => 'required|integer'
        ]);

        // Find the application and related crop data
        $app = Application::findOrFail($id);
        $crop_data = $app->crops;

        // Update the crop data with validated input
        $crop_data->update([
            'name_id' => $validatedData['name'],
            'kodtnved' => $validatedData['tnved'],
            'type_id' => $validatedData['type'],
            'party_number' => $validatedData['party_number'],
            'joy_soni' => $validatedData['joy_soni'],
            'amount' => $validatedData['amount'],
            'year' => $validatedData['year'],
            'country_id' => $validatedData['country'],
        ]);

        // Redirect with success message
        return redirect()->route('sifat_sertificate.edit', $id)->with('message', 'Successfully Submitted');
    }

    //edit client data
    public function clientEdit($id)
    {
        $data = ClientData::findOrFail($id);

        $clients = Clients::get();

        return view('sifat_sertificate.client_edit', compact('data','clients'));
    }

    public function clientUpdate (Request $request)
    {

        $id = $request->input('id');
        $client = ClientData::findOrFail($id);
        $client->transport_type = $request->input('transport_type');
        $client->vagon_number = $request->input('number');
        $client->yuk_xati = $request->input('yuk_xati');
        $client->sender_name = $request->input('sender_name');
        $client->sender_station = $request->input('sender_station');
        $client->reciever_station = $request->input('reciever_station');
        $client->sender_address = $request->input('sender_address');
        $client->company_marker = $request->input('company_marker');
        $client->save();

        return redirect()->route('sifat_sertificate.edit',$client->app_id)->with('message', 'Successfully Submitted');
    }

    //edit result data
    public function resultEdit ($id)
    {
        $data = Application::findOrFail($id);

        return view('sifat_sertificate.result_edit', compact('data'));
    }

    public function resultUpdate(Request $request)
    {

        $id = $request->input('id');
        $client = LaboratoryResult::where('app_id',$id)->first();
        $client->update([
            'class'    => $request->input('class'),
            'type'      => $request->input('type'),
            'subtype'  => $request->input('subtype'),
            'nature'  => $request->input('nature'),
            'humidity'  => $request->input('humidity'),
            'falls_number'  => $request->input('falls_number'),
            'kleykovina'  => $request->input('kleykovina'),
            'quality'  => $request->input('quality'),
            'elak_number'  => $request->input('elak_number'),
            'elak_result'  => $request->input('elak_result'),
        ]);

        return redirect()->route('sifat_sertificate.edit',$id)->with('message', 'Successfully Submitted');
    }

    //accept online applications
    public function accept($id)
    {
        $test = Application::with('laboratory_result_data')->findOrFail($id);
        $result_data1 = optional($test->laboratory_result_data())->where('type',1)->get();
        $result_data2 = optional($test->laboratory_result_data())->where('type',2)->get();


        $company = OrganizationCompanies::with('city')->find($test->organization_id);
        $quality = 1;

        // date format
        $formattedDate = formatUzbekDateInLatin($test->date);
        $currentYear = date('Y');
        $type = optional(optional($test->crops)->name)->sertificate_type;

//        get max  number of sertificate
        $number = SifatSertificates::where('year', $currentYear)
            ->where('type',$type)
            ->max('number');
//        }
        $number = $number ? $number + 1 : 1;

        // create sifat certificate
        if (!$test->sifat_sertificate) {

            $sertificate = new SifatSertificates();
            $sertificate->app_id = $id;
            $sertificate->number = $number;
            $sertificate->state_id = optional($test->user)->state_id;
            $sertificate->year = $currentYear;
            $sertificate->type = $type;
            $sertificate->created_by = \auth()->user()->id;
            $sertificate->save();
        }

        $sert_number = ($currentYear - 2000) * 1000000 + $number;

        // Generate QR code
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate(route('sifat_sertificate.download', $id)));

        //nds
        $nds_type = 1;
        if($test->crops->name_id == 25 and $test->crops->country_id == 243){
            $nds_type = 2;
        }
        $nds = $test->crops->name->sertificate_nds->where('type',$nds_type)->first();
        $director = SertificateLaboratories::where('state_id', $test->user->state_id)->first();

        // Load the view and pass data to it
        $pdf = Pdf::loadView('sifat_sertificate.pdf', compact('test','nds','director','quality','sert_number','formattedDate', 'company', 'qrCode','result_data1','result_data2'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'DejaVu Sans');

    //   return $pdf->stream('sdf');
        // Save the PDF file
        $filePath = storage_path('app/public/sifat_sertificates/certificate_' . $id . '.pdf');
        $pdf->save($filePath);

        // Redirect to list page with success message
        return redirect()->route('/sifat-sertificates/list', ['generatedAppId' => $id])
            ->with('message', 'Certificate saved!');
    }


    public function download($id)
    {
        $filePath = storage_path('app/public/sifat_sertificates/certificate_' . $id . '.pdf');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

}

