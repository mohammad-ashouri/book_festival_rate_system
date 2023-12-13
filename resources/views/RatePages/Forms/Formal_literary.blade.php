<table id="rateForm" class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
    <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center ">
        <th class="px-6 py-1 w-5 font-bold ">ردیف</th>
        <th class="px-6 py-1 w-80 font-bold ">شاخص</th>
        <th class="px-6 py-1 w-5 font-bold ">امتیاز</th>
        <th class="px-6 py-1 w-80 font-bold ">راهنمای امتیازدهی</th>
    </tr>
    {{--    ردیف اول--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            1
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>1- آراستگی زبان</p>
            <p>1-1 آرایه های لفظی و معنوی (حسن مطلع، همخوانی/مراعات نظیر، تشبیه، لف و نشر، هماوایی و...)</p>
            <p>1-2 سادگی و روانی قلم</p>
            <p>1-3 تنوع واژگانی</p>
            <p>1-4 صمیمی و زنده نویسی</p>
            <p>1-5 بهداشت قلم (پرهیز از گرته برداری، کلیشه، تعابیر و کلمات سست، درازنویسی، ایجاز مخل و اطناب ممل، اغلاط
                انشایی، دشوار نویسی، پیچیدگی کلامی، واژه های غیرفصیح و...)</p>
            <p>1-6 تکیه بر استفاده از فعل خاص و معلوم</p>
            <p>1-7 عنوان کتاب</p>
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
                خیلی ضعیف از 0 تا 20
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 20 تا 24
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 24 تا 28
            </p>
            <hr>
            <p class="text-sm">
                خوب از 28 تا 32
            </p>
            <hr>
            <p class="text-sm">
                عالی از 32 تا 40
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
            <p>2- ویراستگی لفظی</p>
            <p>2-1 رسم الخط</p>
            <p>2-2 علائم سجاوندی</p>
            <p>2-3 پرهیز از اغلاط دستوری</p>
            <p>2-4 قطع و وصل ها</p>
            <p>2-5 پاراگراف بندی</p>
            <p>2-6 یکدستی</p>
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
                خیلی ضعیف از 0 تا 15
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 15 تا 18
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 18 تا 21
            </p>
            <hr>
            <p class="text-sm">
                خوب از 21 تا 24
            </p>
            <hr>
            <p class="text-sm">
                عالی از 24 تا 30
            </p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r2_description" id="r2_description"
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
            <p>3- تنظیم فنی و دقیق پاورقی ها و کتابنامه</p>
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
                خیلی ضعیف از 0 تا 10
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 10 تا 12
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 12 تا 14
            </p>
            <hr>
            <p class="text-sm">
                خوب از 14 تا 16
            </p>
            <hr>
            <p class="text-sm">
                عالی از 16 تا 20
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
            4
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>4- پیوست انواع فهرست ها و نمایه ها</p>
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
                خیلی ضعیف از 0 تا 15
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 15 تا 18
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 18 تا 21
            </p>
            <hr>
            <p class="text-sm">
                خوب از 21 تا 24
            </p>
            <hr>
            <p class="text-sm">
                عالی از 24 تا 30
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
            5
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>5- رعایت امور فنی و صوری</p>
            <p>5-1 طرح جلد</p>
            <p>5-2 صفحه آرایی</p>
            <p>5-3 حروف چینی</p>
            <p>5-4 فصل بندی</p>
            <p>5-5 تیترسازی</p>
            <p>5-6 عناوین سرصفحه ای</p>
            <p>5-7 غلط گیری دقیق</p>
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
                خیلی ضعیف از 0 تا 15
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 15 تا 18
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 18 تا 21
            </p>
            <hr>
            <p class="text-sm">
                خوب از 21 تا 24
            </p>
            <hr>
            <p class="text-sm">
                عالی از 24 تا 30
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
    $('#r1_point, #r2_point, #r3_point, #r4_point, #r5_point').on('input', function () {
        if (!isNaN($(this).val())) {
            let r1 = parseFloat($('#r1_point').val()) || 0;
            let r2 = parseFloat($('#r2_point').val()) || 0;
            let r3 = parseFloat($('#r3_point').val()) || 0;
            let r4 = parseFloat($('#r4_point').val()) || 0;
            let r5 = parseFloat($('#r5_point').val()) || 0;
            $('#Sum').text(r1 + r2 + r3 + r4 + r5);
        }
    });

    $('#FormalLiteraryAssessmentSet').on('submit', function (e) {
        e.preventDefault();
        if (r1_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r1_point.value < 0 || r1_point.value > 40) {
            swalFire('خطا!', 'امتیاز ردیف اول اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r1_description.value == null || r1_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value < 0 || r2_point.value > 30) {
            swalFire('خطا!', 'امتیاز ردیف دوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r2_description.value == null || r2_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r3_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف سوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r3_point.value < 0 || r3_point.value > 20) {
            swalFire('خطا!', 'امتیاز ردیف سوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r3_description.value == null || r3_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف سوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r4_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r4_point.value < 0 || r4_point.value > 30) {
            swalFire('خطا!', 'امتیاز ردیف چهارم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r4_description.value == null || r4_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value < 0 || r5_point.value > 30) {
            swalFire('خطا!', 'امتیاز ردیف پنجم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r5_description.value == null || r5_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
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
                        url: '/Rate/setFormalLiteraryRate',
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
                                window.location.href = response.redirect + '?successFormalLiteraryRate';
                            }
                        }
                    });
                }
            });
        }

    });
</script>
