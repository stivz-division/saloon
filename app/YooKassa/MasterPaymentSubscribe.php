<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\UserRepository;
use App\Services\MasterSubscribeHistoryService;
use App\Services\UserService;

final class MasterPaymentSubscribe extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $userRepository
            = app(UserRepository::class);

        $userService = app(UserService::class);

        $masterSubscribeHistoryService = app(
            MasterSubscribeHistoryService::class
        );

        $master = $userRepository->getById(
            (int) $this->payment->metadata->master_id
        );

        if ($master === null) {
            return;
        }

        $userService->masterPaymentSubscribe(
            $master,
        );

        $masterSubscribeHistoryService->store(
            $master,
            (float) config('yookassa.master-subscription')
        );
    }

}