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
        $CommentLimit = 2;
        $count = 0;
        while($count < $CommentLimit){
            $randomComments = Comment::factory()->create();
            Notification::factory()->createNotifications($randomComments);
            $count = $count + 1;
        }
    }
}
