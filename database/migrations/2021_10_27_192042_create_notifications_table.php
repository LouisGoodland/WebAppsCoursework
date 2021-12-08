<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            //default attributes
            $table->id();
            $table->timestamps();

            //foreign key to linked account
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')
                ->onDelete('cascade')->onUpdate('cascade');
            
            //morph attributes for objects that can notify
            $table->morphs('notifiable');
            //text of the notification
            $table->string('notification_text');

            $table->boolean("has_been_read")->default(false);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
