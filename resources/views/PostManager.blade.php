@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">مدیریت آثار</h1>
            <div class="flex">
                <button id="new-post-button" type="button"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                    اثر جدید
                </button>
                <form id="new-post">
                    @csrf
                    <div class="mt-4 mb-4 flex items-center">
                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="newPostModal">
                            {{--                        <div class="fixed z-10 inset-0 overflow-y-auto" id="newPostModal">--}}
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75 add"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[900px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            تعریف اثر جدید در جشنواره
                                            {{ $festival->name }}
                                        </h3>
                                        <div class="mt-4">
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="person"
                                                       class="block text-gray-700 text-sm font-bold mb-2">مشخصات صاحب
                                                    اثر*:</label>
                                                <select id="person" class="select2 border rounded-md w-full px-3 py-2 "
                                                        name="person">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($persons as $person)
                                                        <option
                                                                value="{{ $person->user_id }}">{{ $person->first_name . ' ' . $person->last_name . ' - ' . $person->national_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex flex-col items-right mb-2">
                                                <label for="name"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام
                                                    اثر*:</label>
                                                <input type="text" id="name" name="name"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                                       placeholder="نام اثر را وارد کنید">
                                            </div>
                                            <div class="flex justify-between mb-4">
                                                <div class="w-1/3 ml-3">
                                                    <label for="post_format"
                                                           class="block text-gray-700 text-sm font-bold mb-2">قالب
                                                        علمی*:</label>
                                                    <select id="post_format" class="border rounded-md w-full px-3 py-2 "
                                                            name="post_format">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="کتاب">کتاب</option>
                                                        <option value="پایان نامه">پایان نامه</option>
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="post_type"
                                                           class=" block text-gray-700 text-sm font-bold mb-2">نوع
                                                        اثر*:</label>
                                                    <select id="post_type" class="border rounded-md w-full px-3 py-2 "
                                                            name="post_type">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="تالیف">تالیف</option>
                                                        <option value="تصحیح و تحقیق">تصحیح و تحقیق</option>
                                                        <option value="شرح و تلخیص">شرح و تلخیص</option>
                                                        <option value="تقریر">تقریر</option>
                                                        <option value="ترجمه">ترجمه</option>
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="language"
                                                           class="block text-gray-700 text-sm font-bold mb-2">زبان*:</label>
                                                    <select id="language" class="border rounded-md w-full px-3 py-2 "
                                                            name="language">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $languages=\App\Models\Catalogs\Language::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($languages as $language)
                                                            <option
                                                                value="{{ $language->id }}">{{ $language->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex justify-right mb-4">
                                                <div class="w-1/3 ml-3">
                                                    <label for="pages_number"
                                                           class="block text-gray-700 text-sm font-bold mb-1">تعداد
                                                        صفحه*:</label>
                                                    <input type="text" id="pages_number" name="pages_number"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تعداد صفحه را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="special_section"
                                                           class="block text-gray-700 text-sm font-bold mb-1">محور
                                                        ویژه*:</label>
                                                    <select id="special_section"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="special_section">
                                                        <option value="">این اثر در محور ویژه قرار نمی گیرد</option>
                                                        @php
                                                            $special_sections=\App\Models\Catalogs\SpecialSection::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($special_sections as $special_section)
                                                            <option
                                                                value="{{ $special_section->id }}">{{ $special_section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="bookDIV1" class="flex justify-right mb-4 hidden">
                                                <div class="w-1/3 ml-3 overflow-x-auto">
                                                    <label for="publisher"
                                                           class="block text-gray-700 text-sm font-bold mb-2">ناشر:</label>
                                                    <select id="publisher"
                                                            class="select2 border rounded-md w-72 px-3 py-2"
                                                            name="publisher">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @foreach($publishers as $publisher)
                                                            <option
                                                                value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="ISSN"
                                                           class="block text-gray-700 text-sm font-bold mb-2">شابک:</label>
                                                    <input type="text" id="ISSN" name="ISSN"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="شابک را وارد کنید">
                                                </div>
                                            </div>
                                            <div id="bookDIV2" class="flex justify-between mb-4 hidden">
                                                <div class="w-1/3 ml-3">
                                                    <label for="number_of_covers"
                                                           class="block text-gray-700 text-sm font-bold mb-2">تعداد
                                                        جلد*:</label>
                                                    <input type="text" id="number_of_covers" name="number_of_covers"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تعداد جلد را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="circulation"
                                                           class="block text-gray-700 text-sm font-bold mb-2">تیراژ:</label>
                                                    <input type="text" id="circulation" name="circulation"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تیراژ را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="book_size"
                                                           class="block text-gray-700 text-sm font-bold mb-2">قطع*</label>
                                                    <select id="book_size"
                                                            class="border rounded-md w-full px-3 py-2 mb-2"
                                                            name="book_size">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="رحلی">رحلی</option>
                                                        <option value="رقعی">رقعی</option>
                                                        <option value="نیم رقعی">نیم رقعی</option>
                                                        <option value="وزیری">وزیری</option>
                                                        <option value="بیاضی">بیاضی</option>
                                                        <option value="پالتویی">پالتویی</option>
                                                        <option value="خشتی">خشتی</option>
                                                        <option value="جیبی">جیبی</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="thesisDIV1" class="flex justify-right mb-4 hidden">
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_certificate_number"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">شماره
                                                        گواهی دفاع پایان نامه:</label>
                                                    <input type="text" id="thesis_certificate_number"
                                                           name="thesis_certificate_number"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="شماره
                                                        گواهی دفاع پایان نامه را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_defence_place"
                                                           class="block text-gray-700 text-sm font-bold mb-1">محل
                                                        دفاع*:</label>
                                                    <select id="thesis_defence_place"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="thesis_defence_place">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $defenceplaces=\App\Models\Catalogs\DefencePlace::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($defenceplaces as $defenceplace)
                                                            <option
                                                                value="{{ $defenceplace->id }}">{{ $defenceplace->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_grade"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">امتیاز
                                                        پایان نامه:</label>
                                                    <input type="text" id="thesis_grade" name="thesis_grade"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="امتیاز
                                                        پایان نامه را وارد کنید">
                                                </div>
                                            </div>
                                            <div id="thesisDIV2" class="flex justify-right mb-4 hidden">
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_supervisor"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد راهنما*:</label>
                                                    <input type="text" id="thesis_supervisor" name="thesis_supervisor"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد راهنما ">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_advisor"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد مشاور*:</label>
                                                    <input type="text" id="thesis_advisor" name="thesis_advisor"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد مشاور ">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_referee"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد داور*:</label>
                                                    <input type="text" id="thesis_referee" name="thesis_referee"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد داور ">
                                                </div>
                                            </div>
                                            <div class="flex justify-right mb-4">
                                                <div class="ml-3">
                                                    <label for="scientific_group1"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                        علمی اول*:</label>
                                                    <select id="scientific_group1"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="scientific_group1">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $groups=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="scientific_group2"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                        علمی دوم*:</label>
                                                    <select id="scientific_group2"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="scientific_group2">
                                                        <option value="">بدون گروه علمی دوم</option>
                                                        @php
                                                            $groups=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="properties"
                                                       class="text-gray-700 text-sm font-bold whitespace-nowrap">ویژگی
                                                    های اثر:</label>
                                                <textarea name="properties" id="properties"
                                                          class="border rounded-md w-full px-3 py-2"></textarea>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <div class="mb-4">
                                                    <label for="activity_type"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">نوع
                                                        همکاری:</label>
                                                    <select id="activity_type"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="activity_type">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="individual">فردی</option>
                                                        <option value="common">مشترک</option>
                                                    </select>
                                                </div>
                                                <div id="commonDIV" class="mb-4 hidden">
                                                    <table class="min-w-full divide-y divide-gray-200 text-center">
                                                        <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                نام
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                نام خانوادگی
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                کد ملی
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                درصد همکاری
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                شماره همراه
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tableBody"
                                                               class="bg-white divide-y divide-gray-200 ">
                                                        <tr>
                                                            <td><input type="text" name="comm_name1"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family1"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code1"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage1"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile1"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name2"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family2"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code2"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage2"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile2"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name3"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family3"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code3"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage3"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile3"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name4"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family4"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code4"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage4"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile4"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name5"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family5"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code5"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage5"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile5"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <div class="flex mb-4">
                                                    <label for="post_delivery_method"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">نحوه
                                                        تحویل اثر:</label>
                                                    <select id="post_delivery_method"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="post_delivery_method">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="physical">فیزیکی</option>
                                                        <option value="digital">دیجیتال</option>
                                                    </select>
                                                    <label for="number_of_received"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">تعداد نسخ واصله به دبیرخانه:</label>
                                                    <input type="number" name="number_of_received"
                                                           id="number_of_received"
                                                           class="border rounded-md w-full px-3 py-2"
                                                           placeholder="تعداد نسخ واصله به دبیرخانه را وارد نمایید">
                                                </div>
                                                <div id="file_srcDIV" class="mb-4 hidden">
                                                    <label for="file_src"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">فایل
                                                        اثر:</label>
                                                    <input id="file_src" name="file_src" type="file"
                                                           accept=".pdf, .doc, .docx, .jpg, .jpeg, .bmp"
                                                           class="border border-gray-300 px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                                </div>
                                                <div id="thesis_proceedings_srcDIV" class="mb-4 hidden">
                                                    <label for="thesis_proceedings_src"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">فایل
                                                        دفاعیه پایان نامه:</label>
                                                    <input id="thesis_proceedings_src" name="thesis_proceedings_src"
                                                           type="file" accept=".pdf, .doc, .docx, .jpg, .jpeg, .bmp"
                                                           class="border border-gray-300 px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ثبت اثر جدید
                                        </button>
                                        <button id="cancel-new-post" type="button"
                                                class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                            انصراف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="edit-post">
                    @csrf
                    <div class="mt-4 mb-4 flex items-center">
                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editPostModal">
                            {{--                        <div class="fixed z-10 inset-0 overflow-y-auto" id="newPostModal">--}}
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75 edit"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[900px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            ویرایش اثر
                                        </h3>
                                        <div class="mt-4">
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="personForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">مشخصات صاحب
                                                    اثر*:</label>
                                                <select id="personForEdit" class="border rounded-md w-full px-3 py-2 "
                                                        name="personForEdit">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($persons as $person)
                                                        <option
                                                            value="{{ $person->user_id }}">{{ $person->first_name . ' ' . $person->last_name . ' - ' . $person->national_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex flex-col items-right mb-2">
                                                <label for="nameForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام
                                                    اثر*:</label>
                                                <input type="text" id="nameForEdit" name="nameForEdit"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                                       placeholder="نام اثر را وارد کنید">
                                            </div>
                                            <div class="flex justify-between mb-4">
                                                <div class="w-1/3 ml-3">
                                                    <label for="post_formatForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">قالب
                                                        علمی*:</label>
                                                    <select id="post_formatForEdit"
                                                            class="border rounded-md w-full px-3 py-2 "
                                                            name="post_formatForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="کتاب">کتاب</option>
                                                        <option value="پایان نامه">پایان نامه</option>
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="post_typeForEdit"
                                                           class=" block text-gray-700 text-sm font-bold mb-2">نوع
                                                        اثر*:</label>
                                                    <select id="post_typeForEdit"
                                                            class="border rounded-md w-full px-3 py-2 "
                                                            name="post_typeForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="تالیف">تالیف</option>
                                                        <option value="تصحیح و تحقیق">تصحیح و تحقیق</option>
                                                        <option value="شرح و تلخیص">شرح و تلخیص</option>
                                                        <option value="تقریر">تقریر</option>
                                                        <option value="ترجمه">ترجمه</option>
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="languageForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">زبان*:</label>
                                                    <select id="languageForEdit"
                                                            class="border rounded-md w-full px-3 py-2 "
                                                            name="languageForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $languages=\App\Models\Catalogs\Language::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($languages as $language)
                                                            <option
                                                                value="{{ $language->id }}">{{ $language->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex justify-right mb-4">
                                                <div class="w-1/3 ml-3">
                                                    <label for="pages_numberForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-1">تعداد
                                                        صفحه*:</label>
                                                    <input type="text" id="pages_numberForEdit"
                                                           name="pages_numberForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تعداد صفحه را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="special_sectionForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-1">محور
                                                        ویژه*:</label>
                                                    <select id="special_sectionForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="special_sectionForEdit">
                                                        <option value="" selected>این اثر در محور ویژه قرار نمی گیرد
                                                        </option>
                                                        @php
                                                            $special_sections=\App\Models\Catalogs\SpecialSection::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($special_sections as $special_section)
                                                            <option
                                                                value="{{ $special_section->id }}">{{ $special_section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="bookDIV1ForEdit" class="flex justify-right mb-4 hidden">
                                                <div class="w-1/3 ml-3 overflow-x-auto">
                                                    <label for="publisherForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">ناشر:</label>
                                                    <select id="publisherForEdit"
                                                            class="select2 border rounded-md w-72 px-3 py-2"
                                                            name="publisherForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @foreach($publishers as $publisher)
                                                            <option
                                                                value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="ISSNForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">شابک:</label>
                                                    <input type="text" id="ISSNForEdit" name="ISSNForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="شابک را وارد کنید">
                                                </div>
                                            </div>
                                            <div id="bookDIV2ForEdit" class="flex justify-between mb-4 hidden ">
                                                <div class="w-1/3 ml-3">
                                                    <label for="number_of_coversForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">تعداد
                                                        جلد*:</label>
                                                    <input type="text" id="number_of_coversForEdit"
                                                           name="number_of_coversForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تعداد جلد را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="circulationForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">تیراژ:</label>
                                                    <input type="text" id="circulationForEdit" name="circulationForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="تیراژ را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="book_sizeForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">قطع*</label>
                                                    <select id="book_sizeForEdit"
                                                            class="border rounded-md w-full px-3 py-2 mb-2"
                                                            name="book_sizeForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="رحلی">رحلی</option>
                                                        <option value="رقعی">رقعی</option>
                                                        <option value="نیم رقعی">نیم رقعی</option>
                                                        <option value="وزیری">وزیری</option>
                                                        <option value="بیاضی">بیاضی</option>
                                                        <option value="پالتویی">پالتویی</option>
                                                        <option value="خشتی">خشتی</option>
                                                        <option value="جیبی">جیبی</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="thesisDIV1ForEdit" class="flex justify-right mb-4 hidden ">
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_certificate_numberForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">شماره
                                                        گواهی دفاع پایان نامه:</label>
                                                    <input type="text" id="thesis_certificate_numberForEdit"
                                                           name="thesis_certificate_numberForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="شماره
                                                        گواهی دفاع پایان نامه را وارد کنید">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_defence_placeForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-1">محل
                                                        دفاع*:</label>
                                                    <select id="thesis_defence_placeForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="thesis_defence_placeForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $defenceplaces=\App\Models\Catalogs\DefencePlace::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($defenceplaces as $defenceplace)
                                                            <option
                                                                value="{{ $defenceplace->id }}">{{ $defenceplace->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_gradeForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">امتیاز
                                                        پایان نامه:</label>
                                                    <input type="text" id="thesis_gradeForEdit"
                                                           name="thesis_gradeForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="امتیاز
                                                        پایان نامه را وارد کنید">
                                                </div>
                                            </div>
                                            <div id="thesisDIV2ForEdit" class="flex justify-right mb-4 hidden ">
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_supervisorForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد راهنما*:</label>
                                                    <input type="text" id="thesis_supervisorForEdit"
                                                           name="thesis_supervisorForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد راهنما ">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_advisorForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد مشاور*:</label>
                                                    <input type="text" id="thesis_advisorForEdit"
                                                           name="thesis_advisorForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد مشاور ">
                                                </div>
                                                <div class="w-1/3 ml-3">
                                                    <label for="thesis_refereeForEdit"
                                                           class="block text-gray-700 text-sm font-bold mb-2">مشخصات
                                                        استاد داور*:</label>
                                                    <input type="text" id="thesis_refereeForEdit"
                                                           name="thesis_refereeForEdit"
                                                           autocomplete="off"
                                                           class="border rounded-md w-full px-3 py-2 "
                                                           placeholder="نام و نام خانوادگی استاد داور ">
                                                </div>
                                            </div>
                                            <div class="flex justify-right mb-4">
                                                <div class="ml-3">
                                                    <label for="scientific_group1ForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                        علمی اول*:</label>
                                                    <select id="scientific_group1ForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="scientific_group1ForEdit">
                                                        name="scientific_group1">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        @php
                                                            $groups=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="scientific_group2ForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                        علمی دوم*:</label>
                                                    <select id="scientific_group2ForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="scientific_group2ForEdit">
                                                        <option value="">بدون گروه علمی دوم</option>
                                                        @php
                                                            $groups=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="propertiesForEdit"
                                                       class="text-gray-700 text-sm font-bold whitespace-nowrap">ویژگی
                                                    های اثر:</label>
                                                <textarea name="propertiesForEdit" id="propertiesForEdit"
                                                          class="border rounded-md w-full px-3 py-2"></textarea>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <div class="mb-4">
                                                    <label for="activity_typeForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">نوع
                                                        همکاری:</label>
                                                    <select id="activity_typeForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="activity_typeForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="individual">فردی</option>
                                                        <option value="common">مشترک</option>
                                                    </select>
                                                </div>
                                                <div id="commonDIVForEdit" class="mb-4 hidden">
                                                    <table class="min-w-full divide-y divide-gray-200 text-center">
                                                        <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                نام
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                نام خانوادگی
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                کد ملی
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                درصد همکاری
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                                                شماره همراه
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tableBodyForEdit"
                                                               class="bg-white divide-y divide-gray-200 ">
                                                        <tr>
                                                            <td><input type="text" name="comm_name1ForEdit"
                                                                       id="comm_name1ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family1ForEdit"
                                                                       id="comm_family1ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code1ForEdit"
                                                                       id="comm_national_code1ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage1ForEdit"
                                                                       id="comm_percentage1ForEdit"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile1ForEdit"
                                                                       id="comm_mobile1ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name2ForEdit"
                                                                       id="comm_name2ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family2ForEdit"
                                                                       id="comm_family2ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code2ForEdit"
                                                                       id="comm_national_code2ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage2ForEdit"
                                                                       id="comm_percentage2ForEdit"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile2ForEdit"
                                                                       id="comm_mobile2ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name3ForEdit"
                                                                       id="comm_name3ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family3ForEdit"
                                                                       id="comm_family3ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code3ForEdit"
                                                                       id="comm_national_code3ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage3ForEdit"
                                                                       id="comm_percentage3ForEdit"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile3ForEdit"
                                                                       id="comm_mobile3ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name4ForEdit"
                                                                       id="comm_name4ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family4ForEdit"
                                                                       id="comm_family4ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code4ForEdit"
                                                                       id="comm_national_code4ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage4ForEdit"
                                                                       id="comm_percentage4ForEdit"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile4ForEdit"
                                                                       id="comm_mobile4ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" name="comm_name5ForEdit"
                                                                       id="comm_name5ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام"></td>
                                                            <td><input type="text" name="comm_family5ForEdit"
                                                                       id="comm_family5ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="نام خانوادگی"></td>
                                                            <td><input type="text" name="comm_national_code5ForEdit"
                                                                       id="comm_national_code5ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="کد ملی"></td>
                                                            <td><input type="text" name="comm_percentage5ForEdit"
                                                                       id="comm_percentage5ForEdit"
                                                                       class="border rounded-md w-16 px-3 py-2"
                                                                       placeholder="درصد همکاری"></td>
                                                            <td><input type="text" name="comm_mobile5ForEdit"
                                                                       id="comm_mobile5ForEdit"
                                                                       class="border rounded-md w-full px-3 py-2"
                                                                       placeholder="شماره همراه"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <div class="flex mb-4">
                                                    <label for="post_delivery_methodForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">نحوه
                                                        تحویل اثر:</label>
                                                    <select id="post_delivery_methodForEdit"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="post_delivery_methodForEdit">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="physical">فیزیکی</option>
                                                        <option value="digital">دیجیتال</option>
                                                    </select>
                                                    <label for="number_of_receivedForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">تعداد نسخ واصله به دبیرخانه:</label>
                                                    <input type="number" name="number_of_receivedForEdit"
                                                           id="number_of_receivedForEdit"
                                                           class="border rounded-md w-full px-3 py-2"
                                                           placeholder="تعداد نسخ واصله به دبیرخانه را وارد نمایید">
                                                </div>
                                                <div id="file_srcDIVForEdit" class="mb-4 hidden">
                                                    <label for="file_srcForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">برای
                                                        مشاهده فایل اثر
                                                        <a id="postFile" target="_blank">
                                                            اینجا
                                                        </a>
                                                        را کلیک کرده و در صورت تمایل به تغییر فایل از کادر زیر اقدام
                                                        نمایید:</label>
                                                    <input id="file_srcForEdit" name="file_srcForEdit" type="file"
                                                           accept=".pdf, .doc, .docx, .jpg, .jpeg, .bmp"
                                                           class="border border-gray-300 px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">

                                                </div>
                                                <div id="thesis_proceedings_srcDIVForEdit" class="mb-4 hidden">
                                                    <label for="thesis_proceedings_srcForEdit"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">برای
                                                        مشاهده فایل دفاعیه پایان نامه
                                                        <a id="proceedingsFile" target="_blank">
                                                            اینجا
                                                        </a>
                                                        را کلیک کرده و در صورت تمایل به تغییر فایل از کادر زیر اقدام
                                                        نمایید:</label>
                                                    <input id="thesis_proceedings_srcForEdit"
                                                           name="thesis_proceedings_srcForEdit"
                                                           type="file" accept=".pdf, .doc, .docx, .jpg, .jpeg, .bmp"
                                                           class="border border-gray-300 px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <input type="hidden" value="" name="postIDForEdit" id="postIDForEdit">
                                        <button type="submit"
                                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ویرایش اثر
                                        </button>
                                        <button id="cancel-edit-post" type="button"
                                                class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                            انصراف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <div class=" mb-4 flex w-full">
                    {{--                    <label for="search-Username-UserManager" class="block mt-3 text-sm font-bold text-gray-700">جستجو در--}}
                    {{--                        کد--}}
                    {{--                        اثری:</label>--}}
                    {{--                    <input id="search-Username-UserManager" autocomplete="off"--}}
                    {{--                           placeholder="لطفا کد اثری را وارد نمایید."--}}
                    {{--                           type="text" name="search-Username-UserManager"--}}
                    {{--                           class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>--}}
                    {{--                    <label for="search-type-UserManager"--}}
                    {{--                           class="block text-gray-700 text-sm font-bold mt-3 ">جستجو در نقش--}}
                    {{--                        اثری:</label>--}}
                    {{--                    <select id="search-type-UserManager" class="border rounded-md  px-3 "--}}
                    {{--                            name="search-type-UserManager">--}}
                    {{--                        <option value="">بدون فیلتر</option>--}}
                    {{--                        @foreach($personList->pluck('type', 'subject')->unique() as $type => $subject)--}}
                    {{--                            <option value="{{ $subject }}">{{ $type }}</option>--}}
                    {{--                        @endforeach--}}
                    {{--                    </select>--}}
                </div>
                <div class="max-w-full overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">ردیف</th>
                            <th class=" px-6 py-3  font-bold ">کد اثر</th>
                            <th class=" px-6 py-3  font-bold ">جشنواره</th>
                            <th class=" px-6 py-3  font-bold ">نام اثر</th>
                            <th class=" px-3 py-3  font-bold ">قالب اثر</th>
                            <th class=" px-3 py-3  font-bold ">نوع اثر</th>
                            <th class=" px-3 py-3  font-bold ">زبان</th>
                            <th class=" px-3 py-3  font-bold ">گروه علمی اول</th>
                            <th class=" px-3 py-3  font-bold ">گروه علمی دوم</th>
                            <th class=" px-3 py-3  font-bold ">صاحب اثر</th>
                            <th class=" px-3 py-3  font-bold ">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($postList as $post)
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $loop->iteration  }}</td>
                                <td class="px-6 py-4">
                                    {{ $post-> id }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $festivalInfo=\App\Models\Catalogs\Festival::find($post->festival_id)
                                    @endphp
                                    {{ $festivalInfo->name }}
                                </td>
                                <td class="px-6 py-4">{{ $post->title  }}</td>
                                <td class="px-6 py-4">{{$post->post_format  }}</td>
                                <td class="px-3 py-4">{{ $post->post_type }}</td>
                                <td class="px-3 py-4">
                                    @php
                                        $languageInfo=\App\Models\Catalogs\Language::find($post->language)
                                    @endphp
                                    {{ $languageInfo->name }}
                                </td>
                                <td class="px-3 py-4">
                                @php
                                    $sg1Info=\App\Models\Catalogs\ScientificGroup::find($post->scientific_group_v1)
                                @endphp
                                {{ $sg1Info->name }}
                                <td class="px-3 py-4">
                                    @php
                                        $sg2Info=\App\Models\Catalogs\ScientificGroup::find($post->scientific_group_v2)
                                    @endphp
                                    {{ @$sg2Info->name }}
                                </td>
                                <td class="px-3 py-4">
                                    @php
                                        $personInfo=\App\Models\Person::find($post->person_id)
                                    @endphp
                                    {{ @$personInfo->name .' ' . @$personInfo->family }}
                                </td>
                                <td class="flex px-6 py-4">
                                    <button type="submit" data-id="{{ $post->id }}"
                                            class="px-4 py-2 mr-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 PostControl">
                                        ویرایش
                                    </button>
                                    <button type="submit" data-id="{{ $post->id }}"
                                            class="px-4 py-2 mr-3 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 DeletePost">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div dir="ltr" class="mt-4 flex justify-center" id="laravel-next-prev">
                    {{ $postList->links() }}
                </div>

            </div>

        </div>
    </main>
@endsection
