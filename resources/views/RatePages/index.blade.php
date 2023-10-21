@php use App\Models\Catalogs\ScientificGroup;use App\Models\Person; @endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72 mb-6">
            <h1 class="text-2xl font-bold mb-4">ثبت ارزیابی اجمالی</h1>
            <div class="bg-white rounded shadow p-6">
                <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                    <thead>
                    <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                        <th class=" px-6 py-3  font-bold ">عنوان اثر</th>
                        <th class=" px-3 py-3  font-bold ">پدید آورنده</th>
                        <th class=" px-3 py-3  font-bold ">گروه اول</th>
                        <th class=" px-3 py-3  font-bold ">گروه دوم</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                    <tr class="bg-white">
                        <td class="px-6 py-4">{{ $summaryRate->postInfo->title  }}</td>
                        <td class="px-6 py-4">
                            @php
                                $personInfo=Person::find($summaryRate->postInfo->person_id)
                            @endphp
                            {{ $personInfo->name . ' ' . $personInfo->family  }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $group1Info=ScientificGroup::find($summaryRate->postInfo->scientific_group_v1)
                            @endphp
                            {{ $group1Info->name }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $group2Info=ScientificGroup::find($summaryRate->postInfo->scientific_group_v2)
                            @endphp
                            {{ $group2Info->name }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="font-bold">
                    یادآوری:
                </p>
                <p class="mt-2">
                    - جلسه ارزیابی اجمالی با 3 عضو رسمیت می یابد.
                </p>
                <p>
                    - ارزیاب محترم؛ نظر خود را به صورت عدد
                    <span class="font-bold underline">
                    4 برای عالی،
                    </span>
                    <span class="font-bold underline">
                    3 برای خوب،
                    </span>
                    <span class="font-bold underline">
                    2 برای متوسط،
                    </span>
                    <span class="font-bold underline">
                    1 برای ضعیف
                    </span>
                    ارائه فرمایید.
                </p>
            </div>
        </div>
    </main>
@endsection
