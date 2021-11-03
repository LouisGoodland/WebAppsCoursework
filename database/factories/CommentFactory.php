<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Account;
use App\Models\Post;


use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //picks a random post, commented by a random user and with random text added
            'post_id' => Post::all()->random()->id,
            'account_id' => Account::all()->random()->id,
            'content' => $this->faker->realText(),
        ];
    }
}
