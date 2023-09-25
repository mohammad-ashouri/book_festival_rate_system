<?php

namespace App\Http\Controllers;

use App\Models\RateInfo;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function setSummaryRater(Request $request)
    {
        $rater=(integer)$request->username;
        $PostID=(integer)$request->PostID;
        switch ($request->work){
            case 'ChangeRater1Group1':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej2g1rater==$rater or $rateInfo->ej3g1rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej1g1rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater1 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 'ChangeRater2Group1':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej1g1rater==$rater or $rateInfo->ej3g1rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej2g1rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater2 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 'ChangeRater3Group1':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej1g1rater==$rater or $rateInfo->ej2g1rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej3g1rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater3 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 'ChangeRater1Group2':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej2g2rater==$rater or $rateInfo->ej3g2rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej1g2rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater1 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 'ChangeRater2Group2':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej1g2rater==$rater or $rateInfo->ej3g2rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej2g2rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater2 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 'ChangeRater3Group2':
                $rateInfo=RateInfo::where('post_id',$PostID)->first();
                if($rateInfo->ej1g2rater==$rater or $rateInfo->ej2g2rater==$rater){
                    return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                }
                $rateInfo->ej3g2rater=$rater;
                $rateInfo->save();
                $this->logActivity('Rater3 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;

        }
    }
    public function summaryAssessmentIndex()
    {
        return view('SummaryAssessmentAdmin', ['summaries' => RateInfo::where('rate_status', 'Summary')->paginate(10)]);
    }
}
