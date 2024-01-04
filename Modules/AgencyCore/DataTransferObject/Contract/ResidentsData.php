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
 * @package     Agency Core
 * @Date        : 15/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject\Contract;


use Illuminate\Support\Collection;

class ResidentsData
{
    /**
     * @var [Client]
     */
    private array $residents = [];

    public static function fromFormData(array $data): ResidentsData {
        $instance = new self;
        $instance->residents[] = [
            'id'       => $data['id'],
            'relation' => $data['relation'],
        ];

        return $instance;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getResidents(): Collection {
        return collect($this->residents);
    }

}
