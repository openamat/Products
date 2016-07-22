<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarerulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farerules', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('fare_id');
			$table->integer('route_id');
			$table->integer('origin_id');
			$table->integer('destination_id');
			$table->integer('contains_id');

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
        Schema::drop('farerules');
    }
}
