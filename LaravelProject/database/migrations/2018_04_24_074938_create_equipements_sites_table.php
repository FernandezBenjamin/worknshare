<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementsSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipements_sites', function (Blueprint $table) {
            $table->integer('sites_id',false,false);
            $table->integer('equipements_id',false,false);
            $table->integer('quantity',false,true);
            $table->timestamps();
            $table->primary(['sites_id','equipements_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipements_sites');
    }
}
