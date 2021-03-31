<?php
namespace App\Http\Controllers;

// required in order to type it shortly so that laravel knows we are using eloquent
// from folder App, controller Greeting Eloquent db Model
Use App\Greeting;
// in order to use URL class we need this namespace in use
use Illuminate\Support\Facades\URL;

class HelloWorldController extends Controller{
	public function index(){
		// eddited file services inside config/services.php
		echo config('services.personalData.secretData').'<br />';
	
		// eddited file /.env
		echo env('MY_OWN_DISTINCT_VAR').'<br />';
		// the right way to access env vars is using services array to put it in there
		echo config('services.personalData.myENV').'<br />';
		
		
		return "Controller Hello World";
	}
	
	// for routes we generate new page
	public function dbinsert(){
		$greeting = new Greeting;		// we need to have table greetings
		$greeting->body = "Hello";		// greetings table needs to have body column
		$greeting->save();				// insert to db
		return "We have successful insert";
	}
	// some routes can have parameters, and you use them like this
	public function withParameter($id){
		return "The user id in question is ".$id.' And this is returned from controller';
	}
	
	// this page will be used togenerate links to demonstrate signed route
	public function showInvitationLinks(){
		$returnString = '';
		// generating regular link route
		$urlRegular = URL::route('invitations', ['invitation'=>1234, 'answer']);
		
		$returnString .= 'REGULAR LINK <br />';
		
		$returnString .= $urlRegular;
		
		// generating a signed RouteLink
		$urlRegular = URL::signedRoute('invitations', ['invitation'=>1234, 'answer']);
		
		$returnString .= '<br /> SIGNED LINK <br />';
		
		$returnString .= $urlRegular;
		
		$urlRegular = URL::temporarySignedRoute('invitations', now()->addHours(4), ['invitation'=>1234, 'answer']);
		
		$returnString .= '<br /> Temporary signed route <br />';
		
		$returnString .= $urlRegular;
		
		return 	$returnString;
	}
	
	public function invitation(){
		return 'Invitation link';
	}
	
}