<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum StockType: string
{

    case Percent = 'percent';
    case Price = 'price';

    public function name(): string
    {
        return match ($this) {
            self::Percent => 'Процент',
            self::Price => 'Цена',
        };
    }

}
