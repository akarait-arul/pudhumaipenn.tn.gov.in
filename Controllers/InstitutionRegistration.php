<?php
ini_set('error_reporting', 0);

include_once("./Models/RegistrationModel.php");
include_once("./Models/LoginModel.php");
include_once("./Models/MasterModel.php");
include_once("./classes/validation.php");
include_once("./Controllers/Mailer.php");
include_once("./Controllers/APIController.php");
include_once("./Controllers/Masters.php");


require_once './libraries/vendor/autoload.php';

class InstitutionRegistration
{

    function __construct()
    {

        $this->api_controller = new APIController();
        $this->mailer = new Mailer();
        $this->validation = new validation();
        $this->registration_modal = new RegistrationModel();
        $this->login_modal = new LoginModel();
        $this->master_modal = new MasterModel();
        $this->master = new Masters();
    }

    public function InstitutionRegister()
    {

        if (isset($_POST['formdata'])) {

            $inp_array = [];

            foreach ($_POST['formdata'] as $value) {
                $inp_array[$value['name']] = $value['value'];
            }

            //  Check Validation Empty or Not
            $val_return = false;
            foreach ($inp_array as $inp_value) {

                $validate_empty = $this->validation->emptyCheck($inp_value);
                if ($validate_empty == false) {
                    $val_return = false;
                    break;
                } else {
                    $val_return = true;
                }
            }

            if ($val_return == true) {

                $valid_email = $this->validation->emailValidation($inp_array['email_id']);
                $valid_mobile = $this->validation->mobileValidation($inp_array['mobile_number']);
                $valid_name = $this->validation->nameValidation($inp_array['contact_person']);
                $valid_pincode = $this->validation->pincodeValidation($inp_array['pincode']);
                $valid_address = $this->validation->addressValidation($inp_array['address']);

                if ($valid_email == 1 && $valid_mobile == 1 && $valid_name == 1 && $valid_pincode == 1 && $valid_address == 1 && $valid_address == 1) {

                    // Condition Check Student Already Registerd Or Not
                    $check_ins_registration = $this->registration_modal->checkInstituionRegistration($inp_array['mobile_number'], $inp_array['email_id']);

                    // Condition Check User Already Exists
                    $check_user_login = $this->registration_modal->checkUserExists($inp_array['mobile_number'], $inp_array['email_id']);

                    if (count($check_ins_registration) == 0 && count($check_user_login) == 0) {

                        // Call Send OTP Method 
                        $result = $this->mailer->GenerateOTP();
                        if ($result['error_status'] == true) {

                            $email_array = array(
                                "to_email_id" => $inp_array['email_id'],
                                "email_subject" => "Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                                "email_body" => "OTP for Institution Registration <b>" . $result['error_msg'] . "</b>"
                            );

                            $send_email = $this->mailer->SendEmail($email_array);
                            if ($send_email == true) {


                                $result['error_msg'] = 'OTP Sent to Your Email !!!';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            } else {

                                $result['error_msg'] = 'Problem on Send OTP to Email ID !!!';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Problem On Register OTP Number !!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Registration Details Already Exists !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Input Related to Fields !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please Fill All Mandatory Fields !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Inputs Please Check Inputs !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function SubmitInstitutionOTP()
    {

        if (isset($_POST['formdata'])) {

            $inp_array = [];

            foreach ($_POST['formdata'] as $value) {
                $inp_array[$value['name']] = $value['value'];
            }

            //  Check Validation Empty or Not
            $val_return = false;
            foreach ($inp_array as $inp_value) {

                $validate_empty = $this->validation->emptyCheck($inp_value);
                if ($validate_empty == false) {
                    $val_return = false;
                    break;
                } else {
                    $val_return = true;
                }
            }

            if ($val_return == true) {

                $valid_email = $this->validation->emailValidation($inp_array['email_id']);
                $valid_mobile = $this->validation->mobileValidation($inp_array['mobile_number']);
                $valid_name = $this->validation->nameValidation($inp_array['contact_person']);
                $valid_pincode = $this->validation->pincodeValidation($inp_array['pincode']);
                $valid_address = $this->validation->addressValidation($inp_array['address']);

                if ($valid_email == 1 && $valid_mobile == 1 && $valid_name == 1 && $valid_pincode == 1 && $valid_address == 1 && $valid_address == 1) {

                    // Condition Check Student Already Registerd Or Not
                    $check_ins_registration = $this->registration_modal->checkInstituionRegistration($inp_array['mobile_number'], $inp_array['email_id']);

                    // Condition Check User Already Exists
                    $check_user_login = $this->registration_modal->checkUserExists($inp_array['mobile_number'], $inp_array['email_id']);

                    if (count($check_ins_registration) == 0 && count($check_user_login) == 0) {

                        $result_modal = $this->registration_modal->checkOTP($_POST['otp_number'], $inp_array['mobile_number'], $inp_array['email_id']);
                        if ($result_modal && count($result_modal) != 0) {

                            $result_submit_institution = $this->registration_modal->InsertInstitutionRegistration($inp_array);
                            if ($result_submit_institution > 0) {

                                $email_array = array(
                                    "to_email_id" => $inp_array['email_id'],
                                    "email_subject" => "Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                                    "email_body" => "Your Institution Sucessfully Registere]"
                                );

                                $send_email = $this->mailer->SendEmail($email_array);
                                if ($send_email == true) {

                                    $result['error_msg'] = 'Institution Registered Sucessfully !!!';
                                    $result['error_code'] = '200';
                                    $result['error_status'] = true;
                                } else {

                                    $result['error_msg'] = 'Problem on Success Message !!!';
                                    $result['error_code'] = '400';
                                    $result['error_status'] = false;
                                }
                            } else {

                                $result['error_msg'] = 'Problem On Registration Please Contact Admin !!!';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Please Enter Valid OTP !!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Registration Details Already Exists !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Input Related to Fields !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please Fill All Mandatory Fields !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Inputs Please Check Inputs !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Student Register List
    public function InstitutionRegisterList()
    {

        // Call Model student Register  for enter student details
        $result_modal = $this->registration_modal->InstitutionRegisterList();
        //print($result_modal);
        if ($result_modal) {


            $result['data'] = $result_modal;
        } else {

            $result['error_msg'] = 'Problem on Send SMS !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }
    // Function Get Student Register List
    public function registeredInstituteListdot()
    {

        // Call Model student Register  for enter student details
        $result_modal = $this->registration_modal->registeredInstituteListdot();
        //print($result_modal);
        if ($result_modal) {


            $result['data'] = $result_modal;
        } else {

            $result['error_msg'] = 'Problem on Send SMS !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Student Register List
    public function verifyInstitution()
    {

        if (isset($_POST['id'])) {

            $validate_empty = $this->validation->emptyCheck($_POST['id']);
            if ($validate_empty == true) {

                // Check Weather Institution Register or Not
                $result_reg = $this->registration_modal->CheckInstitution($_POST['id']);

                if ((int)count($result_reg) != 0) {

                    $result_update = $this->registration_modal->UpdateInstitution($_POST['id']);
                    if ($result_update == true) {

                        $res_arr['m_district_id'] = $result_reg['m_district_code'];
                        $res_arr['m_institution_id'] = [$result_reg['m_institution_id']];
                        $res_arr['m_institution_type_id'] = [$result_reg['m_institution_type_id']];

                        // Generate Password and INsert
                        $randstring_resp = $this->validation->generate_string(10);

                        if (strlen($randstring_resp) == 10) {

                            $salt_resp = $this->validation->saltGeneration(11);
                            if (strlen($salt_resp) == 22) {

                                $password_resp = $this->validation->passwordGenerator($randstring_resp, $salt_resp);
                                //echo $password_resp;
                                // exit();
                                if (strlen($password_resp) != 0) {

                                    $result_emis_api = array(
                                        "m_user_type_id" => 31,
                                        "email_id" => $result_reg['email_id'],
                                        "mobile_number" => $result_reg['mobile_number'],
                                        "pass_word" => $password_resp,
                                        "user_salt" => $salt_resp,
                                        "created_by" => 1
                                    );

                                    $result_insert_login = $this->registration_modal->InsertInstitution($result_emis_api);
                                    if ($result_insert_login != 0) {

                                        $json_value = json_encode($res_arr);

                                        $table_name = 'user_login';
                                        $result_update_access = $this->registration_modal->UpdateJsonfield($result_insert_login, $table_name, $json_value);
                                        if ($result_update_access == true) {

                                            $email_array = array(
                                                "to_email_id" => $result_reg['email_id'],
                                                "email_subject" => "Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                                                "email_body" => "Your login password <b>$randstring_resp</b>"
                                            );

                                            $send_email_sucess = $this->mailer->SendEmail($email_array);
                                            if ($send_email_sucess == true) {

                                                $result['error_msg'] = 'Institution Verified Successfully !!!';
                                                $result['error_code'] = '200';
                                                $result['error_status'] = true;
                                            } else {

                                                $result['error_msg'] = 'Problem Verification Login Paasword !!!';
                                                $result['error_code'] = '400';
                                                $result['error_status'] = false;
                                            }
                                        } else {

                                            $result['error_msg'] = 'Problem on Update Record !!!';
                                            $result['error_code'] = '400';
                                            $result['error_status'] = false;
                                        }
                                    } else {

                                        $result['error_msg'] = 'Problem Insert Record !!!';
                                        $result['error_code'] = '400';
                                        $result['error_status'] = false;
                                    }
                                } else {

                                    $result['error_msg'] = 'Problem on Generate Password !!!';
                                    $result['error_code'] = '400';
                                    $result['error_status'] = false;
                                }
                            } else {

                                $result['error_msg'] = 'Problem on Generate Salt !!!';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Password Not in Length COndition!!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Problem on Upadte Institution Verificataion Flag !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Institution Already Registerd !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Fields are empty !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'PLease Select Mandatory Fields !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }



        return $result;
    }

    public function InstitutionRegisterByHOD()
    {

        if (isset($_POST['formdata'])) {

            $inp_array = [];

            foreach ($_POST['formdata'] as $value) {
                $inp_array[$value['name']] = $value['value'];
            }

            //  Check Validation Empty or Not
            $val_return = false;
            foreach ($inp_array as $inp_value) {

                $validate_empty = $this->validation->emptyCheck($inp_value);
                if ($validate_empty == false) {
                    $val_return = false;
                    break;
                } else {
                    $val_return = true;
                }
            }

            if ($val_return == true) {

                $valid_email = $this->validation->emailValidation($inp_array['email_id']);
                $valid_mobile = $this->validation->mobileValidation($inp_array['mobile_number']);
                $valid_name = $this->validation->nameValidation($inp_array['contact_person']);
                $valid_pincode = $this->validation->pincodeValidation($inp_array['pincode']);
                $valid_address = $this->validation->addressValidation($inp_array['address']);

                if ($valid_email == 1 && $valid_mobile == 1 && $valid_name == 1 && $valid_pincode == 1 && $valid_address == 1 && $valid_address == 1) {

                    // Condition Check Student Already Registerd Or Not
                    $check_ins_registration = $this->registration_modal->checkInstituionRegistration($inp_array['mobile_number'], $inp_array['email_id']);

                    // Condition Check User Already Exists
                    $check_user_login = $this->registration_modal->checkUserExists($inp_array['mobile_number'], $inp_array['email_id']);

                    if (count($check_ins_registration) == 0 && count($check_user_login) == 0) {

                        // Call Send OTP Method 
                        $result = $this->mailer->GenerateOTP();
                        if ($result['error_status'] == true) {

                            $email_array = array(
                                "to_email_id" => $inp_array['email_id'],
                                "email_subject" => "Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Institution Registration",
                                "email_body" => "OTP for Institution Registration <b>" . $result['error_msg'] . "</b>"
                            );

                            $send_email = $this->mailer->SendEmail($email_array);
                            if ($send_email == true) {


                                $result['error_msg'] = 'OTP Sent to Your Email !!!';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            } else {

                                $result['error_msg'] = 'Problem on Send OTP to Email ID !!!';
                                $result['error_code'] = '400';
                                $result['error_status'] = false;
                            }
                        } else {

                            $result['error_msg'] = 'Problem On Register OTP Number !!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Registration Details Already Exists !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Please Enter Input Related to Fields !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Please Fill All Mandatory Fields !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Inputs Please Check Inputs !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function checkFirstTimeLogin()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';

        $user_id = trim($_SESSION['user_details']['user_id']);
        $logged_usermail = trim($_SESSION['user_details']['email_id']);
        $user_type =  $_SESSION['user_details']['user_type'];




        if (!$this->validation->emptyCheck($user_id)) {

            $result['error_msg'] = "Unable to fetch user details. Try later.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($user_type)) {

            $result['error_msg'] = "User Login doesn't belong to any cateogory of login. Contact Admin.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {


            $get_userdetails = $this->login_modal->Login($logged_usermail, $user_type);

            $no_rows = $get_userdetails['no_rows'];
            $sql_rows =  $get_userdetails['rows'];



            if ($no_rows == '1') {

                $mobile_number = $sql_rows['mobile_number']  ? $sql_rows['mobile_number'] : '';


                $record['insti_loginfirst']  = $sql_rows['first_time_logged'];

                $record['contact_person'] = $sql_rows['contact_person']   ? $sql_rows['contact_person'] : '';


                if ($user_type != '31' and $user_type != '1000') {


                    $user_id = $sql_rows['user_login_id'];
                    $record['insti_email'] = $logged_usermail;


                    $record['insti_phoneno'] = $mobile_number;
                    $record['user_id'] = $user_id;
                    $record['insti_type_name'] = '';
                    $record['insti_disctrict'] = '';

                    if ($user_type == '30') {
                        //hod getting mapped institution type

                        $get_user_type = isset($_SESSION['user_details']['m_institution_type_id'][0]) ?  $_SESSION['user_details']['m_institution_type_id'][0] : '';
                        //foreach need to be updated

                        $user_type_rows  = $this->master_modal->mInstitutionType($get_user_type);
                        $insti_type_count = count($user_type_rows);

                        if ($insti_type_count) {

                            $institution_type_name =   count($user_type_rows) == 1 ? (string)$user_type_rows[0]['institution_type'] : "";
                            $institution_type_id =   count($user_type_rows) == 1 ? (string)$user_type_rows[0]['m_institution_type_id'] : "";
                            $record['insti_type_name'] = '<li class="list-group-item"> * ' . $institution_type_name . '  </li>';

                            $result['error_msg'] =  $record;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'Unable to get HOD details. Please try again later.';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else if ($user_type == '20' or $user_type == '40' or $user_type == '50') {
                        //others  getting mapped district name

                        $get_user_district = '';
                        $district_name = '';
                        $district_id = '';

                        $get_user_district = isset($_SESSION['user_details']['district']) ?  $_SESSION['user_details']['district'] : '';
                        $getdistrict_details = $this->registration_modal->GetDistrictCode($get_user_district);
                        if (count($getdistrict_details)) {

                            $district_id = trim($getdistrict_details['m_district_id']);
                            $district_name = trim($getdistrict_details['district_name']);

                            $record['insti_disctrict'] = '<li class="list-group-item"> * ' . $district_name . '  </li>';


                            $result['error_msg'] =  $record;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'Unable to get user details. Please try again later.';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    }
                } else  if ($user_type == '31') {



                    $email_id = $sql_rows['email_id']  ? $sql_rows['email_id'] : $sql_rows['lusername'];
                    $lusername = $sql_rows['lusername']  ? $sql_rows['lusername'] : '';
                    $mobile_number = $sql_rows['mobile_number']  ? $sql_rows['mobile_number'] : '';

                    $user_id = $sql_rows['user_login_id'];
                    $get_insitutionid = isset($_SESSION['user_details']['institution_id'][0]) ?  $_SESSION['user_details']['institution_id'][0] : '';
                    if ($get_insitutionid) {

                        //asuming single value of type is mapped to this institution
                        $get_institution_type = isset($_SESSION['user_details']['m_institution_type_id'][0]) ?  $_SESSION['user_details']['m_institution_type_id'][0] : '';
                        if ($get_institution_type) {
                            //getting details of institution_type_id  by id
                            $institution_type_rows  = $this->master_modal->mInstitutionType($get_institution_type);
                            $insti_count = count($institution_type_rows);
                            if ($insti_count) {
                                $institution_type_name =   count($institution_type_rows) == 1 ? (string)$institution_type_rows[0]['institution_type'] : "";
                                $institution_type_id =   count($institution_type_rows) == 1 ? (string)$institution_type_rows[0]['m_institution_type_id'] : "";

                                $contactperson = '';
                                //getting details of institution by id
                                $institution_details = $this->master_modal->institutionDetailsById($get_insitutionid);

                                if ($institution_details) {


                                    $institute_name  = $institution_details['institution_name'];
                                    $district_name  = (string)$institution_details['district_name'];
                                    $district_id  = (string)$institution_details['m_district_id'];
                                    $contactperson = $institution_details['contact_person']  ? $institution_details['contact_person'] : '';
                                    $address = $institution_details['address']  ? $institution_details['address'] : '';
                                    $pincode = $institution_details['pincode']   ? $institution_details['pincode']   : '';


                                    $record['insti_disctrict'] = '<li class="list-group-item"> * ' . $district_name . '  </li>';
                                    $record['insti_type_name'] = '<li class="list-group-item"> * ' . $institution_type_name . '  </li>';
                                    $record['insti_name'] = $institute_name;
                                    $record['insti_email'] = $email_id;
                                    $record['insti_phoneno'] = $mobile_number;
                                    $record['insti_lusername'] = $lusername;
                                    $record['insti_address'] = $address;
                                    $record['insti_pincode'] = $pincode;
                                    $record['user_id'] = $user_id;


                                    $result['error_msg'] =  $record;
                                    $result['error_code'] = '200';
                                    $result['error_status'] = true;
                                } else {

                                    $result['error_msg'] = 'Unable to fetch Institution details. contact admin';
                                    $result['error_code'] = '200';
                                    $result['error_status'] = true;
                                }
                            } else {

                                $result['error_msg'] = 'Unable to fetch Institution details. contact admin';
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            }
                        } else {

                            $result['error_msg'] = 'Unable to fetch Institution details. contact admin';
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        }
                    } else {

                        $result['error_msg'] = "Unable to fetch records Institution details. Contact admin.";
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                }
            } else if ($no_rows == 0) {

                $result['error_msg'] = "Unable to fetch records for the user. Contact admin.";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    } //check login first time

    //email exist
    public function checkInstitutionEmailExist()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';

        $user_email = trim($_POST['institution_email']);
        $userid = $_SESSION['user_details']['user_id'];

        if (!$this->validation->emptyCheck($user_email)) {

            $result['error_msg'] = "Email ID cannot be left empty.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$valid_email = $this->validation->emailValidation($user_email)) {

            $result['error_msg'] = "Please enter valid format for email.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $result_query  =  $this->registration_modal->checkInstitutionsEmailExist($user_email, $userid);
            if (count($result_query)) {
                $result['error_msg'] = "Email ID already exist. Please try with another email id.";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            } else {

                $result['error_msg'] = "";
                $result['error_code'] = '200';
                $result['error_status'] = true;
            }
        }
        return $result;
    }
    //email exist

    //checing mobile exist
    public function checkInstitutionmobileExist()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';

        $mobileno = trim($_POST['institution_mobile']);
        $userid = $_SESSION['user_details']['user_id'];
        if (!$this->validation->emptyCheck($mobileno)) {

            $result['error_msg'] = "Mobile number cannot be left empty.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$valid_email = $this->validation->mobileValidation($mobileno)) {

            $result['error_msg'] = "Please enter valid mobile number";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $result_query  =  $this->registration_modal->checkInstitutionsmobileExist($mobileno, $userid);

            if (count($result_query)) {

                $result['error_msg'] = "Mobile number already exist. Please try with another mobile number.";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            } else {

                $result['error_msg'] = "";
                $result['error_code'] = '200';
                $result['error_status'] = true;
            }
        }
        return $result;
    }
    //checing mobile exist

    //sending otp in email
    public function sendOTPemailinstitute()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';
        $emialid = trim($_POST['email_id']);
        $userid = $_SESSION['user_details']['user_id'];

        if (!$this->validation->emptyCheck($emialid)) {

            $result['error_msg'] = "Email id is emtpy. please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emailValidation($emialid)) {

            $result['error_msg'] = "Entered email id is not a valid email format";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ($this->registration_modal->checkInstitutionsEmailExist($emialid, $userid)) {

            $result['error_msg'] = "email ID alreayd exist, please use another email ID.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {


            $otp = $this->mailer->GenerateOTP();
            if ($otp['error_status']) {
                $OTP_value = $otp['error_msg'];
                //var_dump($OTP_value);
                if ($OTP_value) {

                    $email_array = array(
                        "to_email_id" => $emialid,
                        "email_subject" => "Pudhumai Penn Scheme - Institute Details Updation",
                        "email_body" => "OTP for Institution Details updation  <b>" . $OTP_value . "</b>"
                    );
                    $send_email = $this->mailer->SendEmail($email_array);
                    if ($send_email == true) {

                        $result['error_msg'] = 'Enter OTP sent to your email ID';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    } else {

                        $result['error_msg'] = 'Problem Sending OTP to Email ID.';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {
                    $result['error_msg'] = 'Unable to Generate OTP. Please contact Admin.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Unable to Generate OTP. Please contact Admin.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }
    //sending otp in email

    //email otp  checking for insitution
    public function checkOTPemailinstitute()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';


        $emial_otp = trim($_POST['OTp']);
        $email_id  = trim($_POST['email_id']);
        $userid = $_SESSION['user_details']['user_id'];
        if (!$this->validation->emptyCheck($email_id)) {

            $result['error_msg'] = "Email id is emtpy. please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emailValidation($email_id)) {

            $result['error_msg'] = "Email id is not in valid email format. please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ($this->registration_modal->checkInstitutionsEmailExist($email_id, $userid)) {

            $result['error_msg'] = "Email id already exist. please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ((strlen($emial_otp) != 6)) {

            $result['error_msg'] = "OTP should be 6 digits.";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else {

            $phone_no = '';
            $check_otp = $this->registration_modal->checkOTP($emial_otp, $phone_no, $email_id);
            //var_dump($check_otp);
            if ($check_otp) {

                $result['error_msg'] = "OTP validated successful";
                $result['error_code'] = '200';
                $result['error_status'] = 'true';
            } else {

                $result['error_msg'] = "OTP expired or invalid OTP.";
                $result['error_code'] = '400';
                $result['error_status'] = 'false';
            }
        }


        return $result;
    }
    //email otp  checking for insitution


    //mobile otp for insitution
    public function sendOTPmobileinstitute()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';
        $mobileno = trim($_POST['mobile_no']);
        $userid = $_SESSION['user_details']['user_id'];

        if (!$this->validation->emptyCheck($mobileno)) {

            $result['error_msg'] = "mobile number is emtpy. please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->mobileValidation($mobileno)) {

            $result['error_msg'] = "Entered mobile number is not valid ";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ($this->registration_modal->checkInstitutionsmobileExist($mobileno, $userid)) {

            $result['error_msg'] = "Mobile number alreayd exist, please use another mobile number.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->master->limitOTPMobile($mobileno, '1')) {

            $result['error_msg'] = "OTP Limit Exceeded. Please try after some time.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $emialid = '';
            $otp = $this->mailer->GenerateOTP();
            //var_dump($otp);
            if ($otp['error_status']) {
                $OTP_value = $otp['error_msg'];
                //var_dump($OTP_value);
                if ($OTP_value) {


                     $send_otp = $this->api_controller->sendingOTP($mobileno, $OTP_value, 'PasswordReset');

                    
                    if ($send_otp == true) {

                        $sent_by =  trim($_SESSION['user_details']['user_id']);
                        $result_modal = $this->registration_modal->InsertOTP($OTP_value, $sent_by, $mobileno, $emialid);

                        if ($result_modal) {
                            $result['error_msg'] = 'Enter the OTP sent to your mobile number';
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'Problem in Updating OTP to mobile number';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Problem in Sending OTP to mobile number';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {
                    $result['error_msg'] = 'Unable to Generate OTP. Please contact Admin.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Unable to Generate OTP. Please contact Admin.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }
    //mobile otp for insitution

    //mobile otp  checking for insitution
    public function checkOTPmobileinstitute()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';


        $mobile_otp = trim($_POST['OTp']);
        $mobile_no  = trim($_POST['mobileno']);
        $userid = $_SESSION['user_details']['user_id'];
        if (!$this->validation->emptyCheck($mobile_no)) {

            $result['error_msg'] = "Mobile number is emtpy. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->mobileValidation($mobile_no)) {

            $result['error_msg'] = "Mobile number is not valid. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ($this->registration_modal->checkInstitutionsmobileExist($mobile_no, $userid)) {

            $result['error_msg'] = "Mobile number already exist. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ((strlen($mobile_otp) != 6)) {

            $result['error_msg'] = "OTP should be 6 digits.";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else {

            $email_id = '';
            $check_otp = $this->registration_modal->checkOTP($mobile_otp, $mobile_no, $email_id);
            if ($check_otp) {

                $result['error_msg'] = "OTP validated successfully";
                $result['error_code'] = '200';

                $result['error_status'] = 'true';
            } else {

                $result['error_msg'] = "OTP expired or invalid OTP";
                $result['error_code'] = '400';
                $result['error_status'] = 'false';
            }
        }


        return $result;
    }
    //mobile otp  checking for insitution


    //first time new password updation
    public function newInstitutionPassword()
    {

        $result['error_msg'] = "";
        $result['major_update'] = "";

        $result['error_code'] = '400';
        $result['error_status'] = false;

        $user_id = trim($_SESSION['user_details']['user_id']);
        $user_type = trim($_SESSION['user_details']['user_type']);

        $institution_id = isset($_SESSION['user_details']['institution_id'][0]) ?  $_SESSION['user_details']['institution_id'][0] : '';

        $newpassword = trim($_POST['new_password']);
        $confirmpassword = trim($_POST['confirm_password']);
        $update_type = trim($_POST['updatetype']);
        $institution_email = trim($_POST['insti_email']);
        $institution_mobile = trim($_POST['insti_mobileno']);
        $contact_person = trim($_POST['insti_contact']);
        $institution_address = isset($_POST['insti_address']) ? trim($_POST['insti_address'])  : '';
        $institution_pincode = isset($_POST['insti_pincode'])   ?  trim($_POST['insti_pincode'])  : '';




        if ($update_type == '1') {

            //validation code  for default 
            $emailemptyvalidate = $this->validation->emptyCheck($institution_email);

            $validemailvalidate =  $this->validation->emailValidation($institution_email);
            $emailexistvalidate = $this->registration_modal->checkInstitutionsEmailExist($institution_email, $user_id);

            $phoneemptyvalidate = $this->validation->emptyCheck($institution_mobile);
            $validephonevalidate = $this->validation->mobileValidation($institution_mobile);

            $phoneexistvalidate = $this->registration_modal->checkInstitutionsmobileExist($institution_mobile, $user_id);


            $newpasswordemptyvalidate = $this->validation->emptyCheck($newpassword);
            $newpasswordrequiredvalidate = $this->validation->userPasswordcheck($newpassword);

            $confirmpasswordemtpyvalidate = $this->validation->emptyCheck($confirmpassword);
            $confirmpasswordrequiredvalidate = $this->validation->userPasswordcheck($confirmpassword);
            $newpasswordequalvalidate =  ($newpassword == $confirmpassword) ? true  : false;


            //validation code 


        } else if ($update_type == '2') {


            $institution_id == true;

            if ($institution_email != '') {

                $emailemptyvalidate = $this->validation->emptyCheck($institution_email);
                $validemailvalidate =  $this->validation->emailValidation($institution_email);
                $emailexistvalidate = $this->registration_modal->checkInstitutionsEmailExist($institution_email, $user_id);
            } else if ($institution_email == '') {

                $emailemptyvalidate = $validemailvalidate =  true;
                $emailexistvalidate = false;
            }

            if ($institution_mobile != '') {

                $phoneemptyvalidate = $this->validation->emptyCheck($institution_mobile);
                $validephonevalidate = $this->validation->mobileValidation($institution_mobile);
                $phoneexistvalidate = $this->registration_modal->checkInstitutionsmobileExist($institution_mobile, $user_id);
            } else if ($institution_email == '') {

                $phoneemptyvalidate = $validephonevalidate =  true;
                $phoneexistvalidate = false;
            }

            if ($newpassword == '' and $confirmpassword == '') {

                $newpasswordemptyvalidate = $newpasswordrequiredvalidate = $confirmpasswordemtpyvalidate = $confirmpasswordrequiredvalidate = $newpasswordequalvalidate = true;
            } else {


                $newpasswordemptyvalidate = $this->validation->emptyCheck($newpassword);
                $newpasswordrequiredvalidate = $this->validation->userPasswordcheck($newpassword);
                $confirmpasswordemtpyvalidate = $this->validation->emptyCheck($confirmpassword);
                $confirmpasswordrequiredvalidate = $this->validation->userPasswordcheck($confirmpassword);
                $newpasswordequalvalidate =  ($newpassword == $confirmpassword) ? true  : false;
            }
        }

        if (!$this->validation->emptyCheck($user_id)) {

            $result['error_msg'] = "Unable to fetch user details. Try again later";
        } else if (!$institution_id) {

            $result['error_msg'] = "Unable to fetch Institution details";
        } else if (!$newpasswordemptyvalidate) {

            $result['error_msg'] = "Please enter New password.";
        } else if (!$newpasswordrequiredvalidate) {

            $result['error_msg'] = "Entered password doens't meet the requirement. Please check";
        } else if (!$confirmpasswordemtpyvalidate) {

            $result['error_msg'] = "Please enter Confirm password.";
        } else if (!$confirmpasswordrequiredvalidate) {

            $result['error_msg'] = "Confirm password doens't meet the requirement. Please check";
        } else if (!$newpasswordequalvalidate) {

            $result['error_msg'] = "New password and Confirm password are not same. Please check";
        } else if (!$emailemptyvalidate) {

            $result['error_msg'] = "Please enter Email ID";
        } else if (!$validemailvalidate) {

            $result['error_msg'] = "Please enter valid email ID";
        } else if ($emailexistvalidate) {

            $result['error_msg'] = "Entered email ID already exists. Please try with another Email ID";
        } else if (!$phoneemptyvalidate) {

            $result['error_msg'] = "Please enter mobile number";
        } else if (!$validephonevalidate) {

            $result['error_msg'] = "Please enter valid mobile number";
        } else if ($phoneexistvalidate) {

            $result['error_msg'] = "Mobile number is already registered. Please try with another mobile number.";
        } else   if (!$this->validation->emptyCheck($contact_person)) {

            $result['error_msg'] = "Please enter the name of the Contact Person.";
        } else {



            //updating user password
            $table_name1 = 'user_login';
            //$records1['m_user_type_id'] = '31';
            if ($update_type == '2') {
                if ($institution_email) {

                    $records1['email_id'] = $institution_email;
                }
            } else {

                $records1['email_id'] = $institution_email;
            }

            $records1['contact_person'] = $contact_person;
            $records1['mobile_number'] = $institution_mobile;
            $records1['first_time_logged'] = '1';
            /*  $records1['updated_on'] = date("Y-m-d H:i:s");
            $records1['updated_by'] = $user_id; */

            //$records1['pass_word'] = $this->validation->passwordGenerator($newpassword);



            if ($newpassword) {

                $salting_len = 11;
                $salting = $this->validation->saltGeneration($salting_len);
                $encrypt_pass =  $this->validation->passwordGenerator($newpassword, $salting);
                $records1['pass_word'] = $encrypt_pass;
            }


            //$records1['pass_word'] = '$2a$07$6457b2c72f697e1c27567uKcoaZ3fJhM4FYWj8Eq1K6YbEcfGacq6';
            $where1 = "user_login_id ='" . $user_id . "' ";
            if ($user_type == '31') {

                //updating institution details
                $table_name2 = 'm_institution';
                $records2['contact_person'] = $contact_person;
                $records2['address'] = $institution_address;
                $records2['pincode'] = $institution_pincode;
                /*  $records2['updated_on'] = date("Y-m-d H:i:s");
                $records2['updated_by'] = $user_id; */
                $where2 = "m_institution_id ='" . $institution_id . "' ";

                $update_institution_details = $this->registration_modal->updateInstitutionDetails($table_name2, $records2, $where2);
            } else {

                $update_institution_details = true;
            }

            //updating in userlogin table
            $update_institution_password = $this->registration_modal->updateInstitutionNewPassword($table_name1, $records1, $where1);

            //updating in m_institution table
            if ($update_institution_password and  $update_institution_details) {
                $result['error_msg'] = "Profile and password updated successfully.<br> You will be logged out automatically. <br> Please login with new password";
                if ($update_type == '2') {

                    if ($institution_email) {
                        $result['error_msg'] = "Primary Username updated successfully.<br> You will be logged out automatically. <br> Please login with new credentials";
                        $result['major_update'] = "1";
                    } else {

                        $result['error_msg'] = "Profile Details updated successfully.";
                        $result['major_update'] = "0";
                    }
                }


                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = "Unable to save the changes. Please contact admin";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    } //function ends
    //first time new password updation

    public function insertNewInstitutionbydot()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';

        $district = trim($_POST['district_list']);
        $institute_name = trim($_POST['institute_name']);
        $dot_userid = $_SESSION['user_details']['user_id'];
        $dot_institution_type_id = isset($_SESSION['user_details']['m_institution_type_id'][0]) ? trim($_SESSION['user_details']['m_institution_type_id'][0]) : '';

        if ($dot_institution_type_id == 'all') {

            $dot_institution_type_id = $district;

            $district = isset($_SESSION['user_details']['district']) ? trim($_SESSION['user_details']['district']) : '';
        }


        if (!$this->validation->emptyCheck($district)) {

            $result['error_msg'] = "Please select the district name.";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else if (!$this->validation->emptyCheck($institute_name)) {

            $result['error_msg'] = "Please select the Institution name.";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else if (!$this->validation->emptyCheck($dot_userid)) {

            $result['error_msg'] = "Unable to fetch current user details";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else if (!$this->validation->emptyCheck($dot_institution_type_id)) {

            $result['error_msg'] = "Unable to fetch current user details";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else {

            $institute_count = $this->master_modal->checkInstituteNameExist($institute_name, $district);

            if (count($institute_count)) {

                $result['error_msg'] = "College name already exists. Please check";
                $result['error_code'] = '400';
                $result['error_status'] = 'false';
            } else {

                //creating new institution id
                $m_user_type = '31';


                //adding instition and getting id
                $add_collegemaster = $this->registration_modal->registerInstituteName($district, $institute_name, $dot_userid, $dot_institution_type_id);
                $institution_id = $add_collegemaster;
                $autopassword =  $this->validation->randomPasswordGenerator();
                $salting_len = 11;
                $salting = $this->validation->saltGeneration($salting_len);
                $password =  $this->validation->passwordGenerator($autopassword, $salting);
                //var_dump($autopassword);

                //$password = '$2a$07$6457b2c72f697e1c27567uKcoaZ3fJhM4FYWj8Eq1K6YbEcfGacq6';

                $checkingprefix = $this->registration_modal->createPrefixUsername($dot_institution_type_id);

                if ($checkingprefix) {
                    $prefix_username = $checkingprefix['lusername'];
                    $prefixusername_count = $this->registration_modal->checkPrefixExist($prefix_username);
                    if ($prefixusername_count == '0') {

                        //create and adding username and password in table,returning user id
                        $get_username_password = $this->registration_modal->createUsernamePassword($m_user_type, $prefix_username, $password, $dot_userid, $autopassword, $institution_id);
                        if ($get_username_password) {

                            $institution_primaryid = $get_username_password;
                            //var_dump($institution_primaryid);
                            if ($institution_primaryid) {
                                //updating prefix serila value
                                $updateprefixserial_count = $this->registration_modal->updatePrefixSerial($dot_institution_type_id);
                                if ($updateprefixserial_count) {
                                    $login_id = $institution_primaryid;
                                    if ($add_collegemaster and $get_username_password) {

                                        $res_arr['m_district_id'] = [$district];
                                        $res_arr['m_institution_id'] = [$institution_id];
                                        $res_arr['m_institution_type_id'] = [$dot_institution_type_id];

                                        $json_value = json_encode($res_arr, true);

                                        $table_name = 'user_login';
                                        $result_update_access = $this->registration_modal->UpdateJsonfield($login_id, $table_name, $json_value);
                                        if ($result_update_access) {

                                            $result['error_msg'] = "Institution added successfully. <br> Login credentials shown below. ";

                                            /*  $result['username_table'] =  '<table class="table " width="100%"> <thead>    <tr > <td width="50%" > <b> Username </b> </td> <td width="50%" class="datata_td" > <b>' . $prefix_username . '</b> </td> </tr> <tr width="50%">  <td> <b> Password </b>  </td> <td width="50%" lass="datata_td" > <b>' . $autopassword . '</b> </td> </tr>  </thead>      </table>'; */
                                            $result['username_table'] = '<table class="table table-bordered"><thead class="bg-200">
                                           <tr>
                                              <th scope="col"> Login Id </th>
                                              <th scope="col"> Password </th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> <b>' . $prefix_username . '</b>   </td>
                                            <td> <b>' . $autopassword . '</b>  </td>
                                        </tr>
                                        </tbody> (Please take note of the Login Id  and Password.)
                                        </table>';
                                            $result['error_code'] = '200';
                                            $result['error_status'] = 'true';
                                        } else {

                                            $result['error_msg'] = "Unable to save college details.";
                                            $result['error_code'] = '400';
                                            $result['error_status'] = 'false';
                                        }
                                    } else {


                                        $result['error_msg'] = "Unable to register the college. Please try again later";
                                        $result['error_code'] = '400';
                                        $result['error_status'] = 'false';
                                    }
                                } else {

                                    //Unable to update last serial number for updated Institute type.
                                    $result['error_msg'] = "Unable to register the college. Please try again later";
                                    $result['error_code'] = '400';
                                    $result['error_status'] = 'false';
                                }
                            } else {
                                //unable to get default user name. contact admin.
                                $result['error_msg'] = "Unable to register the college. Please try again later";
                                $result['error_code'] = '400';
                                $result['error_status'] = 'false';
                            }
                        } else {
                            //unable to register default username try again late
                            $result['error_msg'] = "Unable to register the college. Please try again later";
                            $result['error_code'] = '400';
                            $result['error_status'] = 'false';
                        }
                    } else {
                        //Username already exist,  try again later
                        $result['error_msg'] = "Unable to register the college. Please try again later";
                        $result['error_code'] = '400';
                        $result['error_status'] = 'false';
                    }
                } else {
                    //Unable to create default username please try again later
                    $result['error_msg'] = "Unable to register the college. Please try again later";
                    $result['error_code'] = '400';
                    $result['error_status'] = 'false';
                }
            }
        }
        return $result;
    }

    public function instituteRegisterListDot()
    {


        $user_id = $_SESSION['user_details']['user_id'];
        //reports for dot hence 31 set as default
        $user_type =   isset($_SESSION['user_details']['user_type'])  ? trim($_SESSION['user_details']['user_type'])  : '';
        $m_institute_type =  isset($_SESSION['user_details']['m_institution_type_id'][0])  ? trim($_SESSION['user_details']['m_institution_type_id'][0])  : '';
        $district_id = isset($_SESSION['user_details']['district'])  ? trim($_SESSION['user_details']['district'])  : '';
        //var_dump($district_id);

        if (!$this->validation->emptyCheck($user_id)) {

            $result['error_msg'] = 'Unable to fetch user details.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($m_institute_type)) {

            $result['error_msg'] = 'Unable to fetch user details.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($user_type)) {

            $result['error_msg'] = 'Unable to fetch user details.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            if ($m_institute_type != 'all') {

                $result_modal = $this->registration_modal->instituteRegisterListDot($user_id, $m_institute_type, $user_type);
            } else {

                $result_modal = $this->registration_modal->instituteRegisterListDotByDistrict($user_id, $district_id, $user_type);
            }

            // Call registered institution list

            //var_dump($result_modal);


            $records_count  = count($result_modal);
            if ($records_count) {


                $list_html = '';

                if ($records_count) {
                    $sino = 1;
                    foreach ($result_modal  as $fields) {

                        $list_html .= '<tr>';

                        $list_html .= '<td>' . $sino . '</td>';
                        $list_html .= '<td>' . $fields['institution_name'] . '</td>';

                        //var_dump($user_type);
                        if ($user_type == '40') {

                            $institutiontypeid = isset($fields['institution_type_id']) ? $fields['institution_type_id'] : '';
                            $institutetype_name = '';
                            //var_dump($institutiontypeid);
                            if ($institutiontypeid) {

                                $institutename = $this->master_modal->mInstitutionType($institutiontypeid);

                                $institutetype_name  = is_array($institutename) ? $institutename[0]['institution_type']   : '';
                            }
                            $list_html .= '<td>' . $institutetype_name . '</td>';
                        }



                        $list_html .=   '<td>' . $fields['district_name'] . '</td>';
                        $list_html .=  '<td>';
                        $username = isset($fields['first_time_logged']) ? $fields['email_id'] : $fields['lusername'];
                        $list_html .= $username;
                        $list_html .= '</td>';
                        $list_html .=  '<td>';
                        $password_status = isset($fields['first_time_logged']) ? '<span class="badge badge rounded-pill badge-soft-success">Success<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>'  : '<span class="badge badge rounded-pill badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span> ';
                        $list_html .= $password_status;
                        $list_html .= '</td>';

                        $list_html .= '<td>';
                        //var_dump($fields['updated_on']);
                        $userview_date =  $this->validation->dateFormateUserView($fields['last_updated_on']);
                        $list_html .= $userview_date ? $userview_date : '';
                        $list_html .=   '</td>';

                        $mobile_no = isset($fields['mobile_number'])  ? trim($fields['mobile_number']) : '';
                        $list_html .= '<td>' . $mobile_no . '</td>';
                        $list_html .= '<td>' . $fields['contact_person'] . '</td>';
                        $list_html .= '<td>  <div><button class="btn btn-success mb-2 "  onclick="editcollegecourse(' . "'" . $fields['m_institution_id'] . "'" . ')"     > <i class="fas fa-edit"></i></button> </div>  </td>';



                        //$list_html .= '<td class="text-end"><div><button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="text-500 fas fa-edit"></span></button><button class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" itle="Delete"><span class="text-500 fas fa-trash-alt"></span></button></div></td> ';


                        $list_html .= '</tr>';
                        $sino++;
                    }
                } else {

                    $list_html = '<tr><td colspan="8" class="text_center"> no records found<td></tr>';
                }

                $result['error_msg'] = $list_html;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = $list_html = '<tr><td colspan="8" class="text_center"> no records found<td></tr>';;
                $result['error_code'] = '200';
                $result['error_status'] = false;
            }
        }
        return $result;
    }






    //mobile otp  checking for insitution
    public function VerifyOTPmobile()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';


        $mobile_otp = trim($_POST['OTp']);
        $mobile_no  = trim($_POST['mobileno']);
        if (!$this->validation->emptyCheck($mobile_no)) {

            $result['error_msg'] = "Mobile number is emtpy. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->mobileValidation($mobile_no)) {

            $result['error_msg'] = "Mobile number is not valid. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if ((strlen($mobile_otp) != 6)) {

            $result['error_msg'] = "OTP should be 6 digits.";
            $result['error_code'] = '400';
            $result['error_status'] = 'false';
        } else {

            $email_id = '';
            $check_otp = $this->registration_modal->checkOTP($mobile_otp, $mobile_no, $email_id);
            if ($check_otp) {

                $result['error_msg'] = "OTP validated successfully";
                $result['error_code'] = '200';

                $result['error_status'] = 'true';
            } else {

                $result['error_msg'] = "OTP expired or invalid OTP";
                $result['error_code'] = '400';
                $result['error_status'] = 'false';
            }
        }


        return $result;
    }
    //mobile otp  checking for insitution



    //first time new password updation
    public function newPasswordUpdation()
    {

        $result['error_msg'] = "";
        $result['error_code'] = '';
        $result['error_status'] = '';

        $user_id = trim($_POST['userid']);
        $newpassword = trim($_POST['new_password']);
        $confirmpassword = trim($_POST['confirm_password']);

        $institution_email = trim($_POST['insti_email']);
        $institution_mobile = trim($_POST['insti_mobileno']);

        if (!$this->validation->emptyCheck($user_id)) {

            $result['error_msg'] = "Unable to fetch user details. Try again later";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($newpassword)) {

            $result['error_msg'] = "Please enter New password.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->userPasswordcheck($newpassword)) {

            $result['error_msg'] = "Entered password doens't meet the requirement. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($confirmpassword)) {

            $result['error_msg'] = "Please enter Confirm password.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->userPasswordcheck($confirmpassword)) {

            $result['error_msg'] = "Confirm password doens't meet the requirement. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$newpassword == $confirmpassword) {

            $result['error_msg'] = "New password and Confirm password are not same. Please check";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($institution_email)) {

            $result['error_msg'] = "Please enter Email ID";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emailValidation($institution_email)) {

            $result['error_msg'] = "Please enter valid email ID";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($institution_mobile)) {

            $result['error_msg'] = "Please enter mobile number";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->mobileValidation($institution_mobile)) {

            $result['error_msg'] = "Please enter valid mobile number";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $userid = $this->validation->decryptValue($user_id);
            if ($this->validation->numbersonly($userid)) {


                //var_dump($newpassword);
                $salting_len = 11;
                $salting = $this->validation->saltGeneration($salting_len);
                $encrypt_pass =  $this->validation->passwordGenerator($newpassword, $salting);
                //updating user password
                $table_name1 = 'user_login';
                //$records1['m_user_type_id'] = '31';
                $records1['updated_on'] = date("Y-m-d H:i:s");
                $records1['updated_by'] = $user_id;
                $records1['pass_word'] = $encrypt_pass;
                $where1 = "user_login_id ='" . $userid . "' ";
                //updating in userlogin table


                $update_institution_password = $this->registration_modal->updateInstitutionNewPassword($table_name1, $records1, $where1);

                //updating in m_institution table
                if ($update_institution_password) {


                    $result['error_msg'] = "New password updated successfully.<br>   Please login with new password";
                    $result['error_code'] = '200';
                    $result['error_status'] = false;
                } else {

                    $result['error_msg'] = "Unable to save the changes. Please contact admin";
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = "Unable to fetch user details. Please contact admin";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    } //function ends
    //first time new password updation








} //class closing
