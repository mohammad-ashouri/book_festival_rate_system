@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">اختصاص اثر به ارزیاب اجمالی</h1>
            <div class="bg-white rounded shadow p-6">
                @if($summaries->count()>0)
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">ردیف</th>
                            <th class=" px-6 py-3  font-bold ">کد اثر</th>
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
                            <tr class="bg-white">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $post->postInfo->id }}</td>
                                <td class="px-6 py-4">
                                    @if($post->postInfo->file_src)
                                        <a class="text-blue-500" href="
                            @php
                                echo str_replace('public','storage',$post->postInfo->file_src)
                            @endphp
                            ">
                                            {{ $post->postInfo->title }}
                                        </a>
                                    @else
                                        {{ $post->postInfo->title }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $post->postInfo->post_format  }}</td>
                                @php $languageInfo=\App\Models\Catalogs\Language::find($post->postInfo->language) @endphp
                                <td class="px-6 py-4">{{ $languageInfo->name }}</td>
                                @php $ScientificGroup1Info=\App\Models\Catalogs\ScientificGroup::find($post->postInfo->scientific_group_v1) @endphp
                                <td class="px-6 py-4">{{ $ScientificGroup1Info->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($post->postInfo->scientific_group_v2)
                                        @php $ScientificGroup2Info=\App\Models\Catalogs\ScientificGroup::find($post->postInfo->scientific_group_v2) @endphp
                                        {{ $ScientificGroup2Info->name }}
                                    @endif
                                </td>
                                @php $personInfo=\App\Models\Person::find($post->postInfo->person_id) @endphp
                                <td class="px-6 py-4">{{ $personInfo->name . ' ' . $personInfo->family  }}</td>
                                <td class="text-center">
                                    @if($post->sg1_form_type!=='Waiting For Header')
                                        <div class="mb-3 mt-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                اول
                                                @if($post->s1g1_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater1Group1"
                                                    @if($post->s1g1_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s1g1rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                دوم
                                                @if($post->s2g1_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater2Group1"
                                                    @if($post->s2g1_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s2g1rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                سوم
                                                @if($post->s3g1_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater3Group1"
                                                    @if($post->s3g1_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s3g1rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if($post->postInfo->scientific_group_v2 and $post->sg2_form_type!=='Waiting For Header')
                                        <div class="mb-3 mt-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                اول
                                                @if($post->s1g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater1Group2"
                                                    @if($post->s1g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s1g2rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                دوم
                                                @if($post->s2g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater2Group2"
                                                    @if($post->s2g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s2g2rater ) selected
                                                            @endif
                                                            value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                                سوم
                                                @if($post->s3g2_status===1)
                                                    (تکمیل)
                                                @endif
                                            </label>
                                            <select data-postid="{{ $post->postInfo->id }}"
                                                    data-work="ChangeRater3Group2"
                                                    @if($post->s3g2_status===1) disabled @endif
                                                    class="border rounded-md w-full px-3 py-2 SetSummaryRater">
                                                <option value="" selected>بدون ارزیاب</option>
                                                @php
                                                    $raters=\App\Models\User::whereIn('type', [3, 4])->where('scientific_group',$post->postInfo->scientific_group_v2)->orderBy('name','asc')->get();
                                                @endphp
                                                @foreach($raters as $rater)
                                                    <option @if ( $rater->id==$post->s3g2rater ) selected
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
                    اثری برای ارزیابی وجود ندارد
                @endif
            </div>
            <div dir="ltr" class="mt-4 flex justify-center" id="laravel-next-prev">
                {{ $summaries->links() }}
            </div>
        </div>
    </main>
@endsection

