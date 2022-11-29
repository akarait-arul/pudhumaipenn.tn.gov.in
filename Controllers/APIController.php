<?php

require_once './Config/config.php';

include_once("./Controllers/SMSTemplate.php");
class APIController
{
	
	function __construct()
    {

        $this->smstemplate = new SMSTemplate();
    }
	
    function emisApiCall($emis_id)
    {

        $header_data = array(
            "Content-Type: application/json",
            "x-api-key : " . EMIS_API_KEY
        );
        $dataArray = ['StudID' => $emis_id];
        $data = http_build_query($dataArray);
        $getUrl = EMIS_API . "?" . $data;

        //echo $getUrl;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 0,
            //CURLOPT_TIMEOUT => CURL_EXEC_TIMELIMIT,
        );
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, $curlOpts);
        $_response = curl_exec($ch);

        if (curl_error($ch)) {
            if (curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
                throw new Exception("Unable to fetch the required SAP data");
            } else {
                throw new Exception(curl_error($ch));
            }
        } else {

            return $_response;
        }

        curl_close($ch);
    }

    function getSearchEmisDetails($aadharno, $student_name, $student_dob, $school_id, $user_type)
    {




        $enable_td =    $user_type ? 1  : 0;

        $stud_dob =  implode("-", array_reverse(explode("-", $student_dob)));


        //var_dump($stud_dob);

        $header_data = array(
            "Content-Type: application/json",
            "KEY :  EMIS_SEARCH_KEY"
        );



        $emis_params = array("AadharNo" => $aadharno, "Name" => $student_name, "Dob" => $stud_dob, "Udise" => $school_id);
        //var_dump($emis_params);
        $data = http_build_query($emis_params);

        //var_dump($data);

        $getUrl = EMIS_SEARCH . "?" . $data;

        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 0,
            //CURLOPT_TIMEOUT => CURL_EXEC_TIMELIMIT,
        );
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, $curlOpts);
        $_response = curl_exec($ch);

        if (curl_error($ch)) {
            if (curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
                throw new Exception("Unable to fetch the required SAP data");
            } else {
                throw new Exception(curl_error($ch));
            }
        } else {

            //echo $_response;
            $data_response = json_decode($_response);

            //print_r($data_response);



            $respose_code =  $data_response->status;
            $respose_dataexist =  $data_response->dataStatus;

            $response_data =  $respose_dataexist ? $data_response->result : $data_response->message;


            //var_dump($response_data);

            $resp['msg'] =  $respose_dataexist;
            $resp['error_code'] =  $respose_code;


            if ($respose_dataexist) {
                $table_records = '';
                $si = 1;
                foreach ($response_data as $values) {

                    //var_dump($values->EMIS_ID);

                    $table_records .= "<tr>";

                    $table_records .=  "<td>" . $si . "</td>";
                    $table_records .=  "<td class ='emisidcopy'>" . $values->EMIS_ID . "</td>";
                    $table_records .=  "<td>" . $values->StuName . "</td>";
                    $table_records .=  "<td>" . $values->Cls . "</td>";
                    $table_records .=  "<td>" . $values->Section . "</td>";
                    $table_records .=  "<td>" . implode("-", array_reverse(explode("-", $values->StuDOB))) . "</td>";
                    $table_records .=  "<td>" . $values->FatherEng . "</td>";
                    //$table_records .=  "<td>".$values->FatherTam."</td>";
                    $table_records .=  "<td>" . $values->MotherEng . "</td>";
                    //$table_records .=  "<td>".$values->MotherTam."</td>";
                    $table_records .=  "<td>" . $values->GuardianEng . "</td>";
                    // $table_records .=  "<td>".$values->GuardTam."</td>";

                    /*  if($enable_td){ 
                         
                        $table_records .=  '<td onclick="copy_records(this)"> <i class="fa fa-user-plus "  ></i> </i></td>'; 
                    } */



                    $table_records .= "</tr>";

                    $si++;
                }
            } else {

                $table_records = "<tr><td colspan='9' class='text-center'   > " . $response_data . " <br/> Helpdesk : 9150056809, 9150056805, 9150056801, 9150056810 | Email:mraheas@gmail.com </td></tr>";
            }

            $resp['records'] = $table_records;

            return $resp;

            //echo $data_response['dataStatus'];


        }

        curl_close($ch);
    }

    //OTP sms code
    function  sendingOTP($mobileno,$content,$type)
    {
		
		if($type=='OTP'){
			
			$call_template = $this->smstemplate->OTP($content);
			
			
		}else if($type=='ApplicationSubmit'){
			
			$call_template = $this->smstemplate->ApplicationSubmit($content);
			
		}else if($type=='PasswordReset'){
			
			$call_template = $this->smstemplate->PasswordReset($content);
		}
		
		if($call_template){
			
			$template = $call_template['template'];
			$template_id = $call_template['template_id'];
			$template_langid = $call_template['template_langid'];
			
		}
		
		$data_response = false;
        $header_data = array(
            "Content-Type: application/json"
        );		
        $values = '{
			"keyword":"DEMO",
			"timeStamp":"071818163530",
			"dataSet": [
				{
					"UNIQUE_ID":"735694wew",
                    "MESSAGE":"'.$template.'",
					"OA":"TNGOVT",
					"MSISDN":"'. trim($mobileno) . '",
					"CHANNEL":"SMS",
					"CAMPAIGN_NAME":"tnega_u",
					"CIRCLE_NAME":"DLT_GOVT",
					"USER_NAME":"tnega_ppshtsi",
					"DLT_TM_ID":"1001096933494158",
					"DLT_CT_ID":"'.$template_id.'",
					"DLT_PE_ID":"1301157259712022912",
					"LANG_ID":"'.$template_langid.'"
				}
			]
		}';

        $getUrl = SMS_OTP_SEND;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $getUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $values,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,

            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 0,
            //CURLOPT_TIMEOUT => CURL_EXEC_TIMELIMIT,
        );
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, $curlOpts);
        $_response = curl_exec($ch);
        //var_dump($_response);

        if (curl_error($ch)) {
            if (curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
                //  throw new Exception("Unable to fetch the required SAP data");
            } else {
                // throw new Exception(curl_error($ch));
            }

            $data_response = false;
        } else {

            $data_response = json_decode($_response);
        }
        return   $data_response;
        curl_close($ch);
    }

 
