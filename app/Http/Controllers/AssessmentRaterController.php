<?php

namespace App\Http\Controllers;

use App\Models\Catalogs\ScientificGroup;
use App\Models\HeaderComment;
use App\Models\Post;
use App\Models\RateInfo;
use App\Models\User;
use Illuminate\Http\Request;

class AssessmentRaterController extends Controller
{
    public function headerApprovalIndex()
    {
        $userType = User::find(session('id'));
        switch ($userType->type) {
            case 1:
                $approvals = RateInfo::with('postInfo')->where('rate_status', 'Summary')->where('sg1_form_type', 'Waiting For Header')->orWhere('sg2_form_type', 'Waiting For Header')->paginate(10);
                break;
            case 3:
                $approvals = RateInfo::with('postInfo')
                    ->where('rate_status', 'Summary')
                    ->where(function ($query) {
                        $query->where('sg1_form_type', 'Waiting For Header')
                            ->whereHas('postInfo', function ($subQuery) {
                                $userType = User::find(session('id'));
                                $subQuery->where('scientific_group_v1', $userType->scientific_group);
                            });
                    })
                    ->orWhere(function ($query) {
                        $query->where('sg2_form_type', 'Waiting For Header')
                            ->whereHas('postInfo', function ($subQuery) {
                                $userType = User::find(session('id'));
                                $subQuery->where('scientific_group_v2', $userType->scientific_group);
                            });
                    })
                    ->paginate(10);
                break;
        }
        $userType = $userType->type;
        return view('AssessmentFormApproval.HeaderApproval', compact('approvals', 'userType'));

    }

