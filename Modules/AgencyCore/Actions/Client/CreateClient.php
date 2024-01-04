<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 10:57 PM
 */

namespace Modules\AgencyCore\Actions\Client;


use Illuminate\Support\Facades\DB;
use Modules\AgencyCore\DataTransferObject\ClientData;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Client;

class CreateClient
{
    public function execute(ClientData $dto): Client
    {
        DB::beginTransaction();

        try {
            $client = Account::create()->clients()->create($dto->getClientData());

            $client->addresses()->create($dto->getAddressData());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        /** @var Client $client */
        return $client;

    }
}
