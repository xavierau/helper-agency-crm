<table width="100%"
       border="1"
       cellpadding="0"
       cellspacing="0">
        <tbody>
        <tr>
            <td style="text-align:center">
                NAME(姓名)
            </td>
            <td style="text-align:center">
                Relationship(關係)
            </td>
            <td style="text-align:center">
                Date of Birth(出生年份)
            </td>
            <td style="text-align:center">
                HKID Number(身份証號碼)
            </td>
        </tr>
        @foreach($contract->residents as $index=>$resident)
            <tr>
                <td>{{$index+1}}/ {{$resident->full_name}}</td>
                <td>{{$resident->pivot->relation}}</td>
                <td>{{$resident->is_male?'M':'F'}} {{$resident->date_of_birth->format('Y/m/d')}}</td>
                <td>{{$resident->hk_id??""}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
