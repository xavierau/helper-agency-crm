<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     anacreation/agency-finance
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyFinance\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AgencyFinance\Entities\Invoice;

class TrailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {

        return $this->map(fn(Invoice $invoice) => $invoice->load('client'))
                    ->reduce(function(array $carry, Invoice $invoice) {
                        $carry['total_payment'] = $carry['total_payment'] + $invoice->payments->sum->amount;
                        $carry['invoices'][] = [
                            'id'             => $invoice->id,
                            'total'          => $invoice->total,
                            'invoice_number' => $invoice->invoice_number,
                            'created_at'     => $invoice->created_at,
                            'contract'       => [
                                'id'              => $invoice->contract->id,
                                'contract_number' => $invoice->contract->contract_number,
                            ],
                            'client'         => [
                                'id'   => $invoice->client->id,
                                'name' => join(" ",
                                               [
                                                   $invoice->client->prefix,
                                                   $invoice->client->first_name,
                                                   $invoice->client->last_name,
                                               ]),
                            ],
                            'payments'       => $invoice->payments->map(function($payment) {
                                return [
                                    'id'         => $payment->id,
                                    'amount'     => $payment->amount,
                                    'type'       => $payment->type,
                                    'note'       => $payment->note,
                                    'attachment' => $payment->attachment,
                                    'created_at' => $payment->created_at,
                                ];
                            }),
                        ];

                        return $carry;

                    },
                        [
                            'total_payment' => 0,
                            'invoices'      => [],
                        ]);
    }
}
