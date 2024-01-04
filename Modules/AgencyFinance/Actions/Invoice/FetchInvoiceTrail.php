<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 2:03 AM
 */

namespace Modules\AgencyFinance\Actions\Invoice;


use Illuminate\Support\Collection;
use Modules\AgencyFinance\Entities\Invoice;

class FetchInvoiceTrail
{
    private Collection $collection;

    /**
     * FetchInvoiceTrail constructor.
     */
    public function __construct() {
        $this->collection = collect([]);
    }


    public function execute(Invoice $invoice): Collection {
        $invoice->load([
                           'payments' => function($q) {
                               $q->latest();
                           },
                       ],
                       'previousInvoice',
                       'client');
        $this->collection->push($invoice);

        $this->recursivelyAddInvoice($invoice->previousInvoice);

        return $this->collection;

    }

    private function recursivelyAddInvoice(Invoice $previousInvoice = null) {

        if($previousInvoice !== null) {
            $previousInvoice->load('payments',
                                   'client',
                                   'previousInvoice');
            $this->collection->push($previousInvoice);
            $this->recursivelyAddInvoice($previousInvoice->previousInvoice);
        }
    }


}
