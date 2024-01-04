<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyContract\Transformers\ContractResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $result = $this->basicInfo();

        $result['contracts'] = ContractResource::collection($this->whenLoaded('contracts'));
        $result['duties'] = DomesticDutyResource::collection($this->whenLoaded('duties'));
        $result['experiences'] = ApplicantExperienceResource::collection($this->whenLoaded('experiences'));
        $result['supplier'] = new SupplierResource($this->whenLoaded('supplier'));

        return $result;
    }

    private function basicInfo(): array
    {
        return [
            'age'              => $this->age,
            'current_location' => $this->current_location,
            'pt_code'          => $this->pt_code,
            'hk_code'          => $this->hk_code,
            'id'               => $this->id,
            'is_approved'      => (bool)$this->is_approved,
            'name'             => $this->name,
            'marital_status'   => ucwords($this->marital_status),
            'education'        => $this->education,
            'height'           => $this->height,
            'weight'           => $this->weight,
            'supplier'         => new SupplierResource($this->whenLoaded('supplier')),
            'nationality'      => $this->nationality,
            'status'           => $this->status,
            'gender'           => $this->sex,
            'thumbnail'        => $this->thumbnail,
        ];
    }
}
