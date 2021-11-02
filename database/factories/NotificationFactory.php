<?php

namespace Database\Factories;

use App\Models\Notification;

use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $noteableList = [
            Comment::class,
            Friendship::class,
            Post::class,
        ];
        $notable = $this->faker->randomElement($noteableList);

        /*
        if($notable == Comment::class){
            $notableId = Comment::all()->random()->id;
        } elseif($notable == Friendship::class){
            $notableId = Friendship::all()->random()->id;
        } else {
            $notableId = Post::all()->random()->id;
        }
        */

        return [
            'account_id' => 'overriden',
            'notifiable_id' => $notableId,
            'notifiable_type' => $notable,
            'notification_text' => $this->faker->realText(),
        ];
    }
}
