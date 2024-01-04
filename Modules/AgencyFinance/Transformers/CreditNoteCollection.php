<?php

namespace Modules\AgencyFinance\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CreditNoteCollection extends ResourceCollection
{
    public $collects = CreditNoteResource::class;

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
