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
        int $perPage = 15
    ): LengthAwarePaginator {
        return MasterAdvertisement::search($search,
            function (Indexes $meilisearch, string $query, array $options) use (
                $filterData
            ) {
                $options['facets']   = MasterAdvertisement::FACETS;
                $options['filter'][] = 'is_published = true';

                $options['sort'] = ['top_at:desc'];

                if (count($filterData->locations)) {
                    $options['filter'][] = 'locations IN ['
                        .implode(',', $filterData->locations).']';
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