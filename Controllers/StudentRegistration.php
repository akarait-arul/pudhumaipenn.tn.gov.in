<?php

ini_set('error_reporting', 0);

include_once("./Models/RegistrationModel.php");
include_once("./Models/MasterModel.php");
include_once("./classes/validation.php");
include_once("./Controllers/Mailer.php");
include_once("./Controllers/APIController.php");
require_once './libraries/vendor/autoload.php';
require_once './Config/config.php';
include_once("./Controllers/Masters.php");

class StudentRegistration {

    function __construct() {

        $this->validation = new validation();
        $this->api_controller = new APIController();
        $this->registration_modal = new RegistrationModel();
        $this->master_controller = new Masters();
        $this->master_modal = new MasterModel();
        $this->mailer = new Mailer();
    }

    ////////////////////// New Flow Methods Starts Here ////////////////////
    // School Student Unapproved Api Method
    function StudentSchoolDetailsAPI($district_code, $fromdate, $todate) {

        $result = [];
        $result_arr = [];
        $param = [];
        $api_param = array("district_code" => $district_code, "from_date" => $fromdate, "to_date" => $todate);
        if (isset($fromdate) && isset($todate)) {

            $result_record = $this->registration_modal->StudentSchoolDetailsAPI($district_code, $fromdate, $todate);
            if ($result_record) {

                // Added By Arul
                $param['api_data'] = json_encode($result_record);
                $param['api_param'] = json_encode($api_param);
                $param['created_by'] = 99999999;
                $param['api_url'] = 'getunapprovedstudents.php';
                $result_log = $this->registration_modal->SchoolAPILog($param);
                // Added By Arul
                foreach ($result_record as $data) {

                    if ($data['emis_id'] == 0) {

                        $emis_id = "No EMIS";
                    } else {
                        $emis_id = $data['emis_id'];
                    }

                    array_push($result_arr, array(
                        "studentkey" => $data['studentkey'],
                        "emis_id" => $emis_id,
                        "student_name_emis" => $data['student_name_emis'],
                        "date_of_birth" => $data['date_of_birth'],
                        "aadhaar_no" => $data['aadhaar_no'],
                        "community_name" => $data['community_name'],
                        "religion" => $data['religion'],
                        "gender" => $data['gender'],
                        "mother_name" => $data['mother_name'],
                        "parents_mobile" => $data['parents_mobile'],
                        "father_name" => $data['father_name'],
                        "institution_name" => $data['institution_name'],
                        "institution_type" => $data['institution_type'],
                        "degree" => $data['degree'],
                        "subject" => $data['subject'],
                        "date_of_admission" => $data['date_of_admission'],
                        "reg_date" => $data['reg_date'],
                        "school_completion_on" => $data['school_completion_on'],
                        "academic_year" => $data['academic_year'],
                        "year_of_study" => $data['year_of_study'],
                        "district_6th" => $data['district_6th'],
                        "school_6th" => $data['school_6th'],
                        "year_of_study_6th" => $data['year_of_study_6th'],
                        "district_7th" => $data['district_7th'],
                        "school_7th" => $data['school_7th'],
                        "year_of_study_7th" => $data['year_of_study_7th'],
                        "district_8th" => $data['district_8th'],
                        "school_8th" => $data['school_8th'],
                        "year_of_study_8th" => $data['year_of_study_8th'],
                        "district_9th" => $data['district_9th'],
                        "school_9th" => $data['school_9th'],
                        "year_of_study_9th" => $data['year_of_study_9th'],
                        "district_10th" => $data['district_10th'],
                        "school_10th" => $data['school_10th'],
                        "year_of_study_10th" => $data['year_of_study_10th'],
                        "district_11th" => $data['district_11th'],
                        "school_11th" => $data['school_11th'],
                        "year_of_study_11th" => $data['year_of_study_11th'],
                        "group_11th" => $data['group_11th'],
                        "medium_11th" => $data['medium_11th'],
                        "district_12th" => $data['district_12th'],
                        "school_12th" => $data['school_12th'],
                        "year_of_study_12th" => $data['year_of_study_12th']
                    ));

                    $encrypt_student_key = '';
                }

                $result['resp_status'] = true;
                $result['resp_code'] = 200;
                $result['resp_data'] = $result_arr;
            } else {

                $result['resp_status'] = false;
                $result['resp_code'] = 400;
                $result['resp_data'] = 'No Records Found';
            }
        } else {

            $result = 'District Code Not Found';
        }

        return $result;
    }

    // School Student Approved API
    function StudentSchoolDetailsApproved($data) {

        $result = [];
        $param = [];
        $resp_arr = [];
        $fail_arr = [];
        $total_sucess = 0;
        $total_failure = 0;
        if (count($data) != 0) {

            // Added By Arul
            $param['api_data'] = '';
            $param['api_param'] = json_encode($data);
            $param['created_by'] = 99999999;
            $param['api_url'] = 'updatestudentapprovalstatus.php';
            $result_log = $this->registration_modal->SchoolAPILog($param);
            // Added By Arul
            foreach ($data as $key => $value) {

                $studentkey = $value['studentkey'];
                $approvalstatus = $value['approvalstatus'];
                $rejectreason = $value['rejectreason'];
                if (isset($studentkey)) {
                    $result = $this->registration_modal->VerifyStudentSchoolKey($studentkey);
                    if ($result) {
                        if ($approvalstatus == 'N' && $rejectreason != '' || $approvalstatus == 'Y') {
                            $trim_reason = $this->validation->removeSpecialCharacter($rejectreason);
                            $result_update = $this->registration_modal->StudentSchoolDetailsApproved($studentkey, $approvalstatus, $trim_reason);
                        } else {
                            array_push($fail_arr, array(
                                "studentkey" => $studentkey,
                                "approvalstatus" => $approvalstatus,
                                "rejectreason" => $rejectreason
                            ));
                        }
                    } else {
                        array_push($fail_arr, array(
                            "studentkey" => $aadhar_number_masking,
                            "approvalstatus" => $data['created_by'],
                            "rejectreason" => $date_format
                        ));
                    }
                } else {

                    array_push($fail_arr, array(
                        "studentkey" => $aadhar_number_masking,
                        "approvalstatus" => $data['created_by'],
                        "rejectreason" => $date_format
                    ));
                }
            }
            
            $resp_arr['total_application'] = count($data);
            $resp_arr['application_failed'] = $fail_arr;            
            $result['resp_status'] = true;
            $result['resp_code'] = 200;
            $result['resp_data'] = $resp_arr;
        } else {

            $result['resp_status'] = false;
            $result['resp_code'] = 400;
            $result['resp_data'] = 'No Records Found';
        }

        return $result;
    }

