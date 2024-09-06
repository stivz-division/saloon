<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementStoreData;
use App\Domain\Enum\AnimalType;
use App\Livewire\Components\Hepler\MultiSelect\Animal;
use App\Livewire\Components\Hepler\MultiSelect\Breed;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Livewire\Components\Hepler\MultiSelect\PetWeight;
use App\Models\MasterAdvertisement;
use App\Repositories\AnimalRepository;
use App\Services\MasterAdvertisementService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MasterAdvertisementEdit extends Component
{

    use Location;
    use Animal;
    use Breed;
    use PetWeight;
    use WithFileUploads;

    public MasterAdvertisement $masterAdvertisement;

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
        $this->locations = $this->masterAdvertisement->locations->map(function (
            $location
        ) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        })->toArray();

        $animalRepository = app(AnimalRepository::class);

        $this->dogAnimal = $animalRepository->getWhere(AnimalType::Dog);

        $this->name        = $this->masterAdvertisement->title;
        $this->description = $this->masterAdvertisement->description;
        $this->start_at
                           = $this->masterAdvertisement->start_at?->toDateString();
        $this->end_at
                           = $this->masterAdvertisement->end_at?->toDateString();
        $this->price       = $this->masterAdvertisement->price;

        $this->animals = $this->masterAdvertisement->animals->map(function (
            $item
        ) {
            return [
                'value' => $item->id,
                'name'  => $item->title_ru,
            ];
        });

        $this->petWeights
            = $this->masterAdvertisement->petWeights->map(function (
            $item
        ) {
            return [
                'value' => $item->id,
                'name'  => $item->title,
            ];
        });

        $this->breeds
            = $this->masterAdvertisement->breeds->map(function (
            $item
        ) {
            return [
                'value' => $item->id,
                'name'  => $item->name,
            ];
        });
    }

    public function updateAdvertisement()
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

        if (auth()->user()->can('update', $this->masterAdvertisement)
            === false
        ) {
            abort(403);
        }

        $animals    = collect($this->animals)->pluck('value')->toArray();
        $petWeights = collect($this->petWeights)->pluck('value')->toArray();
        $breeds     = collect($this->breeds)->pluck('value')->toArray();

        app(MasterAdvertisementService::class)
            ->update(
                $this->masterAdvertisement,
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
