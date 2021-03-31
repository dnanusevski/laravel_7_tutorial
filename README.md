* before installing you need to have compozer ready

run command in cmd

	:composer create-project laravel/laravel:^7.0 larabit
		

** INSTALATION
This will install laravel in the newly created or empty folder larabit version will bi latest 7.*

Now we need to connect to git link

// THIS WORKS ON GIT HUB

	:git init
	:git add .
	:git commit -m "first commit"
	:git remote add origin https://dnanusevski@bitbucket.org/dnanusevski/larabit.git
	:git push origin master

// ON BIT BUCKET IT IS DIFERENT
		
First create project in bit - bucket run this command
	
	:git clone https://dnanusevski@bitbucket.org/dnanusevski/larabit.git
	:git add .
	:git commit -m "first commit"
	:git push origin master
	
Now delete gitignore and md file, paste freshly installed laravel or install it inside

	:git add .
	:git commit -m "first commit"
	:git push origin master
	
Now all is the same as with git hub now just set up xampp virtual host and 
point it to public folder - if you are on windows
__________________________________________________________________________________________________
** INTRODUCTION TO SIMLPE WORLD OF LARAVEL



!!! IMPORTANT NOTE !!! 
WHAT IS LARAVEL FACADE  ?
Laravel facade translates static calls to noral class calls meaning:
	
	+ Logger::log('INTERESTING');
	
Same as 
	
	$loger = new Logger();
	$loger->log('INTERESTING');
	
	

How to make a simple page ? In laravel go to file

 - routes/web.php

This is the file holding adresses of the site similar to drupal module file that holds adresses. 
Just add the line below and there you have it

//Folder routes/web
	+ Route::get('/', function () {
	+ 	return "Simple Hello World";
	+ });

On the main page (index) you will see Simple hello world

This is simple example, but we usualy have controlers to to things. 
Controllers are the one that usualy serve content via their methods
Go to folder 

//Folder App/Http/Controllers
 
Create file HelloWorldController.php and put followig code inside. The code tells us that class is in namespace Controllers
This is crutial in the controller since laravel will not know how to import it.

//Folder App/Http/Controllers/HelloWorldController.php
	
	+ namespace App\Http\Controllers;

	+ class HelloWorldController extends Controller{
	+ 	public function index(){
	+ 		return "Controller Hello World";
	+ 	}
	+ }
	
	

Now inside routes we can use something like this

	+ Route::get('/ControllerHelloWorld', 'HelloWorldController@index');
	
Now we will create a simple database insert. In order to do that we need something called Eloguent Model for database
It will be explaned a bit more later. In order to insert something in database laravel needs its eloquent model class. 
Lets create one called Greeting.php and store it in eloquent model folder
 
//Folder app/
 
Inside we will put following code
!It is important to know that greetings (mind the S at the end) has to be table in database

//Folder App/Greeting.php

	+ namespace App;							//! important
	
	+ Use Illuminate\Database\Eloguent\Model;
	+ Class Greeting extends Model{
	+ 	//
	+ }

Inside routes we will put new Route that is doing simple insert. 

//Folder routes/web.php

	+ Route::get('/ControllerHelloWorld', 'HelloWorldController@dbinsert');


Inside Controller folder we will update our already created controller HelloWorldController to have one more function "dbinsert"
!Important note 'HelloWorldController@dbinsert' is a PHP closure -> laravle will run Class method dbinsert -> Closures are 
Similar to anomynus functions meaning function can be varaible passed around. Might have seen it in js before a lot of times

//Folder App/Http/Controllers/HelloWorldController.php

	+ Use App\Greeting;							//! important
	
	+ public function dbinsert(){
	+ 	$greeting = new Greeting;
	+ 	$greeting->body = "Hello World";
	+ 	$greeting->save();
	+ 	return "New Insert";
	+ }
	
Use App\Greeting helps us use Greeting class the way we have (shorten its name).
!It is important to know that greetings table in database has to have "body","created_at", "updated_at" column and preferably autoincrement id
Code above will insert Hello world to body column in table greetings

Lets sum up

1. To create a page go to  
	//Folder routes/web.php
2. To create controller that controles what is shown on the page above
	//Folder App/Http/Controllers/HelloWorldController.php	
3. To create a class that controles database go to
	//Folder App/Greeting.php
	
In our example i have created my own database table -> Also i have changed .env file to corresopnd to my database setting
but soon you will learn about migrations and how they create tables for you

__________________________________________________________________________________________________

** STRUCTURE OF LARAVEL
	
There are other folders that we will learn on the way but lest just rewiew them now

- App 			-> holds models/ controllers, commands, and php domain code
- bootstrap 	-> larael framework to be bootstraped from here
- config		-> configurations ofcourse
- database 		-> migrations, seeds, factories
- public		-> whre index.php
- resources		-> for like js/js framework and css
- routes		-> where project links are and views langfuage files and so on
- storage		-> cashes, logs combiled system files
- tests			-> unit and integration tests 
- vendor		-> composer dependencies and git ignored etc etc

We also have some loose files in main directorium. Tho moes important is 
.env and .env.example 				-> database instructions and mail passwords etc..
.gitignore							-> ignore some files from commit
.composer.json and composer.lock
.artisan							-> allows commands php artisan

There are some others also but lest skip it :).

We can make our on configurations in order to acces it. 
It is something like SUPERGLOBA to be accased anyware (Similar to DEFINE ina some main settings file)

Modify file inside return statement
// Folder config/services.php


	
	+ 'personalData' => [
	+ 	'secretData' => 'MyOwnPass'
	+ ],


You can later access it using

	+ config('services.sparkpost.secret')

We can demonstrate it in the file
//Folder App/Http/Controllers/HelloWorldController.php
	+ public function index(){
	++	echo config('services.personalData.secretData');
	+ 	return "Controller Hello World";
	+ }

But if you have a variable that is diferent for diferent variables you should put it in env file
Lets add our on variable in there
//.env

	+ MY_OWN_DISTINCT_VAR = HelloFromENVfile
	
Now we can access it using

	+ env('MY_OWN_DISTINCT_VAR')
	
We will demonstrate it the same way as with services above	
Althou thios is not recomended, the best way is to put env variable in services, so that it looks cool for some reason

Inside env file there are some important things to know about

APP_KEY		String used to encript data, if you have pulled project from git, you will need to generate it since you will get an error
			In order to overcome this error use console and type 
		 
			/	php artisan key:generate

APP_DEBUG	If it is on application will show errors not good for live

If you want to test apps (later discussed) you will use folfer test and create inside it a file that ends in Test.php
Like so tests/MyTest.php

__________________________________________________________________________________________________

** ROUTING AND CONTROLLERS

Laravel is MVC framework - we will not explain what is MVC here

A common HTTP Verbs in Laravel (or in other systems)

 GET
 HEAD		-	to ask for headers only
 POST
 PUT
 PATCH		-	to modify resource
 DELETE
 OTPIONS	-	to see what options we have from server (if it is offered at all, never seen it in my life)
 

In lravel links or routes or web routes are placed in 
//Folder routes/web.php
Api links are placed in
//Folder routes/api.php

Let us take a look at the generating link again

	+ Route::get('/', function () {
	+ 	return "Simple Hello World";
	+ });

Content is not echoed. Insted it is returned. And the reason behind it is that the content will be passed throw several validators.
Also there are some middlewars that can decide can you see content or not. And that is why we return content and not echo it.

In most of the cases in laravel you will return a view and most probably throw some sontroller
	
	+ Route::get('/', function () {
	+ 	return view('MyView');
	+ });
	
Regarding those links, we have used get so far, but somebody can create a form that sens POST data to a link
In that case we want

	+ Route::post('/', function () {
	+ 	// and in here we handle that request
	+ });

And instead of post in Route::post we can change post to delete, put, any and so on. Or even you can do something like that.

Still this is not used wery much, the thing descripbed just above is using closures to handle routes function(){} -> this is closure
The most common way to do it is to use controller name and methods

	+ Route::get("/", 'HelloWorldController@index')
	
We have already described this, but lets do it again, this route tells laravel to serve index 
method of HelloWorldController controller class
Above code can be also written like this
 
	+ Route::get("/", [HelloWorldController::class, 'index'])
	
But it is not commonly used

Some routes can have parameters like is and similar
	
	+ Route::post('user/{id}/friends', function ($id) {
	+ 	return "The user id in question is ".$id;
	+ });

Parameter can be optional with question mark 'user/{id?}'

WHat is very interesting to know is that we can validate this($id) parameter imidiatly using reg exporesssion
	
	+ Route::post('user/{id}/friends', function ($id) {
	+ 	return "The user id in question is ".$id;
	+ })->where('id', '[0-9]+'); // ony numbers
	
For username you would put something like this
	->where('username', '[A-Z-a-z]+');
	
If you have more then one url parameter, and you would like to validate them all write soemthing like this

	+ Route::post('user/{id}/{slug}', function ($id, $slug) {
	+ 	return "The user id in question is ".$id;
	+ })->where('id' => '[0-9]+', 'slug' => '[A-Z-a-z]+'); // ony numbers

And if it is mismatched to regex then 404 will be returned. And regardgin names, $id and $slug, it does not metter, 
laravel checks from left to right, still you sholu name variables the same as url parameters

If you want to make echo al ink on some page  you can use 
	
	+ echo url('user/33/friends')
	
Laravel offers you to name routs for some reason, like to be able to change them in web.php and not to disturb views files
This is done in a follwoing way

	+ Route::get("/{id}", 'HelloWorldController@index')->name('HelloWorldController.index')

Now you can use it like this in the views template (you still do not know what is view template but soon you will see)

	+ echo route('HelloWorldController.index', '[id] => 14');

Best way to name the name of the routes is something like this photos.index photos.edit etc..
So all in all use helper rote instead of just echo url as it helps us later on to cheange links and keep the names

Using roue helper is as follows. If you have a link like this
// https://somesite.com/users/userId/comment/commentId

	+ route(users.comment.show, [1,2])
	+ route(users.comment.show, ['userId' => 1, 'commentId' => 2])

One interesting note is to know that routes can be groupped if they have something in common
Defining a group is done like this

	+ Route::group(function (){
	+ 	Route::get('hello', function (){
	+ 		return "hello";
	+ 	});
	+ 	Route::get('world', function (){
	+ 		return "world";
	+ 	});
	+ });

IN example above there is nothing interesting except that we have added some routes to the gorup, nothing happens for now.
Lets add a prefix to the group. So that all the links in a grup actually have 'greating/' added auytomaticaly

	+ Route::prefix("greating")->group(function (){
	+ 	Route::get('hello', function (){
	+ 		return "hello";
	+ 	});
	+ 	Route::get('world', function (){
	+ 		return "world";
	+ 	});
	+ });
	
We are going to modify that a bit, meaning we need middleware

	+ Route::prefix("greating")->middleware('auth')->group(function (){
	+ 	Route::get('hello', function (){
	+ 		return "hello";
	+ 	});
	+ 	Route::get('world', function (){
	+ 		return "world";
	+ 	});
	+ });


Here is how we use middleware to restrict access to some routes only for authenticated users outside group

	+ Route::middleware('auth')->group(function(){
	+ 	Route::get('hello', function (){
	+ 		return "hello";
	+ 	});
	+ 	Route::get('world', function (){
	+ 		return "world";
	+ 	});
	+ });

This is an easy way to do this, but the most common way to applay middleware is via controller
Meaning add middleware in constructor of a controller and this controlelr will be accessable only for specific roles

	+ class HelloWorldController extends Controller{
	+ 	public function function __construct{
	+ 		$this->middleware('auth');
	+		$this->middleware('admin-auth')->only('editUsers');
	+		$this->middleware('team-member')->except('editUsers');	
	+ 	}
	+ }

Middlewares are widly used in laravel, and we have milions of them.
In a follwoing example this page can be accessed 60 times in one minute and no more

60 is number of times

1  is 1 minute

	+ Route::middleware('auth:api', 'throttle:60,1')->group(function(){
	+ 	Route::get('hello', function (){
	+ 		return "hello";
	+ 	});
	+ 	Route::get('world', function (){
	+ 		return "world";
	+ 	});
	+ });
	

If all the routes fail we can define fallback something like custom 404

	+ Route::fallback(function (){
	+ 	return "CUSTOM 404";
	+ })

Subdomain routing will be skipped since we plan to make new apps for each subdomain
Also you can use namespace inside routes group definitions if controllers are inside some folder
for example if controllers are inside dahsbord fodler of controllers folder you can do something like this

	+ Route::namepspace("Dashbord")->group(function (){
	+ 	Route::get('hello', 'PurchaseDashbord@index');
	+ });

If we have not used this namespace we would have to write 
	
	+ 	Route::get('hello', 'Dashbord/PurchaseDashbord@index');
	
Now let us complicate things to extram
We want to have names of routes also prefixed and we want to have liks also prefixed

	+ Route::name('users.')->prefix('users')->group(function(){
	+ 	Route::name('comments.')->prefix('comments')->group(function(){
	+ 		Route::get('{id}', function (){
	+ 			return 'Most complex thing ever';
	+ 		})->name('show')
	+ 	});	
	+ });

Ok look at that mass upstairs :) we did that so that we can have the same thing like below
	
	+ 	Route::get('users/comments/show', function (){
	+ 		return 'Now not so complex';
	+ 	})->name('users.comments.show')

But what if we have a lot more links under same prefix, then it is more interesting the most complex things ever

SIGNED ROUTES
Now we will work on SIGNED. This is a apage that you can only access using url with specific key
For this page - login is not requred. This signed route is used like: you send it in an email and clinet clicks
now we know it is him he has to key to access page. 

First create a route with name. Name is required

	+ Route::get('invitation/{invitation}/{answer}', 'HelloWorldController@invitation')->name('invitations');

Now, Inside controller we can use URL class helper (or in view template or wherever) to generate specific links
We need to add following line at the begining of the page so that we ca access URL class

	+ use Illuminate\Support\Facades\URL;

inside controler or in some view we can echo several links like
regular link

	+ URL::route('invitations', ['invitation'=>1234, 'answer']);
	
Signed

	+ URL::signedRoute('invitations', ['invitation'=>1234, 'answer']);
	
Signed and expires	

	+ URL::temporarySignedRoute('invitations', now()->addHours(4), ['invitation'=>1234, 'answer']);
	
	
But our link can be accessed by everybody what to do. Well it is easy, we need to add midleware to the main link in routes

	+	Route::get('invitation/{invitation}/{answer}', 'HelloWorldController@invitation')
	+	->name('invitations')
	+	->middleware('signed');

now this page can not be accessed regulary it has to be accessed with signed. All thiw validation can also bee done in controler 
using the method __invoke but we will skip it for now


__________________________________________________________________________________________________
** VIEWS
	
Views are used to display somethiong hence the views. In laravel they are most commonly in html, but they can also be json or xml
Views can be plan php templates or BLADE templates it is just in the way you are going to name them. For example

about.php 			-> regular view template
about.blade.php 	-> blade template

Viewas are loaded with view() function they can also be loaded like View::make().

Here is a simple code of view

	+ Route::get('/view-example', function(){
	+ 	return view('home');
	+ });


You need view file to be located inside
//resources/views/home.blade.php
or
//resources/views/home.php

When you access the page you will see content of a view
You can also add variables to the view

	+ Route::get('/view-example', function(){
	+ 	return view('home')->with('myVar', 'MyVarValue');
	+ });

In laravel it is preatty common to pass only a view to route so they have created something like this

	+ Route::view('/view-example', 'home');

Or if you want to pass data to route view

	+ Route::view('/view-example', 'home', ['myVar'=> 'MyVarValue']);
	
We can share some variable with all the views if it is important

	+ view()->share('sharedVar', 'sharedVarValue');

__________________________________________________________________________________________________

** CONTROLLERS


Class that organizes ligic of one or more routes in one place. And that is that :D jk
So how do you make controllers. Well it is extramly easy using CLI commands

	:php artisan make:controller artisanController

This will make new controller in folder 
//app/Http/Controllers

If you want to place controller inside some subfolder use following command

	:php artisan make:controller master/artisanController
	
This file in master will have diferent namespace and it will insert neccecery line, and it will have added master to namespace

	+	use App\Http\Controllers\Controller;

Now lets modify newly created controller and add index method
And now lets create a we rote to that controller index method
	
	+ Route::get('/artisan-controller-index', 'ArtisanController@index');
	
If a controller is in folder controllers you can just tyoe its name like that, but if you put it inside folder like 
//app/Http/Controllers/master
then you need to reference it also

	+ Route::get('/artisan-controller-index', 'master/ArtisanController@index');

Regarfing generating of controllers you can generate it as a resource. Meaning this controler should have 
insert delete update methods for a certain table or a sort

	:php artisan make:controller artisanController --resource
	
This will create controller for use that has all the methods to control database inputs

Now we will demonstrate a FORM
lets create a form on our artisan.blade.php nd two links

this first link will hold a method that returns view and that view has a form on it

	+ Route::get('/form-create', 'ArtisanController@create');
	
this stores the submited form from the view above

	+ Route::post('/form-store', 'ArtisanController@store');


Artisan create method is easy to understand but store method is as follows

	+ Greeting::create(
	+ 	request()->only(['body'])
	+ );
	+ return redirect('/form-create');



Greeting in this case is eloqauent model that has create as a static mehtod that receives request helper function
request helper represents http request

Also the eloquent class that will save this data needs to have 
protected variable fillable someting like this
//file Greeting.php - Eloguent class in our code

	+ protected $fillable = ['body'];

So now we will be able to save that data with the code above

Lets explan this
Greeting:create() expect an array like this
[
	'body' => 'some value fro post field'
]
And request onlu generates an array comeplatly similar to the array above using post values or get values
and when you said only it means from the post data take only body

Typehinting is something like this (String lokosi) Streing is typehinting regular thing in java here in php a "magic" pathetic hahaha

OK lets go back to controllers that are resources. Lets generate one that is a resource type following in the console

	:php artisan make:controller ResourceController --resource
	
OK now you have created resource controller and now we need to make a lot of route get and route post and route delete etc.
It would be to much work so lets just create one route that is resource

	+ Route::resource('resource', 'ResourceController');

