<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final class MasterAdvertisementFilterData
{

    public function __construct(
        public readonly array $locations = [],
    ) {}

}