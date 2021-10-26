<?php

namespace Database\Seeders;
use App\Models\Comment;
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
        $test = new Comment;
        $test->account_id = 1;
        $test->post_id = 1;
        $test->content = "this is the first comment!";
    }
}
