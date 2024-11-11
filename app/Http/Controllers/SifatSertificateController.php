<?php

namespace App\Http\Controllers;


use App\Filters\V1\ApplicationFilter;
use App\Models\Application;
use App\Models\ChigitResult;
use App\Models\ChigitTips;
use App\Models\ClientData;
use App\Models\Clients;
use App\Models\CropData;
use App\Models\CropsSelection;
use App\Models\Indicator;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryResultData;
use App\Models\OrganizationCompanies;
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
        $names = DB::table('crops_name')->where('id','!=',1)->get()->toArray();
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
            'party_number' => 'required|string|max:10',
            'amount' => 'required',
        ]);

        $crop = CropData::create([
            'name_id'       => $request->input('name'),
            'country_id'    => $request->input('country'),
            'kodtnved'      => $request->input('tnved'),
            'party_number'  => $request->input('party_number'),
            'measure_type'  => $request->input('measure_type'),
            'amount'        => $request->input('amount'),
            'year'          => $request->input('year'),
            'joy_soni'      => $request->input('joy_soni'),
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

        return view('sifat_sertificate.client_data_add',compact('id'));

    }
    public function ClientDataStore(Request $request)
    {
        $crop = ClientData::create([
            'app_id'       => $request->input('id'),
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

        return view('sifat_sertificate.add_result',compact('id'));

    }
    public function ResultStore(Request $request)
    {
        $appId = $request->input('id');
        $app =Application::findOrFail($appId);

        $crop = LaboratoryResult::create([
            'app_id'   => $appId,
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
        $data = [];

// Static data entries
        $dataEntries = [
            ['name' => "JAMI", 'value' => $request->input('jami1'), 'type' => 1],
            ['name' => "JAMI", 'value' => $request->input('jami2'), 'type' => 2],
            ['name' => 'MA\'DANLI', 'value' => $request->input('madan'), 'type' => 1],
            ['name' => "ZARARLI", 'value' => $request->input('zarar'), 'type' => 1],
            ['name' => $request->input('name1'), 'value' => $request->input('value1'), 'type' => 1]
        ];

        // Add static entries to $data with app_id
        foreach ($dataEntries as $entry) {
            $data[] = array_merge($entry, ['app_id' => $appId]);
        }

        // Dynamic data entries using a loop
        for ($i = 1; $i < 3; $i++) {
            $name = $request->input('name' . $i);
            if ($name) {
                $data[] = [
                    'app_id' => $appId,
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

        // Generate QR code
        $url = route('sifat_sertificate.view', $id);
        $qrCode = QrCode::size(100)->generate($url);
        $quality = 1;


        return view('sifat_sertificate.show', compact('test', 'formattedDate','company', 'qrCode','quality'));
    }

    public function edit($id)
    {
        $data = Application::findOrFail($id);
        $company = OrganizationCompanies::with('city')->findOrFail($data->organization_id);

        // Fetch values and tip
        $chigitValues = $this->getChigitValuesAndTip($data);

        return view('sifat_sertificate.edit', compact('data', 'company') + $chigitValues);
    }

    public function editData($id)
    {
        $data = Application::findOrFail($id);

        $names = DB::table('crops_name')->where('id','!=',1)->get()->toArray();
        $selection = CropsSelection::get();

        return view('sifat_sertificate.edit_data', compact('data','names','selection'));
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
            'selection_code' => 'nullable|string',
        ]);

        // Find the application and related crop data
        $app = Application::findOrFail($id);
        $crop_data = $app->crops;

        // Update the crop data with validated input
        $crop_data->update([
            'name_id' => $validatedData['name'],
            'kodtnved' => $validatedData['tnved'],
            'party_number' => $validatedData['party_number'],
            'amount' => $validatedData['amount'],
            'selection_code' => $validatedData['selection_code'],
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
        $client->client_id = $request->input('client');
        $client->vagon_number = $request->input('number');
        $client->yuk_xati = $request->input('yuk_xati');
        $client->save();

        return redirect()->route('sifat_sertificate.edit',$client->app_id)->with('message', 'Successfully Submitted');
    }

    //edit result data
    public function resultEdit ($id)
    {
        $data = Application::findOrFail($id);

        $chigitValues = $this->getChigitValuesAndTip($data);

        return view('sifat_sertificate.result_edit', compact('data')+$chigitValues);
    }

    public function resultUpdate(Request $request)
    {

        $id = $request->input('id');
        $client = Application::findOrFail($id);
        foreach ($client->chigit_result as $result){
            $result->value = $request->input('value'. $result->id);
            $result->save();
        }

        return redirect()->route('sifat_sertificate.edit',$id)->with('message', 'Successfully Submitted');
    }

    //accept online applications
    public function accept($id)
    {
        $test = Application::findOrFail($id);
        $company = OrganizationCompanies::with('city')->findOrFail($test->organization_id);
        $quality = 1;

        // date format
        $formattedDate = formatUzbekDateInLatin($test->date);
        $currentYear = date('Y');
//        $zavod_id = $test->user->zavod_id;
//        $number = 0;
//        if($chigitValues['quality']){
//            $number = SifatSertificates::where('zavod_id', $zavod_id)
//                ->where('year', $currentYear)
//                ->max('number');
//        }
//        $number = $number ? $number + 1 : 1;
//
//        // create sifat certificate
//        if (!$test->sifat_sertificate) {
//
//            $sertificate = new SifatSertificates();
//            $sertificate->app_id = $id;
//            $sertificate->number = $number;
//            $sertificate->zavod_id = $zavod_id;
//            $sertificate->year = $currentYear;
//            $sertificate->created_by = \auth()->user()->id;
//            $sertificate->save();
//        }

        $sert_number = 001001;

        // Generate QR code
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate(route('sifat_sertificate.download', $id)));

        // Load the view and pass data to it
        $pdf = Pdf::loadView('sifat_sertificate.pdf', compact('test','quality','sert_number','formattedDate', 'company', 'qrCode'));

        return $pdf->stream('sdf');
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

// Private method to avoid code duplication
    private function getChigitValuesAndTip($application)
    {
        $nuqsondorlik = optional($application->chigit_result()->where('indicator_id', 9)->first())->value;
        $tukdorlik = optional($application->chigit_result()->where('indicator_id', 12)->first())->value;
        $namlik = optional($application->chigit_result()->where('indicator_id', 11)->first())->value;
        $zararkunanda = optional($application->chigit_result()->where('indicator_id', 10)->first())->value;

        $tip = null;
        if($nuqsondorlik and $tukdorlik){
            $tip = ChigitTips::where('nuqsondorlik', '>=', $nuqsondorlik);
            if($application->crops->name_id == 2){
                $tip = $tip->where('tukdorlik', '>=', $tukdorlik)
                    ->where('tukdorlik_min', '<=', $tukdorlik);
            }

            $tip = $tip->where('crop_id', $application->crops->name_id)
                ->first();
        }

        $quality = false;
        if($tip && $namlik <= $tip->namlik && $tukdorlik <= $tip->tukdorlik and $tukdorlik >= $tip->tukdorlik_min){
            $quality = true;
        }

        return [
            'nuqsondorlik' => $nuqsondorlik,
            'tukdorlik' => $tukdorlik,
            'namlik' => $namlik,
            'zararkunanda' => $zararkunanda,
            'tip' => $tip,
            'quality' => $quality
        ];
    }
}

