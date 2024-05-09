<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PetWeight;
use Illuminate\Database\Eloquent\Collection;

final class PetWeightRepository
{

    public function getById(int $id): ?PetWeight
    {
        return PetWeight::query()->find($id);
    }

    public function all(): Collection
    {
        return PetWeight::all();
    }

}