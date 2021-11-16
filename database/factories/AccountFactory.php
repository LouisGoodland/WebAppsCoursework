<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //makes a fake user name and password
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'first_name' => $this->faker->name(),
        ];
    }
}
