<?php

namespace App\Console\Commands;

use App\Models\YandexLocation;
use Illuminate\Console\Command;

class ParseYandexLocationCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:yandex-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсим YANDEX LOCATION';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url       = 'https://serpapi.com/yandex/yandex-ru-geo-codes.json';
        $locations = json_decode(file_get_contents($url), true, 512,
            JSON_THROW_ON_ERROR);

        foreach ($locations as $location) {
            YandexLocation::query()->updateOrCreate([
                'lr' => $location['lr'],
            ], [
                'location' => $location['location'],
            ]);
        }
    }

}
