<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyCore\Actions\Comment\CreateComment;
use Modules\AgencyCore\DataTransferObject\CommentData;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Transformers\CommentCollection;
use Modules\AgencyCore\Transformers\CommentResource;

class JobCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Modules\AgencyCore\Entities\Job $job
     * @return \Modules\AgencyCore\Transformers\CommentCollection
     */
    public function index(Job $job) {
        $comments = $job->comments()
                        ->latest()
                        ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request                                           $request
     * @param \Modules\AgencyCore\Entities\Job                  $job
     * @param \Modules\AgencyCore\Actions\Comment\CreateComment $action
     * @return \Modules\AgencyCore\Transformers\CommentResource
     */
    public function store(Request $request, Job $job, CreateComment $action) {
        $validatedData = $this->validate($request,
                                         [
                                             'content' => 'required',
                                         ]);

        return new CommentResource($action->execute($job,
                                                    CommentData::fromFromRequest($validatedData)));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        //
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
