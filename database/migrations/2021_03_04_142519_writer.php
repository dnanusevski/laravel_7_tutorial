<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Writer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writers', function (Blueprint $table){
			$table->increments('id');		// this is primary key and autoincrement and unsigned
			$table->string('name', 64)->unique();
			$table->timestamp('created_at')->useCurrent = true;
			$table->timestamp('updated_at')->useCurrent = true;
		});
		// lets update alrady existing table
		Schema::table('greetings', function (Blueprint $table){
			$table->unsignedInteger('writer_id');
			$table->foreign('writer_id')->references('id')->on('writers');
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('writers');
		
    }
}
