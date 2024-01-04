<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowContractContractTypeResource extends JsonResource
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
            'contract_dates'     => ShowContractContractTypeContractDateResource::collection($this->contractDates),
            'contract_documents' => ShowContractContractTypeContractDocumentResource::collection($this->contractDocuments),
            'contract_templates' => ShowContractContractTypeContractTemplateResource::collection($this->templates),
        ];
    }
}
