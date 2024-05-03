<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\User;
use Livewire\Component;

class MasterProfile extends Component
{

    public User $user;

    public $is_veterinarian;

    public $is_delivering_pet;

    public $is_home_check_out;

    public $is_at_home;

    public function mount()
    {
        $this->is_veterinarian   = $this->user->infoMaster->is_veterinarian;
        $this->is_delivering_pet = $this->user->infoMaster->is_delivering_pet;
        $this->is_home_check_out = $this->user->infoMaster->is_home_check_out;
        $this->is_at_home        = $this->user->infoMaster->is_at_home;
    }

    public function saveInfo()
    {
        $this->user->infoMaster()->update([
            'is_veterinarian'   => $this->is_veterinarian,
            'is_delivering_pet' => $this->is_delivering_pet,
            'is_home_check_out' => $this->is_home_check_out,
            'is_at_home'        => $this->is_at_home,
        ]);

        session()->flash('success', __('Сохранено!'));
    }

    public function render()
    {
        return view('livewire.page.profile.master.master-profile');
    }

}
