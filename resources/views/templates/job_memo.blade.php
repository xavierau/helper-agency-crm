<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Job Offering Memo</title>

    <style type="text/css">
        @page {
            margin: 10px 20px;
        }

        body {
            margin: 10px 20px;
            font-size: 11px;
        }

        @font-face {
            font-family: 'Firefly Sung' ;
            font-style: normal;
            font-weight: 400;
            src: url("fireflysung.ttf") format('truetype');
        }

        * {
            font-family: Firefly Sung, DejaVu Sans, sans-serif;
        }

        .font-for-spaces {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
        }

        .table-layout-fixed {
            table-layout: fixed;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-underline {
            text-decoration: underline;
        }

        .text-justify {
            text-align: justify;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
        }

        .f-10 {
            font-size: 10px;
        }


        input {
            text-align: center;
        }

        input, input:hover, input:focus {
            border-top: 0 none;
            border-left: 0 none;
            border-right: 0 none;
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

        p {
            margin: 0;
            padding: 0;
        }

        td.input-cell, li.input-cell {
            border-bottom: 1px solid black;
            /*height: 14px;*/
        }
    </style>

</head>
<body>

<h2>JOB OFFER MEMO</h2>
<div>
    <table class="table-layout-fixed">
        <tr>
            <td rowspan="2">

                <table>
                    <tr>
                        <td width="20px">TO: </td>
                        <td class="input-cell">
{{--                            {{$contract->applicant->name}}--}}
                            {{optional($contract->applicant->supplier)->name}}
                        </td>
                    </tr>
                    <tr>
                        <td width="20px">FR:</td>
                        <td class="input-cell">
                            <table class="">
                                <tr>
                                    <td>

                                    </td>
                                    <td width="80px" class="text-right">
                                        (Branch 分店)
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>

            <td rowspan="2">
                <table>
                    <tr>
                        <td width="60px">REF NO:</td>
                        <td class="input-cell">
                            {{$contract->applicant->vcac_number}}
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">SALES:</td>
                        <td class="input-cell"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<p class="font-bold">PLEASE INFORM THAT THIS APPLICANT HAS BEEN HIRED AND DETAIL INFORMATION OF EMPLOYER AS FOLLOWS:</p>

<div>
    <table class="table-layout-fixed">
        <tr>
            <td>DATE OF HIRING :</td>
            <td class="input-cell">{{now()->format('d/m/Y')}}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>HK / AGENCY REF NO. :</td>
            <td class="input-cell"></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>NAME OF APPLICATIONS :</td>
            <td class="input-cell"> {{$contract->applicant->name}} </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>MONTHLY SALARY :</td>
            <td class="input-cell">HKD {{number_format($contract->salary)}}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>EXPECT TO HK :</td>
            <td class="input-cell">{{optional($contract->requirement->expected_arrival_date)->format('d/m/Y')}}</td>
            <td colspan="2"></td>
        </tr>
    </table>
</div>

<p class="font-bold">A) EMPLOYERS’S INFORMATION :</p>

<div>
    <table class="table-layout-fixed">
        <tr>
            <td>ADDRESS :</td>
            <td colspan="3" class="input-cell">
                {{optional($contract->address)->full_address}}
            </td>
        </tr>
        <tr>
            <td>HOUSE SIZE:</td>
            <td class="input-cell">{{$contract->requirement->house_size}}</td>
            <td colspan="2">
                 SQ FEET WITH
                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{$contract->requirement->number_of_rooms}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>
                ROOMS.
            </td>
        </tr>
        <tr>
            <td>NAME OF EMPLOYER:</td>
            <td class="input-cell">{{$contract->client->full_name}}</td>
            <td colspan="2">
                (NO. OF FAMILY <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{$contract->residents->count() + 1}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>)
            </td>
        </tr>
        <tr>
            <td>NO. OF ADULTS:</td>
            <td class="input-cell">{{$contract->requirement->number_of_adults}}</td>
            <td colspan="2">
                (AGED <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{implode(', ',$contract->requirement->age_of_adults)}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>)
            </td>
        </tr>
        <tr>
            <td>NO. OF CHILDREN:</td>
            <td class="input-cell">{{$contract->requirement->number_of_kids + $contract->requirement->number_of_young_adults}}</td>
            <td colspan="2">
                (AGED BELOW 5: <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{implode(', ',$contract->requirement->age_of_kids)}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>)
                (AGED BELOW 5-18: <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{implode(', ',$contract->requirement->age_of_young_adults)}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>)
            </td>
        </tr>

        <tr>
            <td>NO. OF EXPECTING BABY :</td>
            <td class="input-cell">{{$contract->requirement->number_of_expecting_babies}}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>NO. OF CONSTANT CARE :</td>
            <td class="input-cell">{{$contract->requirement->disabled_personeel}}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>NO. OF HELPERS IN FAMILY :</td>
            <td class="input-cell"></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>SPECIAL DUTIES:</td>
            <td colspan="3" class="input-cell">{{$contract->requirement->special_duties}}</td>
        </tr>
    </table>
</div>

<p class="font-bold">B) ACCOMMODATION:</p>

