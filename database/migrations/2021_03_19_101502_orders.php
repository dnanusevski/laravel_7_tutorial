<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('orders', function (Blueprint $table){
			$table->increments('id');		// this is primary key and autoincrement and unsigned
			$table->unsignedInteger('user_id');
			$table->string('from', 128);
			$table->string('to', 128);
			$table->timestamp('created_at')->useCurrent = true;
			$table->timestamp('updated_at')->useCurrent = true;
			$table->foreign('user_id')->references('id')->on('writers');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('orders');
    }
}
