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
 * @Date        : 7/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject;


use InvalidArgumentException;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use function PHPUnit\Framework\matches;

class GlobalSearchResult
{
    public string $type;
    public string $link;
    public string $label;
    public int $entity_id;

    public function __construct($obj)
    {
        $this->validateObject($obj);

        match (get_class($obj)) {
            Applicant::class => $this->convertApplicant($obj),
            Contract::class => $this->convertContract($obj),
            Client::class => $this->convertClient($obj)
        };

//        if ($obj instanceof Applicant) {
//            $this->convertApplicant($obj);
//        } elseif ($obj instanceof Contract) {
//            $this->convertContract($obj);
//        } elseif ($obj instanceof Client) {
//            $this->convertClient($obj);
//        }
    }

    public function validateObject($obj): bool
    {

        if (in_array(get_class($obj), $this->getAvailableEntities())) {
            return true;
        }
        throw new InvalidArgumentException;
    }

    private function convertApplicant(Applicant $applicant)
    {

        $this->type = 'Applicant';
        $this->link = 'Applicant';
        $this->label = $applicant->name;
        $this->entity_id = $applicant->id;
    }

    private function convertContract(Contract $contract)
    {
        $this->type = 'Contract';
        $this->link = 'Contract';
        $this->label = $contract->contract_number;
        $this->entity_id = $contract->id;
    }

    private function convertClient(Client $client)
    {
        $this->type = 'Client';
        $this->link = 'Client';
        $this->label = $client->full_name;
        $this->entity_id = $client->id;
    }

    private function getAvailableEntities(): array
    {
        return [
            Applicant::class,
            Client::class,
            Contract::class
        ];
    }
}
