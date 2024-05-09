<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Animal;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Collection;

final class BreedRepository
{

    public function getById(int $id): Breed
    {
        return Breed::query()->find($id);
    }

    /**
     * @param  \App\Models\Animal  $animal
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allWhereAnimal(Animal $animal): Collection
    {
        return Breed::query()
            ->where('animal_id', $animal->id)
            ->get();
    }

}