<?php

namespace Database\Seeders;

use App\Domain\DTO\ClientAdvertisementStoreData;
use App\Domain\Enum\AccountType;
use App\Domain\Enum\AnimalType;
use App\Models\User;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use App\Services\ClientAdvertisementService;
use App\Services\PetService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        $password = Hash::make('password');

        $admin = User::create([
            'account_type' => AccountType::Client->value,
            'name'         => 'ADMIN',
            'surname'      => 'ADMIN',
            'email'        => 'admin@mail.ru',
            'password'     => $password,
        ]);

        $petService          = app(PetService::class);
        $petWeightRepository = app(PetWeightRepository::class);
        $animalRepository    = app(AnimalRepository::class);
        $breedsRepository    = app(BreedRepository::class);

        $animal = $animalRepository->getById(1);

        $client = User::create([
            'account_type' => AccountType::Client->value,
            'name'         => 'CLIENT',
            'surname'      => 'CLIENT',
            'email'        => 'client@mail.ru',
            'password'     => $password,
        ]);

        $pet = $petService->store(
            $client,
            'nickname',
            $animal,
            $animal->title->value === AnimalType::Dog->value
                ? $breedsRepository->getById(1) : null,
            $petWeightRepository->getById(1),
            null
        );

        $clientAdvertisementService = app(ClientAdvertisementService::class);

        $clientAdvertisementService->store(
            new ClientAdvertisementStoreData(
                user_id: $client->id,
                pet_id: $pet->id,
                description: 'TEST',
                yandex_location_id: 1,
                datetime_service_at: now(),
                is_published: true,
                published_at: now(),
                published_end_at: now()->clone()->addMonths(),
            )
        );

        $master = User::create([
            'account_type' => AccountType::Master->value,
            'name'         => 'CLIENT',
            'surname'      => 'CLIENT',
            'email'        => 'master@mail.ru',
            'password'     => $password,
        ]);
    }

}
