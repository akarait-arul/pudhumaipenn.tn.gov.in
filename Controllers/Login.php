<?php

/* ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */


include_once("./Models/LoginModel.php");
include_once("./Models/SessionModel.php");
include_once("./classes/validation.php");
include_once("./Config/config.php");
include_once("./Controllers/Masters.php");
include_once("./Controllers/APIController.php");
include_once("./Models/RegistrationModel.php");
include_once("./Controllers/Mailer.php");


class Login  extends validation
{



    function __construct()
    {

        $this->login = new LoginModel();
        $this->sessionmodel = new SessionModel();
        $this->master = new Masters();
        $this->api_controller = new APIController();
        $this->registration_modal = new RegistrationModel();
        $this->mailer = new Mailer();
    }
	public function StudentLogin(){
		
		$result['msg'] = '';
        $result['error_code'] = '';
        $result['error_field'] = '';

        $mobile_no =  trim($_POST['mobile_no']);
        $email_id = trim($_POST['email_id']);
        $user_type_id = trim($_POST['user_type']);
        $decoded_usertype = base64_decode($user_type_id);
		if($decoded_usertype == '32'){
			
			if ($this->emptyCheck($mobile_no) && $this->mobileValidation($mobile_no)) {
				
				if($this->emptyCheck($email_id) && $this->emailValidation($email_id)){					
					
					// Check Mobile Number and Email ID
					$result_check_registration = $this->registration_modal->checkRegistrationstudentlogin($mobile_no, $email_id); 	
					if (count($result_check_registration) != 0) {
						
						$otp_validation = $this->master->limitOTPMobile($mobile_no, '1');
						if($otp_validation){
						
							// Call Generate OTP 
							$result = $this->mailer->GenerateOTP();
							if ($result['error_status'] == true) {					
								
								// Send OTP SMS Method Starts Here
								$otp = $result['error_msg'];
								$send_otp_sms = $this->api_controller->sendingOTP($mobile_no, $otp,'OTP');
								if ($send_otp_sms == 1) {									
									
									$sent_by =  0;
									$result_modal = $this->registration_modal->InsertOTP($otp, $sent_by, $mobile_no, $email_id,'OTP');
									$result['error_msg'] = 'OTP sent to the above registered mobile number';
									$result['error_code'] = '200';
									$result['error_status'] = true;								
								
								} else {

									$result['error_msg'] = 'Unable to send OTP Contact Admin';
									$result['error_code'] = '400';
									$result['error_status'] = false;
								}
							
							}else{
								
								$result['error_msg'] = 'Problem on generate otp';
								$result['error_code'] = '400';
								$result['error_status'] = false ;	
								
							}
						
						}else{
							
							$result['error_msg'] = "OTP Limit Exceeded. Please try after some time";
							$result['error_code'] = '400';
							$result['error_status'] = false;
							
						}										
					
					}else{
						
						$result['error_msg'] = 'Student Details Not Found';
						$result['error_code'] = '400';
						$result['error_status'] = false ;						
					
					}
					
				
				} else {
					
					$result['error_msg'] = 'Invalid Email ID';
					$result['error_code'] = '400';
					$result['error_field'] = 'user_passcode' ;
					
				}
				
		   } else {
				
				$result['error_msg'] = 'Invalid Mobile Number';
				$result['error_code'] = '400';
				$result['error_field'] = 'user_passcode' ;
			}
			
			
		}else{
			
			
			$result['error_msg'] = 'Password doesnt meet the requirement. Please check it.';
            $result['error_code'] = '400';
            $result['error_field'] = 'user_passcode' ;
			
		}
     
		
		return $result;
		
	}
	
