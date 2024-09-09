<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Enum\AccountType;
use App\Models\User;

final class UserRepository
{

    /**
     * @param  int  $id
     *
     * @return \App\Models\User|null
     */
    public function getById(int $id): ?User
    {
        return User::query()->find($id);
    }

    public function getPaginateMasters(int $perPage = 15)
    {
        return User::query()
            ->with('infoMaster')
            ->where('account_type', AccountType::Master)
            ->latest()
            ->paginate(15);
    }

    public function getUserByUuid(string $uuid): ?User
    {
        return User::query()->where('uuid', $uuid)->first();
    }

}