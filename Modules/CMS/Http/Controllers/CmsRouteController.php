<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Page;

class CmsRouteController extends Controller
{
    public function __invoke(Request $request)
    {

        if ($page = Page::getPageByPath($request->path())) {

            return view($page->view,
                compact('page'));
        }

        return $request->wantsJson() ?
            response('endpoint not found',
                404) :
            view(404);

    }

}
