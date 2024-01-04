<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 4:15 PM
 */

namespace Modules\AgencyFinance\Actions;


use Illuminate\Support\Facades\DB;
use Modules\AgencyFinance\DataTransferObject\CreatePaymentDTO;
use Modules\AgencyFinance\Entities\CreditNote;
use Modules\AgencyFinance\Entities\Payment;

class CreatePayment
{
    public function execute(CreatePaymentDTO $dto): Payment {
        $data = $dto->getPaymentData();

        DB::beginTransaction();

        try {

            $payment = Payment::create($data);

            $this->updateCreditNote($payment,
                                    $dto->getCreditNote());

            DB::commit();

            return $payment;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    private function updateCreditNote(
        Payment $payment, CreditNote $creditNote = null): void {

        if($creditNote !== null) {
            $creditNote->applyCreditNoteForPayment($payment);
        }

    }
}
