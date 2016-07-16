<?php

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
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
			$table->string('service_id');
			$table->string('monday');
			$table->string('tuesday');
			$table->string('wednesday');
			$table->string('thursday');
			$table->string('friday');
			$table->string('saturday');
			$table->string('sunday');
			$table->date('start_date');
			$table->date('end_date');

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
        Schema::drop('services');
    }
}
