@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">مدیریت صاحب اثر</h1>
            <div class="flex">
                <a href="{{route('Person.create')}}">
                    <button id="new-person-button" type="button"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                        صاحب اثر جدید
                    </button>
                </a>
            </div>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <div class=" mb-4 flex w-full">
                    {{--                    <label for="search-Username-UserManager" class="block mt-3 text-sm font-bold text-gray-700">جستجو در--}}
                    {{--                        کد--}}
                    {{--                        صاحب اثری:</label>--}}
                    {{--                    <input id="search-Username-UserManager" autocomplete="off"--}}
                    {{--                           placeholder="لطفا کد صاحب اثری را وارد نمایید."--}}
                    {{--                           type="text" name="search-Username-UserManager"--}}
                    {{--                           class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>--}}
                    {{--                    <label for="search-type-UserManager"--}}
                    {{--                           class="block text-gray-700 text-sm font-bold mt-3 ">جستجو در نقش--}}
                    {{--                        صاحب اثری:</label>--}}
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
                            <th class=" px-6 py-3  font-bold ">نام</th>
                            <th class=" px-3 py-3  font-bold ">نام خانوادگی</th>
                            <th class=" px-3 py-3  font-bold ">کد ملی</th>
                            <th class=" px-3 py-3  font-bold ">شماره همراه</th>
                            <th class=" px-3 py-3  font-bold ">جنسیت</th>
                            <th class=" px-3 py-3  font-bold ">شماره پرونده حوزوی</th>
                            <th class=" px-3 py-3  font-bold ">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($personList as $person)
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $loop->iteration  }}</td>
                                <td class="px-6 py-4">{{ $person->generalInformationInfo->first_name }}</td>
                                <td class="px-6 py-4">{{ $person->generalInformationInfo->last_name }}</td>
                                <td class="px-3 py-4">{{ $person->generalInformationInfo->national_code }}</td>
                                <td class="px-3 py-4">{{ $person->generalInformationInfo->mobile }}</td>
                                <td class="px-3 py-4">{{ $person->generalInformationInfo->gender }}</td>
                                <td class="px-3 py-4">{{ $person->generalInformationInfo->howzah_code }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{route('Person.edit',$person->id)}}">
                                        <button type="button"
                                                class="px-4 py-2 mr-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 PersonControl">
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
                    {{ $personList->links() }}
                </div>

            </div>

        </div>
    </main>
@endsection
