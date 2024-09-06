<?php

declare(strict_types=1);

namespace App\Services;

use App\Livewire\Components\Hepler\MultiSelect\MultiSelectInterface;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use Illuminate\Support\Collection;

final class AnimalService implements MultiSelectInterface
{

    public function __construct(
        private AnimalRepository $animalRepository,
    ) {}

    public function searchForMultiSelect(
        ?string $search,
        int $limit = 5,
        array $data = []
    ): Collection {
        return $this->animalRepository->search($search, $limit)
            ->map(function (Animal $animal) {
                return [
                    'value' => $animal->id,
                    'name'  => $animal->title_ru,
                ];
            });
    }

}
