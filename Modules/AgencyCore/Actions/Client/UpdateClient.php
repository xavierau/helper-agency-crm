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
 * @Date        : 21/12/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Actions\Client;


use Modules\AgencyCore\DataTransferObject\ClientData;
use Modules\AgencyCore\Entities\Client;

class UpdateClient
{
    public function execute(Client $client, ClientData $dto): Client {
        $data = $dto->getClientData();

        $client->update($data);

        return $client;
    }
}
