<?php

namespace App\Console\Commands;

use App\Models\ClientAdvertisement;
use App\Services\ClientAdvertisementService;
use Illuminate\Console\Command;

class ClientAdvertisementCheckCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:client-advertisement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверяем актуальность даты публикации';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clientAdvertisementService = app(ClientAdvertisementService::class);

        ClientAdvertisement::query()
            ->where('is_published', true)
            ->lazy()
            ->each(function (ClientAdvertisement $clientAdvertisement) use (
                $clientAdvertisementService
            ) {
                if ($clientAdvertisement->published_end_at->isPast()) {
                    $clientAdvertisementService->unPublish($clientAdvertisement);
                }
            });
    }

}
