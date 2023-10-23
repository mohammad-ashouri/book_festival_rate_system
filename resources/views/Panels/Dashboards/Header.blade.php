@extends('layouts.PanelMaster')

@section('content')
    <main class="flex-1 bg-cu-light py-6 px-8">
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">صفحه اصلی</h1>
            <div class="bg-white rounded shadow p-6">
                <p>
                    به پنل سامانه کتاب سال حوزه خوش آمدید.
                </p>
            </div>
        </div>
        <div class="mx-auto lg:mr-72">
            <h1 class="text-2xl font-bold mb-4">تعیین ارتباط اثر با گروه حاضر</h1>
            <div class="bg-white rounded shadow p-6">
                <table class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
                    <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center border-b-2">
                        <th class="px-6 py-1 w-5 font-bold ">ارتباط اثر با گروه حاضر</th>
                        <th class="px-6 py-1 w-5 font-bold ">تعیین نوع اثر</th>
                    </tr>
                    <tr class="items-center text-center w-80">
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
                        <td class="px-6 py-1 bg-gray-300">
                            <select id="type" class="border rounded-md w-56 px-3 py-2"
                                    name="type">
                                <option value="" disabled selected>انتخاب کنید</option>
                                <option value="علمی پژوهشی">علمی پژوهشی</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
@endsection

