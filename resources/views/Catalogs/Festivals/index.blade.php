@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">تعاریف اولیه - مدیریت بر اطلاعات دوره های همایش</h1>
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

            <div class="bg-white rounded shadow p-6 flex flex-col ">
                <a href="{{route('Festivals.create')}}">
                    <button type="button"
                            class="px-4 py-2 bg-green-500 w-32 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                        همایش جدید
                    </button>
                </a>
                <div class="mt-4 mb-4 flex items-center">
                </div>

                {{--                <div class=" mb-4 flex items-center">--}}
                {{--                    <label for="search-brand-catalog-code" class="block font-bold text-gray-700">جستجو در ناشران:</label>--}}
                {{--                    <input id="search-brand-catalog-name" autocomplete="off"--}}
                {{--                           placeholder="نام ناشران را وارد نمایید."--}}
                {{--                           type="text" name="search-brand-catalog-name"--}}
                {{--                           class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>--}}
                {{--                </div>--}}
                <table class="w-full border-collapse rounded-lg overflow-hidden text-center datasheet">
                    <thead>
                    <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                        <th class="px-6 py-3  font-bold ">ردیف</th>
                        <th class="px-6 py-3  font-bold ">کد</th>
                        <th class="px-6 py-3  font-bold ">عنوان همایش</th>
                        <th class="px-6 py-3  font-bold ">تاریخ شروع</th>
                        <th class="px-6 py-3  font-bold ">تاریخ پایان</th>
                        <th class="px-6 py-3  font-bold ">وضعیت</th>
                        <th class="px-6 py-3  font-bold ">عملیات</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                    @foreach ($festivals as $festival)
                        <tr class="bg-white">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $festival->id }}</td>
                            <td class="px-6 py-4">{{ $festival->name }}</td>
                            <td class="px-6 py-4">{{ $festival->start_date }}</td>
                            <td class="px-6 py-4">{{ $festival->end_date }}</td>
                            <td class="px-6 py-4">
                                @if($festival->active==1)
                                    فعال
                                @else
                                    غیرفعال
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('Festivals.edit',$festival->id)}}">
                                    <button type="button"
                                            class="px-4 py-2 mr-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 BrandControl">
                                        جزئیات و ویرایش
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div dir="ltr" class="mt-4 flex justify-center">
                    {{ $festivals->links() }}
                </div>
            </div>

        </div>
    </main>
@endsection
