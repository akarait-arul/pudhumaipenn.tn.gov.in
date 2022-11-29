<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once './Config/config.php';
require("./Controllers/StudentRegistration.php");

$result = [];
// Check IS POST METHOD
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $header_keys = getallheaders();
    $header_x_api_key = $header_keys['X-Api-Key'];
    $header_content_type = $header_keys['Content-Type'];
    if (trim($header_x_api_key) == GET_STUDENT_LIST_API_KEY) {

        $districtcode = filter_input(INPUT_POST, 'districtcode');
        $fromdate = filter_input(INPUT_POST, 'fromdate');
        $todate = filter_input(INPUT_POST, 'todate');

        // Check Valid District Code
        if (isset($fromdate) && isset($todate)) {
            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fromdate) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $todate)) {
                
                $obj_studentregistration = new StudentRegistration();		
                $call_method_schooldetails = $obj_studentregistration->StudentSchoolDetailsAPI($districtcode,$fromdate,$todate);
                if($call_method_schooldetails){
		
                    $result['resp_status'] = true;
                    $result['resp_code'] = 200;
                    $result['resp_data'] = $call_method_schooldetails['resp_data'];
                } else {

                    $result['resp_status'] = false;
                    $result['resp_code'] = 400;
                    $result['resp_msg'] = 'No Records Found';
                }
            } else {
                $result['resp_status'] = false;
                $result['resp_code'] = 400;
                $result['resp_msg'] = 'Invalid Date Format.';
            }
        } else {

            $result['resp_status'] = false;
            $result['resp_code'] = 400;
            $result['resp_msg'] = 'Invalid District Code';
        }
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
