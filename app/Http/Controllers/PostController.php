<?php

namespace App\Http\Controllers;

use App\Models\Catalogs\Festival;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        $person = $request->input('person');
        $festival = Festival::orderBy('id', 'desc')->first();
        $festival = $festival->id;
        $name = $request->input('name');
        $post_format = $request->input('post_format');
        $post_type = $request->input('post_type');
        $language = $request->input('language');
        $pages_number = $request->input('pages_number');
        $special_section = $request->input('specialSection');
        $scientific_group1 = $request->input('scientific_group1');
        $scientific_group2 = $request->input('scientific_group2');
        $properties = $request->input('properties');
        $activity_type = $request->input('activity_type');
        $post_delivery_method = $request->input('post_delivery_method');
        $postFilePath=null;
        $thesisFilePath=null;
        if (!$person) {
            return $this->alerts(false, 'nullPerson', 'کاربر انتخاب نشده است');
        }
        if (!$name) {
            return $this->alerts(false, 'nullName', 'نام اثر وارد نشده است');
        }
        if (!$post_format) {
            return $this->alerts(false, 'nullPostFormat', 'قالب علمی انتخاب نشده است');
        }
        if (!$post_type) {
            return $this->alerts(false, 'nullPostType', 'نوع اثر انتخاب نشده است');
        }
        if (!$language) {
            return $this->alerts(false, 'nullLanguage', 'زبان انتخاب نشده است');
        }
        if (!$pages_number) {
            return $this->alerts(false, 'nullPagesNumber', 'تعداد صفحه وارد نشده است');
        }
        if (!$scientific_group1) {
            return $this->alerts(false, 'nullSG1', 'گروه علمی اول انتخاب نشده است');
        }
        if (!$activity_type) {
            return $this->alerts(false, 'nullActivityType', 'نوع همکاری انتخاب نشده است');
        }
        if (!$post_delivery_method) {
            return $this->alerts(false, 'nullPostDeliveryMethod', 'نحوه تحویل اثر انتخاب نشده است');
        }

        switch ($post_format) {
            case 'کتاب':
                $publisher = $request->input('publisher');
                if (!$publisher) {
                    return $this->alerts(false, 'nullPublisher', 'ناشر انتخاب نشده است');
                }
                $ISSN = $request->input('ISSN');
                if (!$ISSN) {
                    return $this->alerts(false, 'nullISSN', 'شابک وارد نشده است');
                }
                $number_of_covers = $request->input('number_of_covers');
                if (!$number_of_covers) {
                    return $this->alerts(false, 'nullNumberOfCovers', 'تعداد جلد انتخاب نشده است');
                }
                $circulation = $request->input('circulation');
                if (!$circulation) {
                    return $this->alerts(false, 'nullCirculation', 'تیراژ وارد نشده است');
                }
                $book_size = $request->input('book_size');
                if (!$book_size) {
                    return $this->alerts(false, 'nullBookSize', 'قطع انتخاب نشده است');
                }
                break;
            case 'پایان نامه':
                $thesis_certificate_number = $request->input('thesis_certificate_number');
                if (!$thesis_certificate_number) {
                    return $this->alerts(false, 'nullThesisCertificateNumber', 'شماره گواهی دفاع پایان نامه وارد نشده است');
                }
                $thesis_defence_place = $request->input('thesis_defence_place');
                if (!$thesis_defence_place) {
                    return $this->alerts(false, 'nullThesisDefencePlace', 'محل دفاع پایان نامه انتخاب نشده است');
                }
                $thesis_grade = $request->input('thesis_grade');
                if (!$thesis_grade) {
                    return $this->alerts(false, 'nullGrade', 'امتیاز پایان نامه وارد نشده است');
                }
                $thesis_supervisor = $request->input('thesis_supervisor');
                if (!$thesis_supervisor) {
                    return $this->alerts(false, 'nullSupervisor', 'مشخصات استاد راهنما وارد نشده است');
                }
                $thesis_advisor = $request->input('thesis_advisor');
                if (!$thesis_advisor) {
                    return $this->alerts(false, 'nullAdvisor', 'مشخصات استاد مشاور وارد نشده است');
                }
                $thesis_referee = $request->input('thesis_referee');
                if (!$thesis_referee) {
                    return $this->alerts(false, 'nullReferee', 'مشخصات استاد داور وارد نشده است');
                }
                break;
        }

        if ($scientific_group2) {
            $research_type = 2;
        } else {
            $research_type = 1;
        }

        //cooperators
        $participation_percentage = 100;
        if ($activity_type == 'common') {
            if ($request->input('comm_name1') and $request->input('comm_family1') and $request->input('comm_percentage1') and $request->input('comm_national_code1') and $request->input('comm_mobile1')) {
                $comm_name1 = $request->input('comm_name1');
                $comm_family1 = $request->input('comm_family1');
                $comm_national_code1 = $request->input('comm_national_code1');
                $comm_percentage1 = $request->input('comm_percentage1');
                $comm_mobile1 = $request->input('comm_mobile1');
                $participation_percentage -= $comm_percentage1;
            }else{
                return $this->alerts(false, 'nullCooperatorInformation', 'اطلاعات مشترک ناقص وارد است');
            }
            if ($request->input('comm_name2') and $request->input('comm_family2') and $request->input('comm_percentage2') and $request->input('comm_national_code2') and $request->input('comm_mobile2')) {
                $comm_name2 = $request->input('comm_name2');
                $comm_family2 = $request->input('comm_family2');
                $comm_national_code2 = $request->input('comm_national_code2');
                $comm_percentage2 = $request->input('comm_percentage2');
                $comm_mobile2 = $request->input('comm_mobile2');
                $participation_percentage -= $comm_percentage2;
            }else{
                return $this->alerts(false, 'nullCooperatorInformation', 'اطلاعات مشترک ناقص وارد است');
            }
            if ($request->input('comm_name3') and $request->input('comm_family3') and $request->input('comm_percentage3') and $request->input('comm_national_code3') and $request->input('comm_mobile3')) {
                $comm_name3 = $request->input('comm_name3');
                $comm_family3 = $request->input('comm_family3');
                $comm_national_code3 = $request->input('comm_national_code3');
                $comm_percentage3 = $request->input('comm_percentage3');
                $comm_mobile3 = $request->input('comm_mobile3');
                $participation_percentage -= $comm_percentage3;
            }else{
                return $this->alerts(false, 'nullCooperatorInformation', 'اطلاعات مشترک ناقص وارد است');
            }
            if ($request->input('comm_name4') and $request->input('comm_family4') and $request->input('comm_percentage4') and $request->input('comm_national_code4') and $request->input('comm_mobile4')) {
                $comm_name4 = $request->input('comm_name4');
                $comm_family4 = $request->input('comm_family4');
                $comm_national_code4 = $request->input('comm_national_code4');
                $comm_percentage4 = $request->input('comm_percentage4');
                $comm_mobile4 = $request->input('comm_mobile4');
                $participation_percentage -= $comm_percentage4;
            }else{
                return $this->alerts(false, 'nullCooperatorInformation', 'اطلاعات مشترک ناقص وارد است');
            }
            if ($request->input('comm_name5') and $request->input('comm_family5') and $request->input('comm_percentage5') and $request->input('comm_national_code5') and $request->input('comm_mobile5')) {
                $comm_name5 = $request->input('comm_name5');
                $comm_family5 = $request->input('comm_family5');
                $comm_national_code5 = $request->input('comm_national_code5');
                $comm_percentage5 = $request->input('comm_percentage5');
                $comm_mobile5 = $request->input('comm_mobile5');
                $participation_percentage -= $comm_percentage5;
            }else{
                return $this->alerts(false, 'nullCooperatorInformation', 'اطلاعات مشترک ناقص وارد است');
            }
        }

        if ($post_delivery_method == 'digital') {
            if ($post_format == 'کتاب') {
                $file_src = $request->file('file_src');
                if ($file_src->getClientOriginalName()) {
                    $folderName = str_replace('/', '', bcrypt($file_src->getClientOriginalName()));
                    $folderName = str_replace('\\', '', $folderName);
                    $filePath = $file_src->storeAs('public/PostFiles/' . $folderName, $file_src->getClientOriginalName());
                } else {
                    return $this->alerts(false, 'nullPostFile', 'فایل اثر انتخاب نشده است');
                }
            }

            if ($post_format == 'پایان نامه') {
                $file_src = $request->file('file_src');
                $thesis_proceedings_src = $request->input('thesis_proceedings_src');
                if ($file_src->getClientOriginalName() and $thesis_proceedings_src->getClientOriginalName()) {
                    $folderName = str_replace('/', '', bcrypt($file_src->getClientOriginalName()));
                    $folderName = str_replace('\\', '', $folderName);
                    $postFilePath = $file_src->storeAs('public/PostFiles/' . $folderName, $file_src->getClientOriginalName());

                    $folderName = str_replace('/', '', bcrypt($thesis_proceedings_src->getClientOriginalName()));
                    $folderName = str_replace('\\', '', $folderName);
                    $thesisFilePath = $file_src->storeAs('public/ThesisFiles/' . $folderName, $thesis_proceedings_src->getClientOriginalName());
                } elseif (!$file_src->getClientOriginalName()) {
                    return $this->alerts(false, 'nullPostFile', 'فایل اثر انتخاب نشده است');
                } elseif (!$thesis_proceedings_src->getClientOriginalName()) {
                    return $this->alerts(false, 'nullThesisFile', 'فایل دفاعیه پایان نامه انتخاب نشده است');
                }
            }

        }

        $Post = new Post();
        $Post->person_id = $person;
        $Post->festival_id = $festival;
        $Post->title = $name;
        $Post->post_format = $post_format;
        $Post->post_type = $post_type;
        $Post->language = $language;
        $Post->pages_number = $pages_number;
        $Post->special_section = $special_section;
        $Post->properties = $properties;
        switch ($post_format) {
            case 'کتاب':
                $Post->publisher = $publisher;
                $Post->ISSN = $ISSN;
                $Post->number_of_covers = $number_of_covers;
                $Post->book_size = $book_size;
                $Post->circulation = $circulation;
                break;
            case 'پایان نامه':
                $Post->thesis_certificate_number = $thesis_certificate_number;
                $Post->thesis_defence_place = $thesis_defence_place;
                $Post->thesis_grade = $thesis_grade;
                $Post->thesis_supervisor = $thesis_supervisor;
                $Post->thesis_advisor = $thesis_advisor;
                $Post->thesis_referee = $thesis_referee;
                break;
        }
        $Post->research_type = $research_type;
        $Post->scientific_group_v1 = $scientific_group1;
        $Post->scientific_group_v2 = $scientific_group2;
        $Post->activity_type = $activity_type;
        $Post->participation_percentage = $participation_percentage;
        $Post->post_delivery_method = $post_delivery_method;
        $Post->file_src = $postFilePath;
        $Post->thesis_proceedings_src = $thesisFilePath;
        $Post->save();

        $this->logActivity('Post Added =>' . $Post->id, \request()->ip(), \request()->userAgent(), \session('id'));
        return $this->success(true, 'PostAdded', 'برای نمایش اطلاعات جدید، لطفا صفحه را رفرش نمایید.');
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
