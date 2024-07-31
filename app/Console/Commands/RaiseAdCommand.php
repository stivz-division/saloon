<?php

namespace App\Console\Commands;

use App\Services\AdvertisementTopTariffService;
use Illuminate\Console\Command;

class RaiseAdCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:raise-ad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Поднимаем уведомления в TOP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(AdvertisementTopTariffService::class)
            ->raise();
    }

}
