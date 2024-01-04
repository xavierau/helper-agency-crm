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
 * @package     ${PACKAGE}
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\DataTransferObjects;


class ContractTypeData
{
    private string $label;

    public static function fromFormData(array $validatedData): ContractTypeData {
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
