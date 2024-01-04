<?php

namespace Modules\AgencyCore\Services;

abstract class SetSchemalessAttribute
{
    protected $groupName = '';
    protected $atrributes = [];

    /**
     * @param Array<string, any> $subject
     * @return array
     */
    public function extractAttributes(array $subject): array
    {
        return collect($subject)->reduce(function ($carry, $val, $key) {
            if (in_array($key, $this->atrributes))
                $carry[$key] = $val;
            return $carry;
        }, []);
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @return array
     */
    public function getAtrributes(): array
    {
        return $this->atrributes;
    }

}
