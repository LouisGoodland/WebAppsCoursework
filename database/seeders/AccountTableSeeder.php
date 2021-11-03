<?php

namespace Database\Seeders;
use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creates 3 random accounts
        $users = Account::factory()->count(3)->create();
    }
}
