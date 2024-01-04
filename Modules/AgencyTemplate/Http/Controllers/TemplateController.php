<?php

namespace Modules\AgencyTemplate\Http\Controllers;

use App\Services\DocumentStorageManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AgencyTemplate\Actions\CreateTemplate;
use Modules\AgencyTemplate\Actions\UpdateTemplate;
use Modules\AgencyTemplate\DataTransferObjects\TemplateData;
use Modules\AgencyTemplate\Entities\Template;
use Modules\AgencyTemplate\Http\Requests\TemplateStoreRequest;
use Modules\AgencyTemplate\Http\Requests\TemplateUpdateRequest;
use Modules\AgencyTemplate\Transformers\TemplateResource;

class TemplateController extends Controller
{

    public function all(): JsonResponse {
        return response()->json(TemplateResource::collection(Template::all()));
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse {
        return response()->json(TemplateResource::collection(Template::all()));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyTemplate\Http\Requests\TemplateStoreRequest $request
     * @param \Modules\AgencyTemplate\Actions\CreateTemplate             $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TemplateStoreRequest $request, CreateTemplate $action) {
        $template = $action->execute(TemplateData::fromFormData($request->validated()));

        return response()->json($template);
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyTemplate\Entities\Template $template
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Template $template): JsonResponse {
        return response()->json(new TemplateResource($template));
    }

    /**
     * Update the specified resource in storage.
     * @param Request                                        $request
     * @param \Modules\AgencyTemplate\Entities\Template      $template
     * @param \Modules\AgencyTemplate\Actions\UpdateTemplate $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        TemplateUpdateRequest $request, Template $template, UpdateTemplate $action): JsonResponse {

        $template = $action->execute($template,
                                     TemplateData::fromFormData($request->validated()));

        return response()->json(new TemplateResource($template));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function getContent(Template $template, DocumentStorageManager $manager) {

        $content = file_get_contents(resource_path('views/templates/'.$template->view_path));

        return response(json_encode($content));
    }
}
