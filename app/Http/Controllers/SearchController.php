<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $work = $request->input('work');
        switch ($work) {
            case 'UserManagerSearch':
                $username = $request->input('username');
                $type = $request->input('type');
                $search = User::query();
                if ($username && $type) {
                    $search->where('username', 'LIKE', '%' . $username . '%')
                        ->where(function ($query) use ($type) {
                            $query->where('type', $type);
                        });
                    $this->logActivity('Search In User Manager With Username => ' . $username . ' And Type => ' . $type, request()->ip(), request()->userAgent(), session('id'));
                } elseif ($username) {
                    $search->where('username', 'LIKE', '%' . $username . '%');
                    $this->logActivity('Search In User Manager With Username => ' . $username, request()->ip(), request()->userAgent(), session('id'));
                } elseif ($type) {
                    $search->where(function ($query) use ($type) {
                        $query->where('type', $type);
                    });
                    $this->logActivity('Search In User Manager With Type => ' . $type, request()->ip(), request()->userAgent(), session('id'));
                }
                $result = $search->with('generalInformationInfo')->get();
                return response()->json($result);
                break;
            case 'ClassificationSearch':
                $title = $request->input('Title');
                $SG1 = $request->input('SG1');
                $SG2 = $request->input('SG2');
                $search = Post::query();
                if (!empty($title)) {
                    $search->where('title', 'LIKE', '%' . $title . '%');
                }
                if (!empty($SG1)) {
                    $search->where('scientific_group_v1', $SG1);
                }
                if (!empty($SG2)) {
                    $search->where('scientific_group_v2', $SG2);
                }
                $search->where('sorted', 0);
                $result = $search->get();
                $this->logActivity('Search In Classification With Title => ' . $title . ' And SG1 => ' . $SG1 . ' And SG2 => ' . $SG2, request()->ip(), request()->userAgent(), session('id'));
                return response()->json($result);

        }
    }
}
