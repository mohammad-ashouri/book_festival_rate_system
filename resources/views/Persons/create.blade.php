@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">تعریف صاحب اثر جدید</h1>
            @if (count($errors) > 0)
                <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md"
                     role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="font-bold">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded shadow flex flex-col ">
                <form id="new-person" method="post" action="{{route('Person.store')}}">
                    @csrf
                    <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex mt-4">
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="first_name"
                                       class="block text-gray-700 text-sm font-bold mb-2">نام*:</label>
                                <input type="text" autocomplete="off" required id="first_name" name="first_name"
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                       placeholder="نام صاحب اثر را وارد کنید">
                            </div>
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="last_name"
                                       class="block text-gray-700 text-sm font-bold mb-2">نام خانوادگی*:</label>
                                <input type="text" autocomplete="off" required id="last_name" name="last_name"
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                       placeholder="نام خانوادگی صاحب اثر را وارد کنید">
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="national_code"
                                       class="block text-gray-700 text-sm font-bold mb-2">کد ملی*:</label>
                                <input type="text" autocomplete="off" required id="national_code" name="national_code"
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                       placeholder="کد ملی صاحب اثر را وارد کنید">
                            </div>
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="mobile"
                                       class="block text-gray-700 text-sm font-bold mb-2">شماره همراه*:</label>
                                <input type="text" autocomplete="off" required id="mobile" name="mobile"
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                       placeholder="شماره همراه صاحب اثر را وارد کنید">
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="gender"
                                       class="block text-gray-700 text-sm font-bold mb-2">جنسیت*:</label>
                                <select id="gender" required class="border rounded-md w-full px-3 py-2 "
                                        name="gender">
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    <option value="مرد">مرد</option>
                                    <option value="زن">زن</option>
                                </select>
                            </div>
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label for="howzah_code"
                                       class="block text-gray-700 text-sm font-bold mb-2">شماره پرونده
                                    حوزوی*:</label>
                                <input type="text" id="howzah_code" name="howzah_code" required
                                       autocomplete="off"
                                       class="border rounded-md w-full mb-4 px-3 py-2 text-right"
                                       placeholder="شماره پرونده حوزوی را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                            ثبت صاحب اثر جدید
                        </button>
                        <a href="{{url()->previous()}}">
                            <button id="backward_page" type="button"
                                    class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                بازگشت
                            </button>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </main>
@endsection
