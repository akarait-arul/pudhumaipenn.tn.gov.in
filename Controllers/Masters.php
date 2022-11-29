<?php

include_once("./Models/MasterModel.php");
include_once("./classes/validation.php");
include_once("./Controllers/APIController.php");
include_once("./Models/RegistrationModel.php");

class Masters extends validation {

    function __construct() {

        $this->validation = new validation();
        $this->master_modal = new MasterModel();
        $this->registration_modal = new RegistrationModel();
        $this->api_controller = new APIController();
    }

    ############

    public function GetAvailableDegreeSubject() {

        $result = [];
        if (isset($_POST['institution_id'])) {

            $result_modal = $this->master_modal->GetAvailableDegreeSubject($_POST['institution_id']);
            $degree = isset($result_modal['available_degree_subject']) ? json_decode($result_modal['available_degree_subject'], TRUE) : '';
            if (!$degree) {
                $degree = array();
            }
            //echo $result_modal['available_degree_subject'];
            //exit;
            if (count($degree) != 0) {

                //$data = json_decode($degree, TRUE);
                $data_degree = (array_keys($degree));
                //print_r($data_degree);
                $result_modal_degree = $this->master_modal->GetDegreeByID($data_degree);
                if ($result_modal_degree != '' && $result_modal_degree != 0 && count($result_modal_degree) > 0) {

                    $result['error_msg'] = $result_modal_degree;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Records Not Found!!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {


                $result_modal_degree = $this->master_modal->mDegree($_POST['m_institution_type_id']);
                if ($result_modal_degree != '' && $result_modal_degree != 0 && count($result_modal_degree) > 0) {

                    $result['error_msg'] = $result_modal_degree;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Records Not Found!!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            }
        } else {

            $result['error_msg'] = 'Invalid Institution ID !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetSubjectByInstitution() {

        $result = [];
        if (isset($_POST['m_institution_id']) && isset($_POST['degree'])) {

            $result_modal = $this->master_modal->GetAvailableDegreeSubject($_POST['m_institution_id']);
            //print_r($result_modal);
            $data = isset($result_modal['available_degree_subject']) ? json_decode($result_modal['available_degree_subject'], TRUE) : '';
            //print_r($data);
            if (!$data) {
                $data = array();
            }

            if ($data != null && $data != '' && $data != 0 && $data != 'null' && $data != 'NULL') {

                //$data = json_decode($degree, TRUE);
                //print_r($data);
                //echo $_POST['degree'];
                $data_degree = array_values($data[$_POST['degree']]);
                $result_modal_degree = $this->master_modal->GetInstitutionSubjectByID($data_degree);

                if ($result_modal_degree != '' && $result_modal_degree != 0 && count($result_modal_degree) > 0) {

                    $result['error_msg'] = $result_modal_degree;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Records Not Found!!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result_modal_subject = $this->master_modal->mDegreeSubject($_POST['degree']);

                if ($result_modal_subject != '' && $result_modal_subject != 0 && count($result_modal_subject) > 0) {

                    $result['error_msg'] = $result_modal_subject;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Records Not Found!!!';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            }
        } else {

            $result['error_msg'] = 'Invalid Institution ID !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    ############

    // Function Get Year Of Completion
    public function GetCommunity() {

        $result_community = $this->master_modal->mCommunity($_POST['religion']);
        if ($result_community) {

            $result['error_msg'] = $result_community;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch Community !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetReason() {

        $result_year = $this->master_modal->GetReason($_POST['reason_flag']);
        //var_dump($result_year);
        if ($result_year) {

            $result['error_msg'] = $result_year;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function Yearofstudy() {

        $result_year = $this->master_modal->mYearofStudy($_POST['subject']);
        if ($result_year) {

            $result['error_msg'] = $result_year[0]['year_of_study'];
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Academic Year
    public function SchoolYear() {

        $result_year = $this->master_modal->mSchoolYear($_POST['last_school_year']);
        if ($result_year) {

            $result['error_msg'] = $result_year;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Year Of Completion
    public function GetReligion() {

        $result_district = $this->master_modal->mReligion();
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Year Of Completion
    public function YearOfCompletion() {
        $current_year = date('Y');
        $result_district = $this->master_modal->mYearOfCompletion($current_year);
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Year Of Completion
    public function YearOfSchoolCompletion() {
        //echo $_POST['school_completion_on'];
        $result_district = $this->master_modal->mYearOfSchoolCompletion($_POST['school_completion_on']);
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Get School Year COmpletion';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get Academic Year
    public function AcademicYear() {

        $result_year = $this->master_modal->mAcademicYear($_POST['school_completion_on']);
        if ($result_year) {

            $result['error_msg'] = $result_year;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetDistrict() {

        $result_district = $this->master_modal->mDistrict();
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetInstitutions() {


        $district = $_POST['district'];
        $optionhtml_template = isset($_POST['optionhtml_template']) ? trim($_POST['optionhtml_template']) : '';

        $validate_district = $this->validation->emptyCheck($district);
        $user_type = isset($_SESSION['user_details']['user_type']) ? trim($_SESSION['user_details']['user_type']) : '';

        if ($validate_district == true) {

            $result_institution = $this->master_modal->mInstitution($district);

            //var_dump($result_institution);
            if ($result_institution) {


                if ($optionhtml_template) {
                    $respone_data = '';
                    foreach ($result_institution as $rows) {

                        $respone_data .= '<option value="' . $rows['m_institution_id'] . '">' . $rows['institution_name'] . '</option>';
                    }
                } else {

                    $respone_data = $result_institution;
                }

                $result['error_msg'] = $respone_data;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on Fetch Institution Details. Try again later.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid District Code Please Check the district.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function getInstitutionbyusertype() {


        $district = $_POST['district'];
        $optionhtml_template = isset($_POST['optionhtml_template']) ? trim($_POST['optionhtml_template']) : '';

        $validate_district = $this->validation->emptyCheck($district);
        $m_institution_type_id = is_array($_SESSION['user_details']['m_institution_type_id']) ? trim($_SESSION['user_details']['m_institution_type_id'][0]) : '';

        $respone_data = '';
        if ($validate_district == true) {

            //var_dump($district);
            if ($district == 'all') {

                $result_institution = $this->master_modal->mInstitution($district);
            } else {
                $result_institution = $this->master_modal->getInsituteWiseSubject($district);
            }


            //var_dump($result_institution);
            if ($result_institution) {

                if ($optionhtml_template) {

                    if ($district == 'all') {
                        foreach ($result_institution as $rows) {

                            $respone_data .= '<option value="' . $rows['m_institution_id'] . '">' . $rows['institution_name'] . '</option>';
                        }
                    } else {
                        $respone_data = '<option value="' . $result_institution['m_institution_id'] . '">' . $result_institution['institution_name'] . '</option>';
                    }
                } else {

                    $respone_data = $result_institution;
                }

                $result['error_msg'] = $respone_data;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on Fetch Institution Details. Try again later.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid District Code Please Check the district.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    //get institution type based on input
    public function GetInsitutionType() {

        $result['error_msg'] = '';
        $result['error_code'] = '';
        $result['error_status'] = '';

        $institution_id = $_POST['institution_id'];
        $optionhtml_template = isset($_POST['optionhtml_template']) ? trim($_POST['optionhtml_template']) : '';

        //var_dump($institution_id);
        //if(is_array($institution_id)){
        if ($institution_id != 'all') {

            //array code needs to be written
            //$institution_ids = implode(',',$institution_id);
            //var_dump($institution_ids);
            $result_institutiontype = $this->master_modal->mInstitutionType($institution_id);

            if ($optionhtml_template) {
                $respone_data = '';

                foreach ($result_institutiontype as $rows) {

                    $respone_data .= '<option value="' . $rows['m_institution_type_id'] . '">' . $rows['institution_type'] . '</option>';
                }

                //var_dump($respone_data);
            } else {

                $respone_data = $result_institutiontype;
            }

            //var_dump($respone_data);
            $result['error_msg'] = $respone_data;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else if ($institution_id == 'all') {


            $institn_id = '';

            $result_institutiontype = $this->master_modal->mInstitutionType($institn_id);

            if ($result_institutiontype) {

                $result['error_msg'] = $result_institutiontype;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on Fetch Institution Type.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Invalid Institution Code Please Check Inputs !!!';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }



        return $result;
    }

    //get institution type based on input


    public function getUsertTypes() {

        $result_usertypes = $this->master_modal->mUserTypesList();
        if (count($result_usertypes)) {

            $usertype = '<option value=""> select the user type  </option>';
            foreach ($result_usertypes as $user_row) {

                $muser_code = trim($user_row['m_user_type_id']) ? trim($user_row['m_user_type_id']) : '';

                if (isset($user_row['m_user_type_id'])) {





                    $usertype .= '<option  value="' . $muser_code . '"> ' . $user_row['user_type'] . ' </option>';
                }
            }


            if ($usertype != '<option> select the user type  </option>') {

                $result['error_msg'] = $usertype;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Unable to fetch User Type. Please try again later.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Unable to fetch User Type. Please try again later.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }




        //$result = $result_district;

        return $result;
    }

    // Function Get School Master Distrinct Of School Master Table
    public function GetDistrictFromSchoolMaster() {

        $result_district = $this->master_modal->mDistrictSchool();
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    // Function Get District School Master Distrinct Of School Master Table
    public function GetDistrictSchoolFromSchoolMaster() {

        $district = trim($_POST['district']);
        $result_district = $this->master_modal->mSchoolDistrictSchool($district);
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetSchoolDistrictList() {

        $result_district = $this->master_modal->GetSchoolDistrictList();
        //var_dump($result_district);
        if ($result_district) {

            $result['error_msg'] = $result_district;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function GetSchoolBlock() {

        $district_name = trim($_POST['district_name']);

        $result_block = $this->master_modal->GetSchoolBlock($district_name);
        //var_dump($result_district);
        if ($result_block) {

            $result['error_msg'] = $result_block;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch District Masters !!!';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function getSchoolNames() {


        $type = trim($_POST['recordtype']);

        if ($type == 1) {
            //district
            $block_names = trim($_POST['block_name']);
        } else {
            // block
            $block_names = trim($_POST['block_name']);
        }

        //var_dump($block_names);
        $result_block = $this->master_modal->getSchoolNames($block_names, $type);
        //var_dump($result_district);
        if ($result_block) {

            $result['error_msg'] = $result_block;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on Fetch School names';
            $result['error_code'] = '405';
            $result['error_status'] = false;
        }

        return $result;
    }

    public function getSearchEmisDetails() {


        $aadharno = $_POST['aadharcard'];
        $student_name = $_POST['student_name'];
        $student_dob = $_POST['student_dob'];
        $stud_dob = implode("-", array_reverse(explode("-", $student_dob)));
        $school_id = $_POST['school_id'];
        $user_type = isset($_POST['user_type']) ? 1 : 0;

        //var_dump( $user_type); 
        if (!$this->validation->emptyCheck($school_id)) {

            $result['error_msg'] = 'School field is mandatory.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else if (!$this->validation->emptyCheck($stud_dob)) {

            $result['error_msg'] = 'Student DOB is mandatory.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        } else {

            $user_dob = strtotime($stud_dob);
            $student_dob = date("d-m-Y", $user_dob);

            if ($aadharno) {
                if (!$this->validation->aadhaarValidation($aadharno)) {

                    $result['error_msg'] = 'aadhaar card should be 12 digits.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                } else {

                    $result = $this->api_controller->getSearchEmisDetails($aadharno, $student_name, $student_dob, $school_id, $user_type);
                }
            } else {

                $result = $this->api_controller->getSearchEmisDetails($aadharno, $student_name, $student_dob, $school_id, $user_type);
            }
        }

        return $result;
    }

    public function getDegreeListByDot() {


        $result = [];
        //getting hod session institute type
        $insti_type_logged = is_array($_SESSION['user_details']['m_institution_type_id']) ? trim($_SESSION['user_details']['m_institution_type_id'][0]) : $_SESSION['user_details']['m_institution_type_id'];

        if ($insti_type_logged) {

            //institution id or  institution type id
            $institution_type_id = trim($_POST['institution_id']);
            //var_dump($institution_type_id);
            if ($insti_type_logged == 'all') {

                $getinstitutiondetails = $this->master_modal->institutionDetailsById($institution_type_id);
                $institution_type_id = $getinstitutiondetails['m_institution_type_id'];
            }

            if ($institution_type_id) {

                $result_modal = $this->master_modal->mDegree($institution_type_id);

                if ($result_modal != '' && $result_modal != 0 && count($result_modal) > 0) {

                    $result['error_msg'] = $result_modal;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Records Not Found ';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Invalid Institution ID  ';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['error_msg'] = 'Unable to fetch user details. Please try again later.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }


        return $result;
    }

    public function CourseMapping() {

        $result = [];

        $insti_type_logged = is_array($_SESSION['user_details']['m_institution_type_id']) ? trim($_SESSION['user_details']['m_institution_type_id'][0]) : '';

        $institute_type_id = trim($_POST['institution_type_id']);
        $institutionid = trim($_POST['m_institution_id']);
        $subjects = $_POST['subject'];
        $degreeid = trim($_POST['degree_id']);

        if (!$this->validation->emptyCheck($institute_type_id)) {

            $result['msg'] = 'Please select Institution type';
            $result['error_code'] = '400';
            $result['error_status'] = false;
            $result['error_field'] = 'institute_type_err';
        } else if ($insti_type_logged != $institute_type_id) {
            //Course Mapping sent from differnt Institution Type. Please logout and login again.
            $result['msg'] = 'Unable to map the courses to the Institution';
            $result['error_code'] = '400';
            $result['error_status'] = false;
            $result['error_field'] = 'common_err';
        } else if (!$this->validation->emptyCheck($institutionid)) {

            $result['msg'] = 'Please select Institution name';
            $result['error_code'] = '400';
            $result['error_status'] = false;
            $result['error_field'] = 'institution_err';
        } else {

            //$subject_codes  = implode(',', $subjects);
            $institution_details = $this->master_modal->institutionDetailsById($institutionid);
            if ($institution_details) {

                $subj_degree = $institution_details['available_degree_subject'];
                $conv_degreesubject = json_decode($subj_degree, true);
                $degreeexist = false;
                if (!is_null($conv_degreesubject)) {
                    $degreeexist = array_key_exists($degreeid, $conv_degreesubject);
                }



                //var_dump($conv_degreesubject);
                $subcount = $subjects ? count($subjects) : 0;
                if ($degreeexist) {

                    if ($subcount) {
                        $conv_degreesubject[$degreeid] = $subjects;
                    } else {

                        unset($conv_degreesubject[$degreeid]);
                    }
                } else {


                    if ($subcount) {

                        $conv_degreesubject[$degreeid] = $subjects;
                    }
                }

                //var_dump($conv_degreesubject);
                ksort($conv_degreesubject);

                $subjects_degress_json = json_encode($conv_degreesubject);
                $table_name = 'm_institution';
                $update_coursemapping = $this->master_modal->updateCourseMapping($institutionid, $table_name, $subjects_degress_json);
                if ($update_coursemapping) {

                    $result['msg'] = "Courses are mapped successfully to the Instiitution";
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {
                    //Unable to process course mapping. Try again later.
                    $result['msg'] = "Unable to map the course to the Institution. Please try again later. ";
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                    $result['error_field'] = 'common_err';
                }
            } else {

                $result['msg'] = "Unable to map the course to the Institution. Please try again later. ";
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }

//course mapping
    //get all subjects list
    public function getAvailableSubjects() {

        $result['error_msg'] = ' ';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $institutionid = trim($_POST['instituteid']);

        $degree_subject_list = '';
        if ($institutionid) {
            if ($this->validation->emptyCheck($institutionid)) {

                $institution_details = $this->master_modal->institutionDetailsById($institutionid);
                //$institution_details = $this->master_modal->institutionDetailsById('512');
                //var_dump($institution_details);
                if ($institution_details) {

                    $getdegreesubjects = $institution_details['available_degree_subject'];

                    $converteddegreesubjects = json_decode($getdegreesubjects, true);

                    $total_degree = $converteddegreesubjects ? count($converteddegreesubjects) : '';

                    if ($total_degree) {

                        $serialno = 1;
                        //foreach degree subject from db
                        foreach ($converteddegreesubjects as $degreeid => $subjects) {

                            $degree_subject_list .= '<tr>';
                            $degree_subject_list .= '<td>' . $serialno . '</td>';
                            $degree_id = array($degreeid);

                            $degree_rows = $this->master_modal->GetDegreeByID($degree_id);
                            //var_dump($degree_rows);
                            $degree_id = '';
                            $degree_list = $degree_rows ? count($degree_rows) : '0';
                            if ($degree_list) {

                                $degreename = isset($degree_rows[0]['degree']) ? trim($degree_rows[0]['degree']) : '';
                                $degree_subject_list .= '<td>' . $degreename . '</td>';

                                $degree_subject_list .= '<td>';
                                //var_dump($subjects);

                                foreach ((array) $subjects as $subjecodes) {
                                    // var_dump($subjecodes);
                                    $subjeccod = array($subjecodes);
                                    $subject_rows = $this->master_modal->GetInstitutionSubjectByID($subjeccod);
                                    //var_dump($subject_rows);
                                    $subject_count = $subject_rows ? count($subject_rows) : '0';
                                    if ($subject_count) {

                                        $subjectname = isset($subject_rows[0]['subject']) ? trim($subject_rows[0]['subject']) : '';
                                        $yearofstudy = isset($subject_rows[0]['year_of_study']) ? trim($subject_rows[0]['year_of_study']) : '';

                                        $degree_subject_list .= '* ' . trim($subjectname) . ' ( ' . $yearofstudy . ' years )' . '<br>';
                                    } //subject count
                                    $subjeccod = '';
                                } //foreach subjec count 



                                $degree_subject_list .= '</td>';
                            } //degree count empty
                            //var_dump($degree_subject_list);


                            if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] != 31) {


                                $degree_subject_list .= '<td> <button class="btn btn-success mb-2 "  onclick="getSubject(' . "'" . $degreeid . "'" . ')"     > <i class="fas fa-edit"></i></button>  </td>';
                                $degree_subject_list .= '</tr>';
                            } else {

                                $degree_subject_list .= '</tr>';
                            }
                            $serialno++;
                        } //foreach degree subject from db

                        $result['error_msg'] = $degree_subject_list;
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    } else {

                        $result['error_msg'] = '<tr > <td colspan="5">  no records </td> </tr>';
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    }
                } else {

                    $result['error_msg'] = 'Unable to get institution details. Please contact admin.';
                    $result['error_code'] = '400';
                    $result['error_status'] = false;
                }
            } else {

                $result['error_msg'] = 'Institution type is emtpy.';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        } else {

            $result['msg'] = "Institution is not selected. Plese try again later.";
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }



        return $result;
    }

    //get all subjects
    //getting degree wise subject for select2 box for old course mapping
    public function getDegreeWiseSubject() {

        $result = [];

        $degree_subject_list = '';

        $institution_type_id = trim($_POST['institution_type_id']);

        if ($this->validation->emptyCheck($institution_type_id)) {

            $degree_list = $this->master_modal->mDegree($institution_type_id);

            if (count($degree_list)) {

                foreach ($degree_list as $degree) {

                    if (count($degree)) {

                        $degree_subject_list .= '<optgroup label="' . $degree['degree'] . '">';
                        $degree_code = $degree['m_degree_id'] ? trim($degree['m_degree_id']) : '';
                        if ($degree_code) {

                            $degree_subject = $this->master_modal->mDegreeSubject($degree_code);
                            foreach ($degree_subject as $degree_subject) {

                                $degree_subject_list .= '<option value="' . trim($degree_subject['m_subject_id']) . '">' . trim($degree_subject['subject']) . '</option>';
                            }
                        }
                        $degree_subject_list .= ' </optgroup>';
                    }
                } //foreach

                if ($degree_subject_list) {

                    $result['error_msg'] = $degree_subject_list;
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
        } else {

            $result['error_msg'] = 'Institution type is emtpy.';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }
        return $result;
    }

    //getting degree wise subject for select2 box for old course mapping
    //getting institution wise subject used for old course mapping
    public function getInsituteWiseSubject() {
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $result = [];

        $institutionid = trim($_POST['institution_id']);
        $degree = trim($_POST['degree_id']);
        if (!$this->validation->emptyCheck($institutionid)) {

            $result['error_msg'] = 'Unable to get subjects. Please contact Administrator.';
        } else {

            $institution_details = $this->master_modal->institutionDetailsById($institutionid);

            if ($institution_details) {

                $subj_degree = $institution_details['available_degree_subject'];

                $conv_degreesubject = $subj_degree ? json_decode($subj_degree, true) : '';
                //extracting subject only in to use in select2 option

                $degreeexist = $conv_degreesubject ? array_key_exists($degree, $conv_degreesubject) : '';

                //checking if subjects alrread exist
                if ($degreeexist) {

                    $degreeexist = array_key_exists($degree, $conv_degreesubject) ? $conv_degreesubject[$degree] : '';
                    $recordcount = count($degreeexist) ? count($degreeexist) : '';
                    if ($recordcount) {

                        //extracting subject only in to use in select2 option

                        $result['selected_subject'] = $degreeexist;
                        $result['error_code'] = '200';
                        $result['error_status'] = true;

                        //get all records for subject
                        $subjectall = $this->master_modal->mDegreeSubject($degree);
                        $records = count($subjectall) ? count($subjectall) : '0';

                        if ($records) {

                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                            $result['error_msg'] = $subjectall;
                        } else {

                            $result['error_msg'] = 'Unable to get subjects. Please try again later.';
                        }
                        //get all records for subject
                    } else {

                        $result['error_msg'] = 'Unable to get subjects. Please try again later.';
                    }
                } else {



                    $subjectall = $this->master_modal->mDegreeSubject($degree);
                    $records = count($subjectall) ? count($subjectall) : '0';
                    if ($records) {


                        $result['error_msg'] = $subjectall;
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    } else {

                        $result['error_msg'] = 'Unable to get subjects. Please try again later.';
                    }
                }
            }
        }

        return $result;
    }

    //getting institution wise subject used for old course mapping 
    //check mobile otp locked
    function limitOTPMobile($mobileno, $type) {

        $result = false;
        if (!$this->validation->emptyCheck($mobileno)) {

            $result = false;
        } else if (!$this->validation->mobileValidation($mobileno)) {

            $result = false;
        } else {

            $mobilecount = $this->master_modal->checkLockedMobile($mobileno, $type);
            //var_dump($mobilecount );
            if ($mobilecount['mobile_count'] > '3') {

                $result = false;
            } else if ($mobilecount['mobile_count'] < '3') {

                $result = true;
            }
        }

        return $result;
    }

    //check mobile otp locked



    function getUserDetails() {
        $result['error_code'] = '400';
        $result['error_status'] = false;
        $result['error_msg'] = '';

        $usertypeid = trim($_SESSION['user_details']['user_type']);

        $usertypedetails = $this->master_modal->mUserTypeDetails($usertypeid);
        $usertypename = $usertypedetails['user_type'];
        $distrct_name = '';
        if (!$usertypeid) {

            $result['error_msg'] = 'Unable to fetch user details. Try again later.';
        } else if ($usertypeid == '10') {
            //Executeive officer

            /*  $district_id =  is_array($_SESSION['user_details']['district']) ?  $_SESSION['user_details']['district'][0] : $_SESSION['user_details']['district'];
              $district_details = $this->registration_modal->GetDistrictCode($district_id);
              $distrct_name  = trim($district_details['district_name']); */

            $result['error_code'] = '200';
            $result['error_status'] = true;
            $result['error_msg'] = '';
        } else if ($usertypeid == '20') {
            //social welfare officer

            $disctrict_id = is_array($_SESSION['user_details']['district']) ? $_SESSION['user_details']['district'][0] : $_SESSION['user_details']['district'];
            //var_dump($disctrict_id);
            $districtdetails = $this->registration_modal->GetDistrictCode($disctrict_id);
            $districtname = $districtdetails['district_name'];
            $recordcount1 = count($districtdetails) ? $districtdetails : false;
            if ($recordcount1) {


                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['error_msg'] = $usertypename . ' (' . $districtname . ')';
            } else {

                $result['error_msg'] = 'Unable to fetch user details.';
            }
        } else if ($usertypeid == '30') {
            //Dept HOD 

            $institute_typelist = [];
            $institution_typeid = is_array($_SESSION['user_details']['m_institution_type_id']) ? $_SESSION['user_details']['m_institution_type_id'][0] : $_SESSION['user_details']['m_institution_type_id'];

            $institutiontypedetails = $this->master_modal->mInstitutionType($institution_typeid);

            $recordcount = is_array($institutiontypedetails) ? count($institutiontypedetails) : false;
            if ($recordcount) {

                foreach ($institutiontypedetails as $institutype_details) {

                    $institute_typelist[] = $institutype_details['institution_type'];
                }

                $type_list = implode(',', $institute_typelist);

                $name = $usertypename . ' (' . $type_list . ' )';

                //var_dump($type_list);
            }


            $result['error_code'] = '200';
            $result['error_status'] = true;
            $result['error_msg'] = $name;
        } else if ($usertypeid == '31') {
            //institution 


            $instiutonname = '';
            $institution_id = is_array($_SESSION['user_details']['institution_id']) ? $_SESSION['user_details']['institution_id'][0] : $_SESSION['user_details']['institution_id'];
            $institutiondetails = $this->master_modal->getInsituteWiseSubject($institution_id);
            $recordcount = count($institutiondetails) ? $institutiondetails : false;

            $disctrict_id = is_array($_SESSION['user_details']['district']) ? $_SESSION['user_details']['district'][0] : $_SESSION['user_details']['district'];
            $districtdetails = $this->registration_modal->GetDistrictCode($disctrict_id);
            $recordcount1 = count($districtdetails) ? $districtdetails : false;

            if ($recordcount and $recordcount1) {

                $instiutonname = $institutiondetails['institution_name'];
                $districtname = $districtdetails['district_name'];
                $name = $instiutonname . ' (' . $districtname . ' )';
            }

            $result['error_code'] = '200';
            $result['error_status'] = true;
            $result['error_msg'] = $name;
        } else if ($usertypeid == '40') {
            //e-District manager

            $district_list = [];
            $disctrict_id = is_array($_SESSION['user_details']['district']) ? $_SESSION['user_details']['district'][0] : $_SESSION['user_details']['district'];
            if ($disctrict_id) {

                $districtdetails = $this->registration_modal->GetDistrictCode($disctrict_id);
                $recordcount = count($districtdetails) ? $districtdetails : false;
                if ($recordcount) {

                    $districtname = $districtdetails['district_name'];
                    $name = $usertypename . ' (' . $districtname . ' )';
                }

                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['error_msg'] = $name;
            } else {

                $result['error_msg'] = 'Unable to fetch user deails.';
            }
        } else if ($usertypeid == '50') {
            //District Collector sincle district

            $district_list = [];
            $disctrict_id = is_array($_SESSION['user_details']['district']) ? $_SESSION['user_details']['district'][0] : $_SESSION['user_details']['district'];
            if ($disctrict_id) {

                $districtdetails = $this->registration_modal->GetDistrictCode($disctrict_id);
                $recordcount = count($districtdetails) ? $districtdetails : false;
                if ($recordcount) {

                    $districtname = $districtdetails['district_name'];
                    $name = $usertypename . ' (' . $districtname . ' )';
                }

                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['error_msg'] = $name;
            } else {

                $result['error_msg'] = 'Unable to fetch user deails.';
            }
        }

        return $result;
    }

    /* //getting subject name and id using degree and insitution for new course mapping
      public function getSubjectByDegree()
      {

      $result['error_msg'] = '';
      $result['error_code'] = '400';
      $result['error_status'] = false;


      $degreeid = trim($_POST['degree_id']);
      $institution = trim($_POST['m_institution_id']);
      if (!$degreeid) {

      $result['error_msg'] = 'Unable to get degree details. Try later.';
      } else if (!$institution) {

      $result['error_msg'] = 'Unable to get Insitution details. Try later.';
      } else {


      $subjects_id = $this->master_modal->mDegreeSubject($degreeid);


      if ($subjects_id) {

      $record_count  = count($subjects_id) ? $subjects_id : '';
      if ($record_count) {

      $result['error_msg'] =  $subjects_id;
      $result['error_code'] = '400';
      $result['error_status'] = false;
      } else {

      $result['error_msg'] =  'Unable to get subject list. Try again later.';
      $result['error_code'] = '400';
      $result['error_status'] = false;
      }
      } else {

      $result['error_msg'] = 'Unable to get Insitution details. Try later.';
      }
      }
      }
      //getting subject name and id using degree and insitution for new course mapping */

    // Added By Arul 22-11-2022
    function getBank() {
        $result_bank = $this->master_modal->getBank();
        if ($result_bank) {

            $result['error_msg'] = $result_bank;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'Problem on fetch bank';
            $result['error_code'] = '400';
            $result['error_status'] = false;
        }

        return $result;
    }

    function getBranch() {
        $result = false;
        if (isset($_POST['district'])) {
            $result_branch = $this->master_modal->getBranch($_POST['district'], $_POST['bank']);
            if ($result_branch) {

                $result['error_msg'] = $result_branch;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on fetch branch';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }

    function getBranchDetails() {
        $result = false;
        if (isset($_POST['branch'])) {
            $result_branch = $this->master_modal->getBranchDetails($_POST['branch']);
            if ($result_branch) {

                $result['error_msg'] = $result_branch;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Problem on fetch branch';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }

    function VerifyBankDetails() {
        $result = false;
        if (isset($_POST['student_reg_id']) && isset($_POST['branch'])) {
            $student_reg_id = $this->validation->decryptValue($_POST['student_reg_id']);

            $data = array(
                "student_registration_id" => $student_reg_id,
                "m_bank_branch_id" => $_POST['branch'],
                "created_by" => $_SESSION['user_details']['user_id']);

            $result_branch = $this->master_modal->VerifyBankDetails($data);
            //var_dump($result_branch);
            if ($result_branch) {

                $result['error_msg'] = 'Bank Verification Request Submitted Sucessfully';
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'Already Bank Proposed';
                $result['error_code'] = '400';
                $result['error_status'] = false;
            }
        }

        return $result;
    }

}

//class ending
