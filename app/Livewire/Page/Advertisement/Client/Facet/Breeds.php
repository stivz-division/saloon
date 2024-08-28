<?php

namespace App\Livewire\Page\Advertisement\Client\Facet;

use App\Models\Breed;
use App\Repositories\BreedRepository;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Breeds extends Component
{

    public $breeds = [];

    public $breedObjects;

    public $selectBreeds = [];

    public function updatedSelectBreeds()
    {
        $this->dispatch('change-breeds', selected: $this->selectBreeds);
    }

    public function render()
    {
        $breedRepository = app(BreedRepository::class);

        $idBreeds = DB::table('client_advertisements')
            ->join('pets', 'client_advertisements.pet_id', '=', 'pets.id')
            ->join('breeds', 'pets.breed_id', '=', 'breeds.id')
            ->distinct()
            ->pluck('breed_id')
            ->toArray();

        $this->breedObjects = $breedRepository->getByIds(
            $idBreeds,
        )->map(function (Breed $breed) {
            if (isset($this->breeds[$breed->id])) {
                $breed->count = $this->breeds[$breed->id];
            } else {
                $breed->count = 0;
            }

            return $breed;
        });

        return view('livewire.page.advertisement.client.facet.breeds');
    }

}
