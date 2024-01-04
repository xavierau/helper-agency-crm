<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ContractListResource extends ResourceCollection
{
    public $collects = ContractResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return parent::toArray($request);
    }
}
