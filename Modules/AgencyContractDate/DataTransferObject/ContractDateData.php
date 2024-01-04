<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     anacreation/agency-contract-date
 * @Date        : 31/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContractDate\DataTransferObject;


class ContractDateData
{

    private string $label;

    public static function fromFormData(array $validatedData): ContractDateData {
        $instance = new static;
        $instance->label = $validatedData['label'];

        return $instance;
    }

    /**
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }
}
