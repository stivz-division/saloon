<?php

declare(strict_types=1);

namespace App\Livewire\Components\Hepler\MultiSelect;

use App\Services\AnimalService;

trait Animal
{

    public $serviceAnimal = AnimalService::class;

    public $animals = [];

    public function setAnimals($selected)
    {
        $this->animals = $selected;
    }

}