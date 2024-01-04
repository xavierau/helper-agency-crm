<?php

namespace Modules\AgencyCore\DataTransferObject;

use Modules\AgencyCore\Http\Requests\UpdatePersonalInfoRequest;

class UpdatePersonalInfoDTO
{
    private array $data;

    public static function fromRequest(UpdatePersonalInfoRequest $request): static
    {
        $instance = new static;

        $instance->data = $request->validated();

        return $instance;

    }

    public function getData(): array
    {
        $data = $this->data;
        $data['sex'] = $data['gender'];

        unset($data['gender']);

        return $data;
    }
}
