<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

final class UserService
{

    public function masterPaymentSubscribe(User $master)
    {
        $master->infoMaster()->update([
            'is_subscription'     => true,
            'subscription_at'     => now(),
            'subscription_end_at' => now()->addMonths(),
        ]);
    }

}