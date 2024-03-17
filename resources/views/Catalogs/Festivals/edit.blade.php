@php use Morilog\Jalali\Jalalian; @endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">ویرایش دوره همایش</h1>
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
                {!! Form::model($festival, ['method' => 'PATCH','id'=>'edit-festival','route' => ['Festivals.update', $festival->id]]) !!}
                @csrf
                <div class="flex bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="name"
                               class="block text-gray-700 text-sm font-bold mb-2">نام ناشر*:</label>
                        <input type="text" autocomplete="off" required id="name" name="name"
                               value="{{$festival->name}}"
                               class="border rounded-md w-full px-3 py-2 text-right"
                               placeholder="نام ناشر را وارد کنید">
                    </div>
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="status"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">وضعیت*:</label>
                        <select id="status"
                                class="border rounded-md w-full px-3 py-2"
                                name="status">
                            <option @if($festival->status==1) selected @endif value="1">فعال</option>
                            <option @if($festival->status==0) selected @endif value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>
                <div class="flex bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex-1 flex-col items-right mb-2 ml-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تاریخ شروع*:</label>
                        <div class="flex-1 flex-col items-right ml-3">
                            <select id="start_day" class="border rounded-md px-3 py-2"
                                    name="start_day">
                                <option value="" disabled selected>روز</option>
                                @for($a=01;$a<=31;$a++)
                                    <option @if(Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->start_date))->getDay()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                            <select id="start_month" class="border rounded-md px-3 py-2"
                                    name="start_month">
                                <option value="" disabled selected>ماه</option>
                                @for($a=01;$a<=12;$a++)
                                    <option @if(Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->start_date))->getMonth()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                            <select id="start_year" class="border rounded-md px-3 py-2"
                                    name="start_year">
                                <option value="" disabled selected>سال</option>
                                @for($a=1402;$a<=1420;$a++)
                                    <option @if(Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->start_date))->getYear()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="flex-1 flex-col items-right mb-2 ml-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تاریخ پایان*:</label>
                        <div class="flex-1 flex-col items-right ml-3">
                            <select id="finish_day" class="border rounded-md px-3 py-2"
                                    name="finish_day">
                                <option value="" disabled selected>روز</option>
                                @for($a=01;$a<=31;$a++)
                                    <option @if(isset($festival->finish_date) and Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->finish_date))->getDay()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                            <select id="finish_month" class="border rounded-md px-3 py-2"
                                    name="finish_month">
                                <option value="" disabled selected>ماه</option>
                                @for($a=01;$a<=12;$a++)
                                    <option @if(isset($festival->finish_date) and Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->finish_date))->getMonth()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                            <select id="finish_year" class="border rounded-md px-3 py-2"
                                    name="finish_year">
                                <option value="" disabled selected>سال</option>
                                @for($a=1402;$a<=1420;$a++)
                                    <option @if(isset($festival->finish_date) and Jalalian::fromCarbon(\Carbon\Carbon::parse($festival->finish_date))->getYear()==$a) selected @endif value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input type="hidden" name="id" value="{{$festival->id}}">
                    <button type="submit"
                            class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                        ویرایش
                    </button>
                    <a href="{{url()->previous()}}">
                        <button id="backward_page" type="button"
                                class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                            بازگشت
                        </button>
                    </a>
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </main>
@endsection
