<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowContractContractTypeContractDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'         => $this->id,
            'label'      => $this->label,
            'assignment' => [
                'order'       => $this->assignment->order,
                'is_required' => $this->assignment->is_required,
            ],
        ];
    }
}
