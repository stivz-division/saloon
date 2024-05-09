<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Animal;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\PetWeight;
use App\Models\User;
use App\Repositories\PetRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class PetService
{

    public function __construct(
        private PetRepository $petRepository,
    ) {}

    public function delete($idPet): void
    {
        $pet = $this->petRepository->getById($idPet);

        $pet->delete();
    }

    /**
     * @param  \App\Models\User  $user
     * @param  string  $nickname
     * @param  \App\Models\Animal  $animal
     * @param  \App\Models\Breed|null  $breed
     * @param  \App\Models\PetWeight  $weight
     *
     * @return Pet
     */
    public function store(
        User $user,
        string $nickname,
        Animal $animal,
        ?Breed $breed,
        PetWeight $weight,
        ?UploadedFile $file
    ): Pet {
        DB::beginTransaction();

        $pet = Pet::query()->create([
            'user_id'       => $user->id,
            'breed_id'      => $breed?->id,
            'animal_id'     => $animal->id,
            'pet_weight_id' => $weight->id,
            'nickname'      => $nickname,
        ]);

        if ($file !== null) {
            $pet->addMedia($file)
                ->toMediaCollection(Pet::MEDIA_COLLECTION_NAME);
        }

        DB::commit();

        return $pet;
    }

}