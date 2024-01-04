<table class="table table-sm m-0">
    <tbody>
    <tr>
        <td>
            <strong>Nationality 國籍</strong>
            <br>
            {{ucwords($applicant->nationality)}}
        </td>
        <td>
            <strong>Date of Birth 出生日期</strong>
            <br>
            {{$applicant->date_of_birth?->format('d/m/Y')}} ({{$applicant->age}})
        </td>
        <td>
            <strong>Height </strong>
            <br>
            {{$applicant->height}} cm
        </td>
        <td>
            <strong>Weight</strong>
            <br>
            {{$applicant->weight}} kg
        </td>
        <td>
            <strong>Religion</strong>
            <br>
            {{ucwords($applicant->religion)}}
        </td>


    </tr>
    </tbody>
</table>
