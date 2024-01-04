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
 * @package     AgencyCore
 * @Date        : 15/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Actions\Address;


use Modules\AgencyCore\DataTransferObject\Address\AddressData;
use Modules\AgencyCore\Entities\Address;

class AddAddress
{
    public function execute($owner, AddressData $dto): Address {
        return $owner->addresses()->create([
                                               'address_1'   => $dto->getAddress1(),
                                               'address_2'   => $dto->getAddress2(),
                                               'address_3'   => $dto->getAddress3(),
                                               'state'       => $dto->getState(),
                                               'country'     => $dto->getCountry(),
                                               'postal_code' => $dto->getPostalCode(),
                                           ]);

    }
}
