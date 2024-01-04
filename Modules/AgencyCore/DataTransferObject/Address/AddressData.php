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
 * @package
 * @Date        : 15/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject\Address;


class AddressData
{
    private ?string $address_1;
    private ?string $address_2;
    private ?string $address_3;
    private ?string $state;
    private ?string $country;
    private ?string $postal_code;

    public static function fromFormData(array $validatedData): AddressData {
        $instance = new self;
        $instance->address_1 = $validatedData['address_1'] ?? null;
        $instance->address_2 = $validatedData['address_2'] ?? null;
        $instance->address_3 = $validatedData['address_3'] ?? null;
        $instance->state = $validatedData['state'] ?? null;
        $instance->country = $validatedData['country'] ?? null;
        $instance->postal_code = $validatedData['postal_code'] ?? null;

        return $instance;
    }

    /**
     * @return string|null
     */
    public function
    getAddress1(): ?string {
        return $this->address_1;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string {
        return $this->address_2;
    }

    /**
     * @return string|null
     */
    public function getAddress3(): ?string {
        return $this->address_3;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string {
        return $this->postal_code;
    }
}
