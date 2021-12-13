<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users_to_produce = 6;
        //While it still needs to make more comments
        $production_count = 0;
        while($production_count < $users_to_produce){
            //Make a comment and it's notification
            $produced_user = User::factory()->create();

            $a = new Account;
            $a->username = $produced_user->name;
            $a->user_id = $produced_user->id;
            $a->first_name = $this->faker->firstname();
            $a->last_name = $this->faker->lastname();
            $a->save();
            
            //increase the amount produced count
            $production_count = $production_count + 1;
        }
    }
}