Why not chekc on this using a nice command like

	:php artisan route:list

You will see a lot of new links connecter to the resourceCOntroller and his methods

Generating api resource is a bit diferent you will use 

	:php artisan make:controller ResourceController --api
	
And link will be

	+ Route::apiResource('resource', 'ResourceController');	
	
	
 ** TAKE A GOOD LOOK HERE

The invoke function of a class is a function that will be called if you call a class name as a function

for example
class MM{
	public function __invoke(){
		echo "Hey";
	}
}

MM() -> will call __invoke()

Now that we know this we can make a controller that does only one thing within its __invoke function and 
you make a web orute like this

	+ Route::post('someplace/form/update', 'UpdateAvatarController')
	
Now here we do not have any methods instead invoke will be called	

! Consider route cashing for every milisecond

Follwoing are mehtods that are predefined in laravel

Route::get()
Route::post()
Route::any()
Route::match()
Route::patch()
Route::put()
Route::delete()

How are you going to send someting via http form that is not get or post - you need to use SPOOFING
In laravel template add one hidden filed to form definition
So here is one simple POST form

	+ <form action = "<?php echo URL::route('form-store');?>" method = "POST">
	+	@csrf
	+ 	<input name = "body" type = "text" maxlength = '32'>
	+ 	<input type ="submit" value = "submit">
	+ </form>



URL::route('form-store') will work only if web.php has a route with defined name 'form-store'
If you try to delete @csrf post will not work and you will get page expired error.


@csrf -> It is used to fight against cross site forgery

You can aslo insert token like this
	
	+ echo csrf_field();

Or

	+ <input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>">


If you want to change method you can add something like this iside html form

	+ @method('DELETE')
	
Or you can add input filed inside html form

	<input type = "hidden" name = "_method" value = "DELETE">
	

Since you will alsoe make ajax requests right and probably with jquery or dk do following

	+ <meta name = "csrf-token" content = "<?php echo csrf_token(); ?>" id = "token">

Now that you have it in emta tag you can add it in js request header
like
	
	+	$.ajaxSetup({
	+		headers:{
	+			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	+		}
	+	})


OK that is that regarding csrf

Now lets show what else can we return from the route, not just view or string
lets see what else
	
REDIRECT
	+	return redirect()->to('login');
OR
	+	return redirect('login');
OR
	+	return Redirect::to('login');	
	
Redirect has parameters like these

	+	redirect()->to($to = null, $status = 302, $headers = [], $secure = null);

All methods take a route as a place to redirect and not a nema of a route

	+	redirect->route('services.view')
	
In this case the 'service.view' is probably a neme for a route 'services/name'
Route also does not have same paraameters as route to it has follwoing

	+	redirect->route('services.view', $parameters = [], $status = 302, $headers = [])
	
The method above is interesting couse you can use it like this
	
	+	return redirect->route('services.view', ['dataKey'=> 'SomeKey'])
	
Most common thing you are going to use is 
	
	+ return redirect()->back()
	

Here are some more redirect methods to run yor day

	+ return redirect()->home()			- to the route named home
	+ return redirect()->secure()		- with secure oparameter set to on
	+ return redirect()->action()		

There are more methods that you will never use	so lets go on

! redirect()->with() as this s something yo are ghoing to use quite often
this with thjing passes data to session so that yo can use it on the redirected page
Here is the most common thing in laravel

	+ return redirect('dashbord')->with('error', true);
	+ return redirect('dashbord')->with(['error' => true, 'message' => 'Whoops!']);

EVEN more important and iteresting is to return to the submiting page with the submitted data

	+ 	return redirect('formPage')
	+ 	->withInput()										// Send the form data back togeather with parameters
	+ 	->with(['error' => true, 'message' => 'Whoops!']);	// parameters

How are you going to use this ? Well extramly easy, use function old()

	<input name = "username" value = "<?php old('username', 'Default username instructions here');?>"> 

There are some shortcuts to abort a request, meaning serve page 403 error or something that you probalby wont use
instead of return you will write

	+ abort(403, 'You can not do that');  // this will stop execution and serve http status 403 withe error
	+ abort_unless(boolean $var,403);		// same as above but first check
	+ abort_if(boolean $var,403);			// same as above but first check
	
You can make custom responses like,  i do not understand the purpose but we will probably understand later or during the work

	+ response()->make('Hello, world', 200) 	// this will return hello world with status 200
	+ response()->json($jsonData, 200) 		// this will return json datawith status 200
	
IMPORTANT

Sometimes you will want to return a file for download. do it like this

	+ response()->download('link to fle', 'file rename'),
	
And if you would like to display the file in the brawser if possible like pdf use follwoing

	+ response()->file()
	
	
We will work on laravel testing some other time :)


__________________________________________________________________________________________________

** BLADE TEMPLATING

For the purpose of blade templating we will use ArtisanController and those two forms that we already have

	+ Route::get('/form-create', 'ArtisanController@create')->name('form-create');
		// thuis method holds code for storin the submited data from above
	+ Route::post('/form-store', 'ArtisanController@store')->name('form-store');
	
'/form-create' will return a blade template created in the following folder
// folder resources\views\artisan.blade.php

in order for bleade template to work it needs to have .blade.php in the name
Blade uses {{ }} to echo something and @ for starting commands or directives(to say correctly)
If you ahgve a object $group with var title you can use it like this

	+ <h1>{{ $group->title}} </h1>			//echo group title but pass it throw htmlentities
	+ {{!! $group->title() !!}}				// echo group title but do not excape htmlentities

What if you want to write {{ and }} you can ad directive @ and it will work just type thios and it will @{{
	
You can write foreach method easily

	+ @forelse($arr as $temp)		// go throw array
	+ 	{{$temp->name}}			// for each member echo temp name
	+ @empty						// if it is emopty write html underneath
	+ 	<div>Non here</div>
	+ @endforelse					// end this loop here
		
	
You can also use if else like above but:

	+ @if(count($arr) === 1)
	+ 	<div>This array is only 1 memeber long</div>
	+ @elseif(count($arr) > 1)
	+ 	<div>This array has more then one member</div>
	+ @else
	+ 	<div>Certenly zero :D</div>	
	+ @endif
	
You have seen forelse up above. i do not know why would they make such a thing when you have foreach and for and while
But forelse has that @empty thing so you can be happy now
Look atr the good way to do it

	+ @for($i=0; $i < 10; $i++)
	+ 	<div>{{$i}}</div>
	+ @endfor

Now foreach

	+ @foreach($arr as $temp)
	+ 	<div>{{$temp}}</div>
	+ @endforeach
	
Now while

	+ @while($i < 5)
	+ 	<div>{{$i}}</div>
	+ @endforeach
	
Doring the foreach and forealse we imidiatly get $loop variable. And that varaible can help as determinate some thins that can 
help us. But you will probaly not use it. Still elts show it

	+ @foreach($arr as $temp)
	+ 	<div>INDEX 		{{$loop->index}}</div>			// this tells us from 0 to arr length what element is currently active
	+ 	<div>ITERATION 	{{$loop->iteration}}</div> 	// this tells us from 0+1 to arr length 1+ what element is currently active
	+ 	<div>COUNT 		{{$loop->count}}</div> 		// how manu elemets are there
	+ 	<div>FIRST 		{{$loop->first}}</div> 		// telss us if it is first element
	+ 	<div>LAST 		{{$loop->last}}</div> 			// telss us if it is last element
	+ 	<div>DEAPTH 	{{$loop->deapth}}</div> 		// If you have foerach inside foreach then deapth will be 2
	+ @endforeach
	
	
Now we go to the important part TEMPLATE INHERITANCE
First on our artiasn blade php -> lets cosnider him main template.
We will demonstrate follwing templating tricks
The blue comments blow are not correct ! keep that in mind

//file artisan.blade.php

	+ @yield('title', 'Home page')		// inlcude  view 'title'  or if it does not exist put Home page 

	+ @yield('content')					// inlcude  view 'content'  or if it does not exist then nothing

	+ @section('fotterScript')				// inlcude  view 'content'  or if it does not exist then codein between
	+ 	<script src = "app.js"> </script>		
	+ @show


Inside @section the code in between can be availabel to the fotterScript VIEW using @parent which is cool
Unlike above options, @yield called views can not use default values

This is all NOT CORRECT. 
Here is what you actualy do. You create child template

All those templates that inherit parent template are usualy called partials if i am correct

And you include parent tamplate
// file childTemplateArtisan.blade.php
	+ @extends('artisan') 
	
Code above will just insert parent template artisan to this page, as it was on the regular page
So Nothing much so far
// file childTemplateArtisan.blade.php
	+ @section('title', 'Dashbord')	
	
Now code above will search  @yield('title', 'Home page') on the parent view 
and when it is found it will change 'Home page' to 'Dashbord'
// file childTemplateArtisan.blade.php
	+ @section('Content')
	+ 	This is the main contend of the child template
	+ @endsection
	
The code above does someting similar, it will search for the @yield('content') and at that place instead of 
@yield('content') it wil lecho all that is in between @section('content') and @endsection

// file childTemplateArtisan.blade.php
	+ @section('fotterScript')
	+ 	@parent
	+ 	<script src = "dashbord.js"></script>
	+ @endsection

WHat does code above do ? Well similar, seacth for @section('fotterScript') and instead of it displat parts that is in between above code
WHat is that parent ? well what was inserted in the parten section can be accessed here
WHat is the diference between @section/@endsection and @section/@show
Well show is used in parent template and endsection in child template

WHen you use extend like above (  @extends('artisan')   ) this imidiatly means that this template 
is going only to define some sections and that is that, he will probably not have anything else in it probably

Ok so all in all i was just being sarcartic a few lines back, we do have include
it is easily used. Create new view that will be included like
// file views/sign-up-button.blade.php
	+ <a class = "some classes" >
	+ 	<i class = "SomeOtherCLass"></i> {{ $text }}
	+ </a>

see here a text variable abve, well we are going to include this little view using parameters that will have a nema text ofcourse
// file childTemplateArtisan.blade.php
	
	+ @include('sign-up-button', ['text' => 'text given in parent template'])

We have some options that can help us include thingis

	+ @includeIf('sign-up-button', ['text' => 'text given in parent template']) //incldue if it exists
	+ @includeWhen(Boolean $some ,'sign-up-button', ['text' => 'text given in parent template']) //incldue @some is true
	

We have more options in building templates for example 

*STACKS

For example if you have a page that needs to load 1 css, and another page needs to load 2 css files, first is from the first page
and second is specific for itself, third page loads 3 css files, the first two are the ones from first page and second
and third css is specific for itself

lets demonstrate this with divs

First i parent template put
// FILE artisan.blade.php
	+ @stack('stackDivs')
	
This will not do anything but ! in the child template add

// FILE childTemplateArtisan.blade.php
	+ @push('stackDivs')
	+ 	<div> Pushed to the bottom of the stack stackDivs </div>
	+ @endpush

No code above will push the div above ('<div> Pushed to the bottom of the stack stackDivs </div>') to the parent 
where @stack('stackDivs') should be
// FILE childTemplateArtisan.blade.php

	+ @prepend('stackDivs')
	+ 	<div> Pushed to the top of the stack stackDivs </div>
	+ @endprepend

If something was pushed already to the parent stack, this prepend will put the div above all divs.
All this is similar to the array. Push all to array or prepend, and at the end show the array the way it was itended

Stacks are usualy used for css and js files not like what i did above

*COMPONENTS AND SLOTS

Remember the button that we used before

	+ @include('sign-up-button', ['text' => 'text given in parent template'])
	
So the code above takes the view called sign up button and where text 
var is found it puts 'text given in parent template' instead of it

Now if value for text is to large, maybe there is a better way.

Create new view called slot-example.blade.php
//FILE slot-example.blade.php
	
	+ <div>	
	+ 	<h5>Below me is a slot place</h5>
	+ 	<div> - -  {{ $slot }} - -</div>
	+ </div>
	
Look at the $slot var it is extramly simialr to the button that we created. Now you can include this slot example like this
// FILE artisan.blade.php

	+ @component('slot-example')
	+ 	 And this value will be placed instead of $ slot 
	+ @endcomponent

Now what will happen, the code above will be exchanged for the slot-example.blade.php but the place between component
'And this value will be placed instead of $ slot' will be used to be placed 

You can have more then one variable in the slot-example, so we will change our file to reflect that
//FILE slot-example.blade.php

	+ <div>	
	+ 	<div> - -  {{ $title }} - -</div>
	+ 	<h5>Above is title place, Below me is a slot place</h5>
	+ 	<div> - -  {{ $slot }} - -</div>
	+ </div>

You also need to upldate
// FILE artisan.blade.php

	+ @component('slot-example')
	+	@slot('title')
	+		<div>THis will be placed instaed of title var in slot-example</div>
	+	@endslot	
	+   And this value will be placed instead of $ slot 
	+ @endcomponent


OK wo there were a lot of examples and it was quite tyring but lets move on it is not jet end

SHARING data globaly
What if you want to have all pages have specific data with them, like the one you have already used
->with(['ales'=>'mesar']) remeber this
So we want all of our pages to have it. it is done easily. Just use service provider and its boot method
//FILE app/providers/appServiceProvider

	+ view()->share('sharedData', 'sharedDataValue');
	
And now after this you can acces this var value in all the views ever
// FILE artisan.blade.php
	
	+ echo '<br> Value of sharedData passed from service provider boot method - '.$sharedData;	
	
You can also make it so that only certain views have acces to that var like this
//FILE app/providers/appServiceProvider -> did not made examlpe of this
	+ view()->composer(['viewName'.'secondViewName'], function($view){
	+ 	$view->with('sharedData', 'sharedDataValue')
	+ });

Regarding views you can also include classes that are imidiatlu instanced if you want like this
// FILE artisan.blade.php
	+ @inject('ExampleClass','App\Example\ExampleClass');
	
You also need to create this class in the folder
// App\Example\ExampleCLass.php
	
	+ namespace App\Example;
	+ 
	+ class ExampleClass{
	+ 	public $lokosi = "<br> <h5>Hello</h5>";
	+ }
	
Instead of @inject the calss above could have also been passed to a route like this 

	+ Route::get('some/link', function (ExampleClass $ExampleClass)){
	+ 	return view('someView')->with('Example', $ExampleClass);
	+ })


Since there is a typehint (ExampleClass) in the function it can recognize the class (probably need to have namespace use option someware)

You can have custom BLade directives if you want for some reason.
For example you can check if there is a subdomain name in your application. 
And you would like to have something like this
//FILER artisan.blade.php
	+ @hasdubdomain
	+	OK this site is under subdomain and not main site
	+ @endhasdubdomain
	
	
Go to the 
//FILE App\Providers\AppServiceProvider	function boot add
	+ $parameter = true;

	+ Blade::directive('hasdubdomain', function ($parameter){
	+ 	// instead of this we would have some function to determine does it realy have subdomain
	+ 	$hasDubDomain = $parameter; //do not do any logic inside blade directives always outside !!!!
	+ 	return "<?php if($hasDubDomain){  ?>";
	+ });
	
Ok this will open it up, we also need to close it once it is opened
//FILE App\Providers\AppServiceProvider	function boot add
	
	+ Blade::directive('endhasdubdomain', function (){
	+	return "<?php } ?>";
	+ });	

You know instead of writing endhasdubdomain you could have also inserted endif :)
You are probably going to write a lot of if blade statements or maybe not so you can just use something like this
//FILE App\Providers\AppServiceProvider	function boot add
	
	+ Blade::if('isDimeLord', function(){
	+ 	return true;
	+ });

Now you can use 
//FILER artisan.blade.php

	+ @isDimeLord
		YES HE IS
	+ @endif	
	
REGARDING testing the views, it is most commont to visit the page

__________________________________________________________________________________________________
** DATABASE AND ELOQUENT

You are probably going to open up this file
//config/database.php
you will see a lot of options some of them you can just delete nmost of them

All in all lets go to migrations. During this tests, you will have a lot of problems with already created tables and so on.
So all in all if migrations do not work, just take a look at the database, if you have problems, just chekc if some tables or 
table columns exist and delete them, since rollback will not work in the begining. Rollbak usualu do not remove column tables
if you have not set up down method accordingly. And we have not worked with down methods

Migration files are classes that define hat define some DB table or table alterations
they usualy have up and down method, to install or remove some table
Take a look at the file 
//FILE database/ migrations/2014_10_12_000000_create_users_table.php
and you will see what we talked about

OK creating a migration, how do we do that, so in order to ceate table that or MIGRATION you just type

	:php artisan make:migration masters

Thiss will create migration file with class Masters	in folder migrations under database


you can pass a parameter that will determinate table name

	:php artisan make:migration mastersOverRide --create=MaterClass
	
Or a parameter that will tell the file to be prepared to modifiy existing table in the follwoing case master table

	:php artisan make:migration mastersOverwrite --table=masters


OK we will create new table called masters

	:php artisan make:migration masters
	
ok now we have file created called yours will be similar
// database/migrations/2021_03_03_123303_masters
Open the file and inside up method add

	+ Schema::create('masters', function (Blueprint $table){
	+	$table->increment('id');					// this is primary key and autoincrement and unsigned
	+	$table->string('name', 64)->unique();		// and unique can not be repeted
	+	$table->boolean('alignment')->default(true)->index();	// with defautl value and index on db
	+	$table->decimal('power', 5,2);				// like this 999,99
	+	$table->double('height', 6,2);				// like this 9999,99
	+	$table->datetime('becomeFameous')->nullable(); // can be null
	+ });

All above is self explanatory and is all placed in up method and here is what we add in down method

	+ Schema::dropIfExists('users');

We can also change existing tables inside our migration that will add or remove some columns from the already created tables
add to the same file BUT BEFORE CHANGING RUN THIS COMMAND if change does not work
	: composer require doctrine/dbal
	
I had problems with installing this doctrine dbal and in json file change doctrine sdbal from 3.0 to 2.0
and then composer update and it is all ok
ALso keep in mind that when you run migrate some databases will be created some will not. So keep that in mind also.


	+ Schema::table('greetings', function (Blueprint $table){
	+ 	$table->string('header', 512);
	+ 	$table->string('body', 1024)->change;
	+ });
	

