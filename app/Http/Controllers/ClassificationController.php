<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RateInfo;
use App\Models\SortingClassification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassificationController extends Controller
{
    public function showClassification()
    {
        $postList = Post::where('sorted', 0)->orderBy('festival_id', 'desc')->orderBy('title', 'asc')->paginate(50);
        $type = User::where('id', session('id'))->pluck('type')->first();
        return view('Classification', ['postList' => $postList, 'type' => $type]);
    }

    public function changeScientificGroup(Request $request)
    {
        $work = $request->input('work');
        $postID = $request->input('PostID');
        $me = User::find(session('id'));
        switch ($work) {
            case 'ChangeScientificGroup1':
                $newSG1 = $request->input('newSG1');
                $post = Post::find($postID);
                if ($post->scientific_group_v2==$newSG1){
                    return $this->alerts(false, 'sameWithSG2', 'گروه علمی انتخاب شده با گروه علمی دوم برابر می باشد.');
                }
                $oldSG1 = $post->scientific_group_v1;
                $post->scientific_group_v1 = $newSG1;
                if ($me->type != 2 and $me->type != 1) {
                    $post->sorter = session('id');
                }
                $post->save();
                break;
            case 'ChangeScientificGroup2':
                $newSG2 = $request->input('newSG2');
                $post = Post::find($postID);
                $oldSG2 = $post->scientific_group_v2;
                if ($post->scientific_group_v1==$newSG2){
                    return $this->alerts(false, 'sameWithSG1', 'گروه علمی انتخاب شده با گروه علمی اول برابر می باشد.');
                }
                $post->scientific_group_v2 = $newSG2;
                if ($me->type != 2 and $me->type != 1) {
                    $post->sorter = session('id');
                }
                $post->save();
                break;
        }
    }

    public function Classification(Request $request)
    {
        if ($request->hasFile('file_src')) {
            $file = $request->file('file_src');
            $validator = Validator::make($request->all(['file_src']), [
                'file_src' => 'mimes:pdf,rar,zip,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                return $this->alerts(false, 'wrongFileType', 'پسوند فایل اشتباه می باشد.');
            }
            $folderName = str_replace('/', '', bcrypt($file->getClientOriginalName()));
            $folderName = str_replace('\\', '', $folderName);
            $filePath = $file->storeAs('public/ClassificationFiles/' . $folderName, $file->getClientOriginalName());
            $SCFile = new SortingClassification();
            $SCFile->src = $filePath;
            $SCFile->save();
        }
        $posts = Post::where('sorted', 0)->get();
        foreach ($posts as $post) {
            $post->sorted = 1;
//            $post->sorter = session('id');
            $post->sorted_date = now();
            if ($request->hasFile('file_src')) {
                $post->sorting_classification_id = $SCFile->id;
            }
            $post->save();

            $rateInfo = new RateInfo();
            $rateInfo->post_id = $post->id;
            if ($post->scientific_group_v2 === null) {
                $rateInfo->sg2_form_type = null;
            }
            $rateInfo->save();
        }

        return $this->success(true, 'classificationSuccessful', 'برای نمایش اطلاعات جدید، لطفا صفحه را رفرش نمایید.');
    }

}
