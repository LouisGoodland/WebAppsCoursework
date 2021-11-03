<?php

namespace Database\Seeders;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates 2 comments
        $amount_of_comments_to_produce = 2;
        //While it still needs to make more comments
        $production_count = 0;
        while($production_count < $amount_of_comments_to_produce){
            //Make a comment and it's notification
            $produced_comment = Comment::factory()->create();
            Notification::factory()->createNotifications($produced_comment);
            //increase the amount produced count
            $production_count = $production_count + 1;
        }
    }
}
