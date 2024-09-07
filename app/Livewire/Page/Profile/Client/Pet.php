<?php

namespace App\Livewire\Page\Profile\Client;

use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Breed;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use App\Services\PetService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pet extends Component
{

    use WithFileUploads;
    use Breed;

    /** @var \App\Models\User */
    public $user;

    public $nickname;

    public $animal;

    public $file;

    public $pet_weight;

    public $petWeights;

    public $animals;

    public $dogAnimal;

    /** @var \App\Models\Pet[] */
    public $pets;

    public function rules()
    {
        return [
            'nickname'       => ['required', 'string', 'max:255'],
            'animal'         => ['required', 'exists:animals,id'],
            'breeds'         => 'nullable|array|min:0|max:1',
            'breeds.*.value' => 'exists:breeds,id',
            'file'           => [
                'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:15048',
            ],
            'pet_weight'     => ['required', 'exists:pet_weights,id'],
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
                ? $breedsRepository->getById($this->breeds[0]['value']) : null,
            $petWeightRepository->getById($this->pet_weight),
            $file
        );

        session()->flash('success', 'Питомец добавлен.');

        $this->nickname   = null;
        $this->animal     = null;
        $this->breeds     = [];
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

        $this->dogAnimal = $animalRepository->getWhere(AnimalType::Dog);

        $this->petWeights = $petWeightRepository->all();
        $this->animals    = $animalRepository->all();

        $this->pets = $this->user->pets;
    }

    public function render()
    {
        return view('livewire.page.profile.client.pet');
    }

}
