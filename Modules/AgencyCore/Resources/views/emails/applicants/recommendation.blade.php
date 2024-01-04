Dear {{$client->prefix}} {{$client->last_name}},

We recommend the following candidates.

@foreach($applicants as $applicant)
    <p>{{$applicant->name}}</p>
@endforeach

Thanks,
System
