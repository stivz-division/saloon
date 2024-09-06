<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class CheckSubscriptionCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверяем актуальность подписки.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = app(SubscriptionService::class);

        User::query()
            ->whereNotNull('subscription_id')
            ->lazy()
            ->each(function (User $user) use ($service) {
                if ($user->subscription_end_at->isPast()) {
                    $service->unsubscribe($user);
                }
            });
    }

}
