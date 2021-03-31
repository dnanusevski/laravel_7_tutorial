<html>
	<head>
		<title> My Site | @yield('title', 'Home page') </title>
	</head>

	<body>
	
		<div class = "container">
			@yield('content')
		</div>
	
		@section('fotterScript')
			<script src = "app.js"> </script>
		@show
		
		
		@stack('stackDivs')
	
		@component('slot-example')
			@slot('title')
				<div>THis will be placed instaed of title var in slot-example</div>
			@endslot
			ANd this value should be placed instead of  { { $ slot } } 
		@endcomponent
		
		@inject('ExampleClass','App\Example\ExampleClass');
		
		@hasdubdomain
			<div> IT HAS SUBDOMAIN </div>
		@endhasdubdomain	
		
		@isDimeLord	
			<div> YES DIME IS LORD </div>
		@endisDimeLord
	
		
		<?php
		echo $ExampleClass->lokosi;
	
		// lets dislpat data included in appServiceProvider
		
		
		// follwoing value is passed from web.php routes file using with('myVar' => 'myVar')
		if(isset($sharedData)){
			echo '<br> Value of sharedData passed from service provider boot method - '.$sharedData;	
		}
		// follwoing value is passed from web.php routes file using with('myVar' => 'myVar')
		if(isset($myVar)){
			echo '<br> Value of myVar passed from web.php '.$myVar;
			// in the child template, you will ofcourse not see this thing above hehe
		}
		
		$group = new stdClass();
		$group->title = "Hello";
		$group->arr = [
			'ada'=>'kardano',
			'king'=>'kong',
		];

		?>


		<h2>Generating links using URL::route</h2>
		<!-- URL::route needs to have a name in web.php -->
		<h4>SENDING TO :  <?php echo URL::route('form-store');?></h4>

		<form action = "<?php echo URL::route('form-store');?>" method = "POST">
			@csrf
			<input 
				name = "body" 
				type = "text"
				maxlength = '32' 
				value = "<?php old('body', 'Default username instructions here');?>" 
			>
			<input type ="submit" value = "submit">
		</form>

		<h3>We will demontrate blade template here</h3>

		<div>using { { $group->title  } } and result is -> {{ $group->title }} </div>
		<h3>Below is forels method</h3>
		@forelse ($group->arr as $arr)
		<div>- {{$arr}}</div>
		@empty
		<div>Arr empty</div>
		@endforelse
			
		<div>lets echo @{{ }} -> we added@ ad the begining of {{ and it is ok now</div>


		@if(count($group->arr) === 1)
			<div>This array is only 1 memeber long</div>
		@elseif(count($group->arr) > 1)
			<div>This array has more then one member</div>
		@else
			<div>Certenly zero :D</div>	
		@endif
		
		
		<h2> Lets test some db thingis</h2>
		<?php
			$data = DB::select('Select * from writers');
			echo '$data = DB::select("Select * from writers");';
			
			echo '<pre>';
				print_r($data);
			echo '</pre>';
		?>
		
		
		
	</body>
	
</html>	