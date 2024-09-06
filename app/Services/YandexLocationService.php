<?php

declare(strict_types=1);

namespace App\Services;

use App\Livewire\Components\Hepler\MultiSelect\MultiSelectInterface;
use App\Models\YandexLocation;
use App\Repositories\YandexLocationRepository;
use Illuminate\Support\Collection;

final class YandexLocationService implements MultiSelectInterface
{

    public function __construct(
        private YandexLocationRepository $yandexLocationRepository,
    ) {}

    public function searchForMultiSelect(
        ?string $search,
        int $limit = 5,
        array $data = []
    ): Collection {
        return $this->yandexLocationRepository->search($search, $limit)
            ->map(function (YandexLocation $location) {
                return [
                    'value' => $location->id,
                    'name'  => $location->location,
                ];
            });
    }

}