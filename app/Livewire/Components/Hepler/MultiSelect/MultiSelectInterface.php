<?php

declare(strict_types=1);

namespace App\Livewire\Components\Hepler\MultiSelect;

interface MultiSelectInterface
{

    public function searchForMultiSelect(
        ?string $search,
        int $limit = 5,
        array $data = []
    );

}