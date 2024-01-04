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

namespace Modules\AgencyCore\Actions\Client;


use DB;
use Modules\AgencyCore\DataTransferObject\ClientData;
use Modules\AgencyCore\Entities\Client;

class AddRelative
{
    public function execute(Client $principle, ClientData $dto, string $relation): Client {
        $data = $dto->getClientData();

        $data['is_primary'] = false;
        $data['account_id'] = $principle->account->id;

        DB::beginTransaction();

        try {

            $relative = Client::create($data);

            $principle->relatives()->attach($relative->id,
                                            ['relation' => $relation]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


        return $relative;
    }
}
