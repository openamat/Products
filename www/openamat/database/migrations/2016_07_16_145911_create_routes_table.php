<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('route_id');
			$table->integer('agency_id');
			$table->string('route_short_name');
			$table->string('route_long_name');
			$table->string('route_desc');
			$table->string('route_type');
			$table->string('route_url');
			$table->string('route_color');
			$table->string('route_text_color');

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
        Schema::drop('routes');
    }
}
