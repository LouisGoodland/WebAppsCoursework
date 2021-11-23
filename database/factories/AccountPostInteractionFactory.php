<?php

namespace Database\Factories;

use App\Models\AccountPostInteraction;

use App\Models\Post;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountPostInteractionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountPostInteraction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //random account and random post id and random type enum
        return [
            'post_id' => Post::all()->random()->id,
            'account_id' => Account::all()->random()->id,
            'type' => $this->faker->randomElement(['like', 'dislike', 'view']),
        ];
    }
}
