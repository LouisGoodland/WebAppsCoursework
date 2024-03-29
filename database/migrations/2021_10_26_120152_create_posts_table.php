<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //default table attributes
            $table->id();
            $table->timestamps();

            //foreign key to linked account
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')
                ->onDelete('cascade')->onUpdate('cascade');

            //Content
            $table->string('image_path')->nullable();
            $table->string('content')->nullable();

            //Attributes
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
