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
        //note, should never be called
        return [
            'notification_text' => $this->faker->realText(),
        ];
    }

    public function createNotifications($notifiyingObject){
        $accounts_to_notify = Friendship::all()
        ->where('account_id_reciever', $notifiyingObject->account_id)->pluck('account_id_sender');

        //all notifiying objects will have account_id, notfiable_id and notifiable_type

        foreach($accounts_to_notify as $notified_account_id){
            Notification::factory()->create([
            'notifiable_id' => $notifiyingObject->id,
            'notifiable_type' => get_class($notifiyingObject), 
            'account_id' => $notified_account_id,
            'notification_text' => "Notification for ".$notified_account_id." 
            caused by: ".get_class($notifiyingObject). " from ".$notifiyingObject->account_id]);
        }
    }

    public function createFriendNotification($friendRequest){
        Notification::factory()->create([
        'notifiable_id' => $friendRequest->id,
        'notifiable_type' => get_class($friendRequest), 
        'account_id' => $friendRequest->account_id_reciever,
        'notification_text' => "Notification for ".$friendRequest->account_id_reciever." 
        caused by: a friend request from ".$friendRequest->account_id_sender]);
    }
}
