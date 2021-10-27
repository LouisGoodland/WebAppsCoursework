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
        $friendships = Friendship::factory()->count(100)->create();
        //$friendships = Friendship::get()->where('account_id_sender', '>', 7);
    }
}
