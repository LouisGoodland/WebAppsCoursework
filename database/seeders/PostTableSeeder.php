<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Friendship;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PostLimit = 2;
        $count = 0;
        while($count < $PostLimit){
            $post = Post::factory()->create();
            Notification::factory()->createNotifications($post);
            $count = $count + 1;
        }
    }
}
