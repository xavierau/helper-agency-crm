<table class="table table-sm m-0">
    <thead>
    <tr>
        <th colspan="3">Family Status 家庭狀況</th>
        <th>Brother and sister 兄弟數目</th>
        <th>No. and age of children 子女數目和年齡</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td>Age 年齡</td>
        <td>Occupation 職業</td>
        <td>No of brothers 兄弟數目: {{$applicant->family->number_of_brothers}} </td>
        <td>Boy no. 男孩數目 {{$applicant->family->number_of_boy}}
            / Age 年齡: {{$applicant->family->age_of_boy}}</td>
    </tr>
    <tr>
        <td>Spouse 配偶</td>
        <td>{{$applicant->family->spouse_age}}</td>
        <td>{{$applicant->family->spouse_occupation}}</td>
        <td>No of sisters 姊妹數目: {{$applicant->family->number_of_sisters}} </td>
        <td>Girl no. 女孩數目 {{$applicant->family->number_of_girl}}
            / Age 年齡: {{$applicant->family->age_of_girl}}</td>
    </tr>
    <td>Father 父親</td>
    <td>{{$applicant->family->father_age}}</td>
    <td>{{$applicant->family->father_occupation}}</td>
    <td>No. in family 家中排行: {{$applicant->family->number_in_family}} </td>
    <td></td>
    </tr>
    <td>Mother 母親</td>
    <td>{{$applicant->family->mother_age}}</td>
    <td>{{$applicant->family->mother_occupation}}</td>
    <td></td>
    <td></td>
    </tr>

    </tbody>
</table>
