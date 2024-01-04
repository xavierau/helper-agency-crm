<table class="table table-sm m-0">
    <tbody>
    <tr>
        <td>
            <strong>Name of Applicant 姓名 </strong>
            <br>
            {{$applicant->name}}
        </td>
        <td>
            <strong>Sex 性別</strong>
            <br>
            {{ucwords($applicant->sex)}}
        </td>
        <td>
            <strong>Zodiac 生肖</strong>
            <br>
            {{ucwords($applicant->chinese_zodiac)}}
        </td>
        <td>
            <strong>Horoscope 星座</strong>
            <br>
            {{$applicant->getHoroscope()}}
        </td>
    </tr>
    </tbody>
</table>
