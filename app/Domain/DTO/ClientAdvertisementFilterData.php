<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final class ClientAdvertisementFilterData
{

    public function __construct(
        public readonly array $locations = [],
        public readonly array $animals = [],
        public readonly array $breeds = [],
    ) {}

}