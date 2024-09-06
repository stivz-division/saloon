<?php

declare(strict_types=1);

namespace App\Livewire\Components\Hepler\MultiSelect;

use App\Services\PetWeightService;

trait PetWeight
{

    public $servicePetWeight = PetWeightService::class;

    public $petWeights = [];

    public function setPetWeights($selected)
    {
        $this->petWeights = $selected;
    }

}