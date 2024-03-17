@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">مدیریت کاربران</h1>
            @if( session()->has('success') )
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                     role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">{{ session()->get('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="flex">
                <button id="new-user-button" type="button"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                    کاربر جدید
                </button>
                <form id="new-user">
                    @csrf
                    <div class="mt-4 mb-4 flex items-center">
                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="newUserModal">
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            تعریف کاربر جدید
                                        </h3>
                                        <div class="mt-4">
                                            <div class="flex flex-col items-right mb-4">
                                                <label for="first_name"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام*:</label>
                                                <input type="text" id="first_name" name="first_name" autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="نام کاربر">
                                                <label for="last_name"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام
                                                    خانوادگی*:</label>
                                                <input type="text" id="last_name" name="last_name" autocomplete="off"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                                       placeholder="نام خانوادگی کاربر">
                                            </div>
                                            <div class="mb-4">
                                                <label for="username"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نام
                                                    کاربری*:</label>
                                                <input type="text" id="username" name="username" autocomplete="off"
                                                       class="border rounded-md w-full px-3 py-2 text-left"
                                                       placeholder="نام کاربری">
                                            </div>
                                            <div class="flex flex-col mb-4">
                                                <label for="password"
                                                       class="block text-gray-700 text-sm font-bold mb-2">رمز
                                                    عبور*:</label>
                                                <input type="password" autocomplete="new-password" name="password"
                                                       id="password"
                                                       class="border rounded-md w-full mb-4 px-3 py-2 text-left"
                                                       placeholder="رمزعبور">
                                            </div>
                                            <div class="mb-4">
                                                <label for="type"
                                                       class="block text-gray-700 text-sm font-bold mb-2">نقش
                                                    کاربر:</label>
                                                <select id="type" class="border rounded-md w-full px-3 py-2"
                                                        name="type">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    <option value="1">ادمین کل</option>
                                                    <option value="2">کارشناس سامانه</option>
                                                    <option value="3">مدیر گروه</option>
                                                    <option value="4">ارزیاب</option>
                                                    <option value="5">کارشناس گونه بندی</option>
                                                    <option value="6">نویسنده</option>
                                                </select>
                                            </div>
                                            <div class="mb-4" id="scientific_groupDIV" hidden="hidden">
                                                <label for="scientific_group"
                                                       class="block text-gray-700 text-sm font-bold mb-2">گروه
                                                    علمی:</label>
                                                <select id="scientific_group" class="border rounded-md w-full px-3 py-2"
                                                        name="scientific_group">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @php
                                                        $groups=\App\Models\Catalogs\ScientificGroup::
                                                        where('status',1)
                                                        ->orderBy('name')->get();
                                                    @endphp
                                                    @foreach($groups as $group)
                                                        <option value="{{ $group->id }}">{{$group->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ثبت کاربر جدید
                                        </button>
                                        <button id="cancel-new-user" type="button"
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
                    <label for="search-Username-UserManager" class="block mt-3 text-sm font-bold text-gray-700">جستجو در
                        کد
                        کاربری:</label>
                    <input id="search-Username-UserManager" autocomplete="off"
                           placeholder="لطفا کد کاربری را وارد نمایید."
                           type="text" name="search-Username-UserManager"
                           class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>
                    <label for="search-type-UserManager"
                           class="block text-gray-700 text-sm font-bold mt-3 ">جستجو در نقش
                        کاربری:</label>
                    <select id="search-type-UserManager" class="border rounded-md  px-3 "
                            name="search-type-UserManager">
                        <option value="">بدون فیلتر</option>
                        @foreach($userList->pluck('type', 'subject')->unique() as $type => $subject)
                            <option value="{{ $subject }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="max-w-full overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">کد کاربری</th>
                            <th class=" px-6 py-3  font-bold ">مشخصات</th>
                            <th class=" px-3 py-3  font-bold ">نوع کاربری</th>
                            <th class=" px-3 py-3  font-bold ">وضعیت</th>
                            <th class=" px-3 py-3  font-bold ">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($userList as $user)
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->generalInformationInfo->first_name . ' ' . $user->generalInformationInfo->last_name  }}</td>
                                <td class="px-3 py-4">{{ $user->subject }}</td>
                                <td class="px-3 py-4">
                                    @if($user->status==1)
                                        فعال
                                    @else
                                        غیر فعال
                                    @endif
                                </td>
                                <td class="px-3 py-4">
                                    <a href="{{ route('Users.edit',$user->id) }}">
                                        <button
                                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ویرایش
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div dir="ltr" class="mt-4 flex justify-center" id="laravel-next-prev">
                    {{ $userList->links() }}
                </div>

            </div>

        </div>
    </main>
@endsection
