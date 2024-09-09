<?php

namespace App\Livewire\Page\Advertisement\Master\Facet;

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

        $idBreeds = DB::table('master_advertisement_breeds')
            ->select('breed_id')
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

        return view('livewire.page.advertisement.master.facet.breeds');
    }

}
