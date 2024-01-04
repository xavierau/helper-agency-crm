<?php
/**
 * Author: A & A Creation Co.
 * Date: 20/9/2020
 * Time: 1:00 PM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Illuminate\Support\Collection;
use Modules\AgencyFinance\DataTransferObject\InvoiceData;
use Modules\AgencyFinance\DataTransferObject\InvoiceItemData;
use Modules\AgencyFinance\Entities\Invoice;

class UpdateInvoice
{

    /**
     * @var \Modules\AgencyFinance\Actions\Invoice\InvoiceUpdateInvoiceItem
     */
    private InvoiceUpdateInvoiceItem $updateInvoiceItemAction;
    /**
     * @var \Modules\AgencyFinance\Actions\Invoice\InvoiceCreateInvoiceItem
     */
    private InvoiceCreateInvoiceItem $createInvoiceItemAction;
    /**
     * @var \Modules\AgencyFinance\Actions\Invoice\DeleteInvoiceItem
     */
    private DeleteInvoiceItem $deleteInvoiceItemAction;

    public function __construct(InvoiceUpdateInvoiceItem $updateInvoiceItemAction,
        InvoiceCreateInvoiceItem $createInvoiceItemAction,
        DeleteInvoiceItem $deleteInvoiceItemAction
    ) {
        $this->updateInvoiceItemAction = $updateInvoiceItemAction;
        $this->createInvoiceItemAction = $createInvoiceItemAction;
        $this->deleteInvoiceItemAction = $deleteInvoiceItemAction;
    }

    public function execute(Invoice $invoice, InvoiceData $data): Invoice {

        $invoice = $this->updateInvoice($invoice,
                                        $data);

        $invoice = $this->updateInvoiceItem($invoice,
                                            $data);

        return $invoice;
    }

    private function updateInvoice(Invoice $invoice, InvoiceData $data): Invoice {
        $invoice_data = $data->getInvoiceData();
        $invoice->update($invoice_data);

        return $invoice;

    }

    private function updateInvoiceItem(Invoice $invoice, InvoiceData $data): Invoice {


        $itemData = $data->getInvoiceItemsData();

        $this->getDeleteInvoiceItemIds($invoice,
                                       $itemData)
             ->each(function(int $item_id) {
                 $this->deleteInvoiceItemAction->execute($item_id);
             });

        $itemData->each(function(InvoiceItemData $data) use ($invoice) {
            $data->getId() ?
                $this->updateInvoiceItemAction->execute($invoice,
                                                        $data):
                $this->createInvoiceItemAction->execute($invoice,
                                                        $data);

        });

        return $invoice;

    }

    /**
     * @param \Modules\AgencyFinance\Entities\Invoice $invoice
     * @param \Illuminate\Support\Collection          $itemData
     * @return array
     */
    private function getDeleteInvoiceItemIds(Invoice $invoice,
        \Illuminate\Support\Collection $itemData
    ): Collection {
        $originalInvoiceItemsIds = $invoice->items()->pluck('id')->toArray();
        $itemDataIds = $itemData->map(function(InvoiceItemData $item) {
            return $item->getId();
        })->toArray();

        return collect(array_diff($originalInvoiceItemsIds,
                                  $itemDataIds));

    }

}
