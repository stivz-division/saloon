<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\DTO\MasterAdvertisementStoreData;
use App\Models\MasterAdvertisement;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class MasterAdvertisementService
{

    public function __construct(
        public SubscriptionService $subscriptionService,
    ) {}

    public function store(
        User $author,
        MasterAdvertisementStoreData $data
    ): MasterAdvertisement {
        $checkCanCreateAdvertisement
            = $this->subscriptionService->checkCanCreateAdvertisement(
            $author
        );

        if ($checkCanCreateAdvertisement === false) {
            throw new \Exception('Лимит на создание объявлений достигнут! Перейдите на другую подписку, чтобы его увеличить!');
        }

        DB::beginTransaction();

        /** @var MasterAdvertisement $advertisement */
        $advertisement = MasterAdvertisement::query()->create([
            'user_id'          => $author->id,
            'title'            => $data->name,
            'description'      => $data->description,
            'start_at'         => $data->start_at
                ? Carbon::parse($data->start_at)
                : null,
            'end_at'           => $data->end_at ? Carbon::parse($data->end_at)
                : null,
            'price'            => $data->price,
            'published_at'     => now(),
            'end_published_at' => $this->subscriptionService->isFreeAdvertisement($author)
                ? now()->addDays($this->subscriptionService->getFreeAdvertisementPublishDays($author))
                : now()->addDays($author->subscription->published_days),
            'is_published'     => true,
            'top_at'           => now(),
        ]);

        $advertisement->animals()->sync($data->animals);
        $advertisement->locations()->sync(collect($data->locations)
            ->pluck('value')->toArray());
        $advertisement->petWeights()->sync($data->pet_weights);
        $advertisement->breeds()->sync($data->breeds);

        DB::commit();

        foreach ($data->photos as $photo) {
            $advertisement->addMedia($photo)
                ->toMediaCollection(MasterAdvertisement::MEDIA_COLLECTION_NAME);
        }

        return $advertisement;
    }

    public function update(
        MasterAdvertisement $masterAdvertisement,
        MasterAdvertisementStoreData $data
    ): MasterAdvertisement {
        DB::beginTransaction();

        $masterAdvertisement->update([
            'title'       => $data->name,
            'description' => $data->description,
            'start_at'    => $data->start_at
                ? Carbon::parse($data->start_at)
                : null,
            'end_at'      => $data->end_at ? Carbon::parse($data->end_at)
                : null,
            'price'       => $data->price,
        ]);

        $masterAdvertisement->animals()->sync($data->animals);
        $masterAdvertisement->locations()->sync(collect($data->locations)
            ->pluck('value')->toArray());
        $masterAdvertisement->petWeights()->sync($data->pet_weights);
        $masterAdvertisement->breeds()->sync($data->breeds);

        DB::commit();

        foreach ($data->photos as $photo) {
            $masterAdvertisement->addMedia($photo)
                ->toMediaCollection(MasterAdvertisement::MEDIA_COLLECTION_NAME);
        }

        return $masterAdvertisement;
    }

}