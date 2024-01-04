<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Page;

class GetPageContentsController extends Controller
{
    public function __invoke(Request $request, Page $page) {

        return response()->json($page->load(['contents'=>fn($q)=>$q->latest()]));
    }
}
