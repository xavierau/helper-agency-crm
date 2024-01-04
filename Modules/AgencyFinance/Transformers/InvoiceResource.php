<?php

namespace Modules\AgencyFinance\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyContract\Transformers\ContractResource;
use Modules\AgencyCore\Transformers\ClientResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {

        return [
            'id'              => $this->id,
            'invoice_number'  => $this->invoice_number,
            'discount'        => $this->discount,
            'note'            => $this->note,
            'status'          => $this->status,
            'items'           => $this->items,
            'client'          => new ClientResource($this->client),
            'payments'        => $this->payments,
            'previousInvoice' => new InvoiceResource($this->previousInvoice),
            'contract'        => new ContractResource($this->contract),
        ];

    }
}
