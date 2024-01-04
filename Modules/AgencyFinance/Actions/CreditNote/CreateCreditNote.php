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
 * @Date        : 8/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyFinance\Actions\CreditNote;


use Modules\AgencyFinance\DataTransferObject\CreditNoteData;
use Modules\AgencyFinance\Entities\CreditNote;

class CreateCreditNote
{
    public function execute(CreditNoteData $dto): CreditNote {
        return CreditNote::create($dto->getData());
    }
}
