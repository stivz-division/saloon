<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\ServiceMaster;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Services extends Component
{

    /** @var \App\Models\User */
    public $user;

    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string|max:2000')]
    public $description;

    #[Validate('required|numeric|min:0|max:10000000')]
    public $price;

    public $services;

    public function mount()
    {
        $this->services = $this->user->masterServices;
    }

    public function deleteService($idService)
    {
        ServiceMaster::query()->find($idService)->delete();

        $this->mount();

        session()->flash('success', 'Услуга удалена');
    }

    public function storeService()
    {
        $this->validate();

        $this->user->masterServices()->create([
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
        ]);

        $this->title       = null;
        $this->description = null;
        $this->price       = null;

        session()->flash('success', 'Услуга добавлена');

        $this->mount();
    }

    public function render()
    {
        return view('livewire.page.profile.master.services');
    }

}
