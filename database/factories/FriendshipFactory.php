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
        //Gets a list of all accounts that will be checked for friend requests
        $valid_friend_sender_list = Account::all();

        $found_valid_friend = false;

        //while it hasn't found a friend
        while($found_valid_friend != true){

            //picks a random account to send a friend request
            $friend_sender_id = $valid_friend_sender_list->random()->id;
            
            //Gets a list of invalid accounts 
            $invalid_friend_reciever_list = Friendship::all()
            ->where('account_id_sender', $friend_sender_id)->pluck('account_id_reciever');

            //gets a list of all users to be valid users to add friends to
            $valid_friend_reciever_list = Account::all()
            ->whereNotIn('id', $invalid_friend_reciever_list)->pluck('id');
            
            //pick a friend from the valid friend list if a valid friend exists
            if(count($valid_friend_reciever_list) > 0){
                $friend_reciever_id = $this->faker->randomElement($valid_friend_reciever_list);
                $found_valid_friend = true;
            }
        }

        //returns the valid friendship
        return [
            'account_id_sender' => $friend_sender_id,
            'account_id_reciever' => $friend_reciever_id,
        ];
    }
}
