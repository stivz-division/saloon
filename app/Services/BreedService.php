<?php

declare(strict_types=1);

namespace App\Services;

use App\Livewire\Components\Hepler\MultiSelect\MultiSelectInterface;
use App\Models\Breed;
use App\Repositories\BreedRepository;

final class BreedService implements MultiSelectInterface
{

    public function __construct(
        public BreedRepository $breedRepository,
    ) {}

    /**
     * @param  string|null  $search
     * @param  int  $limit
     * @param  array  $data
     *
     * @return \Illuminate\Support\Collection
     */
    public function searchForMultiSelect(
        ?string $search,
        int $limit = 5,
        array $data = []
    ) {
        if (isset($data['animal_id']) === false) {
            $data['animal_id'] = null;
        }

        return $this->breedRepository->search($search, $limit,
            $data['animal_id'])
            ->map(function (Breed $breed) {
                return [
                    'value' => $breed->id,
                    'name'  => $breed->name,
                ];
            });
    }

}