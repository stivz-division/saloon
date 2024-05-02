<?php

namespace App\Livewire\Page;

use App\Models\User;
use Livewire\Component;

class ProfilePage extends Component
{

    /** @var User */
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.page.profile-page');
    }

}
