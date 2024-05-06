<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Animal;
use App\Repositories\AnimalRepository;
use Illuminate\Support\Collection;

final class AnimalService
{

    public function __construct(
        private AnimalRepository $animalRepository,
    )
    {
    }

    public function searchForMultiSelect(
        ?string $search,
    ): Collection
    {
        $animals = $this->animalRepository->search($search);

        return $animals->map(function (Animal $location) {
            return [
                'value' => $location->id,
                'name' => $location->title->name(),
            ];
        });
    }

}
