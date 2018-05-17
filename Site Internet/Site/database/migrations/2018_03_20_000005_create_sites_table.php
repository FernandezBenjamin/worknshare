<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city',60);
            $table->text('hours');
            $table->string('filename',255);
            $table->timestamps();
        });

        Schema::create('equipements_sites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('sites_id',false);
            $table->unsignedInteger('equipements_id',false);
            $table->unsignedInteger('quantity',false);
            $table->timestamps();
        });

        Schema::table('equipements_sites', function(Blueprint $table) {
            $table->foreign('sites_id')->references('id')->on('sites');
            $table->foreign('equipements_id')->references('id')->on('equipements');
            $table->primary(['sites_id','equipements_id']);

        });


        Schema::create('services_sites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('sites_id',false);
            $table->unsignedInteger('services_id',false);
            $table->boolean('contains');
            $table->timestamps();
            $table->primary(['sites_id','services_id']);
        });

        Schema::table('services_sites', function($table) {
            $table->foreign('sites_id')->references('id')->on('sites');
            $table->foreign('services_id')->references('id')->on('services');
        });


        Schema::create('rooms_sites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('sites_id',false);
            $table->unsignedInteger('rooms_id',false);
            $table->integer('quantity',false,true);
            $table->timestamps();
            $table->primary(['sites_id','rooms_id']);
        });

        Schema::table('rooms_sites', function($table) {
            $table->foreign('sites_id')->references('id')->on('sites');
            $table->foreign('rooms_id')->references('id')->on('rooms');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
        Schema::dropIfExists('equipements_sites');
        Schema::dropIfExists('services_sites');
        Schema::dropIfExists('rooms_sites');

    }
}
