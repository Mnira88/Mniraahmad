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
            $table->id();

            $table->bigInteger('visitor_id')->unsigned()->nullable();
            $table->bigInteger('hospital_id')->unsigned()->nullable();
            $table->string('content')->nullable();
            $table->string('replay')->nullable();
            $table->string('department')->nullable();
            $table->dateTime('traetment_date')->nullable();
            $table->tinyInteger('status')->nullable()->default('0');
            $table->string('result')->nullable()->default('Not Proccessed');
            $table->tinyInteger('is_new')->nullable()->default('1');
            $table->timestamps();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('managers')->onDelete('cascade');
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
