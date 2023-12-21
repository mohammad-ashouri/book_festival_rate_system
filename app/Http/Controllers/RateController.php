<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RateInfo;
use App\Models\Rates\DetailedRate;
use App\Models\Rates\FormalLiteraryRate;
use App\Models\Rates\SummaryRate;
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
            case 2:
                return view('Panels.Dashboards.Admin');
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
                    $assessmentStatus = 'Summary';
                    return view('RatePages.index', compact('rateInfo', 'assessmentStatus'));
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

        $summaryRate = new SummaryRate();
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
                    $summaryS2G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g1')->first();
                    $summaryS3G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS2G1->sum + $summaryS3G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
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
                    $summaryS1G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g1')->first();
                    $summaryS3G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS1G1->sum + $summaryS3G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    }
                }
                $this->logActivity('S2G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's3g1':
                $rateInfo->s3g1_status = 1;
                if ($rateInfo->s1g1_status == 1 and $rateInfo->s2g1_status == 1) {
                    $summaryS1G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g1')->first();
                    $summaryS2G1 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g1')->first();
                    $rateInfo->avg_sg1 = $sum + $summaryS1G1->sum + $summaryS2G1->sum;
                    if ($rateInfo->postInfo->scientific_group_v2 != null and $rateInfo->avg_sg2 != null) {
                        if ($rateInfo->avg_sg2 >= 34 or $rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
                        } else {
                            $rateInfo->rate_status = 'RejectedSummary';
                        }
                    } elseif ($rateInfo->postInfo->scientific_group_v2 == null) {
                        if ($rateInfo->avg_sg1 >= 34) {
                            $rateInfo->rate_status = 'Pre Detailed';
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
                    $summaryS2G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g2')->first();
                    $summaryS3G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS2G2->sum + $summaryS3G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 != null) {
                            if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                                $rateInfo->rate_status = 'Pre Detailed';
                            } else {
                                $rateInfo->rate_status = 'RejectedSummary';
                            }
                        }
                    }
                }
                $this->logActivity('S1G2 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's2g2':
                $rateInfo->s2g2_status = 1;
                if ($rateInfo->s1g2_status == 1 and $rateInfo->s3g2_status == 1) {
                    $summaryS1G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g2')->first();
                    $summaryS3G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's3g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS1G2->sum + $summaryS3G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 != null) {
                            if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                                $rateInfo->rate_status = 'Pre Detailed';
                            } else {
                                $rateInfo->rate_status = 'RejectedSummary';
                            }
                        }
                    }
                }
                $this->logActivity('S2G1 Rate Successfully Submitted =>' . $rateInfo->id, \request()->ip(), \request()->userAgent(), \session('id'));
                break;
            case 's3g2':
                $rateInfo->s3g2_status = 1;
                if ($rateInfo->s1g2_status == 1 and $rateInfo->s2g2_status == 1) {
                    $summaryS1G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's1g2')->first();
                    $summaryS2G2 = SummaryRate::where('rate_info_id', $rate_info_id)->where('rate_type', 's2g2')->first();
                    $rateInfo->avg_sg2 = $sum + $summaryS1G2->sum + $summaryS2G2->sum;
                    if ($rateInfo->postInfo->scientific_group_v1 != null and $rateInfo->avg_sg1 != null) {
                        if ($rateInfo->avg_sg1 != null) {
                            if ($rateInfo->avg_sg1 >= 34 or $rateInfo->avg_sg2 >= 34) {
                                $rateInfo->rate_status = 'Pre Detailed';
                            } else {
                                $rateInfo->rate_status = 'RejectedSummary';
                            }
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

    public function formalLiteraryIndex($id)
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
                $rateInfo = RateInfo::with('postInfo')->where('rate_status', 'Formal literary')->where('id', $id)
                    ->where('formal_literary_rater', session('id'))
                    ->first();
                if ($rateInfo->count() > 0) {
                    $assessmentStatus = 'Formal literary';
                    return view('RatePages.index', compact('rateInfo', 'assessmentStatus'));
                }
                abort(403);
        }
    }

    public function setFormalLiteraryRate(Request $request)
    {
        $sum = 0;
        $inputData = $request->all();
        $formalLiteraryForm = new FormalLiteraryRate();
        $formalLiteraryForm->rate_info_id = $request->input('rateInfoID');
        $formalLiteraryForm->rater = session('id');
        $formalLiteraryForm->points_info = json_encode($inputData);

        $keysWithPoints = array_filter(array_keys($inputData), function ($key) {
            return strpos($key, 'point') !== false;
        });
        foreach ($keysWithPoints as $keys) {
            $sum = $request->input($keys) + $sum;
        }
        $formalLiteraryForm->sum = $sum / 10;
        $formalLiteraryForm->save();

        $rateInfo = RateInfo::with('postInfo')->find($formalLiteraryForm->rate_info_id);
        $postInfo = Post::with('personInfo')->find($rateInfo->post_id);
        $detailed1 = DetailedRate::where('rate_info_id', $formalLiteraryForm->rate_info_id)->where('rate_type', 'd1')->pluck('sum')->first();
        $detailed2 = DetailedRate::where('rate_info_id', $formalLiteraryForm->rate_info_id)->where('rate_type', 'd2')->pluck('sum')->first();
        $sumDetailed = $detailed1 + $detailed2 + $sum;
        switch ($postInfo->personInfo->gender) {
            case 'مرد':
                if ($sumDetailed >= 75) {
                    $rateInfo->rate_status = 'Detailed';
                } else {
                    $rateInfo->rate_status = 'Detailed rejected';
                }
                break;
            case 'زن':
                if ($sumDetailed >= 70) {
                    $rateInfo->rate_status = 'Detailed';
                } else {
                    $rateInfo->rate_status = 'Detailed rejected';
                }
                break;
            default:
                abort(403);
        }
        $rateInfo->save();
        $this->logActivity('Formal literary rate set', \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->postInfo->post_id);
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);
    }

    public function detailedIndex($id)
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
                $rateInfo = RateInfo::with('postInfo')->where('rate_status', 'Detailed')->where('id', $id)
                    ->where(function ($query) {
                        $query->where(function ($subquery) {
                            $subquery
                                ->where('d1rater', session('id'))
                                ->where('d1_status', 0);
                        })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('d2rater', session('id'))
                                    ->where('d2_status', 0);
                            })
                            ->orWhere(function ($subquery) {
                                $subquery
                                    ->where('d3rater', session('id'))
                                    ->where('d3_status', 0);
                            });
                    })
                    ->first();
                if ($rateInfo->count() > 0) {
                    $assessmentStatus = 'Detailed';
                    $specialSections = \App\Models\Catalogs\SpecialSection::where('active', 1)->orderBy('name', 'asc')->get();
                    return view('RatePages.index', compact('rateInfo', 'assessmentStatus', 'specialSections'));
                }
                abort(403);
        }
    }

    public function setDetailedRate(Request $request)
    {
        $sum = 0;
        $inputData = $request->all();
        $detailedForm = new DetailedRate();
        $detailedForm->rate_info_id = $request->input('rateInfoID');
        $detailedForm->rate_type = $request->input('rateType');
        $detailedForm->rater = session('id');
        $detailedForm->points_info = json_encode($inputData);
        $detailedForm->special_section = implode('|', $request->input('special_section'));

        $keysWithPoints = array_filter(array_keys($inputData), function ($key) {
            return strpos($key, 'point') !== false;
        });
        foreach ($keysWithPoints as $keys) {
            $sum = $request->input($keys) + $sum;
        }
        $detailedForm->sum = $sum;

        $rateInfo = RateInfo::find($detailedForm->rate_info_id);
        switch ($rateInfo->postInfo->personInfo->gender) {
            case 'مرد':
                $maxPoint = 75;
                break;
            case 'زن':
                $maxPoint = 70;
                break;
        }
        switch ($detailedForm->rate_type) {
            case 'd1':
                $rateInfo->d1_status = 1;
                if ($rateInfo->d2_status == 1) {
                    $detailedRate2 = DetailedRate::where('rate_type', 'd2')->pluck('sum')->first();
                    $avg = ($sum + $detailedRate2) / 2;
                    switch ($rateInfo->d_form_type) {
                        case 'تصحیح و تحقیق':
                        case 'پایان نامه':
                        case 'کتابشناسی و فهرست نگاری':
                        case 'داستان جوان':
                        case 'ادبیات کودک و نوجوان':
                        case 'ترجمه':
                            switch ($rateInfo->postInfo->personInfo->gender) {
                                case 'مرد':
                                    $maxPoint = 75;
                                    break;
                                case 'زن':
                                    $maxPoint = 70;
                                    break;
                            }
                            if ($avg >= $maxPoint) {
                                $status = 'Detailed';
                            } else {
                                $status = 'Detailed rejected';
                            }
                            break;
                        default:
                            if ($avg >= 64) {
                                $status = 'Formal literary';
                            } else {
                                $status = 'Detailed rejected';
                            }
                    }
                }
                break;
            case 'd2':
                $rateInfo->d2_status = 1;
                if ($rateInfo->d1_status == 1) {
                    $detailedRate1 = DetailedRate::where('rate_type', 'd1')->pluck('sum')->first();
                    $avg = ($sum + $detailedRate1) / 2;
                    switch ($rateInfo->d_form_type) {
                        case 'تصحیح و تحقیق':
                        case 'پایان نامه':
                        case 'کتابشناسی و فهرست نگاری':
                        case 'داستان جوان':
                        case 'ادبیات کودک و نوجوان':
                        case 'ترجمه':
                            switch ($rateInfo->postInfo->personInfo->gender) {
                                case 'مرد':
                                    $maxPoint = 75;
                                    break;
                                case 'زن':
                                    $maxPoint = 70;
                                    break;
                            }
                            if ($avg >= $maxPoint) {
                                $status = 'Detailed';
                            } else {
                                $status = 'Detailed rejected';
                            }
                            break;
                        default:
                            if ($avg >= 64) {
                                $status = 'Formal literary';
                            } else {
                                $status = 'Detailed rejected';
                            }
                    }
                }
                break;
            case 'd3':
                $rateInfo->d3_status = 1;
                $detailedRate1 = DetailedRate::where('rate_type', 'd1')->pluck('sum')->first();
                $detailedRate2 = DetailedRate::where('rate_type', 'd2')->pluck('sum')->first();
                if ($detailedRate1 >= $maxPoint and $detailedRate2 >= $maxPoint and $sum >= $maxPoint) {
                    $finalAVG = ($sum + $detailedRate1 + $detailedRate2) / 3;
                } elseif ((abs($sum - $detailedRate1) >= 12) and (abs($sum - $detailedRate2) >= 12) and (abs($detailedRate1 - $detailedRate2) >= 12)) {
                    $finalAVG = ($sum + $detailedRate1 + $detailedRate2) / 3;
                } elseif ((abs($sum - $detailedRate1) >= 12) or (abs($sum - $detailedRate2) >= 12)) {
                    $difference3v1 = abs($sum - $detailedRate1);
                    $difference3v2 = abs($sum - $detailedRate2);
                    $difference1v2 = abs($detailedRate1 - $detailedRate2);
                    if ($difference1v2 < 12 and ($detailedRate1 + $detailedRate2 / 2) >= $maxPoint) {
                        $finalAVG = ($detailedRate1 + $detailedRate2) / 2;
                    } else {
                        if ($difference3v1 > $difference3v2) {
                            $finalAVG = ($sum + $detailedRate2) / 2;
                        } elseif ($difference3v1 < $difference3v2) {
                            $finalAVG = ($sum + $detailedRate1) / 2;
                        } elseif ($difference3v1 == $difference3v2) {
                            $finalAVG = ($sum + $detailedRate1) / 2;
                        }
                    }
                } elseif ((abs($sum - $detailedRate1) < 12) or (abs($sum - $detailedRate2) < 12)) {
                    $finalAVG = ($sum + $detailedRate1 + $detailedRate2) / 3;
                }

                switch ($rateInfo->d_form_type) {
                    case 'پایان نامه':
                    case 'ترجمه':
                    case 'تصحیح و تحقیق':
                    case 'کتابشناسی و فهرست نگاری':
                    case 'داستان جوان':
                    case 'ادبیات کودک و نوجوان':
                        if ($finalAVG >= $maxPoint) {
                            $status = 'Committee';
                            $rateInfo->grade = $finalAVG;
                        } elseif ($finalAVG < $maxPoint) {
                            $status = 'Detailed rejected';
                        }
                        break;
                    default:
                        $status = 'Formal literary';
                }
                break;
        }
        $rateInfo->rate_status = $status;
        $rateInfo->save();
        $detailedForm->save();
        $this->logActivity('Detailed rate set', \request()->ip(), \request()->userAgent(), \session('id'), $rateInfo->postInfo->post_id);
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);
    }
}
