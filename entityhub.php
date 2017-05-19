<?php 

$url = "https://verinote.net/api/entityhub/entity";
$id = $_GET['id'];
$token = $_GET['token'];
$data = '?'.http_build_query(array('id' => $id));
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Authorization: Bearer $token\r\nAccept: application/json\r\n",
        'method'  => 'GET'
    )
);
// echo "sending request to url: $url";
$context  = stream_context_create($options);
// make the get request, use the @ sign to suppress errors, we'll handle it manually
$result = @file_get_contents($url.$data, false, $context);
// Set JSON header
header('Content-Type: application/json');

// Send an error if the enhancer request failed
if ($result === FALSE) {
	// http_response_code(400);
	echo json_encode(array('error' => 'Something Went Wrong')); 
}else{	
	// Send the response
	echo $result;
}