@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">تعریف دوره همایش جدید</h1>
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
                <form id="new-publisher" method="post" action="{{route('Publishers.store')}}">
                    @csrf
                    <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex mt-4">
                            <div class="flex-1 flex-col items-right ml-3">
                                <label
                                       class="block text-gray-700 text-sm font-bold mb-2">کد همایش:</label>
                                <input type="text" disabled
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right bg-gray-200"
                                       value="{{$lastFestival->id+1}}">
                            </div>
                            <div class="flex-1 flex-col items-right ml-3">
                                <label for="name"
                                       class="block text-gray-700 text-sm font-bold mb-2">عنوان همایش*:</label>
                                <input type="text" autocomplete="off" id="name" name="name"
                                       class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                                       placeholder="عنوان همایش را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex">
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">تاریخ شروع*:</label>
                                <div class="flex-1 flex-col items-right mb-2 ml-3">
                                    <select id="start_day" class="border rounded-md px-3 py-2"
                                            name="start_day">
                                        <option value="" disabled selected>روز</option>
                                        @for($a=1;$a<=31;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                    <select id="start_month" class="border rounded-md px-3 py-2"
                                            name="start_month">
                                        <option value="" disabled selected>ماه</option>
                                        @for($a=1;$a<=12;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                    <select id="start_year" class="border rounded-md px-3 py-2"
                                            name="start_year">
                                        <option value="" disabled selected>سال</option>
                                        @for($a=1402;$a<=1420;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="flex-1 flex-col items-right mb-2 ml-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">تاریخ پایان*:</label>
                                <div class="flex-1 flex-col items-right mb-2 ml-3">
                                    <select id="end_day" class="border rounded-md px-3 py-2"
                                            name="end_day">
                                        <option value="" disabled selected>روز</option>
                                        @for($a=1;$a<=31;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                    <select id="end_month" class="border rounded-md px-3 py-2"
                                            name="end_month">
                                        <option value="" disabled selected>ماه</option>
                                        @for($a=1;$a<=12;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                    <select id="end_year" class="border rounded-md px-3 py-2"
                                            name="end_year">
                                        <option value="" disabled selected>سال</option>
                                        @for($a=1402;$a<=1420;$a++)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                            تعریف دوره
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
