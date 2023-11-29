<table id="rateForm" class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
    <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center ">
        <th class="px-6 py-1 w-5 font-bold ">ردیف</th>
        <th class="px-6 py-1 w-80 font-bold ">شاخص</th>
        <th class="px-6 py-1 w-5 font-bold ">امتیاز</th>
        <th class="px-6 py-1 w-80 font-bold ">راهنمای امتیازدهی</th>
    </tr>
    <tr>
        <td class="px-6 py-1 bg-gray-500 w-56 text-white" colspan="1">الف)شاخص های محتوایی</td>
    </tr>
    {{--    ردیف اول--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            1
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>اولویت و میزان تاثیر موضوع کتاب در تامین نیازهای علمی همگانی یا جوامع علمی</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r1_point"
                id="r1_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 3
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 3 تا 4
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 4 تا 5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 5 تا 6
            </p>
            <hr>
            <p class="text-sm">
                عالی از 6 تا 7
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r1_description" id="r1_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف دوم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            2
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>سطح علمی و اتقان اثر</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r2_point"
                id="r2_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 5
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 5 تا 6
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 6 تا 7
            </p>
            <hr>
            <p class="text-sm">
                خوب از 7 تا 8
            </p>
            <hr>
            <p class="text-sm">
                عالی از 8 تا 10
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r2_description" id="r1_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف سوم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            3
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>نظریه پردازی و راه حل های جدید</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r3_point"
                id="r3_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 5
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 5 تا 6
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 6 تا 7
            </p>
            <hr>
            <p class="text-sm">
                خوب از 7 تا 8
            </p>
            <hr>
            <p class="text-sm">
                عالی از 8 تا 10
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r3_description" id="r3_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف چهارم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            4-1
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>نقل و تحلیل صحیح آراء</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r4_point"
                id="r4_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4 تا 5
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r4_description" id="r4_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف پنجم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            4-2
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>نقد صحیح آراء</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r5_point"
                id="r5_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4 تا 5
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r5_description" id="r5_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف ششم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            5
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>استناد به منابع معتبر و بهره گیری از مستندات و منابع و نتیجه گیری</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r6_point"
                id="r6_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4 تا 5
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r6_description" id="r6_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف هفتم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            6
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>میزان دستیابی پژوهش به اهداف خود</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r6_point"
                id="r6_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 4
            </p>
            <hr>
            <p class="text-sm">
                خوب از 4 تا 5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 5 تا 6
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r6_description" id="r6_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    <tr>
        <td class="px-6 py-1 bg-gray-500 w-44 text-white" colspan="1">روش و ساختار</td>
    </tr>
    {{--    ردیف هشتم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>1</p>
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>تحدید دقیق موضوع و تبیین هدف، سوالات و فرضیه ها</p>
            <p class="font-bold">نکته: البته لازم نیست الزاما عنوان سوال و فرضیه ذکر شده باشد.</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r8_point"
                id="r8_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4 تا 5
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r8_description" id="r8_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف نهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>2</p>
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>به کار گیری روش متناسب با موضوع</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r9_point"
                id="r9_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 1
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 1.5 تا 2
            </p>
            <hr>
            <p class="text-sm">
                خوب از 2 تا 2.5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 2.5 تا 3
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r9_description" id="r9_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف دهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            3-1
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>خلاقیت و نوآوری در اصل موضوع/مساله</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r10_point"
                id="r10_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 3
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 3 تا 4
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 4 تا 5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 5 تا 6
            </p>
            <hr>
            <p class="text-sm">
                عالی از 6 تا 7
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r10_description" id="r10_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف یازدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            3-2
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>خلاقیت و نوآوری در روش تحقیق و زاویه نگرش به موضوع</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r11_point"
                id="r11_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 4
            </p>
            <hr>
            <p class="text-sm">
                خوب از 4 تا 5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 5 تا 6
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r11_description" id="r11_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف دوازدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            4
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>تناسب ساختار و انسجام منطقی سرفصل ها و عناوین</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r12_point"
                id="r12_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 2
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2 تا 3
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4 تا 5
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r12_description" id="r12_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف سیزدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            5
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>تناسب اسلوب زبانی کتاب با موضوع</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r13_point"
                id="r13_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 0.25
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 0.25 تا 0.5
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 0.5 تا 1
            </p>
            <hr>
            <p class="text-sm">
                خوب از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 1.5 تا 2
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r13_description" id="r13_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف چهاردهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            6
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>توازن حجم مطالب بخشها و فصول</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r14_point"
                id="r14_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 0.25
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 0.25 تا 0.5
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 0.5 تا 1
            </p>
            <hr>
            <p class="text-sm">
                خوب از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 1.5 تا 2
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r14_description" id="r14_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف پانزدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            7
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>چکیده و نتیجه گیری</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r15_point"
                id="r15_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 0.25
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 0.25 تا 0.5
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 0.5 تا 1
            </p>
            <hr>
            <p class="text-sm">
                خوب از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 1.5 تا 2
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r15_description" id="r15_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    <tr>
        <td class="px-6 py-1 bg-gray-500 w-44 text-white" colspan="1">امتیاز ویژه</td>
        <td class="px-6 py-1 bg-red-500 w-44 text-white" colspan="3">توجه: امتیاز ویژه، شامل ویژگی های ادبی و شکلی اثر
            نمی باشد
        </td>
    </tr>
    {{--    ردیف شانزدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            الف
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>پاسداری و حراست از ارزش های دینی و انقلابی</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r16_point"
                id="r16_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 0.5
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 0.5 تا 1
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 1.5 تا 1.75
            </p>
            <hr>
            <p class="text-sm">
                عالی از 1.75 تا 2
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r16_description" id="r16_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف هفدهم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            ب
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>اثربخشی فوق العاده، برجستگی و جذابیت ویژه در نگارش</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r17_point"
                id="r17_point"
                type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p class="text-sm">
                خیلی ضعیف از 0 تا 0.5
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 0.5 تا 1
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 1 تا 1.5
            </p>
            <hr>
            <p class="text-sm">
                خوب از 1.5 تا 1.75
            </p>
            <hr>
            <p class="text-sm">
                عالی از 1.75 تا 2
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r17_description" id="r17_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    <tr class="items-center text-center">
        <td colspan="2" class="px-6 py-1 text-left bg-gray-300">
            <p class="font-bold">جمع امتیازات</p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="Sum" class="font-bold">
        </td>
    </tr>
</table>

<script>
    $('#r1_point, #r2_point, #r3_point, #r4_point, #r5_point, #r6_point, #r7_point, #r8_point, #r9_point, #r10_point, #r11_point, #r12_point, #r13_point, #r14_point, #r15_point, #r16_point, #r17_point').on('input', function () {
        if (!isNaN($(this).val())) {
            let r1 = parseFloat($('#r1_point').val()) || 0;
            let r2 = parseFloat($('#r2_point').val()) || 0;
            let r3 = parseFloat($('#r3_point').val()) || 0;
            let r4 = parseFloat($('#r4_point').val()) || 0;
            let r5 = parseFloat($('#r5_point').val()) || 0;
            let r6 = parseFloat($('#r6_point').val()) || 0;
            let r7 = parseFloat($('#r7_point').val()) || 0;
            let r8 = parseFloat($('#r8_point').val()) || 0;
            let r9 = parseFloat($('#r9_point').val()) || 0;
            let r10 = parseFloat($('#r10_point').val()) || 0;
            let r11 = parseFloat($('#r11_point').val()) || 0;
            let r12 = parseFloat($('#r12_point').val()) || 0;
            let r13 = parseFloat($('#r13_point').val()) || 0;
            let r14 = parseFloat($('#r14_point').val()) || 0;
            let r15 = parseFloat($('#r15_point').val()) || 0;
            let r16 = parseFloat($('#r16_point').val()) || 0;
            let r17 = parseFloat($('#r17_point').val()) || 0;
            $('#Sum').text(r1 + r2 + r3 + r4 + r5 + r6 + r7 + r8 + r9 + r10 + r11 + r12 + r13 + r14 + r15 + r16 + r17);
        }
    });

    $('#DetailedAssessmentSet').on('submit', function (e) {
        e.preventDefault();
        if (r1_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r1_point.value < 0 || r1_point.value > 7) {
            swalFire('خطا!', 'امتیاز ردیف اول اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r1_description.value == null || r1_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value < 0 || r2_point.value > 10) {
            swalFire('خطا!', 'امتیاز ردیف دوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r2_description.value == null || r2_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r3_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف سوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r3_point.value < 0 || r3_point.value > 10) {
            swalFire('خطا!', 'امتیاز ردیف سوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r3_description.value == null || r3_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف سوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r4_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r4_point.value < 0 || r4_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف چهارم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r4_description.value == null || r4_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value < 0 || r5_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف پنجم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r5_description.value == null || r5_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r6_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف ششم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r6_point.value < 0 || r6_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف ششم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r6_description.value == null || r6_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف ششم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r7_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف هفتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r7_point.value < 0 || r7_point.value > 6) {
            swalFire('خطا!', 'امتیاز ردیف هفتم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r7_description.value == null || r7_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف هفتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r8_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف هشتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r8_point.value < 0 || r8_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف هشتم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r8_description.value == null || r8_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف هشتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r9_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف نهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r9_point.value < 0 || r9_point.value > 3) {
            swalFire('خطا!', 'امتیاز ردیف نهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r9_description.value == null || r9_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف نهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r10_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف دهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r10_point.value < 0 || r10_point.value > 7) {
            swalFire('خطا!', 'امتیاز ردیف دهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r10_description.value == null || r10_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف دهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r11_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r11_point.value < 0 || r11_point.value > 6) {
            swalFire('خطا!', 'امتیاز ردیف یازدهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r11_description.value == null || r11_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r12_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r12_point.value < 0 || r12_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف یازدهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r12_description.value == null || r12_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r13_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r13_point.value < 0 || r13_point.value > 2) {
            swalFire('خطا!', 'امتیاز ردیف یازدهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r13_description.value == null || r13_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r14_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r14_point.value < 0 || r14_point.value > 2) {
            swalFire('خطا!', 'امتیاز ردیف یازدهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r14_description.value == null || r14_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r15_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r15_point.value < 0 || r15_point.value > 2) {
            swalFire('خطا!', 'امتیاز ردیف یازدهم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r15_description.value == null || r15_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ردیف یازدهم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r16_point.value === '') {
            swalFire('خطا!', 'امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r16_point.value < 0 || r16_point.value > 2) {
            swalFire('خطا!', 'امتیاز ویژه اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r16_description.value == null || r16_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r17_point.value === '') {
            swalFire('خطا!', 'امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r17_point.value < 0 || r17_point.value > 2) {
            swalFire('خطا!', 'امتیاز ویژه اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r17_description.value == null || r17_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (general_comment1.value == null || general_comment1.value == '') {
            swalFire('خطا!', 'ردیف اول اظهار نظر کلی جنابعالی وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (general_comment2.value == null || general_comment2.value == '') {
            swalFire('خطا!', 'ردیف دوم اظهار نظر کلی جنابعالی وارد نشده است.', 'error', 'تلاش مجدد');
        } else {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: 'ارزیابی شما ثبت خواهد شد.' +
                    '\n' +
                    'این عملیات برگشت پذیر نیست.',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله',
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $(this);
                    var data = form.serialize();
                    $.ajax({
                        type: 'POST',
                        url: '/Rate/setDetailedRate',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.errors) {
                                if (response.errors.nullID) {
                                    swalFire('خطا!', response.errors.nullID[0], 'error', 'تلاش مجدد');
                                }
                            } else {
                                window.location.href = response.redirect + '?successDetailedRate';
                            }
                        }
                    });
                }
            });
        }

    });
</script>
