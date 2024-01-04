<?php

namespace Modules\CMS\Http\Controllers;

use App\Mail\ContactUsEmail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function __invoke(Request $request) {
        $email = common_content('contact_us_email',
                                'xavier.au@anacreation.com');

        Mail::to($email)->send(new ContactUsEmail($request->all()));

        return redirect()->back()->with('message',
                                        __("Thank you! We will get back to you soon."));
    }
}
