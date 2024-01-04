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
 * @Date        : 12/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\TransitionValidators;


use Anacreation\Workflow\Entities\Transition;
use Modules\AgencyContract\Contracts\ContractTransitionValidatorInterface;
use Modules\AgencyContract\Entities\Contract;

abstract class AbstractTransitionValidator implements ContractTransitionValidatorInterface
{
    /**
     * @var \Modules\AgencyContract\Entities\Contract
     */
    protected Contract $contract;
    /**
     * @var \Anacreation\Workflow\Entities\Transition
     */
    protected Transition $transition;

    public function __construct(Contract $contract, Transition $transition) {

        $this->contract = $contract;
        $this->transition = $transition;
    }

    abstract public function passes(): bool;

    abstract public function fails(): bool;

    abstract public function getMessage(): string;

}