After some tables are created and you would like to modify them to remove indexes you can use this

	+ $table->dropPimary('nameOfTheColumn')
	+ $table->dropUnique('nameOfTheColumn')
	+ $table->dropindex('nameOfTheColumn')
	+ $table->dropForeign('foreignKeyConstrintName')
	+ $table->dropForeign(['whatItReferences'])
	
How about foreign key creation - it is extramly easy

	+ $tabler

// you do not need to use onDelete	

And that is that

Now we would like to run those migrations nad to see those databases. We have files prepared. lets run migration
(i have removed already existin migrations in the migration folder)
	:php artisan migrate

And this will run our files 
We can do 

	:php artisan migrate:reset		//Removes tables lookuing at down method

And now we have removed all the tables that we have added yes, but we do not have them anymore
This command looks at down method

	:php artisan migrate:refresh	//remove tables and istall them again
	
This does reset and runs migrate again	

	:php artisan migrate:fresh		//remove tables and istall them again
	
This is similar to refresh it does reset but without looking at down method just removes tables. and runs migrate again	


	:php artisan migrate:rollback --step=2
	
Rols back last 2 migrations, you can change the number ofcourse

	:php artisan migrate:status	

Shows runned migrations


SEEDING

Seeding is actualy populating tables with data, some arbitrry test data usualy

Lets make a seeder

	:php artisan make:seeder MastersTableSeeder

In folder 
//database/seeds 

You will find MastersTableSeeder

THis seeder needs to be known to the main seeder class called DatabaseSeeder
Inside this class inside method run add our new seeder class
//database/seeds/DatabaseSeeder run method

	+ $this->call(MastersTableSeeder::class);

Ok now lets eddit our personal MastersTableSeeder class run method
//database/seeds/MastersTableSeeder

		+ DB::table('masters')->insert([
		+ 	'name' => 'superman',
		+ 	'alignment' => true,
		+ 	'power' => 45.2,
		+ 	'height' => 125.22,	
		+ 	'becomeFameous' => "2014-01-01 11:11:11",	
		+ ]);


OK that is done now run the seed

	:php artisan db:seed

Seed can also be run while migrating

	:php artisan migrate --seed

So what happened now ? We got one row added in the database. This does not help that much

We want more then 1 record to be inserted of course so we need seed factories
Facotry is a class that is udes to insert rows in the database
They relaty on Eloquent model for database
Factories are placed in databse/factories

You make factory by using artisan command. Lets create one factory

	:php artisan make:factory GreetingFacotry --model=Greeting
	
It is strongly recomended that you just name them like this ModelNameFactory and put --model=ModelName class
Now that you have run command like that, you will see a new GreetingFacototy class in
// database/factory/GreetingFacotry.php

OK it is time to add something to it

	+ $factory->define(Greeting::class, function (Faker $faker) {
	+ 	return [
	+ 		'body' 		=> 'Factory body',
	+ 		'header' 	=> 'Factory header'
	+ 	];
	+ });

OK lets look at each line one by one
$factory->define(Greeting::class, function (Faker $faker) 

Here we have a factory method define that will take model (Eloquent) name as a first parameter and a function with faker as parameter
This faker will help us create randomized entries in db
inside we have returned an array whcih keys corresond to the databse columns

OK now how do you use this facotry. Well factory is used inside seed classes like this
// file MasterTableSeeder   - i should have created GreetingTable seeder but what are we gona do now :/

	+ factory(Greeting::class, 20)->create();
	
OK now that we told factory that we are using greeting class, he searches for the factory that has Greeting::class defined
and inside seraches for the array and start to generate inputs based on array
Lets use fakes to get randomized thingies

	+ $factory->define(Greeting::class, function (Faker $faker) {
	+ 	return [
	+ 		'body' 		=> $faker->text,	// some random text
	+ 		'header' 	=> $faker->name,	// some random name
	+ 	];
	+ });


Delete from the database what is already inserted and then just run seed again and you will seee interesting results

OK lets dive in more deaply. We will create new Eloquent model called writer, he is the one who writes greetings
So that greetings will ahve writer id as a foreign key to writer id, and we will create factory that creates writers and 
their comments all togeather

First lets create a model of writer

	:php artisan make:Model writer

// this will create a new Eloquent databse class Model	
and we do not need to do anything here
ok lets create migration

	:php artisan make:migration writer

This has create writer migration
OK now fill up migration method up() 
// file database/migration ***writer
	+ Schema::create('writers', function (Blueprint $table){
	+ 	$table->increments('id');		// this is primary key and autoincrement and unsigned
	+ 	$table->string('name', 64)->unique();
	+ 	$table->timestamp('created_at')->useCurrent = true;		// EXTREAMLY IMPORTANT ! Seeding aint gonna work
	+ 	$table->timestamp('updated_at')->useCurrent = true;		// EXTREAMLY IMPORTANT ! Seeding aint gonna work
	+ });
	+ // lets update alrady existing table
	+ Schema::table('greetings', function (Blueprint $table){
	+ 	$table->unsignedInteger('writer_id');
	+ 	$table->foreign('writer_id')->references('id')->on('writers');
	+ });

OK now we run this migration // you can comment out old migration in up method just not to couse any problems

	:php artisan migrate
	
You should see all tables in databse accordingly. If you are still expiriancing porblems, 
and you probably have, check the database for already cerated tables and columns

OK, lets summ up. We have created eloquent class Writer so taht we can make request to the databse
and to be abel to use factory for Writer
// app/Writer

OK we have created migratio for that Writer so that we have a database table writer and some other things in db
like foreign key to the greetings since writer is the one writing greetings
// database/migrations/2021_03_04_142519_writer    -your name will be similar

We have run that migration and got database tables ok.
Now we will create factory method that is a bit complex
But first we need writer facotry. Lets create it

	:php artisan make:factory WriterFacotry --model=Writer

We have now a facotry for model writer and lets just use it once, We will make seeder class for writer

	:php artisan make:seeder WriterSeeader

For all else seeader classes comment out all in run method so that we do not seed nothig else bofero running seed
Ok we have commented out everything now lets cerate add follwoing to the WriterSeeder
//databse/seeders/WriterSeeder run() method

	+ factory(Writer::class, 20)->create();
	
Now lets generate those writers by Adding our seeder in main DatabaseSeeder class
//DatabaseSeeder.php run() method
	+ $this->call(WriterSeeader::class);
	
You can comment out mastersTableSeader or something

After that run seeders
	: php artisan db:seed
	
Now you should be abble to see new simpatic writers in the database. If you do not and simply see some errors still
take a look at the error report and try to delete what is causing problems. I cant realy help you much there

Delete those new writers from the database since we are going to make a complex factory a greeting factory

OK this is porobalby wery confusing, seeader, writer, factory, migrate, eloquent model ... Fuck them right :)
It is what it is :)

Ok so what did we want, we wanted to create a complex factorty that is inserting writers and their greetings inside database
so that we can be happy

ok lets create greeting facotry ok ?

	:php artisan make:factory GreetingFacotry --model=Greeting

open the factory and modify it like this
//file databse/factory/GreetingFacotry.php	
	
	+ $factory->define(Greeting::class, function (Faker $faker) {
    + 	return [
	+ 		'body' => $faker->text,
	+ 		'writer_id' => function (){
	+ 			return factory(Writer::class)->create()->id //this shoud create one writer and give us back its id
	+ 		}
	+  	];
	+ });
	
There is one file that will cause problems ant that is the first GreetingFactory that i have already created,
//GreetingFactory.php
Comment it out inside so that it does not couse problems we have new greeting factory 
//file databse/factory/GreetingFacotry.php	
sorry for this

OK now real greeting factory is ready lets add it to the seader WriterSeader
//file WriterSeeader
	+ factory(Greeting::class, 20)->create();
	
Now when you run

	:php artisan db:seed

This chain of events happen

		- Openning DatabaseSedaer Reading run method
		- I have found WriterSeader class inside, i will run its method run()
		- Writer seader is calling facotry for Eloquent class Greeting
		- Search all factories to find where is Factory that uses Greeting::class
		- Found it inside file GreetingFacotry.php :) not Factory sorry
		- For writer id new factory is called and is searching for WriterFacotry
		- Ok generate first Writer inside db and give back its id
		- Us that id and generate greeting that is that

OK that was extramly complicated :D My god that was complicated !!!
But we are done with it, lets mouve on! 

Quaery Builder

We are now moving to Eloquent class and what it can doo, or you can just use DB::select('select * from greetings')
That :: is in laravel called fasade (HAHAHA)

Here is an example

	+ DB::select('select * from greetings where name = ?', ['MegaLord'])

This means selectr all from greetings where name = MegaLord	 or yuo can do somethiing like this

	+ DB::table('writers')
	+ 	->('greetings', function($join){
	+ 		$join->on('writers.id', '=', 'greetings.wrtier_id')
	+ 			->where('greetings.name', 'MegaLord')
	+ 	})-get()

Lets try some at our artisan.blade
//file artisan.blade
	+ $data = DB::select('Select * from writers');
$data will hold all writers in the database you can var dump it and see

OK make it a bit more complex

	+ $data = DB::select('SELECT * FROM writers WHERE name = :name', ['name' => 'MegaLord']);

You can do an insert

	+ $data = DB::insert('INSERT INTO writers(name) values(:name) ', ['name' => 'MegaLord']);	

Delete
	
	+ $data = DB::delete('DELETE FROM writers WHERE name = :name ', ['name' => 'MegaLord']);

Update 

	+ $data = DB::delete('DELETE ...


Lets now show how laravel (or drupal haha)  does that

	+ $users = DB::table('writers')->where('name', $someName)->get();

This will get all the columns how abous just some of them

Methods:

- select() 

	+ $users = DB::table('writers')->select('name', 'id as writer_id')->get();

- where
	+ $users = DB::table('writers')->where('created_at', '>', now()->subDay())->get();
if comparison for where is = you can ommit it and have only two parameters like
	+ $users = DB::table('writers')->where('created_at', '2020-01-01')->get();
	
Regarding where we can name many wheres FOLLWOING IS NOT CORRECT, it is just for a reference
	+ $users = DB::table('writers')
	+	->where('created_at', '2020-01-01')	// where created at is
	+	->where('name', 'LokosiMaster')		// where name is
	+	->whereBetween('age', [3,45])		// where age is between 0 and 1 eleement value
	+	->whereIn('age', [3,45,45,78])		// where age is found in array
	+	->orderBy('name', 'asc')			// where age is found in array
	+	->groupBy('name')					// where age is found in array
	+	->havingRaw('count(blabla) > 30')	// where age is found in array
	+	->get();
		
You can have nested wheres and so on, but my recomendation in case of extramly comples queries better to use db:select
with complex query as a parameter

Still you can play around with this stupidity if you want to waste some time. Like this

	+ $users = DB::table('writers')
	+	->whereExists(function ($query){
	+		$query->select('id')->from('greetings')->whereRaw('greetings.writer_id = writers.id')
	+	})	
	+	->get();
		
And this request above is somehow easyer then writing a regular query ????? I think not !

OK so far you have seend the ->get()

	->get() //gets all from query 
	
	->first() // gets only first
	
	->firstOrFail()
	
	->find($id) // search by using primary key
	
	->findOrFail($id)	//same as above but errors on fail
	
	->value()		// if you have one colum from the first result it will give you that
	
	->count()		// like gets how manu rows there is
	
	->min()
	
	->max()
	
And so on and so on, still it is pointless to show all of these examles in here, on the way you will learn them by yourself

JOINS

	+$users = DB::table('users')
	+	->join('contats', 'users.id', '=', 'contacts.user_id')
	+	->select('users.*', 'contacts.name')
	+	->get();
			
Ok that was join, and it is somehos simpler then query HAHHA no it is not :D

OK so far those were all selects lets review inserts

	+ $id = DB::table('writers')->insertGetId([
	+ 	'name' => 'Lokosi Kobra'
	+ ]);

$id will be inserted id

Insert more at once
	DB::table('writers')->insertGetId([
	+ 	['name' => 'Lokosi Kobra'],
	+ 	['name' => 'Lokosi Kobra 2'],
	+ ]);
	
Update

	DB::table('contacts')
		->where('name', 'OldName')
		->update(['name' => 'newName'])	
		
Delete

	DB::table('contacts')
		->where('name', 'OldName')
		->delete(['name' => 'newName'])	
		
		
Now transactions, also are like wery easy. I am not going to do all of these examples, just try some

	+ DB::transatcion(function () use ($userId, $numVotes){
	+ 	DB::table('contacts')
	+ 		->where('name', 'OldName')
	+ 		->update(['name' => 'newName']);
	+ });
	
Now all the db queries inside transation have to be done, or roolback will be fired
But we have one much more common method that all will like

	+ DB:beginTransaction();
	+ if(true){
	+ 	DB::rollBack();
	+ }
	+ DB:commit();
	
ELOQUENT

In most of the examples that follws values that are saved to the database need to have mass assignment property for specific
column in databse table. You will shortly understand it. Or you might have already find that out since laravel tells you that
In 90% of the cases tutorails always skip to tell you something and you keep trying like creazy and 10 cahpters later they say 
AHAH you should have done it like that. Sorry if i did the same sometimes :(

Ok all so far was like how to use database without eloquent, 
but you are porbably going to use eloguent. Ok eloquent is laravels
database manager class for a sepcific table :)
	
We will work start working on examples again so let frist creat writerController

	:php artisan make:controller WriterController --resource
	

Lets now create a new page called writer-controll index and store, this is where all the action will be
//web.php
	
	+ Route::get('/writer-control', 'WriterController@index')->name('writer-control');
	+ Route::post('/writer-store', 'WriterController@store')->name('writer-store');

And now lets edit index method of WriterController
//WriterController.php

	+ return view('writerControlPanel')->with(['allWriters'=> Writer::all()->get()]);	// maybe the ->get is not neccecery can cause probem

This tells our controller will return a view so lets make that view, create a file
With writer all means take all writers
//resources/views/writerControlPanel.blade.php

	+ Writer

Now when you go to a link '/wrtier-control'

It will go to controller WriterController and run indexs() method, index method returns view. Laravel goes to the view 
and reads it Since inside writerControlPanel.blade.php is only 'Writer' writen that is all that you will see.
Since our routes are returning some vars lets add that to to
//resources/views/writerControlPanel.blade.php
	+ <h4>List all names</h4>
	+ @foreach ($allWriters as $writer)
	+ 	<div> {{$writer->name}}</div>
	+ @endforeach	

Now we will add form to that page
//resources/views/writerControlPanel.blade.php

	+ <form method = "POST" action = "<?php echo route('writer-store');?>">
	+ 	@csrf
	+ 	<input type = "text" name = "name" > 
	+ 	<input type = "submit" name = "submit" > 
	+ </form>

Everything shoud be obvious for now and lets move on to the create method
//file WriterController
at the top
	+ use App\Writer;
so that we can use Writer eloquent class
ok now store method

	+ $writer = new Writer();
	+ $writer->name = $request->input('name');
	+ $writer->save();
	+ return redirect()->back();

And that is that it will work :)
	
OK that is a short introduction lets see what we have in Eloquent store for us
You know how to create models, and what are migrations and such
So regarding table name, how does larave know that.
Her assumes if model name is writer he expects table name writers
if model is car we expect cars and so on.
What if it is not expected then we can tell laravel what is table name

	+	protected $table = "the_real_table_name"  //change table name
	+	protected $primaryKey = "contacts_id"	//tell eloquent what is primary key

Eloquent class wants all tables to have created_at and updated_at
We do not have to have that
	+	public $timestamps = false // no more required created_at updated_at
	
Also if you do use them you can change the format but do not change format it is ok


OK now getting the data back. Here is how to do it

	+ $allWriters = Writer::all();

Or get only one 	

	+ $allWriters = Writer::findOrFail(44);

Lets demonstrate this
//WriterController.php Index method

	return view('writerControlPanel')->with([
		'allWriters'=> Writer::all(),
		'oneWriter'	=> Writer::findOrFail(23)			//FAILS WITH 404 page you can try catch it if you want
	]);
	
Ok so now the index method is returnih two new values that we can access, adn lets display them in our template
//writerControlerPanel.blade.php

	+ <h4>List all names</h4>
	+ @foreach ($allWriters as $writer)
	+ 	<div> {{$writer->name}}</div>
	+ @endforeach	
	+
	+ <h4>List one names ffor 22</h4>
	+ <div>{{$writer->name}}</div>
	
And if all is ok you should see what we inserted in db

Eloquent works similar to the database helper or FASADE :D

you can use it like this

	+ Writer::where('name', 'Lokosi')->get();

Or if you want to get all as before

	+ Writer::all();
	
But it is better to use 
	
	+ Writer::get();

They work the same just that get will be able to work with where clause and similar

Agregates work like this (agregates meaning get count of something)

	+ $countGoranWriters = Writers::where('name', 'Goran')->count();
	
Please note i will not do a lot of these examples. You can just do them in your real work, you do not need them now

INSERTS

Like so

	+ $writer = new Writer();
	+ $writer->name = "Lokosi Kobra"; // name is column in table writers
	+ $writer->save();
	
Or like so

	+ $writer = new Writer([
	+ 	'name' => "Lokosi Kobra"// name is column in table writers
	+ ]);
	+ $writer->save();

In both cases if you do not call save nothing will happen unlike the follwoing exapmple

	+ $writer = Writer::create([
	+ 	'name' => "Lokosi Kobra"
	+ ]);
	
UPDATES	

Similar to inserting just you need to get Writer that you want to update
	
	+ $writer = Writer::find(22);
	+ $writer->name = "New Name";
	+ $writer->save();

As you can see $writer above represents one row from the database under id 22. Also if there is updated at and created at
only updated at will be updated :D

OK now Mass assigment. FUS RO DAH ! ! ! !

This means save everything from the form imidialty in database, do not care about each field, and most probably it is an oke 
thing to do
// some controller
	+ public function update(Writer $writer, Reequest $request){
	+ 	$contact->update($request->all());
	+ }
	
