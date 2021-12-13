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
            //
        ];
    }

    public function makeAccount($user)
    {
        
        Account::factory()->create([
            'username' => $user->name,
            'first_name' => $this->faker->firstname(), 
            'last_name' => $this->faker->lastname(), 
            'user_id' => $user->id,
            'date_of_birth' => $this->faker->date(),
            'image_path' => "A4qTBrNH841AsYsTNFX8rTUnP88lEWGL37pvgvFp.png",
        ]);
    }
}
