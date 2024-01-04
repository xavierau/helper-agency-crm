<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowContractContractDateResource extends JsonResource
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
            'value' => ['value' => $this->value->value],
        ];
    }
}
