<?php

namespace App\Livewire\Page\Auth;

use App\Domain\Enum\AccountType;
use App\Repositories\UserRepository;
use Livewire\Component;

class RegisterPage extends Component
{

    public $accountType;

    /** @var \App\Models\User|null */
    public $ref;

    public function mount()
    {
        $ref_uuid       = request()->input('ref_uuid');
        $userRepository = app(UserRepository::class);

        if ($ref_uuid !== null) {
            $this->ref = $userRepository->getUserByUuid(
                $ref_uuid
            );
        }

        $this->accountType = old('account_type', AccountType::Client->value);

        if ($this->ref !== null) {
            $this->accountType = AccountType::Master->value;
        }
    }

    public function render()
    {
        $accountTypes = AccountType::cases();

        $saloonType = AccountType::Saloon->value;

        return view('livewire.page.auth.register-page',
            compact('accountTypes', 'saloonType'));
    }

}
