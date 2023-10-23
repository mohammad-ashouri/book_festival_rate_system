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
                <option value="علمی ترویجی">علمی ترویجی</option>
                <option value="فرهنگی تبلیغی">فرهنگی تبلیغی</option>
            </select>
        </td>
    </tr>
</table>

<table id="rateForm" class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3 hidden">
    <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center border-b-2">
        <th class="px-6 py-1 w-5 font-bold ">ردیف</th>
        <th class="px-6 py-1 w-80 font-bold ">شاخص های موثر</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 1</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 2</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 3</th>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            1
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p id="r1Title"></p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r1" name="r1" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r1" name="r1" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r1" name="r1" @else disabled
                @endif step="0.25" type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            2
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p id="r2Title"></p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r2" name="r2" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r2" name="r2" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r2" name="r2" @else disabled
                @endif step="0.25" type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            3
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p id="r3Title"></p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r3" name="r3" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r3" name="r3" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r3" name="r3" @else disabled
                @endif step="0.25" type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            4
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <p id="r4Title"></p>
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r4" name="r4" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r4" name="r4" @else disabled
                @endif step="0.25" type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r4" name="r4" @else disabled
                @endif step="0.25" type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td colspan="2" class="px-6 py-1 text-left bg-gray-300">
            <p class="font-bold">جمع ردیف</p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="c1Sum" class="font-bold"></p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="c2Sum" class="font-bold"></p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="c3Sum" class="font-bold"></p>
        </td>
    </tr>
</table>
<div id="submitRate" class="mt-3 text-center hidden">
    <button type="submit"
            class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
        ثبت ارزیابی
    </button>
</div>

<script>
    function sumC1Rows() {
        let r1 = parseFloat($('#r1').val()) || 0;
        let r2 = parseFloat($('#r2').val()) || 0;
        let r3 = parseFloat($('#r3').val()) || 0;
        let r4 = parseFloat($('#r4').val()) || 0;

        $('#c1Sum').text(r1 + r2 + r3 + r4);
    }

    $('#r1, #r2, #r3, #r4').on('input', function() {
        if (!isNaN($(this).val())) {
            sumC1Rows();
        }
    });

    $('#connectionWithGroup').on('change', function () {
        if (this.value === 'اثر مربوط به گروه حاضر است' && type.value !== '') {
            rateForm.classList.remove('hidden');
            submitRate.classList.remove('hidden');
        } else if (this.value === 'اثر میان رشته ای است') {
            rateForm.classList.add('hidden');
            submitRate.classList.add('hidden');
        } else if (this.value === 'اثر مربوط به گروه حاضر نیست') {
            rateForm.classList.add('hidden');
            submitRate.classList.add('hidden');
        }
    });
    $('#type').on('change', function () {
        if (connectionWithGroup.value === 'اثر مربوط به گروه حاضر است') {
            rateForm.classList.remove('hidden');
            submitRate.classList.remove('hidden');
        } else if (connectionWithGroup.value === 'اثر میان رشته ای است') {
            rateForm.classList.add('hidden');
            submitRate.classList.add('hidden');
        } else if (connectionWithGroup.value === 'اثر مربوط به گروه حاضر نیست') {
            rateForm.classList.add('hidden');
            submitRate.classList.add('hidden');
        }
        if (this.value === 'علمی پژوهشی' || this.value === 'علمی ترویجی') {
            r1Title.textContent = 'اهمیت موضوع';
            r2Title.textContent = 'ارزش علمی';
            r3Title.textContent = 'اثربخشی';
            r4Title.textContent = 'استفاده مناسب از منابع معتبر';
        } else if (this.value === 'فرهنگی تبلیغی') {
            r1Title.textContent = 'میزان ارتباط موضوع با عناصر فرهنگ و تبلیغ';
            r2Title.textContent = 'ارزش و اهمیت موضوع در عرصه فرهنگ و تبلیغ';
            r3Title.textContent = 'تناسب موضوع با نیازها و اولویت های فرهنگی - تبلیغی جامعه';
            r4Title.textContent = 'اثربخشی برای مخاطبان اثر';
        }
    });
    $('#SummaryAssessmentSet').on('submit', function (e) {
        e.preventDefault();
        if (r1.value === '') {
            swalFire('خطا!', 'امتیاز ردیف اول وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r2.value === '') {
            swalFire('خطا!', 'امتیاز ردیف دوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r3.value === '') {
            swalFire('خطا!', 'امتیاز ردیف سوم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r4.value === '') {
            swalFire('خطا!', 'امتیاز ردیف چهارم وارد نشده است.', 'error', 'تلاش مجدد');
        } else if (r1.value < 0 || r1.value > 4) {
            swalFire('خطا!', 'امتیاز ردیف اول اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r2.value < 0 || r2.value > 4) {
            swalFire('خطا!', 'امتیاز ردیف دوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r3.value < 0 || r3.value > 4) {
            swalFire('خطا!', 'امتیاز ردیف سوم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
        } else if (r4.value < 0 || r4.value > 4) {
            swalFire('خطا!', 'امتیاز ردیف چهارم اشتباه وارد شده است.', 'error', 'تلاش مجدد');
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
                        url: '/Rate/setSummaryRate',
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
                                window.location.href = response.redirect + '?successSummaryRate';
                            }
                        }
                    });
                }
            });
        }

    });
</script>