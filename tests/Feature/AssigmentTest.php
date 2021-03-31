<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

	public function testGreeting(){
       $this->post('/', ['body'=> 'my my my'])
    }
	
}
