<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementStoreData;
use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Animal;
use App\Livewire\Components\Hepler\MultiSelect\Breed;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Livewire\Components\Hepler\MultiSelect\PetWeight;
use App\Repositories\AnimalRepository;
use App\Services\MasterAdvertisementService;
use App\Services\SubscriptionService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MasterAdvertisementPage extends Component
{

    use Location;
    use Animal;
    use Breed;
    use PetWeight;
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:5024'])]
    public $photos = [];

    #[Validate('required|string')]
    public $name;

    #[Validate('required|string')]
    public $description;

    #[Validate('nullable|date_format:Y-m-d')]
    public $start_at;

    #[Validate('nullable|date_format:Y-m-d')]
    public $end_at;

    #[Validate('required|numeric|min:1')]
    public $price;

    public $dogAnimal;

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

        $this->locations = auth()->user()->workingLocations->map(function (
            $location
        ) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        })->toArray();

        $animalRepository = app(AnimalRepository::class);

        $this->dogAnimal = $animalRepository->getWhere(AnimalType::Dog);
    }

    public function save()
    {
        $this->addRulesFromOutside([
            'animals'         => 'required|array|min:1',
            'animals.*.value' => 'exists:animals,id',

            'petWeights'         => 'required|array|min:1',
            'petWeights.*.value' => 'exists:pet_weights,id',

            'breeds'         => 'nullable|array|min:0',
            'breeds.*.value' => 'exists:breeds,id',
        ]);

        $this->validate();

        $animals    = collect($this->animals)->pluck('value')->toArray();
        $petWeights = collect($this->petWeights)->pluck('value')->toArray();
        $breeds     = collect($this->breeds)->pluck('value')->toArray();

        app(MasterAdvertisementService::class)
            ->store(
                auth()->user(),
                new MasterAdvertisementStoreData(
                    $this->name,
                    $this->description,
                    $animals,
                    $petWeights,
                    $breeds,
                    $this->price,
                    $this->start_at,
                    $this->end_at,
                    $this->locations,
                    $this->photos
                )
            );

        $this->redirectRoute('profile');
    }

    public function render()
    {
        return view('livewire.page.advertisement.master.master-advertisement-page');
    }

}
