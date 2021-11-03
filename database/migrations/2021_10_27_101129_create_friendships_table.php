<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendships', function (Blueprint $table) {
            //default attributes
            $table->id();
            $table->timestamps();
            
            //foreign key of account who initiated friendship
            $table->unsignedBigInteger('account_id_sender');
            $table->foreign('account_id_sender')->references('id')->on('accounts')
                ->onDelete('cascade')->onUpdate('cascade');

            //foreign key of account who initiated friendship
            $table->unsignedBigInteger('account_id_reciever');
            $table->foreign('account_id_reciever')->references('id')->on('accounts')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendships');
    }
}
