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
 * @package     anacreation\agency-core
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject\ContractDate;


class ContractDateData
{
    /**
     * @var string
     */
    private string $label;

    public static function fromFormData(array $validatedData): ContractDateData {
        $instance = new self;
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
