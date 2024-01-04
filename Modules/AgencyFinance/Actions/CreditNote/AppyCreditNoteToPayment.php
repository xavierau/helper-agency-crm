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
 * @Date        : 10/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyFinance\Actions\CreditNote;


use Modules\AgencyFinance\DataTransferObject\CreatePaymentDTO;
use Modules\AgencyFinance\Entities\CreditNote;
use Modules\AgencyFinance\Entities\Payment;

class AppyCreditNoteToPayment
{

    public function execute(
        CreditNote $creditNote, Payment $payment, CreatePaymentDTO $dto): CreditNote {
        //TODO: Implement method
    }
}
