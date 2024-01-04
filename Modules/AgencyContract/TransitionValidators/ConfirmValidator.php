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


use Modules\AgencyContractDate\Entities\ContractDateValue;
use Modules\AgencyContractDoc\Entities\ContractDocValue;

class ConfirmValidator extends AbstractTransitionValidator
{
    public function passes(): bool {

        if( !$this->contract->canApplyTransition($this->transition)) {
            return false;
        }

        if( !$this->hasAllRequiredDocuments()) {
            return false;
        }

        if( !$this->hasAllRequiredDates()) {
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

    /**
     * @return bool
     */
    private function hasAllRequiredDocuments(): bool {
        $contractTypeRequiredDocs = $this->contract->type->contractDocuments->filter(fn(
            $cd) => $cd->assignment->is_required)->map->id;

        $docs = $this->contract->documents->map->id;

        $requiredDocs = $contractTypeRequiredDocs->merge($docs->all());

        $result = true;
        $requiredDocs->unique()->each(function($docId) use (&$result) {
            $record = ContractDocValue::where('contract_doc_id',
                                              $docId)
                                      ->where('contract_id',
                                              $this->contract->id)
                                      ->first();

            if($record === null or $record->value === null) {
                $result = false;
            }
        });

        return $result;
    }

    private function hasAllRequiredDates(): bool {

        $contractTypeRequiredDates = $this->contract->type->contractDates->filter(fn(
            $cd) => $cd->assignment->is_required)->map->id;

        $dates = $this->contract->dates->map->id;

        $requiredDates = $contractTypeRequiredDates->merge($dates->all());

        $result = true;
        $requiredDates->unique()->each(function($dateId) use (&$result) {
            $record = ContractDateValue::where('contract_date_id',
                                               $dateId)
                                       ->where('contract_id',
                                               $this->contract->id)
                                       ->first();

            if($record === null or $record->value === null) {
                $result = false;
            }
        });

        return $result;
    }
}
