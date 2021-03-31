<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Masters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
		Schema::create('masters', function (Blueprint $table){
			$table->increments('id');		// this is primary key and autoincrement and unsigned
			$table->string('name', 64)->unique();
			$table->boolean('alignment')->default(true)->index();
			$table->decimal('power', 5,2);	// like this 999,99
			$table->double('height', 6,2);	// like this 9999,99
			$table->datetime('becomeFameous')->nullable();
		});
		// lets update alrady existing table
		Schema::table('greetings', function (Blueprint $table){
			$table->string('header', 512);
			$table->string('body', 1024)->change();
		});
		*/
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('masters');
    }
}
