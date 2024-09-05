<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use Carbon\Carbon;

final class ClientAdvertisementFilterData
{

    public function __construct(
        public readonly array $locations = [],
        public readonly array $animals = [],
        public readonly array $breeds = [],
        public readonly bool $withoutDateTime = false,
        public readonly ?Carbon $dateTimeServiceStart = null,
        public readonly ?Carbon $dateTimeServiceEnd = null,
    ) {}

}