This means all the data that was sent via http post form will be saved directly to the database
request all creates an array, i belivee we have already told that.
This wont work unless you set what fileds are fillable
// some Eloquent class

	protected $fillable = ['name']; // means what will be available for masss assigments like in the code above
	//or
	protected $quarded = ['created_at', 'updatd_at'] // what will not be available to mass assignments ofcourse

What if yoyu do not insert those thingis upstairs, well somebodyu can send in the form as a post filed created_at
and there you go :D	
You can also do sometinh like that , but i guess you will not use it 
	+ Writer::create($request->only('name'));
	
Something that you might use sometimes is this
	+ $writer = Writer::firstOrCreate(['name' => 'Luiziana']);
	
This will create new writer, enter it in the databse end return it. BUT if the one with the name(id whatever you pass) 
exist already you will get that one	

DELETING

In laravel you have soft deletes and real deletes
Real is like
	+ $writer = Writer::find(22);
	+ $writer->delete();
Or
	+ Writer::destroy(22)
OR	
	+ Writer::destroy([22,21,23,75])

OR
	Writer:where('updated_at', '>', '2020-01-01')->delete();
	
If you ever need softdeletes go search the net for it :)


Scopes

Scopes or filters, meaning get some results from the database not all, but some using some where clause
Ok, so what now  ? Well we can create a function in the eloquent class that we will use as a scope
//some eloquent class
	
	+ public function scopeYoungNamedLokosi($query){
	+ 	return $query->where('name', 'Lokosi')->where('created_at', '>', '2020-01-01');
	+ }
	
// or 

	+ public function scopeYoungNamedLokosi($query, $name){
	+ 	return $query->where('name', $name)->where('created_at', '>', '2020-01-01');
	+ }	

Why is that so that we can use it like this

	+ $youungAndNamed = Writer::YoungNamedLokosi()->get();
or
	+ $youungAndNamed = Writer::YoungNamedLokosi('Lokosi')->get();
	
We have ommited the 'scope' from scopeYoungNamedLokosi this is important

Scopes above are local scopes, meaning just for one query, 

GLOBAL SCOPES

we can ahve a scope for all the queries so that you do not have to
sepcificaly type them in, they will be already applied
Here is how to do it

FOr example we consider writers to be ok only if they are cerated after 2020-01-01 ok ? So we do not even want to consider them
if they are older
// Model Writer.php
	+ use Illuminate\Database\Eloquent\Builder;
	
	//

	+ protected static function boot(){
	+ 	parent::boot();
	+ 	static::addGlobalScope('name', fucntion (Builder $builder){
	+ 		$builder->where('name', 'Lokosi')'
	+ 	});
	+ }

Ok if you apply this, every time you use this model it will take only the lokosi named writers
There is also another way with making a class that can have scopes, but no need
And now what if you want to make that same query but without thos applied global scopes

	+ Writer:withoutGlobalScopers()->get();
	
But probably you are never going to do all of that right :D:D OK OK maybe you will ok ok 
if you are some critic leave me alone plese.


ACCESSORS
Eloquent is offerin some other fucntionality that is somehow interesting like you can create accessors
 to some of eloquent atributes like
// some model
	+ public function getNameAttribute($value){
	+ 	return $value ?: 'Ther is no name given';
	+ }

So now you can use ti like this

	+ $name = $someEloquent->name;	
	
So function getNameAttribute  removes get and attribute and leaves Name but puts name to lowercase. HAh what a thing eee?
So you will learn this and use it ?? Ofcourse not

Also a function named like this

	+ public function getMyPersonalAttribute(){
	+ 	return $this->name.' is my persona';
	+ }	
	
	
So you can now use it like this

	+ $myPersona = $SomeEloquent->my_personal;

And you are going to use that right ??? :D hahah never...	
It is quite strange to do this for columns that are not in the database still you can

MUTATORS

Work the same way, so as we can see this is repeating, maybe people who use laravel actualy use this shit
Here is how mutator work

	+ public function setNameAttribute(){
	+ 	return 'Sir. '.$this->name;
	+ }	

So now when you want to save something in the database when you use this

	+ $writer->name = "Michal";
	+ $writer->save();
	
	
In the database	you will see that michal is Sir. Michal :D Also take a look at the name of the function
Here is something interesting for sure.
In eloquent class you can prepare casts. meaning you can cast some values imidatly to something you want

//some eloquent class

	+ protected $casts = [
	+ 	'name' => 'string'
	+ ];

Now however you do it name will be string for that eloquent class 
If you know that some fileds are date fileds you can do something like this

	+ protected $dates = [
	+ 	'dateOfBirth',
	+ ];

You can do above also in casts

OK now COLLECTIONS in laravel. Ok somnebody likes javascript yes :D haha jk maybe it is frome somware else before

So colelction is a laravel array with some specific thignis it can do ok, similar to js arrays similar ok
we will demonstrate some of them in template writerControllerPanel.blade.php
//file writerControlPanel.blade.php
	+ $collection = collect([1,2,3]);

Here is now what we can do

	+ $odd = $collection->reject(function($item){
	+ 	return $item % 2 === 0;
	+ });

And that is how you get odd numbers

	+ $odd = $collection->map(function($item){
	+ 	return $item * 2;
	+ });
	
We can also do some complex thingis like this

	+ $sum = $collection
	+  ->filter(function($item){
	+    return $item % 2 === 0;
	+  })->map(function($item){
	+    return $item * 2;
	+  })->sum();

And you get a sum. 

Also there are serializations already prepared fopr you. Serializatin means convert some variable to its string representation
array or object whatever like this

	+ $writerArray = Writer::first()->toArray();
	+ $writerJson = Writer::first()->toJson();

You can return a model (eloquent) directly from the route, this is usualy done when creating apis

	+ Route::get('api/writers', function(){
	+ 		return Writers::all();
	+ });
	
	+ Route::get('api/writers/id', function($id){
	+ 		return Writers::findOrFail($id);
	+ });

This will json the writers or writer and send it back to you

When you return json, maybe you want to hide something not te be packed in json.
Jos just add protected hidden to eloquent class and it will be exlcluded like the following

	+ public $hidden = ['created_at'];
	
Now json will not have created_at	

	+ public $visible = ['name'];

Now json will only have name




ELOQUENT RELATIOSHIPS

ONE-TO-ONE
	
Writer has one greeting for example, but it shold have many yes
//Eloquent Writer.php 

	+ public function greeting(){
	+ 	return $this->hasOne(Greeting::class);
	+ }

It is expected that greeting table has writer_id, but if it does not, if it is named diferent

	+ public function greeting(){
	+ 	return $this->hasOne(Greeting::class, 'writer_foreign_coulumn_name');
	+ }

And now how do we do access that

	+ $writer = Writer::first();
	+ $greeting = $writer->greeting();
	
Lets demonstrate
//WriterController.php index method
	
	+ $writer   = Writer::first();
	+ $greeting = $writer->greeting;
	+	
	+ return view('writerControlPanel')->with([
	+  'allWriters'	=> Writer::all(),
	+  'oneWriter'	=> Writer::findOrFail(23),
	+  'firstWriter' => $writer,
	+  'firstWriterGreeting' => $greeting,
	+ ]);

//writerControlPanel.blade.php
	+ <h4>Show</h4>
	+ <div> {{$firstWriter->name}}</div>
	+ <div> {{$firstWriterGreeting->body}}</div>


OK now you know how to use thses relationships and we will just explain what we have else in store
reverse situation

//greeting Model
	+ public function writer(){
	+ 	return $this->belongsTo(Writer::class);
	+ }

So you can get writer like this

	+ $writer = $greeting->writer();
	
OK these were one to one ok. Experiment further to find more :D
OK now how do we insert them

	+ $writer = Writer::first();
	+ 
	+ $greeting = new Greeting;
	+ $greeting->body = "Lalaland";
	+ $writer->greeting()->save($greeting);
	
And this is how we save one greeting to a specific writer or even like this

	+ $writer->greeting()->saveMany([
	+ 	Greeting::find(1),
	+ 	Greeting::find(2),
	+ ]);
	
Or
	+ $writer->greeting()->create([
	+ 	'body' => "Lalaland",
	+ ]);
Or
	
	+ $writer->greeting()->createMany([
	+ 	['body' => "Lalaland1"],
	+ 	['body' => "Lalaland2"],
	+ ]);
	
ONE TO MANY	
OK we have shown one to one, but we are gonig to have it usualy one to many
Remeber the function greeting in the eloquent class, just change it to be hasMany

//Eloquent Writer.php but modified

	+ public function greetings(){
	+ 	return $this->hasMany(Greeting::class);
	+ }

Ok now it will pull all the greetings
	
	+ $writer   = Writer::first();
	+ $greeting = $writer->greetings;
	
You should change greeting to greetings it is more logical if there is one to many ok

This time greeting is laravel collection class so you can use map reduce and filter on them like so

	+ $specificGreetings = $writer->greetings->filter(function ($greeting){
	+ 	return $greeting->body == "Lokosi body";
	+ });

The reverse is the same belognsTo() it did not chage just type it where it should belong

So when you call for one to many like this 
	
	+ $writer->greetings; //return eloquent collecction 

You actually get the laravel colelction class
But if you do it like this	 

	+ $writer->greetings();	//return query builder
	
So we have tocall get on it

	+ $writer->greetings()->get();

Now that you know this you can do something like this

	+ $writer->greetings()->where('name', "Lokosi body")->get();	
	
You can select only writers that have greetings

	+ $writersWithGreetings = Wrtier::has('greetings')->get();

OK we also have somethin more complex that you can also find throw yor work and that is if writer has greeting an greeting has 
something for example a grupus that can be welcomed by this greeting

	+ public function greetingGroup(){
	+ 	return $this->hasManyThrough(Greeting::class, Group::class);
	+ }

You will access this relationship using $writer->greeting_group

If a greetig can be shown to only one group

	+return $this->hasOneThrough(Greeting::class, Group::class);
	
And now we have many to many

Imagine a user has contacts, and one contact can belong to manu users ok

// samo eloguent model user

	+ class User extends Model{
	+ 	public function contacts(){
	+ 		return $this->belongsToMany(Contact:class);
	+ 	}
	+ }

And also 

// samo eloguent model contact

	+ class Contact extends Model{
	+ 	public function users(){
	+ 		return $this->belongsToMany(User:class);
	+ 	}
	+ }
	
Ofcouse these two eloquent classes and their representing tables do not habe contact_id and user id they have pivot table
or table in the middle so to say the name ofthat table shoudl be

	contact_user   (alphabeticaly and separated with underscore).
	
And this table needs to have contact_id and user_id in order for all the sharade to work

If you have done all that now you can do something like this

	+ $user = User::first();
	+ $user->contacts->each(function ($contacts){
	+ 	// some code
	+ });
	
Same thing for contacts
	
	+ $contact = Contact::first();
	+ $contact->users->each(function ($user){
	+ 	// some code
	+ });
	
Or you can do something like this

$vips = $user->contacts()->where('status', 'vip')->get();

To get  all contacts from user that are vip contacts
If pivot tables have more data in them insted only contact_id and user_id you can also pull them by addding withPivot()

	+ class Contact extends Model{
	+ 	public function users(){
	+ 		return $this->belongsToMany(User:class)->withPivot('someColumInPivot', 'someOtherColumnInPOivot');
	+ 	}
	+ }
	
	+ $contact = Contact::first();
	+ $contact->users->each(function ($user){
	+ 	$user->pivot->someColumInPivot;
	+ });
	
There is also some polimorphic connections but we aint gonna go there since it is extramly complex and i am not sure that 
i undestand it nor do i think i can explain it


OK lets go on with this hell of tremendous amount of informations, we are not jet done
What if child table gets updated, you want parent to be updated to so you do something like this

//greeting Model
	protected $tuches = ['writer']; 	//meaning update writer updated at if this gets updated

	+ public function writer(){
	+ 	return $this->belongsTo(Writer::class);
	+ }
	
	
Important note, when you call this $writer->greeting, it will be that monent that calls database query ok
So what if we ahve a lot of writers and want their greetings
SO if you go throw foreach like

	+ foreach($writers as $writer){
	+ 	$writer->greeting //always call query to get greeting
	+ }
	
thisa bove is called lazy loading, but whati fi we want to have greetings already preloaded ok


	+ $writers = Writer::with('greetings')->get();
	
So now we will get all the greetings with all the writers, join query will be called instead of calling query each pass throw
foreach

This thing above is called eager loads.

So many information, some of them unneccecery. There were even morem but i have skipped some.

If you want to eager load some data with filtering something


	+ $writers = Writer::with(['greetings' => function ($query){	
	+ 	$query->where('body', 'Lokosy Body');
	+ }])->get();

So now you will eager load only the writers with greetings that have body lokosy body


EVENTS

We will talk mora about events later in this stupid tutorial but lets just show some functionality

Ok how about we fire an event whenever writer is created we should do something it will go like this
//App/Providers/AppServiceProvider.php

	+ public function boot(){
	+ 	Writer::creating(function ($writer){
	+ 		//SO SOME CODE HERE
	+ 	});
	+ }

it goes like this
MODEL NAME :: EVENT NAME and that is how it works

__________________________________________________________________________________________________
** FRONT END COMPONENTS

You need to have NPM installed. THen run in console
	:npm install
After that run
	:npm run dev
	
OK now laravel has all set up for you. It used laravel MIX. 
It is a package that can: 
	- concatenate all css files in one.
	- concatenate all js in one file.
	- compile js if neccecery
	- compile css if neccecery
	
Ok open main config file
//webpack.mix.js

Comment out the thing i have commented out out and add following

	+ mix.styles('resources/css/dime.css', 'public/css/all.css').sourceMaps().version();

	+ mix.scripts([
	+ 	'resources/js/dime.js',
	+ 	'resources/js/dime2.js',
	+ ], 'public/js/all.js').sourceMaps().version();
	

OK inside resources/css create css file called dime.css and isnde it put some css whatever you want
Also make 2 js files in resources/js called dime.js and dime2.js and put some js in them

OK now run 
	:npm run dev
	
Mix will take dime.css and put it inside all.css and all.css will put in public/css folder 	
also 2 script files will be putted in all.js and all.js will be moved to public/js

So why do we have sourceMaps nad version ??
SourceMap is added so that we can see how the real file looks like whn you click on view source or or inspect element
if you ommit that you will just see a blob of data ok.

ANd why do we use version(). So that whnever you include that css inside some template we append version id to the file
If something is changed, brawser will give us new version of the file, cashed version will not be used anymore. Since 
explorers cash css and js files.

This is now how you include those files in templates
//template writerControlPanel.blade.php
	+ <link rel = "stylesheet" href="{{ mix('css/all.css') }}">
	+ <div class = "lokosi"> asd </div>
	
If you are working with frontend libraryies then you are probably going to researhc all htese thingies.
i will just tell you that you can type in console something like this

	:php artisan preset react

And laravel will prepare for react	

!! PAGINATION !!

This is one of the most common things in all the online systems, pagination
// app/http/controllers/WriterController.php
	+ use Illuminate\Support\Facades\DB;
	 ...
	+ $paginationGreeting = DB::table('greetings')->paginate(5);
	 ...
	+ 'paginationGreeting' => $paginationGreeting,
	
And inside template
//writerControlPanel.blade.php
	
	+ <h4> Pagination </h4>
	+ <div> {{$paginationGreeting->links()}}</div>
	+ <br >
	+ <hr/>
	+ @foreach ($paginationGreeting as $greeting)
	+ 	<div> {{$greeting->body}}</div>
	+ @endforeach	

lets review. In the controller we have created a request to the db to get the 5 
greetings and to put them in a class called paginator. Meaning paginate will return class paginate
This paginate class has function links that will generate links, and if you foreach throw it it will go throw those 5 greetings

If you take all the greetins from db like paginate->(50000) method links will return empty string
If you do not want to use eloquent pagination then it is best to consult with documentation on how does
pagination class work


ON the every view there is a empty var called $errors it has mehtod any() to see if there are some errors 
remember this for later


LOCALIZATION or LANGUAGE TRANSLATION

go to template
//writerControlPanel.blade.php

	+ <h4>LANGUAGE: word hello - @lang('main.hello')</h4>

this @lang('main.hello') could have been written like this
	+ {{__('main.hello')}}	
	
Or like this 
	<?php echo __('main.hello');?>
	
OK what will this do ??
First you need to have to set what is the current locale and you do that like this	App::setLocale('es');
//WirterCOntroller.php

	+ use App;
	...
	+ App::setLocale('es');
	
You can probably put this App::setLocale someware else, like in appServiceProvider or someware else ok

What will this do. well first you need to create a folder 'es' inside  resources lang
//resources/lang/es

Ok inside this create a file called main
//resources/lang/es/main.php
	
	+ <?php
	+ 
	+ return[
	+ 	'hello' => 'HOLAS MUCACOS',
	+ ];

OK so now you have a file called main and inside of it there is an array that has a key hello.

Ok you have set locale to 'es' using App::setLocale('es'); and you have sait @lang('main.hello')
This will happen. Laravel searches for folder es in lang and inside that folder serahes for file main.php

inside of it it expects an array that has a key 'hello' and returns value under that key and that is that

__________________________________________________________________________________________________
** COLLECTING AND HANDLING FORM DATA (USER INPUT DATA)


All the data that is submited, nomether where from will be inserted in the Request object 
You have following options to access it
- Illuminate\Http\Request		// injecting it in the methods
- request()						// helper - accessable like almouste anyware
- facade i presume Request:: 

Lets make 2 pages, one to have a form, and one to accept that form
//web.php
	+Route::get('/form-example', 'FormExample@index')->name('form-example'); 
	+Route::post('/form-example-post', 'FormExample@post')->name('form-example-post'); 
	
We need controller
	:php artisan make:controller FormExample
	
//FormExample.php controller

	+ public function index(){
	+ 	return view('form_example');
	+ }
	
	+ public function post(Request $request){
	+ 	echo 'we will work in here';
	+ }
	
