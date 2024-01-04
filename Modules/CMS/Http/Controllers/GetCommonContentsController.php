<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Content;

class GetCommonContentsController extends Controller
{
    public function __invoke() {
        return response()->json(Content::common()->get());
    }
}
