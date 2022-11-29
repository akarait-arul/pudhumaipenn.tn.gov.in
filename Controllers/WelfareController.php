<?php

ini_set('display_errors', -1);
include_once("./classes/validation.php");
include_once("./Models/WelfareModel.php");
include_once("./Models/MasterModel.php");
require_once './Config/config.php';


class WelfareController
{

    function __construct()
    {
        $this->welfare_modal = new WelfareModel();
        $this->validation = new validation();
        $this->mastermodal = new MasterModel();
    }

    //get student list by pending
    function getWelfareStudentListByType()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;


        $welfare_district = isset($_SESSION['user_details']['district']) ? $_SESSION['user_details']['district'] : '';

        if ($welfare_district) {


            $district =  is_array($welfare_district)  ?  implode($welfare_district, ",") : trim($welfare_district);
            $studentrecordstype = trim($_POST['recordstype']);

            $where =  " AND d.m_district_id in ('" . $district . "') ";
            if ($this->validation->emptyCheck($studentrecordstype)) {

                if ($studentrecordstype == 'approved') {

                    $type = '1';
                } else if ($studentrecordstype == 'pending') {

                    $type = '2';
                } else if ($studentrecordstype == 'rejected') {

                    $type = '3';
                }


                //var_dump($where);

                $getpendinglist = $this->welfare_modal->getWelfareStudentListByType($where, $type);
                //var_dump($getpendinglist);
                $record_count = $getpendinglist ?  count($getpendinglist)  : $getpendinglist = 0;



                if ($record_count) {

                    $rows_table = '';
                    foreach ($getpendinglist as $rows) {

                        $rows_table .= '<tr>';
                        if ($studentrecordstype == "pending") {

                            $rows_table .= '<td>  <div class="form-check mb-0"><input class="form-check-input stud_det" value="' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . '"  name="stud_details" type="checkbox"  data-bulk-select-row="data-bulk-select-row" /></div>  </td>';
                        }
                        $rows_table .= '<td>' . $rows['student_registration_no'] . '</td>';
                        $rows_table .= '<td>' . $rows['student_name'] . '</td>';
                        $rows_table .= '<td>' . $rows['emis_id'] . '</td>';
                        $rows_table .= '<td>' . $rows['phone_number'] . '</td>';
                        $rows_table .= '<td>' . $rows['email_id'] . '</td>';
                        $rows_table .= '<td>' . $this->validation->aadhaarmasking($rows['aadhaar_no']) . '</td>';
                        $rows_table .= '<td>' . $rows['institution_name'] . '</td>';
                        $rows_table .= '<td>' . $rows['degree'] . '</td>';
                        $rows_table .= '<td>' . $rows['subject'] . '</td>';


                        if ($studentrecordstype == "rejected") {

                            $rows_table .= '<td>' . $rows['reject_reason'] . '</td>';
                        }

                        $rows_table .= '<td><div> <a href="student_profile.php?id='.trim($this->validation->encryptValue($rows['student_registration_id'])).'"><span class="text-500 fas fa-eye text-black"></span> </a> </div></td>';
                        if ($studentrecordstype == "pending") {

                            $rows_table .= '<td>  <div>    <button class="btn btn-success   "  onclick="accept_student(' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . ')"     > <i class="fas fa-check"></i></button>  <button class="btn btn-danger"   data-bs-toggle="modal" onclick="openreason_student(' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . ')"   >  <i class="far fa-window-close"></i></button> </div></td>';
                        }
                        $rows_table .= '</tr>';
                    }

                    $result['error_msg'] = $rows_table;
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                    $result['error_msg'] = 'No records found.';
                }
            } else {

                $result['error_msg'] = 'Unable to fetch login details. Please contact admin.';
            }
        } else {


            $result['error_msg'] = 'Unable to fetch User details. Please contact admin.';
        }


