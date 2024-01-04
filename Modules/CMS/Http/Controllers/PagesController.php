<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Page;

class PagesController extends Controller
{

    public function __invoke() {
        return response()->json(Page::all());
    }
}
