<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\API\Inventory;

use Ramsey\Uuid\UuidInterface;

final class ProductBalance
{
    /**
     * @var UuidInterface
     */
    private $locationUuid;

    /**
     * @var LocationBalance[]
     */
    private $variants;
    
    public function __construct(
        UuidInterface $locationUuid,
        array $variants
    ) {
        $this->locationUuid = $locationUuid;
        $this->variants = $variants;
    }

    public function getLocationUuid(): UuidInterface
    {
        return $this->locationUuid;
    }

    public function getVariants(): array
    {
        return $this->variants;
    }

}
