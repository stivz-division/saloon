<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum PetWeightType: string
{

    case AboveSix = '6';
    case SixTwelve = '6-12';
    case TwelveTwenty = '12-20';
    case TwentyForty = '20-40';
    case OverForty = '40+';

    public function name(): string
    {
        return match ($this) {
            self::AboveSix => 'До 6 кг.',
            self::SixTwelve => 'От 6 до 12 кг.',
            self::TwelveTwenty => 'От 12 до 20 кг.',
            self::TwentyForty => 'От 20 до 40 кг.',
            self::OverForty => '40+',
        };
    }

}
