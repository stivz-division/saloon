<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\YandexLocation;
use Illuminate\Database\Eloquent\Collection;

final class YandexLocationRepository
{

    public function search(string $location, int $limit = 5): Collection
    {
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = YandexLocation::search($location)->get();

        return $collection->take($limit);
    }

}