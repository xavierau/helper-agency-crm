<?php

namespace Modules\UploadDocument\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'link'  => $this->link,
        ];
    }
}
