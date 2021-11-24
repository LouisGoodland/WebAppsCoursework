<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            //creates the default attributes
            $table->id();
            $table->timestamps();

            //link to user login object
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            //$table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on()
            //Login details attributes
            $table->string('username', 50)->unique();

            //Personal details attributes
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->date('date_of_birth')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
