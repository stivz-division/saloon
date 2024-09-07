<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\DTO\ClientAdvertisementFilterData;
use App\Models\ClientAdvertisement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Meilisearch\Endpoints\Indexes;

final class ClientAdvertisementRepository
{

    /**
     * @param  string  $search
     * @param  int  $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchAdvertisementsForCatalog(
        string $search,
        ClientAdvertisementFilterData $filterData,
        int $perPage = 15
    ): LengthAwarePaginator {
        return ClientAdvertisement::search($search,
            function (Indexes $meilisearch, string $query, array $options) use (
                $filterData
            ) {
                $options['facets']   = ClientAdvertisement::FACETS;
                $options['filter'][] = 'is_published = true';

                $options['sort'] = ['published_at:desc'];

                if (count($filterData->locations)) {
                    $options['filter'][] = 'yandex_location_id IN ['
                        .implode(',', $filterData->locations).']';
                }

                if (count($filterData->animals)) {
                    $options['filter'][] = 'animal IN ['
                        .implode(',', $filterData->animals).']';
                }

                if (count($filterData->breeds)) {
                    $options['filter'][] = 'breed_id IN ['
                        .implode(',', $filterData->breeds).']';
                }

                if ($filterData->withoutDateTime === false) {
                    if ($filterData->dateTimeServiceStart !== null
                        && $filterData->dateTimeServiceEnd === null
                    ) {
                        $options['filter'][] = 'datetime_service_at >= '
                            .$filterData->dateTimeServiceStart->timestamp;
                    }

                    if ($filterData->dateTimeServiceStart === null
                        && $filterData->dateTimeServiceEnd !== null
                    ) {
                        $options['filter'][] = 'datetime_service_at <= '
                            .$filterData->dateTimeServiceEnd->timestamp;
                    }

                    if ($filterData->dateTimeServiceStart !== null
                        && $filterData->dateTimeServiceEnd !== null
                    ) {
                        $options['filter'][] = 'datetime_service_at <= '
                            .$filterData->dateTimeServiceEnd->timestamp
                            .' AND datetime_service_at >= '
                            .$filterData->dateTimeServiceStart->timestamp;
                    }
                } else {
                    $options['filter'][] = 'datetime_service_at IS NULL';
                }

                return $meilisearch->search($query, $options);
            })
            ->query(fn(Builder $query) => $query->with([
                'user', 'pet', 'yandexLocation',
            ]))
            ->paginateRaw($perPage);
    }

    /**
     * @param  string  $uuid
     *
     * @return \App\Models\ClientAdvertisement|null
     */
    public function getByUuid(string $uuid): ?ClientAdvertisement
    {
        return ClientAdvertisement::query()
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * @param  int  $id
     *
     * @return \App\Models\ClientAdvertisement|null
     */
    public function getById(int $id): ?ClientAdvertisement
    {
        return ClientAdvertisement::query()->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return ClientAdvertisement::query()
            ->whereIn('id', $ids)
            ->latest('published_at')
            ->get();
    }

}