<table class="table table-sm m-0">
    <thead>
    <tr>
        <th colspan="7">Latest Working Experience 最近工作經驗</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <strong>Work Place 工作地區</strong>
        </td>
        <td>
            <strong>Period 工作期</strong>
        </td>
        <td>
            <strong>Position 位置</strong>
        </td>
        <td>
            <strong>Duties 責任</strong>
        </td>
    </tr>
    @foreach($applicant->experiences()->latest()->limit(3)->get() as $experience)
        <tr>
            <td>
                {{$experience->location ?? "NIL"}}
            </td>
            <td style="word-break-wrap: none">
                {{$experience->from->format('Y')}} - {{$experience->to->format('Y')}}
            </td>

            <td>
                {{$experience->position}}
            </td>
            <td>
                {{$experience->profileDuties()}}
            </td>
        </tr>
        <tr>
            <td>
                Finished

                @if($experience->status ==='finished')
                    <i class="fa-regular fa-square-check"></i>
                @else
                    <i class="fa-regular fa-square"></i>
                @endif
                /
                Term
                @if($experience->status ==='terminated')
                    <i class="fa-regular fa-square-check"></i>
                @else
                    <i class="fa-regular fa-square"></i>
                @endif
            </td>
            <td colspan="3">
                Reason: {{$experience->reason}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
