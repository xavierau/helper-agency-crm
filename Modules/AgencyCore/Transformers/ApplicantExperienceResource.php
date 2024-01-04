<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);

        $result['duties'] = $this->whenLoaded('duties', DomesticDutyResource::collection($this->duties));

        return $result;
    }
}