	public function SubmitStudentOTP() {

        $result = [];
        if (isset($_POST['otp_number']) && isset($_POST['phone_no']) && isset($_POST['user_email'])) {

            $result_modal_otp = $this->registration_modal->checkOTP($_POST['otp_number'], trim($_POST['phone_no']), trim($_POST['user_email']));
			if ($result_modal_otp) {
				
				$result_check_registration = $this->registration_modal->checkRegistration(trim($_POST['phone_no']), trim($_POST['user_email'])); 	
				if($result_check_registration){					
					
					$student_registration_id = $this->encryptValue($result_check_registration['student_registration_id']);
					$result['error_msg'] = 'student_profile.php?id='.$student_registration_id;
					$result['error_code'] = '200';
					$result['error_status'] = true;					
					
				}else{
					
					$result['error_msg'] = 'Student Details Not Found';
					$result['error_code'] = '400';
					$result['error_status'] = false;
					
				}				
			
			}else{
				
				$result['error_msg'] = 'OTP Details Not Verified';
				$result['error_code'] = '400';
				$result['error_status'] = false;
				
			}
		
		}else{
			
			$result['error_msg'] = 'Invalid Student Details';
			$result['error_code'] = '400';
			$result['error_status'] = false;
			
		}
		
		return $result;
	}
    public function UserLogin()
    {

        $result['msg'] = '';
        $result['error_code'] = '';
        $result['error_field'] = '';


        $usernme =  base64_decode(trim($_POST['ussrname']));
        $passcode = base64_decode(trim($_POST['passcode']));
        $user_type_id = trim($_POST['user_type']);
        $decoded_usertype = base64_decode($user_type_id);


        if ($decoded_usertype == '31' || $decoded_usertype == '30') {

            if (!$this->emptyCheck($usernme)) {

                $emailvalidationstatus = false;
            } else {

                $result_query  =  $this->login->Login($usernme, $decoded_usertype);
                $no_rowscheck = $result_query['no_rows'];

                //var_dump($no_rowscheck);


                $emailvalidationstatus = false;

                if ($no_rowscheck == 1) {

                    $emailvalidationstatus = true;
                }
            }
        } else {

            $emailvalidationstatus = $this->emailValidation($usernme);
        }


        if (!$this->emptyCheck($usernme)) {

            $result['msg'] = 'Please check the Username';
            $result['error_code'] = '400';
            $result['error_field'] = 'username_errmsg';
        } else if (!$this->emptyCheck($passcode)) {

            $result['msg'] = 'Password cannot be empty. Please check';
            $result['error_code'] = '400';
            $result['error_field'] = 'password_errmsg';
        } else if (!$emailvalidationstatus) {

            $result['msg'] = 'Username is invalid. Please check or contact admin';
            $result['error_code'] = '400';
            $result['error_field'] = 'username_errmsg';
        } else if (!$this->emptyCheck($user_type_id)) {

            $result['msg'] = 'Please refresh the page. Try again later';
            $result['error_code'] = '400';
            $result['error_field'] = 'username_errmsg';
        } else if (!$this->userPasswordcheck($passcode)) {

            $result['msg'] = 'Password doesnt meet the requirement. Please check it.';
            $result['error_code'] = '400';
            $result['error_field'] = 'user_passcode';
        } else {



            $result_query  =  $this->login->Login($usernme, $decoded_usertype);
            $no_rows = $result_query['no_rows'];
            $sql_rows =  $result_query['rows'];


            //var_dump($sql_rows);
            //exit; 

            if ($no_rows == 1) {

                $user_id = trim($sql_rows['user_login_id']);
                $db_password = trim($sql_rows['pass_word']);
                if ($this->passwordValidation($passcode, $db_password)) {


                    $user_emailid = $sql_rows['email_id'];
                    $active = trim($sql_rows['is_active']);
                    $deleted = trim($sql_rows['is_deleted']);
                    $user_id = trim($sql_rows['user_login_id']);
                    $user_type = trim($sql_rows['m_user_type_id']);
                    $contact_person = $sql_rows['contact_person'];
                    $lusername_id = trim($sql_rows['lusername']);

                    $userfullname = $user_emailid  ? $user_emailid  : $lusername_id ;

                    $access_detail = trim($sql_rows['access_detail']);

                   

                    //var_dump($active);
                    //exit;
                    if (trim($active) == '1') {

                        $result['msg'] = 'User Login Successful.';
                        $result['error_code'] = '200';
                        $result['error_field'] = '';

                        session_destroy();

                        //setcookie('PHPSESSID', '', time() + (86400 * 30), "/");
                        session_start();
                        session_regenerate_id();
                        $sessionid  = session_id();

                        //setcookie('PHPSESSID', $sessionid, time() + (86400 * 30), "/");
                        //false for session exist,true for no session
                        $checksessionexist = $this->sessionmodel->checksessionexist($user_id);
                        $recordcount  = count($checksessionexist) ?  false : true;



                        //true means no session 
                        if (!$recordcount) {

                            $deletesession =  $this->sessionmodel->deleteSessionUserLogout($user_id);
                            //var_dump($deletesession );

                        } else {

                            $deletesession = true;
                        }


                        if ($deletesession) {


                            $logintime = date('Y-m-d H:i:s');
                            //var_dump(date_default_timezone_get());
                            //var_dump($logintime );

                            $ipaddress = $_SERVER['SERVER_ADDR'];
                            $table_name = 'user_login_session';
                            $records['user_login_id'] = $user_id;
                            $records['session_hashval'] = $sessionid;
                            $records['last_logintime'] = $logintime;
                            $records['ip_address'] = $ipaddress;


                            $update_session = $this->sessionmodel->addUserSession($table_name, $records);

                            if ($update_session) {

                                $_SESSION['user_details']  = array();
                                //username
                                $_SESSION['user_details']['login_names'] =  $userfullname;
                                $user_emailid =  $user_emailid  ? $user_emailid  :   $lusername_id ;
                                //var_dump($user_emailid );

                                if ($user_type == '31') {
                                    // institution incharge login -dot 
                                    
                                    $_SESSION['user_details']['user_id'] =  $user_id;
                                    $_SESSION['user_details']['email_id'] =  $user_emailid;
                                    $_SESSION['user_details']['user_type'] =  $user_type;
                                    $_SESSION['user_details']['contact_person'] =  $contact_person;


                                    $acessarray = json_decode($access_detail);


                                    //var_dump($acessarray->m_institution_type_id);
                                    //exit;
                                    $_SESSION['user_details']['district'] =  $acessarray->m_district_id;
                                    $_SESSION['user_details']['institution_id'] = $acessarray->m_institution_id;
                                    $_SESSION['user_details']['m_institution_type_id'] = $acessarray->m_institution_type_id;

                                } else if ($user_type == '10' || $user_type == '20' || $user_type == '30' || $user_type == '40' || $user_type == '50' || $user_type == '100' ) {
                                    //admin institution login
                                     
                                    
                                    $_SESSION['user_details']['user_id'] =  $user_id;
                                    $_SESSION['user_details']['email_id'] =  $user_emailid;
                                    $_SESSION['user_details']['user_type'] =  $user_type;
                                    $_SESSION['user_details']['contact_person'] =  $contact_person;

                                    $acessarray = json_decode($access_detail);
                                    $_SESSION['user_details']['district'] =  $acessarray->m_district_id;
                                    $_SESSION['user_details']['institution_id'] = $acessarray->m_institution_id;
                                    $_SESSION['user_details']['m_institution_type_id'] = $acessarray->m_institution_type_id;
                                    $_SESSION['user_details']['session_id']  = $sessionid;
                                
								}  else if ($user_type == '1000') {
                                    //supuer login

                                }
								
                            } else {

                                $result['msg'] = 'Unable to update session details.';
                                $result['error_code'] = '400';
                                $result['error_field'] = 'common_errorfield';
                            }
                        } else {

                            $result['msg'] = 'Unable to clear previous session.';
                            $result['error_code'] = '400';
                            $result['error_field'] = 'common_errorfield';
                        }
                    } else {
                        $result['msg'] = 'For user activation. Please contact Administrator.';
                        $result['error_code'] = '400';
                        $result['error_field'] = 'common_errorfield';
                    }
                } else {

                    $user_locked  = $this->checkIncorrectPasswordLimit($usernme, $user_id);

                    if ($user_locked) {

                        $result['msg'] = 'Password is incorrect <br/> Please check.';
                        $result['error_code'] = '400';
                        $result['error_field'] = 'password_errmsg';
                    } else {

                        $result['msg'] = 'User account locked for incorrect password limit exceeded.</br> Try after 10 minutes.';
                        $result['error_code'] = '400';
                        $result['error_field'] = 'password_errmsg';
                    }
                }
            } else if ($no_rows == 0) {

                $result['msg'] = "Username does not exist <br/> Please check";
                $result['error_code'] = '400';
                $result['error_field'] = 'username_errmsg';
            } else if ($no_rows > 1) {

                $result['msg'] = 'Contact Admin. More than one user exist for the username';
                $result['error_code'] = '400';
                $result['error_field'] = 'common_errorfield';
            }
        } //else  of true
        return $result;
    }


