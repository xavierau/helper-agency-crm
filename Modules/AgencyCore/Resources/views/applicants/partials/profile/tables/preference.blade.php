<table class="table table-sm m-0 table-bordered">
    <thead>
    <tr>
        <th colspan="8">Willing to working 願意接受工作</th>
    </tr>
    </thead>
    <tbody>
    @foreach(array_chunk(\Modules\AgencyCore\Services\DefaultDomesticDuties::get(),4) as $row)
        <tr>
            @foreach($row as $data)
                <td style="width: 22%">{{$data['label']}} {{trans($data['label'])}}</td>
                <td>@if($applicant->duties->contains('label',$data['label']))
                        <i class="fa-solid fa-check"></i>@endif</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
