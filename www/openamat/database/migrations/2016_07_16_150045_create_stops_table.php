<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stops', function (Blueprint $table) {
            $table->increments('id');
			$table->string('stop_id');
			$table->string('stop_code');
			$table->string('stop_name');
			$table->string('stop_desc');
			$table->integer('stop_lat');
			$table->integer('stop_lon');
			$table->integer('zone_id');
			$table->string('stop_url');
			$table->string('location_type');
			$table->string('parent_station');
			$table->string('stop_timezone');
			$table->string('wheelchair_boarding');

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
        Schema::drop('stops');
    }
}
