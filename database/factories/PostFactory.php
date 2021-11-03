<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Account;
use App\Models\Notification;
use App\Models\Friendship;


use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {        
        //Generates a random account and text for the post
        return [
            'account_id' => Account::all()->random()->id,
            'content' => $this->faker->realText(),
        ];
    }
}
