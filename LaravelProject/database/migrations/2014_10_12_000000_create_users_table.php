<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pwd');
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_ban')->default(false);
            $table->text('ban_reasons')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
