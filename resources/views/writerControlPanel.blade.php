<link rel = "stylesheet" href="{{ mix('css/all.css') }}">

<div class = "lokosi"> asd </div>

<h4>LANGUAGE: word hello - @lang('main.hello')</h4>


Writer
<form method = "POST" action = "<?php echo route('writer-store');?>">
	@csrf
	<input type = "text" name = "name" > 
	<input type = "submit" name = "submit" > 
</form>


<h4>List all names</h4>
@foreach ($allWriters as $writer)
	<div> {{$writer->name}}</div>
@endforeach	

<h4>List oneWriter name(22)</h4>
<div> {{$oneWriter->name}}</div>

<h4>Show</h4>
<div> {{$firstWriter->name}}</div>
<div> {{$firstWriterGreeting->body}}</div>


<h4>Pagination</h4>
<div> {{$paginationGreeting->links()}}</div>
<br >
<hr/>
@foreach ($paginationGreeting as $greeting)
	<div> {{$greeting->body}}</div>
@endforeach	





<br />

<hr>
<?php
// showing collections down here

$collection = collect([1,2,3]);

var_dump($collection);

//make odds numbers
$odd = $collection->reject(function($item){
	return $item % 2 === 0;
});

var_dump($odd);

$doubled = $collection->map(function($item){
	return $item * 2;
});

var_dump($doubled);


