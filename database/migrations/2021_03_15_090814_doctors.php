<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Doctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table){
			$table->increments('id');		// this is primary key and autoincrement and unsigned
			$table->string('first_name', 128);
			$table->string('last_name', 128);
			$table->string('localization', 128);
			$table->string('status', 128);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('doctors');
		
    }
}
