<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Illuminate\Support\Arr;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['Hombre', 'Mujer', 'No binario'];
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'is_admin' => 0,
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'bio' => $this->faker->text($maxNbChars = 100),
            'country' => $this->faker->country(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => Arr::random($gender),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
