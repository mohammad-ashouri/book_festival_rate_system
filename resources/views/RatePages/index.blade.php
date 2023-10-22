@php
    $me=session('id');
    use App\Models\Catalogs\ScientificGroup;
    use App\Models\Person;
@endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <form id="SummaryAssessmentSet">
            <input type="hidden" name="rateInfoID" value="{{ $summaryRate->id }}">
            <div class="mx-auto lg:mr-72 mb-6">
                <h1 class="text-2xl font-bold mb-4">ثبت ارزیابی اجمالی</h1>
                <div class="bg-white rounded shadow p-6">
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-1 font-bold ">عنوان اثر</th>
                            <th class=" px-3 py-1 font-bold ">پدید آورنده</th>
                            <th class=" px-3 py-1 font-bold ">گروه اول</th>
                            <th class=" px-3 py-1 font-bold ">گروه دوم</th>
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
                                {{ @$group2Info->name }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="font-bold">
                        یادآوری:
                    </p>
                    <p class="mt-2">
                        - با کلیک بر روی نام اثر، در صورت وجود فایل میتوانید اثر را مشاهده کنید.
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
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
                        <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center border-b-2">
                            <th class="px-6 py-1 w-5 font-bold ">تعیین نوع اثر</th>
                            <th class="px-6 py-1 w-5 font-bold ">ارتباط اثر با گروه حاضر</th>
                        </tr>
                        <tr class="items-center text-center ">
                            <td class="px-6 py-1 bg-gray-300">
                                <select id="type" class="border rounded-md w-56 px-3 py-2"
                                        name="type">
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    <option value="علمی پژوهشی">علمی پژوهشی</option>
                                    <option value="علمی ترویجی">علمی ترویجی</option>
                                    <option value="فرهنگی تبلیغی">فرهنگی تبلیغی</option>
                                    @if($summaryRate->postInfo->post_format!=='پایان نامه')
                                        <option value="تقریر">تقریر</option>
                                    @endif
                                </select>
                            </td>
                            <td class="px-6 py-1 bg-gray-300">
                                <select id="connectionWithGroup" class="border rounded-md w-80 px-3 py-2"
                                        name="connectionWithGroup">
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    <option value="اثر مربوط به گروه حاضر است">اثر مربوط به گروه حاضر است</option>
                                    <option value="اثر میان رشته ای است">اثر میان رشته ای است (گروه مرتبط تعیین شود)
                                    </option>
                                    <option value="اثر مربوط به گروه حاضر نیست">اثر مربوط به گروه حاضر نیست (گروه مرتبط
                                        تعیین شود)
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    @if($summaryRate->postInfo->post_format==='پایان نامه')
                        @include('RatePages.Forms.Summary.payanname')
                    @endif
                </div>
            </div>
        </form>
    </main>
@endsection
