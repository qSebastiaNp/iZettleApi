<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\Client\Inventory;

use LauLamanApps\IzettleApi\API\Inventory\ProductBalance;
use LauLamanApps\IzettleApi\API\Inventory\LocationBalance;
use Ramsey\Uuid\Uuid;
use LauLamanApps\IzettleApi\API\Inventory\Location\TypeEnum;

final class ProductBalanceBuilder implements ProductBalanceBuilderInterface
{
    public function buildFromJson(string $json): ProductBalance
    {
        $data = json_decode($json, true);
        
        $variants = [];
        foreach ($data['variants'] as $variant) {
            $variants []= new LocationBalance(
                    Uuid::fromString($variant['locationUuid']),
                    TypeEnum::get($variant['locationType']),
                    Uuid::fromString($variant['productUuid']),
                    Uuid::fromString($variant['variantUuid']),
                    (int) $variant['balance']
                );
        }
        
        return new ProductBalance(
            Uuid::fromString($data['locationUuid']),
            $variants
        );
    }
    
}
