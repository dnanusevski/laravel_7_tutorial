<h4> Insert order form </h4>
<form method = "POST" action = "{{ url('order')}}" >
	@csrf
	
	<input 
		type = "text" 
		id = "from" 
		name = "from" 
		placeholder = "from" 
		value="{{old('from')}}"
	>
	
	<br />
	
	<input 
		type = "text" 
		id = "to" 
		name = "to" 
		placeholder = "to" 
		value="{{old('to')}}"
	>
	
	<br />
	
	<input type = "submit" name = "submit">
	
	<br />
</form>

	<ul>
		@foreach ($orders as $order)
			<li>
				
				<form action = "{{route('order.update', $order)}}" method = "POST">
					@csrf
					@method('PUT')
					
					<input type = "text" name = "from" value="{{ $order->from }}">
					<input type = "text" name = "to" value="{{ $order->to }}">				
					<input type = "submit" value = "submit">
				</form>
			</li>
		@endforeach
	</ul>
	
<br /><br />
<h4> ERRORS IF ANY</h4>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if ($errors->any('mesages'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('mesages') as $success)
                <li style = "color:green">{{ $success }}</li>
            @endforeach
        </ul>
    </div>
@endif