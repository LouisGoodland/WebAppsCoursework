<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Accounts must come first
        $this->call(AccountTableSeeder::class);
        $this->call(FriendshipTableSeeder::class);
        $this->call(PostTableSeeder::class);
        //Comments must be made after posts
        $this->call(CommentTableSeeder::class);
    }
}
