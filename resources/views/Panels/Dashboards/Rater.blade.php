@php use App\Models\Person; @endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72 mb-6">
            <h1 class="text-2xl font-bold mb-4">صفحه اصلی</h1>
            <div class="bg-white rounded shadow p-6">
                <p>
                    به پنل سامانه کتاب سال حوزه خوش آمدید.
                </p>
            </div>
        </div>
        @if( count($summaryRates) > 0 )
            <div class="mx-auto lg:mr-72 mb-6">
                <h1 class="text-2xl font-bold mb-4">فهرست آثار در حال ارزیابی اجمالی</h1>
                <div class="bg-white rounded shadow p-6">
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">ردیف</th>
                            <th class=" px-6 py-3  font-bold ">نام اثر</th>
                            <th class=" px-3 py-3  font-bold ">قالب اثر</th>
                            <th class=" px-3 py-3  font-bold ">نوع اثر</th>
                            <th class=" px-3 py-3  font-bold ">مولف</th>
                            <th class=" px-3 py-3  font-bold ">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($summaryRates as $rate)
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $loop->iteration  }}</td>
                                <td class="px-6 py-4">{{ $rate->postInfo->title  }}</td>
                                <td class="px-6 py-4">{{ $rate->postInfo->post_format  }}</td>
                                <td class="px-6 py-4">{{ $rate->postInfo->post_type  }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $personInfo=Person::find($rate->postInfo->person_id)
                                    @endphp
                                    {{ $personInfo->name . ' ' . $personInfo->family  }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/Rate/Summary/{{ $rate->id }}">
                                        <button type="button"
                                                class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                            ثبت ارزیابی
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @elseif( count($detailedRates) > 0 )
            <div class="mx-auto lg:mr-72">
                <h1 class="text-2xl font-bold mb-4">فهرست آثار در حال ارزیابی تفصیلی</h1>
                <div class="bg-white rounded shadow p-6">

                </div>
            </div>
        @else
            <div class="mx-auto lg:mr-72">
                <div class="bg-white rounded shadow p-6">
                    شما هیچ اثری برای ارزیابی ندارید!
                </div>
            </div>
        @endif
    </main>
@endsection

