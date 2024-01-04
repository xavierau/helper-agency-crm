
<table class="table table-sm m-0">
    <thead>
    <tr>
        <th>Marital Status 婚姻狀況</th>
        <th>Address Zone 居住地區</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ucwords($applicant->marital_status)}}</td>
        <td>{{ucwords(Str::headline($applicant->current_location))}}</td>
    </tr>
    </tbody>
</table>
