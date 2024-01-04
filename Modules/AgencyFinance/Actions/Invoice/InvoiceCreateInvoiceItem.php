<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 3:26 AM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Modules\AgencyFinance\DataTransferObject\InvoiceItemData;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\AgencyFinance\Entities\InvoiceItem;

class InvoiceCreateInvoiceItem
{
    public function execute(Invoice $invoice, InvoiceItemData $dto): InvoiceItem {

        return $invoice->items()->create($dto->getInvoiceItemData());
    }
}
