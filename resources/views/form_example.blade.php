Form example testing

<form enctype = "multipart/form-data" method = "POST" action = <?php echo route('form-example-post') ?>>
	<input type = "text" name = "first_name" >
	@csrf
	<br />
	
	<input type = "text" name = "last_name" value = "<?php echo old('last_name', 'Name');?>">
	
	<br/>
	foreign <input type = "radio" name = "localization" value = "foreign" >
	domestic<input type = "radio" name = "localization" value = "domestic">
	
	<br/><br/>
	<select name = "status">
		<option value = "Dr.">Dr.</option>
		<option value = "Dr. Spec.">Dr. Spec.</option>
		<option value = "Dr. Mr. Spec.">Dr. Mr. Spec.</option>
	</select>
	
	<br />	<br />	
	<input type = "file" name = "image">
	
	<br />
	<br />
	<input type = "submit" name = "submit">
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($errors->has('mesages'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('mesages') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<?php
	if($errors->has('mesages')){
		var_dump($errors->get('mesages'));
	}
?>
