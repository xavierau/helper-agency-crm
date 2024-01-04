<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Page;

class UpdatePageContentController extends Controller
{
    public function __invoke(Request $request, Page $page, string $key)
    {

        $this->updateContent($page,
            $key,
            $request);

        return response()->json($request->all());

    }

    /**
     * @param \Modules\CMS\Entities\Page $page
     * @param string $key
     * @param \Illuminate\Http\Request $request
     */
    private function updateContent(Page $page, string $key, Request $request): void
    {
        $engContent = $page->contents()->where('key', $key)
            ->where('language', 'en')
            ->first();

        $engContent->update(['content' => $request->get('en_content')]);

        $chiContent = $page->contents()->where('key', $key)
            ->where('language', 'zh')
            ->first();

        $chiContent->update(['content' => $request->get('zh_content')]);

    }
}
