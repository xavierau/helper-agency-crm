<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 3:17 AM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Modules\AgencyFinance\Entities\InvoiceItem;

class DeleteInvoiceItem
{
    public function execute(int $invoiceItemId): void {
        InvoiceItem::findOrFail($invoiceItemId)->delete();
    }
}
