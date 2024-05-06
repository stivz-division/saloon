<?php

namespace Database\Seeders;

use App\Domain\Enum\AnimalType;
use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Animal::query()->updateOrCreate([
            'title' => AnimalType::Dog
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Cat
        ]);
    }
}
