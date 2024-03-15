@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">ویرایش زبان</h1>
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
                {!! Form::model($language, ['method' => 'PATCH','id'=>'edit-language','route' => ['Languages.update', $language->id]]) !!}
                @csrf
                <div class="flex bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="name"
                               class="block text-gray-700 text-sm font-bold mb-2">نام زبان*:</label>
                        <input type="text" autocomplete="off" required id="name" name="name"
                               value="{{$language->name}}"
                               class="border rounded-md w-full mb-2 px-3 py-2 text-right"
                               placeholder="نام زبان را وارد کنید">
                    </div>
                    <div class="flex-1 flex-col items-right ml-3">
                        <label for="status"
                               class="text-gray-700 text-sm font-bold whitespace-nowrap">وضعیت*:</label>
                        <select id="status"
                                class="border rounded-md w-full px-3 py-2"
                                name="status">
                            <option @if($language->status==1) selected @endif value="1">فعال</option>
                            <option @if($language->status==0) selected @endif value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input type="hidden" name="id" value="{{$language->id}}">
                    <button type="submit"
                            class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                        ویرایش ناشر
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
