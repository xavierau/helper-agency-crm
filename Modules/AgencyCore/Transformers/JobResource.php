<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'id'           => $this->id,
            'service_type' => $this->service_type,
            'type'         => $this->type,
            'nationality'  => $this->nationality,
            'status'       => $this->status,
            'services'     => $this->services,
            'created_at'   => $this->created_at,
            'client'       => $this->whenLoaded('client', (new ClientResource($this->client))->onlyBasic()),
            'requirement'  => new RequirementResource($this->requirement),
        ];
    }
}
