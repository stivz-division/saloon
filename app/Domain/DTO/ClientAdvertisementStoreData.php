<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use Carbon\Carbon;

final class ClientAdvertisementStoreData
{

    public function __construct(
        public readonly int $user_id,
        public readonly int $pet_id,
        public readonly string $description,
        public readonly ?int $yandex_location_id = null,
        public readonly ?Carbon $datetime_service_at = null,
        public readonly bool $is_payment = false,
        public readonly bool $is_published = false,
        public readonly ?Carbon $published_at = null,
        public readonly ?Carbon $published_end_at = null,
    ) {}

}