<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\Notification;
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
        //Creates two posts
        $amount_of_posts_to_produce = 5;
        //While it still needs to make more posts
        $production_count = 0;
        while($production_count < $amount_of_posts_to_produce){
            //make a post and its notification
            $post = Post::factory()->create();
            Notification::factory()->createNotifications($post);
            //increase the produced count
            $production_count = $production_count + 1;
        }
    }
}