We also need the view that we have noted above "form_example"
// form_example.blade.php

	+ Form example testing
	+
	+ <form method = "POST" action = <?php echo route('form-example-post') ?>>
	+	<input type = "text" name = "first_name">
	+	@csrf
	+	<br />
	+		
	+	<input type = "text" name = "last_name">
	+		
	+	<br/>
	+	foreign <input type = "radio" name = "localization" value = "foreign">
	+	domestic<input type = "radio" name = "localization" value = "domestic">
	+		
	+	<br/><br/>
	+	<select name = "status">
	+		<option value = "Dr.">Dr.</option>
	+		<option value = "Dr. Spec.">Dr. Spec.</option>
	+		<option value = "Dr. Mr. Spec.">Dr. Mr. Spec.</option>
	+	</select>
	+		
	+	<br />
	+	<br />
	+	<input type = "submit" name = "submit">
	+ </form>
	
OK so now we need migration for those doctors so that we cane make a table yes

	:php artisan make:migration doctors
	
Now go to this migration
//migrations/some_number_doctors.php	
	
	+ public function up()
    + {
    +     Schema::create('doctors', function (Blueprint $table){
	+ 		$table->increments('id');		// this is primary key and autoincrement and unsigned
	+ 		$table->string('first_name', 128);
	+ 		$table->string('last_name', 128);
	+ 		$table->string('localization', 128);
	+ 		$table->string('status', 128);
	+ 	});
    + }

    +  public function down()
    +  {
    +     Schema::dropIfExists('doctors');
	+ 	
    + }
	
Run this migration
	:php artisan migrate
	
One more thin we need and taht is Eloquent model for doctors

	:php artisan make:model Doctor


Now you shoud see new table - called doctors and new Eloquent model class Doctor. 

Now we have all that we need to start this chapter ok
Ok now when you click ubmit lets go to the controller
//FormExample.php controller

	+ public function post(Request $request){
	+	echo '<pre>';
	+		print_r($request->all());
	+	echo '</pre>';
	+ }
	
	
$request->all() 

Gets all the datafrom the form and puts it in the array, you can pass that data to eloquent in order to save all data 
inside database as we have already discussed

$request->except('_token') 

Creates the same array as the one above except the token

$request->only('first_name') 

Understandable only first name

if($request->has('first_name') ){...}

You can test if inside request we have first_name and then act apon that info

OK but what is the most familiar way of accessing data for us. It is this

$request->input('first_name', "Default first name") ;

You can check wheter it is POST GET or whatever method using

$request->method() //returns method

$request->isMethod('GET') //returns true if method is GET

OK you know how some forms have these
// some view
	+ <input type = "text" name = "doctor[0][first_name]">
	+ <input type = "text" name = "doctor[0][last_name]">
	+ <input type = "text" name = "doctor[1][first_name]">
	+ <input type = "text" name = "doctor[1][last_name]">
	
You can easily access them like this
//some controller
	+ $request->input('doctor.0.first_name') 	// gets the name of the first doctor
	+ $request->input('doctor.*.first_name') 	// gets all first names
	+ $request->input('doctor.1')				// gets array like first_name => 'Lokosi'	last_name => "Kobra" values correspond to second doctor
	
	
Ofocurse if you make api, you are probably going to receive json to the post page yes
And here is how you acess it. Imagine you have this JSON
// SOME JSON
	
	+ {
	+ 	"first_name" : "Lokosi",
	+ 	"last_name" : "Kobra",
	+ 	"son":{
	+ 		"first_name" : "Lokosi J.",
	+ 		"last_name" : "Kobra",
	+ 	}
	+ }
	
// some controller
	$name = $request->input('first_name');
	$sonName = $request->input('son.first_name');
	
Instead of input when JSON is in use, it is better to use ->json() with these paramters, since if content type is not set 
correctly json will still work

URL manipulation
www.some.com/part1/part2?lokosi=kobra&masters=skeletor
ok this is an url for manipulation ok

	+ $request->segments() // will return 'part1', 'part2' or probably 'part2?lokosi=kobra&masters=skeletor' not sure try it
	+ $request->segment(1) //will return part1 (NOT PART 2)


File uploads, lets update our form to accept files

You can check if file is uploaded like this
	+ $request->hasFile('image')		// check if file is uploaded
		
	+ $request->file('image')->isValid() //does what was done above except that it also checs if the file is valid somehow
	
Other options
	
	+ $request->file('image')->store($where) 	// to save the file
	+ $request->file('image')->storeAs($where, $newName) // to save the file
	+ $request->file('image')->getMimeType() 	// gets mime type
	.. there are a lot more
	+ $request->file('image')->getRealPath()	//TO GET THE FILE which is most important :D


Now it is time to validate the input. THe easiest way is via validate
//FormExample.php controller
	+ $validated = $request->validate([
	+ 	'first_name' =>'required|max:128',
	+ 	'last_name' =>'required|max:128',
	+ ]);
		
// form_example.blade.php
	+ @if ($errors->any())
	+ 	<div class="alert alert-danger">
	+ 		<ul>
	+ 			@foreach ($errors->all() as $error)
	+ 				<li>{{ $error }}</li>
	+ 			@endforeach
	+ 		</ul>
	+ 	</div>
	+ @endif

And if first_name is missing, you will get generic message like first_name is missing
But what if you do not want to have generic messages ok. you do not wnat first_name to be displayer ok
Then you make rules and messages separatly
Here is a complex way of validating forms
//FormExample.php controller

	+ $rules = [
    +     'first_name' => 'required',
    +     'last_name' => 'required',
    + ];

    + $customMessages = [
    +     'required' => 'The :attribute SHALL NOT STAY BLANK. Fly you fools'
    + ];

	+  $this->validate($request, $rules, $customMessages);
	
OK so this is much cooler right ? just submit empty form and yo will see.
But lets go one step further

	+ $customMessages = [
	+	'first_name.required' => 'You have not provided your first name, are you from another planet ?',
	+ ];

So look at that, if the first_name is not provided give back this message :) This way you have apsolute control over messages
Now, some values need to be somehow specific like 
	+ use App\Rules\notBielzabab;
	..

	+ $rules = [
    +     'first_name' => new notBielzabab(),
    + ];
	
We will require frst name but it must not be bielzabab ok, this is a custom rule ok
Make a new rule

	:php artisan make:rule notBielzabab

new rule is created
//app/Rules/notBielzabab.php

	+ public function passes($attribute, $value)
    + {
    +     //
	+ 	return $value != "Bielzabab";
    + }
	
	+ public function message()
    + {
    +     return 'Bielzabab is not allowed to join our server.';
    + }


Ok ok. this is all great. but what if we are want to generate an error and send it back, and that error is not strictly
conencted to a form input. like bad email and missing name. What if the error is like somethin in the excel file is missing
the file is ok, but the data inside of it is not good ok ?

We do that using message bags
//FormExample.php controller
	+ use Illuminate\Support\MessageBag;	
	...
	+ $errors = new MessageBag();
	+ $errors->add('MyOwn', 'MY PRECIOUS');
	+ return redirect()->back()->withErrors($errors);
	
OK that is that. you are now sending errors back with message bag

There is one more customization that you can do (probably a lot more, i do not know, but you do not have to do them)
//FormExample.php controller
	+ $messages = [
	+	'errors' 	=> ['First error','Second error'],
	+	'mesages' 	=> ['First message','Second message']
	+ ];
	
	+ $errors = new MessageBag($messages);
		
	+ return redirect()->back()->withErrors($errors);
	
	
Preatty similar yes, but now you can do something like this
// in form_example.blade.php
	+ @if ($errors->has('mesages'))
	+ 	<div class="alert alert-danger">
	+ 		<ul>
	+ 			@foreach ($errors->get('mesages') as $error)
	+ 				<li>{{ $error }}</li>
	+ 			@endforeach
	+ 		</ul>
	+ 	</div>
	+ @endif


	+ <?php
	+ 	if($errors->has('mesages')){
	+ 		var_dump($errors->get('mesages'));
	+ 	}
	+ ?>
	
as i said before there are more options but i am not sure how will you get acosutmed to them one of those is 

FORM RQUEST object that is created like

	:php artisan make:request CreateCommentRequest

If you want you can go and research thsi, but i did not wanted, since it works like it detects some strings someware
and calls itself so i did not liked that	


OK so far we have been validating, now we need to save that data inside

Mass asigment - You already know that
//some controller

	+ $newGreeting = Greeting::create($request->all());
	
Ofcourse this will not work we need to have something that will tell laravel what to save

we have 2 options that you have already seen, just add one of those 2 arrays to eloquetn model

	+ protected $guarded = ['writer_id'];	// will not write to writer_id ion database even if it is in request	
Or 
	+ protected $fillable = ['body'];		// will take only body from request

You can also double protect 

	+ $newGreeting = Greeting::create($request->only([
	+  'body'
	+ ]));
	
Already we have talked about this but here it is again
imagine we have $dangerousText = "<! input !>"; So we would like to escape those characters
just put it in those breckets

	+ {{ $dangerousText }}		// this will do somethin like echo htmlentities($dangerousText)
	+ {!! $dangerousText !!}	// this will do somethin like echo $dangerousText without any escaping
	
	
__________________________________________________________________________________________________
** ARTISAN AND TINKER

Most of this chapter you already know

Here are some that yo might find usefull

	:php artisan clear-compiled 		//this will remove cash of some compiled files, 

remeber good the command above for sometimes you can chane some classes but changes are not being affected. so run this and all 
will be ok
Similar to above

	:php artisan optimize


OK lets move on to

	:php artisan down	//app in maintnance mod
	:php artisan up		//app turn on

	:php artisan preset			// shoud be something like to change to react or vue, connected to frontend. I am not 100% sure
	:php artisan serve			//makes a server on specific port (localhost:8000) so you can play around

	:php artisan tinker		// shows tinker REPL that will be covered soon
	
Now lest show you something that you will not use
All these command can probably go with folloowing 

	-q	//do not show output
	-v -vv -vvv //like how much of a detail report you would like regarding the command never used ever
	--version  --env	// as the word says.
	
I do not know maybe somebody like usses this so that he can be cool. Or to get better salary if possible
Maybe i am just amateur do not know.	

OK lets review some more of the thing you will never use, not only never use but some of them are strongly not recomended
only like if you are realy in to laravel like you are merried to it.

	:php artisan app:name MyAppName //fucks up your laravel installation so that you can not use it normaly anymore
	
	:php artisan auth:clear-reset	// fulshes expired passwords
	
	:php artisan cash:clear		
	
	
OK here is one that you will actualy use ok ahahahha
WHen you take laravel from git or hoever you are probablu not going to have specific key for session cripting purposes or similar
You will then have to run

	:php artisan key:generate	//this will generate key in .env file and you will be good
	
You alreaduy know 

	make:

And

	migrate:

here are some more that you will not use!

	notifications:table		//generates table for writing notifications inside
	route:list				// this is coole, you will be able to list all the routes that you app is currently using
	schedule				// for crons will be covered later
	session:table			//creates table for sessions, it is a good idea to have sessions i the table
	
Views are also cahsed, if cahsing is truned on ofcorse
if you want to clear the cash do this

	:php artisan view:clear	//and now views are cleared
	
You can write custom command of course but came on, if you get there i say good for you :) 
I am almoust 100% sure that if you get to need to write custom commands, you are probably going to move to
pyton or java or c# just kidding maybe it is like woow

TINKER

One more thing that you will not use is tinker how wonderful :) 
It is realy cool, i mean like what it does. But it is usless for me. Maybe you are like laravel hasbant and you think it is cool

Lets look at it

in console you type
	:php artisan tinker
	:$user = new App\User;
	:$user->email = 'lokosi@gmai.com',
	:$user->pass = bvrypt('superSecret');
	:$user->save();
	
And now you have a new user.

One more interesting thing that you probably wont use is dump($some_var). If you use it in a code 
it will print out in the console that variable so that you can review it there


__________________________________________________________________________________________________
** USER AUTHENTICATION AND AUTHORIZATION

This is by far the most important and fun part.
We need to return those migrations that we deleted in the begining. Hope that you have saved them

Before you run migrate. go to user migration and reset password migration and change this
// user migration
	+ $table->string('email')->unique();
		to
	+ $table->string('email', 64)->unique();
//password reset migration

	$table->string('email')->index();
		change to
	$table->string('email', 64)->index();
	
Default email would be to long for the unique field, i belive you can change it als oto 128
now run
	
	:php artisan migrate
	
You will get 3 new tables (or 2 depends if you got also the failed_jobs migration)	

This laravel does not come with user authentification package imidiatly so we need to install it

	:composer require laravel/ui "^2.0"
	
This will install packages required for user authentification, you need to set "^2.0" since we are using laravel 7, 
if you have installed laravel 8 than maybe you would not have to use this "^2.0"

We now create routes, we will use bootrap css package, since we do not use vue or react for this instance


	:php artisan ui bootstrap --auth	// this will make pages like login and all, you probably do not need 
	
you could have ofcourse instad of bootstrap used vue ot some other, but we will not

	
Now we need to run 
	
	:npm install
	:npm run dev
	
Since this will get us the bootstrap and jquery or other thing that we need to have for us	
	
OK we are ready to take a look at the login pages etc
We need t type one important thing in routes
//web.php

	+ Auth::routes();
	
this will put all important routes like login register and such

in console type

	:php artisan route:list
	
Now you will see a list of pages that are connected to the user authentification
And if you go to login page you will see login, up above you will see register page, you have remember me and forgot password
all is already prepared for you.
Lets try it out lets register. Afeter the registration you will be imidiatly logged in. You can logout, and login again
It works

OK there are 2 user classes one is 
//App/user Eloquent
That is classic Eloquent but it extends Authenticatable 
And that Authenticatable is actlualy parent user class 

If we take a look at the child user class (Eloquent - user class) you will see

    + protected $fillable = [
    +     'name', 'email', 'password',	//only allow these table 
    + ];

	+ protected $hidden = [
    +     'password', 'remember_token',	// if user is requested via json do not return password and remeber token
    + ];

In folder
//vendor/laravel/framework/src/Illuminate/Foundation/Auth/User.php
Ther is a user class a parent class of the eloquent User class or so to say MODEL, 
so Parent user class extends model and child user extends parent user, so child is also a model eloqutent
If you might have wondered that :D
If you take a look at the parent usr class from the folder above

	Authenticatable  	//allows the class to be authentificatable meaning to be able to log in :D
	Authorizable		// to be able to check wheteer an authetificated user can do something or not
	CanResetPassword	// self explanatory
	MustVerifyEmail		// self explanatory
	
These are the traits that our parent user class has, And as you can imagine if you would to extend this class with some 
class of your own, this class will be able to do all of that

We will demontrate all of there fucntionalitis 
First lets show the auth() helper

	auth()->check()			// to see if user is logged in anyware in the app
	auth()->guest()			// to see if user is not logged in
	auth()->viaRemeber() 	// to see if the user has logged in using remember
	
Leets start with examples. 
Make a new page 
//web.php

	+ //page to have access without authentification
	+ Route::get('/logi-test-home', 'AuthenticatedExampler@index')->name('login-test-home');
	+ //page to be accessed only if you are authentificated
	+ Route::get('/logi-test-authenticated', 'AuthenticatedExampler@authenticated')->name('login-test-authenticated');

We will not work with views now, no nead for the demonstration

	:php artisan make:controller AuthenticatedExampler

// AuthenticatedExampler.php controller index()


	+ public function index(){
	+ 	echo '<h2>HELLO TO ALL THAT HAVE ENTERED HERE</h2>';
	+ 	echo '<br />';
	+ 	
	+ 	if(auth()->check()){
	+ 		echo '<h4>USER IS AUTHENTICATED</h4>';
	+		$user = auth()->user(); 
	+		var_dump($user);
	+ 	}
	+ 	
	+ 	if(auth()->guest()){
	+ 		echo '<h4>USER IS JUST A GUEST</h4>';
	+ 	}
	+ }

you might wonder how does these things work, like password reset, ligin etc
Well inside http /controllers/Auth are controllers that do all those things for 
Those are
(just a note a bit of theory that you will foreget forever, you can easily skip this theory)

***THEROY
	RegisterController // To create a new user
	
	validator() method 	-> it check wheher you have provided adequate data for the new user
	create method		-> inserts new user in to database

	TRAIT -> RegisterUsers			// use RegisterUsers
		It is a trait that provides a page where users register on the URL "register" 
		This page returns view/auth/register.blade.php
		If you want to change what is displayed to the users you can overridere
		
		showRegistrationForm() method and do whatever you want
		
		register()		method, passes the data from the form to the validate and create methods
		
		redirectPath() 	method, pushes successfuly registerd users to a redirect page 
	
	LoginController
		
	Allowes logins It has redirectTo property that allows you to change where to redirect
		
	TRAIT -> TRAIT AuthenticatesUsers 
		it shows the login Form, validates login doesthrotling redirects after succesfull
		showLoginForm()	displays view auth.login view to dislpay login page
		login() accepts post data from login form oushes data to validateLogin()
		redirectPath()	where to redirect
		
		Imprtant authenticated() method is called after successfull login so you can perform diferent
		things here after successful login
		
	TRAIT -> ThrottlesLogins
		If you decide to use this trait it will start checking how manu times somebody has tried to login etc
		It limits to 5 attempts per 60 seconds
		
	ResetPasswordController
		pulls
	TRAIT -> ResetPasswords trait
		This shows reset password view
		
	ForgetPasswordController
		pulls
	TRAIT -> SendsPasswordResetEmails
		it shows auth.passwords.email
	VerificationController
		verifies emails usin VerifiesEmails trait
***END OF THEORY		

Ok how the fuck do we use this at all :D we will try to do it all 

In order for pages to work you need to add
//web.php
	+ Auth::routes(); // dislpays all the neccecery routes to web.php
		
After that if you type
	:php artisan route:list 

you will see all the new routes that were defined and are now working

instead of Auth::routes()  if yo want the registerd users to verify their email addresses 
you will use follwoing two things

//web.php
	+ Auth::routes(['verify' => true]);
	
//User controller
	+ class User extends Authenticatable implements MustVerifyEmail //added implements MystVerifyEmail
	
I did not try this since i do not have mail account, but you shoud try	

You can also do something like this
 //web.php
	+ Auth::routes(['register' => false, 'reset' => false]);
	
So no more registration links, you need to add users by yourself, and reset password is not available anymore	

