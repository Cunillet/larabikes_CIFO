<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'display_name' => ['nullable', 'string', 'max:32'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            'birth_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:16'],
            'city' => ['nullable', 'string', 'max:256'],
            ],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'display_name' => $input['display_name'],
                'name' => $input['name'],
                'email' => $input['email'],
                'birth_date' => $input['birth_date'],
                'phone' => $input['phone'],
                'city' => $input['city'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'display_name' => $input['display_name'],
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'birth_date' => $input['birth_date'],
            'phone' => $input['phone'],
            'city' => $input['city'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