/*  function  sendingOTP($mobileno, $otp)
    {

        define('SMS_SEND', 'http://digimate.airtel.in:15181/BULK_API/InstantJsonPush');
        $data_response = false;

        $header_data = array(
            "Content-Type: application/json"

        );

        //$otp = '236547';

        $values = '{
			"keyword":"DEMO",
			"timeStamp":"071818163530",
			"dataSet": [
				{
					"UNIQUE_ID":"735694wew",
					"MESSAGE":"Your OTP for CAN Registration is ' . $otp . ' TNGOVT",
					"OA":"TNGOVT",
					"MSISDN":"' . trim($mobileno) . '",
					"CHANNEL":"SMS",
					"CAMPAIGN_NAME":"tnega_u",
					"CIRCLE_NAME":"DLT_GOVT",
					"USER_NAME":"tnega_ppshtsi",
					"DLT_TM_ID":"1001096933494158",
					"DLT_CT_ID":"1007181940113901894",
					"DLT_PE_ID":"1301157259712022912",
					"LANG_ID":"0"
				}
			]
		}';

        $getUrl = SMS_SEND;

        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $getUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $values,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,

            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 0,
            //CURLOPT_TIMEOUT => CURL_EXEC_TIMELIMIT,
        );
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, $curlOpts);
        $_response = curl_exec($ch);
        //var_dump($_response);

        if (curl_error($ch)) {
            if (curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
                //  throw new Exception("Unable to fetch the required SAP data");
            } else {
               // throw new Exception(curl_error($ch));
            }
            
            $data_response = false;
        } else {

            $data_response = json_decode($_response);
        }
        return   $data_response;
        curl_close($ch);
    } */

   
    //OTP sms code

    function AadharOTPGeneration($aadharno)
    {
        $result = [];

        $pid = base64_encode('PID-XML');
        $service_url = 'https://tnpreauth.tn.gov.in/clientgwapi/api/Aadhaar/GenerateOTP';
        $curl = curl_init($service_url);
        $curl_post_data =  '{
                "AUAKUAParameters" : 
                {
                    "LAT" : "17.494568",
                    "LONG" : "78.392056",
                    "DEVMACID" :"11:22:33:44:55",
                    "CONSENT": "Y",
                    "SHRC" : "Y",
                    "VER" : "2.5",
                    "SERTYPE" : "10",
                    "ENV" : "2",							         
                    "CH" : "0",
                    "AADHAARID":"' . $aadharno . '",
                    "SLK" : "'.AADHAR_API_KEY.'",
                    "RRN" : "123456789123123",
                    "REF" : "FROMSAMPLE",
                    "UDC" : ""
                },
                    "PIDXml": "' . $pid . '",
                    "Environment":"0"
        }';

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        } else {

            $decoded = json_decode($curl_response, true);
            $result['msg'] = $decoded['ret'];   //y =  is otp sent, n = otp not send
            $result['trns_code'] = $decoded['txn'];    //need to send during eKYC verfication 
        }

        curl_close($curl);
        //var_dump( $result);
        return $result;
    }

    function verifyeKYC_aadhar($aadharno, $otp, $transction_no)
    {

        $result = [];
        $pid = base64_encode('<Pid-XML>');
        $service_url = 'https://tnpreauth.tn.gov.in/clientgwapi/api/Aadhaar/KYCWithOTP';
        $curl = curl_init($service_url);
        $curl_post_data = '{ 
            "AUAKUAParameters" : { 
                "LAT" : "17.494568",
                "LONG" : "78.392056",
                "DEVMACID" :"11:22:33:44:55",
                "DEVID" : "F0178BF2AA61380FBFF0",
                "CONSENT": "Y",
                "SHRC" : "Y",
                "VER" : "2.5",
                "SERTYPE" : "05",
                "LANG" : "N",
                "PFR" : "N",
                "ENV" : "2",
                "OTP" :"' . $otp . '",							         
                "AADHAARID":"' . $aadharno . '",
                "SLK" : "'.AADHAR_API_KEY.'",
                "RRN" : "123456789123123",
                "TXN" : "' . $transction_no . '",
                "REF" : "FROMSAMPLE",
                "UDC" : ""
            },
            "PIDXml": "",
            "Environment":"0"
                                
        }';

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $curl_response = curl_exec($curl);

        if ($curl_response === false) {

            $info = curl_getinfo($curl);

            die('error occured during curl exec. Additioanl info: ' . var_export($info));
            curl_close($curl);
        } else {

            $decoded = json_decode($curl_response, true);
            $result['ret'] = $decoded['ret'];
            $result['errdesc'] = $decoded['errdesc'];
            $result['err'] = $decoded['err'];
            $aadhar_details = $decoded['responseXML'];
            $xml_object =  simplexml_load_string(base64_decode($aadhar_details));
            $result['name'] = $xml_object['name'];
        }

        curl_close($curl);
        //var_dump($result);		
        return $result;
    }

    function npciVerification($aadharno)
    {




        $result = '';

        $xml_respnse =  '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
            <soapenv:Body>
            <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                <return>
                    <aadhaarNumber>XXXXXXXX4183</aadhaarNumber>
                    <bankName>XXXX Bank</bankName>
                    <error/>
                    <lastUpdatedDate>2018-07-04 13:01:29.137</lastUpdatedDate>
                    <mandateCustDate>01-05-2018</mandateCustDate>
                    <mandateFlag>Y</mandateFlag>
                    <mobileNumber>7364236387</mobileNumber>
                    <ODDate>01-07-2018</ODDate>
                    <ODFlag>Y</ODFlag>
                    <processedDateTimeStamp>2019-01-04 12:22:58.778</processedDateTimeStamp>
                    <requestNumber>SBIN100001</requestNumber>
                    <requestReceivedDateTime>2019-01-04 12:22:58.774</requestReceivedDateTime>
                    <requestedDateTimeStamp>2018-12-07 03:03:09.3</requestedDateTimeStamp>
                    <status>A</status>
                </return>
                </ns2:getAadhaarStatusResponse>
            </soapenv:Body>
            </soapenv:Envelope>';

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml_respnse);
        $xml = new SimpleXMLElement($response);

        $result['aadhaarNumber']  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->aadhaarNumber;
        $result['bankName'] = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->bankName;
        $result['mandateFlag'] = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mandateFlag;
        $result['mobileNumber']  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mobileNumber;
        $result['ODFlag']  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->ODFlag;
        $result['requestNumber'] = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->requestNumber;
        $result['status']  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->status;




        return $result;
    }
}
