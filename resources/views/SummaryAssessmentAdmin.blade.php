@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">اختصاص اثر به ارزیاب اجمالی</h1>
            <div class="bg-white rounded shadow p-6">
                @if($summaries)
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">ردیف</th>
                            <th class=" px-6 py-3  font-bold ">نام اثر</th>
                            <th class=" px-6 py-3  font-bold ">قالب علمی</th>
                            <th class=" px-6 py-3  font-bold ">زبان</th>
                            <th class=" px-6 py-3  font-bold ">گروه علمی اول</th>
                            <th class=" px-6 py-3  font-bold ">گروه علمی دوم</th>
                            <th class=" px-3 py-3  font-bold ">نام نویسنده</th>
                            <th class=" px-3 py-3  font-bold ">ارزیابان گروه اول</th>
                            <th class=" px-3 py-3  font-bold ">ارزیابان گروه دوم</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($summaries as $post)
                            @php
                                $postInfo=\App\Models\Post::find($post->post_id);
                                $rateInfo=\App\Models\RateInfo::where('post_id','=',$postInfo->id)->first();
                            @endphp
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    @if($postInfo->file_src)
                                        <a class="text-blue-500" href="
                            @php
                                echo str_replace('public','storage',$postInfo->file_src)
                            @endphp
                            ">
                                            {{ $postInfo->title }}
                                        </a>
                                    @else
                                        {{ $postInfo->title }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $postInfo->post_format  }}</td>
                                @php $languageInfo=\App\Models\Catalogs\Language::find($postInfo->language) @endphp
                                <td class="px-6 py-4">{{ $languageInfo->name }}</td>
                                @php $ScientificGroup1Info=\App\Models\Catalogs\ScientificGroup::find($postInfo->scientific_group_v1) @endphp
                                <td class="px-6 py-4">{{ $ScientificGroup1Info->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($postInfo->scientific_group_v2)
                                        @php $ScientificGroup2Info=\App\Models\Catalogs\ScientificGroup::find($postInfo->scientific_group_v2) @endphp
                                        {{ $ScientificGroup2Info->name }}
                                    @endif
                                </td>
                                @php $personInfo=\App\Models\Person::find($postInfo->person_id) @endphp
                                <td class="px-6 py-4">{{ $personInfo->name . ' ' . $personInfo->family  }}</td>
                                <td class="text-center">
                                    <div class="mb-3 mt-3">
                                        <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                            اول
                                            @if($rateInfo->s1g1_status===1)
                                                (تکمیل)
                                            @endif
                                        </label>
                                        <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater1Group1"
                                                @if($rateInfo->s1g1_status===1) disabled @endif
                                                class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                            <option value="" selected>بدون ارزیاب</option>
                                            @php
                                                $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                            @endphp
                                            @foreach($raters as $rater)
                                                <option @if ( $rater->id==$rateInfo->s1g1rater ) selected
                                                        @endif
                                                        value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                            دوم
                                            @if($rateInfo->s2g1_status===1)
                                                (تکمیل)
                                            @endif
                                        </label>
                                        <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater2Group1"
                                                @if($rateInfo->s2g1_status===1) disabled @endif
                                                class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                            <option value="" selected>بدون ارزیاب</option>
                                            @php
                                                $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                            @endphp
                                            @foreach($raters as $rater)
                                                <option @if ( $rater->id==$rateInfo->s2g1rater ) selected
                                                        @endif
                                                        value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                            سوم
                                            @if($rateInfo->s3g1_status===1)
                                                (تکمیل)
                                            @endif
                                        </label>
                                        <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater3Group1"
                                                @if($rateInfo->s3g1_status===1) disabled @endif
                                                class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                            <option value="" selected>بدون ارزیاب</option>
                                            @php
                                                $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                            @endphp
                                            @foreach($raters as $rater)
                                                <option @if ( $rater->id==$rateInfo->s3g1rater ) selected
                                                        @endif
                                                        value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    @if($postInfo->scientific_group_v2)
                                        <div class="mb-3 mt-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                اول
                                                @if($rateInfo->s1g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater1Group2"
                                                    @if($rateInfo->s1g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$rateInfo->s1g2rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                دوم
                                                @if($rateInfo->s2g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater2Group2"
                                                    @if($rateInfo->s2g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$rateInfo->s2g2rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                سوم
                                                @if($rateInfo->s3g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $postInfo->id }}" data-work="ChangeRater3Group2"
                                                    @if($rateInfo->s3g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::where('type',4)->where('scientific_group',$postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$rateInfo->s3g2rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    nothing to show
                @endif
            </div>
            <div dir="ltr" class="mt-4 flex justify-center" id="laravel-next-prev">
                {{ $summaries->links() }}
            </div>
        </div>
    </main>
@endsection

