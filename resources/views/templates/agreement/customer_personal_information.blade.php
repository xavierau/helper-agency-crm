<div class="font-bold">Customer personal Information <span
        class="text-normal">(客戶個人資料)</span></div>
<div class="">
    <table class="table-condensed table-layout-fixed">
        <tr>
            <td>
                <table class="table-layout-fixed">
                    <tr>
                        <td>FULL NAME(英文全名):</td>
                        <td class="input-cell text-center">
                            {{$contract->client->prefix}} {{$contract->client->full_name}}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-layout-fixed">
                    <tr>
                        <td>Chinese(中文全名)</td>
                        <td class="input-cell text-center">
                            {{$contract->client->chinese_full_name}}
                        </td>
                        <td>
                            @if($contract->client->is_male)
                                先生
                            @else
                                女士
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-condensed table-layout-fixed">
        <tr>
            <td width="15%">OCCUPATION (職業):</td>
            <td class="input-cell text-center">{{$contract->client->occupation}}</td>

            <td width="12%" class="text-right">HKID (身份証):</td>
            <td class="input-cell text-center">{{$contract->client->hk_id}}</td>

            <td width="16%" class="text-right">Nationality (國籍):</td>
            <td class="input-cell text-center"> {{$contract->client->nationality}}</td>
        </tr>
    </table>

    <table class="table-condensed table-layout-fixed">
        <tr>
            <td width="22%">DATE OF BIRTH (出生日期):</td>
            <td class="input-cell text-center"> {{$contract->client->nationality}}</td>

            <td width="22%" class="text-right">PLACE OF BIRTH (出生地點):</td>
            <td class="input-cell text-center"> {{$contract->client->place_of_birth}}</td>

            <td width="16%" class="text-right">Status (婚姻狀況):</td>
            <td class="input-cell text-center"> {{ucwords($contract->client->marital_status)}}</td>
        </tr>
    </table>

    <table class="table-condensed table-layout-fixed">
        <tr>
            <td class="text-nowrap">HOME ADDRESS(住宅地址):</td>
            <td colspan="5" class="input-cell text-center">
                {{optional($contract->client->addresses->first())->full_address}}
            </td>
        </tr>
    </table>
    <table class="table-condensed">
        <tr>
            <td class="text-nowrap" width="1%">Home Tel (住宅電話):</td>
            <td class="input-cell text-center"> {{$contract->client->tel}}</td>

            <td class="text-nowrap" width="1%">E-MAIL (電郵):</td>
            <td class="input-cell text-center"> {{$contract->client->email}}</td>

            <td class="text-nowrap" width="1%">MOB (手機):</td>
            <td class="input-cell text-center"> {{$contract->client->mobile}}</td>
        </tr>
    </table>
</div>
