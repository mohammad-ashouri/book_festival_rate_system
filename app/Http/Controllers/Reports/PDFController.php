<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Festival;
use App\Models\EquipmentLog;
use App\Models\Person;
use App\Models\Post;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $message = null;
        switch ($request->input('work')) {
            case 'GetAllClassifications':
                $lastFestival=Festival::where('active',1)->first();
                $nonClassificatedPosts = Post::with('personInfo')->with('languageInfo')->with('personInfo')->with('sorterInfo')->with('scientificGroup1Info')->with('scientificGroup2Info')->where('sorted', 0)->where('festival_id', $lastFestival->id)->get();
                $pdf = Pdf::loadView('Reports.PDFReportPages.AllClassifications', compact('nonClassificatedPosts','lastFestival'));
                return $pdf->stream(1 . '.pdf');
                break;
        }
    }

}
