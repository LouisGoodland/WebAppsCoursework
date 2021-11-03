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
        $maximum_possible_friends = count(Account::all()) * count(Account::all());
        $friendLimit = 11;
        $count = 0;
        while($count < $friendLimit){
            if(count(Friendship::all())<$maximum_possible_friends){
                $friendship = Friendship::factory()->create();
                Notification::factory()->createFriendNotification($friendship);
                $count = $count + 1;
            } else {
                print_r("exceeded max friend count");
                $count = $count + 1;
            }
        }
    }
}
