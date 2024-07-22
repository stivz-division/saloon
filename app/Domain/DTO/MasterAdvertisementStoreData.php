<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final class MasterAdvertisementStoreData
{

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly array $animals,
        public readonly array $pet_weights,
        public readonly array $breeds,
        public readonly string $price,
        public readonly ?string $start_at,
        public readonly ?string $end_at,
        public readonly array $locations,
        public readonly array $photos,
    ) {}

}