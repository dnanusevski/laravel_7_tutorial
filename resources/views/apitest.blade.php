<?php
	/*
	echo url('api/orders').'?block=true';
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, url('api/writers'));
	//curl_setopt($ch, CURLOPT_URL, url('api/orders').'?block=true');
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	
	$response 		= curl_exec($ch);
	$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header	 		= substr($response, 0, $header_size);
	$body 			= substr($response, $header_size);
	
	dd($header, json_decode($body));
*/
	
	/*
	
	// TESTING THE API USING Password grant
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, route('passport.token'));
	
	$data = [
		'grant_type' => 'password',
		'client_id'=>'2',
		'client_secret'=>'JXkM4ASfrQP42ejD1F2Bvuza7BHl4EQWHstDeaxk',
		'username'=>'dimitrije.nanusevski@swissmailsolutions.com',
		'password'=>'peugeot2002',
	];
	
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	
	$response 		= curl_exec($ch);
	$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header	 		= substr($response, 0, $header_size);
	$body 			= json_decode(substr($response, $header_size));
	
	//dd($header, $body);
	echo '<pre>';
		print_r($body);
	echo '/<pre>';	
	
	$headers = array(
		'Authorization: Bearer '.$body->access_token,
	);
	
	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, url('api/secure'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$response = curl_exec($ch);
	dd(json_decode($response));
	
*/	

/*
	// TESTING THE API USING personal access token
	$user = Auth::user();
	$token = $user->createToken('TokenMe')->accessToken;

	$headers = array(
		'Authorization: Bearer '.$token,
	);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, url('api/secure'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$response = curl_exec($ch);
	dd(json_decode($response));
*/


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	if (window.jQuery) {  
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN': "{{ csrf_token() }}",
				'X-Requested-With' : 'XMLHttpRequest'
			}
		});		
		$.ajax({url: "{{ url('api/secure') }}", success: function(result){
			alert(result);
		}});
	}
</script>



	
	
	
	