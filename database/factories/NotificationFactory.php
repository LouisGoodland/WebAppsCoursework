<?php

namespace Database\Factories;

use App\Models\Notification;

use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\Account;

use App\Notifications\NewReplyAdded;

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
        //note, should never be called, only used by the other two functions
        return [
            'notification_text' => $this->faker->realText(),
        ];
    }

    /*
    A method that creates a notification based on the notification object.
    The notification object will have:
        -account_id: The account that created the notifying object
        -notifiable_id: The id of the notifying object
    */
    public function createNotifications($notifiyingObject){
        //Gets a list of all of the accounts that need notifying
        $accounts_to_notify = Friendship::all()
        ->where('account_id_reciever', $notifiyingObject->account_id)->pluck('account_id_sender');

        //for each account that needs notifying
        foreach($accounts_to_notify as $notified_account_id){
            //create a notification, setting the attributes based on the object
            $n = Notification::factory()->create([
            'notifiable_id' => $notifiyingObject->id,
            'notifiable_type' => get_class($notifiyingObject), 
            //The id of the account that will get notified
            'account_id' => $notified_account_id,
            //notification text, encorperates all the assigned attributes into a message
            'notification_text' => "Notification for ".
            Account::where('id', $notified_account_id)->first()->username." 
            caused by: ".get_class($notifiyingObject). " from ".
            Account::where('id', $notifiyingObject->account_id)->first()->username]);

            //$notify = Account::where('id', $notified_account_id)->first();
            //$notify->user->notify(new NewReplyAdded($n));
        }


    }

    public function createCommentNotification($notifiyingObject){
        //Only one notification created, assigns the attributes based on the friend request
        Notification::factory()->create([
            'notifiable_id' => $notifiyingObject->id,
            'notifiable_type' => get_class($notifiyingObject), 
            'account_id' => $notifiyingObject->post->account_id,
            //Notification text encorperates all the assigned attributes into a message
            'notification_text' => "Notification for ".
            $notifiyingObject->post->account->username." 
            caused by: a comment on your post from ".
            $notifiyingObject->account->username]);
    }
    
    

    /*
    A method that creates a notification for specifically a friend request
    A different method was required due to notifying a different account.
    */
    public function createFriendNotification($friendRequest){
        //Only one notification created, assigns the attributes based on the friend request
        Notification::factory()->create([
        'notifiable_id' => $friendRequest->id,
        'notifiable_type' => get_class($friendRequest), 
        'account_id' => $friendRequest->account_id_reciever,
        //Notification text encorperates all the assigned attributes into a message
        'notification_text' => "Notification for ".
        Account::where('id', $friendRequest->account_id_reciever)->first()->username." 
        caused by: a friend request from ".Account::where('id', $friendRequest->account_id_sender)
        ->first()->username]);
    }

    
    /*
    A method that creates a notification for specifically a user post interaction
    A different method was required due to notifying a different account.
    */
    public function createInteractionNotification($interaction){
        //Only one notification created, assigns the attributes based on the friend request
        Notification::factory()->create([
        'notifiable_id' => $interaction->id,
        'notifiable_type' => get_class($interaction), 
        'account_id' => $interaction->post()->first()->account_id,
        //Notification text encorperates all the assigned attributes into a message
        'notification_text' => "Notification for ".
        Account::where('id', $interaction->post()->first()->account_id)->first()->username." 
        caused by: a ".$interaction->type. " from ".
        Account::where('id', $interaction->account_id)->first()->username]);
    }
}
