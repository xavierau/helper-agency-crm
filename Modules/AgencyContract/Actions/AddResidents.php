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

namespace Modules\AgencyContract\Actions;


use Illuminate\Support\Collection;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\DataTransferObject\Contract\ResidentsData;

class AddResidents
{
    public function execute(Contract $contract, ResidentsData $dto): Collection {
        $residents = $dto->getResidents();

        $residents = $residents->filter(fn(array $a) => $contract->residents()
                                                                 ->where('client_id',
                                                                         $a['id'])
                                                                 ->exists() === false);
        $residents->each(fn(array $a) => $contract->residents()->attach($a['id']));

        return $residents;
    }
}
