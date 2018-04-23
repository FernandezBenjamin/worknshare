<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_sites', function (Blueprint $table) {
            $table->unsignedInteger('sites_id',false);
            $table->unsignedInteger('services_id',false);
            $table->boolean('contains');
            $table->timestamps();
            $table->primary(['sites_id','services_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_sites');
    }
}
