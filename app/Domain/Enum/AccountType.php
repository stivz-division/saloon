<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum AccountType: string
{

    case Client = 'client';
    case Master = 'master';
    case Saloon = 'saloon';

    public function name(): string
    {
        return match ($this) {
            self::Client => 'Клиент',
            self::Master => 'Мастер',
            self::Saloon => 'Салон',
        };
    }

}
