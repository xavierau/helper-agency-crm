<?php

namespace Modules\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\AgencyCore\Entities\Applicant;
use Modules\CMS\Emails\ApplicantEnquiry;
use Modules\CMS\Entities\Content;

class SendApplicantEnquiryController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = $this->validate($request, [
            'name'           => 'required',
            'tel'            => 'required',
            'email'          => 'required|email',
            'marital_status' => 'nullable',
            'message'        => 'nullable',
        ]);

        $cart = session()->get('cart');

        $applicantHKCodes = array_keys($cart);

        $applicants = Applicant::whereIn('hk_code', $applicantHKCodes)
            ->get();

        $email = Content::where('key', 'contact_us_email')
            ->first();

        $emails = collect(explode(',', $email->content))
            ->map(fn($i) => trim($i))
            ->toArray();


        Mail::to($emails)->send(new ApplicantEnquiry($applicants, $data));

        session()->forget('cart');

        return redirect()->back()->with('message', 'Thank you for your enquiry. We will get back to you soon');
    }
}
