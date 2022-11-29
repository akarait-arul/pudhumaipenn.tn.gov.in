<?php

ini_set('error_reporting', -1);
//header('Access-Control-Allow-Origin: https://pudhumaipenn.tn.gov.in');
header('Access-Control-Allow-Methods: GET, POST');

include_once('./Controllers/Login.php');
include_once('./Controllers/Registration.php');
include_once('./Controllers/Masters.php');
include_once('./Controllers/InstitutionRegistration.php');
include_once('./Controllers/StudentRegistration.php');
include_once('./Controllers/WelfareController.php');
include_once('./functions/fn_dashboard.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])) {

    switch ($_POST['type']) {

        // New Flow Ajax Starts Here
        case 'filterbyinstitution':

            $param['m_institution_type_id'] = $_POST['m_institution_type_id'];
            $param['m_district_id'] = $_POST['m_district_id'];
            $param['callfor'] = $_POST['callfor'];
            $type = base64_decode($_POST['fil_type']);
            $data_instituion['list'] = GetInstitutionDetailList($param);
            //echo  $type;
            if (trim($type) == 'inst') {
                $data_instituion['count'] = GetInstitutionDetailsCount($param);
            } else if (trim($type) == 'appl') {
                $data_instituion['count'] = GetApplicationInstDetailsCount($param);
            }
            echo json_encode($data_instituion, true);
            break;
        case 'filterbydistrict':
            $param['m_institution_type_id'] = $_POST['m_institution_type_id'];
            $param['m_district_id'] = $_POST['m_district_id'];
            $param['callfor'] = $_POST['callfor'];
            $type = base64_decode($_POST['fil_type']);
            $data_instituion['list'] = GetInstitutionDetailList($param);
            if (trim($type) == 'inst') {
                $data_instituion['count'] = GetDistrictDetailsCount($param);
            } else if (trim($type) == 'appl') {
                $data_instituion['count'] = GetApplicationDistDetailsCount($param);
            }
            echo json_encode($data_instituion, true);
            break;

        case 'StudentLogin':
            $obj_login = new Login();
            $method_login = $obj_login->StudentLogin();
            echo json_encode($method_login);
            break;

        case 'SubmitStudentOTP':
            $obj_login = new Login();
            $method_submitotp = $obj_login->SubmitStudentOTP();
            echo json_encode($method_submitotp);
            break;

        case 'UpdateStudentBankDetails':
            $obj_registration = new StudentRegistration();
            $method_get_emis = $obj_registration->UpdateStudentBankDetails();
            echo json_encode($method_get_emis);
            break;

        case 'GetStudentEMIS':
            $obj_registration = new StudentRegistration();
            $method_get_emis = $obj_registration->GetStudentEMIS();
            echo json_encode($method_get_emis);
            break;

        case 'GetStudentProfile':
            $obj_registration = new StudentRegistration();
            $method_get_student_profile = $obj_registration->GetStudentProfile();
            echo json_encode($method_get_student_profile);
            break;

        case 'GetCommunity':
            $obj_masters = new Masters();
            $method_community_masters = $obj_masters->GetCommunity();
            echo json_encode($method_community_masters);
            break;

        case 'GetAadhaarDetails':
            $obj_registration = new StudentRegistration();
            $method_get_aadhaardetails = $obj_registration->GetAadhaarDetails();
            echo json_encode($method_get_aadhaardetails);
            break;

        case 'GetBankDetails':
            $obj_registration = new StudentRegistration();
            $method_get_bankdetails = $obj_registration->ValidateNPCI();
            echo json_encode($method_get_bankdetails, true);
            break;

        ###### degree and subject

        case 'GetAvailableDegreeSubject':
            $obj_registration = new Masters();
            $method_get_degree = $obj_registration->GetAvailableDegreeSubject();
            echo json_encode($method_get_degree, JSON_FORCE_OBJECT);
            break;

        case 'GetSubjectByInstitution':
            $obj_registration = new Masters();
            $method_get_degree = $obj_registration->GetSubjectByInstitution();
            echo json_encode($method_get_degree, JSON_FORCE_OBJECT);
            break;

        ########

        case 'ValidateInstitutionDetails':
            $obj_registration = new StudentRegistration();
            $method_get_emis = $obj_registration->ValidateInstitutionDetails();
            echo json_encode($method_get_emis);
            break;

        // New Flow Ajax Ends Here

        case 'GetReason':
            $obj_masters = new Masters();
            $method_reason_masters = $obj_masters->GetReason();
            echo json_encode($method_reason_masters);
            break;

        case 'Yearofstudy':
            $obj_masters = new Masters();
            $method_year_masters = $obj_masters->Yearofstudy();
            echo json_encode($method_year_masters);
            break;

        case 'SchoolYear':
            $obj_masters = new Masters();
            $method_year_masters = $obj_masters->SchoolYear();
            echo json_encode($method_year_masters);
            break;

        case 'ValidateAadhaarDetails':
            $obj_registration = new StudentRegistration();
            $method_community_masters = $obj_registration->ValidateAadhaarDetails();
            echo json_encode($method_community_masters);
            break;

        case 'GetCommunity':
            $obj_masters = new Masters();
            $method_community_masters = $obj_masters->GetCommunity();
            echo json_encode($method_community_masters);
            break;

        case 'GetReligion':
            $obj_masters = new Masters();
            $method_religion_masters = $obj_masters->GetReligion();
            echo json_encode($method_religion_masters);
            break;

        case 'YearOfCompletion':
            $obj_masters = new Masters();
            $method_year_of_completion_masters = $obj_masters->YearOfCompletion();
            echo json_encode($method_year_of_completion_masters);
            break;

        case 'YearOfSchoolCompletion':
            $obj_masters = new Masters();
            $method_year_of_completion_masters = $obj_masters->YearOfSchoolCompletion();
            echo json_encode($method_year_of_completion_masters);
            break;

        case 'AcademicYear':
            $obj_masters = new Masters();
            $method_academic_masters = $obj_masters->AcademicYear();
            echo json_encode($method_academic_masters);
            break;

        case 'GetDistrict':
            $obj_masters = new Masters();
            $method_dist_masters = $obj_masters->GetDistrict();
            echo json_encode($method_dist_masters);
            break;

        case 'GetDistrictFromSchoolMaster':
            $obj_masters = new Masters();
            $method_dist_masters = $obj_masters->GetDistrictFromSchoolMaster();
            echo json_encode($method_dist_masters);
            break;

        case 'GetDistrictSchoolFromSchoolMaster':
            $obj_masters = new Masters();
            $method_dist_masters = $obj_masters->GetDistrictSchoolFromSchoolMaster();
            echo json_encode($method_dist_masters);
            break;

        case 'GetInstitutions':
            $obj_masters = new Masters();
            $method_institution = $obj_masters->GetInstitutions();
            echo json_encode($method_institution);
            break;

        case 'getInstitutionbyusertype':
            $obj_masters = new Masters();
            $method_institution = $obj_masters->getInstitutionbyusertype();
            echo json_encode($method_institution);
            break;

        case 'InstitutionRegister':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->InstitutionRegister();
            echo json_encode($method_institution);
            break;

        case 'InstitutionRegisterByHOD':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->InstitutionRegister();
            echo json_encode($method_institution);
            break;

        case 'SubmitInstitutionOTP':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->SubmitInstitutionOTP();
            echo json_encode($method_institution);
            break;

        case 'InstitutionRegisterList':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->InstitutionRegisterList();
            echo json_encode($method_institution);
            break;

        case 'instituteRegisterListDot':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->instituteRegisterListDot();
            echo json_encode($method_institution);
            break;

        case 'registeredInstituteListdot':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->registeredInstituteListdot();
            echo json_encode($method_institution);
            break;

        case 'verifyInstitution':
            $obj_registration = new InstitutionRegistration();
            $method_institution = $obj_registration->verifyInstitution();
            echo json_encode($method_institution);
            break;

        case 'UserLogin':
            $obj_login = new Login();
            $method_user_login = $obj_login->UserLogin();
            echo json_encode($method_user_login);
            break;

        case 'SubmitStudentRegistration':
            $obj_registration = new StudentRegistration();
            $method_student_registration = $obj_registration->SubmitStudentRegistration();
            echo json_encode($method_student_registration);
            break;

        case 'ResendOTP':
            $obj_registration = new StudentRegistration();
            $method_student_registration = $obj_registration->ResendOTP();
            echo json_encode($method_student_registration);
            break;

        case 'CheckStudentSession':
            $obj_registration = new StudentRegistration();
            $method_student_registration = $obj_registration->CheckStudentSession();
            echo json_encode($method_student_registration);
            break;

        case 'CheckStudentInstituionSession':
            $obj_registration = new StudentRegistration();
            $method_student_registration = $obj_registration->CheckStudentInstituionSession();
            echo json_encode($method_student_registration);
            break;

        case 'CheckStudentDetailsSession':
            $obj_registration = new StudentRegistration();
            $method_student_registration = $obj_registration->CheckStudentDetailsSession();
            echo json_encode($method_student_registration);
            break;

        case 'SubmitOTP':
            $obj_registration = new StudentRegistration();
            $method_otp_submit = $obj_registration->submitOTP();
            echo json_encode($method_otp_submit);
            break;

        case 'SubmitStudentSchoolDetails':
            $obj_registration = new StudentRegistration();
            $method_otp_submit = $obj_registration->SubmitStudentSchoolDetails();
            echo json_encode($method_otp_submit);
            break;

        case 'GetDegree':
            $obj_registration = new Registration();
            $method_get_degree = $obj_registration->getDegree();
            echo json_encode($method_get_degree);
            break;

        case 'GetSubject':
            $obj_registration = new Registration();
            $method_get_subject = $obj_registration->getSubject();
            echo json_encode($method_get_subject);
            break;

        case 'GetEMIS':
            $obj_registration = new StudentRegistration();
            $method_get_emis = $obj_registration->getEMIS();
            echo json_encode($method_get_emis);
            break;

        case 'SubmitStudentDetails':
            $obj_registration = new StudentRegistration();
            $method_get_emis = $obj_registration->SubmitStudentDetails();
            echo json_encode($method_get_emis);
            break;

        case 'GetAadhaarDetails':
            $obj_registration = new StudentRegistration();
            $method_get_aadhaardetails = $obj_registration->GetAadhaarDetails();
            echo json_encode($method_get_aadhaardetails);
            break;

        case 'submitApplication':
            $obj_registration = new StudentRegistration();
            $method_submit_application = $obj_registration->submitApplication();
            echo json_encode($method_submit_application);
            break;

        case 'studentRegisterList':
            $obj_registration = new StudentRegistration();
            $method_student_register_list = $obj_registration->studentRegisterList();
            echo json_encode($method_student_register_list);
            break;

        case 'WelfarestudentRegisterList':
            $obj_registration = new StudentRegistration();
            $method_student_register_list = $obj_registration->WelfarestudentRegisterList();
            echo json_encode($method_student_register_list, true);
            break;

        case 'getFilledDetails':
            $obj_registration = new Registration();
            $method_getdetails = $obj_registration->getFilledDetails();
            echo json_encode($method_getdetails);
            break;

        case 'getSearchEmisDetails':
            $obj_masters = new Masters();
            $method_api = $obj_masters->getSearchEmisDetails();
            echo json_encode($method_api);
            break;

        case 'GetSchoolDistrictList':
            $obj_masters = new Masters();
            $method_dist_mastersschool = $obj_masters->GetSchoolDistrictList();
            echo json_encode($method_dist_mastersschool);
            break;

        case 'GetSchoolBlock':
            $obj_masters = new Masters();
            $method_block = $obj_masters->GetSchoolBlock();
            echo json_encode($method_block);
            break;

        case 'getSchoolNames':
            $obj_masters = new Masters();
            $method_schoolname = $obj_masters->getSchoolNames();
            echo json_encode($method_schoolname);
            break;

        case 'GetInsitutionType':
            $obj_masters = new Masters();
            $method_institutiontype = $obj_masters->GetInsitutionType();
            echo json_encode($method_institutiontype);
            break;

        case 'CourseMapping':
            $obj_masters = new Masters();
            $method_coursemapping = $obj_masters->CourseMapping();
            echo json_encode($method_coursemapping);
            break;

        case 'getDegreeListByDot':
            $obj_masters = new Masters();
            $method_dotdegreelist = $obj_masters->getDegreeListByDot();
            echo json_encode($method_dotdegreelist);
            break;

        case 'GetDegreeWiseSubject':
            $obj_masters = new Masters();
            $method_degreewisesubject = $obj_masters->getDegreeWiseSubject();
            echo json_encode($method_degreewisesubject);
            break;

        case 'getInsituteWiseSubject':
            $obj_masters = new Masters();
            $method_institutesubject = $obj_masters->getInsituteWiseSubject();
            echo json_encode($method_institutesubject);
            break;

        case 'checkFirstTimeLogin':
            $obj_registration = new InstitutionRegistration();
            $method_checkFirstTimeLogin = $obj_registration->checkFirstTimeLogin();
            echo json_encode($method_checkFirstTimeLogin);
            break;

        case 'checkInstitutionEmailExist':
            $obj_registration_insti = new InstitutionRegistration();
            $method_emailcheck_institution = $obj_registration_insti->checkInstitutionEmailExist();
            echo json_encode($method_emailcheck_institution);
            break;

        case 'checkInstitutionmobileExist':
            $obj_registration_insti = new InstitutionRegistration();
            $method_mobilecheck_institution = $obj_registration_insti->checkInstitutionmobileExist();
            echo json_encode($method_mobilecheck_institution);
            break;

        case 'newinstitutiondetailsupdate':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institution_newpassword = $obj_registration_insti->newInstitutionPassword();
            echo json_encode($method_institution_newpassword);
            break;

        case 'sendOTPemailinstitute':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutionsendemailOTP = $obj_registration_insti->sendOTPemailinstitute();
            echo json_encode($method_institutionsendemailOTP);
            break;

        case 'checkOTPemailinstitute':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutioncheckemailOTP = $obj_registration_insti->checkOTPemailinstitute();
            echo json_encode($method_institutioncheckemailOTP);
            break;

        case 'sendOTPmobileinstitute':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutionsendOTP = $obj_registration_insti->sendOTPmobileinstitute();
            echo json_encode($method_institutionsendOTP);
            break;

        case 'checkOTPmobileinstitute':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutioncheckmobileOTP = $obj_registration_insti->checkOTPmobileinstitute();
            echo json_encode($method_institutioncheckmobileOTP);
            break;

        case 'insertNewInstitutionbydot':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutionNewAdd = $obj_registration_insti->insertNewInstitutionbydot();
            echo json_encode($method_institutionNewAdd);
            break;

        case 'getWelfareStudentListByType':
            $obj_welfareobject = new WelfareController();
            $method_welfareobj = $obj_welfareobject->getWelfareStudentListByType();
            echo json_encode($method_welfareobj);
            break;

        case 'GetWelfareInstitutionTypeByDistrictID':
            $obj_welfareobject = new WelfareController();
            $method_welfareinstitype = $obj_welfareobject->GetWelfareInstitutionTypeByDistrictID();
            echo json_encode($method_welfareinstitype);
            break;

        case 'GetWelfareInstitutionByDistrictID':
            $obj_welfareobject = new WelfareController();
            $method_welfareinstitution = $obj_welfareobject->GetWelfareInstitutionByDistrictID();
            echo json_encode($method_welfareinstitution);
            break;

        case 'accept_student':
            $obj_welfareobject = new WelfareController();
            $method_welfareaccept = $obj_welfareobject->acceptStudent();
            echo json_encode($method_welfareaccept);
            break;

        case 'reject_student':
            $obj_welfareobject = new WelfareController();
            $method_welfarereject = $obj_welfareobject->rejectStudent();
            echo json_encode($method_welfarereject);
            break;

        case 'getRejectResonsList':
            $obj_welfareobject = new WelfareController();
            $method_welfarerejectreason = $obj_welfareobject->getRejectResonsList();
            echo json_encode($method_welfarerejectreason);
            break;

        case 'acceptAllStudents':
            $obj_welfareobject = new WelfareController();
            $method_welfareacceptall = $obj_welfareobject->acceptAllStudents();
            echo json_encode($method_welfareacceptall);
            break;

        case 'getWelfareCourseList':
            $obj_welfareobject = new WelfareController();
            $method_welfarecourselist = $obj_welfareobject->getWelfareCourseList();
            echo json_encode($method_welfarecourselist);
            break;

        case 'getWelfareSubjectList':
            $obj_welfareobject = new WelfareController();
            $method_welfaresubjectlist = $obj_welfareobject->getWelfareSubjectList();
            echo json_encode($method_welfaresubjectlist);
            break;

        case 'getFilteredStudentsResulst':
            $obj_welfareobject = new WelfareController();
            $method_welfarefilterstudentslist = $obj_welfareobject->getFilteredStudentsResulst();
            echo json_encode($method_welfarefilterstudentslist);
            break;
        case 'getAvailableSubjects':
            $obj_masterobject = new Masters();
            $method_mastercoursemapping = $obj_masterobject->getAvailableSubjects();
            echo json_encode($method_mastercoursemapping);
            break;

        case 'checkValidUser':
            $obj_login = new Login();
            $method_checkvaliduser = $obj_login->checkValidUser();
            echo json_encode($method_checkvaliduser);
            break;

        case 'VerifyOTPmobile':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutioncheckmobileOTP = $obj_registration_insti->VerifyOTPmobile();
            echo json_encode($method_institutioncheckmobileOTP);
            break;

        case 'passwordresetuser':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institutioncheckmobileOTP = $obj_registration_insti->VerifyOTPmobile();
            echo json_encode($method_institutioncheckmobileOTP);
            break;

        case 'newpasswordupdate':
            $obj_registration_insti = new InstitutionRegistration();
            $method_institution_newpassword = $obj_registration_insti->newPasswordUpdation();
            echo json_encode($method_institution_newpassword);
            break;

        case 'getUserDetails':
            $obj_masters = new Masters();
            $method_userdetails = $obj_masters->getUserDetails();
            echo json_encode($method_userdetails);
            break;

        // Added By Arul 22-11-2022 For Bank Status Update Starts Here

        case 'getBankDistrict':
            $obj_masters = new Masters();
            $result_dist = $obj_masters->GetDistrict();
            echo json_encode($result_dist);
            break;

        case 'getBank':
            $obj_masters = new Masters();
            $result_bank = $obj_masters->getBank();
            echo json_encode($result_bank);
            break;

        case 'getBranch':
            $obj_masters = new Masters();
            $result_branch = $obj_masters->getBranch();
            echo json_encode($result_branch);
            break;

        case 'getBranchDetails':
            $obj_masters = new Masters();
            $result_branch = $obj_masters->getBranchDetails();
            echo json_encode($result_branch);
            break;

        case 'VerifyBankDetails':
            $obj_masters = new Masters();
            $result_branch = $obj_masters->VerifyBankDetails();
            echo json_encode($result_branch);
            break;

        // Added By Arul 22-11-2022 For Bank Status Update Ends Here
        // Added By Arul 25-11-2022
        case 'DeleteTempAadhar':
            $obj_registration = new StudentRegistration();
            $method_tempdelete = $obj_registration->DeleteTempAadhar();
            echo json_encode($method_tempdelete);
            break;

        // Added By Arul 27-11-2022
        case 'GetApplCountDistrictBarChart':
            $param = [];
            $param['user_id'] = trim($_POST['user_id']);
            $param['callfor'] = trim($_POST['callfor']);
            $param['order_by'] = trim($_POST['order_by']);

            $call_func = getdbAllbarByDistrict($param);

            echo json_encode($call_func);
            break;

        case 'GetApplCountInstBarChart':
            $param = [];
            $param['user_id'] = trim($_POST['user_id']);
            $param['callfor'] = trim($_POST['callfor']);
            $param['order_by'] = trim($_POST['order_by']);

            $call_func = getdbAllbarByInsType($param);

            echo json_encode($call_func);
            break;

        default:
            $result['error_msg'] = 'Invalid Authentication Please Contact Admin !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
            echo json_encode($result);
            break;
    }
} else {
    $result['error_msg'] = 'Unauthorized : Access is denided';
    echo json_encode($result);
}
