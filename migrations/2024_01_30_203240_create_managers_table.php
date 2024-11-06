<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('hospital')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('code')->nullable();
            $table->tinyInteger('status')->nullable()->default('0');
            $table->string('password');
            $table->tinyInteger('role_id')->default('2');

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
        Schema::dropIfExists('managers');
    }
}
