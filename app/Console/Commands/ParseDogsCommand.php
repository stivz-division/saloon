<?php

namespace App\Console\Commands;

use App\Domain\Enum\AnimalType;
use App\Models\Animal;
use Illuminate\Console\Command;

class ParseDogsCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:dogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсим собак';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = base_path('dogs.txt');

        /** @var Animal $animal */
        $animal = Animal::query()
            ->where('title', AnimalType::Dog->value)
            ->first();

        $handle = fopen($filePath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $animal->breeds()->createOrFirst([
                    'name' => str($line)->squish()->toString(),
                ]);
            }

            fclose($handle);
        }
    }

}
