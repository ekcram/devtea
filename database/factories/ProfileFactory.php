<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;


class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

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
            'gender' => Arr::random($gender),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'bio' => $this->faker->text($maxNbChars = 100),
            'country' => $this->faker->country(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }

}
