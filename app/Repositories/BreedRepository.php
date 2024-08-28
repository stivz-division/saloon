<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Animal;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Collection;

final class BreedRepository
{

    /**
     * @param  int  $id
     *
     * @return \App\Models\Breed
     */
    public function getById(int $id): Breed
    {
        return Breed::query()->find($id);
    }

    /**
     * @param  array  $ids
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids): Collection
    {
        return Breed::query()->whereIn('id', $ids)->get();
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