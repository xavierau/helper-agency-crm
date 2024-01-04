<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Content;

class ShowCommonContentController extends Controller
{

    public function __invoke(string $key) {
        return response()->json(Content::common()->key($key)->first());
    }
}
