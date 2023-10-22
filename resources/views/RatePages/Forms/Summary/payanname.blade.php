<table class="w-full border-collapse rounded-lg overflow-hidden text-center mt-3">
    <tr class="items-center bg-gradient-to-r from-blue-400 to-purple-500 text-white text-center border-b-2">
        <th class="px-6 py-1 w-5 font-bold ">ردیف</th>
        <th class="px-6 py-1 w-32 font-bold ">شاخص های موثر</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 1</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 2</th>
        <th class="px-6 py-1 w-5 font-bold ">ارزیاب 3</th>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            1
        </td>
        <td class="px-6 py-1 bg-gray-300">
            اهمیت موضوع
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r1" name="r1" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r1" name="r1" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r1" name="r1" @else disabled
                @endif type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            2
        </td>
        <td class="px-6 py-1 bg-gray-300">
            ارزش علمی
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r2" name="r2" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r2" name="r2" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r2" name="r2" @else disabled
                @endif type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            3
        </td>
        <td class="px-6 py-1 bg-gray-300">
            ارزش علمی
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r3" name="r3" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r3" name="r3" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r3" name="r3" @else disabled
                @endif type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td class="px-6 py-1 bg-gray-300">
            4
        </td>
        <td class="px-6 py-1 bg-gray-300">
            استفاده مناسب از منابع معتبر
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s1g1rater==$me or $summaryRate->s1g2rater==$me) id="r4" name="r4" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s2g1rater==$me or $summaryRate->s2g2rater==$me) id="r4" name="r4" @else disabled
                @endif type="text">
        </td>
        <td class="px-6 py-1 bg-gray-300">
            <input
                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 w-20 mt-2"
                @if($summaryRate->s3g1rater==$me or $summaryRate->s3g2rater==$me) id="r4" name="r4" @else disabled
                @endif type="text">
        </td>
    </tr>
    <tr class="items-center text-center ">
        <td colspan="2" class="px-6 py-1 text-left bg-gray-300">
            <p class="font-bold">جمع ردیف</p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="s1Sum" class="font-bold"></p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="s2Sum" class="font-bold"></p>
        </td>
        <td class="px-6 py-1 text-center bg-gray-300">
            <p id="s3Sum" class="font-bold"></p>
        </td>
    </tr>
</table>
<div class="mt-3 text-center">
    <button type="submit"
            class="px-4 py-2 mr-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
        ثبت ارزیابی
    </button>
</div>
<script>
    $('#SummaryAssessmentSet').on('submit', function (e) {
        e.preventDefault();
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
                    }
                });
            }
        });
    });
</script>
