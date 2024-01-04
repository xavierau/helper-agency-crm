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
 * @Date        : 2/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions\ContractStateTransit;


use Anacreation\Workflow\Entities\Transition;
use InvalidArgumentException;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Factories\ContractTransitionValidatorFactory;

class ContractStateTransit
{
    public function execute(Contract $contract, Transition $transition): Contract {

        if( !$contract->canApplyTransition($transition)) {
            throw new InvalidArgumentException('Invalid transition for the contract');
        }

        $validator = ContractTransitionValidatorFactory::make($contract,
                                                              $transition);

        if($validator and $validator->fails()) {
            throw new InvalidArgumentException('Transition validator check fails');
        }

        $contract->applyTransition($transition);

        return $contract;

    }
}
