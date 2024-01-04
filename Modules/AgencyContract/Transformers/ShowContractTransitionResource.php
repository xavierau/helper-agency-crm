<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowContractTransitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'            => $this->id,
            'label'         => $this->label,
            'code'          => $this->code,
            'from_state_id' => $this->from_state_id,
            'to_state_id'   => $this->to_state_id,
        ];
    }
}
