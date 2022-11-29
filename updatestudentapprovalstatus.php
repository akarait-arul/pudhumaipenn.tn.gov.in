<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("./Controllers/StudentRegistration.php");

/* $data = ["STUDENTKEY2" => "y","STUDENTKEY1" => "n"];
  $data_count = count($data);
  $hash = md5($data_count . "SALETVALUE128");
  $post['hash'] = $hash;
  $post['data'] = $data;
  echo json_encode($post);
  die; */

$result = [];
// Check IS POST METHOD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $header_keys = getallheaders();
    $header_x_api_key = $header_keys['X-Api-Key'];
    $header_content_type = $header_keys['Content-Type'];
    //var_dump($header_keys);
    // Check API KEY 
    if (trim($header_x_api_key) == POST_STUDENT_LIST_API_KEY) {

        // Check Content Type
        if (trim($header_content_type) == 'application/json') {

            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            // Check Post Data Available or Not		
            if (isset($data['securekey']) && isset($data['data'])) {

                $securekey = $data['securekey'];
                $data_count = count($data['data']);
                $hash = md5($data_count . "pudhumaipenndev");                
                if (trim($hash) == trim($securekey)) {

                    // Check Hash Key And Count of Data
                    $obj_studentregistration = new StudentRegistration();
                    $call_method_schooldetails = $obj_studentregistration->StudentSchoolDetailsApproved($data['data']);
                    if ($call_method_schooldetails) {

                        $result['resp_status'] = true;
                        $result['resp_code'] = 200;
                        $result['resp_data'] = $call_method_schooldetails['resp_data'];
                        //$result['resp_data'] = $call_method_schooldetails;
                    } else {

                        $result['resp_status'] = false;
                        $result['resp_code'] = 400;
                        $result['resp_msg'] = 'No Records Found';
                    }
                } else {
                    $result['resp_status'] = false;
                    $result['resp_code'] = 400;
                    $result['resp_msg'] = 'Invalid Data';
                }
            } else {

                $result['resp_status'] = false;
                $result['resp_code'] = 400;
                $result['resp_msg'] = 'No Post Data';
            }
        } else {

            $result['resp_status'] = false;
            $result['resp_code'] = 400;
            $result['resp_msg'] = 'Invalid Content type';
        }
    } else {

        $result['resp_status'] = false;
        $result['resp_code'] = 400;
        $result['resp_msg'] = 'Invalid API Key';
    }
} else {

    $result['resp_status'] = false;
    $result['resp_code'] = 400;
    $result['resp_msg'] = 'Invalid Method';
}

echo json_encode($result, true);
?>
