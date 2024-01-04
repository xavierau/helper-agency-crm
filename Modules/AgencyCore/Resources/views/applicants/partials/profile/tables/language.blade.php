<table class="table">
    <thead>
    <tr>
        <th colspan="5">Foreign Languages 外國語言</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td>Native 好好</td>
        <td>Good 好</td>
        <td>Fair 平</td>
        <td>Poor 差</td>
    </tr>
    <tr>
        <td>English 英語</td>
        <td>{!!  $applicant->english === 'Native' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->english === 'Good' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->english === 'Fair' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->english === 'Poor' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
    </tr>
    <tr>
        <td>Cantonese 廣東話</td>
        <td>{!!$applicant->cantonese === 'Native' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->cantonese === 'Good' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->cantonese === 'Fair' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->cantonese === 'Poor' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
    </tr>
    <tr>
        <td>Mandarin 國語</td>
        <td>{!!$applicant->mandarin === 'Native' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->mandarin === 'Good' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->mandarin === 'Fair' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
        <td>{!!$applicant->mandarin === 'Poor' ? "<i class='fa-solid fa-check'></i>":""!!}</td>
    </tr>
    <tr>
        <td>Other 其它</td>
        <td colspan="4">{{$applicant->other_language }}</td>
    </tr>
    </tbody>
</table>
