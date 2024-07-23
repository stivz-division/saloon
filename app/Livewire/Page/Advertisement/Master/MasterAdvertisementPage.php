<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementStoreData;
use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use App\Services\MasterAdvertisementService;
use App\Services\SubscriptionService;
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

    #[Validate('required|exists:animals,id')]
    public $animal;

    #[Validate('required|exists:pet_weights,id')]
    public $pet_weight;

    #[Validate('nullable|exists:breeds,id')]
    public $breed;

    #[Validate('required|numeric|min:1')]
    public $price;

    public $dogAnimal;

    public $animals;

    public $breeds;

    public $petWeights;

    public function mount()
    {
        $checkSubscription
            = app(SubscriptionService::class)->checkCanCreateAdvertisement(
            auth()->user(),
        );

        if ($checkSubscription === false) {
            //            session()->flash('success',
            //                'Лимит на создание объявлений достигнут! Перейдите на другую подписку, чтобы его увеличить!');
            $this->redirectRoute('subscription.list');
        }

        $breedsRepository = app(BreedRepository::class);

        $this->locations = auth()->user()->workingLocations->map(function (
            $location
        ) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        })->toArray();

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

        app(MasterAdvertisementService::class)
            ->store(
                auth()->user(),
                new MasterAdvertisementStoreData(
                    $this->name,
                    $this->description,
                    $this->animal ? [$this->animal] : [],
                    // TODO: Получать массив
                    $this->pet_weight ? [$this->pet_weight] : [],
                    // TODO: Получать массив
                    $this->breed ? [$this->breed] : [], // TODO: Получать массив
                    $this->price,
                    $this->start_at,
                    $this->end_at,
                    $this->locations,
                    $this->photos,
                )
            );

        $this->redirectRoute('profile');
    }

    public function render()
    {
        return view('livewire.page.advertisement.master.master-advertisement-page');
    }

}
