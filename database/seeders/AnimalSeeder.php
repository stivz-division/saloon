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
        ], [
            'title_ru' => AnimalType::Dog->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Cat,
        ], [
            'title_ru' => AnimalType::Cat->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Mouse,
        ], [
            'title_ru' => AnimalType::Mouse->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Rabbit,
        ], [
            'title_ru' => AnimalType::Rabbit->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Pig,
        ], [
            'title_ru' => AnimalType::Pig->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Bird,
        ], [
            'title_ru' => AnimalType::Bird->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Reptile,
        ], [
            'title_ru' => AnimalType::Reptile->name(),
        ]);

        Animal::query()->updateOrCreate([
            'title' => AnimalType::Others,
        ], [
            'title_ru' => AnimalType::Others->name(),
        ]);
    }

}
