<?php

namespace Database\Seeders;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\Account;
use Illuminate\Database\Seeder;

class FriendshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Gets a list of the maximum amount of possible friend combinations
        $maximum_possible_friends = count(Account::all()) * count(Account::all());
        //Tries to create 11 friends
        $amount_of_friends_to_produce = 11;
        //whilst it has friends to produce
        $production_count = 0;
        while($production_count < $amount_of_friends_to_produce){

            //if the amount of friends doesn't pass the maximum possible friends
            if(count(Friendship::all())<$maximum_possible_friends){

                //produce a friend and its notification
                $friendship = Friendship::factory()->create();
                Notification::factory()->createFriendNotification($friendship);
                //increase the produced count
                $production_count = $production_count + 1;

            //if the max amount of friends has already been made
            } else {
                //alert the user and continue counting (to not get stuck)
                print_r("exceeded max friend count");
                $production_count = $production_count + 1;
            }
        }
    }
}
