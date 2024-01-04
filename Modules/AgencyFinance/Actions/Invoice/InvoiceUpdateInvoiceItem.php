<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 3:22 AM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Modules\AgencyFinance\DataTransferObject\InvoiceItemData;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\AgencyFinance\Entities\InvoiceItem;

class InvoiceUpdateInvoiceItem
{
    public function execute(Invoice $invoice, InvoiceItemData $dto): InvoiceItem {

        $item = InvoiceItem::findOrFail($dto->getId());

        if($item->invoice->isNot($invoice)) {
            abort(403,
                  'invoice and invoice line item does not match!');
        }

        $item->update($dto->getInvoiceItemData());

        return $item;
    }
}
