<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesProfileProfileInformation;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\Profile;
use App\Models\User;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $todayDate = date('Y-m-d');

        Validator::make($input, [
            'name' => ['required', 'alpha', 'max:255'],
            'surname' => ['required', 'alpha', 'max:255'],
            'username' => ['required', 'string', 'max:50'],
            'email' => [
                'required', 'email', 'email:rfc,dns',
                Rule::unique('users')->ignore($user->id)
            ],
            'date_of_birth' => ['required' ,'date_format:Y-m-d', 'after_or_equal:1920-01-01','before_or_equal:'.$todayDate ],
            'country' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:250'],
            'phone' => ['nullable', 'numeric', 'digits:9'],
            'gender' => ['required'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'headerPhoto' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        Profile::where('user_id', auth()->user()->id)->update([
            'name' => $user->name,
            'surname' => $user->surname,
            'username' => $user->username,
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'country' => $input['country'],
            'bio' => $input['bio'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
        ]);

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['headerPhoto'])) {
            $user->updateProfileHeaderPhoto($input['headerPhoto']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'surname' => $input['surname'],
                'username' => $input['username'],
                'email' => $input['email'],
                'date_of_birth' => $input['date_of_birth'],
                'address' => $input['address'],
                'country' => $input['country'],
                'bio' => $input['bio'],
                'phone' => $input['phone'],
                'gender' => $input['gender'],
            ])->save();

           
        }
    }


    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
