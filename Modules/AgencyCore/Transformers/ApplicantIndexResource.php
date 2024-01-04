<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ApplicantIndexResource extends JsonResource
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
            'id'               => $this->id,
            'thumbnail'        => $this->thumbnail,
            'name'             => $this->name,
            'nationality'      => $this->nationality,
            'gender'           => $this->sex,
            'age'              => $this->age,
            'current_location' => Str::headline($this->current_location),
            'status'           => $this->status,
            'is_approved'      => $this->is_approved,
        ];
    }
}
