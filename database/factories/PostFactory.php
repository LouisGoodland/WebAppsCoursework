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

        //produces the random account the post was made from
        $account_id_to_set = Account::all()->random()->id;

        //$this->createNotifications($account_id_to_set);
        
        return [
            'account_id' => Account::all()->random()->id,
            'content' => $this->faker->realText(),
        ];
    }

    public function createNotifications($account_id_to_set)
    {
        //now I go through the friends list to see who needs notifying
        $accounts_to_notify = Friendship::all()
        ->where('account_id_reciever', $account_id_to_set);
        

        foreach($accounts_to_notify as $notified_account){
            //Makes a new notification
            $notification_produced = new Notification;

            //Sets the ID of the account that needs to be notified
            $notification_produced->account_id = $notified_account->id;
            
            //sets the notification ID and type to link to the post
            $notification_produced->notifiable_id = count(Post::all()) + 1;
            $notification_produced->notifiable_type = Post::class;

            //adds random text and saves the message
            $notification_produced->notification_text = $this->faker->realText();
            $notification_produced->save();
        }
    }
}
