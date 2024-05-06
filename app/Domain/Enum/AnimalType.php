<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum AnimalType: string
{

    case Dog = 'dog';
    case Cat = 'cat';

    public function name(): string
    {
        return match ($this) {
            self::Dog => 'Собака',
            self::Cat => 'Кошка',
        };
    }
}
