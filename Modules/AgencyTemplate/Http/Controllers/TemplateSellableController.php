<?php

namespace Modules\AgencyTemplate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Entities\SellableVariant;
use Modules\AgencyCore\Entities\Variant;
use Modules\AgencyTemplate\Actions\CreateEntityTemplate;

class TemplateSellableController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyCore\Entities\Sellable                $sellable
     * @param Request                                              $request
     * @param \Modules\AgencyTemplate\Actions\CreateEntityTemplate $action
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(
        Sellable $sellable, Request $request, CreateEntityTemplate $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'variant_id' => [
                                                 'nullable',
                                                 Rule::exists('sellable_variant',
                                                              'variant_id')
                                                     ->where(function($query) use ($sellable) {
                                                         return $query->where('sellable_id',
                                                                              $sellable->id);
                                                     }),
                                             ],
                                             'content'    => 'required',
                                         ]);
        if($sellableVariantId = $validatedData['variant_id'] ?? null) {
            $entity = SellableVariant::where('sellable_id',
                                             $sellable->id)
                                     ->where('variant_id',
                                             $sellableVariantId)
                                     ->first();

        } else {
            $entity = $sellable;
        }

        $fileName = Str::random(16).'.blade.php';

        $action->execute($entity,
                         $fileName,
                         $validatedData['content']);

        return response()->json($fileName);
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
