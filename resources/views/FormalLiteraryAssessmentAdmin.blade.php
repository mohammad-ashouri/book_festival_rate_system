@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">اختصاص اثر به ارزیاب ادبی صوری</h1>
            <div class="bg-white rounded shadow p-6">
                @if($formalLiterary->count()>0)
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                        <thead>
                        <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                            <th class=" px-6 py-3  font-bold ">ردیف</th>
                            <th class=" px-6 py-3  font-bold ">کد اثر</th>
                            <th class=" px-6 py-3  font-bold ">نام اثر</th>
                            <th class=" px-6 py-3  font-bold ">قالب علمی</th>
                            <th class=" px-6 py-3  font-bold ">گروه علمی اول</th>
                            <th class=" px-6 py-3  font-bold ">گروه علمی دوم</th>
                            <th class=" px-3 py-3  font-bold ">نام نویسنده</th>
                            <th class=" px-3 py-3  font-bold ">ارزیاب</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach ($formalLiterary as $post)
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
                                    <div class="mb-3 mt-3">
                                        <label class="block text-gray-700 text-sm font-bold text-right mr-2">ارزیاب
                                        </label>
                                        <select data-postid="{{ $post->postInfo->id }}"
                                                class="border rounded-md w-full px-3 py-2 SetFormalLiteraryRater">
                                            <option value="" selected>بدون ارزیاب</option>
                                            @php
                                                $raters=\App\Models\User::
                                                whereIn('type', [3, 4])
                                                ->orderBy('name','asc')
                                                ->get();
                                            @endphp
                                            @foreach($raters as $rater)
                                                <option @if ( $rater->id==$post->formal_literary_rater ) selected
                                                        @endif
                                                        value="{{ $rater->id }}">{{ $rater->name . ' ' . $rater->family }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                {{ $formalLiterary->links() }}
            </div>
        </div>
    </main>
@endsection

