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
                $rateInfo = RateInfo::with('postInfo')->where('rate_status', 'Summary')->where('id', $id)
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
                if ($rateInfo->count() > 0) {
                    return view('RatePages.index', compact('rateInfo'));
                }
                abort(403);
        }
    }

    public function setSummaryRate(Request $request)
    {
        $rate_info_id = $request->input('rateInfoID');
        $rateType = $request->input('rateType');
        $special_section = $request->input('special_section');
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
        $summaryRate->r1 = $r1;
        $summaryRate->r2 = $r2;
        $summaryRate->r3 = $r3;
        $summaryRate->r4 = $r4;
        $sum = $r1 + $r2 + $r3 + $r4;
        $summaryRate->sum = $sum;
        $summaryRate->special_section = $special_section;
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
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S1G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's2g1':
                $rateInfo->s2g1_status = 1;
                if ($rateInfo->s1g1_status == 1 and $rateInfo->s3g1_status == 1) {
                    $summaryS1G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g1')->first();
                    $summaryS3G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS1G1->sum + $summaryS3G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S2G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's3g1':
//                $rateInfo->s3g1_status = 1;
                if ($rateInfo->s1g1_status == 1 and $rateInfo->s2g1_status == 1) {
                    $summaryS1G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g1')->first();
                    $summaryS2G1 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS1G1->sum + $summaryS2G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S3G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's1g2':
                $rateInfo->s1g2_status = 1;
                if ($rateInfo->s2g2_status == 1 and $rateInfo->s3g2_status == 1) {
                    $summaryS2G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g2')->first();
                    $summaryS3G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS2G2->sum + $summaryS3G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S1G2 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's2g2':
                $rateInfo->s2g2_status = 1;
                if ($rateInfo->s1g2_status == 1 and $rateInfo->s3g2_status == 1) {
                    $summaryS1G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g2')->first();
                    $summaryS3G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS1G2->sum + $summaryS3G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S2G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's3g2':
                $rateInfo->s3g2_status = 1;
                if ($rateInfo->s1g2_status == 1 and $rateInfo->s2g2_status == 1) {
                    $summaryS1G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g2')->first();
                    $summaryS2G2 = SummaryRates::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS1G2->sum + $summaryS2G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                            $rateInfo->rate_status = 'Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S3G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
        }
        $rateInfo->save();
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);
    }
}
