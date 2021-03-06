<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\Client\Product;

use LauLamanApps\IzettleApi\API\Product\Variant;
use LauLamanApps\IzettleApi\API\Product\VariantCollection;
use LauLamanApps\IzettleApi\API\Universal\Vat;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

final class VariantBuilder implements VariantBuilderInterface
{
    public function buildFromArray(array $data): VariantCollection
    {
        $collection = new VariantCollection();

        foreach ($data as $variant) {
            $collection->add($this->build($variant));
        }

        return $collection;
    }

    private function build(array $data): Variant
    {
        return Variant::create(
            Uuid::fromString($data['uuid']),
            $data['name'],
            $data['description'],
            $data['sku'],
            $data['barcode'],
            (int) ($data['defaultQuantity'] ?? 0),
            $data['unitName'] ?? null,
            new Money($data['price']['amount'], new Currency($data['price']['currencyId'] ?? 'EUR')),
            $data['costPrice'] ? new Money($data['costPrice']['amount'], new Currency($data['costPrice']['currencyId'])) : null,
            $data['vatPercentage'] != '0' ? new Vat($data['vatPercentage']) : null
        );
    }
}
