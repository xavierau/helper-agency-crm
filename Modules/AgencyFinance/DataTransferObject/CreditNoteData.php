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

namespace Modules\AgencyFinance\DataTransferObject;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\AgencyContract\Entities\Contract;

class CreditNoteData
{
    private string $credit_note_number;
    private Contract $formContract;
    private ?Contract $toContract = null;
    private float $amount;
    private Carbon $expired_date;
    private string $status;

    public static function fromFormData(array $validatedData): CreditNoteData {
        $instance = new static;

        $instance->credit_note_number = $validatedData['credit_note_number'] ?? Str::random();

        $instance->formContract = Contract::find($validatedData['contract_id']);

        $instance->amount = $validatedData['amount'];

        $instance->expired_date = $validatedData['expired_date'] ?
            Carbon::parse($validatedData['expired_date']):
            now()->addYears(1);

        $instance->status = $validatedData['status'] ?? Crednt;

        return $instance;
    }

    public function getData(): array {
        return [
            'amount'             => $this->amount,
            'credit_note_number' => $this->credit_note_number,
            'expired_date'       => $this->expired_date,
            'from_contract_id'   => $this->formContract->id,
            'status'             => $this->status,
            'to_contract_id'     => optional($this->toContract)->id,
        ];
    }
}
