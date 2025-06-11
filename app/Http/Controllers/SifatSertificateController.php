<?php

namespace App\Http\Controllers;


use App\Filters\V1\ApplicationFilter;
use App\Models\Application;
use App\Models\ClientData;
use App\Models\CropData;
use App\Models\CropsName;
use App\Models\CropsType;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryResultData;
use App\Models\SertificateLaboratories;
use App\Models\SifatSertificates;
use App\Services\SearchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class SifatSertificateController extends Controller
{

    public function applicationList(Request $request, ApplicationFilter $filter,SearchService $service)
    {
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
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

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

    public function addClientData(Application $app)
    {
        $transportType = ClientData::getType();
        $companyMarker = ClientData::getMarkerExist();

        return view('sifat_sertificate.client_data_add',compact('app','transportType','companyMarker'));

    }
    public function ClientDataStore(Application $app,Request $request): RedirectResponse
    {
        ClientData::create([
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

        return redirect()->route('sifat-sertificates.add_result', $app)->with('message', 'Successfully Submitted');
    }

    public function addResult(Application $app)
    {
        $types = LaboratoryResult::getType();
        $group = LaboratoryResult::getGroup();
        $flavour_types = LaboratoryResult::getFlaourTypes();

        if($app->crops->name->sertificate_type == 2){
            return view('sifat_sertificate.add_result2',compact('app','types','group','flavour_types'));
        }

        return view('sifat_sertificate.add_result',compact('app','types','group'));
    }
    public function ResultStore(Application $app, Request $request): RedirectResponse
    {
        LaboratoryResult::create([
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

    public function showapplication(Application $app)
    {
        $app->load('laboratory_result_data');
        $result_data1 = optional($app->laboratory_result_data())->where('type',1)->get();
        $result_data2 = optional($app->laboratory_result_data())->where('type',2)->get();
        $formattedDate = formatUzbekDateInLatin($app->date);
        $nds_type = 1;
        if($app->crops->name_id == 25 and $app->crops->country_id == 243){
            $nds_type = 2;
        }
        $nds = $app->crops->name->sertificate_nds->where('type',$nds_type)->first();
        $director = SertificateLaboratories::where('state_id', $app->user->state_id)->first();

        // Generate QR code
        $url = route('sifat_sertificate.view', $app->id);
        $qrCode = QrCode::size(100)->generate($url);
        $t = 1;

        return view('sifat_sertificate.show', compact('app', 'nds','director','formattedDate','qrCode','t','result_data1','result_data2'));
    }

    public function edit(Application $app)
    {
       return view('sifat_sertificate.edit', compact('app'));
    }

    public function editData(Application $app)
    {
        $names = DB::table('crops_name')->where('id','!=',1)->get()->toArray();
        $types = CropsType::where('crop_id',optional($app->crops)->name_id)->get();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $years = CropData::getYear();

        return view('sifat_sertificate.edit_data', compact('app','names','types','countries','years'));
    }

    public function update(Application $app, Request $request)
    {
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

        // Update the crop data with validated input
        $app->crops->update([
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
        return redirect()->route('sifat_sertificate.edit', $app)->with('message', 'Successfully Submitted');
    }

    //edit client data
    public function clientEdit($id)
    {
        $data = ClientData::findOrFail($id);
        $transportType = ClientData::getType();
        $companyMarker = ClientData::getMarkerExist();

        return view('sifat_sertificate.client_edit', compact('data', 'transportType', 'companyMarker'));
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
        $result_data1 = optional($data->laboratory_result_data())->where('type',1)->get();
        $result_data2 = optional($data->laboratory_result_data())->where('type',2)->get();

        return view('sifat_sertificate.result_edit', compact('data', 'result_data1','result_data2'));
    }

    public function resultUpdate(Request $request): RedirectResponse
    {
        $id = $request->input('id');

        // Fetch related data
        $resultDataByType = [
            1 => LaboratoryResultData::where('app_id', $id)->where('type', 1)->get(),
            2 => LaboratoryResultData::where('app_id', $id)->where('type', 2)->get(),
        ];

        // Update main LaboratoryResult record
        $client = LaboratoryResult::where('app_id', $id)->firstOrFail();
        $client->update($request->only([
            'class', 'type', 'subtype', 'nature', 'humidity',
            'falls_number', 'kleykovina', 'quality', 'elak_number', 'elak_result',
        ]));

        // Update static values in result_data1 (type 1)
        $this->updateResultValue($resultDataByType[1], 0, $request->input('jami1'));
        $this->updateResultValue($resultDataByType[1], 1, $request->input('madan'));
        $this->updateResultValue($resultDataByType[1], 2, $request->input('zarar'));

        // Update static value in result_data2 (type 2)
        $this->updateResultValue($resultDataByType[2], 0, $request->input('jami2'));

        // Handle optional dynamic entries
        $dataEntries = [];

        $this->updateOrQueueResult($resultDataByType[1], 3, 'name1', 'value1', 1, $request, $dataEntries);
        $this->updateOrQueueResult($resultDataByType[2], 1, 'z_name1', 'z_value1', 2, $request, $dataEntries);
        $this->updateOrQueueResult($resultDataByType[2], 2, 'z_name2', 'z_value2', 2, $request, $dataEntries);
        $this->updateOrQueueResult($resultDataByType[2], 3, 'z_name3', 'z_value3', 2, $request, $dataEntries);

        // Insert new dynamic entries if any
        if (!empty($dataEntries)) {
            foreach ($dataEntries as &$entry) {
                $entry['app_id'] = $id;
            }
            LaboratoryResultData::insert($dataEntries);
        }

        return redirect()->route('sifat_sertificate.edit', $id)->with('message', 'Successfully Submitted');
    }


    //accept online applications
    public function accept($id)
    {
        $app = Application::with('laboratory_result_data','crops','user','laboratory_result')->findOrFail($id);
        $result_data1 = optional($app->laboratory_result_data())->where('type',1)->get();
        $result_data2 = optional($app->laboratory_result_data())->where('type',2)->get();

        $quality = 1;

        // date format
        $formattedDate = formatUzbekDateInLatin($app->date);
        $currentYear = date('Y');
        $type = optional(optional($app->crops)->name)->sertificate_type;

//        get max  number of sertificate
        $number = SifatSertificates::where('year', $currentYear)
            ->where('type',$type)
            ->max('number');

        $number = $number ? $number + 1 : 1;

        // create sifat certificate
        if (!$app->sifat_sertificate) {
            $sertificate = new SifatSertificates();
            $sertificate->app_id = $app->id;
            $sertificate->number = $number;
            $sertificate->state_id = optional($app->user)->state_id;
            $sertificate->year = $currentYear;
            $sertificate->type = $type;
            $sertificate->created_by = \auth()->user()->id;
            $sertificate->save();
        }else{
            $number = $app->sifat_sertificate->number;
        }

        $sert_number = ($currentYear - 2000) * 1000000 + $number;

        // Generate QR code
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate(route('sifat_sertificate.download', $app)));

        //nds
        $nds_type = 1;
        if($app->crops->name_id == 25 and $app->crops->country_id == 243){
            $nds_type = 2;
        }
        $nds = $app->crops->name->sertificate_nds->where('type',$nds_type)->first();
        $director = SertificateLaboratories::where('state_id', $app->user->state_id)->first();

        // Load the view and pass data to it
        $pdf = Pdf::loadView('sifat_sertificate.pdf', compact('app','nds','director','quality','sert_number','formattedDate','qrCode','result_data1','result_data2'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'DejaVu Sans');

       //return $pdf->stream('sdf');
        // Save the PDF file
        $filePath = storage_path('app/public/sifat_sertificates/certificate_' . $app->id . '.pdf');
        $pdf->save($filePath);

        // Redirect to list page with success message
        return redirect()->route('/sifat-sertificates/list', ['generatedAppId' => $id])
            ->with('message', 'Certificate saved!');
    }


    public function download(Application $app)
    {
        $filePath = storage_path('app/public/sifat_sertificates/certificate_' . $app->id . '.pdf');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
    /**
     * Update a specific index of result data if exists.
     */
    private function updateResultValue($collection, $index, $value)
    {
        if (isset($collection[$index])) {
            $collection[$index]->value = $value;
            $collection[$index]->save();
        }
    }

    /**
     * Either update an existing result or queue it for insertion.
     */
    private function updateOrQueueResult($collection, $index, $nameKey, $valueKey, $type, Request $request, array &$dataEntries)
    {
        if ($request->filled($nameKey)) {
            if (isset($collection[$index])) {
                $collection[$index]->name = $request->input($nameKey);
                $collection[$index]->value = $request->input($valueKey);
                $collection[$index]->save();
            } else {
                $dataEntries[] = [
                    'name' => $request->input($nameKey),
                    'value' => $request->input($valueKey),
                    'type' => $type,
                ];
            }
        }
    }
}

