<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Festival;
use App\Models\Post;
use Illuminate\Http\Request;

class AssessmentsReport extends Controller
{
    public function allAssessmentReportIndex()
    {
        $festivals=Festival::orderBy('id','asc')->get();
        return view('Reports.AssessmentsStatus',compact('festivals'));
    }

    public function reportAssessments(Request $request)
    {
        $festival_id=$request->input('festival');
        $festivalCheck=Festival::find($festival_id);
        if ($festivalCheck) {
            $posts = Post::where('festival_id', $request->input('festival'))->orderBy('id','asc')->get();
            $festivals=Festival::orderBy('id','asc')->get();
            return view('Reports.AssessmentsStatus',compact('posts','festivals'));
        }
        abort(403);
    }
}
