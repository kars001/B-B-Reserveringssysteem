<?php

namespace App\Actions\Fortify;

use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'min:8',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'license' => ['required', 'string', 'max:255'],
        ])->validate();

        $license = License::where('license_code', $input['license'])->first();
        if (!$license) {
            throw ValidationException::withMessages([
                'license' => 'Ongeldige licentiecode',
            ]);
        }

        $license->delete();

        $user =User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);


        if ($user->id === 1) {
            $user->assignRole('admin', 'medewerker');
        } else {
            $user->assignRole('medewerker');
        }

        return $user;
    }
}
