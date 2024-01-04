<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateApplicantPersonalInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['gender'] = $this->sex;
        $data['date_of_birth'] = $this->date_of_birth?->format('Y-m-d');
        $data['name'] = $this->name;
        $data['duties'] = $this->whenLoaded('duties', fn() => $this->duties->map(fn($duty) => $duty->id));

unset($data['sex']);

return $data;
}
}
