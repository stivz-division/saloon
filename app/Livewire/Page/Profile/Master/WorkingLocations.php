<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\User;
use App\Services\YandexLocationService;
use Livewire\Component;

class WorkingLocations extends Component
{

    public User $user;

    public $service = YandexLocationService::class;

    public $locations = [];

    public function mount()
    {
        $this->locations = $this->user->workingLocations->map(function (
            $location
        ) {
            return [
                'value' => $location->id,
                'name'  => $location->location,
            ];
        });
    }

    public function setLocations($selected)
    {
        $this->locations = $selected;
    }

    public function saveLocations()
    {
        if ( ! count($this->locations)) {
            return;
        }

        $this->user->workingLocations()
            ->sync(
                collect($this->locations)->pluck('value')
            );

        session()->flash('success', __('Сохранено!'));
    }

    public function render()
    {
        return view('livewire.page.profile.master.working-locations');
    }

}
