<?php

namespace App\Livewire\Page\Profile\Client;

use App\Domain\Enum\AnimalType;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use App\Services\PetService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pet extends Component
{

    use WithFileUploads;

    /** @var \App\Models\User */
    public $user;

    public $nickname;

    public $animal;

    public $breed;

    public $file;

    public $pet_weight;

    public $breeds;

    public $petWeights;

    public $animals;

    public $dogAnimal;

    /** @var \App\Models\Pet[] */
    public $pets;

    public function rules()
    {
        return [
            'nickname'   => ['required', 'string', 'max:255'],
            'animal'     => ['required', 'exists:animals,id'],
            'breed'      => ['nullable', 'exists:breeds,id'],
            'file'       => [
                'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:15048',
            ],
            'pet_weight' => ['required', 'exists:pet_weights,id'],
        ];
    }

    public function savePet()
    {
        $this->validate();

        $petService          = app(PetService::class);
        $petWeightRepository = app(PetWeightRepository::class);
        $animalRepository    = app(AnimalRepository::class);
        $breedsRepository    = app(BreedRepository::class);

        $animal = $animalRepository->getById($this->animal);

        $file = $this->file;

        $petService->store(
            $this->user,
            $this->nickname,
            $animal,
            $animal->title->value === AnimalType::Dog->value
                ? $breedsRepository->getById($this->breed) : null,
            $petWeightRepository->getById($this->pet_weight),
            $file
        );

        session()->flash('success', 'Питомец добавлен.');

        $this->nickname   = null;
        $this->animal     = null;
        $this->breed      = null;
        $this->file       = null;
        $this->pet_weight = null;

        $this->user->refresh();

        $this->pets = $this->user->pets()->with([
            'petWeight', 'breed', 'animal',
        ])->get();
    }

    public function deletePet($idPet)
    {
        app(PetService::class)->delete($idPet);

        $this->user->refresh();

        $this->pets = $this->user->pets;
    }

    public function mount()
    {
        $petWeightRepository = app(PetWeightRepository::class);
        $animalRepository    = app(AnimalRepository::class);
        $breedsRepository    = app(BreedRepository::class);

        $this->dogAnimal = $animalRepository->getWhere(AnimalType::Dog);

        $this->petWeights = $petWeightRepository->all();
        $this->animals    = $animalRepository->all();
        $this->breeds     = $breedsRepository->allWhereAnimal(
            $animalRepository->getWhere(
                AnimalType::Dog
            ),
        );

        $this->pets = $this->user->pets;
    }

    public function render()
    {
        return view('livewire.page.profile.client.pet');
    }

}
