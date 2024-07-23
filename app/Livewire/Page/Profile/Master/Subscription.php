<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\User;
use Livewire\Component;

class Subscription extends Component
{

    public User $user;

    public function render()
    {
        return view('livewire.page.profile.master.subscription');
    }

}