        return $result;
    }
    //get student list by pending

    //get filtered student list
    public function getFilteredStudentsResulst()
    {


        $result['error_msg']  = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $where  = '';
        $studentrecordstype = trim($_POST['recordtype'])  ?: '';
        $institutiontypeid = isset($_POST['institutiontypeid']) ?  trim($_POST['institutiontypeid'])   : '';
        $institutionid = isset($_POST['institutionlisteid']) ?  trim($_POST['institutionlisteid'])   : '';
        $course = isset($_POST['course']) ?  trim($_POST['course'])   : '';
        $subject = isset($_POST['subject']) ?  trim($_POST['subject'])   : '';
        $startdate = isset($_POST['startdate']) ?  trim($_POST['startdate'])   : '';
        $enddate = isset($_POST['enddate']) ?  trim($_POST['enddate'])   : '';
        $welfare_district = $_SESSION['user_details']['district'];
        $district =  is_array($welfare_district)  ?  implode($welfare_district, ",") : trim($welfare_district);

        $where .=  " AND d.m_district_id in ('" . $district . "') ";

        if (!$this->validation->emptyCheck($institutiontypeid)) {

            $result['error_msg'] = 'Unable to get institution type details.';
        } else {

            $where  .= " and a.m_institution_type_id = '" . $institutiontypeid . "' ";
            $where  .= $institutionid ?  " and a.m_institution_id = '" . $institutionid . "'   "   : '';
            $where  .= $course ?  " and a.m_degree_id = '" . $course . "'   "   : '';
            $where  .= $subject ?  " and a.m_subject_id = '" . $subject . "'   "   : '';

            if ($startdate and   empty($enddate)) {

                $enddate = $startdate;
            }


            $enddat = $this->validation->dateFormatDB($enddate);


            $where  .= ($startdate and  $enddate) ?  " and (a.reg_date  between  '" . $this->validation->dateFormatDB($startdate) . "' and  '" . $this->validation->dateFormatDB($enddat) . "')  "     : '';

             
             
            if ($studentrecordstype == 'approved') {

                $type = '1';
            } else if ($studentrecordstype == 'pending') {

                $type = '2';
            } else if ($studentrecordstype == 'rejected') {

                $type = '3';
            }

            $getpendinglist = $this->welfare_modal->getWelfareStudentListByType($where, $type);
            //var_dump($getpendinglist);
            
            $record_count = $getpendinglist ?  count($getpendinglist)  :   0;
            
            if ($record_count) {

                $rows_table = '';
                foreach ($getpendinglist as $rows) {

                    $rows_table .= '<tr>';
                    if ($studentrecordstype == "pending") {

                        $rows_table .= '<td>  <div class="form-check mb-0"><input class="form-check-input stud_det" value="' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . '"  name="stud_details" type="checkbox"  data-bulk-select-row="data-bulk-select-row" /></div>  </td>';
                    }
                    $rows_table .= '<td>' . $rows['student_registration_no'] . '</td>';
                    $rows_table .= '<td>' . $rows['student_name'] . '</td>';
                    $rows_table .= '<td>' . $rows['emis_id'] . '</td>';
                    $rows_table .= '<td>' . $rows['phone_number'] . '</td>';
                    $rows_table .= '<td>' . $rows['email_id'] . '</td>';
                    $rows_table .= '<td>' . $this->validation->aadhaarmasking($rows['aadhaar_no']) . '</td>';
                    $rows_table .= '<td>' . $rows['institution_name'] . '</td>';
                    $rows_table .= '<td>' . $rows['degree'] . '</td>';
                    $rows_table .= '<td>' . $rows['subject'] . '</td>';


                    if ($studentrecordstype == "rejected") {

                        $rows_table .= '<td>' . $rows['reject_reason'] . '</td>';
                    }

                    $rows_table .= '<td><div> <a href="student_profile.php?id="'.$this->validation->encryptValue($rows['student_registration_id']).'" target="_blank"><span class="text-500 fas fa-eye text-black"></span> </a> </div></td>';
                    if ($studentrecordstype == "pending") {

                        $rows_table .= '<td>  <div>    <button class="btn btn-success   "  onclick="accept_student(' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . ')"     > <i class="fas fa-check"></i></button>  <button class="btn btn-danger"   data-bs-toggle="modal" onclick="openreason_student(' . "'" . $this->validation->encryptValue($rows['student_registration_id']) . "'" . ')"   >  <i class="far fa-window-close"></i></button> </div></td>';
                    }
                    $rows_table .= '</tr>';
                }

                $result['error_msg'] = $rows_table;
                $result['error_code'] = '200';
                $result['error_status'] = true;
                
            } else {

                $result['error_code'] = '200';
                $result['error_status'] = true;
                $result['error_msg']   = '<tr><td class="text-center" colspan="11"> No records founds </td></tr>';
            }
        }


        return $result;
    }
    //get filtered student list

    function GetWelfareInstitutionTypeByDistrictID()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $welfare_district = $_SESSION['user_details']['district'] ?  $_SESSION['user_details']['district']   : '';
        $welfaredistricts =  is_array($welfare_district)  ?  implode($welfare_district, ",") : trim($welfare_district);

        if (!$this->validation->emptyCheck($welfaredistricts)) {

            $result['error_msg'] = 'Unable to get welfare district ';
        } else {

            $institutiontype = $this->welfare_modal->GetWelfareInstitutionTypeByDistrictID($welfaredistricts);
            //var_dump(count($institutiontype));
            $record_count =  $institutiontype  ?  count($institutiontype)  : $institutiontype = 0;

            if ($record_count) {

                $result['error_msg'] = $institutiontype;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'No records found.';
                $result['error_code'] = '200';
                $result['error_status'] = true;
            }
        }



        return $result;
    }


    function GetWelfareInstitutionByDistrictID()
    {
        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $institutetype = trim($_POST['institution_type']);
        $welfare_district = $_SESSION['user_details']['district'] ?  $_SESSION['user_details']['district']   : '';
        $welfaredistricts =  is_array($welfare_district)  ?  implode($welfare_district, ",") : trim($welfare_district);
        if (!$this->validation->emptyCheck($institutetype)) {

            $result['error_msg'] = 'Unable to get Institution List for Welfare District.';
        } else {

            $result_institution = $this->mastermodal->mInstitutionMapping($welfaredistricts, $institutetype);

            $record_count =  $result_institution  ?  count($result_institution)  : $result_institution = 0;
            if ($record_count) {

                $result['error_msg'] = $result_institution;
                $result['error_code'] = '200';
                $result['error_status'] = true;
            } else {

                $result['error_msg'] = 'no records found';
                $result['error_code'] = '200';
                $result['error_status'] = true;
            }
        }

        return $result;
    } //fucntion



    public function acceptStudent()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $student_id = trim($_POST['student_id']);
        $logged_id = $_SESSION['user_details']['user_id'];

        if (!$this->validation->emptyCheck($student_id)) {

            $result['error_msg'] = 'Unable to fetch student details';
        }
        if (!$this->validation->emptyCheck($logged_id)) {

            $result['error_msg'] = 'Unable to fetch welfare user details';
        } else {

            $userid = $this->validation->decryptValue($student_id);
            if ($this->validation->numbersonly($userid)) {


                $table_name = 'student_institution_details';
                $records['sw_status'] = '1';
                $records['sw_date'] = date("Y-m-d H:i:s");
                $records['sw_by'] = $logged_id;
                $records['updated_by'] = $logged_id;
                $records['updated_on'] = date("Y-m-d H:i:s");
                //$records['updated_on'] = 'CURRENT_TIMESTAMP()';
                $where = " student_registration_id = '" . $userid . "'";
                //var_dump($records);
                $result_accept_student = $this->welfare_modal->acceptStudent($table_name, $records, $where);
                //var_dump($result_accept_student);
                if ($result_accept_student) {

                    $result['error_msg'] = 'Student Application Accepted successfully.';
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Unable to accept application. Please contact admin.';
                }
            } else {

                $result['error_msg'] = 'Unable to fetch student details. Please contact admin.';
            }
        }

        return $result;
    }



    public function rejectStudent()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $student_id = trim($_POST['student_id']);
        $logged_id = $_SESSION['user_details']['user_id'];
        $reason_id =  trim($_POST['reason_list']);
        // $reason_text =  trim($_POST['reasontext']);

        if (!$this->validation->emptyCheck($student_id)) {

            $result['error_msg'] = 'Unable to fetch student details';
        }
        if (!$this->validation->emptyCheck($logged_id)) {

            $result['error_msg'] = 'Unable to fetch welfare user details';
        }
        if (!$this->validation->emptyCheck($reason_id)) {

            $result['error_msg'] = 'Please select reason type.';
        }
        /* if (!$this->validation->emptyCheck($reason_text)) {

            $result['error_msg'] = 'Please enter the reason.';
        } */ else {

            $userid = $this->validation->decryptValue($student_id);
            if ($this->validation->numbersonly($userid)) {
                $table_name = 'student_institution_details';
                $records['sw_status'] = '2';
                $records['sw_date'] = date("Y-m-d H:i:s");
                $records['sw_by'] = $logged_id;
                $records['updated_by'] = $logged_id;
                $records['updated_on'] = date("Y-m-d H:i:s");
                //$records['updated_on'] = 'now()';
                // $records['sw_reason_text'] =  $reason_text;
                $records['sw_m_reason_id'] =  $reason_id;

                //$records['updated_on'] = 'CURRENT_TIMESTAMP()';
                $where = " student_registration_id = '" . $userid . "'";
                $result_reject_student = $this->welfare_modal->acceptStudent($table_name, $records, $where);

                if ($result_reject_student) {

                    $result['error_msg'] = 'Student Application Rejected.';
                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                } else {

                    $result['error_msg'] = 'Unable to accept application. Please contact admin.';
                }
            } else {

                $result['error_msg'] = 'Unable to get student details. Please contact admin.';
            }
        }

        return $result;
    }


    function getRejectResonsList()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $result_reject_reasons = $this->welfare_modal->getRejectResonsList();
        $record_count =  $result_reject_reasons  ?  count($result_reject_reasons)  : $result_reject_reasons = 0;

        if ($record_count) {

            $result['error_msg'] = $result_reject_reasons;
            $result['error_code'] = '200';
            $result['error_status'] = true;
        } else {

            $result['error_msg'] = 'no records found.';
        }


        return $result;
    }

    function acceptAllStudents()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $student_ids = $_POST['student_ids'];
        $logged_id = $_SESSION['user_details']['user_id'];

        $totalid = is_array($student_ids) ? count($student_ids) : '';

        if (!$this->validation->emptyCheck($totalid)) {

            $result['error_msg'] = 'Selected student list is empty';
        }
        if (!$this->validation->emptyCheck($logged_id)) {

            $result['error_msg'] = 'Unable to fetch logged user information.';
        } else {

            $studentall = [];
            foreach ($student_ids as $value) {

                if ($student_id = $this->validation->decryptValue($value)) {
                    if ($this->validation->numbersonly($student_id)) {

                        $studentall[] = $student_id;
                    }
                }
            }

            if (count($studentall) == $totalid) {

                $studentslist = implode(",", (array)$studentall);

                //var_dump($studentslist);

                $table_name = 'student_institution_details';
                $records['sw_status'] = '1';
                $records['sw_date'] = date("Y-m-d H:i:s");
                $records['sw_by'] = $logged_id;
                $records['updated_by'] = $logged_id;
                $records['updated_on'] = date("Y-m-d H:i:s");
                $where = " student_registration_id in (" . $studentslist . ") ";
                //$where = " student_registration_id in ('4') ";
                //var_dump($table_name);
                $result_accept_student = $this->welfare_modal->acceptStudent($table_name, $records, $where);

                if ($result_accept_student) {

                    $result['error_code'] = '200';
                    $result['error_status'] = true;
                    $result['error_msg'] = 'All selected student application accepted successfully.';
                } else {

                    $result['error_msg'] = 'Unable to accept student application. Please contact admin.';
                }
            } else {

                $result['error_msg'] = 'Selected student list have some problem. Please try again later.';
            }
        }





        return $result;
    }

    function getWelfareCourseList()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $institution_id = $_POST['institution_id'];
        if (!$this->validation->emptyCheck($institution_id)) {
            $result['error_msg'] = 'Unable to fetch Institution details. Please contact Admin.';
        } else if (!$this->validation->numbersonly($institution_id)) {
            $result['error_msg'] = 'Unable to find Institution details. Try again later.';
        } else {

            $institutiondetails = $this->mastermodal->GetAvailableDegreeSubject($institution_id);
            if ($institutiondetails) {
                $degree_subject  = isset($institutiondetails['available_degree_subject']) ?  json_decode($institutiondetails['available_degree_subject'])  : '';

                //degree is mapped to institution
                if ($degree_subject) {

                    $institution_degree = array_keys($degree_subject);
                    if (count($institution_degree)) {

                        $result_modal_degree = $this->mastermodal->GetDegreeByID($institution_degree);
                        $result_modal_degree = count($result_modal_degree) ?  $result_modal_degree  : '';
                        if ($result_modal_degree) {

                            $degreelist = '<option value=""> Select degree </option>';
                            foreach ($result_modal_degree as $degree) {

                                $degreelist .= '<option  value="' . $degree['m_degree_id'] . '" >' . $degree['degree'] . ' </option>';
                            }


                            $result['error_msg'] =  $degreelist;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {
                            $result['error_msg'] = 'Unable to fetch degree details for the Institution. Please try again later.';
                        }
                    } else {

                        $result['error_msg'] = 'Unable to fetch degree details for the Institution. Please try again later.';
                    }
                } else {
                    //degree is not mapped to institution so all degree list

                    $institution_type_id =  isset($institutiondetails['m_institution_type_id']) ? trim($institutiondetails['m_institution_type_id']) : '';
                    if ($institution_type_id) {

                        $getalldegree = $this->mastermodal->mDegree($institution_type_id);
                        //var_dump($getalldegree);
                        $getalldegree = count($getalldegree) ? $getalldegree   : '';
                        if ($getalldegree) {

                            $degreelist = '<option value=""> Select degree </option>';
                            foreach ($getalldegree as $degree) {

                                $degreelist .= '<option  value = "' . $degree['m_degree_id'] . '" >' . $degree['degree'] . ' </option>';
                            }


                            $result['error_msg'] =  $degreelist;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {

                            $result['error_msg'] = 'Unable to fetch degree details. Please try again later.';
                        }
                    } else {

                        $result['error_msg'] = 'Unable to fetch Institution details. Please try again later.';
                    }
                }
            }
        }
        return $result;
    }


    function getWelfareSubjectList()
    {

        $result['error_msg'] = '';
        $result['error_code'] = '400';
        $result['error_status'] = false;

        $institution_id = trim($_POST['institution_id']);
        $course_id = trim($_POST['courseid']);
        if (!$this->validation->emptyCheck($institution_id)) {
            $result['error_msg'] = 'Unable to fetch Institution details. Please contact Admin.';
        } else if (!$this->validation->numbersonly($institution_id)) {

            $result['error_msg'] = 'Unable to find Institution details. Try again later.';
        } else if (!$this->validation->emptyCheck($course_id)) {
            $result['error_msg'] = 'Unable to fetch course details. Please contact Admin.';
        } else if (!$this->validation->numbersonly($course_id)) {

            $result['error_msg'] = 'Unable to find course details. Try again later.';
        } else {

            $institutiondetails = $this->mastermodal->GetAvailableDegreeSubject($institution_id);
            if ($institutiondetails) {

                $degree_subject  = isset($institutiondetails['available_degree_subject']) ?  json_decode($institutiondetails['available_degree_subject'])  : '';

                //degree is mapped to institution
                if ($degree_subject) {

                    $institution_subject = isset($degree_subject[$course_id]) ?    $degree_subject[$course_id]   : '';

                    if (count($institution_subject)) {

                        $result_modal_subject = $this->mastermodal->GetInstitutionSubjectByID($institution_subject);
                        $result_modal_subject = count($result_modal_subject) ?  $result_modal_subject  : '';
                        if ($result_modal_subject) {

                            $subjectlist = '<option value=""> Select subject </option>';
                            foreach ($result_modal_subject as $subject) {

                                $subjectlist .= '<option value = "' . $subject['m_subject_id'] . '" >' . $subject['subject'] . ' </option>';
                            }


                            $result['error_msg'] =  $subjectlist;
                            $result['error_code'] = '200';
                            $result['error_status'] = true;
                        } else {
                            $result['error_msg'] = 'Unable to fetch subject list for current Institution. Contact admin.';
                        }
                    } else {

                        $result['error_msg'] = 'Unable to fetch subject list for current Institution. Contact admin.';
                    }
                } else {
                    //degree is not mapped to institution so all degree list

                    $getallsubject = $this->mastermodal->mDegreeSubject($course_id);
                    //var_dump($getalldegree);
                    $getallsubject = count($getallsubject) ? $getallsubject   : '';
                    if ($getallsubject) {

                        $degreelist = '<option value=""> Select degree </option>';
                        foreach ($getallsubject as $subject) {

                            $degreelist .= '<option value ="' . $subject['m_subject_id'] . '" >' . $subject['subject'] . ' </option>';
                        }

                        $result['error_msg'] =  $degreelist;
                        $result['error_code'] = '200';
                        $result['error_status'] = true;
                    } else {

                        $result['error_msg'] = 'Unable to fetch degree details. Please try again later.';
                    }
                }
            }
        }
        return $result;
    } //







} //class ending
