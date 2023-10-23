<?php

namespace App\Http\Controllers;

use App\Models\RateInfo;
use App\Models\User;
use Illuminate\Http\Request;

class AssessmentRaterController extends Controller
{
    public function setSummaryRater(Request $request)
    {
        $rater = (integer)$request->username;
        $PostID = (integer)$request->PostID;
        if ($request->work) {
            switch ($request->work) {
                case 'ChangeRater1Group1':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s2g1rater == $rater and $rateInfo->s2g1rater != null) or ($rateInfo->s3g1rater == $rater and $rateInfo->s3g1rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s1g1rater = $rater;
                    $rateInfo->s1g1_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater1 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
                case 'ChangeRater2Group1':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s1g1rater == $rater and $rateInfo->s1g1rater != null) or ($rateInfo->s3g1rater == $rater and $rateInfo->s3g1rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s2g1rater = $rater;
                    $rateInfo->s2g1_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater2 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
                case 'ChangeRater3Group1':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s1g1rater == $rater and $rateInfo->s1g1rater != null) or ($rateInfo->s2g1rater == $rater and $rateInfo->s2g1rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s3g1rater = $rater;
                    $rateInfo->s3g1_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater3 Group1 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
                case 'ChangeRater1Group2':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s2g2rater == $rater and $rateInfo->s2g2rater != null) or ($rateInfo->s3g2rater == $rater and $rateInfo->s3g2rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s1g2rater = $rater;
                    $rateInfo->s1g2_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater1 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
                case 'ChangeRater2Group2':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s1g2rater == $rater and $rateInfo->s1g2rater != null) or ($rateInfo->s3g2rater == $rater and $rateInfo->s3g2rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s2g2rater = $rater;
                    $rateInfo->s2g2_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater2 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
                case 'ChangeRater3Group2':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->s1g2rater == $rater and $rateInfo->s1g2rater != null) or ($rateInfo->s2g2rater == $rater and $rateInfo->s2g2rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->s3g2rater = $rater;
                    $rateInfo->s3g2_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Rater3 Group2 Changed =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                    break;
            }
        }
    }

    public function headerApprovalIndex()
    {
        $userType=User::find(session('id'));
        switch ($userType->type){
            case 1:
                $approvals=RateInfo::with('postInfo')->where('rate_status', 'Summary')->where('sg1_form_type','Waiting For Header')->orWhere('sg2_form_type','Waiting For Header')->paginate(10);
                return view('HeaderApproval.HeaderApprovalAdmin', compact('approvals'));
                break;
            case 3:
                $approvals=RateInfo::with('postInfo')->where('rate_status', 'Summary')->where('sg1_form_type','Waiting For Header')->orWhere('sg2_form_type','Waiting For Header')->paginate(10);
                return view('HeaderApproval.HeaderApprovalAdmin', compact('approvals'));
                break;
        }
    }
    public function summaryAssessmentIndex()
    {
        $summaries=RateInfo::with('postInfo')->where('rate_status', 'Summary')->where('sg1_form_type','!=','Waiting For Header')->paginate(10);
        return view('SummaryAssessmentAdmin', compact('summaries'));
    }
}
