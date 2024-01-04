<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 1:43 AM
 */

namespace Modules\AgencyFinance\DataTransferObject;


use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Entities\Variant;

class InvoiceItemData
{

    private float $qty;
    /**
     * @var float|mixed
     */
    private ?int $id;

    private float $price;
    private float $discount;
    private Sellable $sellable;
    private ?Variant $variant;
    private ?string $description;

    private function __construct(array $array)
    {
        $sellable = Sellable::findOrFail($array['sellable_id']);
        $this->id = $array['id'] ?? null;
        $this->qty = $array['qty'];
        $this->price = $array['price'];
        $this->description = $array['description'] ?? '';
        $this->discount = $array['discount'] ?? 0;
        $this->sellable = $sellable;
        $this->variant = $array['variant_id'] !== null ?
            $sellable->variants()
                ->where('variants.id',
                    $array['variant_id'])
                ->first() : null;
    }

    public static function fromFormData(array $formData): InvoiceItemData
    {
        return new self($formData);
    }

    /**
     * @return \Modules\AgencyCore\Entities\Variant|null
     */
    public function getVariant(): ?\Modules\AgencyCore\Entities\Variant
    {
        return $this->variant;
    }

    /**
     * @return \Modules\AgencyCore\Entities\Sellable
     */
    public function getSellable(): \Modules\AgencyCore\Entities\Sellable
    {
        return $this->sellable;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getQty()
    {
        return $this->qty;
    }

    public function getInvoiceItemData(): array
    {
        return [
            "id" => $this->id,
            "price" => $this->price,
            "qty" => $this->qty,
            "discount" => $this->discount,
            "description" => $this->description,
            "sellable_id" => $this->sellable->id,
            "variant_id" => optional($this->variant)->id,
        ];
    }

    /**
     * @return float|mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}
