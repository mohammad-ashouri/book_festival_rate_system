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
            <p>تناسب موضوع با مخاطب</p>
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
            <p>تازگی موضوع یا تازگی نگاه به موضوع</p>
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
                خیلی ضعیف از 0 تا 9
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 9 تا 12
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
            <p>قراردادن هدف در پس زمینه</p>
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
            4
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>جذابیت داستان ها و شخصیت پردازی</p>
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
                خیلی ضعیف از 0 تا 9
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 9 تا 12
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
            <p>رعایت دیگر عناصر داستانی (سوژه، شبکه ی استدلالی حوادث و ماجراها)</p>
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
            <textarea name="r5_description" id="r5_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف ششم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            6
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>نثر و زبان و مراعات ایجاز در نگارش و ویرایش</p>
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
                خیلی ضعیف از 0 تا 9
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 9 تا 12
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
            <textarea name="r6_description" id="r6_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف هفتم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            7
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>رعایت امور فنی چاپ و نشر (شکل و حروفچینی، صفحه آرایی، ندرت اغلاط چاپی، ذکر عناوین سرصفحه ای گویا، تناسب
                حجم با مطالب کتاب)</p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2 text-center"
                name="r7_point"
                id="r7_point"
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
            <textarea name="r7_description" id="r7_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
    {{--    ردیف هشتم--}}
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            امتیاز ویژه
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm">
            <p>پرداختن به موضوی دشوار، کمال نسبی اثر و...</p>
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
                خیلی ضعیف از 0 تا 2.5
            </p>
            <hr>
            <p class="text-sm">
                ضعیف از 2.5 تا 3.5
            </p>
            <hr>
            <p class="text-sm">
                متوسط از 3.5 تا 4
            </p>
            <hr>
            <p class="text-sm">
                خوب از 4 تا 4.5
            </p>
            <hr>
            <p class="text-sm">
                عالی از 4.5 تا 5.5
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
        <td class="px-6 py-1 bg-gray-300">
            ملاحظات ویژه
        </td>
        <td class="px-6 py-1 bg-gray-300 text-sm" colspan="3">
            <p>کتاب هایی که از ویژگی ها و ملاک های مذکور در این برگه ها برخوردار نیست، امتیازدهی و توزیع آن با نظر
                داوران محترم انجام می شود.</p>
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300" colspan="4">
            <textarea name="r9_description" id="r9_description"
                      placeholder="توضیحات و دلایل خود را در مورد موضوع بالا قید کنید."
                      class="border rounded-md w-full px-3 py-2"></textarea>
        </td>
    </tr>
</table>

<script>
    $('#r1_point, #r2_point, #r3_point, #r4_point, #r5_point, #r6_point, #r7_point, #r8_point, #r9_point').on('input', function () {
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
            $('#Sum').text(r1 + r2 + r3 + r4 + r5 + r6 + r7 + r8 + r9);
        }
    });

    $('#DetailedAssessmentSet').on('submit', function (e) {
        e.preventDefault();
        if (r1_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r1_point.value < 0 || r1_point.value > 10) {
            swalFire('خطا!', 'امتیاز ردیف اول اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r1_description.value == null || r1_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2_point.value < 0 || r2_point.value > 20) {
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
        } else if (r4_point.value < 0 || r4_point.value > 20) {
            swalFire('خطا!', 'امتیاز ردیف چهارم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r4_description.value == null || r4_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r5_point.value < 0 || r5_point.value > 10) {
            swalFire('خطا!', 'امتیاز ردیف پنجم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r5_description.value == null || r5_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف پنجم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r6_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف ششم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r6_point.value < 0 || r6_point.value > 20) {
            swalFire('خطا!', 'امتیاز ردیف ششم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r6_description.value == null || r6_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف ششم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r7_point.value === '') {
            swalFire('خطا!', 'امتیاز ردیف هفتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r7_point.value < 0 || r7_point.value > 5) {
            swalFire('خطا!', 'امتیاز ردیف هفتم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r7_description.value == null || r7_description.value == '') {
            swalFire('خطا!', 'توضیحات ردیف هفتم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r8_point.value === '') {
            swalFire('خطا!', 'امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r8_point.value < 0 || r8_point.value > 5) {
            swalFire('خطا!', 'امتیاز ویژه اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r8_description.value == null || r8_description.value == '') {
            swalFire('خطا!', 'توضیحات امتیاز ویژه وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r9_description.value == null || r9_description.value == '') {
            swalFire('خطا!', 'توضیحات ملاحظات ویژه وارد نشده است.', 'error', 'تلاش مجدد');
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
