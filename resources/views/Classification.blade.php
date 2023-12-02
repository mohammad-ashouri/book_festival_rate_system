@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">گونه بندی آثار</h1>
            @php
                $check=\App\Models\Post::where('sorted',0)->get();
            @endphp
            @if($check->isEmpty())
                <div class="bg-white rounded shadow p-6 flex flex-col font-extrabold items-center">
                    اثری برای گونه بندی وجود ندارد.
                </div>
            @else
                <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                    <div class=" mb-4 flex w-full">
                        {{--                        <div>--}}
                        {{--                            <label for="search-Name-Classification" class="block mt-3 text-sm font-bold text-gray-700">جستجو--}}
                        {{--                                در--}}
                        {{--                                نام اثر:</label>--}}
                        {{--                            <input id="search-title-Classification" autocomplete="off"--}}
                        {{--                                   placeholder="لطفا نام اثر را وارد نمایید."--}}
                        {{--                                   type="text" name="search-Name-Classification"--}}
                        {{--                                   class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>--}}
                        {{--                        </div>--}}
                        <div>
                            <label for="search-SG1-Classification"
                                   class="block mt-3 text-sm font-bold text-gray-700 ">جستجو در گروه علمی اول:</label>
                            <select id="search-SG1-Classification" class="border rounded-md py-2 px-4 "
                                    name="search-SG1-Classification">
                                <option value="">بدون فیلتر</option>
                                @php $SG=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get() @endphp
                                @foreach($SG as $scientific_groups)
                                    <option
                                        value="{{ $scientific_groups->id }}">{{ $scientific_groups->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-3">
                            <label for="search-SG2-Classification"
                                   class="block text-gray-700 text-sm font-bold mt-3 ">جستجو در گروه علمی دوم:</label>
                            <select id="search-SG2-Classification" class="border rounded-md py-2 px-4 "
                                    name="search-SG2-Classification">
                                <option value="">بدون فیلتر</option>
                                @php $SG=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get() @endphp
                                @foreach($SG as $scientific_groups)
                                    <option
                                        value="{{ $scientific_groups->id }}">{{ $scientific_groups->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="max-w-full overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                            <thead>
                            <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                                <th class=" px-6 py-3  font-bold ">ردیف</th>
                                <th class=" px-6 py-3  font-bold ">جشنواره</th>
                                <th class=" px-6 py-3  font-bold ">نام اثر</th>
                                <th class=" px-3 py-3  font-bold ">قالب اثر</th>
                                <th class=" px-3 py-3  font-bold ">نوع اثر</th>
                                <th class=" px-3 py-3  font-bold ">زبان</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی اول</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی دوم</th>
                                <th class=" px-3 py-3  font-bold ">صاحب اثر</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach ($postList as $post)
                                <tr class="bg-white">
                                    <td class="px-6 py-4">{{ $loop->iteration  }}</td>
                                    <td class="px-6 py-4">{{ $post->festivalInfo->name }}</td>
                                    <td class="px-6 py-4">{{ $post->title  }}</td>
                                    <td class="px-6 py-4">{{$post->post_format  }}</td>
                                    <td class="px-3 py-4">{{ $post->post_type }}</td>
                                    <td class="px-3 py-4">{{ $post->languageInfo->name }}</td>
                                    <td class="px-3 py-4">
                                        <select data-postid="{{ $post->id }}"
                                                class="border rounded-md w-full px-3 py-2 sg1"
                                                name="sg1">
                                            <option value="" disabled>انتخاب کنید</option>
                                            @php
                                                $sg1=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                            @endphp
                                            @foreach($sg1 as $scientific_group)
                                                <option @if($scientific_group->id==$post->scientific_group_v1)
                                                            {{ "selected=selected" }}
                                                        @endif value="{{ $scientific_group->id }}">
                                                    {{ $scientific_group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-4">
                                        <select id="sg2" data-postid="{{ $post->id }}"
                                                class="border rounded-md w-full px-3 py-2 sg2"
                                                name="sg2">
                                            <option value="">بدون گروه علمی دوم</option>
                                            @php
                                                $sg2=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get();
                                            @endphp
                                            @foreach($sg2 as $scientific_group)
                                                <option @if($scientific_group->id==$post->scientific_group_v2)
                                                            {{ "selected=selected" }}
                                                        @endif value="{{ $scientific_group->id }}">
                                                    {{ $scientific_group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-4">{{ $post->personInfo->name .' ' . $post->personInfo->family }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($type==1 or $type==2)
                    <form id="classification-form">
                        <div class=" bg-white rounded shadow p-4 flex flex-col ">
                            <div id="file_src" class="mb-4 ">
                                <label for="file_src"
                                       class="text-gray-700 text-sm font-bold whitespace-nowrap">در صورت نیاز می توانید
                                    فایل
                                    صورتجلسه گونه بندی را نیز پیوست نمایید:</label>
                                <input id="file_src" name="file_src" type="file"
                                       accept="application/zip, .rar, .jpg, .jpeg, .pdf"
                                       class="border border-gray-300 px-3 py-2 w-72 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <button type="submit"
                                        class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                    ثبت نهایی گونه بندی
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif
        </div>
    </main>
@endsection
