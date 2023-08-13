<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        $person = $request->input('person');
        $name = $request->input('name');
        $post_format = $request->input('post_format');
        $post_type = $request->input('post_type');
        $language = $request->input('language');
        $publisher = $request->input('publisher');
        $ISSN = $request->input('ISSN');
        $number_of_covers = $request->input('number_of_covers');
        $circulation = $request->input('circulation');
        $book_size = $request->input('book_size');
        $thesis_defence_place = $request->input('thesis_defence_place');
        $thesis_grade = $request->input('thesis_grade');
        $thesis_supervisor = $request->input('thesis_supervisor');
        $thesis_advisor = $request->input('thesis_advisor');
        $thesis_referee = $request->input('thesis_referee');
        $scientific_group1 = $request->input('scientific_group1');
        $scientific_group2 = $request->input('scientific_group2');
        $properties = $request->input('properties');
        $research_type = $request->input('research_type');
        $post_delivery_method = $request->input('post_delivery_method');

//        $file_src = $request->input('file_src');
//        $thesis_proceedings_src = $request->input('thesis_proceedings_src');

        //cooperators
        if ($research_type=='common'){
            if ($request->input('comm_name1') and $request->input('comm_family1') and $request->input('comm_percentage1') and $request->input('comm_national_code1') and $request->input('comm_mobile1')) {
                $comm_name1 = $request->input('comm_name1');
                $comm_family1 = $request->input('comm_family1');
                $comm_national_code1 = $request->input('comm_national_code1');
                $comm_percentage1 = $request->input('comm_percentage1');
                $comm_mobile1 = $request->input('comm_mobile1');
            }
            if ($request->input('comm_name2') and $request->input('comm_family2') and $request->input('comm_percentage2') and $request->input('comm_national_code2') and $request->input('comm_mobile2')) {
                $comm_name2 = $request->input('comm_name2');
                $comm_family2 = $request->input('comm_family2');
                $comm_national_code2 = $request->input('comm_national_code2');
                $comm_percentage1 = $request->input('comm_percentage2');
                $comm_mobile2 = $request->input('comm_mobile2');
            }
            if ($request->input('comm_name3') and $request->input('comm_family3') and $request->input('comm_percentage3') and $request->input('comm_national_code3') and $request->input('comm_mobile3')) {
                $comm_name3 = $request->input('comm_name3');
                $comm_family3 = $request->input('comm_family3');
                $comm_national_code3 = $request->input('comm_national_code3');
                $comm_percentage3 = $request->input('comm_percentage3');
                $comm_mobile3 = $request->input('comm_mobile3');
            }
            if ($request->input('comm_name4') and $request->input('comm_family4') and $request->input('comm_percentage4') and $request->input('comm_national_code4') and $request->input('comm_mobile4')) {
                $comm_name4 = $request->input('comm_name4');
                $comm_family4 = $request->input('comm_family4');
                $comm_national_code4 = $request->input('comm_national_code4');
                $comm_percentage4 = $request->input('comm_percentage4');
                $comm_mobile4 = $request->input('comm_mobile4');
            }
            if ($request->input('comm_name5') and $request->input('comm_family5') and $request->input('comm_percentage5') and $request->input('comm_national_code5') and $request->input('comm_mobile5')) {
                $comm_name5 = $request->input('comm_name5');
                $comm_family5 = $request->input('comm_family5');
                $comm_national_code5 = $request->input('comm_national_code5');
                $comm_percentage5 = $request->input('comm_percentage5');
                $comm_mobile5 = $request->input('comm_mobile5');
            }
        }
//
//        $check=Person::where('national_code',$national_code)->first();
//        if ($check){
//            return $this->alerts(false, 'dupNationalCode', 'کد ملی تکراری وارد شده است');
//        }
//
//        $Person = new Person();
//        $Person->name = $name;
//        $Person->family = $family;
//        $Person->national_code = $national_code;
//        $Person->howzah_code = $howzah_code;
//        $Person->mobile = $mobile;
//        $Person->gender = $gender;
//
//        $Person->save();
//        $this->logActivity('Person Added =>' . $Person->id, \request()->ip(), \request()->userAgent(), \session('id'));
//        return $this->success(true, 'PersonAdded', 'برای نمایش اطلاعات جدید، لطفا صفحه را رفرش نمایید.');
    }
    public function editPost(Request $request)
    {
        $PersonID=$request->input('personID');
        $name = $request->input('nameForEdit');
        $family = $request->input('familyForEdit');
        $howzah_code = $request->input('howzah_codeForEdit');
        $mobile = $request->input('mobileForEdit');
        $gender = $request->input('genderForEdit');
        if (!$name) {
            return $this->alerts(false, 'nullName', 'نام وارد نشده است');
        }
        if (!$family) {
            return $this->alerts(false, 'nullFamily', 'نام خانوادگی وارد نشده است');
        }
        if (!$mobile) {
            return $this->alerts(false, 'nullMobile', 'شماره همراه وارد نشده است');
        }
        if (strlen($mobile)!=11) {
            return $this->alerts(false, 'wrongMobile', 'شماره همراه اشتباه وارد شده است');
        }
        if (!$gender) {
            return $this->alerts(false, 'nullGender', 'جنسیت وارد نشده است');
        }

        $Person = Person::find($PersonID);
        $Person->fill([
            'name' => $name,
            'family' => $family,
            'mobile' => $mobile,
            'howzah_code' => $howzah_code,
            'gender' => $gender,
        ]);
        $Person->save();
        $this->logActivity('Person Edited =>' . $PersonID, \request()->ip(), \request()->userAgent(), \session('id'));
        return $this->success(true, 'personEdited', 'برای نمایش اطلاعات جدید، لطفا صفحه را رفرش نمایید.');
    }
    public function getPostInfo(Request $request)
    {
        $personID = $request->input('id');
        if ($personID) {
            return Person::find($personID);
        }
    }
    public function index()
    {
        $postList = Post::orderBy('festival_id', 'asc')->paginate(20);
        return \view('PostManager', ['postList' => $postList]);
    }
}