REMEMBER ME
you have already installed new module called laravel ui, in order to have all of the above, 
so this new module is located in 
//vendor/laravel/ui
if you look at the file
//vendor/laravel/ui/auth-backend/AuthenticatedUsers
You will see

	+ protected function validateLogin(Request $request)
    + {
    +     $request->validate([
    +         $this->username() => 'required|string',
    +         'password' => 'required|string',
    +     ]);
    + }
	
lets change this to this b
	+ use Illuminate\Http\Request;
	 ...
	+ protected function validateLogin(Request $request)
    + {
	+	exit('NO MORE LOGIN BITCH -> but from login controller');
    + }

Ok now there is no way for you to login. you will get just a text that says no more login bitch. 
Ok now copy paste this code to, and file AuthenticatedUsers.php return to what it was originaly

// controllers LoginController.php 
Now when you try to login you will get message "NO MORE LOGIN BITCH but from login controller"
___
Now lets make this login to use remeber me (this is already working). We need to have remeber_token in user table or similar
	// LoginCOntroller.php
	
	+ protected function attemptLogin(Request $request)
    + {
    +     return $this->guard()->attempt(
    +         $this->credentials($request), $request->filled('remember')	// to make checkbox remeber me work
    +     );
    + }
	
Code above  will make remeber checkbox work, if you remove that part, remeber will not work anymore
Try it out by turning of brawser and gogin to /login-test-home without logging in realy, and you will be loged in
What is realy cool is that you can use

	+ auth()->viaRemeber() // to see if the user has logged in using remember
	
Remeber authenticated method up above in the theory. just copy paste it to our
// LoginController in controllers

	+ protected function authenticated(Request $request, $user)
    + {
    +     exit('You are authenticated now we wil lsee who you are and redirect you where you shoud go ok');
    + }

Now when somebody logs in, you can see if it is admin or something else, and then redirect him someware where you want.
	
You can manually authenticate users with code like this:

	+ auth()->loginUsingId(5);	// this will automaticaly log in user with id 5
	+ auth()->login($user)		// if you have before the got it somehow
	+ auth()->once(['username' =>'some username'])	// login user with user name for just this page, after reload it is loged out
	+ auth()->onceUsingId(4)	// same as above only once but with id
	
Log the user out is easy as this
	+ auth()->logout()


AUTH middleware, 
remeber middleware, we talked about it before. Remeber signed middleware, where yo can access the page 
only if you have signed in query string

	+	Route::get('invitation/{invitation}/{answer}', 'HelloWorldController@invitation')
	+	->name('invitations')
	+	->middleware('signed');
	
So this page can not be accessed you do not have neccecery data in url	
You can instead of signed write:
	
	+ ->middleware('auth')	// only for authenticated users
	+ ->middleware('guest')	// only for guests
	+ ->middleware('verified')	// only for users that have verified their email adresses
	
Best thing to do is something like this

	+ Route::middleware('auth')->group(function (){
	+ 	Route::get('some-page', 'SomeController@index');
	+	Route::get('some-page2', 'SomeController@index2');
	+ });
	
Now we have several pages available only for authenticated users
Inside login controlelr you have 
//LoginController.php
	+ protected $redirectTo = RouteServiceProvider::HOME; 
	
just change it to where you want to return if user is not authenticated


Remeber when we tried if(auth()->check()), well you can do that also inside blade templates, but cleaner
// some blade template view
	+ @auth
	+ 	// some code
	+ @endauth


	+ @guest
	+ 	// some code
	+ @endguest
	
THere is something in laravel called guard, that will be explaned below, but with those guards you can do something like this
Jsut for the note, you will not use guards probably.

	+ @auth('admin')
	+ 	// some code
	+ @endauth('admin')

*GUARDS	
---THEROY	
OK now what are guards ?? 
Guard is an option to have to tables holding diferent users, like bosses and eployees. Two diferent tables
But both of them can be authenticated by validating against each database table
bosses authenticate ahainst table bosses
and 
employees against employees table

So if the employee is logged in you can follow up on that and see if employee is the current active user throwout app etc.
THIS IS NOT used for like diferentiating 

Guard is something like user class ok. User class consists of 
driver: how do you keep user authenticated via session or via tokens
provider: WHere is user in database or where mysql mongo db or other?
YOu can change default guard so that for example session is saved in database or similar
There are 2 guards when we install laravel
WEB -> driver session provider users(mysql) i think :D
API -> driver token provider users(mysql) i think :D

Default is web
---END OF THEORY	
//config/auth.php
In this file you can find those guards.
Those guards are actually used to like have two compleatly diferent "user" classes that login against diferent tables
This is not something that you will do to diferentiate between admin and office users
Like
	
	inside guards
	
	+'web' => [
    +    'driver' => 'session',
    +    'provider' => 'office',
    +],
	
	
	
	inside providers you can add
	
	+'office' => [
    +    'driver' => 'eloquent',
    +    'model' => App\Office::class,
    +],

And nw you have new provider office
We are not going to go throw these guards butr will jsut show you how this is done

Now that you have all of these options you can do something like this

	Route::middleware('auth:office')->group(function() {
		// and now these routes are only for office loged in users
	})

Still you will use those guards usualy if you have FOR EXAMPLE a lot of subdomains and each subdomain has some users etc. 
Probably you will not use those guards most of the time. Maybe sometimes.
Still i did not wanted to waste your time any more with guards

*END OF GUARDS	

Now authorization and roles in laravel. Lets see if this is going to allow us to make distinction between admin and office heheh
Admin and roles goes throw Gate facade

We are gogin to test all of this by creating orders table and inside orders table we will have user id
ok lets create migration for order table

	:php artisan make:migration orders
	
Ok now lets alter the file
//migrations some numbers_order.php

	+ public function up()
    + {
    +     Schema::create('orders', function (Blueprint $table){
	+		$table->increments('id');		// this is primary key and autoincrement and unsigned
	+		$table->unsignedInteger('user_id');
	+		$table->string('from', 128);
	+		$table->string('to', 128);
	+		$table->timestamp('created_at')->useCurrent = true;
	+		$table->timestamp('updated_at')->useCurrent = true;
	+		$table->foreign('user_id')->references('id')->on('writers');
	+	});
    + }

    
    + public function down()
    + {
    +   Schema::dropIfExists('orders');
    + }
	
And lets migrate it

	:php artisan migrate
	
We should now see a table orders that is conencted to users via foregin key	

Now we need Eloquent Database model for these orders ok

	:php artisan make:model Order
//file created in app Order.php

Now we have it ok :D Nothing to do with it we just have it.
We need order controller and since orders could be deleted updated etc we will create resource controller

	:php artisan make:controller OrderController --resource
//file created in app http controllers OrderController.php	

Now we also need web routes to test all of the functionality

//web.php

	+ Route::resource('order', 'OrderController');

We adde only one link inside web.php. This is because this link above will generate for us the following links
	order
	order/create
	order/update
	etc..

So that we do not have to do it. Go and populate orderController controller methods and you will see that it works
Now we need to have a form, on that page but wait we do not want anybody to create orders, only authentificated users
but lets leave that for later. First lets make form for adding orders
make index method return a view
But first make a view in views/orders/order.blade.php so create new folder ofcourse
//views/orders/order.blade.php
	+ hello
	
Ok now 
//OrderController
	+ public function index()
    + {
    +     return view('orders.order');
    + }

Ok now when you go to /order you will see hello

Go back to orders.blade.php and make a form that will submit to orders/store
//view orders.blade.php

	+<h4> Insert order form </h4>
	+<form method = "POST" action = "{{ url('order')}}" >
	+	@csrf
	+	
	+	<input 
	+		type = "text" 
	+		id = "from" 
	+		name = "from" 
	+		placeholder = "from" 
	+		value="{{old('from')}}"
	+	>
	+	
	+	<br />
	+	
	+	<input 
	+		type = "text" 
	+		id = "to" 
	+		name = "to" 
	+		placeholder = "to" 
	+		value="{{old('from')}}"
	+	>
	+	
	+	<br />
	+	
	+	<input type = "submit" name = "submit">
	+	
	+	<br />
	+</form>
	
	+<h4> ERRORS IF ANY</h4>
	+@if ($errors->any())
	+	<div class="alert alert-danger">
	+		<ul>
	+			@foreach ($errors->all() as $error)
	+				<li>{{ $error }}</li>
	+			@endforeach
	+		</ul>
	+	</div>
	+@endif

Now we will save that data go to controller OrderController.php
// OrderController.php store function
You might wonder WHY does form order has action to orders action = "{{ url('order')}}". You need to take a look
at the rooutes in console using php artisan route:list and you will see that on order page is also a 
lonk wth post fucntionality
//OrderController.php
Please take a look at the routes using php artisan route:list and you will see that on link order we expect get AND post also

Post on the order link is associated with store method 
// orderController	 store method

We want to allow people to try to insert new order, but if they are not authenticated then do not allow them to
but still let them see ok
	

	+public function store(Request $request)
    +{
    +    if(!auth()->check()){
	+	    $messages = [
	+			'Authenticated user is requred'
	+		];
	+		
	+		return redirect()->back()->withErrors(new MessageBag($messages));
	+   
	+	 } else {
	+		
	+		$rules = [
	+			'from' => ['required'],
	+			'to' => ['required'],
	+		];
	+		
	+		$customMessages = [
	+			'from.required' => 'You need to insert buyers name in form filed',
	+			'to.required' => 'You need to insert receiver name in form filed',
	+		];
	+		
	+		$this->validate($request, $rules, $customMessages);
	+	}
    +}

How about the rule. No shipping to a place called London so if to is london lets not allow that

	:php artisan make:rule NoLondon

//NoLondon.php

	+ public function passes($attribute, $value)
    + {
    +     return $value != "London";
    + }
	
Now from the file above just update rules
	+
	
	+ $rules = [
	+   'from' => ['required', new NoLondon],
	+   'to' => ['required', new NoLondon],
	+ ];

So now London will not be allowed to be inserted anuware

OK now we want to have the ability so that only some specific users can do some specific stugg ok like insertig orders ok
For that we need authorization rules ok and they are usualy done via somethig called Gates
go to AuthServicePreovider
//app/providers/AuthServiceProvider.php	boot 
We will make one most simple rule
in the boot method below registerpolices add

	+ Gate::define('user-id-low', function ($user){
	+ 	return $user->id < 200;
	+ });

First var in the function is always user
	
	
And now we have a rule that will check whether the user id is lower then 200
Letc test that ok go back to 
// orderController	 store method
we will add more options
but jsut for short here is how you will use it
	+ Illuminate\Contracts\Auth\Access\Gate
	
	+ Gate::allows('user-id-low'){
		//OK now we do somethin like for example
		Gate::define('user-id-low', function ($user){
			return $user->id == 2;
		});
	}

You see how we used this, we didnt insert user just the name of the key 'user-id-low'
lest try it out
// OrderCotrnoller

	+ else if(Gate::allows('user-id-low')){
	+ 	
	+ 	$messages = [
	+ 		'user id is not adequate'
	+ 	];
	+ 	
	+ 	return redirect()->back()->withErrors(new MessageBag($messages));
	+ }
	
	
OK if you have tried that and it works, that is cool. Now it is time to make user roles from bottom to the top. All from scratch
We will create user roles using gates and middleware.
We already have all that we need inside laravel
We will create a page where you can see all the users and edit their roles ok
We need UserController 

	:php artisan make:controller UserController --resource 
	
lets open our user controller
// controller UserController.php

	+public function index()
    +{
    +     return view('admin.users.index');	//we currently do not have that view
    +}

create foders and files liek this
//views/admin/users/index.blade.php
	
	+hello
	
Test the page and if all is ok and you see hello

Lest go back to controlelr UserController and add users to var that we will will return to the view
// controller UserController.php
	+  use App\User;
	...
	+ public function index()
    + {   
    +      return view('admin.users.index')
	+		->with('users', User::all());	// should not use all ofcourse better to be more specific what data you want
    + }
Now our view has users in it lets diplsay them in our index.blade.php 
//index.blade.php

	+<h1> USERS </h1>
	+<table style = "width:80%">
	+	<tr>
	+		<th>NAME</th>
	+		<th>EMAIL</th>
	+	</tr>
	+	
	+	@foreach($users as $user)
	+		<tr>
	+			<th>{{$user->name}}</th>
	+			<th>{{$user->email}}</th>
	+		</tr>
	+	@endforeach
	+</table>
	
(
	i do not do css or something else frontend related so enjoj my inline css and be happy or i will find you !!! :D
	Just kidding
	OR AM I !!!?
	ahah yes i am
	OR MAYBE NOT :D
)
	
One neet thing that you can do in laravel inside controller is that you can add middleware in controller contructor method
meaning that all the methods inside this controller will have to obey those rules
Like
//userController.php
	+public function __construct(){
	+	$this->middleware('auth');	// onlu if you are authenticated you can use methods below ofcoruse
	+}
	
Now you need to be logged in in order to access anything from UserController
Ok that is that regardign the panel for user, now we need to add roles.
And roles will be in a separated table many to many relation
Lest start with the model

	:php artisan make:model Role -m
	
So what is cool in here see this -m flag it will aslo create a migration called role :)
GO to the roles table migration
// migration create_roles_table	
// upt method

	+ Schema::create('roles', function (Blueprint $table) {
    +   $table->bigIncrements('id');
	+ 	$table->string('name');
    +   $table->timestamps();
    + });
	
So we have table roles. We also need a pivot table that will connect roles and our users
There is a rule for naking pivot tables. and if we abay by that rule laravel will recognize the table 
and do all that is needed for us automaticaly

	:php artisan make:migration create_role_user_table

// now populate up method of create_role_user_table migration
	+ public function up()
    + {
    +    Schema::create('role_user', function (Blueprint $table) {
    +       $table->bigIncrements('id');
	+		$table->integer('role_id')->unsigned();
	+		$table->integer('user_id')->unsigned();
    +       $table->timestamps();
    +    });
    + }
	

Now lest create all those new tables ok. We have two migrations roles and role user 
	:php artisan migrate
	
Ok now we have our 2 new tables roles and role_user (see role_user table is not in plural)
You have already registered one user. Register some more users.
Add some roles in the table manualy like admin, office...
Adn connect them manualy in the pivot table role_user.
put something like user_id 1 role_id 1
put something like user_id 1 role_id 2
And something that is logical ofcourse. We are not going to write factory models for this it will be more of a waste of time

Now that we have all that we need to connect our roles and users using 
// Role model
	+ use App\User
	
	+ public function users(){
	+ 	return $This->belongsToMany(User::class);
	+ }
// User model	
	+ use App\Role

	+ public function roles(){
	+ 	return $This->belongsToMany(Role::class);
	+ }
	
OK now It is time to display those roles ok on the view page
//index.blade.php
	aadd to header
	
	+ <th>ROLES</th>
	
	Add below toresults
	
	+ <th>{{$user->roles()->get()->pluck(['name'])->implode(', ')}}</th>

Lets explain	
	$user->roles()->get() => gets allo hte roles the user has 
	
	->pluck(['name'])	=> from those results i want to have only name
	
	All of this will return laravel colelction class that has a method implode
	we have used implode method in order to show results as a sting. Did you like that i did :)
	
Well all in all lets give that page some functionality not only to display them. we need to have some 
form of adding roles to users	
we will add edit and delete links
// index.blade.php	
	+ <a href = "{{route('user-control.edit', $user)}}">
	+ 	<button type = "button" >EDIT</button>	
	+ </a>
	+ 
	+ <a href = "{{route('user-control.destroy',$user) }}">
	+ 	<button type = "button" >DELETE</button>
	+ </a>
	
OK you see that route has 2 poarameter. if you type php artisan route:list
you will see that those 2 routes require a value and if we do not provide it it will generate an error

Now it is time do add fucnitonality to edit. We do that firs
//UserController edit method

	return view('admin.users.edit')->with([
		'user'	=>	User::find($id),		// gets the user for which primary key id was sent to us
		'roles'	=>	Role::all()				// gets all roles
	]);
	
Ok, we do need that view 'admin.users.edit' , same thing create edit.blade.php in the resources views admin user fodler
//resources/views/admin/users/edit.blade.php
	+<h4>EDIT USER {{$user->name}}</h4>
	+
	+<form	action = "{{route('user-control.update', $user)}}" method = "POST">
	+	@csrf
	+	@method('PUT')
	+	@foreach($roles as $role)
	+		<div>
	+			<input type = "checkbox" name = "roles[]" value = "{{$role->id}}">
	+			<label> {{$role->name}}</label>
	+		</div>
	+	@endforeach
	+	<button type = "submit">UPDATE</button>
	+</form>

Let me explain each part of this form
This form has 2 variables passed down from UserController edit method those are user and roles
First line ecoes user name ok
then we have a from action user-control.update -> how did i know what tu put there since i did not create route myself in routes

well it is easy jsut type

	:php artisan route:list

and you will see that update expect PUT parameter. Than why post method up there. Because brawsers do not know better.
next we have @csrf you should know what that is. Laravel puts csrf token filed and sends it to protect the form
next we have @method('PUT') this will tell laravel what is the real method used in this form
And next we just display all the roles and put them in checkboxes that is the whole form

Now we submit the form to user-control.update and that is update method of UserController so lets go to that method
and change it to accept user update
// UserController update method
	+ public function update(Request $request, $id)
    + {
	+ 	$user = User::find($id);						// get the user using user id
	+ 	$user->roles()->sync($request->roles);			// take user roles from the request and update them
	+ 	return redirect()->route('user-control.index');	// reditrect back to index user controll
    + }

The most important fucntuion here is $user->roles()->sync($request->roles);
means 
$user 	s the user we are editing
roles() get the roles connection (NOT THE ROLES OF THE CURRENT USER !!) 
	If you want to get the roles that current user has you do something like this $user->roles()->get()
	So remeber $user->roles() returns a class that represents user connection to specific tables and not the roles that user has

sync($array) this sync expect arrays of numbers that represent the roles ids. Sync will delete connections and put the ones 
provided in array

Ok lets go back to the edit.blade.php to spice it up a bit and to explain in a bit of depth what is what again
//resources/views/admin/users/edit.blade.php update input of checkbox

	+ <input 
	+   type = "checkbox" 
	+   name = "roles[]" 
	+   value = "{{$role->id}}" 
	+   @if($user->roles->contains('id', $role->id))
	+     checked
	+   @endif	
	+ >


