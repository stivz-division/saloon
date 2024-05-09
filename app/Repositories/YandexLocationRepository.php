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

    /**
     * @param  array  $ids
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids): Collection
    {
        return YandexLocation::query()
            ->whereIn('id', $ids)
            ->get();
    }

}