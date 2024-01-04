<?php
/**
 * Author: A & A Creation Co.
 * Date: 20/9/2020
 * Time: 1:01 PM
 */

namespace Modules\AgencyFinance\DataTransferObject;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyFinance\Entities\Invoice;

class InvoiceData
{

    private Carbon $due_date;
    private string $invoice_number;
    private float $discount = 0.0;
    private ?string $note;
    private string $status = 'active';
    private Client $client;
    private ?Invoice $invoice;
    /**
     * @var [InvoiceItemData]
     */
    private $invoiceItems = [];

    /**
     * NewInvoiceFormData constructor.
     * @param \Modules\AgencyFinance\Http\Requests\InvoiceStoreRequest $request
     */
    private function __construct(array $formData = null) {
        if($formData) {
            $this->sanitizeInvoiceData($formData);
        }
    }

    public static function fromFormData(array $formData): InvoiceData {
        return new self($formData);
    }


    /**
     * @return array
     */
    public function getInvoiceData(array $override = []): array {

        $default = [
            'invoice_number' => $this->invoice_number,
            'due_date'       => $this->due_date,
            'discount'       => $this->discount,
            'note'           => $this->note,
            'status'         => $this->status,
            'client_id'      => $this->client->id,
        ];

        if($id = optional($this->invoice)->id) {
            $default['invoice_id'] = $id;
        }

        return $override ? array_merge($default,
                                       $override): $default;

    }

    /**
     * @return array
     */
    public function getInvoiceItemsData(): Collection {
        return collect($this->invoiceItems ?? []);
    }

    private function sanitizeInvoiceData(array $formData) {
        $this->invoice_number = $formData['invoice_number'] ?? rand(1000000,
                                                                    9999999);
        $this->due_date = (isset($formData['due_date']) and $formData['due_date']) ?
            Carbon::parse($formData['due_date']):
            now()->addDays(14);
        $this->client = Client::findOrFail($formData['client']['id']);


        $this->discount = $formData['discount'] ?? 0;
        $this->note = $formData['note'] ?? null;
        $this->status = $formData['status'] ?? 'active';
        $this->invoice = (isset($formData['invoice_id']) and $formData['invoice_id']) ?
            Invoice::findOrFail($formData['invoice_id']):
            null;

        $this->invoiceItems = $this->getInvoiceItems($formData);

    }


    /**
     * @param array $formData
     * @return [InvoiceItemData]
     */
    private function getInvoiceItems(array $formData): array {
        $items = [];
        foreach(($formData['items'] ?? []) as $data) {
            $items[] = InvoiceItemData::fromFormData($data);
        }

        return $items;
    }

}
