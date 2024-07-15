<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum AnimalType: string
{

    case Dog = 'dog';
    case Cat = 'cat';
    case Mouse = 'mouse';
    case Rabbit = 'rabbit';
    case Pig = 'pig';
    case Bird = 'bird';
    case Reptile = 'reptile';
    case Others = 'others';

    public function name(): string
    {
        return match ($this) {
            self::Dog => 'Собака',
            self::Cat => 'Кошка',
            self::Mouse => 'Учитель сплинтер',
            self::Rabbit => 'Кролик',
            self::Pig => 'Свинья',
            self::Bird => 'Птица',
            self::Reptile => 'Рептилия',
            self::Others => 'Другое',
        };
    }

}
