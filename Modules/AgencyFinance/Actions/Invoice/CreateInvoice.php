<?php
/**
 * Author: A & A Creation Co.
 * Date: 20/9/2020
 * Time: 1:00 PM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Modules\AgencyFinance\DataTransferObject\InvoiceData;
use Modules\AgencyFinance\DataTransferObject\InvoiceItemData;
use Modules\AgencyFinance\Entities\Invoice;

class CreateInvoice
{
    public function execute(InvoiceData $data): Invoice {

        $newInvoice = $this->createNewInvoice($data);
        $newInvoice = $this->createNewItem($newInvoice,
                                           $data);

        return $newInvoice;

    }

    private function createNewInvoice(InvoiceData $dto): Invoice {
        return Invoice::create($dto->getInvoiceData());
    }

    private function createNewItem(Invoice $newInvoice, InvoiceData $dto): Invoice {

        $items = $dto->getInvoiceItemsData();

        $items->each(function(InvoiceItemData $itemData) use ($newInvoice) {
            $data = $itemData->getInvoiceItemData();
            $newInvoice->items()->create($data);
        });

        return $newInvoice;
    }
}
