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
                        @if(($rateInfo->s1g1rater===$me and $rateInfo->s1g1_status==0) or ($rateInfo->s2g1rater===$me and $rateInfo->s2g1_status==0) or ($rateInfo->s3g1rater===$me and $rateInfo->s3g1_status==0))
                            @php
                                $summary1Info=null;
                                $summary2Info=null;
                                $summary3Info=null;
                                $rater1=\App\Models\User::find($rateInfo->s1g1rater);
                                $rater2=\App\Models\User::find($rateInfo->s2g1rater);
                                $rater3=\App\Models\User::find($rateInfo->s3g1rater);
                                if ($rater1){
                                $summary1Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater1->id)->first();
                                }
                                if ($rater2){
                                $summary2Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater2->id)->first();
                                }
                                if ($rater3){
                                $summary3Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rate_info_id',$rateInfo->id)->where('rater',$rater3->id)->first();
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
                        @elseif(($rateInfo->s1g2rater===$me and $rateInfo->s1g2_status==0) or ($rateInfo->s2g2rater===$me and $rateInfo->s2g2_status==0) or ($rateInfo->s3g2rater===$me and $rateInfo->s3g2_status==0))
                            @php
                                $summary1Info=null;
                                $summary2Info=null;
                                $summary3Info=null;
                                $rater1=\App\Models\User::find($rateInfo->s1g2rater);
                                $rater2=\App\Models\User::find($rateInfo->s2g2rater);
                                $rater3=\App\Models\User::find($rateInfo->s3g2rater);
                                if ($rater1){
                                $summary1Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rater',$rater1->id)->first();
                                }
                                if ($rater2){
                                $summary2Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rater',$rater2->id)->first();
                                }
                                if ($rater3){
                                $summary3Info=\App\Models\Rates\SummaryRate::with('rateInfo')->where('rater',$rater3->id)->first();
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
                        @if(($rateInfo->d1rater===$me and $rateInfo->d1_status==0) or ($rateInfo->d2rater===$me and $rateInfo->d2_status==0) or ($rateInfo->d3rater===$me and $rateInfo->d3_status==0))
                            @switch($rateInfo->d_form_type)
                                @case('پایان نامه')
                                    @include('RatePages.Forms.Detailed.payanname')
                                    @break
                                @case('ترجمه')
                                    @include('RatePages.Forms.Detailed.tarjome')
                                    @break
                                @case('علمی پژوهشی')
                                    @include('RatePages.Forms.Detailed.pazhuheshi')
                                    @break
                                @case('علمی ترویجی')
                                    @include('RatePages.Forms.Detailed.tarviji')
                                    @break
                                @case('فرهنگی تبلیغی')
                                    @include('RatePages.Forms.Detailed.tablighi')
                                    @break
                                @case('تصحیح و تحقیق')
                                    @include('RatePages.Forms.Detailed.tashihtahghigh')
                                    @break
                                @case('کتابشناسی و فهرست نگاری')
                                    @include('RatePages.Forms.Detailed.ketabshenasi')
                                    @break
                                @case('داستان جوان')
                                    @include('RatePages.Forms.Detailed.dastanjavan')
                                    @break
                                @case('ادبیات کودک و نوجوان')
                                    @include('RatePages.Forms.Detailed.adabiatkoodaknojavan')
                                    @break
                            @endswitch
                            <table class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
                                <tr>
                                    <td class="px-6 py-1 bg-gray-500 w-44 text-white" colspan="1">اظهار نظر کلی داور
                                        محترم
                                    </td>
                                </tr>
                                {{--    اظهار نظر کلی داور محترم 1--}}
                                <tr class="items-center text-right ">
                                    <td class="px-6 py-1 bg-gray-300 font-bold" colspan="4">
                                        <p>1- به نظر شما این اثر، شرایط لازم را برای معرفی «اثر برتر یا شایسته تقدیر یا
                                            شایسته تحسین کتاب سال حوزه»
                                            دارد؟</p>
                                    </td>
                                </tr>
                                <tr class="items-center text-center ">
                                    <td class="px-6 py-1 bg-gray-300" colspan="4">
                                        <textarea name="general_comment1" id="general_comment1"
                                                  placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                                                  class="border rounded-md w-full px-3 py-2"></textarea>
                                    </td>
                                </tr>
                                {{--    اظهار نظر کلی داور محترم 2--}}
                                <tr class="items-center text-right ">
                                    <td class="px-6 py-1 bg-gray-300 font-bold" colspan="4">
                                        <p>2- با توجه به اهمیت همسویی آثار مولفان با ارزش ها و سنتهای حوزوی و انقلاب
                                            اسلامی، چنانچه از این جهت نقطه
                                            نظری دارید مرقوم بفرمایید</p>
                                    </td>
                                </tr>
                                <tr class="items-center text-center ">
                                    <td class="px-6 py-1 bg-gray-300" colspan="4">
                                        <textarea name="general_comment2" id="general_comment2"
                                                  placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                                                  class="border rounded-md w-full px-3 py-2"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $("#special_section").CreateMultiCheckBox({
                                        width: '250px',
                                        defaultText: 'انتخاب کنید',
                                        height: '170px',
                                        backgroundColor: 'whitesmoke',
                                    });
                                    $(document).on("click", ".MultiCheckBox", function () {
                                        var detail = $(this).next();
                                        detail.show();
                                    });

                                    $(document).on("click", ".MultiCheckBoxDetailHeader input", function (e) {
                                        e.stopPropagation();
                                        var hc = $(this).prop("checked");
                                        $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", hc);
                                        $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
                                    });

                                    $(document).on("click", ".MultiCheckBoxDetailHeader", function (e) {
                                        var inp = $(this).find("input");
                                        var chk = inp.prop("checked");
                                        inp.prop("checked", !chk);
                                        $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", !chk);
                                        $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
                                    });

                                    $(document).on("click", ".MultiCheckBoxDetail .cont input", function (e) {
                                        e.stopPropagation();
                                        $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

                                        var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                                        $(".MultiCheckBoxDetailHeader input").prop("checked", val);
                                    });

                                    $(document).on("click", ".MultiCheckBoxDetail .cont", function (e) {
                                        var inp = $(this).find("input");
                                        var chk = inp.prop("checked");
                                        inp.prop("checked", !chk);

                                        var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
                                        var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
                                        multiCheckBoxDetail.next().UpdateSelect();

                                        var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                                        $(".MultiCheckBoxDetailHeader input").prop("checked", val);
                                    });

                                    $(document).mouseup(function (e) {
                                        var container = $(".MultiCheckBoxDetail");
                                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                                            container.hide();
                                        }
                                    });
                                });

                                var defaultMultiCheckBoxOption = {
                                    width: '220px',
                                    defaultText: 'انتخاب کنید',
                                    height: '200px',
                                    backgroundColor: 'whitesmoke'
                                };

                                jQuery.fn.extend({
                                    CreateMultiCheckBox: function (options) {

                                        var localOption = {};
                                        localOption.width = (options != null && options.width != null && options.width != undefined) ? options.width : defaultMultiCheckBoxOption.width;
                                        localOption.defaultText = (options != null && options.defaultText != null && options.defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption.defaultText;
                                        localOption.height = (options != null && options.height != null && options.height != undefined) ? options.height : defaultMultiCheckBoxOption.height;
                                        localOption.backgroundColor = (options != null && options.backgroundColor != null && options.backgroundColor != undefined) ? options.backgroundColor : defaultMultiCheckBoxOption.backgroundColor;

                                        this.hide();
                                        this.attr("multiple", "multiple");
                                        var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText + "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>").insertBefore(this);
                                        divSel.css({"width": localOption.width});

                                        var detail = $("<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>انتخاب تمامی موارد</div></div><div class='MultiCheckBoxDetailBody'></div></div>").insertAfter(divSel);
                                        detail.css({
                                            "width": parseInt(options.width) + 10,
                                            "max-height": localOption.height
                                        });
                                        var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

                                        this.find("option").each(function () {
                                            var val = $(this).attr("value");

                                            if (val == undefined)
                                                val = '';

                                            multiCheckBoxDetailBody.append("<div class='cont'><div><input type='checkbox' class='mulinput' value='" + val + "' /></div><div>" + $(this).text() + "</div></div>");
                                        });

                                        multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css("max-height")) - 28) + "px");
                                    },
                                    UpdateSelect: function () {
                                        var arr = [];

                                        this.prev().find(".mulinput:checked").each(function () {
                                            arr.push($(this).val());
                                        });

                                        this.val(arr);
                                    },
                                });
                            </script>
                            <div id="submitRate" class="flex mt-3 text-center">
                                <label class="font-bold">
                                    محور ویژه را در صورت نیاز تعیین نمایید:
                                </label>
                                <select id="special_section" class="border rounded-md w-56 px-3 py-2 text-right"
                                        name="special_section[]">
                                    @foreach($specialSections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-left mt-3">
                                <button type="submit"
                                        class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                    ثبت ارزیابی
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        @elseif($assessmentStatus==='Formal literary')
            <form id="FormalLiteraryAssessmentSet">
                <input type="hidden" name="rateInfoID" value="{{ $rateInfo->id }}">
                <input type="hidden" name="rateType" value="fl">
                <div class="mx-auto lg:mr-72 mb-6">
                    <h1 class="text-2xl font-bold mb-4">ثبت ارزیابی ادبی صوری</h1>
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
                        @if($rateInfo->formal_literary_rater===$me)
                            @include('RatePages.Forms.Formal_literary')
                            <div id="submitRate" class="flex mt-3 text-center">
                            </div>
                            <div class="text-left mt-3">
                                <button type="submit"
                                        class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                    ثبت ارزیابی
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        @endif
    </main>
@endsection
