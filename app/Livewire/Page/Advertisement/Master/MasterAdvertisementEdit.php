<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementStoreData;
use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Models\MasterAdvertisement;
use App\Repositories\AnimalRepository;
use App\Repositories\BreedRepository;
use App\Repositories\PetWeightRepository;
use App\Services\MasterAdvertisementService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MasterAdvertisementEdit extends Component
{

    use Location;
    use WithFileUploads;

    public MasterAdvertisement $masterAdvertisement;

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
        $breedsRepository = app(BreedRepository::class);

        $this->locations = $this->masterAdvertisement->locations->map(function (
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

        $this->animals     = $animalRepository->all();
        $this->petWeights  = $petWeightRepository->all();
        $this->name        = $this->masterAdvertisement->title;
        $this->description = $this->masterAdvertisement->description;
        $this->start_at
                           = $this->masterAdvertisement->start_at?->toDateString();
        $this->end_at
                           = $this->masterAdvertisement->end_at?->toDateString();
        $this->price       = $this->masterAdvertisement->price;

        // TODO: // переделать на массив
        $this->pet_weight = $this->masterAdvertisement->petWeights->first()->id;
        $this->animal     = $this->masterAdvertisement->animals->first()->id;
        $this->breed      = $this->masterAdvertisement->breeds->first()->id;
    }

    public function updateAdvertisement()
    {
        $this->validate();

        if (auth()->user()->can('update', $this->masterAdvertisement)
            === false
        ) {
            abort(403);
        }

        app(MasterAdvertisementService::class)
            ->update(
                $this->masterAdvertisement,
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

    public function deleteImage(int $idImage)
    {
        if (auth()->user()->can('update', $this->masterAdvertisement)
            === false
        ) {
            abort(403);
        }

        $image = $this->masterAdvertisement->images()->where('id', $idImage)
            ->first();

        if ($image === null) {
            abort(404);
        }

        $image->delete();

        return $this->redirectRoute('master.advertisement.edit', [
            'masterAdvertisement' => $this->masterAdvertisement->id,
        ]);
    }

    public function render()
    {
        return view('livewire.page.advertisement.master.master-advertisement-edit');
    }

}
