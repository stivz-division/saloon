<?php

declare(strict_types=1);

namespace App\Repositories;

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

    public function getUserByUuid(string $uuid): ?User
    {
        return User::query()->where('uuid', $uuid)->first();
    }

}