    public function headerApprove(Request $request)
    {
        $rateInfo = RateInfo::with('postInfo')->find($request->input('id'));
        $userInfo = User::find(session('id'));
        $headerComment = new HeaderComment();
        $headerComment->header_id = session('id');
        if (!$request->input('relation_with_summary_group')) {
            return $this->alerts(false, 'nullRelation', 'ارتباط اثر با گروه حاضر انتخاب نشده است.');
        }
        switch ($request->input('relation_with_summary_group')) {
            case 'اثر مربوط به گروه حاضر است':
                if (!$request->input('summary_form_type')) {
                    return $this->alerts(false, 'nullFormType', 'نوع اثر انتخاب نشده است.');
                }
                if ($userInfo->scientific_group === $rateInfo->postInfo->scientific_group_v1) {
                    $rateInfo->sg1_form_type = $request->input('summary_form_type');
                    $scientificGroup = 'SG1';
                } elseif ($userInfo->scientific_group === $rateInfo->postInfo->scientific_group_v2) {
                    $rateInfo->sg2_form_type = $request->input('summary_form_type');
                    $scientificGroup = 'SG2';
                }
                $rateInfo->save();
                $headerComment->body = json_encode([$rateInfo->id, $scientificGroup, $request->input('relation_with_summary_group'), $request->input('summary_form_type')]);
                break;
            case 'اثر میان رشته ای است':
                $scientificGroupInfo = ScientificGroup::find($request->input('scientific_group'));
                switch ($scientificGroupInfo->name) {
                    case 'ترجمه':
                    case 'تصحیح و تحقیق':
                    case 'کتب مرجع':
                        return $this->alerts(false, 'wrongGroup', 'گروه دوم این اثر نمی تواند ' . $scientificGroupInfo->name . ' باشد.');
                    default:
                        if (!$request->input('scientific_group')) {
                            return $this->alerts(false, 'nullScientificGroup', 'گروه علمی انتخاب نشده است.');
                        }
                        if (!$request->input('summary_form_type')) {
                            return $this->alerts(false, 'nullFormType', 'نوع اثر انتخاب نشده است.');
                        }
                        $postInfo = Post::find($rateInfo->postInfo->id);
                        if ($postInfo->scientific_group_v2 === null) {
                            $postInfo->scientific_group_v2 = $request->input('scientific_group');
                            $rateInfo->sg1_form_type = $request->input('summary_form_type');
                            $rateInfo->sg2_form_type = 'Waiting For Header';
                            $postInfo->save();
                            $rateInfo->save();
                        }
                        $headerComment->body = json_encode([$rateInfo->id, "The work is interdisciplinary", $request->input('relation_with_summary_group'), $request->input('scientific_group')]);
                }
                break;
            case 'اثر مربوط به گروه حاضر نیست':
                if (!$request->input('scientific_group')) {
                    return $this->alerts(false, 'nullScientificGroup', 'گروه علمی انتخاب نشده است.');
                }
                $chosenScientificGroup=(int)$request->input('scientific_group');
                $postInfo = Post::find($rateInfo->postInfo->id);
                if ($postInfo->scientific_group_v1 != null and $postInfo->scientific_group_v2 != null) {
                    if ($chosenScientificGroup == $postInfo->scientific_group_v1 or $chosenScientificGroup == $postInfo->scientific_group_v2) {
                        return $this->alerts(false, 'dupScientificGroup', 'گروه علمی انتخاب شده با یکی از گروه ها برابر می باشد.');
                    } else {
                        if ($userInfo->scientific_group === $postInfo->scientific_group_v1) {
                            $postInfo->scientific_group_v1 = $chosenScientificGroup;
                        } elseif ($userInfo->scientific_group === $postInfo->scientific_group_v2) {
                            $scientificGroupInfo = ScientificGroup::find($chosenScientificGroup);
                            switch ($scientificGroupInfo->name) {
                                case 'ترجمه':
                                case 'تصحیح و تحقیق':
                                case 'کتب مرجع':
                                    return $this->alerts(false, 'wrongGroup', 'گروه دوم این اثر نمی تواند ' . $scientificGroupInfo->name . ' باشد.');
                                default:
                                    $postInfo->scientific_group_v2 = $chosenScientificGroup;
                            }
                        }
                    }
                } elseif ($postInfo->scientific_group_v2 === null) {
                    $postInfo->scientific_group_v1 = $chosenScientificGroup;
                }
                $headerComment->body = json_encode([$rateInfo->id, "The work related to the group is not present", $request->input('relation_with_summary_group'), $request->input('scientific_group')]);
                $postInfo->save();
                $rateInfo->save();
                break;
        }
        $this->logActivity('Summary Assessment Approval Done', \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->post_id);
        $headerComment->save();
    }

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
                    $this->logActivity('Rater1 Group1 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
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
                    $this->logActivity('Rater2 Group1 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
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
                    $this->logActivity('Rater3 Group1 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
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
                    $this->logActivity('Rater1 Group2 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
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
                    $this->logActivity('Rater2 Group2 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
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
                    $this->logActivity('Rater3 Group2 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $PostID);
                    break;
            }
        }
    }

    public function summaryAssessmentIndex()
    {
        $summaries = RateInfo::with('postInfo')
            ->where('rate_status', 'Summary')
            ->where(function ($query) {
                $query->whereNull('sg2_form_type')
                    ->where('sg1_form_type', '!=', 'Waiting For Header');
            })
            ->orWhere(function ($query) {
                $query->whereNotNull('sg2_form_type')
                    ->where('sg1_form_type', '!=', 'Waiting For Header')
                    ->where('sg2_form_type', '!=', 'Waiting For Header');
            })
            ->paginate(20);
        return view('SummaryAssessmentAdmin', compact('summaries'));
    }

    public function detailedAssessmentFormApprovalIndex()
    {
        $detailedAssessments = RateInfo::where('rate_status', 'Pre Detailed')->where('d_form_type', 'Waiting For Admin')->with('postInfo')->get();
        return view('AssessmentFormApproval.DetailedAssessmentFormApproval', compact('detailedAssessments'));
    }

    public function detailedAssessmentFormApproval(Request $request)
    {
        $postID = $request->input('PostID');
        $form = $request->input('Form');
        if (!$postID) {
            return $this->alerts(false, 'NullPostID', 'کد اثر انتخاب نشده است.');
        }
        if (!$form) {
            return $this->alerts(false, 'NullForm', 'فرم انتخاب نشده است.');
        }
        $rateInfo = RateInfo::find($postID);
        $rateInfo->d_form_type = $form;
        $rateInfo->rate_status = 'Detailed';
        if ($rateInfo->save()) {
            $this->logActivity('Detailed Form Set =>' . $form . ' For Post By ID => ' . $postID, \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->post_id);
        } else {
            return $this->alerts(false, 'Error', 'خطای ناشناخته.');
        }
    }

    public function setDetailedRater(Request $request)
    {
        $rater = (integer)$request->username;
        $PostID = (integer)$request->PostID;
        if ($request->work) {
            switch ($request->work) {
                case 'ChangeRater1':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->d2rater == $rater and $rateInfo->d2rater != null) or ($rateInfo->d3rater == $rater and $rateInfo->d3rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->d1rater = $rater;
                    $rateInfo->d1_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Detailed Rater1 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->post_id);
                    break;
                case 'ChangeRater2':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->d1rater == $rater and $rateInfo->d1rater != null) or ($rateInfo->d3rater == $rater and $rateInfo->d3rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->d2rater = $rater;
                    $rateInfo->d2_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Detailed Rater2 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->post_id);
                    break;
                case 'ChangeRater3':
                    $rateInfo = RateInfo::where('post_id', $PostID)->first();
                    if (($rateInfo->d1rater == $rater and $rateInfo->d1rater != null) or ($rateInfo->d2rater == $rater and $rateInfo->d2rater != null)) {
                        return $this->alerts(false, 'UsersAreEqual', 'ارزیابان نمی توانند با هم برابر باشند.');
                    }
                    if (!$rater) {
                        $rater = null;
                    }
                    $rateInfo->d3rater = $rater;
                    $rateInfo->d3_rater_set_date = now();
                    $rateInfo->save();
                    $this->logActivity('Detailed Rater3 Changed =>' . $rater, \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->post_id);
                    break;
            }
        }
    }

    public function detailedAssessmentIndex()
    {
        $detailed = RateInfo::with('postInfo')->where('rate_status', 'Detailed')->paginate(10);
        return view('DetailedAssessmentAdmin', compact('detailed'));
    }
}
