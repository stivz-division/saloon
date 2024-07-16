<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MasterAdvertisementPage extends Component
{

    use Location;
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    #[Validate('required|string')]
    public $name;

    #[Validate('required|string')]
    public $description;

    #[Validate('nullable|date_format:Y-m-d')]
    public $start_at;

    #[Validate('nullable|date_format:Y-m-d')]
    public $end_at;

    public $animal;

    public $dogAnimal;

    public $animals;
    
    public $breeds;

    public $petWeights;

    public function mount()
    {
        $breedsRepository = app(BreedRepository::class);

        $this->locations = auth()->user()->workingLocations->map(function (
            $location
        ) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        });

        $animalRepository    = app(AnimalRepository::class);
        $petWeightRepository = app(PetWeightRepository::class);

        $this->dogAnimal = $animalRepository->getWhere(AnimalType::Dog);

        $this->breeds = $breedsRepository->allWhereAnimal(
            $animalRepository->getWhere(
                AnimalType::Dog
            ),
        );

        $this->animals    = $animalRepository->all();
        $this->petWeights = $petWeightRepository->all();
    }

    public function save()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.page.advertisement.master.master-advertisement-page');
    }

}
