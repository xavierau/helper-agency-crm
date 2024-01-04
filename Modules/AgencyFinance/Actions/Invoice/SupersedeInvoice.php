<?php
/**
 * Author: A & A Creation Co.
 * Date: 20/9/2020
 * Time: 1:00 PM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Modules\AgencyContract\Actions\CreateContract;
use Modules\AgencyFinance\DataTransferObject\InvoiceData;
use Modules\AgencyFinance\Entities\Invoice;

class SupersedeInvoice
{
    private CreateInvoice $createInvoiceAction;
    private CreateContract $createContractAction;

    /**
     * SupersedeInvoice constructor.
     * @param \Modules\AgencyFinance\Actions\Invoice\CreateInvoice $createInvoiceAction
     * @param \Modules\AgencyContract\Actions\CreateContract       $createContractAction
     */
    public function __construct(
        CreateInvoice $createInvoiceAction,
        CreateContract $createContractAction) {
        $this->createInvoiceAction = $createInvoiceAction;
        $this->createContractAction = $createContractAction;
    }


    public function execute(Invoice $invoice, InvoiceData $data): Invoice {

        return $this->createNewInvoice($invoice,
                                       $data);
    }

    private function createNewInvoice(Invoice $invoice, InvoiceData $dto): Invoice {

        $this->cancelContract($invoice);

        $this->supersedeInvoice($invoice);

        return $this->createInvoice($invoice,
                                    $dto);

    }

    private function cancelContract(Invoice $invoice) {
        $invoice->contract->cancel();
    }

    private function supersedeInvoice(Invoice $invoice) {
        $invoice->status = 'superseded';

        $invoice->save();
    }

    private function createInvoice(Invoice $invoice, InvoiceData $data): Invoice {

        return $this->createInvoiceAction->execute($data);
    }


}
