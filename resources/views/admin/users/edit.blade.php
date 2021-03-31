<h4>EDIT USER {{$user->name}}</h4>
<form action = "{{route('user-control.update', $user)}}" method = "POST">
	@csrf
	@method('PUT')
	@foreach($roles as $role)
		<div>
			<input 
				type = "checkbox" 
				name = "roles[]" 
				value = "{{$role->id}}" 
				@if($user->roles->contains('id', $role->id))
					checked
				@endif	
			>
			<label> {{$role->id}} {{$role->name}}</label>
		</div>
	@endforeach
	<button type = "submit">UPDATE</button>
</form>


<h4> TEST 2 functions from User</h4>

<?php
	if($user->hasAnyRoles(['admin'])){
		echo 'YES IT DO';
	} else {
		echo 'NO IT DOES NOT';
	}
?>
