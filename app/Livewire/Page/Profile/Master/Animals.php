<?php

namespace App\Livewire\Page\Profile\Master;

use App\Services\AnimalService;
use Livewire\Component;

class Animals extends Component
{
    /** @var \App\Models\User */
    public $user;

    public $service = AnimalService::class;

    public $animals = [];

    public function mount()
    {
        $this->animals = $this->user->animalsMaster->map(function (
            $animal
        ) {
            return [
                'value' => $animal->id,
                'name' => $animal->title->name(),
            ];
        });
    }

    public function setAnimals($selected)
    {
        $this->animals = $selected;
    }

    public function saveAnimals()
    {
        $this->user->animalsMaster()
            ->sync(
                collect($this->animals)->pluck('value')
            );

        session()->flash('success', __('Сохранено!'));
    }

    public function render()
    {
        return view('livewire.page.profile.master.animals');
    }
}
