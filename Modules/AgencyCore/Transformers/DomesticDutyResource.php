<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DomesticDutyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"    => $this->id,
            "label" => __($this->label)
        ];
    }
}
