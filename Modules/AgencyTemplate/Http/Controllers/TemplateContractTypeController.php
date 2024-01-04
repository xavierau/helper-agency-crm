<?php

namespace Modules\AgencyTemplate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Entities\SellableVariant;
use Modules\AgencyCore\Entities\Variant;
use Modules\AgencyTemplate\Entities\Template;
use Modules\AgencyTemplate\Transformers\TemplateResource;

class TemplateContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Modules\AgencyContract\Entities\ContractType $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ContractType $type): JsonResponse {
        return response()->json(TemplateResource::collection($type->templates));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyContract\Entities\ContractType $contractType
     * @param Request                                       $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assign(ContractType $contractType, Request $request): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'template_id' => [
                                                 'required',
                                                 Rule::exists('templates',
                                                              'id'),
                                             ],
                                         ]);

        if( !$contractType->templates()->where('templates.id',
                                               $validatedData['template_id'])->exists()) {
            $contractType->templates()->attach($validatedData['template_id']);
        }

        return response()->json('completed');
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
     * @param \Modules\AgencyTemplate\Entities\Template     $template
     * @param \Modules\AgencyContract\Entities\ContractType $contractType
     * @return void
     */
    public function destroy(Template $template, ContractType $contractType): JsonResponse {
        $contractType->templates()->detach($template->id);

        return response()->json('completed');
    }

    public function getVariantTemplate(Sellable $sellable, Variant $variant): JsonResponse {
        $entity = SellableVariant::where('sellable_id',
                                         $sellable->id)
                                 ->where('variant_id',
                                         $variant->id)
                                 ->firstOrFail();
        $content = '';
        if($fileName = optional($entity->template)->view_path) {
            $content = file_get_contents(resource_path('views/templates/'.$fileName));

        }

        return response()->json($content);

    }

    public function getSellableTemplate(Sellable $sellable): JsonResponse {

        $content = "";
        if($fileName = optional($sellable->template)->view_path) {
            $content = file_get_contents(resource_path('views/templates/'.$fileName));
        }

        return response()->json($content);

    }
}
