<?php

use Illuminate\Database\Seeder;
use App\Greeting;
use App\Writer;

class WriterSeeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		//factory(Writer::class, 20)->create();
		factory(Greeting::class, 20)->create();
    }
}
