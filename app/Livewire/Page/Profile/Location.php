<?php

namespace App\Livewire\Page\Profile;

use Livewire\Component;

class Location extends Component
{

    /** @var \App\Models\User */
    public $user;

    public function render()
    {
        return view('livewire.page.profile.location');
    }

}
