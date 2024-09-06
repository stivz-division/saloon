<?php

declare(strict_types=1);

namespace App\Livewire\Components\Hepler\MultiSelect;

use App\Services\BreedService;

trait Breed
{

    public $serviceBreed = BreedService::class;

    public $breeds = [];

    public function setBreeds($selected)
    {
        $this->breeds = $selected;
    }

}