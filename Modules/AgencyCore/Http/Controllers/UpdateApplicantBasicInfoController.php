<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Http\Requests\UpdateApplicantBasicInfoRequest;

class UpdateApplicantBasicInfoController extends Controller
{
    public function __invoke(UpdateApplicantBasicInfoRequest $request, Applicant $applicant)
    {

        $applicant->update($request->validated());

        if ($request->has('duties')) {
            $applicant->duties()->sync($request->duties);
        }

        return response()->json([
            'message' => 'Applicant basic info updated successfully',
            'data'    => $applicant->refresh()
        ]);
    }
}
