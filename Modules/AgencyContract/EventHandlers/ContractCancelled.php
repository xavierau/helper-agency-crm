<?php

namespace Modules\AgencyContract\EventHandlers;

use Anacreation\Workflow\Events\TransitionApplied;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyFinance\Actions\CreditNote\CreateCreditNote;
use Modules\AgencyFinance\DataTransferObject\CreditNoteData;
use Modules\AgencyFinance\Enums\InvoiceStatus;

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
class ContractCancelled
{
    private CreateCreditNote $createCreditNoteAction;

    /**
     * ContractCancelled constructor.
     * @param \Modules\AgencyFinance\Actions\CreditNote\CreateCreditNote $action
     */
    public function __construct(CreateCreditNote $action) {
        $this->createCreditNoteAction = $action;
    }

    /**
     * Handle the event.
     *
     * @param \Anacreation\Workflow\Events\TransitionApplied $event
     * @return void
     */
    public function handle(TransitionApplied $event) {
        if($event->entity instanceof Contract &&
           $event->transition->toState->code === 'cancelled') {

            $this->createCreditNote($event->entity);

            $this->invalidateInvoice($event->entity);
        }
    }

    /**
     * @param \Modules\AgencyContract\Entities\Contract $contract
     */
    private function createCreditNote(Contract $contract): void {
        $this->createCreditNoteAction->execute(CreditNoteData::fromFormData([
                                                                                'contract_id'  => $contract->id,
                                                                                'amount'       => $contract->invoice->paid,
                                                                                'expired_date' => now()
                                                                                    ->addYears(1)
                                                                                    ->toDateString(),
                                                                                'status'       => 'active',
                                                                            ]));
    }

    /**
     * @param \Modules\AgencyContract\Entities\Contract $contract
     */
    private function invalidateInvoice(Contract $contract) {
        $invoice = $contract->invoice;

        $invoice->status = InvoiceStatus::VOID();
        $invoice->save();
    }
}
