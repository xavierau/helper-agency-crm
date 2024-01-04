<?php

namespace Modules\AgencyTemplate\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'    => $this->id    ,
            'label' => $this->label,
            'tags'  => json_decode($this->tags),
        ];
    }
}
