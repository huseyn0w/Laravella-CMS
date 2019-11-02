<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('status');
            $table->mediumText('content')->nullable();
            $table->mediumText('custom_fields')->json()->nullable();
            $table->string('template')->default('page');
            $table->string('meta_description');
            $table->string('meta_keywords');
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
        Schema::dropIfExists('pages');
    }
}
