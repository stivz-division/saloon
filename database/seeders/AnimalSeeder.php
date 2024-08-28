<?php

namespace Database\Seeders;

use App\Domain\Enum\AnimalType;
use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Animal::query()->updateOrCreate([
            'title' => AnimalType::Dog,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Cat,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Mouse,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Rabbit,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Pig,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Bird,
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Reptile,
        ]);
        
        Animal::query()->updateOrCreate([
            'title' => AnimalType::Others,
        ]);
    }

}
