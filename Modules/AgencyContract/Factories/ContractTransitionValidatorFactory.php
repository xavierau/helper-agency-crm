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

namespace Modules\AgencyContract\Factories;


use Anacreation\Workflow\Entities\Transition;
use Exception;
use Illuminate\Support\Str;
use Modules\AgencyContract\Contracts\ContractTransitionValidatorInterface;
use Modules\AgencyContract\Entities\Contract;

class ContractTransitionValidatorFactory
{
    public static function make(
        Contract $contract, Transition $transition): ?ContractTransitionValidatorInterface {

        $name = Str::ucfirst(Str::camel($transition->code));

        $classFullName = "Modules\\AgencyContract\\TransitionValidators\\${name}Validator";

        try {
            return new $classFullName($contract,
                                      $transition);
        } catch (Exception $e) {
            return null;
        }

    }
}
