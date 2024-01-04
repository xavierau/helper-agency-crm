<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyCore\Transformers\AddressResource;

class ShowContractClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        $data = [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'full_name'     => $this->full_name,
            'mobile'        => $this->mobile,
            'client_number' => $this->client_number,
        ];
        $data['relatives'] = $this->relatives->map(fn($c) => $this->clientBasicInfo($c));
        $data['account'] = [
            'id'        => $this->account->id,
            'addresses' => $this->account->addresses->map(fn($a) => new AddressResource($a)),
        ];

        return $data;
    }

    private function clientBasicInfo($client): array {
        return [
            'id'            => $client->id,
            'first_name'    => $client->first_name,
            'last_name'     => $client->last_name,
            'full_name'     => $client->full_name,
            'mobile'        => $client->mobile,
            'client_number' => $client->client_number,
            'hk_id'         => $client->hk_id,
            'relation'      => $client->pivot->relation,
        ];
    }
}
