<table class="table table-sm m-0">
    <thead>
    <tr>
        <th colspan="2">Other Information 其它資料</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <strong>Date of Release:</strong> {{$applicant->date_of_release?->format('d/m/Y')}}
        </td>
        <td>
            <strong>VISA Expiry
                Date:</strong> {{ \Illuminate\Support\Carbon::make($applicant->personal_document?->visa_expiry_date)?->format('d/m/Y')}}
        </td>

    </tr>

    </tbody>
</table>
