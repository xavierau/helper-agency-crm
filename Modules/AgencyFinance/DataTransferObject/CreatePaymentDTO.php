<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 4:14 PM
 */

namespace Modules\AgencyFinance\DataTransferObject;


use Modules\AgencyFinance\Entities\CreditNote;
use Modules\AgencyFinance\Http\Requests\PaymentStoreRequest;

class CreatePaymentDTO
{

    /**
     * @var array
     */
    private array $paymentData;

    /**
     * CreatePaymentDTO constructor.
     * @param \Illuminate\Http\Request|\Modules\AgencyFinance\Http\Requests\PaymentStoreRequest $request
     */
    public function __construct(PaymentStoreRequest $request) {
        $this->paymentData = $request->validated();
    }

    /**
     * @return array
     */
    public function getPaymentData(): array {
        return $this->paymentData;
    }

    public function getAmount() {
        return $this->paymentData['amount'];
    }

    public function getCreditNote(): ?CreditNote {
        return (isset($this->paymentData['credit_note_id']) and $this->paymentData['credit_note_id']) ?
            CreditNote::find($this->paymentData['credit_note_id']):
            null;
    }


}