    // Submit Application
    public function GetStudentProfile() {
        $result = [];
        $result_profile = [];
        //$student_reg_id = $_POST['student_reg_id'];
        $student_reg_id = $this->validation->decryptValue($_POST['student_reg_id']);
        $validate_student_reg_id = $this->validation->emptyCheck($student_reg_id);
        if ($validate_student_reg_id == true) {

            //Condition Check Student Already Registerd Or Not
            $result_profile = $this->registration_modal->GetStudentProfile($student_reg_id);
            //var_dump($result_profile);
            if ($result_profile) {

                //Decrypt Aadhaar Number
                $aadhar_number = $this->validation->decryptValue($result_profile['enumber']);

                //Decrypt Aadhaar Response
                $aadhar_details = $this->validation->decryptValue($result_profile['edetails']);
                $decoded = json_decode($aadhar_details, true);
                $aahdardetails = $this->getAadharDetailXml($decoded['responseXML']);
                $result_profile['aadhaar_number'] = $aadhar_number;
                $result_profile['aadhaar_photo'] = $aahdardetails['photo'];

                //Aadhaar Masking
                $aadhar_number_masking = $this->validation->aadhaarmasking($aadhar_number);
                $result_profile['aadhar_number_masking'] = $aadhar_number_masking;

                // Date of Birth
                $date_of_birth_conversion = $this->validation->dateFormateUserView($result_profile['date_of_birth']);
                $result_profile['date_of_birth_conversion'] = $date_of_birth_conversion;

                if (isset($result_profile['status']) && $result_profile['status'] == 'A') {

                    $result_profile['bank_status'] = 'Active';
                } else if (isset($result_profile['status']) && $result_profile['status'] == 'I') {

                    $result_profile['bank_status'] = 'InActive';
                }
                // EMIS Date Conversion
                if (isset($result_profile['emis_id_verified_on'])) {

                    $emis_id_verified_on_conversion = $this->validation->dateFormateUserView($result_profile['emis_id_verified_on']);
                    $result_profile['emis_id_verified_on_conversion'] = $emis_id_verified_on_conversion;
                } else {
                    $result_profile['emis_id_verified_on_conversion'] = '';
                }

                // NPCI Date Conversion
                if (isset($result_profile['npci_status_verified_on'])) {
                    $npci_status_verified_on_conversion = $this->validation->dateFormateUserView($result_profile['npci_status_verified_on']);
                    $result_profile['npci_status_verified_on_conversion'] = $npci_status_verified_on_conversion;
                } else {
                    $result_profile['npci_status_verified_on_conversion'] = '';
                }

                // NPCI Date Conversion
                if (isset($result_profile['aadhaar_ekyc_verified_on'])) {
                    $aadhaar_ekyc_verified_on_conversion = $this->validation->dateFormateUserView($result_profile['aadhaar_ekyc_verified_on']);
                    $result_profile['aadhaar_ekyc_verified_on_conversion'] = $aadhaar_ekyc_verified_on_conversion;
                } else {
                    $result_profile['aadhaar_ekyc_verified_on_conversion'] = '';
                }

                // NPCI Date Conversion
                if (isset($result_profile['sw_date'])) {
                    $sw_date_conversion = $this->validation->dateFormateUserView($result_profile['sw_date']);
                    $result_profile['sw_date_conversion'] = $sw_date_conversion;
                } else {
                    $result_profile['sw_date_conversion'] = '';
                }

                // Get Religion
                if (isset($result_profile['religion'])) {
                    $result_religion = $this->master_modal->GetReligionByID($result_profile['religion']);
                    $result_profile['religion_name'] = $result_religion['religion'];
                }

                // Get Community
                if (isset($result_profile['community'])) {
                    $result_religion = $this->master_modal->GetCommunityByID($result_profile['religion'], $result_profile['community']);
                    $result_profile['community_name'] = $result_religion['community_name'];
                }

                // Date of Admission
                $date_of_admission_conversion = $this->validation->dateFormateUserView($result_profile['date_of_admission']);
                $result_profile['date_of_admission_conversion'] = $date_of_admission_conversion;

                // Get School Details
                //var_dump($result_profile['school_6th']);
                if (isset($result_profile['school_6th'])) {
                    $result_school_6th = $this->master_modal->GetSchoolName($result_profile['school_6th']);
                    $result_profile['school_name_6th'] = $result_school_6th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_7th'] != 0) {
                    $result_school_7th = $this->master_modal->GetSchoolName($result_profile['school_7th']);
                    $result_profile['school_name_7th'] = $result_school_6th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_8th'] != 0) {
                    $result_school_8th = $this->master_modal->GetSchoolName($result_profile['school_8th']);
                    $result_profile['school_name_8th'] = $result_school_8th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_9th'] != 0) {
                    $result_school_9th = $this->master_modal->GetSchoolName($result_profile['school_9th']);
                    $result_profile['school_name_9th'] = $result_school_9th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_10th'] != 0) {
                    $result_school_10th = $this->master_modal->GetSchoolName($result_profile['school_10th']);
                    $result_profile['school_name_10th'] = $result_school_10th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_11th'] != 0) {
                    $result_school_11th = $this->master_modal->GetSchoolName($result_profile['school_11th']);
                    $result_profile['school_name_11th'] = $result_school_11th['school_name'];
                }

                // Get School Details
                if ($result_profile['school_12th'] != 0) {
                    $result_school_12th = $this->master_modal->GetSchoolName($result_profile['school_12th']);
                    $result_profile['school_name_12th'] = $result_school_12th['school_name'];
                }

                $result['data'] = $result_profile;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Student Details Not Found';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please fill all the fields';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetStudentEMIS() {

        try {

            $result = [];
            $valid_emisValidation = $this->validation->emisValidation(trim($_POST['emis_id']));
            if ($valid_emisValidation == true) {

                //Condition Check EMIS Already Registered OR NOT
                $check_emis = $this->registration_modal->CheckEMISAlreadyEXISTS(trim($_POST['emis_id']));
                $_continue = false;
                if (count($check_emis) == 0) {
                    $_continue = true;
                } else {
                    if ($check_emis['app_phase'] == 1) {
                        $_continue = true;
                    }
                }
                //if (count($check_emis) == 0) {
                if ($_continue) {
                    //if (count($check_emis) == 0) {

                    $result_api = $this->api_controller->emisApiCall(trim($_POST['emis_id']));
                    $arr = json_decode($result_api, true);
                    $array_assoc = array_column($arr, 'value', 'name');

                    if (count($arr) != 0 && $arr['status'] == 200 && $arr['dataStatus'] == true) {

                        if (trim($arr['result'][0]['Gender']) == 'Girl') {

                            if ($arr['result'][0]['StuDOB'] != '') {
                                $extr_dt = $arr['result'][0]['StuDOB'] ? $arr['result'][0]['StuDOB'] : '';
                                $dob_date = $extr_dt ? implode("-", array_reverse(explode("-", $arr['result'][0]['StuDOB']))) : '';
                                $date_str = strtotime($dob_date);
                                $dob = date("d-M-Y", $date_str);
                            } else {
                                $dob = "";
                            }

                            $flag_emis_verified = $this->validation->encryptValue('1');
                            $student_name = $this->validation->removeSpecialCharacter($arr['result'][0]['StuName']);
                            $mother_name = $this->validation->removeSpecialCharacter($arr['result'][0]['MotherEng']);
                            $father_name = $this->validation->removeSpecialCharacter($arr['result'][0]['FatherEng']);
                            $result_emis_api = array(
                                "student_name_emis" => $student_name,
                                "date_of_birth" => $dob,
                                "aadhaar_no" => str_pad(substr($arr['result'][0]['AadharNo'], -4), strlen($arr['result'][0]['AadharNo']), '*', STR_PAD_LEFT),
                                "aadhaar_no_mask" => $arr['result'][0]['AadharNo'],
                                "religion" => $arr['result'][0]['StuReligion'],
                                "community" => $arr['result'][0]['StuCommunity'],
                                "mother_name" => $mother_name,
                                "father_name" => $father_name,
                                "parent_mobile" => $arr['result'][0]['StuMobile'],
                                "guardian_name" => $arr['result'][0]['GuardianEng'],
                                "emis_verified" => $flag_emis_verified
                            );

                            $_SESSION['student_details']['AadharNo'] = $arr['result'][0]['AadharNo'];
                            $result['emis_data'] = $result_emis_api;
                            $result['error_msg'] = 'EMIS ID found';
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'You are not eligible for scholarship';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'EMIS ID not found';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else if (isset($check_emis['app_phase']) == 1) {

                    $result['error_msg'] = 'EMIS ID already registered in <b>Phase I</b>';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                } else {

                    $result['error_msg'] = 'EMIS ID already registered';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please enter EMIS ID';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }

            throw new Exception();
        } catch (Exception $e) {

            $result[] = $e->getMessage();
        }

        return $result;
    }

    public function GetAadhaarDetails() {

        $result = [];
        $validation = false;
        $empty_check_aadhaar = $this->validation->emptyCheck(trim($_POST['aadhaar_no']));
        $empty_check_aadhaar_no_emis = $this->validation->emptyCheck(trim($_POST['aadhaar_no_emis']));

        //condition check aadhaar already exists
        $check_emis = $this->registration_modal->CheckAadharAlreadyEXISTS(trim($_POST['aadhaar_no']));
        if (count($check_emis) == 0) {

            //echo (bool)$_POST['emis_validation_flag'];
            if ((bool) $_POST['emis_validation_flag'] == 0) {


                // Condition Check Aadhaar and Student Registration Validation
                if ($empty_check_aadhaar == true && $empty_check_aadhaar_no_emis == true) {

                    // Call EMIS Validation Method
                    $validate_aadhaar = $this->validation->aadhaarValidation($_POST['aadhaar_no']);
                    $validate_aadhaar_no_emis = $this->validation->aadhaarValidation($_POST['aadhaar_no_emis']);

                    //Condition Check Valid Aadhar Number          
                    if ($validate_aadhaar == true && $validate_aadhaar_no_emis == true) {

                        $validation_flag = true;
                    } else {


                        $result['error_msg'] = 'Please Enter Valid Aadhar Number';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Valid Aadhar Number';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else if ((bool) $_POST['emis_validation_flag'] == 1) {

                // Condition Check Aadhaar and Student Registration Validation
                if ($empty_check_aadhaar == true) {

                    // Call EMIS Validation Method
                    $validate_aadhaar = $this->validation->aadhaarValidation($_POST['aadhaar_no']);

                    //Condition Check Valid Aadhar Number          
                    if ($validate_aadhaar == true) {

                        $validation_flag = true;
                    } else {


                        $result['error_msg'] = 'Please Enter Valid Aadhar Number';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Valid Aadhar Number';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            }


            // Debug Aadhar Validation
            if (AADHAR_VALIDATION == true) {

                // Condition Check Aadhar in Session
                if ($_SESSION['student_details']['AadharNo'] == trim($_POST['aadhaar_no'])) {

                    //Condition Check Aadhar in EMIS Match with session
                    if ($_SESSION['student_details']['AadharNo'] == trim($_POST['aadhaar_no_emis'])) {

                        $validation = true;
                    } else {

                        $result['error_msg'] = 'Please enter the Aadhar Number given in EMIS details';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please enter the Aadhar Number given in EMIS details';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else if (AADHAR_VALIDATION == false) {

                $validation = true;
            }
            //var_dump($validation);	
            //var_dump($validation_flag);	
            if ($validation == true && $validation_flag == true) {


                //var_dump($curl_response);					

                if (AADHAR_API_VALIDATION == true) {

                    $pid = base64_encode('PID-XML');
                    $curl = curl_init(AADHAR_GENERATE_OTP);
                    $curl_post_data = '{  
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
								"AADHAARID":"' . $_POST['aadhaar_no'] . '",
								"SLK" : "' . AADHAR_API_KEY . '",
								"RRN" : "123456789123123",
								"REF" : "FROMSAMPLE",
								"UDC" : ""
							},
								"PIDXml": "$pid",
								"Environment":"0"
					}';

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_PORT, 443);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    //curl_setopt($curl, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    $curl_response = curl_exec($curl);
                    curl_close($curl);
                } else if (AADHAR_API_VALIDATION == false) {

                    $curl_response = '{
					  "ret": "y",
					  "code": "b22071c499514602aaed7c207e42f3e3",
					  "txn": "271722e9f56da71ef3447f814aebe828b7230d",
					  "ts": "2022-10-15T15:51:32.2+05:30",
					  "err": "000",
					  "errdesc": "",
					  "rrn": "123456789123123",
					  "ref": "FROMSAMPLE",
					  "responseXML": "PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPE90cFJlcyB0eG49IjI3MTcyMmU5ZjU2ZGE3MWVmMzQ0N2Y4MTRhZWJlODI4YjcyMzBkIiBjb2RlPSJiMjIwNzFjNDk5NTE0NjAyYWFlZDdjMjA3ZTQyZjNlMyIgdHM9IjIwMjItMTAtMTVUMTU6NTE6MzIuMjAwKzA1OjMwIiByZXQ9InkiIGluZm89IjAxe0EsMjAyMi0xMC0xNVQxNTo1MTozMSwyLjUsZWUyOTQzMDIzMTRiM2Q0ZmQwZTA3ZGMyYzQzMDQ5NTQ4MTRiOTQ5YTcxMTY5OWI1YWI0OTI4OTU0ZmFiZmQ0YywxZTJkZGFmYzQ3MzMxMTBiZjRiMjU2YzQ1MDQ2NzJmZjdkYzVjNWI5ODQ1NzEzNzBiOTNiZjZjMTQyYWJlYmRiLDFlMmRkYWZjNDczMzExMGJmNGIyNTZjNDUwNDY3MmZmN2RjNWM1Yjk4NDU3MTM3MGI5M2JmNmMxNDJhYmViZGIsKioqKioqKjc3MDQsYXIqKioqKioqQGhvdG1haWwuY29tfSIvPg=="
					}';
                }

                if ($curl_response === false) {

                    $result['error_msg'] = 'We are unable to process requests please try again later.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                } else {

                    $decoded = json_decode($curl_response, true);
                    //var_dump($decoded);
                    if ($decoded['ret'] == 'y' && $decoded['txn'] != '') {

                        $converted_resdata = base64_decode($decoded['responseXML']);
                        $xml_obj = simplexml_load_string($converted_resdata);
                        //print_r(json_encode($xml_obj['info'],true));
                        $result_aadhar_info = explode(",", $xml_obj['info']);

                        //var_dump($xml_obj);
                        //$result['name'] = (string)$xml_obj->UidData->Poi['name'];

                        $result['aadhar_mobile'] = $result_aadhar_info[6];
                        $result['aadhaar_trns_code'] = $decoded['txn'];
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    } else {

                        $result['error_code'] = '400';
                        $result['error_msg'] = $decoded['errdesc'];
                        $result['error_status'] = false;
                    }
                }
            }
        } else if (isset($check_emis['app_phase']) == 1) {

            $result['error_msg'] = 'Aadhaar Number already registered in <b> Phase I </b>';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $result['error_msg'] = 'Aadhaar Number already registered';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function ValidateAadhaarDetails() {

        $result = [];
        $decoded = [];
        $empty_check_aadhaar = $this->validation->emptyCheck(trim($_POST['aadhaar_no']));
        $empty_check_aadhaar_token = $this->validation->emptyCheck(trim($_POST['aadhaar_token']));
        $empty_check_aadhaar_otp = $this->validation->emptyCheck(trim($_POST['aadhaar_otp']));

        // Condition Check Aadhaar and Student Registration Validation
        if ($empty_check_aadhaar == true && $empty_check_aadhaar_token == true && $empty_check_aadhaar_otp == true) {

            // Call EMIS Validation Method
            $validate_aadhaar = $this->validation->aadhaarValidation(trim($_POST['aadhaar_no']));

            //Condition Check Valid Aadhaar Number            
            if ($validate_aadhaar == true) {


                if (AADHAR_API_VALIDATION == true) {

                    $pid = base64_encode('<Pid-XML>');
                    $curl = curl_init(AADHAR_VALIDATE_OTP);
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
							"OTP" :"' . trim($_POST['aadhaar_otp']) . '",							         
							"AADHAARID":"' . trim($_POST['aadhaar_no']) . '",
							"SLK" : "' . AADHAR_API_KEY . '",
							"RRN" : "123456789123123",
							"TXN" : "' . trim($_POST['aadhaar_token']) . '",
							"REF" : "FROMSAMPLE",
							"UDC" : ""
						},
						"PIDXml": "",
						"Environment":"0"
											
					}';

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_PORT, 443);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    //curl_setopt($curl, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    $curl_response = curl_exec($curl);
                    //var_dump($curl_response);					
                    curl_close($curl);
                } else if (AADHAR_API_VALIDATION == false) {

                    $curl_response = '{
					  "ret": "y",
					  "code": "b62370fb1ec94eab9c6646b8e3223508",
					  "txn": "UKC:015752ce458afb72aa47778ec902686fe16c24",
					  "ts": "2022-10-15T17:29:19.196+05:30",
					  "err": "000",
					  "errdesc": "",
					  "rrn": "123456789123123",
					  "ref": "FROMSAMPLE",
					  "responseXML": "PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PEt5Y1JlcyBjb2RlPSJiNjIzNzBmYjFlYzk0ZWFiOWM2NjQ2YjhlMzIyMzUwOCIgcmV0PSJZIiB0cz0iMjAyMi0xMC0xNVQxNzoyOToxOS4xOTYrMDU6MzAiIHR0bD0iMjAyMy0xMC0xNVQxNzoyOToxOSIgdHhuPSJVS0M6MDE1NzUyY2U0NThhZmI3MmFhNDc3NzhlYzkwMjY4NmZlMTZjMjQiIGluZm89IjAxMDAwNTc3eTRCYzNRZmJ6NFhBNkIxM3N0VnNmU0NYNmlBSDM5QnJpU1lmeGM1SXNyTGhzc29SYlI3KzVubDM1a25OUHp3NiIgdXVpZD0iODg1MjcwMjYzNjEzIj48UmFyPlBEOTRiV3dnZG1WeWMybHZiajBpTVM0d0lpQmxibU52WkdsdVp6MGlWVlJHTFRnaVB6NDhRWFYwYUZKbGN5QmpiMlJsUFNKaU5qSXpOekJtWWpGbFl6azBaV0ZpT1dNMk5qUTJZamhsTXpJeU16VXdPQ0lnYVc1bWJ6MGlNRFI3TURFd01EQTFOemQ1TkVKak0xRm1Zbm8wV0VFMlFqRXpjM1JXYzJaVFExZzJhVUZJTXpsQ2NtbFRXV1o0WXpWSmMzSk1hSE56YjFKaVVqY3JOVzVzTXpWcmJrNVFlbmMyTEVFc1pUTmlNR00wTkRJNU9HWmpNV014TkRsaFptSm1OR000T1RrMlptSTVNalF5TjJGbE5ERmxORFkwT1dJNU16UmpZVFE1TlRrNU1XSTNPRFV5WWpnMU5Td3dNVEF3TURBd01UQXdNREF3TURFd0xESXVNQ3d5TURJeU1UQXhOVEUzTWpreE9Dd3dMREFzTUN3d0xESXVOU3hsWlRJNU5ETXdNak14TkdJelpEUm1aREJsTURka1l6SmpORE13TkRrMU5EZ3hOR0k1TkRsaE56RXhOams1WWpWaFlqUTVNamc1TlRSbVlXSm1aRFJqTERGbE1tUmtZV1pqTkRjek16RXhNR0ptTkdJeU5UWmpORFV3TkRZM01tWm1OMlJqTldNMVlqazRORFUzTVRNM01HSTVNMkptTm1NeE5ESmhZbVZpWkdJc01XVXlaR1JoWm1NME56TXpNVEV3WW1ZMFlqSTFObU0wTlRBME5qY3labVkzWkdNMVl6VmlPVGcwTlRjeE16Y3dZamt6WW1ZMll6RTBNbUZpWldKa1lpeE9RU3hPUVN4T1FTeE9RU3hPUVN4T1FTeE9RU3hPUVN4T1FTeE9RU3dzVGtFc1RrRXNUa0VzVGtFc1RrRXNUa0Y5SWlCeVpYUTlJbmtpSUhSelBTSXlNREl5TFRFd0xURTFWREUzT2pJNU9qRTVMakF6T1Nzd05Ub3pNQ0lnZEhodVBTSlZTME02TURFMU56VXlZMlUwTlRoaFptSTNNbUZoTkRjM056aGxZemt3TWpZNE5tWmxNVFpqTWpRaVBqeFRhV2R1WVhSMWNtVWdlRzFzYm5NOUltaDBkSEE2THk5M2QzY3Vkek11YjNKbkx6SXdNREF2TURrdmVHMXNaSE5wWnlNaVBqeFRhV2R1WldSSmJtWnZQanhEWVc1dmJtbGpZV3hwZW1GMGFXOXVUV1YwYUc5a0lFRnNaMjl5YVhSb2JUMGlhSFIwY0RvdkwzZDNkeTUzTXk1dmNtY3ZWRkl2TWpBd01TOVNSVU10ZUcxc0xXTXhORzR0TWpBd01UQXpNVFVpTHo0OFUybG5ibUYwZFhKbFRXVjBhRzlrSUVGc1oyOXlhWFJvYlQwaWFIUjBjRG92TDNkM2R5NTNNeTV2Y21jdk1qQXdNQzh3T1M5NGJXeGtjMmxuSTNKellTMXphR0V4SWk4K1BGSmxabVZ5Wlc1alpTQlZVa2s5SWlJK1BGUnlZVzV6Wm05eWJYTStQRlJ5WVc1elptOXliU0JCYkdkdmNtbDBhRzA5SW1oMGRIQTZMeTkzZDNjdWR6TXViM0puTHpJd01EQXZNRGt2ZUcxc1pITnBaeU5sYm5abGJHOXdaV1F0YzJsbmJtRjBkWEpsSWk4K1BDOVVjbUZ1YzJadmNtMXpQanhFYVdkbGMzUk5aWFJvYjJRZ1FXeG5iM0pwZEdodFBTSm9kSFJ3T2k4dmQzZDNMbmN6TG05eVp5OHlNREF4THpBMEwzaHRiR1Z1WXlOemFHRXlOVFlpTHo0OFJHbG5aWE4wVm1Gc2RXVSthME5ZUkc1YVZHOTFTblFyS3pWM1drdGhjVzlTYUZOTmIxazNkVXhhZFc1WU5GcFFWSHByVjBWTWF6MDhMMFJwWjJWemRGWmhiSFZsUGp3dlVtVm1aWEpsYm1ObFBqd3ZVMmxuYm1Wa1NXNW1iejQ4VTJsbmJtRjBkWEpsVm1Gc2RXVStSa0ZyYVdGSFFucEdOMVl2T0ZkbFFpdHRNRXBEYm1sQlZVdDVMMHh6Vm1jNWIwdE5SR0ZQV0VwaVJ6VkhabmhtTVRONVJraHNVazFaVUVGNFNDOUpSREJYVnl0MVZIa3JOMXB6WXdwTmNuUnBkRzlVVW04eGJqSkxkalZXV1RJek1HbzBkbll6Y0VSVFFqWkVXV1pFVW5CMldtVTRSVTlETW5acWJXSk5abWxZTTNCQ1QwNVJTamREUzFCc1JGQmFlVkpZT1U5dGMxTTNDbmRuVmtSWVdYVkVRakJqYVU1RFZYVXZTRk5UUkVGeGEyNUpiM1ZOT1dVMVIyTmtNM1oyUVd4aGJ5dDZhMHh5T0ZKR1RHOTVWVEZJUlZwNFZXRmFOMU5uVTNweWN6SkdjVGQyYkdZS2FXcGFNV05HWmt4c2NHWlVTblV2Y1hwek4zUk1kakpFZVVkTFl5OVJkamd2TDA5eE5IbE5hWE15YXpodU4zRjNXREJYTTNkTWJXSjJjbloxYWk4ek9HdE9iakF3ZUhRNVFXdDJkZ3BEYlRWclp6SlVOWEpKWldsUGNFcDFhSGRyWkRad1QyTTJUMUEzUWt0aWIxRkJNRzVJZHowOVBDOVRhV2R1WVhSMWNtVldZV3gxWlQ0OEwxTnBaMjVoZEhWeVpUNDhMMEYxZEdoU1pYTSs8L1Jhcj48VWlkRGF0YSB0a249IjAxMDAwNTc3eTRCYzNRZmJ6NFhBNkIxM3N0VnNmU0NYNmlBSDM5QnJpU1lmeGM1SXNyTGhzc29SYlI3KzVubDM1a25OUHp3NiIgdWlkPSI5NDY2NzE3NzI0MjMiPjxQb2kgZG9iPSIwNy0wNC0xOTg5IiBnZW5kZXI9Ik0iIG5hbWU9IkFydWwgTXVydWdhbiIgLz48UG9hIGNvPSJTL086IEVsdW1hbGFpIiBjb3VudHJ5PSJJbmRpYSIgZGlzdD0iVmlsdXBwdXJhbSIgaG91c2U9IjI2IiBsb2M9IlNJVFRBTVBPT05ESSIgcGM9IjYwNDIwNSIgc3RhdGU9IlRhbWlsIE5hZHUiIHN0cmVldD0iUElMTEFJWUFSIEtPVklMIFNUUkVFVCIgdnRjPSJNSU5BTUJVUiIgLz48TERhdGEgLz48UGh0Pi85ai80QUFRU2taSlJnQUJBZ0FBQVFBQkFBRC8yd0JEQUFnR0JnY0dCUWdIQndjSkNRZ0tEQlFOREFzTERCa1NFdzhVSFJvZkhoMGFIQndnSkM0bklDSXNJeHdjS0RjcExEQXhORFEwSHljNVBUZ3lQQzR6TkRMLzJ3QkRBUWtKQ1F3TERCZ05EUmd5SVJ3aE1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakwvd0FBUkNBRElBS0FEQVNJQUFoRUJBeEVCLzhRQUh3QUFBUVVCQVFFQkFRRUFBQUFBQUFBQUFBRUNBd1FGQmdjSUNRb0wvOFFBdFJBQUFnRURBd0lFQXdVRkJBUUFBQUY5QVFJREFBUVJCUkloTVVFR0UxRmhCeUp4RkRLQmthRUlJMEt4d1JWUzBmQWtNMkp5Z2drS0ZoY1lHUm9sSmljb0tTbzBOVFkzT0RrNlEwUkZSa2RJU1VwVFZGVldWMWhaV21Oa1pXWm5hR2xxYzNSMWRuZDRlWHFEaElXR2g0aUppcEtUbEpXV2w1aVptcUtqcEtXbXA2aXBxckt6dExXMnQ3aTV1c0xEeE1YR3g4akp5dExUMU5YVzE5aloydUhpNCtUbDV1Zm82ZXJ4OHZQMDlmYjMrUG42LzhRQUh3RUFBd0VCQVFFQkFRRUJBUUFBQUFBQUFBRUNBd1FGQmdjSUNRb0wvOFFBdFJFQUFnRUNCQVFEQkFjRkJBUUFBUUozQUFFQ0F4RUVCU0V4QmhKQlVRZGhjUk1pTW9FSUZFS1JvYkhCQ1NNelV2QVZZbkxSQ2hZa05PRWw4UmNZR1JvbUp5Z3BLalUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2Z29PRWhZYUhpSW1La3BPVWxaYVhtSm1hb3FPa3BhYW5xS21xc3JPMHRiYTN1TG02d3NQRXhjYkh5TW5LMHRQVTFkYlgyTm5hNHVQazVlYm42T25xOHZQMDlmYjMrUG42LzlvQURBTUJBQUlSQXhFQVB3RDMyaWlpZ2tNVVVVVUFnb29vb0dGRkZGQXdvb29vQUtLS0tBQ2lpaWdBb29vb0FLS0tLQmhSUlJRQVVVVVVFc0tLS0tBUVVVVVVEQ2lvYnE2aHM3WjdpNGtXT0pCbG1ZNEFGZUhlTlBpMWRYRjFKYTZQSTBFS25BbFZ1VzkrS2FWeVhLMmg3dGtlb3BjMThmejYvcUY1ZEdhYThtYVU4N3pJY2o2VkUydVhrcHhMZHpzeUhJTFNFNC9XcTVVTG1aOWkwVjhsd2VOOWZ0d0FOYXZ3b3h4OW9ZOGZuWFdhVDhZTmNzWmxGemNKZFI5Q3NxaitZd2FPVU9aOWo2SW9ya2ZESHhCMG54SUZpUW1DNXdDWTI1QitoNzExb0lJeURrVkxWaWsweGFLS0tRd29vb29BS0tLS0FDaWlpZ0Fvb29vRUZRWGw1YjZmYVMzVjFLc1VFU2xuZGpnQVZQWGpYeHc4V05hMmtPZzJ6a05JUE5ueDZkaC9YOHFhVndic2poUGlMOFI3M3hMZlNXOEVoaDB5TnYzY1FPTitPN2UvOHE4N2E2TGpPV0h2MXBHRWx4TGpHYXR3NlhLMlBsTlU1SkNqRXFDVXNRQzVIUEh5MUo1THVkd1lHdG0zME1rQWtWcXdhSkdwQk5adXFrYUttems5c3lEYXdPT3hwR2QwQkJCeGpxSzc1ZEJobFhCVUROSWZDa1o1VmMvV2txb09GampOTzFhZXhsV1NOMlZoMHdjR3ZvUDRiZkVhUFdXWFRMMW0rMGxBVkp4eVIxL3hyeHU5OEtTSmtvRG50VVhoMHphWjRrdEM3K1NVa0JMWTdkNjBqSlMwTXBSdHFmWGxGVjdHWkxpeWhsU1FTS3lBaGgzcXhVbEozUVVVVVVEQ2lpaWdBb29vb0pRVVVVVUZGYS92WWRPMCs0dmJodHNNRWJTT2ZZREpyNUE4U2F0YytLUEVsMWV0dTNUeWtnWis2dllmbFgwMzhUYnhyTDRmYXE2NDNPZ2lHZjhBYVlBL29UWHpMbzZyNXpTTndlMU85bzNKdGVSZHNkTWl0VUdSdWYxclNTSkFlQlVSUHB4VDQ5MjZ1WjY2bTZMYXFNVk11QlVLS3g3MVlTQnl1UUtrdEZpR1FqSGV0T0NkY0RMYzFsUnhOL0VLdXgyK1V6bkZYRmtTUmRlUkdBQkFPYXhOZDBaYnFEN1JiS0JOSHlQZjJyUUtGZW9OU0NZckdhRTJtVHVqZitEM2kyYVo1ZkQ5NnhKQU1sdXpIbmo3eS8xL092WDYrYy9DMHJhZjhRZFB1TGNETDNDb2M5TU9kcC9RMTlHVjB2WFV5V21nVVVVVkpRVVVVVUFKUzBsQW9JUXRGRkZCUjU3OFoyeDhQNUJuR2JpTVk5ZXRmUGVsb1M3SFB5aml2b3I0d1dyWFB3OXVtVUQ5MUxISWM5dWNmMXJ3R3dVUVdZWTk4bWxQNFJ4WHZGM1lUeVd3UGVwbGxnandHa1hQMXJIa3ZNdmtzZnBVVnhHc3NlNHZnOXR6WXJGSzVyZXgwOEZ4QXpjU0Q4SzZLeDhSUzJsdXNVVWRxVkhkNEZKUDQ0cnlWYnFXMmZHU1JXM3A5N1BLQmdHb2xUTFVrOXp0TC9XemR5SzgrejVPaW9nVUQ4cXBmOEpOWndFcXh6OWE1L1VQdFN3K1p5RnhrNXJuUk5KTkxsdHFyNmswNFFGSnBIcE1XdjJOendQMHE0cGltVW1Od3c5UFN1QXRHQzRXT2VCbkhPeGlWSi9PdDdUZFJKa0EybEhVNFpUVk5XSldwb1d3Tmg0aXM1QUMyMmRIVWV1R0hGZlNJNlY4OWhCTnFtbU9BRG01UWZxSytoSzNpN3hWekpxMGdvb29vQUtLS0tBRU5GTFNVRU1XaWdVVUZJNUh4eHFta3plSHRVMGlhL3QxdTVMZHRzVE9NN3NaQSt2U3ZuZ1JGclZVSHBpdHJ4dzg0OGVhMDNtRlVGd3dBYXMrelVQQWpIdUtpckpKV0toRjN1WTgrbXlidDRmNVJ6Z2RhanUwVlpFa3RDaUhidGRYR2Z4cnB6YnF3elVSdFkrdmxnbjNGWXhxbXpwM01KTGFGcmFKVmovZUxrczNacysxWDlNdHlzb1ZSK0ZXNUlValRweWVnRlh0SWpqUnR6bGMrNXBUbTdEaEJYc1hOU3NBMWhFaktRR1hIUGV1V24wZjdMSEtqd2xqSjBZRGxmcFhveGF6dTdEeW5tVkpPcUE5RCtOVUZhRWcyOXdvei9DVDBJcUtjMlZPQ09KMGkwRU0waGtpTTdPdXpNaWo1UjdWMEZ0bzBhTWpSN2dUL0NUbXRWTEpVZmRIakh2eldsYlJLdkxLQ2ZVVmNxamJKVUVqUFIwc3JyVHBwVCs2aXU0MmZqT0FEay95cjJqUlBFdW02K1pWc3BTWGl3V1JoZ2dIb2E4YTFtTldzemc3UXJnaytnNmYxclkrRDF1eWVKZFhrT1NQSVVCdTNMZi9BRnEzcHl1ckdVNDYzUFpLS0tLc2dLS0tLQUNrSXBhS0NXcmlad2FXbTB0QWt6NS8rTTJuQzE4VW00akgvSDFDa2hIb1JsZi9BR1d1UnRaUWxxbmZIRmVsZkdxRmhmV000SXdiZGx4MzRiLzY5ZVRRU2tRa0dzNml1YXdsWTNZNXR3SFA2MC9lQjNyRmpuSVBYT2FzTGM1NDlPdFlLTmpkeUg2ak84VUpsVUhwamlzU3dtMVNQZk14RFJIa0RQTmJNOXpHVTI5ZmFxd1NXVWorRlQ2OFZvbHBxUTVhNkRSZjZoZFF1bHNOcjQ2c09sYXVpalVydTBFTnloTG8zREh2VWRwQTBEQTdsQTlTZXRhOXRxc2xzTnJvQnp3Zldtb3BiQTV0N2l4M1VzREdOOGdyd1JWdGRRZFJnRTFRdmJsTGxoS2d3eEhOUVJ5bjFyTnhMakkxcnVZeldFaXQzR1AxcjBMNFQ2Y2JiVGI2NmI3MHJwSDdqYUNmL1poWGw3eTV0Z004azE2LzhOWm9uMFM0UkpOemliZXc5TXFCL3dDeW10cWFzakdidXp0YUtLSzBJQ2lpaWdBb3BBYUtDVXdOQW9OSlRKdWNmOFEvRE5scldnM041TXNuMnEwZ2RvbVJ1dkdjRWR4WHpVamxHWlQyTmZYMS9BdDNZVDI3ZEpJeXY1aXZrZldiYVRUdFd1YmFSQ3BqY3JnaWs5aTR2VWozWUlPYWU4bTFPT005NnBHVHBTK2RrQUdza2paanZ0RXFzQWlGaWUrTTgxZXQ3WFVMaE9KbzEvM201cXQ1NnhyZ0hHYVo5dWxVL0xnL1dtSkd4QnBXcDd0clhWc2dIY3VUL1NtWGtXbzJrUjRXZGM5WWlUZyt0WnlhcGRmeERqOGEwb05STFIvT08xQTM1Q1dGMDdqYStRZlExcHJqdldZV1VzV1ZjSDFGVzRwT0JrOWFHcmhFMG9VTThzVVE1THVGSDRtdm9QUTlBMDdRclprMCszOHJ6Y0YvbUxFbkh2WGgvZzJ4YlVmRk5qQ0Vaa1dRU1Bqc0J6bXZvVURBclJLeU1wUFVLS0tLQUNpaWlnQ01HbkEweHVLUU42MVJpbVMwbEFPYVhOSWU0bWE4QStNMmhKWmE2bC9EdHhjcmxsQjVCSGV2YzlVMUJkT3NKTGhzRmdQbEhxYStXZkZmaUM2MWp4SGN0UEtYeVNCazhENlVtYVJpN2N4ejRHUWZXa1BHYzV6U0NRS3hCNjFLR1J4emlwTk5ScXFXNkdyVVVTTGhqelZVa3grNDlxUFBJNkhpa3hvMnJaWW1PQ0JqM3FhU3lqR1N2UTlqV0VsMHlucml0Q0crTEx5YzByTW90QmRuWHRVc1RjY0R2Vk5wMVBMVkpEY0tvYVRCMnhqTlVpV2U2L0N2UVJiYVkrcnlyaVc0eWtZOUVIZjhUWG9sZWVmQy93QVJycU9rTGFPUXZsQUJGOU9LOURxMlp5aTB3b29vcEFGRkZGQUVMWnBsU21vWkhWQmxtQ2dkeWFvd0pGZWlhZElJV2tjZ0tveldSZWE3YVdpNXlaRDJDOTZ5NzNVWjc2Qk42Q05TY2hRYzhlOUk2S2RDVW1yN0dUNHExT2E1MCthUXRoU0NFQTdWODk2NWJHTFhzSEkzcUh6K2xlKytJSVNkT0NqcHhYa1hqV3dhRklMeFIvcXpnNC91bi82OVNkczZhVU5PaHlrOExBNVBIb2V4cUFoMUE2NCt0YWNFeVNJQWNFZWhwejJjYmpLRXAvS291Y3BsaVk0d2VsTkpCNUI1cTFKWU9PUnRQMDRxczluS0Q5MXZ6RlVnQU42MUtzK0IxcU5iT1QrNGZ6cTViYWVXT1N3Rk1MQkR2bElBNHljZEsyWnJiN1BwY201Y0Zod3ZlbjJVRU5yOCtBVy92R3J1bVFmMjdyOXZacmt4SVRMS1FlQXE4L3p3UHhvUTlXN0hZK0FNMkJ0bDVEU0VCajZZNzE3WmEzYXp2SkYvSEhqUDBOZVphQlpyNThlRUEyUzV4N2MxMjJqVCtacUY0eDdNRkIvQ3IzTjZsTmNoME5GVVcxRllMc1FUcnREREtPRHczLzE2dXF3WVpCelNhc2NiaTB0UXpTMGxMU0pPUG04U1hWeG55RUVTZjNqeWF6dDg5NUl6VHl1NkE1d1R4VDBoQ3FNbW5IQ1FzUU9nb1BTakNNZmhSU0VmMm0vVU45eGUxYkpWSDQ2QVZ4bXA2dmZhYmJ5VFdFQ3lURTdkejhoUjY0cmlidnhuNHVFMjc3WXFqKzRzUXgvS2cxY0dldGF1Z21oQ0RqSndQZXVMMXpTaGVhVkpDeWJtQU9QY1ZENFU4YzNlcjZuRnB1cnh4Szc4UnpJTVpiSFEvV3UxdXJIY1JnY2puTkZyb2RsYXg4OXo2YzFyT1VESC9aWWQ2UUM0VVkyN2dQU3V1MXpUR2kxeTloZUwvUk53Y3NvNWpKSDN2cHp6OWF5cHRQbXMyQ3VBVkl5ckRvdzlSWE01V2ZMSTQ1VTNGMk1Yekd6Z29RZmNVR1Vqc2Z5cllXRU4xRlRyYVJkMUdhSE5JRkZuUGVjYzhJVDlCVm1CYnFYL0FGVnUzMUl3SzNsdGtIUkJWZ0xnWUFwcVluRm1SQnBsek82Sk01QlpnRmpUa2tudFhwbmhIdy9hYVkxeEpDUTBwQWdkdjlycTJQYnQrRlVMYlFMalI5TWgxU1dQZGYzSVAySzNQVURITWplZ0E5YTJ2Qlc2MjhNbWE0SmJNamtram5MY21xcHljcGFiRHBSdTduUTZmYUMzbjNBY0U1L0ExdWFjdXhOMk9YWXVjZldzcTZ2NGJMU3A3eDEzcEhGdkF6amNldy9FOFY1TnF2alB4TnFVcGl0cnByU0RKQ3BEZ0hIdWVwcm92WTZWQnlSN3Bxa0szVmdWNVdSU0dRKzlVZE52UE8vMGVaM2puVVlEaGlNMXlIdzhIaVNmOS9xTjlJMWtpN1BMa080eUgxeWVtSzZyVWJReHpDYVBnNXpWb2xRUzkxbXMyb1QyWkFuUXVuOTRWZHRyKzN1bHpISU00NUI2aXMyeHUxdW9mSm1BSjZjMVJ2OEFUSmJkdnROZysxMTVLZW9xV2tZdWxHVHM5R1UzQnh4d0JVRndENUdPNTVxZVg1bVZSd0NlZnBUWDJzM0o0SFlVSkc4VEFrdGM3Z3c0TlpjK2pXOGpPL2tqZDY0cnNHdC9OSnlNQWRxaGt0VUNFQURORmpaU1BNTDdTL3NrNnp4S0ZhTmd5a0RrSHNhOUEwSHhWWmFxa2NWMjMyZTd4Z2h2dXNmVUgrbForbzZlR1ZqdHlEWE16YWNZWlFWQkF6K1ZMWXZsVE8xdmROVC9BSVNQY1VESkl1Q2NjRU1PNS80RDA5elhQNjk0ZlhTMkRlVzhtbE0vekt2TFFFK250Vk9HOHY3YUxFTWhJVncreHVRU0FRUC9BRUkxMWZoblgwOFNXODJuYWtrYVhnVWhreDhzcStvL3JXZFNuR3BHek01MDN1Y0JQbzJGYWV5ZjdUYkQrSlI4eS83dzZpcWV6SGF0dlZOT20wSFdaWUVkMHdkMGJBNHlwNmY0ZmhUSDFaSjhDKzArQzRZSC9XTG1OejlTT0QrVmNEVTRPejFPWXlRTWRLN1B3ejRaeDVXb2FuRUdWdWJlMVk0TW4rMjNvbzQrdjg4S0RVN2EwdU45cnAwRXJsU3FDZFMyQ1QxQTNZempqNjgxM3VoUVhySWIzVTNMWGM1eTJRQUZVZEZIK2U5YVFqS283YklTVGJzYUY1WUc2Z3VYM0I3bVZDalNuc1A3cWpzQjZmelBOWUdnU3BhMjl4WlhnVllvMEJmdGhod2NleDI3ditCR3VydTdtRzBzbW1sbVNOQVB2T2NjMXdWbGJ2cW1yU1NvN3RCdXlwWWNucCtuR2NWM3hpa3JJM3AweTdyVWsrc1JDMmlSb2JSY0hCT1M1SFQvQVBWV2JZZUcxVzZWblhBNjVydGZzYUJCZ2RPMVNKYnJJbkF4aXRMSTE1a2xaR2pwVUVkdGJKSEd1MWF2eXhoaGlxTm1TaTQ2NHErSEhjNUJvT1dWNzNNdDdjd1QrWW5yMUZhU1NDNGcvd0JvQ281MDNvY0VWV3Q1R2hsNmdnOEdrRDk1R1VwNnV4eVc0QTlCVGxUdVIrRkZGQ05Gc1NqbklBeDdWR3k1ejJvb3BEUkUxdXJqN3RaMXpvMGR4bkFDazBVVTdEVGFNV2ZUbnR6aGtQSHRXTmYyY2xyTkhmV2hLU3hrTmxlMUZGUkpXWjBSZDBkT1pZUEdXZzhoWTlXdGhsY2Z4K3Y0SDlEWG44dTVIWkdCREE0SUk2R2lpc0txVzV5Vm9xTXREcmZCMmhHUWpVcmhmbDZSQS84QW9WYmV1K0o0ZEpIMmFCVm11LzRVSFJQZHY4S0tLMWdrb3F4cFNpbTdIT1dlbTMrdlhmMnJVSlhrSjVDazhENkRzSzdyU3RQanRZbEFBQm9vcldLS3FTZXhwbEZVQUFjbmlrS0JHSkE2aWlpbVkzQ0p3cmRhdHh0bGVPYUtLQ1pEc2c1eFZlYUlIREtmd29vcEVvLy8yUT09PC9QaHQ+PC9VaWREYXRhPjxTaWduYXR1cmUgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyMiPjxTaWduZWRJbmZvPjxDYW5vbmljYWxpemF0aW9uTWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMteG1sLWMxNG4tMjAwMTAzMTUiIC8+PFNpZ25hdHVyZU1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyNyc2Etc2hhMSIgLz48UmVmZXJlbmNlIFVSST0iIj48VHJhbnNmb3Jtcz48VHJhbnNmb3JtIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMC8wOS94bWxkc2lnI2VudmVsb3BlZC1zaWduYXR1cmUiIC8+PC9UcmFuc2Zvcm1zPjxEaWdlc3RNZXRob2QgQWxnb3JpdGhtPSJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGVuYyNzaGEyNTYiIC8+PERpZ2VzdFZhbHVlPm5PK2tYNnZPT2JySFREckZ1bXRTaUNMbVZiVTdYVTJlZkJaQUQvbFRQeGs9PC9EaWdlc3RWYWx1ZT48L1JlZmVyZW5jZT48L1NpZ25lZEluZm8+PFNpZ25hdHVyZVZhbHVlPmtHeG5KbG5MdmhTYXF5bzFINWJhVUZESlREU09ad0dUM2tHUTdsU3hCZ3NCcndQWEJiWWdaRU5EQTNtNTJGankwZHRXNkZVOXkzRHYKSldaWU1ZRTQ1dVF0Q1Roc3VDakhuOUladkNoRXZrckpJZjlNWHhhUUpoZEkwdzVWd2dDeERCK1V2bVF4dzlQLzBLS1BRQnJqRE5yUgpiSk1QRVFOSFQ1Z0hIdFRyd25VS3F0UTl2VGN2R0NUaGhDdEZFL0cwelpjM0VPV0pIQ1U5Y01IYW9XUklVS1R3azB1aXJpSlhDcCtGClB1ZnFxVGZhUytlZmhXc0FJblVuVGp5U1FVR0U0K1JQRjRjZU9reXF0Qjd4N1B2L2dsaWMyOHIrWXdreHRFYVkyQ1RkOEZKQXVvOC8KN01WQytPWWFzWXVzNW1aNjNkV3VPWXc1TFVjTG9nNW13Z1p6RHc9PTwvU2lnbmF0dXJlVmFsdWU+PEtleUluZm8+PFg1MDlEYXRhPjxYNTA5U3ViamVjdE5hbWU+Q049RFMgVUlEQUkgMDEsMi41LjQuNT0jMTM0MDYyMzEzOTYxMzgzNzY2NjE2NTM3NjE2NTM5NjU2NjM1MzU2NjY2MzEzNjM2NjIzNTYzNjMzNjMyMzUzNzMwMzA2NTMyMzg2NDM4MzI2NDYxMzczNjYyNjQzNTMzNjYzMDM5MzgzMzM2NjU2NTYxNjU2MTYyMzM2NjY1MzMzODM1LDIuNS40LjUxPSMxMzMyNTU0OTQ0NDE0OTIwNTQ2NTYzNjgyMDQzNjU2ZTc0NzI2NTJjMjA0MTYxNjQ2ODYxNzIyMDQzNmY2ZDcwNmM2NTc4MmMyMDRlNTQ0OTIwNGM2MTc5NmY3NTc0MmMyMDU0NjE3NCxTVFJFRVQ9QmFuZ2Fsb3JlLFNUPUthcm5hdGFrYSwyLjUuNC4xNz0jMTMwNjM1MzYzMDMwMzkzMixPVT1UZWNobm9sb2d5IENlbnRyZSxPPVVJREFJLEM9SU48L1g1MDlTdWJqZWN0TmFtZT48WDUwOUNlcnRpZmljYXRlPk1JSUc3akNDQmRhZ0F3SUJBZ0lFQXY2VkJUQU5CZ2txaGtpRzl3MEJBUXNGQURDQjRqRUxNQWtHQTFVRUJoTUNTVTR4TFRBckJnTlYKQkFvVEpFTmhjSEpwWTI5eWJpQkpaR1Z1ZEdsMGVTQlRaWEoyYVdObGN5QlFkblFnVEhSa0xqRWRNQnNHQTFVRUN4TVVRMlZ5ZEdsbQplV2x1WnlCQmRYUm9iM0pwZEhreER6QU5CZ05WQkJFVEJqRXhNREE1TWpFT01Bd0dBMVVFQ0JNRlJFVk1TRWt4SnpBbEJnTlZCQWtUCkhqRTRMRXhCV0UxSklFNUJSMEZTSUVSSlUxUlNTVU5VSUVORlRsUkZVakVmTUIwR0ExVUVNeE1XUnpVc1ZrbExRVk1nUkVWRlVDQkMKVlVsTVJFbE9SekVhTUJnR0ExVUVBeE1SUTJGd2NtbGpiM0p1SUVOQklESXdNVFF3SGhjTk1qQXdOakF5TVRBMU9ETXhXaGNOTWpNdwpOakF5TVRBMU9ETXhXakNDQVJBeEN6QUpCZ05WQkFZVEFrbE9NUTR3REFZRFZRUUtFd1ZWU1VSQlNURWFNQmdHQTFVRUN4TVJWR1ZqCmFHNXZiRzluZVNCRFpXNTBjbVV4RHpBTkJnTlZCQkVUQmpVMk1EQTVNakVTTUJBR0ExVUVDQk1KUzJGeWJtRjBZV3RoTVJJd0VBWUQKVlFRSkV3bENZVzVuWVd4dmNtVXhPekE1QmdOVkJETVRNbFZKUkVGSklGUmxZMmdnUTJWdWRISmxMQ0JCWVdSb1lYSWdRMjl0Y0d4bAplQ3dnVGxSSklFeGhlVzkxZEN3Z1ZHRjBNVWt3UndZRFZRUUZFMEJpTVRsaE9EZG1ZV1UzWVdVNVpXWTFOV1ptTVRZMllqVmpZell5Ck5UY3dNR1V5T0dRNE1tUmhOelppWkRVelpqQTVPRE0yWldWaFpXRmlNMlpsTXpnMU1SUXdFZ1lEVlFRREV3dEVVeUJWU1VSQlNTQXcKTVRDQ0FTSXdEUVlKS29aSWh2Y05BUUVCQlFBRGdnRVBBRENDQVFvQ2dnRUJBTFZpd05PNzJ1cHlCUElIZk0rTUNwZ3dCY0c2cFFqMQpjZjNSNk9tTEtJMEZtMWc1M0cxOGQzY2FESmM4SnF1M29zcUFaOGJMbkdmZHE5b2tMM01WeGFWdlZuczZlVEJiNHZvbkhDakhmeVVnClBYVVJ5VVV5U0VzcmExZDQraG9Bak5EM21rV1dIQ3BVVFpCZmI4ZEFLZEJCc1Z4bDYrVy9vWExiYWFQQlNJTG40dG4vWUovYk9ZRE4KNzY5ck5qUVFOdStGcXl6bnJvaDVDVXRiOHJndHJ1YlJhV1hoR1REKytHUzgxcjh4bWlGM1F5NlB2UDRJYjlsM3hlaVAwb3dFZWFFZwpuVVhCRU51QjRudll4aFpQMEc1RExVTXBvcitVRHlyOE1sS2pjZUlDWEE3Vm5JdkN6L3d5ZlNjeUppZzBlZXZDdkFaVHRDeDMzS0NPCnl5Vk1aZDhDQXdFQUFhT0NBbmt3Z2dKMU1FQUdBMVVkSlFRNU1EY0dDaXNHQVFRQmdqY1VBZ0lHQ0NzR0FRVUZCd01FQmdnckJnRUYKQlFjREFnWUtLd1lCQkFHQ053b0REQVlKS29aSWh2Y3ZBUUVGTUJNR0ExVWRJd1FNTUFxQUNFT0FCS0FIdGVEUE1JR0lCZ2dyQmdFRgpCUWNCQVFSOE1Ib3dMQVlJS3dZQkJRVUhNQUdHSUdoMGRIQTZMeTl2WTNaekxtTmxjblJwWm1sallYUmxMbVJwWjJsMFlXd3ZNRW9HCkNDc0dBUVVGQnpBQ2hqNW9kSFJ3Y3pvdkwzZDNkeTVqWlhKMGFXWnBZMkYwWlM1a2FXZHBkR0ZzTDNKbGNHOXphWFJ2Y25rdlEyRncKY21samIzSnVRMEV5TURFMExtTmxjakNCK0FZRFZSMGdCSUh3TUlIdE1GWUdCbUNDWkdRQ0F6Qk1NRW9HQ0NzR0FRVUZCd0lDTUQ0YQpQRU5zWVhOeklETWdRMlZ5ZEdsbWFXTmhkR1VnYVhOemRXVmtJR0o1SUVOaGNISnBZMjl5YmlCRFpYSjBhV1o1YVc1bklFRjFkR2h2CmNtbDBlVEJFQmdaZ2dtUmtDZ0V3T2pBNEJnZ3JCZ0VGQlFjQ0FqQXNHaXBQY21kaGJtbDZZWFJwYjI1aGJDQkViMk4xYldWdWRDQlQKYVdkdVpYSWdRMlZ5ZEdsbWFXTmhkR1V3VFFZSFlJSmtaQUVLQWpCQ01FQUdDQ3NHQVFVRkJ3SUJGalJvZEhSd2N6b3ZMM2QzZHk1agpaWEowYVdacFkyRjBaUzVrYVdkcGRHRnNMM0psY0c5emFYUnZjbmt2WTNCemRqRXVjR1JtTUVRR0ExVWRId1E5TURzd09hQTNvRFdHCk0yaDBkSEJ6T2k4dmQzZDNMbU5sY25ScFptbGpZWFJsTG1ScFoybDBZV3d2WTNKc0wwTmhjSEpwWTI5eWJrTkJMbU55YkRBUkJnTlYKSFE0RUNnUUlTSFRYTU94bkxUWXdEZ1lEVlIwUEFRSC9CQVFEQWdiQU1DSUdBMVVkRVFRYk1CbUJGMkZ1ZFhBdWEzVnRZWEpBZFdsawpZV2t1Ym1WMExtbHVNQWtHQTFVZEV3UUNNQUF3RFFZSktvWklodmNOQVFFTEJRQURnZ0VCQUhWNGhtTEh1STMxdUZKMTdTV0wvRnkrCkMrOW1sc3ZGRnhGSEo2a3kyUk9TVlRHQVU0RnBlUzAzZXQ0MTFQSTV2TWVSVWxmbmlhV05FelVnWHZ1UDdrUysyVjNIOFgzQ3BDSG8KRjQxY1U3dkswRUJUTHZnTmpmQlRXZ2VTdHdCVmhUOVpnamZsTEtQajBwK1I5c1JnUU45aVM5VU5kTFJrcXdkWjR2NzhTaVJneStwNQptT2FuczVWTExNSXVSL0pSN3UyeGtpK005ZmY1eXJTVjdBYVRTdU1HZkQ1VkEzciswT2l1LyttdDg3NHYybXgwb2lBSXBrdEd2dmd6CklTclVzOVlMSDk3dHYvUlI0T0FPQUYzdHZtdHdUTnVYd0JEd016bHBKMiszZWhpYWhlRkZ3VDdVZ2t3cjZJNXFrbW8rL0ZDcXREOHYKNGU0WUtrQnViSUx2eFlNPTwvWDUwOUNlcnRpZmljYXRlPjwvWDUwOURhdGE+PC9LZXlJbmZvPjwvU2lnbmF0dXJlPjwvS3ljUmVzPg=="
					}';
                }

                if ($curl_response === false) {

                    $result['error_msg'] = 'We are unable to process request please try again later.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                } else {

                    $decoded = json_decode($curl_response, true);
                    $result['ret'] = $decoded['ret'];
                    $result['errdesc'] = $decoded['errdesc'];
                    $result['err'] = $decoded['err'];
                    $aadhar_response = $decoded['responseXML'];
                    $converted_data = base64_decode($aadhar_response);
                    $xml_obj = simplexml_load_string($converted_data);
                }



                if ($decoded['ret'] == 'y') {

                    $data_array = array(
                        "aadhar_no" => trim($_POST['aadhaar_no']),
                        "aadhar_info" => $curl_response
                    );

                    $result_insertekyc_temp = $this->registration_modal->InsertStudentEdetailTemp($data_array);
                    //var_dump($result_insertekyc_temp);
                    //count($result_insertekyc_temp)			 

                    if ($result_insertekyc_temp) {

                        //aadharcard details in xml 
                        $aahdardetails = $this->getAadharDetailXml($aadhar_response);
                        $result['error_msg'] = 'Aadhaar Verified successfully';
                        $flag_aadhar_verified = $this->validation->encryptValue('1');
                        $result['aadhar_verified'] = $flag_aadhar_verified;
                        $result['resp_code'] = $decoded['ret'];
                        $result['error_code'] = $decoded['err'];
                        $result['error_status'] = true;
                        $result['aadhar_details'] = $aahdardetails;
                    } else {

                        $result['error_msg'] = $decoded['errdesc'];
                        $result['resp_code'] = $decoded['ret'];
                        $result['error_code'] = $decoded['err'];
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = $decoded['errdesc'];
                    $result['resp_code'] = $decoded['ret'];
                    $result['error_code'] = $decoded['err'];
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please enter valid aadhaar number';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please enter valid aadhaar number';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // extracting  aadhar card  details from xml response
    public function getAadharDetailXml($aadhar_responsexml) {

        $result = [];
        $converted_data = base64_decode($aadhar_responsexml);
        $xml_obj = simplexml_load_string($converted_data);
        $result['name'] = (string) $xml_obj->UidData->Poi['name'];
        $result['gender'] = (string) $xml_obj->UidData->Poi['gender'];
        $stud_dob = (string) $xml_obj->UidData->Poi['dob'];
        $stu_dob = strtotime($stud_dob);
        $date_of_birth = date("d-M-Y", $stu_dob);

        $result['dob'] = $date_of_birth;
        $result['houseno'] = (string) $xml_obj->UidData->Poa['house'];
        $result['street'] = (string) $xml_obj->UidData->Poa['street'];
        $result['nagarname'] = (string) $xml_obj->UidData->Poa['lm'];
        $result['areaname'] = (string) $xml_obj->UidData->Poa['vtc'];
        $result['district'] = (string) $xml_obj->UidData->Poa['dist'];
        $result['pincode'] = (string) $xml_obj->UidData->Poa['pc'];
        $result['state'] = (string) $xml_obj->UidData->Poa['state'];
        $result['country'] = (string) $xml_obj->UidData->Poa['country'];
        $result['photo'] = (string) $xml_obj->UidData->Pht;

        return $result;
    }

    // extracting  aadhar card  details from xml response

    public function ValidateNPCI() {

        $result = [];

        // Call EMIS Validation Method
        $validate_aadhaar = $this->validation->aadhaarValidation(trim($_POST['aadhaar_no']));

        //Condition Check Valid Aadhaar Number            
        if ($validate_aadhaar == true) {

            //Condition Debug
            if (NPCI_VALIDATION == true) {

                $request_Number = date('dmHis');
                $requested_date_TimeStamp = date("Y-m-d H:i:s") . substr((string) fmod(microtime(true), 1), 1, 3);
                $mobile_Number = '';
                $return_npci = $this->CallNPCI(trim($_POST['aadhaar_no']), $mobile_Number, $request_Number, $requested_date_TimeStamp);
            } else if (NPCI_VALIDATION == false) {

                //Correct Bank Details
                $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
						<soapenv:Body>
						<ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
						<return xmlns="">
						<aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
						<bank_Name>INDIAN BANK</bank_Name>
						<error/>
						<last_Updated_Date>25-01-2013</last_Updated_Date>
						<mobile_Number>7364236387</mobile_Number>
						<processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
						<request_Number>4040032816</request_Number>
						<request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
						<requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
						<status>A</status>
						</return>
						</ns2:getAadhaarStatusResponse>
						</soapenv:Body>
						</soapenv:Envelope>';

                // Aadhaar Card Linked Senario
                /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                  <soapenv:Body>
                  <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                  <return xmlns="">
                  <aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
                  <bank_Name>INDIAN BANK</bank_Name>
                  <error/>
                  <last_Updated_Date>25-01-2013</last_Updated_Date>
                  <mobile_Number>7364236387</mobile_Number>
                  <processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
                  <request_Number>4040032816</request_Number>
                  <request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
                  <requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
                  <status>I</status>
                  </return>
                  </ns2:getAadhaarStatusResponse>
                  </soapenv:Body>
                  </soapenv:Envelope>'; */

                // Not Eligibility Senario
                /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                  <soapenv:Body>
                  <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                  <return xmlns="">
                  <aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
                  <bank_Name>INDIAN BANK</bank_Name>
                  <error/>
                  <last_Updated_Date>25-01-2013</last_Updated_Date>
                  <mobile_Number>7364236387</mobile_Number>
                  <processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
                  <request_Number>4040032816</request_Number>
                  <request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
                  <requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
                  <status>C</status>
                  </return>
                  </ns2:getAadhaarStatusResponse>
                  </soapenv:Body>
                  </soapenv:Envelope>'; */

                /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                  <soapenv:Body>
                  <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                  <return xmlns="">
                  <aadhaar_Number>XXXXXXXX8799</aadhaar_Number>
                  <bank_Name/>
                  <error>Aadhaar number is not available.</error>
                  <last_Updated_Date/>
                  <mobile_Number/>
                  <processed_Date_TimeStamp>18-10-2022 20:00:48 459</processed_Date_TimeStamp>
                  <request_Number>1234567892</request_Number>
                  <request_received_date_time>18-10-2022 20:00:48 455</request_received_date_time>
                  <requested_Date_TimeStamp>2022-12-18 12:19:09.3</requested_Date_TimeStamp>
                  <status/>
                  </return>
                  </ns2:getAadhaarStatusResponse>
                  </soapenv:Body>
                  </soapenv:Envelope>'; */
            }

            if ($return_npci) {

                $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $return_npci);
                $xml = new SimpleXMLElement($response);

                $aadhaarNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->aadhaar_Number;
                $bankName = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->bank_Name;
                //$mandateFlag = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mandateFlag;
                $mobileNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mobile_Number;
                //$ODFlag  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->ODFlag;
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
                //var_dump($error_cmp);

                if (trim($status) == 'A') {

                    if (in_array($bank_trim, $array_list_bank)) {

                        //$flag_aadhar_verified = $this->validation->encryptValue('1');
                        $flag_bank_verified = $this->validation->encryptValue('1');
                        $result['requestNumber'] = (string) $requestNumber;
                        $result['error_msg'] = NPCI_MSG_ACTIVE_WITH_BANK;
                        $result['bankName'] = (string) $bankName;
                        $result['status'] = 'Active';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                        $result['bank_verified'] = $flag_bank_verified;
                        //$result['aadhar_verified'] = $flag_aadhar_verified;
                    } else {

                        //$flag_aadhar_verified = $this->validation->encryptValue('1');
                        $flag_bank_verified = $this->validation->encryptValue('0');
                        $result['requestNumber'] = (string) $requestNumber;
                        $result['error_msg'] = NPCI_MSG_ACTIVE_WITHOUT_BANK;
                        $result['bankName'] = (string) $bankName;
                        $result['status'] = 'Active';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                        $result['bank_verified'] = $flag_bank_verified;
                        //$result['aadhar_verified'] = $flag_aadhar_verified;							
                    }
                } else if (trim($status) == 'I') {

                    if (in_array($bank_trim, $array_list_bank)) {

                        //$flag_aadhar_verified = $this->validation->encryptValue('1');
                        $flag_bank_verified = $this->validation->encryptValue('0');
                        $result['requestNumber'] = (string) $requestNumber;
                        $result['bankName'] = (string) $bankName;
                        $result['status'] = 'InActive';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                        $result['bank_verified'] = $flag_bank_verified;
                        //$result['aadhar_verified'] = $flag_aadhar_verified;
                        $result['error_msg'] = NPCI_MSG_INACTIVE_WITH_BANK . (string) $bankName;
                    } else {

                        //$flag_aadhar_verified = $this->validation->encryptValue('1');
                        $flag_bank_verified = $this->validation->encryptValue('0');
                        $result['error_msg'] = "Please open account and link your aadhaar in any one of the following banks<br/>STATE BANK OF INDIA<br/>​INDIAN OVERSEAS BANK<br/>​INDIAN BANK<br/>​CANARA BANK";
                        $result['requestNumber'] = (string) $requestNumber;
                        $result['bankName'] = (string) $bankName;
                        $result['status'] = 'InActive';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                        $result['bank_verified'] = $flag_bank_verified;
                        //$result['aadhar_verified'] = $flag_aadhar_verified;			
                    }
                } else if (trim($status) == 'C') {

                    $result['error_msg'] = "Your qualifying crieteria has to be checked and confirmed. Please contact helpdesk for further action. <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com";
                    $result['error_code'] = '401';
                    $result['error_status'] = false;
                } else if ($error_cmp == 0) {

                    //$flag_aadhar_verified = $this->validation->encryptValue('1');
                    $flag_bank_verified = $this->validation->encryptValue('0');
                    $result['error_msg'] = "Please open account and link your aadhaar in any one of the following banks<br/>STATE BANK OF INDIA<br/>​INDIAN OVERSEAS BANK<br/>​INDIAN BANK<br/>​CANARA BANK";
                    $result['error_code'] = '201';
                    $result['error_status'] = true;
                    $result['bank_verified'] = $flag_bank_verified;
                    //$result['aadhar_verified'] = $flag_aadhar_verified;
                } else {

                    $result['error_msg'] = $error;
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            }
        } else {

            $result['error_msg'] = "Invalid aadhaar number please check your aadhaar";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function CallNPCI($aadhaar_Number, $mobile_Number, $request_Number, $requested_date_TimeStamp) {

        $payload = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aad="http://aadhaar.npci.org/">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <aad:getAadhaarStatus>
				 <arg0>
					<aadhaar_Number>' . $aadhaar_Number . '</aadhaar_Number>
					<mobile_Number>' . $mobile_Number . '</mobile_Number>
					<request_Number>' . $request_Number . '</request_Number>
					<requested_date_TimeStamp>' . $requested_date_TimeStamp . '</requested_date_TimeStamp>
				 </arg0>
			  </aad:getAadhaarStatus>
		   </soapenv:Body>
		</soapenv:Envelope>';

        $headers = array(
            'Content-type: text/xml;charset=\"utf-8\"',
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: " . NPCI_API,
            "Content-length: " . strlen($payload),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, NPCI_API);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        if (curl_error($ch)) {
            if (curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
                throw new Exception("Unable to fetch data");
            } else {
                throw new Exception(curl_error($ch));
            }
        }

        curl_close($ch);

        return $response;
    }

    // Function GET EMIS DETAILS AND VALIDATION
    public function ValidateInstitutionDetails() {

        if ($_POST['form_data']) {

            $result = [];
            $array_values = array_column($_POST['form_data'], 'value', 'name');

            $emis_validation_flag_institution = $array_values['emis_validation_flag_institution'];
            $phone_number = $array_values['phone_number'];
            $email_id = $array_values['email_id'];
            $m_degree_id = $array_values['m_degree_id'];
            $subject = $array_values['subject'];
            $date_of_admission = $array_values['date_of_admission'];
            $school_completion_on = $array_values['school_completion_on'];
            $academic_year = $array_values['academic_year'];

            $empty_check_m_degree_id = $this->validation->emptyCheck($m_degree_id);
            $empty_check_subject = $this->validation->emptyCheck($subject);
            $empty_check_date_of_admission = $this->validation->emptyCheck($date_of_admission);
            $empty_check_academic_year = $this->validation->emptyCheck($academic_year);
            $empty_check_school_completion_on = $this->validation->emptyCheck($school_completion_on);
            $empty_check_email = $this->validation->emptyCheck($email_id);
            $empty_check_mobile = $this->validation->emptyCheck($phone_number);

            $validate_regx_mobile = $this->validation->mobileValidation($phone_number);
            $validate_regx_email = $this->validation->emailValidation($email_id);

            //var_dump($emis_validation_flag_institution);
            // Condition Check EMIS and Student Registration Validation
            if ($empty_check_m_degree_id == true && $empty_check_subject == true && $empty_check_date_of_admission == true && $empty_check_academic_year == true && $empty_check_school_completion_on == true && $empty_check_email == true && $empty_check_mobile == true) {

                // Validate Mobile Number
                if ($validate_regx_mobile == true) {

                    // Validate Email ID
                    if ($validate_regx_email == true) {

                        $otp_validation = $this->master_controller->limitOTPMobile($phone_number, '1');
                        if ($otp_validation) {

                            $result_check_registration = $this->registration_modal->checkRegistration($phone_number, $email_id);
                            if (count($result_check_registration) == 0) {

                                if ($emis_validation_flag_institution == 'false') {

                                    $emis_id = trim($_POST['emis_id']);
                                    $empty_check_emis = $this->validation->emptyCheck($emis_id);
                                    $valid_emisValidation = $this->validation->emisValidation($emis_id);
                                    // Validate EMIS
                                    if ($valid_emisValidation == true) {

                                        $result_validation = $this->validateStudentDetails($m_degree_id, $school_completion_on);
                                        if ($result_validation['error_code'] == 200 && $result_validation['error_msg'] == "Valid") {

                                            //Variable Define Table Where to Check
                                            $table = "emis_approved_6to12";

                                            //Call Function and check EMIS  in Table
                                            $get_emis_details = $this->GetEMISDetailsDB($table, $emis_id);
                                            if ($get_emis_details['error_code'] == 200) {

                                                $result['validation'] = "Valid";
                                                $result['error_msg'] = '';
                                                $result['error_code'] = '200';
                                                $result['school_eligibility'] = $result_validation['school_eligibility'];
                                                $result['error_status'] = true;
                                                //$_SESSION['student_details']['degree_valid'] = "Valid";
                                                //$_SESSION['student_details']['school_eligibility'] = $result_validation['school_eligibility'];
                                            } else {

                                                //$result['error_msg'] = 'You are not eligile for scholarship. <br/> Please contact helpdesk for <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com';
                                                //$result['error_msg'] = 'Your qualifying crieteria has to be checked and confirmed. <br/> Please contact helpdesk for <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com';
                                                //$result['error_msg'] = 'This EMIS number is not available in the pre-approved database provided by the School Education Department for the students passed out during the year 2021-22.<br/> Please contact helpdesk for further action.<br/> Mobile No: 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com';
                                                //$result['error_code'] = '410';
                                                //$result['error_status'] = false;
                                                // Updated By Arul on 17-11-2022 Starts Here
                                                //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                                $result['validation'] = "Invalid";
                                                $result['error_msg'] = '';
                                                $result['error_code'] = 200;
                                                $result['school_eligibility'] = $result_validation['school_eligibility'];
                                                $result['error_status'] = true;
                                                //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                                //$_SESSION['student_details']['school_eligibility'] = $result_validation['school_eligibility'];
                                                // Updated By Arul on 17-11-2022 Ends Here  											
                                            }
                                        } else if ($result_validation['error_code'] == 200 && $result_validation['error_msg'] == "Invalid") {

                                            //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                            $result['validation'] = "Invalid";
                                            $result['error_msg'] = '';
                                            $result['error_code'] = 200;
                                            $result['school_eligibility'] = $result_validation['school_eligibility'];
                                            $result['error_status'] = true;
                                            //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                            //$_SESSION['student_details']['school_eligibility'] = $result_validation['school_eligibility'];
                                        }
                                    } else {

                                        $result['error_msg'] = 'Please enter valid EMIS ID';
                                        $result['error_code'] = '400';
                                        $result['error_status'] = false;
                                    }
                                } else if ($emis_validation_flag_institution == 'true') {

                                    $check_registration = $this->registration_modal->checkSchoolEligibility($m_degree_id);
                                    //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                    $result['validation'] = "Invalid";
                                    $result['error_msg'] = '';
                                    $result['error_code'] = 200;
                                    $result['school_eligibility'] = $check_registration['school_eligibility'];
                                    $result['error_status'] = true;
                                    //$_SESSION['student_details']['degree_valid'] = "Invalid";
                                    //$_SESSION['student_details']['school_eligibility'] = $check_registration['school_eligibility'];
                                }
                            } else {

                                $result['error_msg'] = 'Mobile number / Email ID is registered already';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = "OTP Limit Exceeded. Please try after some time.";
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Please enter valid email id';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please enter valid mobile number';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please fill all mandatory fields';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please fill all Mandatory Fields !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Validate Student Details Based On Completion of school
    public function validateStudentDetails($course, $school_completion_on) {

        $valid_school_completion_on = $this->validation->emptyCheck($school_completion_on);
        $valid_course = $this->validation->emptyCheck($course);
        if ($valid_school_completion_on == true && $valid_course == true) {

            // Get School Eligibility 

            $array_list_year[] = "2021";
            $check_registration = $this->registration_modal->checkSchoolEligibility($course);

            //Condition Check Exists IN Array Or Not
            if ($check_registration['school_eligibility'] == 12 && in_array($school_completion_on, $array_list_year)) {

                $result['error_msg'] = "Valid";
                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['school_eligibility'] = $check_registration['school_eligibility'];
            } else {

                $result['error_msg'] = "Invalid";
                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['school_eligibility'] = $check_registration['school_eligibility'];
            }
        } else {

            $result['error_msg'] = 'Invalid Please Select Fileds !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    /// Submit Application
    public function SubmitStudentRegistration() {

        //$array_assoc = array_column($_POST['form_data'], 'value', 'name');
        $name = $_POST['student_name'];
        $phone_number = $_POST['mobile_number'];
        $email_id = $_POST['email_id'];

        $validate_email = $this->validation->emptyCheck($email_id);
        $validate_name = $this->validation->emptyCheck($name);
        $validate_mobile = $this->validation->emptyCheck($phone_number);

        // Condition Check Email and Mobile No Empty
        if ($validate_mobile == true && $validate_email == true) {

            $validate_regx_mobile = $this->validation->mobileValidation($phone_number);
            $validate_regx_email = $this->validation->emailValidation($email_id);
            $validate_regx_name = $this->validation->nameValidation($name);

            // Condition Check Email and Mobile No Valid Regx
            if ($validate_regx_mobile == true && $validate_regx_email == true) {

                //Condition Check Student Already Registerd Or Not
                $check_registration = $this->registration_modal->checkRegistration($phone_number, $email_id, $name);
                if (count($check_registration) == 0) {

                    $otp_validation = $this->master_controller->limitOTPMobile($phone_number, '1');
                    if ($otp_validation) {

                        // Call Generate OTP 
                        $result = $this->mailer->GenerateOTP();
                        if ($result['error_status'] == true) {

                            // Send OTP SMS Method Starts Here
                            $otp = $result['error_msg'];
                            //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, $otp, 'OTP');
                            $send_otp_sms = 1;
                            if ($send_otp_sms == 1) {

                                $sent_by = trim($_SESSION['user_details']['user_id']);
                                $result_modal = $this->registration_modal->InsertOTP($otp, $sent_by, $phone_number, $email_id);
                                $result['error_msg'] = 'OTP sent to the above registered mobile number';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            } else {

                                $result['error_msg'] = 'Unable to send OTP Contact Admin';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }

                            // Send OTP Email Method Starts Here

                            /* $email_array = array(
                              "to_email_id"=>$email_id,
                              "email_subject"=>"Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                              "email_body"=>"OTP for Institution Registration <b>".$result['error_msg']."</b>"
                              );
                              $send_email = $this->mailer->SendEmail($email_array);
                              if($send_email==true){

                              $result['error_msg'] = 'OTP Sent to Your Email ID.';
                              $result['error_code'] = '200';
                              $result['error_status'] = true;

                              }else{

                              $result['error_msg'] = 'Problem Sending OTP to Email ID.';
                              $result['error_code'] = '400';
                              $result['error_status'] = false;

                              } */
                        } else {

                            $result['error_msg'] = 'Problem on register OTP';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = "OTP Limit Exceeded. Please try after some time.";
                        $result['error_code'] = '405';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Mobile number / Email ID is registered already';
                    $result['error_code'] = '405';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please enter valid inputs';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please fill all the fields';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Submit OTP Received OTP Message and verify email or MObile No
    public function submitOTP() {

        $result = [];
        if (isset($_POST['otp_number']) && isset($_POST['phone_no']) && isset($_POST['user_email'])) {

            $result_modal_otp = $this->registration_modal->checkOTP($_POST['otp_number'], $_POST['phone_no'], $_POST['user_email']);
            if (count($result_modal_otp) != 0) {

                //echo 'in';
                $student_name = trim($_POST['student_name']);
                $phone_number = trim($_POST['phone_no']);
                $email_id = trim($_POST['user_email']);
                //$user_id = $_SESSION['user_details']['user_id'];
                // Added By Arul 24-11-2022
                $user_id = trim(base64_decode($_POST['user_id']));

                $form_student_details = $_POST['form_student_details'];
                $array_stud_details_assoc = array_column($form_student_details, 'value', 'name');
                //var_dump($array_stud_details_assoc);
                $form_aadhaar_bank_details = $_POST['form_aadhaar_bank_details'];
                $array_aadhaar_bank_details_assoc = array_column($form_aadhaar_bank_details, 'value', 'name');

                $form_aadhaar_validation = $_POST['form_aadhaar_validation'];
                $array_aadhaar_validation_assoc = array_column($form_aadhaar_validation, 'value', 'name');

                if ($array_stud_details_assoc['emis_validation_flag'] == 'true') {

                    $emis_id = '';
                    $form_student_emis_details = false;
                } else if ($array_stud_details_assoc['emis_validation_flag'] == 'false') {

                    $form_student_emis_details = $_POST['form_student_emis_details'];
                    $array_assoc_std_details = array_column($form_student_emis_details, 'value', 'name');
                    $emis_id = $array_assoc_std_details['emis_id'];
                }
                //var_dump($array_assoc_std_details);    
                //Get EMIS From 
                $array_aasoc_std_aadhar_details = array_column($form_aadhaar_validation, 'value', 'name');
                //var_dump($array_aasoc_std_aadhar_details);
                //Check Condition aadhaarNumber and emis registered
                $result_check_aadhar_emis_exists = $this->registration_modal->getStudentEMISAadharregistered($emis_id, $array_aasoc_std_aadhar_details['aadhaar_no_2']);

                if (count($result_check_aadhar_emis_exists) == 0) {

                    //Check Student Registration                        
                    $result_check_registration = $this->registration_modal->checkRegistration($phone_number, $email_id);
                    if (count($result_check_registration) == 0) {

                        $result_modal_registration = $this->registration_modal->submitRegistration($_POST['phone_no'], $_POST['user_email'], $user_id, $_POST['student_name']);
                        if ($result_modal_registration != 0 && $result_modal_registration != '') {

                            // Submit Student Details							
                            $result_submit_student_details = $this->SubmitStudentDetails($form_student_emis_details, $form_student_details, $result_modal_registration, $form_aadhaar_validation, $user_id);
                            if ($result_submit_student_details['error_code'] == 200) {

                                $result_modal_std_det_temp = $this->registration_modal->GetStudentDetailsFromTemp($array_aasoc_std_aadhar_details['aadhaar_no_2']);

                                // Submit Student eDetails									
                                if (!empty($result_modal_std_det_temp)) {

                                    $aadhar_no = $this->validation->encryptValue($result_modal_std_det_temp['aadhar_no']);
                                    $aadhar_info = $this->validation->encryptValue($result_modal_std_det_temp['aadhar_info']);

                                    $data_array = array(
                                        "student_registration_id" => $result_modal_registration,
                                        "enumber" => $aadhar_no,
                                        "edetails" => $aadhar_info,
                                        "created_by" => $user_id
                                    );

                                    $result_modal_std_det = $this->registration_modal->InsertStudentEdetail($data_array);

                                    if ($result_modal_std_det != 0) {

                                        //Submit Student Institution Details
                                        $form_college_details = $_POST['form_college_details'];
                                        // Added By Arul 24-11-2022
                                        $array_college_details_assoc = array_column($form_college_details, 'value', 'name');
                                        $degree_valid = trim($array_college_details_assoc['validation']);

                                        $result_submit_institution_details = $this->submitInstitutionDetails($form_college_details, $result_modal_registration, $form_aadhaar_bank_details, $form_aadhaar_validation, $user_id);
                                        if ($result_submit_institution_details['error_code'] == 200) {

                                            //Submit School Details
                                            if ($degree_valid == "Invalid") {

                                                $form_student_school_details = $_POST['form_student_school_details'];
                                                $result_submit_school_details = $this->SubmitStudentSchoolDetails($form_student_school_details, $result_modal_registration, $user_id);

                                                if ($result_submit_school_details['error_code'] == '200') {

                                                    // Check Bank Details Available Or Not
                                                    $array_student_bank_assoc = array_column($form_aadhaar_bank_details, 'value', 'name');
                                                    if (trim($array_student_bank_assoc['bank_name']) != '' && trim($array_student_bank_assoc['bank_verified_msg'] != '') && trim($array_student_bank_assoc['status'] != '')) {

                                                        //Submit Student Bank Details
                                                        $form_aadhaar_bank_details = $_POST['form_aadhaar_bank_details'];
                                                        $result_submit_bank_details = $this->submitBankDetails($form_aadhaar_bank_details, $result_modal_registration, $user_id);

                                                        if ($result_submit_bank_details['error_code'] == '200') {

                                                            //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, $result_submit_institution_details['student_reg_no'], 'ApplicationSubmit');
                                                            $send_otp_sms = 1;
                                                            if ($send_otp_sms == 1) {

                                                                // Delete Aadhaar Temp Table
                                                                $result_delete_temp = $this->registration_modal->DeleteEDetailsTemp($result_modal_std_det_temp['aadhar_no']);

                                                                $result['error_msg'] = 'Scholarship Application Submitted Sucessfully. <b>Your Application Number is ' . $result_submit_institution_details['student_reg_no'] . '</b>';
                                                                $result['error_code'] = '200';
                                                                $result['error_status'] = true;
                                                            } else {

                                                                $result['error_msg'] = 'Unable to send OTP Contact Admin';
                                                                $result['error_code'] = '400';
                                                                $result['error_status'] = false;
                                                            }

                                                            unset($_SESSION['student_details']);
                                                        } else {

                                                            $this->isDelete($result_modal_registration, 'student_registration');
                                                            $this->isDelete($result_modal_registration, 'student_details');
                                                            $this->isDelete($result_modal_registration, 'student_edetails');
                                                            $this->isDelete($result_modal_registration, 'student_institution_details');
                                                            $this->isDelete($result_modal_registration, 'student_school_details');

                                                            $result['error_msg'] = 'Problem on insert student institution details try again';
                                                            $result['error_code'] = '400';
                                                            $result['error_status'] = false;
                                                        }
                                                    } else {

                                                        //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, $result_submit_institution_details['student_reg_no'], 'ApplicationSubmit');
                                                        $send_otp_sms = 1;
                                                        if ($send_otp_sms == 1) {

                                                            // Delete Aadhaar Temp Table
                                                            $result_delete_temp = $this->registration_modal->DeleteEDetailsTemp($result_modal_std_det_temp['aadhar_no']);

                                                            $result['error_msg'] = 'Scholarship Application Submitted Sucessfully. <b>Your Application Number is ' . $result_submit_institution_details['student_reg_no'] . '</b>';
                                                            $result['error_code'] = '200';
                                                            $result['error_status'] = true;
                                                        } else {

                                                            $result['error_msg'] = 'Unable to send OTP Contact Admin';
                                                            $result['error_code'] = '400';
                                                            $result['error_status'] = false;
                                                        }

                                                        unset($_SESSION['student_details']);
                                                    }
                                                } else {

                                                    $this->isDelete($result_modal_registration, 'student_registration');
                                                    $this->isDelete($result_modal_registration, 'student_details');
                                                    $this->isDelete($result_modal_registration, 'student_edetails');
                                                    $this->isDelete($result_modal_registration, 'student_institution_details');

                                                    $result['error_msg'] = 'Problem on Insert Student Institution Details';
                                                    $result['error_code'] = '400';
                                                    $result['error_status'] = false;
                                                }
                                            } else if ($degree_valid == 'Valid') {


                                                $form_student_bank_details = $_POST['form_aadhaar_bank_details'];
                                                $array_student_bank_assoc = array_column($form_student_bank_details, 'value', 'name');
                                                if (trim($array_student_bank_assoc['bank_name']) != '' && trim($array_student_bank_assoc['bank_verified_msg'] != '') && trim($array_student_bank_assoc['status'] != '')) {

                                                    $result_submit_bank_details = $this->submitBankDetails($_POST['form_aadhaar_bank_details'], $result_modal_registration, $user_id);
                                                    if ($result_submit_bank_details) {

                                                        //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, $result_submit_institution_details['student_reg_no'], 'ApplicationSubmit');
                                                        $send_otp_sms = 1;
                                                        if ($send_otp_sms == 1) {

                                                            // Delete Aadhaar Temp Table
                                                            $result_delete_temp = $this->registration_modal->DeleteEDetailsTemp($result_modal_std_det_temp['aadhar_no']);
                                                            $result['error_msg'] = 'Scholarship Application Submitted Sucessfully. <b>Your Application Number is ' . $result_submit_institution_details['student_reg_no'] . '</b>';
                                                            $result['error_code'] = '200';
                                                            $result['error_status'] = true;
                                                        } else {

                                                            $result['error_msg'] = 'Unable to send OTP Contact Admin';
                                                            $result['error_code'] = '400';
                                                            $result['error_status'] = false;
                                                        }

                                                        unset($_SESSION['student_details']);
                                                    } else {

                                                        $this->isDelete($result_modal_registration, 'student_registration');
                                                        $this->isDelete($result_modal_registration, 'student_details');
                                                        $this->isDelete($result_modal_registration, 'student_edetails');
                                                        $this->isDelete($result_modal_registration, 'student_institution_details');

                                                        $result['error_msg'] = 'Problem on Insert Student Institution Details';
                                                        $result['error_code'] = '400';
                                                        $result['error_status'] = false;
                                                    }
                                                } else {

                                                    //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, $result_submit_institution_details['student_reg_no'], 'ApplicationSubmit');
                                                    $send_otp_sms = 1;
                                                    if ($send_otp_sms == 1) {

                                                        // Delete Aadhaar Temp Table
                                                        $result_delete_temp = $this->registration_modal->DeleteEDetailsTemp($result_modal_std_det_temp['aadhar_no']);
                                                        $result['error_msg'] = 'Scholarship Application Submitted Sucessfully. <b>Your Application Number is ' . $result_submit_institution_details['student_reg_no'] . '</b>';
                                                        $result['error_code'] = '200';
                                                        $result['error_status'] = true;
                                                    } else {

                                                        $result['error_msg'] = 'Unable to send OTP Contact Admin';
                                                        $result['error_code'] = '400';
                                                        $result['error_status'] = false;
                                                    }
                                                }
                                            }
                                        } else {

                                            $this->isDelete($result_modal_registration, 'student_registration');
                                            $this->isDelete($result_modal_registration, 'student_details');
                                            $this->isDelete($result_modal_registration, 'student_edetails');
                                            $result['error_msg'] = 'Problem on Insert Student Institution Details';
                                            $result['error_code'] = '400';
                                            $result['error_status'] = false;
                                        }
                                    } else {

                                        $this->isDelete($result_modal_registration, 'student_registration');
                                        $this->isDelete($result_modal_registration, 'student_details');
                                        $result['error_msg'] = 'Problem on Insert Student eDetails';
                                        $result['error_code'] = '400';
                                        $result['error_status'] = false;
                                    }
                                } else {

                                    $this->isDelete($result_modal_registration, 'student_registration');
                                    $this->isDelete($result_modal_registration, 'student_details');

                                    $result['error_msg'] = 'Problem on Get Student eDetails from Temp';
                                    $result['error_code'] = '400';
                                    $result['error_status'] = false;
                                }
                            } else {

                                $this->isDelete($result_modal_registration, 'student_registration');
                                $result['error_msg'] = 'Problem on Insert Student Details';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Problem on submit registration check student details';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Mobile number / Email ID is registered already';
                        $result['error_code'] = '401';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Aadhaar Number / EMIS already registered';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Invalid OTP or OTP Expired';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }

    // Function Submit Student Institution Details
    public function submitInstitutionDetails($form_institution_details, $student_registration_id, $form_aadhaar_bank_details, $form_aadhaar_validation, $user_id) {

        if (count($form_institution_details) != 0) {

            $array_assoc = array_column($form_institution_details, 'value', 'name');
            $m_institution_type_id = $array_assoc['m_institution_type_id'];
            //$institution_id = $_SESSION['user_details']['institution_id'][0];
            $institution_id = $array_assoc['m_institution_id'];
            $district_id = $array_assoc['district_id'];

            $degree = $array_assoc['m_degree_id'];
            $subject = $array_assoc['subject'];
            $school_completion_on = $array_assoc['school_completion_on'];
            $academic_year = $array_assoc['academic_year'];
            $year_of_study = $array_assoc['year_of_study'];
            $date = strtotime($array_assoc['date_of_admission']);
            $date_of_admission = date("Y-m-d", $date);

            // Added By Arul 24-11-2022
            $degree_valid = trim($array_assoc['validation']);

            // District id
            $result_district_code = $this->registration_modal->GetDistrictCode($district_id);
            $student_reg_no = $result_district_code['dcode'] . sprintf('%07d', $student_registration_id);

            // Bank Details
            $array_student_aadhar_assoc = array_column($form_aadhaar_bank_details, 'value', 'name');
            $bank_verified = $this->validation->decryptValue($array_student_aadhar_assoc['bank_verified']);

            //eKYC Verified
            $array_student_ekyc_assoc = array_column($form_aadhaar_validation, 'value', 'name');
            $aadhar_verified = $this->validation->decryptValue($array_student_ekyc_assoc['aadhar_verified']);

            if ($degree_valid == 'Valid') {

                $emis_id_verified = 'Y';
                $emis_id_verified_on = date("Y-m-d");
                $emis_id_validation = 'Y';
            } else if ($degree_valid == 'Invalid') {

                $emis_id_verified = 'N';
                $emis_id_verified_on = '';
                $emis_id_validation = 'N';
            }

            // aadhaar ekyc
            if ($aadhar_verified == 1) {

                $aadhar_verified_on = date("Y-m-d");
            } else if ($aadhar_verified == 0) {

                $aadhar_verified_on = '';
            }

            // aadhaar ekyc
            if ($bank_verified == 1) {

                $bank_verified_on = date("Y-m-d");
            } else if ($bank_verified == 0) {

                $bank_verified_on = '';
            }

            // Decrypt Student Details
            //$student_registration_id = $this->validation->decryptValue($student_registration_id_dcrypt);
            $data_array = array(
                "student_registration_id" => $student_registration_id,
                "student_registration_no" => $student_reg_no,
                "m_institution_type_id" => $m_institution_type_id,
                "m_institution_id" => $institution_id,
                "m_degree_id" => $degree,
                "m_subject_id" => $subject,
                "school_completion_on" => $school_completion_on,
                "academic_year" => $academic_year,
                "date_of_admission" => $date_of_admission,
                "year_of_study" => $year_of_study,
                "emis_id" => '',
                "emis_id_verified" => $emis_id_verified,
                "emis_id_verified_on" => $emis_id_verified_on,
                "emis_id_validation" => $emis_id_validation,
                "emis_data" => '',
                "aadhaar_ekyc_status" => $aadhar_verified,
                "aadhaar_ekyc_verified_on" => $aadhar_verified_on,
                "npci_status" => $bank_verified,
                "npci_status_verified_on" => $bank_verified_on,
                "reg_date" => date("Y-m-d"),
                "created_by" => $user_id
            );

            // Check Student Already FIlled INstitituion Details
            $result_checkdetails = $this->registration_modal->getStudentInstitutionDetailsByID($student_registration_id);
            if (count($result_checkdetails) == 0) {

                // Call Model submitStudentInstitutionDetails for enter student details
                $result_modal = $this->registration_modal->submitStudentInstitutionDetails($data_array);

                //Condition Check Student  Details Add In "student_details" Table
                if ($result_modal > 0) {

                    //$_SESSION['student_details']['student_institution_details_id'] = $result_modal;
                    $result['error_msg'] = $result_modal;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                    $result['student_reg_no'] = $student_reg_no;
                } else {

                    $result['error_msg'] = "Please Check Inputs !!!";
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = "Student Details Already Submited.";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please Fill All Mandatory Fields !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Submit Student Schooling Details
    public function SubmitStudentSchoolDetails($form_student_school_details, $student_registration_id, $user_id) {

        $array_stud_details_assoc = array_column($form_student_school_details, 'value', 'name');
        $array_stud_details_assoc['student_registration_id'] = $student_registration_id;
        $array_stud_details_assoc['created_by'] = $user_id;

        // Added By Arul 24-11-2022
        $school_eligibility = $array_stud_details_assoc['school_eligibility'];
        if ($school_eligibility == 12) {

            $result_validation = $this->ValidationUGSchoolDetails($form_student_school_details);
        } else if ($school_eligibility == 10) {

            $result_validation = $this->ValidationDiplomaSchoolDetails($form_student_school_details);
        } else if ($school_eligibility == 8) {

            $result_validation = $this->ValidationITISchoolDetails($form_student_school_details);
        }
        //print_r($result_validation);
        if ($result_validation['error_code'] == 200 && $result_validation['error_status'] == true) {

            // Call Model submitStudentDetails for enter student details
            $result_modal = $this->registration_modal->SubmitStudentSchoolDetails($array_stud_details_assoc);

            if ($result_modal != 0) {

                $result['error_msg'] = 'Thank you for providing School Details';
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Please Fassill All Mandatory Fields !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please Select School Details!!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Submit Student Personal Details
    public function submitStudentDetails($form_student_emis_details, $form_student_details, $student_registration_id, $form_aadhaar_validation, $user_id) {

        $array_student_aadhar_assoc = array_column($form_aadhaar_validation, 'value', 'name');
        $aadhaar_no = $array_student_aadhar_assoc['aadhaar_no_2'];
        if ($form_student_emis_details == false) {

            $emis_id = 0;
            $valid_emisValidation = true;
        } else {

            $array_student_emis_assoc = array_column($form_student_emis_details, 'value', 'name');
            $emis_id = $array_student_emis_assoc['emis_id'];
            $valid_emisValidation = $this->validation->emisValidation($emis_id);
        }

        if ($valid_emisValidation == true) {

            $array_stud_details_assoc = array_column($form_student_details, 'value', 'name');

            $student_name_emis = $array_stud_details_assoc['student_name_emis'];
            $community = $array_stud_details_assoc['community'];
            $religion = $array_stud_details_assoc['religion'];
            $gender = $array_stud_details_assoc['gender'];
            $mother_name = $array_stud_details_assoc['mother_name'];
            $parent_mobile = $array_stud_details_assoc['parent_mobile'];
            $father_name = $array_stud_details_assoc['father_name'];
            $guardian_name = $array_stud_details_assoc['guardian_name'];
            $date = strtotime($array_stud_details_assoc['date_of_birth']);
            $date_of_birth = date("Y-m-d", $date);
            //$user_id = $_SESSION['user_details']['user_id'];

            if (($this->validation->nameValidation($student_name_emis) == true)) {

                if (($this->validation->emptyCheck($religion) == true)) {

                    if (($this->validation->emptyCheck($gender) == true)) {

                        if (($this->validation->emptyCheck($mother_name) == true)) {

                            if (($this->validation->emptyCheck($father_name) == true)) {

                                if (($this->validation->emptyCheck($community) == true)) {

                                    if (($this->validation->mobileValidation($parent_mobile) == true)) {

                                        $result_emis_api = array(
                                            "student_registration_id" => $student_registration_id,
                                            "student_name_emis" => $student_name_emis,
                                            "date_of_birth" => $date_of_birth,
                                            "aadhaar_no" => $aadhaar_no,
                                            "religion" => $religion,
                                            "community" => $community,
                                            "gender" => $gender,
                                            "mother_name" => $mother_name,
                                            "parents_mobile" => $parent_mobile,
                                            "father_name" => $father_name,
                                            "guardian_name" => $guardian_name,
                                            "emis_id" => $emis_id,
                                            "created_by" => $user_id,
                                        );

                                        $result_checkdetails = $this->registration_modal->getStudentPersonalDetailsByID($student_registration_id);
                                        if (count($result_checkdetails) == 0) {

                                            // Call Model submitStudentDetails for enter student details
                                            $result_modal = $this->registration_modal->submitStudentDetails($result_emis_api);
                                            //var_dump($result_modal);
                                            if ($result_modal) {

                                                $_SESSION['student_details']['student_details_id'] = $result_modal;
                                                $result['error_msg'] = 'Student Details Entered Sucessfully Please Further Proceed';
                                                $result['error_code'] = '200';
                                                $result['error_status'] = true;
                                            } else {

                                                $result['error_msg'] = 'Please Fill All Mandatory Fields !!!';
                                                $result['error_code'] = '400';
                                                $result['error_status'] = false;
                                            }
                                        } else {

                                            $result['error_msg'] = 'Student Already Filled Personal Details.';
                                            $result['error_code'] = '400';
                                            $result['error_status'] = false;
                                        }
                                    } else {

                                        $result['error_msg'] = 'Please Enter Parents Mobile No.';
                                        $result['error_code'] = '400';
                                        $result['error_status'] = false;
                                    }
                                } else {

                                    $result['error_msg'] = 'Please Enter Community.';
                                    $result['error_code'] = '400';
                                    $result['error_status'] = false;
                                }
                            } else {


                                $result['error_msg'] = 'Please Enter Fathers Name.';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Please Enter Mothers Name.';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {


                        $result['error_msg'] = 'Please Select Gender.';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Valid Religion.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please Enter Correct Name.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid EMIS Number !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Submit Bank Details
    public function submitBankDetails($form_student_bank_details, $student_registration_id, $user_id) {

        $result = [];
        $array_student_bank_assoc = array_column($form_student_bank_details, 'value', 'name');
        //$user_id = $_SESSION['user_details']['user_id'];

        if (trim($array_student_bank_assoc['status']) == 'Active') {

            $status = 'A';
        } else if (trim($array_student_bank_assoc['status']) == 'InActive') {

            $status = 'I';
        }
        $result_api = array(
            "student_registration_id" => $student_registration_id,
            "bank_name" => $array_student_bank_assoc['bank_name'],
            "status" => $status,
            "request_no" => '',
            "created_by" => $user_id
        );

        $result_npcl_api = array(
            "student_registration_id" => $student_registration_id,
            "npcl_bankname" => $array_student_bank_assoc['bank_name'],
            "npcl_status" => $status,
            "npcl_validation_msg" => $array_student_bank_assoc['bank_verified_msg'],
            "created_by" => $user_id
        );

        //	var_dump($result_api);
        if ($result_api) {
            // Call Model submitStudentDetails for enter student details
            $result_modal = $this->registration_modal->submitStudentBankDetails($result_api);

            if ($result_modal != 0) {

                $result_modal_npcl_log = $this->registration_modal->submitStudentNPCLBankDetails($result_npcl_api);
                if ($result_modal_npcl_log) {


                    $result['error_msg'] = 'Student Details Entered Sucessfully Please Further Proceed';
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                    $result['data'] = $result_modal;
                } else {

                    $result['error_msg'] = 'Unable to enter Bank npcl Details';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Unable to enter Bank Deatails';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Result is empty';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Validate NPCI on Instituion Page
    public function UpdateStudentBankDetails() {
        $result = [];
        $user_id = base64_decode($_POST['user_id']);
        $student_reg_id = $this->validation->decryptValue($_POST['student_reg_id']);
        $validate_student_reg_id = $this->validation->emptyCheck($student_reg_id);
        if ($validate_student_reg_id == true) {

            $result_checkdetails = $this->registration_modal->getStudentPersonalDetailsByID($student_reg_id);
            $result_checkbankdetails = $this->registration_modal->getStudentBankDetailsByID($student_reg_id);
            if (count($result_checkdetails) != 0) {

                // Call EMIS Validation Method
                $validate_aadhaar = $this->validation->aadhaarValidation(trim($result_checkdetails['aadhaar_no']));

                //Condition Check Valid Aadhaar Number            
                if ($validate_aadhaar == true) {

                    //Condition Debug
                    if (NPCI_VALIDATION == true) {

                        $request_Number = date('dmHis');
                        $requested_date_TimeStamp = date("Y-m-d H:i:s") . substr((string) fmod(microtime(true), 1), 1, 3);
                        $mobile_Number = '';
                        $return_npci = $this->CallNPCI(trim($result_checkdetails['aadhaar_no']), $mobile_Number, $request_Number, $requested_date_TimeStamp);
                    } else if (NPCI_VALIDATION == false) {

                        //Correct Bank Details
                        /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                          <soapenv:Body>
                          <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                          <return xmlns="">
                          <aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
                          <bank_Name>INDIAN BANK</bank_Name>
                          <error/>
                          <last_Updated_Date>25-01-2013</last_Updated_Date>
                          <mobile_Number>7364236387</mobile_Number>
                          <processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
                          <request_Number>4040032816</request_Number>
                          <request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
                          <requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
                          <status>A</status>
                          </return>
                          </ns2:getAadhaarStatusResponse>
                          </soapenv:Body>
                          </soapenv:Envelope>'; */

                        // Aadhaar Card Linked Senario
                        $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
								<soapenv:Body>
								<ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
								<return xmlns="">
								<aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
								<bank_Name>INDIAN BANK</bank_Name>
								<error/>
								<last_Updated_Date>25-01-2013</last_Updated_Date>
								<mobile_Number>7364236387</mobile_Number>
								<processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
								<request_Number>4040032816</request_Number>
								<request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
								<requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
								<status>I</status>
								</return>
								</ns2:getAadhaarStatusResponse>
								</soapenv:Body>
								</soapenv:Envelope>';

                        // Not Eligibility Senario
                        /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                          <soapenv:Body>
                          <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                          <return xmlns="">
                          <aadhaar_Number>XXXXXXXX4183</aadhaar_Number>
                          <bank_Name>INDIAN BANK</bank_Name>
                          <error/>
                          <last_Updated_Date>25-01-2013</last_Updated_Date>
                          <mobile_Number>7364236387</mobile_Number>
                          <processed_Date_TimeStamp>08-10-2022 10:35:24 215</processed_Date_TimeStamp>
                          <request_Number>4040032816</request_Number>
                          <request_received_date_time>08-10-2022 10:35:24 210</request_received_date_time>
                          <requested_Date_TimeStamp>2018-12-07 03:03:09.3</requested_Date_TimeStamp>
                          <status>C</status>
                          </return>
                          </ns2:getAadhaarStatusResponse>
                          </soapenv:Body>
                          </soapenv:Envelope>'; */

                        /* $return_npci = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                          <soapenv:Body>
                          <ns2:getAadhaarStatusResponse xmlns:ns2="http://aadhaar.npci.org/">
                          <return xmlns="">
                          <aadhaar_Number>XXXXXXXX8799</aadhaar_Number>
                          <bank_Name/>
                          <error>Aadhaar number is not available.</error>
                          <last_Updated_Date/>
                          <mobile_Number/>
                          <processed_Date_TimeStamp>18-10-2022 20:00:48 459</processed_Date_TimeStamp>
                          <request_Number>1234567892</request_Number>
                          <request_received_date_time>18-10-2022 20:00:48 455</request_received_date_time>
                          <requested_Date_TimeStamp>2022-12-18 12:19:09.3</requested_Date_TimeStamp>
                          <status/>
                          </return>
                          </ns2:getAadhaarStatusResponse>
                          </soapenv:Body>
                          </soapenv:Envelope>'; */
                    }

                    if ($return_npci) {

                        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $return_npci);
                        $xml = new SimpleXMLElement($response);
                        $aadhaarNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->aadhaar_Number;
                        $bankName = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->bank_Name;
                        //$mandateFlag = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mandateFlag;
                        $mobileNumber = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->mobile_Number;
                        //$ODFlag  = $xml->soapenvBody->ns2getAadhaarStatusResponse->return->ODFlag;
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

                                //$flag_aadhar_verified = $this->validation->encryptValue('1');
                                $flag_bank_verified = $this->validation->encryptValue('1');
                                $result['requestNumber'] = (string) $requestNumber;
                                $result['error_msg'] = NPCI_MSG_ACTIVE_WITH_BANK;
                                $result['bankName'] = (string) $bankName;
                                $result['status'] = 'Active';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                                $result['bank_verified'] = $flag_bank_verified;
                                //$result['aadhar_verified'] = $flag_aadhar_verified;								
                                $array_std_ins_update = array(
                                    "student_registration_id" => $student_reg_id,
                                    "npcl_status" => 1,
                                    "npci_status_verified_by" => $user_id
                                );

                                $result_npcl_api = array(
                                    "student_registration_id" => $student_reg_id,
                                    "npcl_bankname" => (string) $bankName,
                                    "npcl_status" => 'Active',
                                    "npcl_validation_msg" => NPCI_MSG_ACTIVE_WITH_BANK,
                                    "created_by" => $user_id
                                );

                                $result_api = array(
                                    "student_registration_id" => $student_reg_id,
                                    "bank_name" => (string) $bankName,
                                    "status" => 'Active',
                                    "created_by" => $user_id
                                );

                                $result_modal_npcl_log = $this->registration_modal->UpdateNPCIStatus($result_npcl_api);
                                $result_ = $this->registration_modal->UpdateNPCIStatus($array_std_ins_update);
                                $result_modal_npcl_log = $this->registration_modal->UpdateBankDetails($result_api);
                            } else {

                                //$flag_aadhar_verified = $this->validation->encryptValue('1');
                                $flag_bank_verified = $this->validation->encryptValue('0');
                                $result['requestNumber'] = (string) $requestNumber;
                                $result['error_msg'] = NPCI_MSG_ACTIVE_WITHOUT_BANK;
                                $result['bankName'] = (string) $bankName;
                                $result['status'] = 'Active';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                                $result['bank_verified'] = $flag_bank_verified;
                                //$result['aadhar_verified'] = $flag_aadhar_verified;							

                                $result_npcl_api = array(
                                    "student_registration_id" => $student_reg_id,
                                    "npcl_bankname" => (string) $bankName,
                                    "npcl_status" => 'Active',
                                    "npcl_validation_msg" => NPCI_MSG_ACTIVE_WITHOUT_BANK,
                                    "created_by" => $user_id
                                );
                            }

                            $result_api = array(
                                "student_registration_id" => $student_reg_id,
                                "bank_name" => (string) $bankName,
                                "status" => 'Active',
                                "created_by" => $user_id
                            );

                            $result_modal_npcl_log = $this->registration_modal->submitStudentNPCLBankDetails($result_npcl_api);
                            if (count($result_checkbankdetails) == 0) {
                                $result_modal_npcl_log = $this->registration_modal->submitStudentBankDetails($result_api);
                            } else {
                                $result_modal_npcl_log = $this->registration_modal->UpdateBankDetails($result_api);
                            }
                        } else if (trim($status) == 'I') {

                            if (in_array($bank_trim, $array_list_bank)) {

                                //$flag_aadhar_verified = $this->validation->encryptValue('1');
                                $flag_bank_verified = $this->validation->encryptValue('0');
                                $result['requestNumber'] = (string) $requestNumber;
                                $result['bankName'] = (string) $bankName;
                                $result['status'] = 'InActive';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                                $result['bank_verified'] = $flag_bank_verified;
                                //$result['aadhar_verified'] = $flag_aadhar_verified;
                                $result['error_msg'] = NPCI_MSG_INACTIVE_WITH_BANK . (string) $bankName;
                                $result_npcl_api = array(
                                    "student_registration_id" => $student_reg_id,
                                    "npcl_bankname" => (string) $bankName,
                                    "npcl_status" => 'InActive',
                                    "npcl_validation_msg" => NPCI_MSG_INACTIVE_WITH_BANK . (string) $bankName,
                                    "created_by" => $user_id
                                );
                            } else {

                                //$flag_aadhar_verified = $this->validation->encryptValue('1');
                                $flag_bank_verified = $this->validation->encryptValue('0');
                                $result['error_msg'] = "Please open account and link your aadhar in any one of the following banks<br/>STATE BANK OF INDIA<br/>​INDIAN OVERSEAS BANK<br/>​INDIAN BANK<br/>​CANARA BANK";
                                $result['requestNumber'] = (string) $requestNumber;
                                $result['bankName'] = (string) $bankName;
                                $result['status'] = 'InActive';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                                $result['bank_verified'] = $flag_bank_verified;
                                //$result['aadhar_verified'] = $flag_aadhar_verified;			

                                $result_npcl_api = array(
                                    "student_registration_id" => $student_reg_id,
                                    "npcl_bankname" => (string) $bankName,
                                    "npcl_status" => 'InActive',
                                    "npcl_validation_msg" => NPCI_MSG_ACTIVE_WITHOUT_BANK,
                                    "created_by" => $user_id
                                );
                            }

                            $result_api = array(
                                "student_registration_id" => $student_reg_id,
                                "bank_name" => (string) $bankName,
                                "status" => 'InActive',
                                "created_by" => $user_id
                            );

                            $result_modal_npcl_log = $this->registration_modal->submitStudentNPCLBankDetails($result_npcl_api);

                            if (count($result_checkbankdetails) == 0) {


                                $result_modal_npcl_log = $this->registration_modal->submitStudentBankDetails($result_api);
                            } else {

                                $result_modal_npcl_log = $this->registration_modal->UpdateBankDetails($result_api);
                            }
                        } else if (trim($status) == 'C') {

                            $result['error_msg'] = "You are not eligible for scholarship please check with helpdesk";
                            $result['error_code'] = '401';
                            $result['error_status'] = false;
                        } else if ($error_cmp == 0) {

                            //$flag_aadhar_verified = $this->validation->encryptValue('1');
                            $flag_bank_verified = $this->validation->encryptValue('0');
                            $result['error_msg'] = "Please open account and link your aadhar in any one of the following banks<br/>STATE BANK OF INDIA<br/>​INDIAN OVERSEAS BANK<br/>​INDIAN BANK<br/>​CANARA BANK";
                            $result['error_code'] = '201';
                            $result['error_status'] = true;
                            $result['bank_verified'] = $flag_bank_verified;
                            //$result['aadhar_verified'] = $flag_aadhar_verified;
                        } else {

                            $result['error_msg'] = $error;
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    }
                } else {

                    $result['error_msg'] = 'Invalid Aadhaar Number';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Student Details Not Found';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Student Registration ID is Invalid';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Student Registration with student name , email id and mobile no
    // OTP Send to registered email id or mobile no

    public function ResendOTP() {

        if ($_POST['form_data']) {

            $array_assoc = array_column($_POST['form_data'], 'value', 'name');
            $name = $array_assoc['student_name'];
            $phone_number = $array_assoc['phone_number'];
            $email_id = $array_assoc['email_id'];

            $validate_email = $this->validation->emptyCheck($email_id);
            $validate_name = $this->validation->emptyCheck($name);
            $validate_mobile = $this->validation->emptyCheck($phone_number);

            // Condition Check Email and Mobile No Empty
            if ($validate_mobile == true && $validate_email == true && $validate_name == true) {

                $validate_regx_mobile = $this->validation->mobileValidation($phone_number);
                $validate_regx_email = $this->validation->emailValidation($email_id);
                $validate_regx_name = $this->validation->nameValidation($name);

                // Condition Check Email and Mobile No Valid Regx
                if ($validate_regx_mobile == true && $validate_regx_email == true && $validate_regx_name == true) {

                    //Condition Check Student Already Registerd Or Not
                    $check_registration = $this->registration_modal->checkRegistration($phone_number, $email_id, $name);

                    if (count($check_registration) == 0) {

                        $result = $this->mailer->GenerateOTP($phone_number, $email_id);
                        if ($result['error_status'] == true) {

                            // Send OTP SMS Method Starts Here
                            //$send_otp_sms = $this->api_controller->sendingOTP($phone_number, trim($result['error_msg']));
                            $send_otp_sms = 1;
                            if ($send_otp_sms == 1) {

                                $result['error_msg'] = 'Resent OTP sent to the above registered mobile number.';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            } else {

                                $result['error_msg'] = 'Unable to send OTP Contact Admin.';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }

                            // Send OTP Email Method Starts Here

                            /* $email_array = array(
                              "to_email_id"=>$email_id,
                              "email_subject"=>"Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                              "email_body"=>"OTP for Institution Registration <b>".$result['error_msg']."</b>"
                              );
                              $send_email = $this->mailer->SendEmail($email_array);
                              if($send_email==true){

                              $result['error_msg'] = 'OTP Sent to Your Email ID.';
                              $result['error_code'] = '200';
                              $result['error_status'] = true;

                              }else{

                              $result['error_msg'] = 'Problem Sending OTP to Email ID.';
                              $result['error_code'] = '400';
                              $result['error_status'] = false;

                              } */
                        } else {

                            $result['error_msg'] = 'Problem on register OTP.';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Mobile number / Email ID is registered already';
                        $result['error_code'] = '405';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please enter valid inputs.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please fill all the fields.';
                $result['error_code'] = '401';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please fill all the fields.';
            $result['error_code'] = '401';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Verify the OTP
    // Function Validation ON Database Student Details Exists Or Not
    public function GetEMISDetailsDB($table, $emis_id) {

        $result = [];
        $empty_check_table = $this->validation->emptyCheck($table);
        $empty_check_emis_id = $this->validation->emptyCheck($emis_id);
        //Check EMIS ID
        if ($empty_check_table == true && $empty_check_emis_id == true) {

            // Get Details ON Modal
            $result_student = $this->registration_modal->checkEMIS($table, $emis_id);
            if (count($result_student) != 0) {

                $result['error_msg'] = $result_student;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'You Are Not Eligile for Scholarship !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Please Check EMIS ID !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }


        return $result;
    }

    // Function Validate UG School Details
    public function ValidationUGSchoolDetails($form_school_details) {

        // Validation Institution Details
        $array_assoc = array_column($form_school_details, 'value', 'name');
        $district_6th = $array_assoc['district_6th'];
        $district_7th = $array_assoc['district_7th'];
        $district_8th = $array_assoc['district_8th'];
        $district_9th = $array_assoc['district_9th'];
        $district_10th = $array_assoc['district_10th'];
        $district_11th = $array_assoc['district_11th'];
        $district_12th = $array_assoc['district_12th'];

        $school_6th = $array_assoc['school_6th'];
        $school_7th = $array_assoc['school_7th'];
        $school_8th = $array_assoc['school_8th'];
        $school_9th = $array_assoc['school_9th'];
        $school_10th = $array_assoc['school_10th'];
        $school_11th = $array_assoc['school_11th'];
        $school_12th = $array_assoc['school_12th'];

        $year_of_study_6th = $array_assoc['year_of_study_6th'];
        $year_of_study_7th = $array_assoc['year_of_study_7th'];
        $year_of_study_8th = $array_assoc['year_of_study_8th'];
        $year_of_study_9th = $array_assoc['year_of_study_9th'];
        $year_of_study_10th = $array_assoc['year_of_study_10th'];
        $year_of_study_11th = $array_assoc['year_of_study_11th'];
        $year_of_study_12th = $array_assoc['year_of_study_12th'];

        if ($this->validation->emptyCheck($district_6th) && $this->validation->emptyCheck($district_7th) && $this->validation->emptyCheck($district_8th) && $this->validation->emptyCheck($district_9th) && $this->validation->emptyCheck($district_10th) && $this->validation->emptyCheck($district_11th) && $this->validation->emptyCheck($district_12th) && $this->validation->emptyCheck($school_6th) && $this->validation->emptyCheck($school_7th) && $this->validation->emptyCheck($school_8th) && $this->validation->emptyCheck($school_9th) && $this->validation->emptyCheck($school_10th) && $this->validation->emptyCheck($school_11th) && $this->validation->emptyCheck($school_12th) && $this->validation->emptyCheck($year_of_study_6th) && $this->validation->emptyCheck($year_of_study_7th) && $this->validation->emptyCheck($year_of_study_8th) && $this->validation->emptyCheck($year_of_study_9th) && $this->validation->emptyCheck($year_of_study_10th) && $this->validation->emptyCheck($year_of_study_11th) && $this->validation->emptyCheck($year_of_study_12th)) {

            $result['error_msg'] = 'Student Details Valid';
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Student Details InValid Please Fill Correctly';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    //Function Validate Diploma School Details
    public function ValidationDiplomaSchoolDetails($form_school_details) {

        // Validation Institution Details
        $array_assoc = array_column($form_school_details, 'value', 'name');
        $district_6th = $array_assoc['district_6th'];
        $district_7th = $array_assoc['district_7th'];
        $district_8th = $array_assoc['district_8th'];
        $district_9th = $array_assoc['district_9th'];
        $district_10th = $array_assoc['district_10th'];

        $school_6th = $array_assoc['school_6th'];
        $school_7th = $array_assoc['school_7th'];
        $school_8th = $array_assoc['school_8th'];
        $school_9th = $array_assoc['school_9th'];
        $school_10th = $array_assoc['school_10th'];

        $year_of_study_6th = $array_assoc['year_of_study_6th'];
        $year_of_study_7th = $array_assoc['year_of_study_7th'];
        $year_of_study_8th = $array_assoc['year_of_study_8th'];
        $year_of_study_9th = $array_assoc['year_of_study_9th'];
        $year_of_study_10th = $array_assoc['year_of_study_10th'];

        if ($this->validation->emptyCheck($district_6th) && $this->validation->emptyCheck($district_7th) && $this->validation->emptyCheck($district_8th) && $this->validation->emptyCheck($district_9th) && $this->validation->emptyCheck($district_10th) && $this->validation->emptyCheck($school_6th) && $this->validation->emptyCheck($school_7th) && $this->validation->emptyCheck($school_8th) && $this->validation->emptyCheck($school_9th) && $this->validation->emptyCheck($school_10th) && $this->validation->emptyCheck($year_of_study_6th) && $this->validation->emptyCheck($year_of_study_7th) && $this->validation->emptyCheck($year_of_study_8th) && $this->validation->emptyCheck($year_of_study_9th) && $this->validation->emptyCheck($year_of_study_10th)) {

            $result['error_msg'] = 'Student Details Valid';
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Student Details InValid Please Fill Correctly';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function ValidationITISchoolDetails($form_school_details) {

        // Validation Institution Details
        $array_assoc = array_column($form_school_details, 'value', 'name');
        $district_6th = $array_assoc['district_6th'];
        $district_7th = $array_assoc['district_7th'];
        $district_8th = $array_assoc['district_8th'];

        $school_6th = $array_assoc['school_6th'];
        $school_7th = $array_assoc['school_7th'];
        $school_8th = $array_assoc['school_8th'];

        $year_of_study_6th = $array_assoc['year_of_study_6th'];
        $year_of_study_7th = $array_assoc['year_of_study_7th'];
        $year_of_study_8th = $array_assoc['year_of_study_8th'];

        if ($this->validation->emptyCheck($district_6th) && $this->validation->emptyCheck($district_7th) && $this->validation->emptyCheck($district_8th) && $this->validation->emptyCheck($school_6th) && $this->validation->emptyCheck($school_7th) && $this->validation->emptyCheck($school_8th) && $this->validation->emptyCheck($year_of_study_6th) && $this->validation->emptyCheck($year_of_study_7th) && $this->validation->emptyCheck($year_of_study_8th)) {

            $result['error_msg'] = 'Student Details Valid';
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Student Details InValid Please Fill Correctly';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    //Get Registered Values Based On Session
    public function CheckStudentSession() {

        if (isset($_SESSION['student_details']['student_registration_id'])) {

            $student_registration_id_decrypt = $this->validation->decryptValue($_SESSION['student_details']['student_registration_id']);

            $result_student = $this->registration_modal->getStudentDetailsByID($student_registration_id_decrypt);

            if (count($result_student) != 0) {

                $result['error_msg'] = $result_student;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Student Details Does Not Exists !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Session cddd !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }


        return $result;
    }

    public function CheckStudentInstituionSession() {

        if (isset($_SESSION['student_registration_id'])) {

            $result_student = $this->registration_modal->getStudentInstitutionDetailsByID($_SESSION['student_registration_id']);
            if (count($result_student) != 0) {

                $result['error_msg'] = $result_student;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Please Fill Student Institution Details!!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Session !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function CheckStudentDetailsSession() {

        if (isset($_SESSION['student_registration_id']) and $_SESSION['student_registration_id'] != 0) {

            $result_student = $this->registration_modal->getStudentStudentDetailsByID($_SESSION['student_registration_id']);
            if (count($result_student) != 0) {

                $result['error_msg'] = $result_student;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Invalid Session !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Session !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function submitApplication() {
        $empty_check_stud_reg_id = $this->validation->emptyCheck($_SESSION['student_details']['student_registration_id']);
        // Condition Check Aadhaar and Student Registration Validation
        if ($empty_check_stud_reg_id == true) {

            $result_sms = true;
            if ($result_sms == true) {

                $email_array = array(
                    "to_email_id" => $_SESSION['student_details']['email_id'],
                    "email_subject" => "Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                    "email_body" => "Scholarship Registration Sucessfully."
                );

                $send_email = $this->mailer->SendEmail($email_array);
                if ($send_email == true) {

                    // unset($_SESSION['student_details']);
                    $result['error_msg'] = 'Scholarship application submitted successfully';
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Problem on Sending Email ID.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Problem on Send SMS !';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Problem on Send SMS !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Student Register List
    public function studentRegisterList() {
        $result_arr = array();
        // Call Model student Register  for enter student details
        $result_modal = $this->registration_modal->StudentRegisterList($_SESSION['user_details']['user_id']);
        // var_dump($result_modal);
        foreach ($result_modal as $data) {
            $proposed_bank = '';
            $encrypt_reg_id = $this->validation->encryptValue($data['student_registration_id']);
            $date_format = $this->validation->dateFormateUserView($data['reg_date']);
            $aadhar_number_masking = $this->validation->aadhaarmasking($data['aadhaar_no']);
            // Added By Arul 22-11-2022 Starts Here

            if ($data['m_bank_branch_id'] != null) {
                $flag_update_bank = 'P';
                $proposed_bank = $data['bank_name'] . ' [ ' . $data['branch_name'] . ' ] ';
            } else if ($data['npci_status'] == '' || is_null($data['npci_status_verified_on'])) {
                $flag_update_bank = 'Y';
            } else {
                $flag_update_bank = 'N';
            }
            // Added By Arul 22-11-2022 Ends Here
            array_push($result_arr, array(
                "aadhaar_no" => $aadhar_number_masking,
                "created_by" => $data['created_by'],
                "reg_date" => $date_format,
                "degree" => $data['degree'],
                "email_id" => $data['email_id'],
                "emis_id" => $data['emis_id'],
                "phone_number" => $data['phone_number'],
                "student_name_emis" => $data['student_name_emis'],
                "subject" => $data['subject'],
                "student_registration_id" => $encrypt_reg_id,
                "student_registration_no" => $data['student_registration_no'],
                "update_flag_bank" => $flag_update_bank, // Added By Arul 22-11-2022
                "proposed_bank" => $proposed_bank // Added By Arul 22-11-2022
            ));
        }

        if ($result_arr) {
            $result['data'] = $result_arr;
        } else {

            $result['error_msg'] = 'No Data Found';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    function isDelete($student_registration_id, $table_name) {
        $empty_check_stud_reg_id = $this->validation->emptyCheck($student_registration_id);
        if (isset($empty_check_stud_reg_id)) {

            $result_modal = $this->registration_modal->updateisDelete($student_registration_id, $table_name);

            if ($result_modal) {

                $result['error_msg'] = 'Is Deleted';
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Session Empty Please Login Again.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Session Empty Please Login Again.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }
    }

    function DeleteTempAadhar() {

        if (isset($_POST['aadhaar_no'])) {
            $result_delete_temp = $this->registration_modal->DeleteEDetailsTemp(trim($_POST['aadhaar_no']));
        }
    }

}
