@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">تاییدیه مدیر گروه برای فرم ارزیابی اجمالی</h1>
            @if($approvals->isEmpty())
                <div class="bg-white rounded shadow p-6 flex flex-col font-extrabold items-center">
                    اثری برای تایید وجود ندارد.
                </div>
            @else
                <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                    {{--                    <div class=" mb-4 flex w-full">--}}
                    {{--                        <div>--}}
                    {{--                            <label for="search-Name-Classification" class="block mt-3 text-sm font-bold text-gray-700">جستجو--}}
                    {{--                                در--}}
                    {{--                                نام اثر:</label>--}}
                    {{--                            <input id="search-title-Classification" autocomplete="off"--}}
                    {{--                                   placeholder="لطفا نام اثر را وارد نمایید."--}}
                    {{--                                   type="text" name="search-Name-Classification"--}}
                    {{--                                   class="ml-4 mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"/>--}}
                    {{--                        </div>--}}
                    {{--                        <div>--}}
                    {{--                            <label for="search-SG1-Classification"--}}
                    {{--                                   class="block mt-3 text-sm font-bold text-gray-700 ">جستجو در گروه علمی اول:</label>--}}
                    {{--                            <select id="search-SG1-Classification" class="border rounded-md py-2 px-4 "--}}
                    {{--                                    name="search-SG1-Classification">--}}
                    {{--                                <option value="">بدون فیلتر</option>--}}
                    {{--                                @php $SG=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get() @endphp--}}
                    {{--                                @foreach($SG as $scientific_groups)--}}
                    {{--                                    <option--}}
                    {{--                                        value="{{ $scientific_groups->id }}">{{ $scientific_groups->name }}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="mr-3">--}}
                    {{--                            <label for="search-SG2-Classification"--}}
                    {{--                                   class="block text-gray-700 text-sm font-bold mt-3 ">جستجو در گروه علمی دوم:</label>--}}
                    {{--                            <select id="search-SG2-Classification" class="border rounded-md py-2 px-4 "--}}
                    {{--                                    name="search-SG2-Classification">--}}
                    {{--                                <option value="">بدون فیلتر</option>--}}
                    {{--                                @php $SG=\App\Models\Catalogs\ScientificGroup::orderBy('name','asc')->get() @endphp--}}
                    {{--                                @foreach($SG as $scientific_groups)--}}
                    {{--                                    <option--}}
                    {{--                                        value="{{ $scientific_groups->id }}">{{ $scientific_groups->name }}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="max-w-full overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                            <thead>
                            <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                                <th class=" px-6 py-3  font-bold ">ردیف</th>
                                <th class=" px-6 py-3  font-bold ">کد اثر</th>
                                <th class=" px-6 py-3  font-bold ">نام اثر</th>
                                <th class=" px-3 py-3  font-bold ">قالب اثر</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی اول</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی دوم</th>
                                @if($userType==3)
                                    <th class=" px-3 py-3  font-bold ">
                                        عملیات
                                    </th>
                                @elseif($userType==1)
                                    <th class=" px-3 py-3  font-bold ">
                                        وضعیت تاییدیه مدیر گروه اول
                                    </th>
                                    <th class=" px-3 py-3  font-bold ">
                                        وضعیت تاییدیه مدیر گروه دوم
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach ($approvals as $post)
                                <tr class="bg-white">
                                    <td class="px-6 py-4">{{ $loop->iteration  }}</td>
                                    <td class="px-6 py-4">{{ $post->postInfo->id  }}</td>
                                    <td class="px-6 py-4">{{ $post->postInfo->title  }}</td>
                                    <td class="px-6 py-4">{{$post->postInfo->post_format  }}</td>
                                    <td class="px-3 py-4">
                                        @php
                                            $sg1Info =\App\Models\Catalogs\ScientificGroup::find($post->postInfo->scientific_group_v1)
                                        @endphp
                                        {{ $sg1Info->name }}
                                    </td>
                                    <td class="px-3 py-4">
                                        @php
                                            $sg2Info =\App\Models\Catalogs\ScientificGroup::find($post->postInfo->scientific_group_v2)
                                        @endphp
                                        @if($sg2Info)
                                            {{ $sg2Info->name }}
                                        @endif
                                    </td>
                                    @if($userType==3)
                                        <td class="px-3 py-4 text-right">
                                            <form class="approve-rate-form"
                                                  action="@if($userType===1)/ApprovePost @elseif($userType===3)/Approve @endif">
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <div>
                                                    <label class="mr-2">ارتباط اثر با گروه حاضر</label>
                                                    <select
                                                        class="border rounded-md w-full px-3 py-2 mb-3 relation-with-summary-group"
                                                        name="relation_with_summary_group"
                                                        data-row="{{$loop->iteration}}">
                                                        <option value="" selected disabled>انتخاب کنید</option>
                                                        <option value="اثر مربوط به گروه حاضر است">
                                                            اثر مربوط به گروه حاضر است
                                                        </option>
                                                        @if(!$post->postInfo->scientific_group_v2)
                                                            <option value="اثر میان رشته ای است">
                                                                اثر میان رشته ای است
                                                                (گروه علمی را مشخص کنید)
                                                            </option>
                                                        @endif
                                                        <option value="اثر مربوط به گروه حاضر نیست">
                                                            اثر مربوط به گروه حاضر نیست
                                                            (گروه علمی را مشخص کنید)
                                                        </option>
                                                    </select>
                                                </div>
                                                <div data-row="{{$loop->iteration}}" class="hidden mt-2 SetFormTypeDIV">
                                                    <label class="mr-2">تعیین نوع اثر</label>
                                                    <select
                                                        class="border rounded-md w-full px-3 py-2 "
                                                        name="summary_form_type">
                                                        @if($post->postInfo->post_format==='پایان نامه')
                                                            <option selected value="پایان نامه">پایان نامه</option>
                                                        @else
                                                            <option value="" selected disabled>انتخاب کنید</option>
                                                            <option value="علمی پژوهشی">علمی پژوهشی</option>
                                                            <option value="علمی ترویجی">علمی ترویجی</option>
                                                            <option value="فرهنگی تبلیغی">فرهنگی تبلیغی</option>
                                                            <option value="تقریر">تقریر</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div data-row="{{$loop->iteration}}"
                                                     class="hidden mt-2 SetScientificGroupDIV">
                                                    <label class="mr-2">تعیین گروه علمی پیشنهادی</label>
                                                    <select
                                                        class="border rounded-md w-full px-3 py-2 "
                                                        name="scientific_group">
                                                        <option value="" selected disabled>انتخاب کنید</option>
                                                        @php
                                                            $scientificGroups=\App\Models\Catalogs\ScientificGroup::where('active',1)->where('id','!=',$post->postInfo->scientific_group_v1)->orderBy('name','asc')->get();
                                                        @endphp
                                                        @foreach($scientificGroups as $scientificGroup)
                                                            <option
                                                                value="{{ $scientificGroup->id }}">{{ $scientificGroup->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="text-center mt-2">
                                                    <button
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full md:w-auto"
                                                        type="submit">ثبت تاییدیه
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    @elseif($userType==1)
                                        <td class="px-3 py-4 text-right">
                                            @if($post->sg1_form_type==='Waiting For Header')
                                                در انتظار تایید مدیر گروه
                                            @else
                                                تایید شده -
                                                {{ $post->sg1_form_type }}
                                            @endif
                                        </td>
                                        <td class="px-3 py-4 text-right">
                                            @if($post->sg2_form_type!=null and $post->sg2_form_type==='Waiting For Header')
                                                در انتظار تایید مدیر گروه
                                            @elseif($post->sg2_form_type!=null)
                                                تایید شده -
                                                {{ $post->sg2_form_type }}
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
