<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyContract\Transformers\ContractResource;

class ApplicantShowResource extends JsonResource
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

        $result['name'] = collect([$this->given_name, $this->middle_name, $this->surname])->join(' ');
        $result['gender'] = $this->sex;
        $result['thumbnail'] = $this->thumbnail;
        $result['contracts'] = ContractResource::collection($this->whenLoaded('contracts'));
        $result['duties'] = DomesticDutyResource::collection($this->whenLoaded('duties'));
        $result['experiences'] = ApplicantExperienceResource::collection($this->whenLoaded('experiences'));
        $result['supplier'] = new SupplierResource($this->whenLoaded('supplier'));

        return $result;
    }
}
