@php use App\Models\DeliveryReportComment;use Morilog\Jalali\Jalalian; @endphp
@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-gray-100 py-6 px-8 ">
        <div class=" mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">گزارش وضعیت تحویل آثار</h1>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <form class="w-full" method="get" id="delivery-status">
                    <div class=" mb-4 flex w-full">
                        <input class="border rounded-md px-3 "
                               value="@if(isset($_GET['PostID'])){{$_GET['PostID']}}@endif" name="post_id"
                               id="post_id" type="text" placeholder="کد اثر را وارد نمایید">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full mr-2 md:w-auto"
                            type="submit">نمایش وضعیت
                        </button>
                    </div>
                </form>

                @if(isset($_GET['PostID']))
                    <div class="w-full text-right">
                        <button id="newDelivery"
                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full mr-2 md:w-auto"
                                type="button">ارسال جدید
                        </button>
                    </div>

                    <form id="new-delivery">
                        @csrf
                        <div class="mt-4 mb-0 flex items-center">
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="newDeliveryModal">
                                {{--                            <div class="fixed z-10 inset-0 overflow-y-auto " id="newDeliveryModal">--}}
                                <div
                                    class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75 adddelivery"></div>
                                    </div>

                                    <div
                                        class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                                ارسال به ارزیاب
                                            </h3>
                                            <div class="mt-4">
                                                <div class="flex flex-col items-right mb-4">
                                                    <label for="rater"
                                                           class="block text-gray-700 text-sm font-bold mb-2">ارزیاب*:</label>
                                                    <select id="rater" class="border rounded-md py-2 px-4 select2"
                                                            name="rater">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($raters as $rater)
                                                            <option
                                                                value="{{ $rater->id }}">{{ $rater->name .' ' . $rater->family }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <input type="hidden" name="post_id" id="post_id"
                                                   value="{{$_GET['PostID']}}">
                                            <button type="submit"
                                                    class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                                ارسال
                                            </button>
                                            <button id="cancel-new-delivery" type="button"
                                                    class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                                انصراف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mb-0 flex items-center">
                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="HistoryModal">
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75 history"></div>
                                </div>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg mb-3 leading-6 font-medium text-gray-900 HistoryTitle" id="modal-headline">
                                        </h3>
                                        <table class="w-full border-collapse rounded-lg overflow-hidden text-center CommentsTable">
                                            <thead>
                                            <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                                                <th class=" px-6 py-3  font-bold w-5">ردیف</th>
                                                <th class=" px-6 py-3  font-bold  ">توضیحات</th>
                                                <th class=" px-6 py-3  font-bold  ">تاریخ ثبت</th>
                                                <th class=" px-6 py-3  font-bold  ">ثبت کننده</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button id="cancel-history" type="button"
                                                class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                            بستن
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="new-comment">
                        @csrf
                        <div class="mt-4 mb-0 flex items-center">
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="newCommentModal">
                                {{--                            <div class="fixed z-10 inset-0 overflow-y-auto " id="newDeliveryModal">--}}
                                <div
                                    class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center  sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75 addcomment"></div>
                                    </div>

                                    <div
                                        class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-[550px]">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                                ثبت توضیح برای ارسال
                                            </h3>
                                            <div class="mt-4">
                                                <div class="flex flex-col items-right mb-4">
                                                    <label for="description"
                                                           class="block text-gray-700 text-sm font-bold mb-2">توضیحات*:</label>
                                                    <textarea name="description" id="description"
                                                              placeholder="توضیحات را وارد نمایید"
                                                              class="border rounded-md w-full px-3 py-2"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <input type="hidden" name="status_id" id="status_id" value="">
                                            <button type="submit"
                                                    class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                                ارسال
                                            </button>
                                            <button id="cancel-new-comment" type="button"
                                                    class="mt-3 w-full inline-flex justify-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:w-auto">
                                                انصراف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                @endif
                @if(isset($deliveryStatusInfo))
                    <div class="w-full overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg overflow-hidden text-center">
                            <thead>
                            <tr class="bg-gradient-to-r from-blue-400 to-purple-500 items-center text-center text-white">
                                <th class=" px-6 py-3  font-bold w-5">ردیف</th>
                                <th class=" px-6 py-3  font-bold  ">ارزیاب</th>
                                <th class=" px-6 py-3  font-bold  ">تاریخ ارسال</th>
                                <th class=" px-6 py-3  font-bold  ">ارسال کننده</th>
                                <th class=" px-3 py-3  font-bold ">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach ($deliveryStatusInfo as $status)
                                <tr class="{{ $loop->even ? 'bg-white' : 'bg-gray-100' }}">
                                    <td class="px-6 py-2">{{ $loop->iteration  }}</td>
                                    <td class="px-6 py-2">{{ $status->raterInfo->name . ' ' . $status->raterInfo->family  }}</td>
                                    @php
                                        $jalaliDate = Jalalian::fromDateTime($status->created_at);
                                        $formattedJalaliDate = $jalaliDate->format('H:i:s Y/m/d');
                                    @endphp
                                    <td class="px-6 py-2">{{ $formattedJalaliDate  }}</td>
                                    <td class="px-6 py-2">{{ $status->registrarInfo->name . ' ' . $status->registrarInfo->family  }}</td>
                                    <td class="px-6 py-2">
                                        <button data-status-id="{{ $status->id }}"
                                                class="bg-green-500 hover:bg-green-600 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline w-full mr-2 md:w-auto AddComment"
                                                type="button">ثبت توضیحات
                                        </button>
                                        <button data-status-id="{{ $status->id }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline w-full mr-2 md:w-auto History"
                                                type="button">تاریخچه
                                        </button>
                                    </td>
                                </tr>
                                @php
                                    $commentInfo=DeliveryReportComment::where('status_id',$status->id)->orderBy('id','desc')->get();
                                @endphp
                                @foreach ($commentInfo as $comments)
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection
