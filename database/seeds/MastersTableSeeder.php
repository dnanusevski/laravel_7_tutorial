<?php

use Illuminate\Database\Seeder;
use App\Greeting;

class MastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
		DB::table('masters')->insert([
			'name' => 'superman',
			'alignment' => true,
			'power' => 45.2,
			'height' => 125.22,	
			'becomeFameous' => "2014-01-01 11:11:11",	
		]);
		*/
		//factory(Greeting::class, 20)->create();
    }
}
