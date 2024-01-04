<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Content;

class UpdateCommonContentsController extends Controller
{

    public function __invoke(Request $request, string $key) {
        $content = Content::common()->key($key)->first();

        $content->update([
                             'content' => $request->get('content'),
                         ]);

        return response()->json(['message' => 'content updated!']);
    }
}
