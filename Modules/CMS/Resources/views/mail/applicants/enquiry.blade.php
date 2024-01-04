Applicants Enquiry <br>

Applicant HK Code <br>
@foreach($applicants as $applicant)
{{$applicant->hk_code}} <br>
@endforeach

@foreach($contactInfo as $key=>$info)
{{$key}}: {{$info}} <br>
@endforeach


