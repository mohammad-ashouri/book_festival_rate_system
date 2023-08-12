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
                        {{--                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="newPostModal">--}}
                        <div class="fixed z-10 inset-0 overflow-y-auto" id="newPostModal">
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75 add"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            تعریف اثر جدید در جشنواره
                                            @php
                                                $festival=\App\Models\Catalogs\Festival::orderBy('id','desc')->first();
                                                echo $festival->name;
                                            @endphp
                                        </h3>
                                        <div class="mt-4">
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="name"
                                                       class="block text-gray-700 text-sm font-bold mb-2">مشخصات صاحب
                                                    اثر*:</label>
                                                <select id="gender" class="border rounded-md w-full px-3 py-2 "
                                                        name="gender">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @php
                                                        $persons=\App\Models\Person::orderBy('family','asc')->get();
                                                    @endphp
                                                    @foreach($persons as $person)
                                                        <option
                                                            value="{{ $person->id }}">{{ $person->name . ' ' . $person->family }}</option>
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
                                            <div class="flex justify-between">
                                                <div class="flex justify-between">
                                                    <div class="ml-3">
                                                        <label for="scientific_group1"
                                                               class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                            علمی اول*:</label>
                                                        <select id="scientific_group1"
                                                                class="border rounded-md w-full px-3 py-2"
                                                                name="scientific_group1">
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
                                                            name="scientific_group2">
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
                                                </div>
                                                <div class="ml-3">
                                                    <label for="post_type"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">قالب
                                                        علمی*:</label>
                                                    <select id="post_type" class="border rounded-md w-full px-3 py-2 "
                                                            name="post_type">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="کتاب">کتاب</option>
                                                        <option value="پایان نامه">پایان نامه</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="post_format"
                                                           class=" text-gray-700 text-sm font-bold mb-1 whitespace-nowrap">نوع
                                                        اثر*:</label>
                                                    <select id="post_format" class="border rounded-md w-full px-3 py-2 "
                                                            name="post_format">
                                                        <option value="" disabled selected>انتخاب کنید</option>
                                                        <option value="تالیف">تالیف</option>
                                                        <option value="تصحیح و تحقیق">تصحیح و تحقیق</option>
                                                        <option value="شرح و تلخیص">شرح و تلخیص</option>
                                                        <option value="تقریر">تقریر</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="gender"
                                                       class="block text-gray-700 text-sm font-bold mb-2">زبان*:</label>
                                                <select id="gender" class="border rounded-md w-full px-3 py-2 "
                                                        name="gender">
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
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="howzah_code"
                                                       class="block text-gray-700 text-sm font-bold mb-2">شمارگان
                                                    صفحه*:</label>
                                                <input type="text" id="howzah_code" name="howzah_code"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="شمارگان صفحه را وارد کنید">
                                            </div>
                                            <div class="flex justify-between">
                                                <div class="ml-3">
                                                    <label for="scientific_group1"
                                                           class="text-gray-700 text-sm font-bold whitespace-nowrap">گروه
                                                        علمی اول*:</label>
                                                    <select id="scientific_group1"
                                                            class="border rounded-md w-full px-3 py-2"
                                                            name="scientific_group1">
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
                                                        name="scientific_group2">
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
                <form id="edit-person">
                    @csrf
                    <div class="mt-4 mb-4 flex items-center">
                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editPersonModal">
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75 edit"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            ویرایش اثر
                                        </h3>
                                        <div class="mt-4">
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="nameForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام*:</label>
                                                <input type="text" id="nameForEdit" name="nameForEdit"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="نام را وارد کنید">
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="familyForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام
                                                    خانوادگی*:</label>
                                                <input type="text" id="familyForEdit" name="familyForEdit"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="نام خانوادگی را وارد کنید">
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="national_codeForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">کد
                                                    ملی*:</label>
                                                <input type="text" id="national_codeForEdit" name="national_codeForEdit"
                                                       autocomplete="off" disabled
                                                       class="border rounded-md bg-gray-300 w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="کد ملی را وارد کنید">
                                            </div>
                                            <div class="flex flex-col items-right mb-2">
                                                <label for="mobileForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">شماره
                                                    همراه*:</label>
                                                <input type="text" id="mobileForEdit" name="mobileForEdit"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="شماره همراه را وارد کنید">
                                            </div>
                                            <div class="mb-4">
                                                <label for="genderForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">جنسیت*:</label>
                                                <select id="genderForEdit" class="border rounded-md w-full px-3 py-2 "
                                                        name="genderForEdit">
                                                    <option value="مرد">مرد</option>
                                                    <option value="زن">زن</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="howzah_codeForEdit"
                                                       class="block text-gray-700 text-sm font-bold mb-2">شماره پرونده
                                                    حوزوی*:</label>
                                                <input type="text" id="howzah_codeForEdit" name="howzah_codeForEdit"
                                                       autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="شماره پرونده حوزوی را وارد کنید">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <input type="hidden" name="personID" id="personID" value="">
                                        <button type="submit"
                                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ویرایش اثر
                                        </button>
                                        <button id="cancel-edit-person" type="button"
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
                                <td class="px-6 py-4">{{ $post->festival_id  }}</td>
                                <td class="px-6 py-4">{{ $post->title  }}</td>
                                <td class="px-6 py-4">{{$post->post_format  }}</td>
                                <td class="px-3 py-4">{{ $post->post_type }}</td>
                                <td class="px-3 py-4">{{ $post->language }}</td>
                                <td class="px-3 py-4">{{ $post->scientific_group_v1 }}</td>
                                <td class="px-3 py-4">{{ @$post->scientific_group_v2 }}</td>
                                <td class="px-3 py-4">{{ $post->user_id }}</td>
                                <td class="px-6 py-4">
                                    <button type="submit" data-id="{{ $post->id }}"
                                            class="px-4 py-2 mr-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 PostControl">
                                        جزئیات و ویرایش
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
