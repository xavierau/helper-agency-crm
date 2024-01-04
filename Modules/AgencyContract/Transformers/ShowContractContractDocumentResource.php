<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowContractContractDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'    => $this->id,
            'label' => $this->label,
            'doc'   => ['value' => $this->doc->value],
        ];
    }
}
