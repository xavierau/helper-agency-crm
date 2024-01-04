<table class="table table-sm m-0">
    <thead>
    <tr>
        <th>Education Attainment 教育程度</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            Highest Education: {{ucwords($applicant->highest_education)}} <br>
            @if($applicant->highest_education === 'university')
            Others:{{$applicant->education->major}}
            @endif
        </td>
    </tr>
    </tbody>
</table>
