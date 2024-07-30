<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppInstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Установить все зависимости';

    protected $env
        = [
            'YOOKASSA_SHOP_ID',
            'YOOKASSA_API_KEY',
            'YOOKASSA_RETURN_URL',
            'SCOUT_DRIVER',
            'MEILISEARCH_HOST',
            'MEILISEARCH_HOST',
            'MEILISEARCH_NO_ANALYTICS',
            'MEILISEARCH_KEY',
        ];

    protected $commands
        = [
            'db:wipe',
            'migrate',
            'db:seed',
            'storage:link',
            'parse:dogs',
            'parse:yandex-location',
            'scout:sync-index-settings',
            'db:seed --class=TestSeeder',
            'db:seed --class=SubscriptionSeeder',
            'db:seed --class=TopTariffsSeeder',
        ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countActions = 10;

        $bar = $this->output->createProgressBar($countActions);

        $bar->start();

        foreach ($this->commands as $command) {
            $this->info(" $command");

            Artisan::call($command);

            $bar->advance();
        }

        $path = app()->environmentFilePath();

        if (file_exists($path) === false) {
            $this->error('.ENV FILE NOT FOUND');

            return Command::FAILURE;
        }

        foreach ($this->env as $env) {
            if (getenv($env) === false) {
                file_put_contents($path, "{$env}=\n", FILE_APPEND);
            }
        }

        $bar->advance();

        $bar->finish();

        $this->info(' APP INSTALL');

        return Command::SUCCESS;
    }

}
