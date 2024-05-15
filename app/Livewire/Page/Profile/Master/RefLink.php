<?php

namespace App\Livewire\Page\Profile\Master;

use Livewire\Component;

class RefLink extends Component
{

    /** @var \App\Models\User */
    public $user;

    public function render()
    {
        return view('livewire.page.profile.master.ref-link');
    }

}
