<?php

namespace App\Livewire\Page\Advertisement\Client\Facet;

use Livewire\Component;

class Animals extends Component
{

    public $selectAnimals = [];

    public $animals = [];

    public function updatedSelectAnimals()
    {
        $this->dispatch('change-animals', selected: $this->selectAnimals);
    }

    public function render()
    {
        return view('livewire.page.advertisement.client.facet.animals');
    }

}
