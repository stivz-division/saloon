<?php

declare(strict_types=1);

namespace App\Livewire\Components\Hepler\MultiSelect;

use App\Services\YandexLocationService;

trait Location
{

    public $serviceLocation = YandexLocationService::class;

    public $locations = [];

    public function setLocations($selected)
    {
        $this->locations = $selected;
    }

}