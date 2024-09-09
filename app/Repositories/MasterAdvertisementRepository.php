<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\DTO\MasterAdvertisementFilterData;
use App\Models\MasterAdvertisement;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Meilisearch\Endpoints\Indexes;

final class MasterAdvertisementRepository
{

    /**
     * @param  string  $search
     * @param  \App\Domain\DTO\MasterAdvertisementFilterData  $filterData
     * @param  int  $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchAdvertisementsForCatalog(
        string $search,
        MasterAdvertisementFilterData $filterData,
        int $masterId = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        return MasterAdvertisement::search($search,
            function (Indexes $meilisearch, string $query, array $options) use (
                $masterId,
                $filterData
            ) {
                $options['facets']   = MasterAdvertisement::FACETS;
                $options['filter'][] = 'is_published = true';

                if ($masterId !== null) {
                    $options['filter'][] = 'user_id = '.$masterId;
                }

                if (count($filterData->animals)) {
                    $options['filter'][] = 'animals IN ['
                        .implode(',', $filterData->animals).']';
                }

                if (count($filterData->breeds)) {
                    $options['filter'][] = 'breeds IN ['
                        .implode(',', $filterData->breeds).']';
                }

                $options['sort'] = ['top_at:desc'];

                if (count($filterData->locations)) {
                    $options['filter'][] = 'locations IN ['
                        .implode(',', $filterData->locations).']';
                }

                if ($filterData->dateTimeServiceStart !== null
                    && $filterData->dateTimeServiceEnd === null
                ) {
                    $options['filter'][] = 'start_at >= '
                        .$filterData->dateTimeServiceStart->timestamp;
                }

                if ($filterData->dateTimeServiceStart === null
                    && $filterData->dateTimeServiceEnd !== null
                ) {
                    $options['filter'][] = 'end_at <= '
                        .$filterData->dateTimeServiceEnd->timestamp;
                }

                if ($filterData->dateTimeServiceStart !== null
                    && $filterData->dateTimeServiceEnd !== null
                ) {
                    $options['filter'][] = 'end_at <= '
                        .$filterData->dateTimeServiceEnd->timestamp
                        .' AND start_at >= '
                        .$filterData->dateTimeServiceStart->timestamp;
                }

                return $meilisearch->search($query, $options);
            })
            ->query(fn(Builder $query) => $query->with([
                'media', 'locations',
            ]))
            ->paginateRaw($perPage);
    }

    /**
     * @param  User  $user
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getUserAdvertisementsPaginate(
        User $user,
        int $perPage = 15
    ): LengthAwarePaginator {
        return MasterAdvertisement::query()
            ->where('user_id', $user->id)
            ->with(['media', 'locations', 'advertisementTopTariff'])
            ->paginate($perPage);
    }

    /**
     * @param  \App\Models\User  $user
     * @param  int  $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPublishedAdvertisementsPaginate(
        User $user,
        int $perPage = 15
    ): LengthAwarePaginator {
        return MasterAdvertisement::query()
            ->active()
            ->where('user_id', $user->id)
            ->with(['media', 'locations', 'advertisementTopTariff'])
            ->paginate($perPage);
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return int
     */
    public function getUserPublishedAdvertisementsCount(
        User $user,
    ): int {
        return MasterAdvertisement::query()
            ->where('user_id', $user->id)
            ->where('is_published', true)
            ->count();
    }

    /**
     * @param  \App\Models\User  $user
     * @param  int  $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserArchivedAdvertisementsPaginate(
        User $user,
        int $perPage = 15
    ): LengthAwarePaginator {
        return MasterAdvertisement::query()
            ->where('user_id', $user->id)
            ->where('is_published', false)
            ->with(['media', 'locations', 'advertisementTopTariff'])
            ->paginate($perPage);
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return int
     */
    public function getUserArchivedAdvertisementsCount(
        User $user,
    ): int {
        return MasterAdvertisement::query()
            ->where('user_id', $user->id)
            ->where('is_published', false)
            ->count();
    }

    /**
     * @param  int  $id
     *
     * @return MasterAdvertisement|null
     */
    public function getById(int $id): ?MasterAdvertisement
    {
        return MasterAdvertisement::query()->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return MasterAdvertisement::query()
            ->whereIn('id', $ids)
            ->latest('top_at')
            ->get();
    }

}