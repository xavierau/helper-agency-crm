<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Entities\Variant;
use Modules\AgencyCore\Http\Requests\SellableVariantStoreRequest;
use Modules\AgencyCore\Http\Requests\SellableVariantUpdateRequest;

class SellableVariantController extends Controller
{

    public function store(SellableVariantStoreRequest $request, Sellable $sellable): JsonResponse {
        $variantIds = array_merge($sellable->variants->pluck('id')->toArray(),
                                  ($request->validated())['variants']);
        $sellable->variants()->sync($variantIds);
        $sellable->refresh()->load('variants');

        return response()->json($sellable);
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyCore\Entities\Sellable $sellable
     * @param \Modules\AgencyCore\Entities\Variant  $variant
     * @return void
     */
    public function show(Sellable $sellable, Variant $variant): JsonResponse {


        return response()->json([
                                    'product' => $sellable,
                                    'variant' => $variant,
                                ]);
    }


    /**
     * @param \Modules\AgencyCore\Http\Requests\SellableVariantUpdateRequest $request
     * @param \Modules\AgencyCore\Entities\Sellable                          $sellable
     * @param \Modules\AgencyCore\Entities\Variant                           $variant
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        SellableVariantUpdateRequest $request, Sellable $sellable,
        Variant $variant
    ): JsonResponse {
        $sellable->variants()->updateExistingPivot($variant->id,
                                                   $request->validated());

        return response()->json($variant->refresh());
    }


    public function destroy(Sellable $sellable, Variant $variant): JsonResponse {
        $sellable->variants()->detach($variant->id);

        $sellable->refresh()->load('variants');

        return response()->json($sellable);
    }
}
