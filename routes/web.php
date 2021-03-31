<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
// The most simple way of creating a page
Route::get('/', function () {
    return "HELLO WORLD";
});

// The most simplee way of creating a page with controller
// Controller is defined in App/Http/Controllers And is called HelloWorldController
Route::get('/ControllerHelloWorld', 'HelloWorldController@index');  // index 	is HelloWorldController class method
Route::get('/dbinsert', 'HelloWorldController@dbinsert');			// dbinsert is HelloWorldController class method
//some routes can have variables inside, use them likethis
// take a look at the question amrk, making this an optional parameter
// you need to prividedefault value then if you use question mark
Route::get('user/{id?}', function ($id = "NOT SET") {
	return "The user id in question is ".$id;
})->where('id', '[0-9]+'); // this ->where is not neccecery but it helps validate if id is mathing regular exprestion
//But still better to use it like this, definition can be found in controller - file HelloWorldController.php in controllers
Route::get('user/{id}/friends/controller', 'HelloWorldController@withParameter');

// a simple way to add aprefix so that all the links are in one place
Route::prefix("greating")->group(function (){
// this group will soon be update with middleware  like auth
//Route::prefix("greating")->middleware('auth')->group(function (){	
	
	// this link is now greating/hello
	Route::get('hello', function (){
		return "hello";
	});
	// this link is now greating/world
	Route::get('world', function (){
		return "world";
	});
});


// Here we will demonstrate signed link
// We first create regular link that NEEDS to have a name
Route::get('invitation/{invitation}/{answer}', 'HelloWorldController@invitation')
	->name('invitations')
	->middleware('signed');
// now this page above can only be accessed using created link in the link below. Consult documentation on signed links	
	
	
// this page will display the links
Route::get('invitation/showLinks', 'HelloWorldController@showInvitationLinks');


//if you want you can share variable between all the views

view()->share('sharedVar', 'sharedVarValue');

// demonstrate view
Route::get('/view-example', function(){
	//return view('home');
	return view('home')->with('myVar', 'MyVarValue');
});
// this controller was made using php artisan command
// php artisan make:controller ArtisanController
// you can put it inside some folder then yiou can type
// php artisan make:controller ArtisanController
Route::get('/artisan-controller-index', 'ArtisanController@index');
// lets work on a form - this mehod of artisan controller will return a viw that has a form on it
Route::get('/form-create', 'ArtisanController@create')->name('form-create');
// thuis method holds code for storin the submited data from above
Route::post('/form-store', 'ArtisanController@store')->name('form-store'); //-> instead of GET we use POST 

// We have create on resource controller by typoing artisan make:controller ResourceController --resource
// i have named it Resource controller but you can name him whatever MasterController --resource
Route::resource('resource', 'ResourceController');
// after this line is saved type artisan routes:list and you will understand all


// This page here will be used to extend parent view that is used inside ArtisanController@create
Route::get('/form-create-child-template', 'ArtisanController@childTemplate')->name('child-template');


// lets learn about eloquent, mak one page that holds several forms
Route::get('/writer-control', 'WriterController@index')->name('writer-control');
Route::post('/writer-store', 'WriterController@store')->name('writer-store');


Route::get('/form-example', 'FormExample@index')->name('form-example'); 
Route::post('/form-example-post', 'FormExample@post')->name('form-example-post'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//page to have access without authentification
Route::get('/login-test-home', 'AuthenticatedExampler@index')->name('login-test-home');
//page to be accessed only if you are authentificated
Route::get('/login-test-authenticated', 'AuthenticatedExampler@authenticated')->name('login-test-authenticated');

// to have all the routes for order with just one link
Route::resource('order', 'OrderController');

Route::resource('user-control', 'UserController');

// OK here we will create 2 page that can be accessed only by admin

Route::middleware('can:manage-users')->group(function (){
	Route::get('only-edit-users', 'UserController@special');
	Route::get('only-edit-users2', 'UserController@special');
});

Route::get('/apitest', function(){
	return view('apitest');
});