    function checkIncorrectPasswordLimit($username, $user_id)
    {

        $result = false;

        //var_dump($inputvalues);
        $loginrecords = $this->login->checkAccountLock($username);
        //var_dump($loginrecords['login_count']);
        $logincounts =   isset($loginrecords['login_count']) ? $loginrecords['login_count']  :  '';
        //var_dump($logincounts);
        if ($logincounts > '3') {

            $result = false;
        } else if ($logincounts <= '3') {


            $clientip = $this->getUserIP() ?  $this->getUserIP()  : '';
            $insertlogin_history = $this->login->insertLoginHistory($username, $user_id, $clientip);
            if ($insertlogin_history) {

                $result = true;
            }
        } 

        return $result;
    }

    function checkValidUser()
    {

        $result['error_msg'] = '';
        $result['error_code'] = 400;
        $result['error_status'] = false;
        
        $username = trim($_POST['user_name']);
        $institution_mobile = trim($_POST['institution_mobile']);
        $usertype = trim($_POST['usertype']);


        if (!$this->emptyCheck($username)) {

            $result['error_msg'] = 'Please enter the registered Email id.';
        } else if (!$this->emptyCheck($institution_mobile)) {

            $result['error_msg'] = 'Please enter the registered mobile no.';
        } else if (!$this->emailValidation($username)) {

            $result['error_msg'] = 'Please enter the registered Email Id.';
        } else if (!$this->mobileValidation($institution_mobile)) {

            $result['error_msg'] = 'Please enter Valid Mobile no.';
        } else if (!$this->master->limitOTPMobile($institution_mobile, '1')) {

            $result['error_msg'] = "OTP Limit Exceeded. Please try after some time.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->emptyCheck($usertype)) {

            $result['error_msg'] = "Unable to fetch user type details.";
            $result['error_code'] = '400';
            $result['error_status'] = false;

        } else {


            $usertype =  base64_decode($usertype);
            //var_dump($usertype);
            $checkemailmobileexist = $this->login->checkRegisteredMailMobile($username, $institution_mobile, $usertype);
            //var_dump($checkemailmobileexist);

            $rows = isset($checkemailmobileexist['no_rows']) ? $checkemailmobileexist['no_rows'] : false;

            //var_dump( $rows);
            if ($rows == 1) {


                $userid = isset($checkemailmobileexist['rows']['user_login_id'])  ? trim($checkemailmobileexist['rows']['user_login_id'])  : false;

                //var_dump($userid);
                $otp = $this->mailer->GenerateOTP();
                $OTP_status = $otp['error_status'];
                $OTP_value = $otp['error_msg'];

                if ($userid) {
                    if ($OTP_status) {


                        $send_otp = $this->api_controller->sendingOTP($institution_mobile, $OTP_value, 'PasswordReset');

                        //$send_otp = true;
                        //var_dump($send_otp);
                        if ($send_otp == true) {

                            $result_modal = $this->registration_modal->InsertOTP($OTP_value, $userid, $institution_mobile, $username);
                            //var_dump($result_modal);
                            if ($result_modal) {


                                $result['error_msg'] = '1';
                                $result['userid'] =  $this->encryptValue($userid);
                                $result['error_code'] = '200';
                                $result['error_status'] = true;
                            } else {

                                $result['error_msg'] = 'Unable to update OTP details.';
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
                    $result['error_msg'] = 'Unable to fetch user details.Please contact Admin.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else if (!$rows) {

                $result['error_msg'] = 'Mobile or Email is not registered with us. Please check the details.';
            } else if ($rows > 1) {

                $result['error_msg'] = 'More users found for the crdentials. Please contact Admin.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }

            //empty rows

        }
        return $result;
    }


    function getDistrictInsitutionId($getids)
    {


        foreach ($getids as $arrayvalue) {

            if (is_array($arrayvalue)) {

                //var_dump($item);
                $institution_names[] =  $arrayvalue;
            } else {

                $dist = $arrayvalue;
            }
        } //foreach ending

        $res['dist'] = $dist;
        $res['insitute_list'] = array_shift($institution_names);

        return $res;
    } //function ends


} 
//class ending
