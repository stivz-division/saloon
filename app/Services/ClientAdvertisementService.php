<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\DTO\ClientAdvertisementStoreData;
use App\Models\ClientAdvertisement;
use App\Repositories\ClientAdvertisementRepository;
use App\Repositories\UserRepository;

final class ClientAdvertisementService
{

    public function __construct(
        private ClientAdvertisementRepository $clientAdvertisementRepository,
        private UserRepository $userRepository
    ) {}

    public function payment(int $id)
    {
        $clientAdvertisement
            = $this->clientAdvertisementRepository->getById($id);

        $clientAdvertisement->update([
            'is_payment'       => true,
            'is_published'     => true,
            'published_end_at' => now()->addYears(),
        ]);
    }

    public function unPublish(ClientAdvertisement $clientAdvertisement): void
    {
        $clientAdvertisement->update(['is_published' => false]);
    }

    public function checkAdvertisement(
        int $checkUserId,
        string $uuidAdvertisement
    ): bool {
        $advertisement = $this->clientAdvertisementRepository->getByUuid(
            $uuidAdvertisement
        );

        if ($advertisement === null) {
            return false;
        }

        $user = $this->userRepository->getById($checkUserId);

        if ($user === null) {
            return false;
        }

        if ($advertisement->isAuthor($user->id)) {
            return true;
        }

        if ($user->isMaster()) {
            return $user->isActiveSubscription()
                || $advertisement->itMasterPayment($user->id);
        }

        if ($advertisement === null) {
            return false;
        }

        if ($advertisement->is_published === false) {
            return false;
        }

        if ($advertisement->published_end_at->isPast() === false) {
            return false;
        }

        return true;
    }

    public function delete(int $id): void
    {
        $this->clientAdvertisementRepository->getById($id)?->delete();
    }

    public function store(ClientAdvertisementStoreData $data
    ): ClientAdvertisement {
        return ClientAdvertisement::query()->create([
            'user_id'             => $data->user_id,
            'pet_id'              => $data->pet_id,
            'description'         => $data->description,
            'yandex_location_id'  => $data->yandex_location_id,
            'datetime_service_at' => $data->datetime_service_at,
            'is_payment'          => $data->is_payment,
            'is_published'        => $data->is_published,
            'published_at'        => $data->published_at,
            'published_end_at'    => $data->published_end_at,
        ]);
    }

}