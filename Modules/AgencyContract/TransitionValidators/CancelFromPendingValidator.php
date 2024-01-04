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

namespace Modules\AgencyContract\TransitionValidators;


class CancelFromPendingValidator extends AbstractTransitionValidator
{

    public function passes(): bool {

        if( !$this->contract->canApplyTransition($this->transition)) {
            return false;
        }

        return true;
    }

    public function fails(): bool {
        return !$this->passes();
    }

    public function getMessage(): string {
        return 'Fails';
    }

}
