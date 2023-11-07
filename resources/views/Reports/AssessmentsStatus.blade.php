@php use App\Models\Catalogs\ScientificGroup;use App\Models\RateInfo; @endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">گزارش وضعیت ارزیابی</h1>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <form class="w-full" method="post">
                    @csrf
                    <div class=" mb-4 flex w-full">
                        <label for="festival"
                               class="block text-gray-700 text-sm font-bold mt-3 ">جشنواره مورد نظر را انتخاب
                            کنید:</label>
                        <select id="festival" class="border rounded-md px-3 " required
                                name="festival">
                            @foreach($festivals as $festival)
                                <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                            @endforeach
                        </select>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full mr-2 md:w-auto"
                            type="submit">نمایش وضعیت
                        </button>
                    </div>
                </form>

                @if(isset($posts))
                    <div class="w-full overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                            <thead>
                            <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                                <th class=" px-6 py-3  font-bold ">ردیف</th>
                                <th class=" px-6 py-3  font-bold ">کد اثر</th>
                                <th class=" px-3 py-3  font-bold ">نام اثر</th>
                                <th class=" px-3 py-3  font-bold ">قالب اثر</th>
                                <th class=" px-3 py-3  font-bold ">نوع اثر</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی اول</th>
                                <th class=" px-3 py-3  font-bold ">گروه علمی دوم</th>
                                <th class=" px-3 py-3  font-bold ">وضعیت</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <tr class="{{ $loop->even ? 'bg-white' : 'bg-gray-100' }}">
                                    <td class="px-6 py-2">{{ $loop->iteration  }}</td>
                                    <td class="px-6 py-2">{{ $post->id  }}</td>
                                    <td class="px-6 py-2">{{ $post->title  }}</td>
                                    <td class="px-6 py-2">{{ $post->post_format  }}</td>
                                    <td class="px-6 py-2">{{ $post->post_type  }}</td>
                                    @php
                                        $sg1=ScientificGroup::find($post->scientific_group_v1);
                                        $sg2=ScientificGroup::find($post->scientific_group_v2);
                                    @endphp
                                    <td class="px-6 py-2">{{ $sg1->name }}</td>
                                    <td class="px-6 py-2">{{ @$sg2->name }}</td>
                                    <td class="px-6 py-2">
                                        @if($post->sorted==0)
                                            گونه بندی نشده
                                        @elseif($post->sorted==1)
                                            @php
                                                $rateInfo=RateInfo::where('post_id',$post->id)->first();
                                            @endphp
                                            @if($rateInfo->sg1_form_type=='Waiting For Header')
                                                در انتظار تایید مدیر گروه اول
                                            @endif
                                            @if($rateInfo->sg1_form_type!='Waiting For Header')
                                                @if( $rateInfo->rate_status=='Summary')
                                                    ارزیابی اجمالی
                                                @elseif( $rateInfo->rate_status=='Pre Detailed')
                                                    انتظار برای تایید انتقال به تفصیلی
                                                @elseif( $rateInfo->rate_status=='RejectedSummary')
                                                    اجمالی ردی
                                                @endif
                                            @endif
                                            @if($post->scientific_group_v2)
                                                <hr/>
                                                @if($rateInfo->sg2_form_type=='Waiting For Header')
                                                    در انتظار تایید مدیر گروه دوم
                                                @endif
                                                @if($rateInfo->sg2_form_type!='Waiting For Header')
                                                    @if( $rateInfo->rate_status=='Summary')
                                                        ارزیابی اجمالی
                                                    @elseif( $rateInfo->rate_status=='Pre Detailed')
                                                        انتظار برای تایید انتقال به تفصیلی
                                                    @elseif( $rateInfo->rate_status=='RejectedSummary')
                                                        اجمالی ردی
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection
