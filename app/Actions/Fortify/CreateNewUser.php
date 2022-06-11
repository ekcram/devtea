<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profile;
use App\Models\Subscription;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $todayDate = date('Y-m-d');

        Validator::make($input, [
            'name' => ['required', 'alpha', 'max:100'],
            'surname' => ['required', 'alpha', 'max:200'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'email:rfc,dns', 'unique:users'],
            'password' => $this->passwordRules(),
            'gender' => ['required'],
            'date_of_birth' => ['date_format:Y-m-d', 'after_or_equal:1920-01-01','before_or_equal:'.$todayDate],
            'country' => ['string'],
            'bio' => ['text'],
            'address' => ['string', 'max:250'],
            'phone' => ['nullable', 'numeric', 'digits:9'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'username' => $input['username'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'date_of_birth' => null,
            'country' => null,
            'bio' => null,
            'address' => null,
            'phone' => null,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'username' => $user->username,
            'date_of_birth' => null,
            'country' => null,
            'bio' => null,
            'address' => null,
            'phone' => null,
            'gender' => $input['gender']
        ]);

        $subscription = Subscription::create([
                'name' => 'DevTea Premium',
                'type' => 'monthly',
                'user_id' => $user->id,
                'payment_id' => null,
                'status' => 'no-active'
        ]);
       
        return $user;
    }
}
