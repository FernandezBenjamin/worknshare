<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_sites', function (Blueprint $table) {
            $table->integer('sites_id',false,true);
            $table->integer('rooms_id',false,true);
            $table->integer('quantity',false,true);
            $table->timestamps();
            $table->primary(['sites_id','rooms_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_sites');
    }
}
