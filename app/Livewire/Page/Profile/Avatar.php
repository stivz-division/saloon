<?php

namespace App\Livewire\Page\Profile;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{

    use WithFileUploads;

    #[Locked]
    public User $user;

    public $avatar;

    public $accessExtensions
        = [
            'jpg',
            'jpeg',
            'png',
            'gif',
        ];

    public function rules()
    {
        return [
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:100000',
        ];
    }

    public function updateAvatar()
    {
        $this->validate();

        if ($this->avatar) {
            $this->user->avatar_path = $this->avatar->store('/', 'public');
        }

        $this->user->save();

        session()->flash('success', __('Аватар изменен'));
    }

    public function render()
    {
        return view('livewire.page.profile.avatar');
    }

}
