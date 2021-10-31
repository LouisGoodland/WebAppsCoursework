<?php

namespace Database\Factories;

use App\Models\Friendship;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Friendship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'account_id_sender' => Account::all()->random()->id,
            'account_id_reciever' => Account::all()->random()->id,
        ];
    }
}
