<div class="font-bold">Selected Applicant <span
        class="font-normal">揀選傭工</span>: Code No <span
        class="font-normal">編號.</span>: {{$contract->applicant->ref_number}}
        </div>

<div class="f-11">
    <table class="table-condensed table-layout-auto">
        <tr>
            <td width="250">
                <table class="table-layout-fixed">
                    <tr>
                        <td width="43%">FULLNAME (英文全名): Mr/Ms.</td>
                        <td class="input-cell text-center">{{$contract->applicant->name}}</td>
                    </tr>
                </table>
            </td>

            <td>
                <table class="table-layout-fixed">
                    <tr>
                        <td class="text-nowrap text-right">HKID (身份証):</td>
                        <td class="input-cell text-center">{{$contract->applicant->hk_id}}</td>
                    </tr>
                </table>
            </td>

            <td>
                <table class="table-layout-fixed">
                    <tr>
                        <td class="text-nowrap text-right">Nationality(國籍)</td>
                        <td class="input-cell text-center">{{$contract->applicant->nationality}}</td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>

    <table class="table-condensed">
        <tr>
            <td width="10%">DATE OF BIRTH (出生日期):</td>
            <td class="input-cell text-center"
                style="vertical-align:bottom">{{$contract->applicant->date_of_birth->format('d/m/Y')}}</td>

            <td width="12%" class="text-right">PLACE OF BIRTH (出生地點):</td>
            <td class="input-cell text-center"
                style="vertical-align:bottom">{{$contract->applicant->place_of_birth}}</td>

            <td width="10%" class="text-right">Status (婚姻狀況):</td>
            <td class="input-cell text-center"
                style="vertical-align:bottom">{{ucwords($contract->applicant->marital_status)}}</td>

            <td width="10%" class="text-right">Local Tel (當地手機):</td>
            <td class="input-cell text-center"
                style="vertical-align:bottom">{{$contract->applicant->mobile}}</td>
        </tr>
    </table>

    <table class="table-condensed text-nowrap table-underline-inputs">
        <tr>
            <td width="10%">Passport No (護照編號).:</td>
            <td class="input-cell text-center">{{$contract->applicant->passport_number}}</td>
            <td width="10%" class="text-right">Issued Date (發出日期)</td>
            <td class="input-cell text-center">{{optional($contract->applicant->passport_issued_date)->format('d/m/Y')}}</td>
            <td class="text-right" width="10%">Issued place 簽發地區</td>
            <td class="input-cell text-center">{{$contract->applicant->passport_issued_place}}</td>
        </tr>
    </table>

    <table class="table-condensed text-nowrap table-underline-inputs">
        <tr>
            <td width="10%">HOME ADDRESS(住宅地址):</td>
            <td class="input-cell text-center">{{$contract->applicant->addresses->first()->full_address}}</td>

            <td width="8%">HK Tel (香港手機):</td>
            <td class="input-cell text-center">{{$contract->applicant->hk_mobile}}</td>
        </tr>
    </table>
</div>
