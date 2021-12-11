<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$xezFEBk4hKEqGxNOy1rVtuO1UNJWm84fTou6XSEVRSPQjFGT0Z86W', // password
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),

        ];
    }
}
