<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum AdvertisementTopTariffsType: string
{

    case ConcreteTime = 'concrete_time'; // в конкретное время, например в 16:00
    case Minute = 'minute'; // каждые n минут

    public function name()
    {
        return match ($this) {
            self::ConcreteTime => 'В конкретное время',
            self::Minute => 'Каждые n минут',
        };
    }

}