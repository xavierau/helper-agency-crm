<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\AgencyCore\Entities\Applicant;

class AddApplicantThumbnailController extends Controller
{
    public function __invoke(Applicant $applicant, Request $request)
    {
        $this->validate(
            $request,
            [
                'file' => 'required|file|min:1',
            ]
        );

        $applicant->addMedia($request->file('file'))->toMediaCollection(Applicant::ThumbnailMediaCollection);

        return response()->json($applicant->thumbnail);
    }
}
