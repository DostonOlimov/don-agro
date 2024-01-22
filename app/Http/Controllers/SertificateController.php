<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CropData;
use App\Models\CropProductionType;
use App\Models\Decision;
use App\Models\FinalResult;
use App\Models\Indicator;
use App\Models\Laboratories;
use App\Models\Nds;
use App\Models\ProductionType;
use App\Models\Sertificate;
use App\Models\TestProgramIndicators;
use App\Models\TestPrograms;
use App\Services\AttachmentService;
use App\tbl_activities;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SertificateController extends Controller
{
    private $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }
    //search
    public function search()
    {
        $tests= Sertificate::orderBy('id','desc')->paginate(50);
        return view('sertificate.search', compact('tests'));
    }
    //list
    public function list()
    {
        $title = 'Normativ hujjatlar';
        $testss = Nds::with('crops')->orderBy('id')->get();
        return view('sertificate.list', compact('decisions','title'));
    }


    public function view($id)
    {
        $tests = FinalResult::find($id);
        return view('sertificate.show', [
            'result' => $tests,
        ]);
    }

}
