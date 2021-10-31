<?php

namespace Database\Seeders;
use App\Models\Notification;
use App\Models\Account;
use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = Notification::factory()->count(10)->create();
    }
}
