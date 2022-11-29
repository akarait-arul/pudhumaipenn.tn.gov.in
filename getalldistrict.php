<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once './Config/config.php';
require("./Controllers/Masters.php");
$result = [];
// Check IS POST METHOD
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    
	$header_keys = getallheaders();
    $header_x_api_key = $header_keys['X-Api-Key'];
    $header_content_type = $header_keys['Content-Type'];
    if (trim($header_x_api_key) == GET_DISTRICT_LIST_API_KEY) {
        
        $obj_masters = new Masters();		
        $call_method_districts = $obj_masters->GetDistrict();
        $result['resp_status'] = true;
        $result['resp_code'] = 200;
        $result['resp_data'] = $call_method_districts;
        
    } else {

        $result['resp_status'] = false;
        $result['resp_code'] = 400;
        $result['resp_msg'] = 'Invalid API KEY';
    }
} else {

    $result['resp_status'] = false;
    $result['resp_code'] = 400;
    $result['resp_msg'] = 'Invalid Method';
}

echo json_encode($result, true);
