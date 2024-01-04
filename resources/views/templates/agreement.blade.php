<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Template 1</title>

    <style type="text/css">
        @page {
            margin: 20px 20px 10px 20px;
        }

        body {
            margin: 20px 20px 10px 20px;
            font-size: 11px;
        }

        @font-face {
            font-family: 'Firefly Sung' ;
            font-style: normal;
            font-weight: 400;
            src: url(fireflysung.ttf) format('truetype');
        }

        * {
            font-family: Firefly Sung, DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
        }

        .print-friendly {
            page-break-inside: avoid;
        }

        .valign-bottom {
            vertical-align: bottom
        }

        .text-normal {
            font-weight: normal;
        }

        .table-layout-auto {
            table-layout: auto;
        }

        .table-layout-fixed {
            table-layout: fixed;
        }

        .logo {
            width: 70px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-underline {
            text-decoration: underline;
        }

        .service-agreement {
            border-top: 5px #4572c4 solid;
            border-bottom: 5px #4572c4 solid;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 14px;
        }

        .underline-input {
            border-bottom: 1px solid black;
            text-align: center;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .text-wrap {
            white-space: initial;
        }

        .table-underline-inputs {
            table-layout: auto;
        }

        .page-break {
            page-break-after: always;
        }


        .pl-0 {
            padding-left: 0;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pr-0 {
            padding-right: 0;
        }

        .pr-10 {
            padding-right: 10px;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pt-20 {
            padding-top: 20px;
        }


        .ml-0 {
            margin-left: 0;
        }

        .ml-10 {
            margin-left: 10px;
        }

        .ml-20 {
            margin-left: 20px;
        }

        .mr-0 {
            margin-right: 0;
        }

        .mr-10 {
            margin-right: 10px;
        }

        .mr-20 {
            margin-right: 20px;
        }

        .f-6 {
            font-size: 6px;
        }

        .f-7 {
            font-size: 7px;
        }

        .f-8 {
            font-size: 8px;
        }

        .f-9 {
            font-size: 9px;
        }

        .f-10 {
            font-size: 10px;
        }

        .f-11 {
            font-size: 11px;
        }

        .f-12 {
            font-size: 12px;
        }

        .f-13 {
            font-size: 13px;
        }

        .f-14 {
            font-size: 14px;
        }

        table.part-1 {
            margin-top: 5px;
        }

        table.part-1 th {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        input {
            max-width: 100%;
            text-align: center;
            padding-bottom: 0;
        }

        input, input:hover, input:focus {
            border-top: 0 none;
            border-left: 0 none;
            border-right: 0 none;
        }

        input.w-full {
            width: 100%;
        }

        .w-200 {
            width: 200px;
        }

        .w-130 {
            width: 130px;
        }

        .w-120 {
            width: 120px;
        }

        .w-110 {
            width: 110px;
        }

        .w-100 {
            width: 100px;
        }

        .w-90 {
            width: 90px;
        }

        .w-80 {
            width: 80px;
        }

        .w-70 {
            width: 70px;
        }

        .w-60 {
            width: 60px;
        }

        .w-50 {
            width: 50px;
        }

        table.table-bordered, table.table-bordered th, table.table-bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table.table-condensed, table.table-condensed th, table.table-condensed td {
            padding: 0;
            border-spacing: 0;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-normal {
            font-weight: normal;
        }

        .font-for-spaces {
            font-family: DejaVu Sans, sans-serif;
        }

        td.input-cell, li.input-cell {
            border-bottom: 1px solid black;
            /*height: 14px;*/
        }

        .m-0 {
            margin: 0;
        }

        .p-0 {
            padding: 0;
        }

        ol li {
            page-break-inside: avoid;
        }

    </style>
</head>
<body>
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td width="70">
                        <img class="logo" src="{{public_path('/img/logo.png')}}" alt="Sia Logo">
                    </td>
                    <td>
                        <h2 class="m-0 p-0">Sincere Company</h2>
                        <h2 class="m-0 p-0 font-normal">忠誠菲泰傭公司</h2>
                    </td>
                </tr>
            </table>
        </td>
        <td class="text-center service-agreement" width="150">
            Service Agreement <br> 服務協議
        </td>
    </tr>
</table>

@include('templates.agreement.dates')

<table class="part-1 f-12">
    <thead>
    <tr>
        <th class="text-left">Part 1 <span class="font-normal">第一部</span>: Application Information (<span
                class="font-normal">申請資料</span>)
        </th>
        <th class="text-right">Contract No.: <span
                class="font-normal">合約編號</span> ( {{$contract->contract_number}} )</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<ol class="pl-20 f-12">
    <li>
        @include('templates.agreement.customer_personal_information')
    </li>

    <li>
        @include('templates.agreement.employment_history')
    </li>
    <li>
        @include('templates.agreement.employer_family_info')
    </li>
    <li>
        @include('templates.agreement.accommodation')
    </li>
    <li>
        @include('templates.agreement.selected_applicant')
    </li>
</ol>

@include('templates.agreement.page_1_signature')

<div class="page-break"></div>

<table class="f-14 text-nowrap table-underline-inputs">
    <tr>
        <th>Part 2 <span class="font-normal">第二部</span>:
            Customer’s signing document for copy (
            <span class="font-normal">條款細則</span>
            ) –
        </th>
        <td width="40%" class="input-cell"></td>
    </tr>
</table>

<div class="invoice-items">

    @foreach($contract->invoice->items as $item)

        @php
            if($variant = $item->variant){
        $entity = \Modules\AgencyCore\Entities\SellableVariant::where('sellable_id', $item->sellable_id)
                ->where('variant_id', $item->variant_id)
            ->first();
    }else{
        $entity = $item->sellable;
    }

        @endphp
        @if($template = $entity->template)
            @include('templates.'.str_replace('.blade.php','',$template->view_path))
        @endif
    @endforeach
</div>


@include('templates.agreement.page_2_signature')

<div class="page-break"></div>

<p class="f-13 m-0" style="display:inline"><strong> Part 3: Customer’s Record receipt and Processing Timetable</strong> (客戶簽收文件副本記錄及申請流程表)</p>

<hr>


@include('templates.agreement.page_3_document_checklist')

<br>

@include('templates.agreement.processing_table')

<br>
@include('templates.agreement.page_3_terms')


@include('templates.agreement.page_3_footer')
</body>
</html>
