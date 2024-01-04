<table class="table table-sm m-0">
    <tbody>
    <tr>
        <td>
            *Do you change the name before
        </td>
        <td>
            @if($applicant->questions?->change_name !== null and  !$applicant->questions->change_name)
                <i class="fa-regular fa-square-check"></i>
                Yes <span class="underline">{{$applicant->questions->change_name_info}}</span>
            @else
                <i class="fa-regular fa-square"></i>
                Yes __
            @endif


            @if($applicant->questions?->change_name === null or $applicant->questions->change_name)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            No
        </td>
    </tr>
    <tr>
        <td>
            *Have you been refused entry into, deported from, remove from or required to leave in HK?
        </td>
        <td>

            @if($applicant->questions?->has_been_deport !== null and !$applicant->questions->has_been_deport)
                <i class="fa-regular fa-square-check"></i>
                Yes <span class="underline">{{$applicant->questions->has_been_deport_info}}</span>
            @else
                <i class="fa-regular fa-square"></i>
                Yes __
            @endif

            @if($applicant->questions?->has_been_deport === null or $applicant->questions->has_been_deport)
                <i class="fa-regular fa-square-check"></i>
                No
            @else
                <i class="fa-regular fa-square"></i>
                No
            @endif

        </td>
    </tr>
    <tr>
        <td>
            *Have you been refused a visa from entry in to HK?
        </td>
        <td>
            @if($applicant->questions?->reject_visa !== null and  !$applicant->questions->reject_visa)
                <i class="fa-regular fa-square-check"></i>
                Yes <span class="underline">{{$applicant->questions->reject_visa_info}}</span>
            @else
                <i class="fa-regular fa-square"></i>
                Yes __
            @endif


            @if($applicant->questions?->reject_visa === null or $applicant->questions->reject_visa)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            No
        </td>
    </tr>
    <tr>
        <td>
            Do you afraid of Dog?
        </td>
        <td>
            @if($applicant->questions->afraid_of_dog)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            Yes

            @if(!$applicant->questions->afraid_of_dog)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            No
        </td>
    </tr>
    <tr>
        <td>
            Do you smoke & drink?
        </td>
        <td>
            @if($applicant->questions->smoke_and_drink)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            Yes

            @if(!$applicant->questions->smoke_and_drink)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            No
        </td>
    </tr>
    <tr>
        <td>
            Do you eat pork?
        </td>
        <td>
            @if($applicant->questions->eat_pork)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            Yes

            @if(!$applicant->questions->eat_pork)
                <i class="fa-regular fa-square-check"></i>
            @else
                <i class="fa-regular fa-square"></i>
            @endif
            No
        </td>
    </tr>
    </tbody>
</table>
