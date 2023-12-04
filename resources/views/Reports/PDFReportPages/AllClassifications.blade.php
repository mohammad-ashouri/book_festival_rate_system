<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>اطلاعات تجهیزات پرسنل</title>
    <style type="text/css">
        body {
            font-family: 'vazir';
            direction: rtl;
        }

        @page {
            header: page-header;
            footer: page-footer;
            size: 8.5in 11in;
            /* <length>{1,2} | auto | portrait | landscape */
            /* 'em' 'ex' and % are not allowed; length values are width height */
            margin: 10% 5% 5% 5%;
            /* <any of the usual CSS values for margins> */
            /*(% of page-box width for LR, of height for TB) */
            margin-header: 1mm;
            /* <any of the usual CSS values for margins> */
            margin-footer: 5mm;
            /* <any of the usual CSS values for margins> */
        }

        /*.logo {*/
        /*    width: 2cm;*/
        /*    height: 2cm;*/
        /*}*/

        table.GeneratedTable {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 2px;
            border-color: #ffcc00;
            border-style: solid;
            color: #000000;
        }

        table.GeneratedTable td, table.GeneratedTable th {
            border-width: 2px;
            border-color: #ffcc00;
            border-style: solid;
            padding: 3px;
        }

        table.GeneratedTable thead {
            background-color: #ffcc00;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px; /* یا مقدار دلخواه شما */
        }

        .mt-5 {
            margin-top: 20px; /* یا مقدار دلخواه شما */
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>

<div>
    <h2 style="text-align: center">
        آثار گونه بندی نشده در دوره
        {{ $lastFestival->name }}
        همایش کتاب سال حوزه
    </h2>

    @if($nonClassificatedPosts->count()!==0)
        <div style="text-align: center">
            <table class="GeneratedTable">
                <thead>
                <tr>
                    <th style="width:5%">ردیف</th>
                    <th style="width:30%">نام اثر</th>
                    <th style="width:8%">قالب</th>
                    <th style="width:10%">نوع</th>
                    <th style="width:15%">گروه علمی اول</th>
                    <th style="width:15%">گروه علمی دوم</th>
                    <th style="width:15%">صاحب اثر</th>
                    <th style="width:15%">کارشناس</th>
                </tr>
                </thead>
                <tbody>
                @foreach($nonClassificatedPosts as $post)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td style="text-align: center">{{ $post->title }}</td>
                        <td style="text-align: center">{{ $post->post_format }}</td>
                        <td style="text-align: center">{{ $post->post_type }}</td>
                        <td style="text-align: center">{{ $post->scientificGroup1Info->name }}</td>
                        <td style="text-align: center">
                            @if($post->scientific_group_v2)
                                {{ $post->scientificGroup2Info->name }}
                            @endif
                        </td>
                        <td style="text-align: center">{{ $post->personInfo->name . ' ' . $post->personInfo->family }}</td>
                        <td style="text-align: center">
                            @if($post->sorter)
                                {{ $post->sorterInfo->name . ' ' . $post->sorterInfo->family }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    @endif

    <div class="grid mt-5 text-left">
        <span>تاریخ و امضای کارشناسان گونه بندی</span>
    </div>
</div>
<htmlpagefooter name="page-footer">
    <p style="text-align:center">
        {PAGENO} از {nbpg}
    </p>
</htmlpagefooter>
</body>
</html>
