<table width="100%"
       border="0"
       align="center"
       cellpadding="0"
       cellspacing="0">
    <tbody>
    <tr>
        <td height="25">英文姓名：
        </td>
        <td colspan="4">{{$contract->client->full_name}}
        </td>
        <td>中文姓名：
        </td>
        <td></td>
    </tr>
    <tr bgcolor="#000000">
        <td height="1"
            colspan="7"></td>
    </tr>
    <tr>
        <td height="25">職業：
        </td>
        <td>{{$contract->client->occupation}}</td>
        <td>身份證:
        </td>
        <td>{{$contract->client->hk_id}}</td>
        <td>國籍：
        </td>
        <td>{{$contract->client->nationality}}</td>
    </tr>
    <tr bgcolor="#000000">
        <td height="1"
            colspan="7"></td>
    </tr>
    <tr>
        <td height="25">出生日期：
        </td>
        <td>{{$contract->client->date_of_birth->format('Y/m/d')}}</td>
        <td>出生地點:
        </td>
        <td>{{$contract->client->place_of_birth}}</td>
        <td>婚姻狀況：
        </td>
        <td>{{$contract->client->marital_status}}</td>
    </tr>
    <tr bgcolor="#000000">
        <td height="1"
            colspan="7"></td>
    </tr>
    <tr>
        <td height="25">
            <div align="left">住址：</div>
        </td>
        <td colspan="6">{{implode(',',[optional($contract->address)->address_1,
optional($contract->address)->address_2,
optional($contract->address)->address_3,
optional($contract->address)->country])}}
        </td>
    </tr>
    <tr bgcolor="#000000">
        <td height="1"
            colspan="7"></td>
    </tr>
    <tr>
        <td height="25">電郵：
        </td>
        <td colspan="2">{{$contract->client->email}}</td>
        <td>住宅電話:
        </td>
        <td>{{$contract->client->tel}}</td>
        <td>手機：
        </td>
        <td>{{$contract->client->mobile}}
        </td>
    </tr>
    <tr bgcolor="#000000">
        <td height="1" colspan="7"></td>
    </tr>
    </tbody>
</table>
