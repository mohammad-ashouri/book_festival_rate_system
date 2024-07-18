<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\DeliveryReportComment;
use App\Models\DeliveryStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use Mpdf\Tag\P;

class DeliveryReportController extends Controller
{
    public function index()
    {
        return view('Reports.DeliveryStatus');
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'PostID' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->alerts(false, 'nullID', 'کد اثر وارد نشده است.');
        }
        $postID = $request->input('PostID');
        $postInfo = Post::find($postID);
        if (!$postInfo) {
            return $this->alerts(false, 'wrongID', 'کد اثر پیدا نشد!');
        }
        if ($postInfo->post_delivery_method == 'digital') {
            return $this->alerts(false, 'digitalPost', 'اثر به صورت دیجیتال می باشد!');
        }
        $raters = User::whereIn('type', [3, 4])->orderBy('family', 'asc')->get();
        $deliveryStatusInfo = DeliveryStatus::where('post_id', $postID)->with('postInfo')->orderBy('id', 'desc')->get();
        return view('Reports.DeliveryStatus', compact('deliveryStatusInfo', 'raters'));
    }

    public function new(Request $request)
    {
        if (!$request->input('rater')) {
            return $this->alerts(false, 'wrongRater', 'ارزیاب انتخاب نشده است!');
        }
        $rater = User::find($request->input('rater'));
        if (!$rater) {
            return $this->alerts(false, 'wrongRaterID', 'ارزیاب پیدا نشد!');
        }
        $postID = Post::find($request->input('PostID'));
        if (!$postID) {
            return $this->alerts(false, 'wrongPostID', 'اثر پیدا نشد!');
        }
        $checkStatus = DeliveryStatus::where('rater_id', $rater->id)->where('post_id', $postID->id)->first();
        if ($checkStatus) {
            return $this->alerts(false, 'duplicateStatus', 'این اثر برای ارزیاب انتخاب شده ارسال شده است!');
        }
        $status = new DeliveryStatus();
        $status->post_id = $postID->id;
        $status->rater_id = $rater->id;
        $status->registrar = session('id');
        $status->save();
        return $this->success(200, 'statusSet', 'به ارزیاب ارسال شد!');

    }

    public function edit()
    {

    }

    public function delete()
    {

    }

    public function newComment(Request $request)
    {
        $statusID = $request->input('StatusID');
        if (!$statusID) {
            return $this->alerts(false, 'nullStatusID', 'کد وضعیت خالی می باشد!');
        }
        $statusID = DeliveryStatus::find($statusID);
        if (!$statusID) {
            return $this->alerts(false, 'wrongStatusID', 'کد وضعیت نامعتبر می باشد!');
        }
        $description = $request->input('description');
        if (!$description) {
            return $this->alerts(false, 'wrongDescription', 'توضیحات ثبت نشده است!');
        }
        $comment = new DeliveryReportComment();
        $comment->status_id = $statusID->id;
        $comment->description = $description;
        $comment->jalali_date = Jalalian::fromDateTime(now())->format('H:i:s Y/m/d');
        $comment->registrar = session('id');
        $comment->save();
        return $this->success(200, 'deliveryCommentSet', 'توضیحات تنظیم شد!');
    }

    public function getComments(Request $request)
    {
        $statusID = $request->input('StatusID');
        if (!$statusID) {
            return $this->alerts(false, 'nullStatusID', 'کد وضعیت خالی می باشد!');
        }
        $comments = DeliveryReportComment::with('registrarInfo')->with('statusInfo')->where('status_id',$statusID)->get();
        return response()->json(['comments' => $comments]);
    }
}
