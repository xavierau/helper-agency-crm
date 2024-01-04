<?php

namespace Modules\AgencyContract\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyCore\Transformers\AddressResource;
use Modules\AgencyCore\Transformers\ApplicantResource;
use Modules\AgencyCore\Transformers\ClientResource;
use Modules\AgencyCore\Transformers\RequirementResource;

class ContractResource extends JsonResource
{
    private bool $isShow = false;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {

        $data = [
            "id"                => $this->id,
            "account"           => $this->account,
            "address"           => new AddressResource($this->addresses?->first()),
            "applicant"         => new ApplicantResource($this->applicant),
            "client"            => (new ClientResource($this->whenLoaded("client")))->onlyBasic(),
            "contract_number"   => $this->contract_number,
            "contract_type"     => $this->type,
            "end_date"          => $this->end_date,
            "food_subsidy"      => $this->food_subsidy,
            "internal_code"     => $this->internal_code,
            "salary"            => $this->salary,
            "special_request_1" => $this->special_request_1,
            "special_request_2" => $this->special_request_2,
            "special_request_3" => $this->special_request_3,
            "start_date"        => $this->start_date,
            "status"            => $this->status,
        ];

        if ($this->isShow) {
            $data = $this->detailContent($data);
        }

        return $data;

    }

    private function detailContent(array $data): array
    {

        collect([
            "accommodation_type"  => $this->accommodation_type,
            "accommodation_value" => $this->accommodation_value,
            "client"              => new ShowContractClientResource($this->client->load('account.clients')),
            "currentState"        => $this->currentState->state,
            "dates"               => ShowContractContractDateResource::collection($this->dates),
            "dayoff_arrangement"  => $this->dayoff_arrangement,
            "documents"           => ShowContractContractDocumentResource::collection($this->documents),
            "invoice"             => $this->invoice,
            "number_of_bedrooms"  => $this->number_of_bedrooms,
            "requirement"         => new RequirementResource($this->requirement),
            "residents"           => $this->residents,
            "transitions"         => ShowContractTransitionResource::collection($this->transitions),
            "type"                => new ShowContractContractTypeResource($this->type->load(['contractDates', 'contractDocuments', 'templates',]))
        ])
            ->each(fn($val, string $key) => $data[$key] = $val);


        return $data;
    }

    public function showDetail(): self
    {
        $this->isShow = true;

        return $this;
    }
}

