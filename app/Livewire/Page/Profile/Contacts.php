<?php

namespace App\Livewire\Page\Profile;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Contacts extends Component
{

    /** @var \App\Models\User */
    public $user;

    #[Validate('nullable|string|min:12|max:12|regex:/^\+7\d{3}\d{3}\d{2}\d{2}$/i')]
    public $phone;

    #[Validate('nullable|string|min:12|max:12|regex:/^\+7\d{3}\d{3}\d{2}\d{2}$/i')]
    public $dop_phone;

    #[Validate('nullable|string|max:200|regex:/^@\w+$/i')]
    public $telegram;

    #[Validate('nullable|string|min:12|max:12|regex:/^\+7\d{3}\d{3}\d{2}\d{2}$/i')]
    public $whatsapp;

    public function mount()
    {
        $this->phone     = $this->user->phone;
        $this->dop_phone = $this->user->dop_phone;
        $this->telegram  = $this->user->telegram;
        $this->whatsapp  = $this->user->whatsapp;
    }

    public function saveContacts()
    {
        $this->validate();

        $this->user->phone     = $this->phone;
        $this->user->dop_phone = $this->dop_phone;
        $this->user->telegram  = $this->telegram;
        $this->user->whatsapp  = $this->whatsapp;

        $this->user->save();

        $this->user->refresh();

        session()->flash('success', 'Данные сохранены.');

        $this->mount();
    }

    public function render()
    {
        return view('livewire.page.profile.contacts');
    }

}
