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

    public function store(
        User $author,
        MasterAdvertisementStoreData $data
    ): MasterAdvertisement {
        // TODO: Добавить проверку на подписку...

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
            'end_published_at' => now()->addDays(30),
            'status'           => true,
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

}