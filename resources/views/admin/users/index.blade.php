<h1> USERS </h1>
<table style = "width:80%">
	<tr>
		<th>NAME</th>
		<th>EMAIL</th>
		<th>ROLES</th>
		<th>ADMINISTER</th>
	</tr>
	
	@foreach($users as $user)
		<tr>
			<th>{{$user->name}}</th>
			<th>{{$user->email}}</th>
			<th>{{$user->roles()->get()->pluck(['name'])->implode(', ')}}</th>
			<th>
				<a href = "{{route('user-control.edit', $user)}}">
					<button type = "button" >EDIT</button>	
				</a>
				
				<form action = "{{route('user-control.destroy', $user)}}" method = "POST">
					@csrf
					@method('DELETE')
					<a href = "{{route('user-control.destroy',$user) }}">
						<button type = "submit" >DELETE</button>
					</a>
				</form>
			</th>
		</tr>
	@endforeach
</table>