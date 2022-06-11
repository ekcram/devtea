<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoubtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $doubt = $this->faker->sentence();
        return [
            'name' => $doubt,
            'slug' => Str::of($doubt)->slug('-'),
            'user_id' => 5,
            'is_resolved' => false,
        ];
    }
}
