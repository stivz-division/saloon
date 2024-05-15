<?php

namespace App\Actions\Fortify;

use App\Domain\Enum\AccountType;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{

    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name'         => ['required', 'string', 'max:255'],
            'surname'      => ['sometimes', 'string', 'max:255'],
            'account_type' => ['required', Rule::enum(AccountType::class)],
            'email'        => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'ref_uuid'     => 'nullable|exists:users,uuid',
            'password'     => $this->passwordRules(),
        ])->validate();

        $ref = null;

        if (isset($input['ref_uuid'])) {
            $userRepository = app(UserRepository::class);

            $ref = $userRepository->getUserByUuid($input['ref_uuid']);
        }

        return User::create([
            'account_type' => $input['account_type'],
            'name'         => $input['name'],
            'surname'      => isset($input['surname']) ? $input['surname']
                : null,
            'email'        => $input['email'],
            'ref_id'       => $ref?->id,
            'password'     => Hash::make($input['password']),
        ]);
    }

}
