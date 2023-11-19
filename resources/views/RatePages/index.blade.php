@php
    $me=session('id');
    use App\Models\Catalogs\ScientificGroup;
    use App\Models\Person;
@endphp
@extends('layouts.PanelMaster')
@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        @if($assessmentStatus==='Summary')
        <form id="SummaryAssessmentSet">
            <input type="hidden" name="rateInfoID" value="{{ $rateInfo->id }}">
            <input type="hidden" name="rateType" value="
                @if($rateInfo->s1g1rater===$me)
                s1g1
                @elseif($rateInfo->s2g1rater===$me)
                s2g1
                @elseif($rateInfo->s3g1rater===$me)
                s3g1
                @elseif($rateInfo->s1g2rater===$me)
                s1g2
                @elseif($rateInfo->s2g2rater===$me)
                s2g2
                @elseif($rateInfo->s3g2rater===$me)
                s3g2
                @endif
            ">
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
                            <td class="px-6 py-4">{{ $rateInfo->postInfo->title  }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $personInfo=Person::find($rateInfo->postInfo->person_id)
                                @endphp
                                {{ $personInfo->name . ' ' . $personInfo->family  }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $group1Info=ScientificGroup::find($rateInfo->postInfo->scientific_group_v1)
                                @endphp
                                {{ $group1Info->name }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $group2Info=ScientificGroup::find($rateInfo->postInfo->scientific_group_v2)
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
                    @if($rateInfo->s1g1rater===$me or $rateInfo->s2g1rater===$me or $rateInfo->s3g1rater===$me)
                        @php
                            $summary1Info=null;
                            $summary2Info=null;
                            $summary3Info=null;
                            $rater1=\App\Models\User::find($rateInfo->s1g1rater);
                            $rater2=\App\Models\User::find($rateInfo->s2g1rater);
                            $rater3=\App\Models\User::find($rateInfo->s3g1rater);
                            if ($rater1){
                            $summary1Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater1->id)->first();
                            }
                            if ($rater2){
                            $summary2Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater2->id)->first();
                            }
                            if ($rater3){
                            $summary3Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater3->id)->first();
                            }
                        @endphp
                        @switch($rateInfo->sg1_form_type)
                            @case('پایان نامه')
                                @include('RatePages.Forms.Summary.payanname')
                                @break
                            @case('تقریر')
                                @include('RatePages.Forms.Summary.taghrir')
                                @break
                            @case('علمی پژوهشی')
                            @case('علمی ترویجی')
                                @include('RatePages.Forms.Summary.pazhuheshi-tarviji')
                                @break
                            @case('فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.tablighi')
                                @break
                            @case('ادبیات و هنر علمی پژوهشی')
                            @case('ادبیات و هنر علمی ترویجی')
                                @include('RatePages.Forms.Summary.adabiat-honar.pazhuheshi-tarviji')
                                @break
                            @case('ادبیات و هنر فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                @break
                            @case('کتب مرجع')
                                @include('RatePages.Forms.Summary.marja')
                                @break
                            @case('ترجمه')
                                @include('RatePages.Forms.Summary.tarjome')
                                @break
                            @case('تصحیح و تحقیق')
                                @include('RatePages.Forms.Summary.tashih')
                                @break
                            @case('تکنولوژی و آموزشی')
                                @include('RatePages.Forms.Summary.technology')
                                @break
                            @case('انقلاب اسلامی علمی پژوهشی')
                            @case('انقلاب اسلامی علمی ترویجی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.pazhuheshi-tarviji')
                                @break
                            @case('انقلاب اسلامی فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                @break
                        @endswitch
                    @elseif($rateInfo->s1g2rater===$me or $rateInfo->s2g2rater===$me or $rateInfo->s3g2rater===$me)
                        @php
                            $summary1Info=null;
                            $summary2Info=null;
                            $summary3Info=null;
                            $rater1=\App\Models\User::find($rateInfo->s1g2rater);
                            $rater2=\App\Models\User::find($rateInfo->s2g2rater);
                            $rater3=\App\Models\User::find($rateInfo->s3g2rater);
                            if ($rater1){
                            $summary1Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rater',$rater1->id)->first();
                            }
                            if ($rater2){
                            $summary2Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rater',$rater2->id)->first();
                            }
                            if ($rater3){
                            $summary3Info=\App\Models\Rates\SummaryRates::with('rateInfo')->where('rater',$rater3->id)->first();
                            }
                        @endphp
                        @switch($rateInfo->sg2_form_type)
                            @case('پایان نامه')
                                @include('RatePages.Forms.Summary.payanname')
                                @break
                            @case('تقریر')
                                @include('RatePages.Forms.Summary.taghrir')
                                @break
                            @case('علمی پژوهشی')
                            @case('علمی ترویجی')
                                @include('RatePages.Forms.Summary.pazhuheshi-tarviji')
                                @break
                            @case('فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.tablighi')
                                @break
                            @case('ادبیات و هنر علمی پژوهشی')
                            @case('ادبیات و هنر علمی ترویجی')
                                @include('RatePages.Forms.Summary.adabiat-honar.pazhuheshi-tarviji')
                                @break
                            @case('ادبیات و هنر فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                @break
                            @case('کتب مرجع')
                                @include('RatePages.Forms.Summary.marja')
                                @break
                            @case('ترجمه')
                                @include('RatePages.Forms.Summary.tarjome')
                                @break
                            @case('تصحیح و تحقیق')
                                @include('RatePages.Forms.Summary.tashih')
                                @break
                            @case('تکنولوژی و آموزشی')
                                @include('RatePages.Forms.Summary.technology')
                                @break
                            @case('انقلاب اسلامی علمی پژوهشی')
                            @case('انقلاب اسلامی علمی ترویجی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.pazhuheshi-tarviji')
                                @break
                            @case('انقلاب اسلامی فرهنگی تبلیغی')
                                @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                @break
                        @endswitch
                    @endif
                </div>
            </div>
        </form>
        @elseif($assessmentStatus==='Detailed')
            <form id="DetailedAssessmentSet">
                <input type="hidden" name="rateInfoID" value="{{ $rateInfo->id }}">
                <input type="hidden" name="rateType" value="
                @if($rateInfo->d1rater===$me)
                d1
                @elseif($rateInfo->d2rater===$me)
                d2
                @elseif($rateInfo->d3rater===$me)
                d3
                @endif
            ">
                <div class="mx-auto lg:mr-72 mb-6">
                    <h1 class="text-2xl font-bold mb-4">ثبت ارزیابی تفصیلی</h1>
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
                                <td class="px-6 py-4">{{ $rateInfo->postInfo->title  }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $personInfo=Person::find($rateInfo->postInfo->person_id)
                                    @endphp
                                    {{ $personInfo->name . ' ' . $personInfo->family  }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $group1Info=ScientificGroup::find($rateInfo->postInfo->scientific_group_v1)
                                    @endphp
                                    {{ $group1Info->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $group2Info=ScientificGroup::find($rateInfo->postInfo->scientific_group_v2)
                                    @endphp
                                    {{ @$group2Info->name }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if($rateInfo->d1rater===$me or $rateInfo->d2rater===$me or $rateInfo->d3rater===$me)
                            @switch($rateInfo->sg1_form_type)
                                @case('پایان نامه')
                                    @include('RatePages.Forms.Summary.payanname')
                                    @break
                                @case('تقریر')
                                    @include('RatePages.Forms.Summary.taghrir')
                                    @break
                                @case('علمی پژوهشی')
                                @case('علمی ترویجی')
                                    @include('RatePages.Forms.Summary.pazhuheshi-tarviji')
                                    @break
                                @case('فرهنگی تبلیغی')
                                    @include('RatePages.Forms.Summary.tablighi')
                                    @break
                                @case('ادبیات و هنر علمی پژوهشی')
                                @case('ادبیات و هنر علمی ترویجی')
                                    @include('RatePages.Forms.Summary.adabiat-honar.pazhuheshi-tarviji')
                                    @break
                                @case('ادبیات و هنر فرهنگی تبلیغی')
                                    @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                    @break
                                @case('کتب مرجع')
                                    @include('RatePages.Forms.Summary.marja')
                                    @break
                                @case('ترجمه')
                                    @include('RatePages.Forms.Summary.tarjome')
                                    @break
                                @case('تصحیح و تحقیق')
                                    @include('RatePages.Forms.Summary.tashih')
                                    @break
                                @case('تکنولوژی و آموزشی')
                                    @include('RatePages.Forms.Summary.technology')
                                    @break
                                @case('انقلاب اسلامی علمی پژوهشی')
                                @case('انقلاب اسلامی علمی ترویجی')
                                    @include('RatePages.Forms.Summary.enghelab-eslami.pazhuheshi-tarviji')
                                    @break
                                @case('انقلاب اسلامی فرهنگی تبلیغی')
                                    @include('RatePages.Forms.Summary.enghelab-eslami.tablighi')
                                    @break
                            @endswitch
                        @endif
                    </div>
                </div>
            </form>
        @endif
    </main>
@endsection
