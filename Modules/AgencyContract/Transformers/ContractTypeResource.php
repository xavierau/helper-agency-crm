<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyTemplate\Transformers\TemplateResource;

class ContractTypeResource extends JsonResource
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
            'label'              => $this->label,
            'contract_dates'     => $this->contractDates->map(function($contractData) {
                return [
                    'id'          => $contractData->id,
                    'label'       => $contractData->label,
                    'order'       => $contractData->assignment->order,
                    'is_required' => $contractData->assignment->is_required,
                ];
            }),
            'contract_documents' => $this->contractDocuments->map(function($contractData) {
                return [
                    'id'          => $contractData->id,
                    'label'       => $contractData->label,
                    'order'       => $contractData->assignment->order,
                    'is_required' => $contractData->assignment->is_required,
                ];
            }),
            'templates'          => TemplateResource::collection($this->templates),
        ];
    }
}