We have added something new to the form

	+ @if($user->roles->contains('id', $role->id))
	+  checked
	+ @endif	

take a closer look. $user->roles as we said before it will return laravel collection
and laravel collection has option contains(key, $value) and that is how we check the options that user already has

take a look at this

$user->roles()->get()	- gets laravel collection
$user->roles			- gets laravel collection same as above
$user->roles()			- this is not collection it is a relationtip class you need to call get() method to get collection
dd($someVarable)		- dump and die function perfectly shows variable :)

OK you can experiment with laravel collection and var dumps a bit more ofcourse. How to get vars... 
But you will learn that along the way. 

If you want to add users programaticaly you can do something like this
// UserController store method
	+ public function store(Request $request)
    + {
	+ 	$user = new User();
	+ 	$user->username = $request->name;
	+ 	$user->password = Hash::make($request->pass);
	+ 	$user->email = $request->mail;
	+ 	$user->save();	
    + }
	
I did not do that but you can if you want. OK now let us continue to destroy users
Go back to index blade and remove button for deleting user and add this in its place

	+ <form action = "{{route('user-control.destroy', $user)}}" method = "POST">
	+	@csrf
	+	@method('DELETE')
	+	<a href = "{{route('user-control.destroy',$user) }}">
	+		<button type = "submit" >DELETE</button>
	+	</a>
	+ </form>
	
Again how do i know where is the page and what method do i need ?? I use php artisan route:list method to get them	
Go to user controller
//UserController destroy method
We can not just delete a user if he has some roles attahced to him we need to detech all the roles from the user
liek this
	
	+ public function destroy($id)
    + {
	+	$user = User::find($id);
	+	$user->roles()->detach(); //delete all roles from pivot table
	+	$user->delete();			//deletes current user
    +   return redirect()->route('user-control.index');
    + }


OK now we have finished our users panel and we are rady to work with authorizations roles. 
Meaning we will create some functionality that only admin can and some functionality that can be done only by
office and admin adn some only by office ok. If that makes any sence do not care :D

ok we will use GATES to do all the authorizations ok and we will add methods inside user model that will be later
used in gates directives ok
//ELOQUENT User.php

	+ public function hasAnyRoles($roles){
	+	if($this->roles()->whereIn('name', $roles)->first()){
	+		return true;
	+	}
	+	return false;
	+ }
	
	+ public function hasAnyRole($role){
	+	if($this->roles()->where('name', $role)->first()){
	+		return true;
	+	}
	+	return false;
	+ }

OK lets explain these functions hasAnyRoles
This function does follwoing

	$this->roles() return "relations belongs to many" class
	
this class has fucntion whereIn that accepts 2 parameters
First parameter is the colum name for which we will test the values but the colum name of the roles table not pivot
second parameter is the array of values to test against. 
What this actulay does. Gets all the roles of the user and test it against provided array.
Now this method first gets us the first match result. 
And if we get that result we know that user has at least one of the roles that have been provided in the array
So we return true

Second method is similar except that where method accepts one value and not more then one

Everything is ready for implementing roles with authroziations that is nice go to
//app/providers/AuthServiceProvider

	+ use Illuminate\Support\Facades\Gate; //if not alraedy present hehehe

	//booth method
	+ Gate::define('edit-users', function ($user){
	+ 	return $user->hasRole('admin');
	+ });

This means this gate checks if user is admin.
Now that we have that code above :) we can use something like this

//UserContorller.php
	+ use Gate;
	
// in user controller go to edit function	
	
	+ if(Gate::denies('edit-users')) { 
	+ 	exit('ONLY ADMIN CAN EDIT USERS OK CLICK BACK SORRY');
	+ }
	
This is cool. 
You can also use Gate::allows but it is contrary of denies it is logical
Now lets mix in with middleware since it can help us out even on the routes or almoust anyware

Now we will make new gate that returns true for admin and office
//app/providers/AuthServiceProvider 
	+ Gate::define('manage-users', function ($user){
	+ 	return $user->hasAnyRoles(['admin', 'office']);
	+ });

OK now you have defined this new role and we will test it in the routes like this
//routes web.php
	+ Route::middleware('can:manage-users')->group(function (){
	+ 	Route::get('only-edit-users', 'UserController@special');
	+ 	Route::get('only-edit-users2', 'UserController@special');
	+ });
	
We have added new function to userController
//UserController.php
	+ public function special()
    + {
	+    exit('YOU HAVE MANAGED TO GET HERE');
    + }
	
Test it out and you will see that only authenticaed users that have role office or admin can access pages

OK that is that regarding roles :) I will just show you something more trinks

	+ abort(403) //this will return 403 page

OK look at this
// IN SOME CONTROLLER

	+ if(Gate::denies('edit-users')) { 
	+ 	abort(403);
	+ }

You can write it like this
//IN SOME CONTROLLER
	
	+ $this->authorize('edit-users')
	
It will work the same as above

THere is one more option that is interesting somehow. If you have loaded a user like 
$user = User::find(3);

You can do something like this
//SOME CONROLLER
	+ $user = User::find(3);
	+ $this->authorizeForUser($user, 'edit-users')	// this is controller mehtod that test id the user can do edit users
	+ $user->can('edit-users')						//one more thing is to check if found user can edit users ?
	
Now when we go to blades you can do something like

	+ @can('edit-user')
	+ 	YES YOU CAN
	+ @endcan	
	
What you can also do is to have a mega super user and allow all gates to return true for him
//probably also in AuthServiceProvider i think :D	
	+ Gate::before(function($user, $ability){
	+	if($user->id == 1){return true;}
	+ });
	
I have not tried this just mentioning it

OK you also have those policies that are very similar to gates
Policies are strictly connected to eloquent class unlike gates that can like do whatever you want
And poeple sometimes use gates and policies sometimes only gates

Lets try to demontrate a policy, we will demonstrate it on the order controller

remeber we had been adding orders to order table

edit
//OrderController.php index method 
	+ $allOrders = Order::all();
    + return view('orders.order')->with('orders',$allOrders);


// ok in database i have manualy deleted the foreign key on the table order that references writer id ok
In the file OrderCotrnoller on the store method we have added
also 
	
	Gate::denies('user-id-low')
 
 insted of denies no is allows so that we get to the part where we save order
// order controller

	+ $order = new Order();
	+ $order->user_id = auth()->id();
	+ $order->from = $request->from;
	+ $order->to = $request->to;
	+ $order->save();
	+ return redirect()->back();
	
And this will sve the newly created order
inside order.blade.php add

	+ <ul>
	+	@foreach ($orders as $order)
	+		<li>	
	+			<form action = "{{route('order.update', $order)}}" method = "POST">
	+				@csrf
	+				@method('PUT')
	+				<input type = "text" name = "from" value="{{ $order->from }}">
	+				<input type = "text" name = "to" value="{{ $order->to }}">				
	+				<input type = "submit" value = "submit">
	+			</form>
	+		</li>
	+	@endforeach
	+ </ul>

So this form will imidiatly update the order in quetsion now we need to take care of the update method ok
//OrderController update
	
    +public function update(Request $request, $id)
    +{
	+	$report = [
	+		'errors' 	=> ['First FAIL error','Second FAIL error'],
	+		'mesages' 	=> ['First Success message','Second Success message']
	+	];
	+	
	+	$errors = new MessageBag($report);
	+		
    +   $order = Order::find($id);
	+	$order->from = $request->from;
	+	$order->to = $request->to;
	+	$order->save();
	+	
	+	return redirect()->back()->withErrors($errors);
    +}

Just for the fun of it yuo can find report returned together with this simpatic method	
Here is how you read only messages

// blade template order.blade.php
	+@if ($errors->any('mesages'))
	+	<div class="alert alert-danger">
	+		<ul>
	+			@foreach ($errors->get('mesages') as $success)
	+				<li style = "color:green">{{ $success }}</li>
	+			@endforeach
	+		</ul>
	+	</div>
	+@endif

OK now we will first create gate to stop user from edditing hiw own order haha ilogical yes :D
//AuthServiceProvider

	+ Gate::define('edit-order', function ($user, $order){
	+ 	return $user->id == $order->user_id;
	+ });
	
Update order controller

	+public function update(Request $request, $id)
    +{
	+	
	+	$order = Order::find($id);
	+	
	+	
	+	if(Gate::allows('user-id-low',  $order)){
	+	
	+		$report = [
	+			'errors' 	=> ['No error'],
	+			'mesages' 	=> ['Yes you can edit it is ok you have created it ok']
	+		];
	+		
	+	} else {
	+		$report = [
	+			'errors' 	=> ['You are trying to eddit somebody elses order'],
	+			'mesages' 	=> ['no success']
	+		];
	+	}
	+	
	+	$order->from = $request->from;
	+	$order->to = $request->to;
	+	$order->save();
	+	
	+	
	+	$errors = new MessageBag($report);
	+	return redirect()->back()->withErrors($errors);
    +}
	
Now user will be able to edit only the ones he has created	and no nobady elses

OK NOW policies hehe
You need to generate policy using artisan command. (first step of deciding to go with the gates instead of policies hahaha )

	:php artisan make:policy OrderPolicy

OK now we have new policy and we need to register it the policy is situated in
//app/Policies/OrderPolict.php
OK as we said we need to register this new policy
//AuthServiceProvider

	+ protected $policies = [
    +    // 'App\Model' => 'App\Policies\ModelPolicy',
	+	 'App\Order' => 'App\Policies\OrderPolicy',
    + ];
	
// OrderPolicy.php

	+public function update($user, $order){
	+  return $user->id == $order->user_id;
	+ }
	
Se this same as gate ok :D

Now how do we check against this 

well bealive it or not the same way as with the gate but laravel now takes care of the naming for use
see upstairs update and below update
// in some controllor
	+ Gate::denies('update', $order)

I have NOT tested this since i decided to go with gates. This way i have better control over naming of gates. Still
i do not want to say i do not like policies

- OK this authentification and authorizations was a bit hard to swallow. 

- But it was the most important part of this stupid tutorial so go slow and make sure all of it works



__________________________________________________________________________________________________
** Request and response and middleware

**THEORY
How laravel works ?
When you go to the link where laravel is installed you will be redirected to index.php
ON that page 
1. composer autoload file is run.
2. Laravel bootstrap creates container (do not worry)
3. Instance of Laravel core is created
4. Instance of user request is created and passed to the core
5. Core creates response.

Looking at this we can say that core is the router. THere are 2 cores. one for web one for console :)

You have seen service providers. It is a place to put some code that will probably run before application
You can speed up boot of your aplication by defering some registrations



REQUEST OBJECT

	This guy keeps all the data of the request like wheter it is post or goet metho, ip adress etc...
	Funny thing is that you can typehint the request object almoust anyware if it is a "LARAVEL CONTAINER"
	so to speak heehe
	
	Here are some ways to get it 
	$request = request();
	$request = app('request');
	$request = app(Illuminate\Http\Request::class);	
	
	So now lets review some methods that request can give you
	all() 							//returns key array of fileds from form
	iunput(filedName)				//just one field
	only([array of fields])			//gets only the provided fields in the provided array
	except([array of fields])		//similar to above except it is except :D
	exists(filedName)				//is provided field
	json()							//returns parameterBag whatever that is if the page has JSON
	json('KEY')						//returns the json value under key KEY
	
	
	//---
	method()  //POST GET ...
	path()		// from www.google.com/as/sfd it wll return as/sdf
	url()	// gets url that accessed this page
	ip()	//gets ip ofcourse
	header()	//returns an array of headers. which is cool for API
	server()		// You know REMOTE_ADDR or whatever is in $_SERVER
	secure()		//test if this was accessed using https
	isJson()	//wheter this page has Content-type json or similar
	wantsJson()	//same as above but in AcceptHeader
	accepts()	//check if accepts something like Json or text
	
All of the methods above are GREAD for api implementation PERFECT 	
	
Now what about files ?

	file() //gets all uploaded filess
	allFiles()//same as above but better naming
	hasFile()	// wheter the file with specific name was provided
	
We will have a whole chapter for files no problem

Now session

	flash() 		// puts request in to session for one time access
	flashOnly()		// puts some specific vals in session for one time use
	flashExcept()	// puts all except specific vals in session for one time use
	old()			// you have seen this one 
	flush()			// deletes all flashed data to it
	cookie()		//gets all cookies or if you privide key gets only that
	hasCookie()		//self explanatory
	
OK now we go to response. This reposnse class is cool for creating apis also very veru cool
It works like this
	Route::get('route', function (){
		return response("error!", 400)
		->header('HeaderName', 'headerValue')	//set header
		//->view('xml-structure', $someXMLdata)	//a specific xml template
		->cookie('cookieName', 'cokkieValue');
	})
	
!! Downloading files in laravel will usualy require you to save a file to a temp location 
then just use download() to that location. Or maybe some classes have their own download 

Here is one example
	return response()->download('file.xlsx', 'export.csv', ['headerName' => 'HeaderValue']);
or	
	return response()->download('file.xlsx');

Or you do not have to download a file you can diplay pdf file in brawser if you want

	return response()->file("/some.pdf", ['headerName' => 'Val'])

JSON 
ok what if you want json to return to user

	return response()->json($dataNotJson);


REDIRECTS 
Thay are still reponses ofcourse jsut a redirect response 
Here are soome methods that you can use

	return redirect('someLink')
	return redirect()->to('someLink');
	return redirect()->route('someLink.name');
	return redirect()->action('SomeController@function'); //WERY INTERESTING redirect directly to controler method
	
	return redirect()->route('someLink.name', ['id' => 15]); //
	return redirect()->action('SomeController@function', ['id' => 15]);
	return redirect()->back()->withInput();	//to have all data back from form so you can use old IF VALIDATION FAILS
	
There is one thing that you have alreay seen
	return redirect()->back()->with('someData', 'some val');	

And you can get it in some blade template like this
		echo session('someData')
	
MIDDLEWARE

	You sam middleware a lot of times. It is the first and last thing in reposnse cycle. So he is best for session manipulation
	Since laravel is layared app there are a lot of middlewares. So first middlware in the line gets first access to request
	then another middleware getst the request and so on and so on.
	
	So if you would for some reason to create your own middleware you would do something like this 
	(block some method for the whole app)
	
	:php artisan make:middleware BlockMethod

//app/Http/Middleware/BlockMethod.php

Take a look at this

	+public function handle($request, Closure $next)
    +{
    +    return $next($request);
    +}
	
This function does following. Take the request in question, do something with it and pass it on to the next middleware
OK up above you have learned a lot about request nad it functionality ok like ip and such so you can add soemthing like this


	+ public function handle($request, Closure $next)
    + {
	+	if($request->ip() == "198.45.78.899"){
	+		return resonse('IP NOT ALLOWED', 403);
	+	}
	+
	+	if($request->method() == "DELETE"){
	+		return resonse('Delete not allowed', 403);
	+	}
	+	
	+	//save resopnse before returning it in a temp var and 
	+	$response = $next($request)
	+	
	+	// and now you can interact with it some more
	+	$response->header('HeaderName', 'headerValue')	
	+	 ->cookie('cookieName', 'cokkieValue');
	+	
    +   return $response;
    + }

Now we need to present this middleware to the app. You can add it to the route or to all the routes
Adding it to the all routes goes vie Global middleware adding in kernel in
//app/Http/Kernel.php

	  + protected $middleware = [
      +    \App\Http\Middleware\BlockMethod::class,
	  +    \App\Http\Middleware\TrustProxies::class,
      +    \Fruitcake\Cors\HandleCors::class,
      +    \App\Http\Middleware\CheckForMaintenanceMode::class,
      +    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
      +    \App\Http\Middleware\TrimStrings::class,
      +    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
	  + ];

