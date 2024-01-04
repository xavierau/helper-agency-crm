<?php
/**
 * Author: A & A Creation Co.
 * Date: 20/9/2020
 * Time: 1:01 PM
 */

namespace Modules\AgencyFinance\DataTransferObject;


use Illuminate\Support\Collection;
use Modules\AgencyFinance\Http\Requests\InvoiceUpdateRequest;

class UpdateInvoiceFormData
{

    private array $invoiceData;
    private array $invoiceItemsData;

    /**
     * NewInvoiceFormData constructor.
     * @param \Modules\AgencyFinance\Http\Requests\InvoiceUpdateRequest $request
     */
    public function __construct(InvoiceUpdateRequest $request) {
        $this->sanitizeInvoiceData($request);
        $this->sanitizeInvoiceItemsData($request);
    }

    /**
     * @return array
     */
    public function getInvoiceData(): array {
        return $this->invoiceData;
    }

    /**
     * @return array
     */
    public function getInvoiceItemsData(): Collection {
        return collect($this->invoiceItemsData ?? []);
    }

    private function sanitizeInvoiceData(InvoiceUpdateRequest $request) {
        $validatedData = $request->validated();
        $this->invoiceData = [
            'invoice_number' => $validatedData['invoice_number'] ?? rand(1000000,
                                                                         9999999),
            'due_date'       => $validatedData['due_date'] ?? now()->addDays(14),
            'client_id'      => $validatedData['client_id'],
            'contract'       => $validatedData['contract'],
            'discount'       => $validatedData['discount'] ?? 0,
            'note'           => $validatedData['note'] ?? null,
            'invoice_id'     => $validatedData['invoice_id'] ?? null,
        ];

    }

    private function sanitizeInvoiceItemsData(InvoiceUpdateRequest $request) {
        $validatedData = $request->validated();
        $this->invoiceItemsData = $validatedData['items'];
    }
}
