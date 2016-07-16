<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('shape_id');
			$table->integer('shape_pt_lat');
			$table->integer('shape_pt_lon');
			$table->integer('shape_pt_sequence');
			$table->integer('shape_dist_traveled');

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
        Schema::drop('shapes');
    }
}
