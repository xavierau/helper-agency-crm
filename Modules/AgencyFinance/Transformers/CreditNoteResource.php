<?php

namespace Modules\AgencyFinance\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'                 => $this->id,
            'from_contract'      => [
                'id'              => $this->fromContract->id,
                'contract_number' => $this->fromContract->contract_number,
                'client_name'     => $this->fromContract->client->full_name,
            ],
            'to_contract'        => [
                'id'              => optional($this->toContract)->id,
                'contract_number' => optional($this->toContract)->contract_number,
                'client_name'     => optional($this->toContract)->client !== null ?
                    $this->toContract->client->full_name: null,
            ],
            'status'             => $this->status,
            'amount'             => $this->amount,
            'expired_date'       => $this->expired_date,
            'credit_note_number' => $this->credit_note_number,
        ];
    }
}