<div>
    <table>
        <tr>
            <td width="20">
                <input type="checkbox"
                       @if($contract->requirement->accommodation_type === 'alone') checked @endif></td>
            <td>
                ESTIMATED SIZE OF SERVANT ROOM:
                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    @if($contract->requirement->accommodation_type === 'alone') {{$contract->requirement->accommodation_value}} @endif
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>
                SQ FEET/SQUARE METRES*
            </td>
        </tr>
        <tr>
            <td width="20"><input type="checkbox"
                                  @if($contract->requirement->accommodation_type === 'shared') checked @endif></td>
            <td>
                SLEEPING WITH:
                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    @if($contract->requirement->accommodation_type === 'shared') {{$contract->requirement->accommodation_value}} @endif
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>

<p class="font-bold">C) SPECIAL REQUESTS FROM EMPLOYER:</p>

<div>
    <ul>
        <li>EMPLOYER ARRANGES FOR HELPER TO TAKE DAYOFF, OR PROVIDE MONETARY COMPENSATION AS AN ALTERNATIVE.</li>
        <li>USE OF MOBILE PHONE OR ANY MESSAGING DEVICES ARE STRICTLY PROHIBITED DURING WORK HOURS.</li>
        <li>HELPER CANNOT POST PHOTOS OF THEIR EMPLOYER’’S HOME OR FAMILY MEMBERS IN ANY MEDIA.</li>
        <li>ENGAGEMENT WITH ANY LOAN COMPANIES ARE STRICTLY PROHIBITED.</li>
        <li class="input-cell">
            <span style="color:white">empty</span>
        </li>
        <li class="input-cell">
            <span style="color:white">empty</span>
        </li>
        <li class="input-cell">
            <span style="color:white">empty</span>
        </li>
    </ul>

</div>

<p class="font-bold">D) APPLICANT PROVIDE INFORMATION:</p>

<div class="f-10">
    <table class="table-layout-fixed">
        <tr>
            <td>1. FULL RESIDENCE ADDRESS:</td>
            <td colspan="3" class="input-cell">
                {{$contract->applicant->address->full_address}}
            </td>
        </tr>
    </table>
    <table class="table-layout-fixed table-condensed">
        <tr>
            <td>2. EMERGENCY INFO:</td>
            <td colspan="3" class="input-cell">
                <table class="table-condensed">
                    <tr>
                        <td width="40%">{{$contract->applicant->emergency_contact_name}}</td>
                        <td>(Name);</td>

                        <td width="35%">{{$contract->applicant->emergency_contact_relation}}</td>
                        <td>(RELATIONSHIP);</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="table-layout-fixed table-condensed">
        <tr>
            <td>3. CONTACT NO.:</td>
            <td colspan="3" class="input-cell">
                <table class="">
                    <tr>
                        <td width="23%">{{$contract->applicant->mobile}}</td>
                        <td>(APPLICANT);</td>

                        <td width="16%">{{$contract->applicant->emergency_contact_number}}</td>
                        <td>(EMERGENCY CONTACT);</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-layout-fixed table-condensed">
        <tr>
            <td>4. HKID NO.:</td>
            <td class="input-cell">{{$contract->applicant->hk_id}}</td>
            <td>PASSPORT NO.:</td>
            <td class="input-cell">{{$contract->applicant->passport_number}}</td>
            <td>ISSUED DATE:</td>
            <td class="input-cell">{{optional($contract->applicant->passport_issued_date)->format('d/m/Y')}}</td>
            <td>EXPIRING DATE:</td>
            <td class="input-cell">{{optional($contract->applicant->passport_expiring_date)->format('d/m/Y')}}</td>
        </tr>
    </table>
</div>

<p class="font-bold">E) HELPER DECLARATION:</p>

<div>
    <table class="table-layout-fixed">
        <tr>
            <td colspan="4">
                I, MR/MS.
                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{$contract->applicant->name}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>
                AGREE AND FULLY UNDERSTAND THE ABOVE JOB
                TERMS AND CONDITION, AND AGREE TO COMPLETE THE CONTRACT FULLY FOR 2 YEARS.
            </td>
        </tr>
    </table>
</div>

<div class="text-center">
    <table class="table-layout-fixed" style="border-spacing: 20px; margin-top: 20px;">
        <tr>
            <td class="input-cell"></td>
            <td class="input-cell"></td>
            <td class="input-cell"></td>
        </tr>
        <tr class="text-center text-bold">
            <td>
                NAME OF APPLICANT
            </td>
            <td>
                SIGNATURE OF APPLICANT
            </td>
            <td>
                THUMB MARK
            </td>
        </tr>
    </table>
</div>

</body>
</html>
