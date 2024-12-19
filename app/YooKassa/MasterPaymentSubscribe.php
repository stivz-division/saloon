<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\UserRepository;
use App\Repositories\VIewSubscriptionRepository;
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

        $viewSubscribe = app(VIewSubscriptionRepository::class)->getById(
            (int) $this->payment->metadata->view_subscribe_id
        );

        if ($viewSubscribe === null) {
            return;
        }

        $master = $userRepository->getById(
            (int) $this->payment->metadata->master_id
        );

        if ($master === null) {
            return;
        }

        $userService->masterPaymentSubscribe(
            $master,
            $viewSubscribe
        );

        $masterSubscribeHistoryService->store(
            $master,
            (float) $viewSubscribe->price
        );
    }

}