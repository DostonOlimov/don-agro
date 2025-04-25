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
use App\Models\Region;
use App\Models\SertificateLaboratories;
use App\Models\SifatSertificates;
use App\Models\StorageCapacityConclusion;
use App\Models\StorageConclusionFiles;
use App\Services\SearchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DefaultModels\tbl_activities;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class StorageConclusionController extends Controller
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
                StorageCapacityConclusion::class,
                [
                    'organization',
                ],
                compact('names', 'states', 'years','all_status'),
                'storage_conclusion.list',
                [],
                false,
                null,
                null,
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
        $types = StorageCapacityConclusion::getType();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $years = CropData::getYear();

        return view('storage_conclusion.add',compact('organization','years','types','countries'));

    }


    // application store
    public function store(Request $request)
    {
        $user = Auth::user();

        // Define validation rules with camelCase attribute names
        $validatedData = $request->validate([
            'amount' => 'required',
        ]);

        $storage = StorageCapacityConclusion::create([
            'type'          => $request->input('type'),
            'measure_type'  => $request->input('type') == 2 ? 1 : 2,
            'given_date'    => \Carbon\Carbon::parse($request->input('dob'))->format('Y-m-d'),
            'valid_date'    => \Carbon\Carbon::parse($request->input('dob2'))->format('Y-m-d'),
            'organization_id' => $request->input('organization'),
            'capacity'     => $request->input('amount'),
            'user_id'      => Auth::User()->id,
            'director_id' => 1,
            'result' => $request->input('result'),
            'comment' => $request->input('data'),
        ]);

        \App\tbl_activities::create([
            'ip_adress'   => request()->ip(),
            'user_id'     => $user->id,
            'action_id'   => $storage->id,
            'action_type' => 'storage_add',
            'action'      => "Sig'im xulosasi qo'shildi",
            'time'        => now(),
        ]);

        return redirect()->route('storage-conclusion.add_result',$storage->id)->with('message', 'Successfully Submitted');
    }

    public function addResult($id)
    {
        $app = StorageCapacityConclusion::findOrFail($id);
        $stateId = optional(optional($app->organization)->city)->state_id;
        $types = StorageConclusionFiles::getType();
        $states = Region::all();

        return view('storage_conclusion.add_result',compact('id','types','states','stateId'));

    }
    public function ResultStore(Request $request): \Illuminate\Http\RedirectResponse
    {
        $app = StorageCapacityConclusion::findOrFail($request->input('id'));
        $types = StorageConclusionFiles::getType();
        $data = [];
        foreach ($types as $key => $type) {
            $data[] = [
                'conclusion_id' => $app->id,
                'name' => $request->input('name'.$key),
                'type' => $key,
                'state_id' => $request->input('state_id'.$key),
                'date' => \Carbon\Carbon::parse($request->input('dob'.$key))->format('Y-m-d'),
                'number' => $request->input('number'.$key),
            ];
        }

        // Insert data if not empty
        if (!empty($data)) {
            StorageConclusionFiles::insert($data);
        }
        return redirect()->route('/storage-conclusion/list')
            ->with('message', 'Successfully Submitted');
    }

    public function edit($id)
    {
        $data = StorageCapacityConclusion::findOrFail($id);
        return view('storage_conclusion.edit', compact('data'));
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

    public function showapplication($id)
    {
        $test = StorageCapacityConclusion::with('organization')->findOrFail($id);

        $givenDate = formatUzbekDateInLatin($test->given_date);
        $validDate = formatUzbekDateInLatin($test->valid_date);


        // Generate QR code
        $url = route('sifat_sertificate.view', $id);
        $qrCode = QrCode::size(100)->generate($url);
        $t = 1;

        return view('storage_conclusion.show', compact('test','givenDate','validDate', 'qrCode','t'));
    }
    //accept online applications
    public function accept($id)
    {
        $test = StorageCapacityConclusion::with('organization')->findOrFail($id);

        $givenDate = formatUzbekDateInLatin($test->given_date);
        $validDate = formatUzbekDateInLatin($test->valid_date);


//        get max  number of sertificate
        $number = StorageCapacityConclusion::max('number');


        // create sifat certificate
        if (!$test->status != StorageCapacityConclusion::STATUS_FINISHED) {
            $test->number = $number + 1;
            $test->status = StorageCapacityConclusion::STATUS_FINISHED;
            $test->save();
        }

        // Generate QR code
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate(route('storage_conclusion.download', $id)));

        // Load the view and pass data to it
        $pdf = Pdf::loadView('storage_conclusion.pdf', compact('test','givenDate','validDate', 'qrCode'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'DejaVu Sans');

       return $pdf->stream('sdf');
        // Save the PDF file
        $filePath = storage_path('app/public/storage_conclusion/conclusion_' . $id . '.pdf');
        $pdf->save($filePath);

        // Redirect to list page with success message
        return redirect()->route('/storage-conclusion/list', ['generatedAppId' => $id])
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

