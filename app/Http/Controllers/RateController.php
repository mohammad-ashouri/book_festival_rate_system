<?php

namespace App\Http\Controllers;

use App\Models\RateInfo;
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
                $summaryRate = RateInfo::where('rate_status', 'Summary')->where('id',$id)->with('postInfo')
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
                    return view('RatePages.index',compact('summaryRate'));
                }
                abort(403);
        }
    }
}
