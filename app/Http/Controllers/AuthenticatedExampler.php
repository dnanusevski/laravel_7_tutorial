<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedExampler extends Controller
{
    //
	public function index(){
		echo '<h2>HELLO TO ALL THAT HAVE ENTERED HERE</h2>';
		echo '<br />';
		
		if(auth()->check()){
			echo '<h4>USER IS AUTHENTICATED</h4>';
			$user = auth()->user(); 
			var_dump($user);
		}
		
		if(auth()->guest()){
			echo '<h4>USER IS JUST A GUEST</h4>';
		}
	}
}
