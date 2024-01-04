<div class="font-bold">Employment history and Existing helper record (<span
        class="font-normal">聘用記錄及現任傭工狀況</span>)
</div>

<div class="f-12">
    <table class="table-layout-auto">
        <tr>
            <td>
                Employer apply the application for (僱主現時申請為):
                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{$contract->applicant->name}}
                    <span class="font-for-spaces">

                    </span>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                Expecting a new helper arrive in HK(要求到港日期):

                <span class="text-underline">
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    {{optional($contract->requirement->expected_arrival_date)->format('d/m/Y')}}
                    <span class="font-for-spaces">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </span>
            </td>
        </tr>
    </table>

    <table class="table-bordered">
        <thead class="text-center">
        <tr>
            <td colspan="2">CHANGE OR EXISTING EMPLOYEE NAME <br> (替換女傭/現任女傭)</td>
            <td>HKID OR PASSPORT <br> (身份証/護照)</td>
            <td>TERMINATE/FINISH DATE <br> (終止/完約日)</td>
            <td>EMPLOYER NAME <br> (僱主名)</td>
        </tr>
        </thead>
        <tbody class="text-center">
        <tr>
            <td class="text-left" style="width:21%">轉換 Replace</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="background-color: black;"></td>
        </tr>
        <tr>
            <td class="text-left">*現有 Exist/ 轉換 Replace</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="text-left">*現有 Exist/ 轉換 Replace</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="text-left">*現有 Exist/ 轉換 Replace</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="text-left">*現有 Exist/ 轉換 Replace</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
