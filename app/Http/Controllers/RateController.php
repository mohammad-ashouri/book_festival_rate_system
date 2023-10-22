<?php

namespace App\Http\Controllers;

use App\Models\RateInfo;
use App\Models\Rates\SummaryRates;
use App\Models\User;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function summaryIndex($id)
    {
        $userInfo = User::find(session('id'));
        switch ($userInfo->type) {
            case 1:
                return view('Panels.Dashboards.SuperAdmin');
                break;
            case 2:
                return view('Panels.Dashboards.Admin');
                break;
            case 3:
            case 4:
                $summaryRate = RateInfo::where('rate_status', 'Summary')->where('id', $id)->with('postInfo')
                    ->where(function ($query) {
                        $query->where(function ($subquery) {
                            $subquery
                                ->where('s1g1rater', session('id'))
                                ->where('s1g1_status', 0);
                        })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('s2g1rater', session('id'))
                                    ->where('s2g1_status', 0);
                            })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('s3g1rater', session('id'))
                                    ->where('s3g1_status', 0);
                            })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('s1g2rater', session('id'))
                                    ->where('s1g2_status', 0);
                            })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('s2g2rater', session('id'))
                                    ->where('s2g2_status', 0);
                            })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('s3g2rater', session('id'))
                                    ->where('s3g2_status', 0);
                            });
                    })
                    ->first();
                if ($summaryRate->count() > 0) {
                    return view('RatePages.index', compact('summaryRate'));
                }
                abort(403);
        }
    }

    public function setSummaryRate(Request $request)
    {
        $rate_info_id = $request->input('rateInfoID');
        $type = $request->input('type');
        $rateType = $request->input('rateType');
        $connectionWithGroup = $request->input('connectionWithGroup');
        $r1 = $request->input('r1');
        $r2 = $request->input('r2');
        $r3 = $request->input('r3');
        $r4 = $request->input('r4');
        if (!$rate_info_id) {
            return $this->alerts(false, 'nullID', 'کد اثر وارد نشده است.');
        }
        if (!$r4) {
            $r4 = 0;
        }

        $summaryRate = new SummaryRates();
        $summaryRate->rate_info_id = $rate_info_id;
        $summaryRate->post_type = $type;
        $summaryRate->connection_with_group = $connectionWithGroup;
        $summaryRate->r1 = $r1;
        $summaryRate->r2 = $r2;
        $summaryRate->r3 = $r3;
        $summaryRate->r4 = $r4;
        $sum = $r1 + $r2 + $r3 + $r4;
        $summaryRate->sum = $sum;
        $summaryRate->rate_type = $rateType;
        $summaryRate->rater = session('id');
        $summaryRate->save();

        $rateInfo = RateInfo::with('postInfo')->find($rate_info_id);
        switch ($rateType) {
            case 's1g1':
                $rateInfo->s1g1_status = 1;
                if ($rateInfo->s2g1_status == 1 and $rateInfo->s3g1_status == 1) {
                    $summaryS2G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g1')->first();
                    $summaryS3G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS2G1->sum + $summaryS3G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $sum >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($sum >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
            case 's2g1':
            case 's3g1':

        }
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);
    }
}
