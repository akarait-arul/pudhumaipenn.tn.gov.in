<?php

include_once("./Models/RegistrationModel.php");
include_once("./Models/MasterModel.php");
include_once("./classes/validation.php");

require_once './libraries/vendor/autoload.php';

class Registration
{

    function __construct()
    {

        $this->validation = new validation();
        $this->registration_modal = new RegistrationModel();
        $this->master_modal = new MasterModel();
    }

    public function getDegree()
    {

        $result = [];
        if (isset($_POST['institution_id'])) {

            $result_modal = $this->master_modal->mDegree($_POST['institution_id']);

            if ($result_modal != '' && $result_modal != 0 && count($result_modal) > 0) {

                $result['error_msg'] = $result_modal;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Records Not Found!!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Institution ID !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }


    public function getSubject()
    {

        $result = [];
        if (isset($_POST['degree'])) {

            $result_modal = $this->master_modal->mDegreeSubject($_POST['degree']);
            if ($result_modal != '' && $result_modal != 0 && count($result_modal) > 0) {

                $result['error_msg'] = $result_modal;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Records Not Found !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Institution ID !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    // function to Get EMIS
    public function getEMIS()
    {

        $result = [];

        $empty_check_emis = $this->validation->emptyCheck($_POST['emis_id']);
        $empty_check_stud_reg_id = $this->validation->emptyCheck($_POST['student_reg_id']);

        // Condition Check EMIS and Student Registration Validation
        if ($empty_check_emis == true && $empty_check_stud_reg_id ==  true) {

            // Call EMIS Validation Method
            $validate_emis = $this->validation->emisValidation($_POST['emis_id']);

            //Condition Check Valid EMIS Number            
            if ($validate_emis == true) {

                $result_emis_api = array(
                    "student_registration_id" => $_POST['student_reg_id'],
                    "student_institution_details_id" => '1',
                    "student_name" => "Arul",
                    "date_of_birth" => "2000-07-04",
                    "aadhaar_no" => "123456789123456",
                    "community" => "MBC",
                    "religion" => "Hindu",
                    "address" => "Choolaimedu Chennai",
                    "pincode" => "600094",
                    "mother_name" => "Vani",
                    "mother_qualification" => "house wife",
                    "father_name" => "elumalai",
                    "father_occupation" => "business",
                    "father_qualification" => "12th",
                    "guardian_name" => "shankar",
                    "annual_income_range" => "70000"
                );


                $emis_json =  json_encode($result_emis_api);

                $result_institution_details = array(
                    "student_registration_id" => $_POST['student_reg_id'],
                    "m_degree_id" => $_POST['degree'],
                    "m_subject_id" => $_POST['subject'],
                    "date_of_admission" => $_POST['date_of_admission'],
                    "emis_id" => $_POST['emis_id'],
                    "emis_id_verified" => 'Y',
                    "emis_id_verified_on" => date("Y-m-d"),
                    "emis_id_validation" => 'Y',
                    "emis_data" => $emis_json,
                    "reg_date" => date("Y-m-d"),
                    "created_by" => '1'
                );

                // Condition Check EMIS API Result 
                if ($result_emis_api != '' && $result_emis_api != 0) {

                    $result_submit_institution = $this->submitInstitutionDetails($result_institution_details);

                    if ($result_submit_institution != false && $result_submit_institution != 0) {

                        $result_submit_student = $this->submitStudentDetails($result_emis_api);
                        if ($result_submit_student != false && $result_submit_student != 0) {

                            $result['error_msg'] = $result_emis_api;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'Problem on Insert Student Details Record !!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;
                        }
                    } else {

                        $result['error_msg'] = 'Problem on Insert Institution Details Record !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;
                    }
                } else {

                    $result['error_msg'] = 'Records Not Found !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Invalid EMIS Number !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Records Not Found !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    /* public function getEMIS(){

        $result=[];
        
        $empty_check_emis = $this->validation->emptyCheck($_POST['emis_id']);
        $empty_check_stud_reg_id = $this->validation->emptyCheck($_POST['student_reg_id']);

        // Condition Check EMIS and Student Registration Validation
        if($empty_check_emis == true && $empty_check_stud_reg_id ==  true){
            
            // Call EMIS Validation Method
            $validate_emis = $this->validation->emisValidation($_POST['emis_id']);
            
            //Condition Check Valid EMIS Number            
            if($validate_emis == true){

                $result_emis_api = array(
                    "student_registration_id"=>$_POST['student_reg_id'],
                    "student_institution_details_id"=>'1', 
                    "student_name"=>"Arul",
                    "date_of_birth"=>"2000-07-04",
                    "aadhaar_no"=>"123456789123456",
                    "community"=>"MBC",
                    "religion"=>"Hindu",
                    "address"=>"Choolaimedu Chennai",
                    "pincode"=>"600094",
                    "mother_name"=>"Vani",
                    "mother_qualification"=>"house wife",
                    "father_name"=>"elumalai",
                    "father_occupation"=>"business",
                    "father_qualification"=>"12th",
                    "guardian_name"=>"shankar",
                    "annual_income_range"=>"70000"
                );
                

                $emis_json =  json_encode($result_emis_api);

                $result_institution_details = array(

                    "student_registration_id" =>$_POST['student_reg_id'],
                    "m_degree_id"=>$_POST['degree'],
                    "m_subject_id"=>$_POST['subject'],
                    "date_of_admission"=>$_POST['date_of_admission'],
                    "emis_id"=>$_POST['emis_id'],
                    "emis_id_verified"=>'Y',
                    "emis_id_verified_on"=>date("Y-m-d"),
                    "emis_id_validation"=>'Y',
                    "emis_data"=>$emis_json,
                    "reg_date"=>date("Y-m-d"),
                    "created_by"=>'1'

                );                

                // Condition Check EMIS API Result 
                if($result_emis_api!='' && $result_emis_api!=0){
                    
                    $result_submit_institution = $this->submitInstitutionDetails($result_institution_details);
                    
                    if($result_submit_institution != false && $result_submit_institution !=0){
                        
                        $result_submit_student = $this->submitStudentDetails($result_emis_api);
                        if($result_submit_student!=false && $result_submit_student!=0){

                            $result['error_msg'] = $result_emis_api;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;                        
                        
                        }else{

                            $result['error_msg'] = 'Problem on Insert Student Details Record !!!';
                            $result['error_code'] = '400';
                            $result['error_status'] = false;

                        }

                    }else{

                        $result['error_msg'] = 'Problem on Insert Institution Details Record !!!';
                        $result['error_code'] = '400';
                        $result['error_status'] = false;

                    }                                                       
                
                }else{
    
                    $result['error_msg'] = 'Records Not Found !!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
    
                }
                        
            }else{

                $result['error_msg'] = 'Invalid EMIS Number !!!';
                $result['error_code'] = '400';
                $result['error_status'] = false;

            } 
                
        }else{

            $result['error_msg'] = 'Records Not Found !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;

        }        

        return $result;

    } */







    // 




    // Function Get Details
    public function getFilledDetails()
    {

        $empty_check = $this->validation->emptyCheck($_POST['id']);

        if ($empty_check == true) {

            // Call Modal getStudentDetails
            $result_modal = $this->registration_modal->getStudentDetails($_POST['id']);
            if ($result_modal > 0) {

                $result['error_msg'] = $result_modal;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on Send SMS !!!';
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

    // Function Get  institution by group
    public function getDistrictWiseInstitution()
    {

        $inst_grouphtml = '';
        $all_dist = $this->master_modal->mDistrict();

        if (count($all_dist)) {

            foreach ($all_dist as $dis_code) {
                if (count($dis_code)) {

                    $inst_grouphtml .= '<optgroup label="' . $dis_code['district_name'] . '">';
                    $dist_code = $dis_code['district_code'] ? trim($dis_code['district_code'])  : '';
                    if ($dist_code) {

                        $dist_institution = $this->master_modal->mInstitution($dist_code);
                        foreach ($dist_institution as  $dist_inst) {

                            $inst_grouphtml .= '<option value="' . trim($dist_inst['m_institution_id']) . '">' . trim($dist_inst['institution_name']) . '</option>';
                        }
                    }
                    $inst_grouphtml .= ' </optgroup>';
                }
            } //foreach

            if ($inst_grouphtml) {

                $result['error_msg'] = $inst_grouphtml;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'District wise Institution Problem. Please contact Administrator.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Unable to get district. Please contact Administrator.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }


    public function userExistCheck($useremail_id)
    {

        $result = false;
        if ($this->registration_modal->userExistCheck($useremail_id) == 0) {

            $result = true;
        }

        return $result;
    } //function ends 



    public function newUserRegistration()
    {

        $result = false;

        $useremail_id = trim($_POST['usermail']);
        $usr_password = trim($_POST['password']);
        $institution_list = $_POST['institution_list'];
        $usertype  = trim($_POST['usertype']);
        $newmobileno = trim($_POST['newmobileno']);
        $userstatus = trim($_POST['userstatus']);

        // var_dump($institution_list);
        //exit;


        if (!$this->validation->emptyCheck($useremail_id)) {

            $result['error_msg'] = 'Please check the email id.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emailValidation($useremail_id)) {

            $result['error_msg'] = 'Please check the email id.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->userExistCheck($useremail_id)) {

            $result['error_msg'] = 'Email iD is already Registered.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($usr_password)) {

            $result['error_msg'] = 'Please check the Password.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->userPasswordcheck($usr_password)) {

            $result['error_msg'] = "password does n't meet the requirement.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->mobileValidation($newmobileno)) {

            $result['error_msg'] = "password does n't meet the requirement.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($usertype)) {

            $result['error_msg'] = " Please choose user type. ";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($userstatus)) {

            $result['error_msg'] = "Please choose user status.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $saltlength = '11';
            $salting = $this->validation->saltGeneration($saltlength);
            $usr_passwd = $this->validation->passwordGenerator($usr_password, $salting);
            //session_login_id user_login_id
            $login_userid = '1';

            $values = array($usertype, $useremail_id, $usr_passwd, $newmobileno, $login_userid, $userstatus);
            $last_id = $this->registration_modal->registerNewUser($values);



            if ($last_id) {
            } else {

                $result['error_msg'] = "Unable to create user. Try again later.";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }





        return $result;
    } //function ends 





}
