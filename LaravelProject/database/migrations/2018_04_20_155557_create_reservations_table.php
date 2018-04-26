<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_reservations', function (Blueprint $table) {
            $table->integer('user_id',false,true);
            $table->integer('rooms_id',false,true);
            $table->integer('sites_id',false,true);
            $table->boolean('canceled');
            $table->date('date_reserve');
            $table->timestamps();
            $table->primary(['user_id','sites_id','date_reserve']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_reservations');
    }
}
