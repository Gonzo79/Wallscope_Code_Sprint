<?php 

$API_KEY = 'mSvg1p0kUwrsr9NtjoUX5iu3pYIa';
$API_SECRET = 'ongfeu0Xx9cT8JVYA4C4_sTfnx4a';
$base64 = base64_encode($API_KEY.':'.$API_SECRET);

$url = 'https://verinote.net/token?grant_type=client_credentials';
$data = array();

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Authorization: Basic $base64\r\nContent-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
// make the get request, use the @ sign to suppress errors, we'll handle it manually
$result = @file_get_contents($url, false, $context);
// Set JSON header
header('Content-Type: application/json');

// Send the response

// Send an error if the token request failed
if ($result === FALSE) {
	http_response_code(400);
	echo json_encode(array('error' => 'Something Went Wrong')); 
}else{	
	// Send the token
	echo json_encode($result);
}