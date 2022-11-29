<?php

if (PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) {
    die("Unable to process your request. Please contact your administrator");
}

setlocale(LC_TIME, 'en_IN');
ini_set('date.timezone', 'Asia/Kolkata');

include_once("./functions/fn_dashboard.php");
include_once("./Controllers/StudentRegistration.php");
include_once("./Models/RegistrationModel.php");

//Set to default script user id
$created_by = 99999999;
$limit = (isset($argv[1]) ? $argv[1] : 10);
$result = getBankNotApprovedList($limit);
$obj_stud_reg = new StudentRegistration();
$obj_reg_modal = New RegistrationModel();

if ($result && count($result) > 0) {

    foreach ($result as $key => $value) {

        $student_reg_id = (int) $value['student_registration_id'];
        $aadhaar_no = (int) $value['aadhaar_no'];
        $request_Number = date('dmHis');
        $requested_date_TimeStamp = date("Y-m-d H:i:s") . substr((string) fmod(microtime(true), 1), 1, 3);
        $mobile_Number = (int) $value['phone_number'];

        if (isset($student_reg_id) && isset($aadhaar_no) && isset($request_Number) && isset($requested_date_TimeStamp) && isset($mobile_Number)) {
            echo ".";
	    //echo "Fetching Student Details of " . $student_reg_id . "\n\r";
            // echo $student_reg_id;
            // Call NPCI with Parameter as Aadhaar Number,Mobile Number,

            $result_npci = $obj_stud_reg->CallNPCI($aadhaar_no, $mobile_Number, $request_Number, $requested_date_TimeStamp);
            if ($result_npci) {
                $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result_npci);
                $xml = new SimpleXMLElement($response);

                $aadhaarNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->aadhaar_Number;
                $bankName = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->bank_Name;
                $mobileNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mobile_Number;
                $requestNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->request_Number;
                $status = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->status;
                $error = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->error;

                $array_list_bank[] = "statebankofindia";
                $array_list_bank[] = "indianoverseasbank";
                $array_list_bank[] = "indianbank";
                $array_list_bank[] = "canarabank";

                $bank_trim = strtolower(str_replace(" ", "", trim($bankName)));
                $error_trim = strtolower(str_replace(" ", "", trim($error)));
                $cmp_string = "aadhaarnumberisnotavailable.";
                $error_cmp = strcmp($error_trim, $cmp_string);

                if (trim($status) == 'A') {

                    if (in_array($bank_trim, $array_list_bank)) {
						
						
                        $array_std_ins_update = array(
                            "student_registration_id" => $student_reg_id,
                            "npcl_status" => 1,
                            "npci_status_verified_by" => $created_by
                        );

                        $array_npcl_insert = array(
                            "student_registration_id" => $student_reg_id,
                            "npcl_bankname" => (string) $bankName,
                            "npcl_status" => trim($status),
                            "npcl_validation_msg" => 'Student Bank Details Fetched Successfully',
                            "created_by" => $created_by
                        );

                        $array_std_bank_update = array(
                            "student_registration_id" => $student_reg_id,
                            "bank_name" => (string) $bankName,
                            "status" => 'A',
                            "created_by" => $created_by,
                            "updated_by" => $created_by
                        );

                        $result_modal_npcl_log = $obj_reg_modal->submitStudentNPCLBankDetails($array_npcl_insert);
                        $result_Student_inst_npci = $obj_reg_modal->UpdateNPCIStatus($array_std_ins_update);
                        //$result_modal_npcl_log = $obj_reg_modal->UpdateBankDetails($array_std_bank_update);
                        //Added By GG on 16-Nov-2022 - START
                        $result_modal_npcl_log = $obj_reg_modal->saveBankDetails($array_std_bank_update);
                        $result_count = $obj_reg_modal->UpdateNPCICount($student_reg_id, $created_by);
                        //Added By GG on 16-Nov-2022 - END
                    
					} else {

                        $array_npcl_insert = array(
                            "student_registration_id" => $student_reg_id,
                            "npcl_bankname" => (string) $bankName,
                            "npcl_status" => trim($status),
                            "npcl_validation_msg" => 'Please open account and link your aadhar in any one of the following banks.<br/>STATE BANK OF INDIA, INDIAN OVERSEAS BANK, INDIAN BANK,CANARA BANK',
                            "created_by" => $created_by
                        );

                        $result_modal_npcl_log = $obj_reg_modal->submitStudentNPCLBankDetails($array_npcl_insert);
                        $result_count = $obj_reg_modal->UpdateNPCICount($student_reg_id, $created_by);
                    }
                } else if (trim($status) == 'I') {

                    if (in_array($bank_trim, $array_list_bank)) {

                        $array_npcl_insert = array(
                            "student_registration_id" => $student_reg_id,
                            "npcl_bankname" => (string) $bankName,
                            "npcl_status" => trim($status),
                            "npcl_validation_msg" => "Please link your aadhar card with account available in the bank " . (string) $bankName,
                            "created_by" => $created_by
                        );

                        $result_modal_npcl_log = $obj_reg_modal->submitStudentNPCLBankDetails($array_npcl_insert);
                        $result_count = $obj_reg_modal->UpdateNPCICount($student_reg_id, $created_by);
                    } else {

                        $array_npcl_insert = array(
                            "student_registration_id" => $student_reg_id,
                            "npcl_bankname" => (string) $bankName,
                            "npcl_status" => trim($status),
                            "npcl_validation_msg" => 'Please open account and link your aadhar in any one of the following banks.<br/>STATE BANK OF INDIA, INDIAN OVERSEAS BANK, INDIAN BANK,CANARA BANK',
                            "created_by" => $created_by
                        );

                        $result_modal_npcl_log = $obj_reg_modal->submitStudentNPCLBankDetails($array_npcl_insert);
                        $result_count = $obj_reg_modal->UpdateNPCICount($student_reg_id, $created_by);
                    }
                } else if ($error_cmp == 0) {

                    $array_npcl_insert = array(
                        "student_registration_id" => $student_reg_id,
                        "npcl_bankname" => NULL,
                        "npcl_status" => NULL,
                        "npcl_validation_msg" => 'Please open account and link your aadhar in any one of the following banks.<br/>STATE BANK OF INDIA, INDIAN OVERSEAS BANK, INDIAN BANK,CANARA BANK',
                        "created_by" => $created_by
                    );
                    $result_modal_npcl_log = $obj_reg_modal->submitStudentNPCLBankDetails($array_npcl_insert);
                    $result_count = $obj_reg_modal->UpdateNPCICount($student_reg_id, $created_by);
                }
            }
        }
        sleep(2);
    }
	echo "\n\r";
}

    
