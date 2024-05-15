<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Enum\PromocodeType;
use App\Models\Program;
use App\Models\Promocode;

final class PromocodeRepository
{

    /**
     * Get a Promocode by the provided code, promocode type,
     * and where the promocode is active, not used, and has no used_at value.
     *
     * @param  string  $code  The code of the Promocode
     * @param  PromocodeType  $promocodeType  The type of the Promocode
     *
     * @return Promocode|null The Promocode matching the provided code, type,
     *     and conditions, or null if not found
     */
    public function getByCodeIsActiveNotUsed(
        string $code,
        PromocodeType $promocodeType
    ): ?Promocode {
        return Promocode::query()
            ->where('type', $promocodeType->value)
            ->where('code', $code)
            ->where('is_active', true)
            ->where('is_used', false)
            ->whereNull('used_at')
            ->first();
    }

}