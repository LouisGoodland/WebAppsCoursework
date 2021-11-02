<?php

namespace Database\Seeders;
use App\Models\Friendship;
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
        $friendLimit = 9;
        $count = 0;
        while($count < $friendLimit){
            $friendship = Friendship::factory()->create();
            $count = $count + 1;
        }
    }
}
