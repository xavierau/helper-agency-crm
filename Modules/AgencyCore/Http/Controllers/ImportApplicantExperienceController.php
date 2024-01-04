<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ApplicantExperienceImport;
use App\Imports\ApplicantImport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportApplicantExperienceController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        $import = new ApplicantExperienceImport();

        Excel::import($import, $file);

        return response('', 204);
    }
}
