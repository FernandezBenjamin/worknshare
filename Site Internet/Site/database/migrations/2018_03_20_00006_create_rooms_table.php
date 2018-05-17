<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_name')->unique();
            $table->text('description');
            $table->string('short_name',40)->unique();
            $table->timestamps();
        });



        Schema::create('rooms_reservations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('user_id',false);
            $table->unsignedInteger('rooms_id',false);
            $table->unsignedInteger('sites_id',false);
            $table->boolean('canceled');
            $table->date('date_reserved');
            $table->time('hour_reserved');
            $table->rememberToken();
            $table->timestamps();
            $table->primary(['user_id','sites_id','date_reserved']);
        });

        Schema::table('rooms_reservations', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rooms_id')->references('id')->on('rooms');
            $table->foreign('sites_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('rooms_reservations');
    }
}
