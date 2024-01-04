<?php

namespace Modules\AgencyCore\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * @var bool|mixed
     */
    private $onlyBasic = false;
    /**
     * @var bool|mixed
     */
    private $includeRelatives = false;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'full_name'     => $this->full_name,
            'mobile'        => $this->mobile,
            'hk_id'         => $this->hk_id,
            'client_number' => $this->client_number,
        ];

        if ($this->includeRelatives) {
            $data['relatives'] = (new ClientCollection($this->relatives));
        }

        if ($this->onlyBasic) {
            return $data;
        }

        return parent::toArray($request);
    }

    public function onlyBasic(): self
    {
        $this->onlyBasic = true;

        return $this;
    }

    public function includeRelatives(): self
    {
        $this->includeRelatives = true;

        return $this;
    }
}
