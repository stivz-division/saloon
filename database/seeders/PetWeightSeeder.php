<?php

namespace Database\Seeders;

use App\Domain\Enum\PetWeightType;
use App\Models\PetWeight;
use Illuminate\Database\Seeder;

class PetWeightSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetWeight::query()->updateOrCreate([
            'title' => PetWeightType::AboveSix,
        ]);

        PetWeight::query()->updateOrCreate([
            'title' => PetWeightType::SixTwelve,
        ]);

        PetWeight::query()->updateOrCreate([
            'title' => PetWeightType::TwelveTwenty,
        ]);

        PetWeight::query()->updateOrCreate([
            'title' => PetWeightType::TwentyForty,
        ]);

        PetWeight::query()->updateOrCreate([
            'title' => PetWeightType::OverForty,
        ]);
    }

}
