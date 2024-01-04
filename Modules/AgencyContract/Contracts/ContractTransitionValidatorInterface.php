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
 * @package     anacreation/agency-contract
 * @Date        : 2/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Contracts;


use Anacreation\Workflow\Entities\Transition;
use Modules\AgencyContract\Entities\Contract;

interface ContractTransitionValidatorInterface
{

    public function __construct(Contract $contract, Transition $transition);

    public function passes();

    public function fails();

    public function getMessage();
}
