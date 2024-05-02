<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\YandexLocation;
use App\Repositories\YandexLocationRepository;
use Illuminate\Support\Collection;

final class YandexLocationService
{

    public function __construct(
        private YandexLocationRepository $yandexLocationRepository,
    ) {}

    public function searchForMultiSelect(
        string $location,
        int $limit = 5
    ): Collection {
        $locations = $this->yandexLocationRepository->search($location, $limit);

        return $locations->map(function (YandexLocation $location) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        });
    }

}