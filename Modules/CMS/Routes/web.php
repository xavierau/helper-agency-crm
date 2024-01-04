<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\AgencyCore\Entities\Applicant;
use Modules\CMS\Emails\ApplicantEnquiry;
use Modules\CMS\Entities\Content;
use Modules\CMS\Entities\News;
use Modules\CMS\Entities\Page;
use Modules\CMS\Http\Controllers\SendApplicantEnquiryController;

Route::get('/setLocale/{locale}', function ($locale) {
        session(['_locale' => $locale,]);

        return redirect()->back();
    }
);


Route::group(['middleware' => 'locale'], function () {

    Route::post('/contact_us', 'ContactUsController');

    Route::get('/applicants_enquiry', fn() => view('contact_us_with_applicant', ['page' => Page::where('url', 'contact_us')->first()]))
        ->name('applicants_enquiry');

    Route::post('/applicants_enquiry', "SendApplicantEnquiryController"
    )->name('applicants_enquiry');

    Route::view('/news', view("news"));

    Route::get('/news/{news}', function (News $news) {
        return view(
            "news_item",
            ['news' => $news]
        );
    }
    );

    Route::get('/search_applicants', 'SearchApplicantController')
        ->name('search_applicants');

    Route::fallback('CmsRouteController')->middleware('locale');

});
