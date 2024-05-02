<?php

namespace App\Livewire\Page\Auth;

use App\Domain\Enum\AccountType;
use Livewire\Component;

class RegisterPage extends Component
{

    public $accountType;

    public function mount()
    {
        $this->accountType = AccountType::Client->value;
    }

    public function render()
    {
        $accountTypes = AccountType::cases();

        $saloonType = AccountType::Saloon->value;

        return view('livewire.page.auth.register-page',
            compact('accountTypes', 'saloonType'));
    }

}
