<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PetWeight;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @param  string|null  $search
     * @param  int|null  $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(
        ?string $search,
        ?int $limit = null,
    ): Collection {
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = PetWeight::query()
            ->when($search !== null, function (Builder $query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->when($limit !== null, function (Builder $query) use ($limit) {
                $query->limit($limit);
            })
            ->get();

        return $collection;
    }

}