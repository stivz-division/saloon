<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Enum\AnimalType;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class AnimalRepository
{

    public function getById(int $id): Animal
    {
        return Animal::query()->find($id);
    }

    public function all(): Collection
    {
        return Animal::all();
    }

    /**
     * @param  \App\Domain\Enum\AnimalType  $animalType
     *
     * @return \App\Models\Animal|null
     */
    public function getWhere(AnimalType $animalType): ?Animal
    {
        return Animal::query()
            ->where('title', $animalType->value)
            ->first();
    }

    public function search(?string $search): Collection
    {
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = Animal::query()
            ->when($search !== null, function (Builder $query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->get();

        return $collection;
    }

}
