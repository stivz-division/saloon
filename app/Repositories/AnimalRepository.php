<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class AnimalRepository
{

    public function search(?string $search): Collection
    {
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = Animal::query()
            ->when($search !== null, function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->get();

        return $collection;
    }

}
