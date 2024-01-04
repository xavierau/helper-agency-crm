<?php

namespace Modules\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CMS\Entities\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        return response()->json(News::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $validatedData = $this->validate($request,
                                         [
                                             'title'         => ['required'],
                                             'title_chi'     => ['nullable'],
                                             'summary'       => ['nullable'],
                                             'summary_chi'   => ['nullable'],
                                             'content'       => ['nullable'],
                                             'content_chi'   => ['nullable'],
                                             'thumbnail'     => ['nullable', 'file'],
                                             'thumbnail_chi' => ['nullable', 'file'],
                                         ]);


        $news = News::create($validatedData);

        if($request->file('thumbnail')) {
            $news->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
        }

        if($request->file('thumbnail_chi')) {
            $news->addMedia($request->file('thumbnail_chi'))->toMediaCollection('thumbnail_chi');
        }

        return response()->json($validatedData);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(News $news) {
        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }
}
