<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('status');
            $table->integer('likes')->unsigned()->default(0);
            $table->integer('dislikes')->unsigned()->default(0);
            $table->mediumText('preview')->nullable();
            $table->mediumText('content')->nullable();
            $table->string('template')->default('standart');
            $table->mediumText('custom_fields')->json()->nullable();
            $table->softDeletes();
            $table->timestamps();
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
