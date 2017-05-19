<?php 

$url = "https://verinote.net/api/enhancer/chain/dbpediaChain?parse=true";
$data = array( 'data' => $_POST['text'], 'type' => 'json');
$token = $_GET['token'];
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Authorization: Bearer $token\r\nContent-type: application/x-www-form-urlencoded\r\n",
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

// Send an error if the enhancer request failed
if ($result === FALSE) { 
	http_response_code(400);
	echo json_encode(array('error' => 'Something Went Wrong')); 
}else{	
	// Send the response
	echo json_encode($result);
}