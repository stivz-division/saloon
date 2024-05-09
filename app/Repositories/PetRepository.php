<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Pet;

final class PetRepository
{

    public function getById(int $idPet)
    {
        return Pet::query()->find($idPet);
    }

}