And now your middleware is global and it will work for the whole application and all routes.
But you can make it local so that you can use it in routes like for example 'auth' 
same file
//app/Http/Kernel.php
jkust a bit below


	+ protected $routeMiddleware = [
	+ ...

Add it there and you will be able to use it in middleware on web.php
You have learned something new and that was a bit cool ok

**END OF THEORY


__________________________________________________________________________________________________
** CONTAINER

**THEORY

Laravel container has many name

	Application container
	IoC (inversion of control) container
	Service container
	DI (dependency injection) continer (like this is the most interestin name for us since like he recognises dependencies :D)

Look at that last name. Dependency injection. Let me explain what that is

	+class Bank {
	+	$accounting;
	+	$management;
	+	
	+	function __constuct(Accounting $accounting, Management $management){
	+		$this->accounting = $accounting;
	+		$this->management = $management;
	+	}
	+	
	+	function setAccounting($accounting){
	+		$this->accounting = $accounting;
	+	}
	+}
	
In the code above constructor method is used for injecting dependencies. Meaning class Bank can not work witout Accouting
and Management class

In the code above we also have an Dependencu injection methods like setAccounting

Most common way of dependency injection is via constructor

OK now if we want to use this Bank class here is how it would look like

	+$accounting = new Accounting();
	+$management = new Management();
	+
	+$bank = new Bank($accounting, $management);
	
	
3 lines of code. Ok lets imagine that Bank class requires bilions of classes as dependency injection. Like imagine that 
Bank needs more then 7 hounder thousent classes. WOOW that is something that i do every day. I write at least 6 bilion classes
that needs more then 10 bilion of classes each.
Ok laraves saw those bilions and said i will shorten the code for that ok.I will invent container

What is continer. In order to understand container we will first demontrate app() global helper
If you pass Full class name(FQCN - full qualified class name) or like laravel class Shortcut
this app helper will generate the class for you

Here is an example

	+$Bank = app(\some\place\Bank); // ok ok wher is accounting an management WAIT PLEASE
	+$Bank = app(Bank::class);		// ok ok wher is accounting an management WAIT PLEASE



OK now lets imagine this class

	+class Loger{
	+	function __consutrct('LogPath', 'LogType');
	+}
	
Now later on you weant to include it using app	

	+$Bank = app(Bank::class);

WHERE ARE LOG PATH AND LOG TYPE !!!! Laravel does not know that !!! So FUCK YOU HAHAHAHAHAH 
AHHA sorry for that  :D
Well here is where it actulay metters :D

When you have called $Bank = app(Bank::class);
Laravel knows how to resolve those two classes that are required in sonctructor because you type hinted them (like java was doing or all those years :D FUCK YOU PHP).
If they have alos thing that should be provided in constructor if they are typehinted then laravel again
initializes those classes. Problem is what if it requires some values in those contructors that CAN NOT BE RESOLVED ?

OK what do we know. Laravel will innstantiate classes only when you do not have anything to pass to constructor. 
And that hepls us some times i must say. But what if we do have something. 
IF WE DO YOU NEED TO BIND IT
You need to go to some service provided. Whatever service provider
//service provider
	+public function register(){
	+	$this->app->bind(Loger::class, function ($app){
	+		return new Logger('Path/to/the/log.txt', 'errorType');
	+	});
	+}
	
So now that you call 	
	$Logger = app(Logger::class);
It will instantiate logger class with 	'Path/to/the/log.txt' and 'errorType'.
Now you might wonder what if i want to instantiate logger class someware in the code and depending on some parameters
i change error type and log file WELL I DO NOT KNOW HOW TO DO THAT !!! AHAHHA SORYYY :D

OK so all thing short here is what could have been done 

You have one class that needs 3 classes (one class needs 3 classes to work -> dependency) The word dependency is created
so that people who write code seam smart (far from it :D).

OK 1 class needs 3

//SOME CLASS

	+class Manager{
	+	public $sector;
	+	public $accounting;
	+	public $somethingMore;
	+	public function ($sector, $accounting, $somethingMore){
	+		$this->sector = $sector;
	+		$this->accounting = $accounting;
	+		$this->somethingMore = $somethingMore;
	+	}
	+}

OK in larael now you can BIND this

//service provider
	+public function register(){
	+	$this->app->bind(Manager::class, function ($app){
	+		return new Manager(app(Sector::class), app(Accounting::class), app(SomethingMore::class));
	+	});
	+}


Lets imagein that you can have only 1 manager in this application of yours
	+public function register(){
	+	$this->app->singleton(Manager::class, function ($app){
	+		return new Manager(app(Sector::class), app(Accounting::class), app(SomethingMore::class));
	+	});
	+}

And if you want for some reason you can reverse classes for example you ask for one class and get another

	+ $this->app->bind(Manager:class, SuperManager::class);
	
If you ask for manager class you will get SuperManager. 

!!! Meaning also in Controller Constructor  if you typeHint Manager you get SuperManager !!!
!!! Also in controller methods it will also resolve those bindings above to reflect your class !!!

	+ $this->app->bind('log', SuperManager::class);	
	
If you do something like app('log')	You will Get SuperClass. 

	+ $this->app->alias(SuperManager::class,'log');	

Same code as above

So far the compleat code above was about generating classes using laravel. And making it somehow easy for us ??
But all those classes can be created withot any varables. They can all be resolved without any outside input
But if you do have some input we can do soemthing like this

//some class

	+class Foo{
	+	public function __construct($bar){
	+		// it is important bar is actualyu var that was created during some actions
	+		// we do not know what will bar be
	+	}
	+}

//In some code
	$foo = $this->app->makeWith(
		Foo::class,
		['bar' => 'value']
	)


!!! IMPORTANT NOTE !!! 
WHAT IS LARAVEL FACADE  ?
Laravel facae translates static calls to noral class calls meaning:
	
	+ Logger::log('INTERESTING');
	
Same as 
	
	$loger = new Logger();
	$loger->log('INTERESTING');
	
This means that when you create your classes import facade so that it works

**END OF THEORY


__________________________________________________________________________________________________
** REST API


You should know what is REST api in order to continue.

OK in laravel rest api routes ins not in web.php
No it is not it is in the api.php
In this chapter we will again have test. In order to conduct those test i will create just one page that will
access rest apis
//web.php
	
	+ Route::get('/apitest', function(){
	+ 	return view('apitest');
	+ });
	
//resources/views/apitest.blade.php	
	+ HELLO
	
Ok now we are ready to start writing REST API :D

Api also has its own controllers. But those controllers do not include methods for siplays ok. No need for that
We wil create orderApiController
	
	:php artisan make:controller Api/OrderApiController --api

Now you have a new controller inside

//app/http/Controllers/Api/OrderApiController
Alter index method
	+ Use App\Order;
	+ //...
	+ public function index()
    + {
    +     echo Order::all();	//imidiatly transfered to json. Laravel is smart
    + }

OK in api.php routes add
//api.php

	+ Route::namespace('Api')->group( function (){
	+ 	Route::get('orders', 'OrderApiController@index');
	+ });

The namspace upstairs is used because all the controllers are inside api folder ok
Ok what now.Now update 
//apitest.blade.php

	+ $ch = curl_init();
	+ curl_setopt($ch, CURLOPT_URL, url('api/orders'));
	+ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	+ $output = curl_exec($ch);
	+ curl_close($ch); 
	+ dd($output);	//dump and die

And you will see all orders using dump and die function dd();
OK you can also return some headers along with the response

//OrderApiController index
	+ return response(Order::all())->header('X-personal', 12);
	
IN the controller if you need headers you can get them like this

	+ $request->header('Accept');

Also in api you can use paginate
// index method OrderApiController
	+ return Greeting::paginate(5);

Every time you update index method go to apitest.blade.php, refresh it to see results
OK let me help you this time
//apitest.blade.php

	
	+ $ch = curl_init();
	+ curl_setopt($ch, CURLOPT_URL, url('api/orders'));
	+ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	+ curl_setopt($ch, CURLOPT_HEADER, 1);
	+
	+ $response 		= curl_exec($ch);
	+ $header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	+ $header	 		= substr($response, 0, $header_size);
	+ $body 			= substr($response, $header_size);
	+
	+ dd($header, json_decode($body));
	
When you call this page now. You will see a bit complex resopnse. 
Showing previous pages and next pages.

how much there is to list etx. EXTRAMLY GOOD functionality i must say. Saves a lot of time.
You have liked that ofcourse. 
You have seen paginate used on regular pages. 
But this is diferent. 
When paginate is called on API it bihaves dieferntly as you saw above

OK what do you need to have inside response. You should have
DATA: returned json representing requested data
ERRORS: an array of objects if any
META: some data regarding the response. They say ERRORS and DATA shuld not be in the same response.

You can also sort the results like this

	+ return Greeting::orderBy('body')->paginate(5);
OR
	+ return Greeting::orderBy('created_at','body')->paginate(5);

Remeber request object. You can take url query parameters do not forget that
// OrderApiController.php
	
	+if($request->has('block')){
	+	return ['block' => 'true'];
	+}
	
Meaning if in request url we have ?block=true it sill couse page to return almoust nothing
Ok you can also get ony some results back to the one requestong greetings
	+ return Greeting::where('updated_at','<', '2021-04-05 02:57:52')->paginate(20);

As you see it is all about Eloquent DB class and he is the one controlling api responses. 
almoust the same as for all other pages

What if you do not want people to see updated at ?
just put update_at in hidden array of eloguent
//Order.php ELOQUENT
	 protected $hidden = ['updated_at'];
	
Now you will not see updated_at	

You can make your own transformer regarding json creation in order to return data in some format you like
But this has nothing to do with laravel in particular
just make 2 methods like toArray and toJson
And there you have it

Ok what if a table user has a lot of greetings how do we include them inside ?
There are diferent aproches but most probably you will use something like take all greestings that user 
has and append them to array
You will learn this along the way

But still in laravel now we have something called API resource. This is used to transform our data and send it back
Lets create one resource

	:php artisan make:resource Writer;

//App/Http/Resources/Writer.php
You will see one method to array. Lets change that method

	+ public function toArray($request)
    + {
	+	return [
	+		'name' => 'My name is: '.$this->name,
	+	];
    + }


Ok now we want to return that resource ok. Go to controller that is used to return data
//Api/WriterController.php		!!! Important this is new controller created in Api folder

	+ Use App\Writer;
	+ use App\Http\Resources\Writer as WriterResource;
	+ ...
	+ public function apiList(){
	+	return new WriterResource(Writer::find(25));
	+ }
	
Watch at the code above. WriterResourse gets Class returned by using Writer eloquent class	

Ok now test it with test page that hits new route and this is the new rout :D
//api.php

	+ Route::namespace('Api')->group( function (){
	+ 	Route::get('orders', 'OrderApiController@index');
	+ 	Route::get('writers', 'WriterController@apiList');
	+ });

And you will see that we have good result.

Ok now we want to return collection ok
//API WriterControler.php
	
	+ return WriterResource::collection(Writer::all());

Now you get the collection. Please follow up what is going on
Writer:all() returns all writers. And passes them one by one to WriterResource class. That now transforms each of the
writers via to array method modifying what you need and returns that writer back to main array.
WriterResource::collection sort of a uses map function.

OK what if we also waant to see writer greeting that he wrote. In our case one writer has one quote. 
This is stupid but what you gonna do sue me. 

We need one moreresource ofcourse in order to achive this


	:php artisan make:resource Greeting;

Ok now without any modification of the Greeting resource go to WriterResource
//Api/Writer.php Writer resource

	+ use App\Http\Resources\Greeting as GreetingResource;
	+ ...
	+ 'greeting' => new GreetingResource($this->greeting)
	
These are the lines we have added to Writer resource and now since we have greeting Resource this will work
but lets modify greeting resource to add only some data ok

	+ public function toArray($request)
    + {
	+	return [
	+		'I said '.$this->body
	+	];
    + }

Now when you test the return json you will see compleatly diferent results. Enjoj. Since this is more then enought to 
create any api in the world

One more thing ofcourse you can use paginate with resource the same way

	+ return WriterResource::collection(Writer::paginate(20));
	
Now Authorization within API. Laravel can use OAuth 2.0 to authorize you along the way. And here is how we are going to set it up
We need passport package
Remeber we are using laravel 7 since it is still using similar routes to 5.6. unlinke version 8. 
They changed some things and i did not liked that
Because we have installed laravel 7 we need to install passport 9.0 and not 10.0 Since it wont work
	
	:composer require laravel/passport:^9.0
	
And this will work. If you leave out 9.0 variant then it will not work ok.OK OK OOK

OK this passport has a lot of packages nad modules that will help us create OAuth 2.0 REST API authentification
After that here is what is needed.
Also what is important. this passport has some tables and therfore migrations we need to run them

	:php artisan migrate
	
Now we do have some new tables inside database you will see them if you want to take a look
Ok we have everything ready. we need to install passport. Ok we have only downloaded it we need to isntall it 

	:php artisan passport:install
	
This install actualy has not done much. Just added clinet id and client secret (for personal and grant type tokens)
and that would be that :D This is all that install has done

What is next ? Laravel user needs to have trait called hasApiTokens and we will include it in the user Model class
//App/User Eloquent

	+ use Laravel\Passport\HasApiTokens;
	+ ...
	+ use Notifiable, HasApiTokens;
	
OK is there something more yes there is. We need auth pages on the api.php to be able to do something
like authenticate and Such :D And we will add that in AuthServoceProvider

//AuthServiceProvider.php Boot Method
	+ use Laravel\Passport\Passport
	+ ...
	+ Passport::routes()

You cluld have also added those routes inside api.php which would be much more logical hahahahahaha :D
And this will generate routes for us to use api to authenticate get token etc...
lest see them

	:php artisan route:list
	
ONE MORE THING !!! 

//config/auth.php

Guard for api has to be changed to be passport driver


	+ 'api' => [
	+	'driver' => 'passport',
	+	'provider' => 'users',
	+	'hash' => false,
	+ ],
	
Ok if you weant to add new client just type
	
	:php artisan passport:client; // have not tried this jet
	
Now we will create one route that you can not access by using regular request using php curl
//api.php under group api
	
	+ Route::get('secure', 'OrderApiController@secureData')->middleware('auth:api');
// order api controller

	
	+public function secureData(){
	+	return ['secure'];
	+}
	
OK try to access that new page in apitest and you will get not found.We need to authenticate here

Here are 2 ways to authenticate users - via password grant and authorization code grant

Password grant is much easier to understand. Send user name and password get token and after that on each request send token :D
We already have one password grant client in table oauth clients
But you can make new one like
	
	:php artisan passport:client --password
	
But we already have one in database and i will use that one. So in order to acces secure page we need token
adjust apitest.blade.php to reflect this

	+ $ch = curl_init();
	+ curl_setopt($ch, CURLOPT_URL, route('passport.token'));
	+
	+ $data = [
	+	'grant_type' => 'password',
	+	'client_id'=>'2',
	+	'client_secret'=>'JXkM4ASfrQP42ejD1F2Bvuza7BHl4EQWHstDeaxk',
	+	'username'=>'usermail@usermail.com',						//mail that you have used to login
	+	'password'=>'userpass',										//pass that you have used to login
	+ ];
	+
	+ curl_setopt($ch, CURLOPT_POST, 1);
	+ curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	+ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	+ curl_setopt($ch, CURLOPT_HEADER, 1);
	+
	+ $response 		= curl_exec($ch);
	+ $header_size 		= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	+ $header	 		= substr($response, 0, $header_size);
	+ $body 			= json_decode(substr($response, $header_size));
	+
	+
	+ echo '<pre>';
	+  print_r($body);
	+ echo '/<pre>';	
	+	
	+ $headers = array(	
	+  'Authorization: Bearer '.$body->access_token,			//request bofore this gave us the access token
	+ );
	+
	+ $ch = curl_init();
	+ curl_setopt($ch, CURLOPT_URL, url('api/secure'));			//page that can be accessed only via token
	+ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	+ curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	+	
	+ $response = curl_exec($ch);
	+ dd(json_decode($response));								//and you will get what secure page was returning
	
Grant type is a bit diferent.
Here are the stepts:
	1. Uers logs in to the first site call it FaceBookPicker
	2. He clicks on authorize FaceBookPicker on Facebook
	3. Her is redirected to Facebook
	4. On facebook he clicks allow FaceBookPicker to pick on facebook
	5. Facebook sends authorization data to FaceBookPicker
	6. You get that token and you can Pick on facebook using FaceBookPicker
	
If you need thes type of authorization go on. I never needed it in my days
Here is what we know grant authorization is for otuside user apps. Password grant is for your own app.
But also you can also use passsword grant for others also.

You can also use personal access tokens in order to test the api. So no need to go throw this hardship
This is only for TESTING nothing else i believe

If a user is logged in you can do something like this

	+ $user = Auth::user();
	+ $token = $user->createToken('TokenMe')->accessToken;	//Gets the token just like with password grant

	+ $headers = array(
	+ 	'Authorization: Bearer '.$token,
	+ );
	
	+ $ch = curl_init();
	+ curl_setopt($ch, CURLOPT_URL, url('api/secure'));
	+ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	+ curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	+ $response = curl_exec($ch);
	+ dd(json_decode($response));
	
OK AND NOW something extramly GOOD. OK imagine that you are loggeed in user and some pages will make js ajax calls to api
you are already logged in. So whay should you make authorization calls and such
You need to add 

Laravel\Passport\Http\Middleware\CreateFreshApiToken

To web middleware group
//app/Kernel.php in web
	+\Laravel\Passport\Http\Middleware\CreateFreshApiToken::class

Now every response in laravel sends auth token called laravel_token if user is authenticated. But how do we use it ?
You use it in ajax requests ok. Best way is to use Jquery You can also use xmlRequestObject as plane vanila js
I used Jquery

//apitest.blade.php
	+ <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	+ <script>
	+	if (window.jQuery) {  
	+		$.ajaxSetup({
	+			headers:{
	+				'X-CSRF-TOKEN': "{{ csrf_token() }}",
	+				'X-Requested-With' : 'XMLHttpRequest'
	+			}
	+		});		
	+		$.ajax({url: "{{ url('api/secure') }}", success: function(result){
	+			alert(result);
	+		}});
	+	}
	+ </script>

When you want to deploy the application online you need to type. I have not done this so far :D
	:php artisan passport:keys
	
	
__________________________________________________________________________________________________
** STORAGE

	I will not write much here since i am not sure what will you use. But just for a little hint
	AMAZON S3 storage is one of the greates ways to store files online and to retrieve them
	LARAVEL comes with already setup S3 you just need secret key, id, bucket, location...
	It will work like this
	
	Storage::disk('s3')->get('file.jpg');
	
	We will demonstrate one wery simple file upload and storage
	
	Remember when you made a form for upload
	now with the file that is provided just put
	
	Storage::put('where/exactly/to/put', file_get_contents($request->file('form_file_name'->getRealPath()))
	
__________________________________________________________________________________________________
** SESSION	

	You will use this a lot ofcourse. To put something in session just use
	
	+ session()->get('myKey', 'If there is not value associated with key get this');
	
	+ session()->put('myKey', 'myKeyValue');
	
	If session key is array 
	
	+ session()->put('myKey', ['myKeyValue1', 'myKeyValue2']);
	
	+ session()->push('myKey', 'myKeyValue3');
	
	Aks if key is set
	
	+ session()->has('myKey');
	
	Delete from session
	
	+ session()->forget('myKey');  //delete specific key value pair
	
	+ session()->flush();
	
	Remember not to use 'flash' as a key since laravel has reserved that word for session
	
__________________________________________________________________________________________________
** CACHE		
	
	To access cashed val use
	+ cache()->get('somKey', 'default if needs be');
	
	+ cache()->put('Key', 'value', $seconds)
	
	+ cache()->forget('myKey');  //delete specific key value pair
	
	+ cache()->flush();
	
__________________________________________________________________________________________________
** COOKIES	

Use cookie helper

__________________________________________________________________________________________________
** LOGGER

Some logger functions. You can see logger options inside 
//config/logging.php
You will see there are a lot of options
like single, daylu etc...

Default will be stack.
You can write down in a single file, all the logs, 
You can write to logs, and if it is another day new file will be created for that day
You can send datat to slack etc..

	Log::emergency($message)
	Log::alert($message)
	Log::critical($message)
	Log::error($message)
	Log::warning($message)
	Log::notice($message)
	Log::info($message)
	Log::debug($message)

If you want to be specific
	Log::chanel('slack')->debug($message)

