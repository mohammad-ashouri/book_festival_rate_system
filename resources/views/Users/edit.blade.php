@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">ویرایش کاربر</h1>
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
                {!! Form::model($user, ['method' => 'PATCH','id'=>'edit-user','route' => ['Users.update', $user->id]]) !!}
                @csrf
                <div class="flex bg-white px-6 py-2 mt-4">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">نام*:</label>
                        <input type="text" autocomplete="off" required id="first_name" name="first_name"
                               value="{{$user->generalInformationInfo->first_name}}"
                               class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                               placeholder="نام را وارد کنید">
                    </div>
                    <div class="flex-1 flex-col items-right">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">نام خانوادگی*:</label>
                        <input type="text" autocomplete="off" required id="last_name" name="last_name"
                               value="{{$user->generalInformationInfo->last_name}}"
                               class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                               placeholder="نام خانوادگی را وارد کنید">
                    </div>
                </div>
                <div class="flex bg-white px-6 py-2">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">نام کاربری*:</label>
                        <input type="text" autocomplete="off" required id="username" name="username"
                               value="{{$user->username}}" class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                               placeholder="نام را وارد کنید">
                    </div>
                    <div class="flex-1 flex-col items-right">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">رمز عبور*:</label>
                        <input type="text" minlength="8" maxlength="24" autocomplete="off" id="password" name="password"
                               class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                               placeholder="در صورت نیاز به تغییر، فیلد را وارد کنید در غیر اینصورت خالی بگذارید">
                    </div>
                </div>
                <div class="flex bg-white px-6 py-2">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="type"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">نوع کاربری*:</label>
                        <select id="type"
                                class="border rounded-md w-full px-3 py-2"
                                name="type">
                            <option @if($user->type==1) selected @endif value="1">ادمین کل</option>
                            <option @if($user->type==2) selected @endif value="2">کارشناس سامانه</option>
                            <option @if($user->type==3) selected @endif value="3">مدیر گروه</option>
                            <option @if($user->type==4) selected @endif value="4">ارزیاب</option>
                            <option @if($user->type==5) selected @endif value="5">کارشناس گونه بندی</option>
                            <option @if($user->type==6) selected @endif value="6">نویسنده</option>
                        </select>
                    </div>
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="status"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">وضعیت*:</label>
                        <select id="status"
                                class="border rounded-md w-full px-3 py-2"
                                name="status">
                            <option @if($user->status==1) selected @endif value="1">فعال</option>
                            <option @if($user->status==0) selected @endif value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>
                <div class="flex bg-white px-6 py-2">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="ntcp"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">نیازمند تغییر رمز
                            عبور*:</label>
                        <select id="ntcp"
                                class="border rounded-md w-full px-3 py-2"
                                name="ntcp">
                            <option @if($user->NTCP==1) selected @endif value="1">می باشد</option>
                            <option @if($user->NTCP==0) selected @endif value="0">نمی باشد</option>
                        </select>
                    </div>
                    <div class="flex-1 flex-col items-right ml-3 ">
                        <label for="user_image"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">تصویر پروفایل*:</label>
                        @if($user->user_image)
                            @php
                                $src=substr($user->user_image,6);
                                $src='storage'.$src;
                            @endphp
                            <div class="text-center w-full">
                                <a href="{{ env('APP_URL').'/'.$src }}" target="_blank">
                                    <div
                                        style="background: url({{ env('APP_URL').'/'.$src }}) no-repeat; background-size: cover;"
                                        class="w-32 h-32 ">
                                    </div>
                                </a>
                            </div>
                        @else
                            <div id="user_icon" class="w-32 h-32 rounded-full">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit"
                            class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                        ویرایش کاربر
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
