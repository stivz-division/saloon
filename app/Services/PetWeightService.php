<?php

declare(strict_types=1);

namespace App\Services;

use App\Livewire\Components\Hepler\MultiSelect\MultiSelectInterface;
use App\Models\PetWeight;
use App\Repositories\PetWeightRepository;

final class PetWeightService implements MultiSelectInterface
{

    public function __construct(
        private PetWeightRepository $petWeightRepository
    ) {}

    public function searchForMultiSelect(
        ?string $search,
        int $limit = 5,
        array $data = []
    ) {
        return $this->petWeightRepository->search($search, $limit)
            ->map(function (PetWeight $petWeight) {
                return [
                    'value' => $petWeight->id,
                    'name'  => $petWeight->title,
                ];
            });
    }

}