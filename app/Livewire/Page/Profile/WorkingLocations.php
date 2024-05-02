<?php

namespace App\Livewire\Page\Profile;

use App\Services\YandexLocationService;
use Livewire\Attributes\On;
use Livewire\Component;

class WorkingLocations extends Component
{

    public $service = YandexLocationService::class;

    public $locations = [];

    public function setLocations($selected)
    {
        $this->locations = $selected;
    }

    public function render()
    {
        return view('livewire.page.profile.working-locations');
    }

}
