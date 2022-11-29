<?php

include_once("./Config/db_connect.php");

class RegistrationModel {

    public function __construct() {




        $db = new DBConfig();
        $conn = $db->dbConnection();
        $this->conn = $conn;
    }

    public function StudentSchoolDetailsAPI($district_id, $fromdate, $todate) {

        $where = "AND date(std_ins.created_on) BETWEEN '$fromdate' AND '$todate'";
        if ($district_id != '') {
            if ($district_id == 'All') {
                $where .= '';
            } else {

                $where .= "AND m_ins.m_district_id='$district_id'";
            }
        }
        $result = $this->conn->getAll("SELECT MD5(CONCAT(std_ins.student_institution_details_id,std_ins.student_registration_id,std_ins.student_registration_no)) AS studentkey,
                                        std_reg.student_registration_id,std_reg.phone_number,std_reg.email_id,std_det.emis_id,std_det.student_name_emis,std_det.date_of_birth,std_det.aadhaar_no,m_comm.community_name,m_rel.religion,std_det.gender, std_det.mother_name,std_det.parents_mobile,std_det.father_name,
                                        m_ins.institution_name, m_ins_type.institution_type, m_deg.degree, m_deg_sub.subject, std_ins.date_of_admission, std_ins.reg_date,std_ins.school_completion_on,std_ins.academic_year,std_ins.year_of_study,
                                        std_sch.district_6th,std_sch.school_6th,std_sch.year_of_study_6th,std_sch.district_7th,std_sch.school_7th,std_sch.year_of_study_7th,std_sch.district_8th,std_sch.school_8th,std_sch.year_of_study_8th,std_sch.district_9th,std_sch.school_9th,std_sch.year_of_study_9th,std_sch.district_10th,std_sch.school_10th,std_sch.year_of_study_10th,std_sch.district_11th,std_sch.school_11th,std_sch.year_of_study_11th,std_sch.group_11th,std_sch.medium_11th,std_sch.district_12th,std_sch.school_12th,std_sch.year_of_study_12th
                                        FROM student_institution_details AS std_ins
                                        INNER JOIN student_registration AS std_reg ON std_ins.student_registration_id = std_reg.student_registration_id
                                        INNER JOIN student_school_details AS std_sch ON std_ins.student_registration_id = std_sch.student_registration_id
                                        INNER JOIN student_details AS std_det ON std_ins.student_registration_id = std_det.student_registration_id
                                        INNER JOIN m_institution AS m_ins ON std_ins.m_institution_id = m_ins.m_institution_id
                                        INNER JOIN m_institution_type AS m_ins_type ON std_ins.m_institution_type_id = m_ins_type.m_institution_type_id
                                        INNER JOIN m_degree AS m_deg ON std_ins.m_degree_id = m_deg.m_degree_id
                                        INNER JOIN m_degree_subject AS m_deg_sub ON std_ins.m_subject_id = m_deg_sub.m_subject_id
                                        INNER JOIN m_community AS m_comm ON std_det.community = m_comm.m_community_id
                                        INNER JOIN m_religion AS m_rel ON std_det.religion = m_rel.m_religion_id
                                        WHERE emis_id_verified = 'N' AND emis_id_verified_on IS NULL $where ");

        return $result;
    }

    public function VerifyStudentSchoolKey($key) {

        $result = $this->conn->getRow("select * from student_institution_details where MD5(CONCAT(student_institution_details_id,student_registration_id,student_registration_no)) = '$key' and is_deleted=0");
        return $result;
    }

    public function StudentSchoolDetailsApproved($key, $status, $reason) {

        $SQL = "UPDATE student_institution_details SET `emis_id_verified`='$status',emis_id_validation='$status',`emis_id_verified_on`=now(),rejectreason='$reason',emis_id_verified_by=999999999 WHERE MD5(CONCAT(student_institution_details_id,student_registration_id,student_registration_no)) = '$key' and is_deleted=0";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateBankDetails($result_api) {

        $bank_name = $result_api['bank_name'];
        $status = $result_api['status'];
        $student_registration_id = $result_api['student_registration_id'];
        $SQL = "UPDATE student_bank_details SET `bank_name`='$bank_name',`status`='$status' WHERE `student_registration_id`='$student_registration_id' and is_deleted=0";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {

            return true;
        } else {

            return false;
        }
    }

    //Added By GG on 16-Nov-2022 - START
    public function saveBankDetails($data) {

        $cur_date = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM student_bank_details WHERE student_registration_id = {$data['student_registration_id']}";
        $rs = $this->conn->execute($sql);
        if ($rs->NumRows()) {
            $data['updated_on'] = $cur_date;
            $data['student_bank_details_id'] = $rs->fields['student_bank_details_id'];
            unset($data['created_by']);
            $sql = $this->conn->GetUpdateSQL($rs, $data, true);
        } else {
            $data['created_on'] = $cur_date;
            unset($data['updated_by']);
            $sql = $this->conn->GetInsertSQL($rs, $data);
        }

        $result = $this->conn->Execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Added By GG on 16-Nov-2022 - END

    public function UpdateNPCIStatus($result_api) {

        //$bank_name = $result_api['bank_name'];
        //$status = $result_api['status'];
        $npci_status_verified_by = $result_api['npci_status_verified_by'];
        $student_registration_id = $result_api['student_registration_id'];
        $SQL = "UPDATE student_institution_details SET `npci_status`= 1,`npci_status_verified_on`= now(),`npci_status_verified_by` = {$npci_status_verified_by} WHERE `student_registration_id`='{$student_registration_id}' and is_deleted=0";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {
            return true;
        } else {
            return false;
        }
    }

    public function GetStudentProfile($student_reg_id) {

        $result = $this->conn->getRow("SELECT std_reg.student_registration_id,std_reg.student_name,std_reg.phone_number,std_reg.email_id,std_reg.isactive,std_det.gender,std_det.emis_id,std_det.date_of_birth,std_det.aadhaar_no,std_det.community,std_det.religion,std_det.mother_name,std_det.parents_mobile,std_det.father_name,std_det.guardian_name,std_edet.enumber,std_edet.edetails,std_ins.student_registration_no,std_ins.m_institution_id,std_ins.m_institution_type_id,std_ins.m_degree_id,std_ins.m_subject_id,std_ins.date_of_admission,std_ins.emis_id_verified,std_ins.emis_id_verified_on,std_ins.emis_id_validation,std_ins.reg_date,std_ins.aadhaar_ekyc_status,std_ins.aadhaar_ekyc_verified_on,std_ins.npci_status,std_ins.npci_status_verified_on,std_ins.school_completion_on,std_ins.academic_year,std_ins.year_of_study,std_ins.sw_status,std_ins.sw_date,std_ins.sw_m_reason_id,std_ins.sw_by,std_sch.district_6th,std_sch.school_6th,std_sch.year_of_study_6th,std_sch.district_7th,std_sch.school_7th,std_sch.year_of_study_7th,std_sch.district_8th,std_sch.school_8th,std_sch.year_of_study_8th,std_sch.district_9th,std_sch.school_9th,std_sch.year_of_study_9th,std_sch.district_10th,std_sch.school_10th,std_sch.year_of_study_10th,std_sch.district_11th,std_sch.school_11th,std_sch.year_of_study_11th,std_sch.district_12th,std_sch.school_12th,std_sch.year_of_study_12th,std_sch.group_11th,std_sch.medium_11th,std_bank.bank_name,std_bank.status,m_ins.institution_name,m_deg.degree,m_instype.institution_type,m_deg_sub.subject,m_year_school_comp.year_of_completion AS school_comp_on,m_acad_year.year_of_completion AS academic_year FROM student_registration AS std_reg left JOIN student_details AS std_det ON std_reg.student_registration_id = std_det.student_registration_id left JOIN student_edetails AS std_edet ON std_reg.student_registration_id=std_edet.student_registration_id left JOIN student_institution_details AS std_ins ON std_reg.student_registration_id=std_ins.student_registration_id left JOIN student_school_details AS std_sch ON std_reg.student_registration_id=std_sch.student_registration_id LEFT JOIN student_bank_details AS std_bank ON std_reg.student_registration_id=std_bank.student_registration_id LEFT JOIN m_institution AS m_ins ON std_ins.m_institution_id = m_ins.m_institution_id LEFT JOIN m_degree AS m_deg ON std_ins.m_degree_id = m_deg.m_degree_id LEFT JOIN m_institution_type AS m_instype ON std_ins.m_institution_type_id = m_instype.m_institution_type_id LEFT JOIN m_degree_subject AS m_deg_sub ON std_ins.m_subject_id = m_deg_sub.m_subject_id LEFT JOIN m_year_of_completion AS m_year_school_comp ON std_ins.school_completion_on = m_year_school_comp.m_year_of_completion_id LEFT JOIN m_year_of_completion AS m_acad_year ON std_ins.academic_year = m_acad_year.m_year_of_completion_id WHERE std_reg.student_registration_id='$student_reg_id' AND std_reg.is_deleted=0");
        return $result;
    }

    public function DeleteEDetailsTemp($aadhaar_no) {

        $SQL = "delete FROM student_edetail_temp WHERE aadhar_no='$aadhaar_no'";
        $result = $this->conn->execute($SQL);
        return $result;
    }

    // GET District Code
    public function GetDistrictCode($district_id) {

        $result = $this->conn->getRow("select * from m_district where m_district_id ='$district_id'");

        return $result;
    }

    // Insert Institution On User Login Table
    public function InsertStudentEdetailTemp($records) {

        $SQL = "SELECT * FROM student_edetail_temp WHERE aadhar_no=-1";
        $loginRecord = $this->conn->execute($SQL);
        $InsertSQL = $this->conn->getInsertSql($loginRecord, $records);
        //print($InsertSQL);
        $this->conn->execute($InsertSQL);
        return $last_id = $this->conn->insert_Id();
    }

    // Get Student EDetails From Temp Table
    public function GetStudentDetailsFromTemp($aadhaar_no) {

        $result = $this->conn->getRow("select * from student_edetail_temp where aadhar_no ='$aadhaar_no' order by id_temp desc limit 1");
        return $result;
    }

    // Insert Institution On User Login Table
    public function InsertStudentEdetail($records) {

        $SQL = "SELECT * FROM student_edetails WHERE student_edetails_id=-1";
        $loginRecord = $this->conn->execute($SQL);
        $InsertSQL = $this->conn->getInsertSql($loginRecord, $records);
        //print($InsertSQL);
        $this->conn->execute($InsertSQL);
        return $last_id = $this->conn->insert_Id();
    }

    public function CheckEMISAlreadyEXISTS($emis_id) {

        $result = $this->conn->getRow("SELECT * FROM student_details as std_det LEFT JOIN student_registration AS std_reg on std_det.student_registration_id = std_reg.student_registration_id WHERE std_det.emis_id ='$emis_id' and std_reg.is_deleted=0");
        return $result;
    }

    public function CheckAadharAlreadyEXISTS($aadhar) {

        $result = $this->conn->getRow("SELECT * FROM student_details as std_det LEFT JOIN student_registration AS std_reg on std_det.student_registration_id = std_reg.student_registration_id WHERE std_det.aadhaar_no ='$aadhar' and std_reg.is_deleted=0");
        return $result;
    }

    public function updateisDelete($student_id, $table_name) {

        //$SQL = "UPDATE $table_name SET `is_deleted`= 1 WHERE  `student_registration_id`='$student_id'";        
        $SQL = "delete FROM $table_name WHERE `student_registration_id`='$student_id'";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {

            return true;
        } else {

            return false;
        }
    }

    public function updateStudentInstituionekysDetails($student_id) {

        $SQL = "UPDATE student_institution_details SET `aadhaar_ekyc_status`=1 WHERE  `student_registration_id`='$student_id' and is_deleted=0";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {

            return true;
        } else {

            return false;
        }
    }

    // Function Get School Eligibility
    public function checkSchoolEligibility($course) {

        $result = $this->conn->getRow("select * from m_degree where m_degree_id='$course' and is_deleted=0");
        return $result;
    }

    // Function Check Institution Registration Already Registered or Not
    public function checkInstituionRegistration($mobile_number, $email_id) {

        $result = $this->conn->getRow("select * from institution_register where (mobile_number='$mobile_number' or email_id='$email_id') and is_deleted=0");
        return $result;
    }

    // Function Check Institution Registration Exist on User Login Table
    public function checkUserExists($mobile_number, $email_id) {

        $result = $this->conn->getRow("select * from user_login where (mobile_number='$mobile_number' or email_id='$email_id') and is_deleted=0");
        return $result;
    }

    // Function Insert Institution Registration Details
    public function InsertInstitutionRegistration($institutionRecords) {

        $SQL = "SELECT * FROM institution_register WHERE institution_register_id=-1";
        $institutionFileds = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($institutionFileds, $institutionRecords);
        $this->conn->execute($SQL);
        return $this->conn->insert_Id();
    }

    public function InstitutionRegisterList() {

        $result = $this->conn->getAll("SELECT ins_reg.institution_register_id,ins_reg.email_id,ins_reg.mobile_number,ins_reg.contact_person,ins_reg.address,ins_reg.pincode,m_dist.district_name,m_ins.institution_name FROM institution_register AS ins_reg LEFT JOIN m_district AS m_dist ON ins_reg.m_district_code=m_dist.m_district_id LEFT JOIN m_institution AS m_ins ON ins_reg.m_institution_id=m_ins.m_institution_id WHERE ins_reg.is_deleted=0 ORDER BY ins_reg.created_on asc");
        return $result;
    }

    public function registeredInstituteListdot() {

        $result = $this->conn->getAll("SELECT * FROM user_login a WHERE ins_reg.is_deleted=0 ORDER BY ins_reg.created_on asc");
        return $result;
    }

    public function CheckInstitution($id) {

        $result = $this->conn->getRow("select * from institution_register where institution_register_id='$id' and is_deleted=0");
        return $result;
    }

    // Update Institution Registration Id active 
    public function UpdateInstitution($id) {

        $SQL = "SELECT * FROM institution_register WHERE institution_register_id='$id' and is_deleted=0";
        $result = $this->conn->execute($SQL);
        $updateArray = array('is_deleted' => 1);
        $SQL1 = $this->conn->getUpdateSql($result, $updateArray, true);
        $result1 = $this->conn->execute($SQL1);
        return $result1;
    }

    // Insert Institution On User Login Table
    public function InsertInstitution($records) {

        $SQL = "SELECT * FROM user_login WHERE user_login_id=-1";
        $loginRecord = $this->conn->execute($SQL);
        $InsertSQL = $this->conn->getInsertSql($loginRecord, $records);
        //print($InsertSQL);
        $this->conn->execute($InsertSQL);
        return $last_id = $this->conn->insert_Id();
    }

    // Function Check Student Already Registered Or Not
    public function checkRegistration($phone_no, $email_id) {

        $result = $this->conn->getRow("select * from student_registration where (phone_number='$phone_no' or email_id='$email_id') and isactive >= 1 and is_deleted=0");
        return $result;
    }

    // Function Check Student Already Registered Or Not
    public function checkRegistrationstudentlogin($phone_no, $email_id) {

        $result = $this->conn->getRow("select * from student_registration where (phone_number='$phone_no' and email_id='$email_id') and isactive >= 1 and is_deleted=0 and app_phase is null");
        //print_r("select * from student_registration where (phone_number='$phone_no' and email_id='$email_id') and isactive >= 1 and is_deleted=0 and app_phase is null");
        return $result;
    }

    // Function Check Student Details Available On Table Or Not
    public function checkEMIS($table, $emis_id) {

        $result = $this->conn->getRow("select * from $table where emis_id='$emis_id' and status='Approved' and is_deleted=0");
        return $result;
    }

    public function submitRegistration($phone_no, $email, $user_id, $name) {

        $this->conn->execute("INSERT INTO student_registration (student_name,phone_number,email_id,created_by) value ('$name','$phone_no','$email','$user_id')");
        //print_r("INSERT INTO student_registration (student_name,phone_number,email_id,created_by) value ('$name','$phone_no','$email','$user_id')");
        $lastId = $this->conn->insert_Id();
        return $lastId;
    }

    public function InsertOTP($otp, $sent_by, $phone_no, $email) {

        $result = '';
        if ($phone_no and $email) {
            //both mail and mobile

            $this->conn->execute("INSERT INTO otp_verification (otp,expiry,created_by,phone_no,email_id) value ('$otp',NOW() + INTERVAL '10:0' MINUTE_SECOND,'$sent_by','$phone_no','$email')");
            $lastId = $this->conn->insert_Id();
            $result = $lastId;
        } else if ($email and empty(trim($phone_no))) {
            //  mail   only

            $result = false;
            // echo "INSERT INTO otp_verification (otp,expiry,created_by,email_id) value ('$otp',NOW() + INTERVAL '5:0' MINUTE_SECOND,'$sent_by','$email')";
            $result = $this->conn->execute("INSERT INTO otp_verification (otp,expiry,created_by,email_id) value ('$otp',NOW() + INTERVAL '10:0' MINUTE_SECOND,'$sent_by','$email')");
            if ($result) {
                $result = 1;
            }
        } else if ($phone_no and empty(trim($email))) {
            //    mobile only

            $result = false;

            $result = $this->conn->execute("INSERT INTO otp_verification (otp,expiry,created_by,phone_no) value ('$otp',NOW() + INTERVAL '10:0' MINUTE_SECOND,'$sent_by','$phone_no')");
            if ($result) {
                $result = 1;
            }
        }

        return $result;
    }

    public function checkOTP($otp, $phone_no, $email_id) {


        $result = 'false';
        if ($phone_no and $email_id) {
            $result = $this->conn->getRow("select * from otp_verification where phone_no='$phone_no' and email_id='$email_id' and otp='$otp' and expiry >= now() and is_deleted=0");
        } else if ($email_id and empty(trim($phone_no))) {
            $result = $this->conn->getRow("select * from otp_verification where   email_id='$email_id' and otp='$otp' and expiry >= now() and is_deleted=0");
            $result = $result ? true : false;
        } else if ($phone_no and empty(trim($email_id))) {
            $result = $this->conn->getRow("select * from otp_verification where phone_no='$phone_no'   and otp='$otp' and expiry >= now() and is_deleted=0");
            $result = $result ? true : false;
        }


        return $result;
    }

    public function SubmitStudentSchoolDetails($records) {

        $SQL = "SELECT * FROM student_school_details WHERE student_school_details_id=-1";
        $studentInstitutionRecord = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($studentInstitutionRecord, $records);
        $qry_result = $this->conn->execute($SQL);
        // Added By Arul Starts Here
        if (!$qry_result) {
            $this->submitLog('student_school_details', $SQL);
        }
        // Added By Arul Ends Here
        return $this->conn->insert_Id();
    }

    public function submitStudentInstitutionDetails($records) {

        $SQL = "SELECT * FROM student_institution_details WHERE student_institution_details_id=-1";
        $studentInstitutionRecord = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($studentInstitutionRecord, $records);
        $qry_result = $this->conn->execute($SQL);
        // Added By Arul Starts Here
        if (!$qry_result) {
            $this->submitLog('student_institution_details', $SQL);
        }
        return $this->conn->insert_Id();
    }

    public function submitStudentDetails($records) {

        $SQL = "SELECT * FROM student_details WHERE student_details_id=-1";
        $studentRecord = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($studentRecord, $records);
        $qry_result = $this->conn->execute($SQL);
        // Added By Arul Starts Here
        if (!$qry_result) {
            $this->submitLog('student_details', $SQL);
        }
        return $this->conn->insert_Id();
    }

    public function submitStudentBankDetails($records) {

        $SQL = "SELECT * FROM student_bank_details WHERE student_bank_details_id=-1";
        $studentBankRecord = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($studentBankRecord, $records);
        $qry_result = $this->conn->execute($SQL);
        // Added By Arul Starts Here 
        if (!$qry_result) {
            $this->submitLog('student_bank_details', $SQL);
        }
        return $this->conn->insert_Id();
    }

    public function submitStudentNPCLBankDetails($records) {

        $SQL = "SELECT * FROM student_npcl_log WHERE student_npcl_log_id=-1";
        $studentBankRecord = $this->conn->execute($SQL);
        $SQL = $this->conn->getInsertSql($studentBankRecord, $records);
        $qry_result = $this->conn->execute($SQL);
        // Added By Arul Starts Here
        if (!$qry_result) {
            $this->submitLog('student_npcl_log', $SQL);
        }
        return $this->conn->insert_Id();
    }

    public function StudentRegisterList($res) {

        if ($res != '' && $res != 0) {

            $result = $this->conn->getAll("SELECT std_ins.student_registration_no,std_reg.created_by,std_reg.student_registration_id,std_det.student_details_id,std_ins.student_institution_details_id,std_bank_det.student_bank_details_id,std_reg.phone_number,std_reg.email_id,std_det.student_name_emis,md.degree,m_deg_sub.subject,std_ins.reg_date,std_det.emis_id,std_det.aadhaar_no,std_ins.npci_status,std_ins.npci_status_verified_on,std_ins.npci_status_verified_by,sbp.m_bank_branch_id , mbb.branch_name,mb.bank_name "
                    . "FROM student_registration AS std_reg "
                    . "LEFT JOIN student_details AS std_det ON std_reg.student_registration_id = std_det.student_registration_id "
                    . "LEFT JOIN student_institution_details AS std_ins ON std_reg.student_registration_id = std_ins.student_registration_id "
                    . "LEFT JOIN student_bank_details AS std_bank_det ON std_reg.student_registration_id = std_bank_det.student_registration_id "
                    . "LEFT JOIN m_degree md ON std_ins.m_degree_id=md.m_degree_id "
                    . "LEFT JOIN m_degree_subject AS m_deg_sub ON std_ins.m_subject_id = m_deg_sub.m_subject_id "
                    . "LEFT JOIN student_bank_proposed AS sbp ON std_reg.student_registration_id = sbp.student_registration_id "
                    . "LEFT JOIN m_bank_branch AS mbb ON sbp.m_bank_branch_id = mbb.m_bank_branch_id "
                    . "LEFT JOIN m_bank AS mb ON mbb.m_bank_id = mb.m_bank_id "
                    . "where std_reg.created_by='$res' and std_reg.is_deleted=0 "
                    . "ORDER BY std_reg.created_on desc");
        }
        return $result;
    }

    public function getStudentDetails($id) {

        $result = $this->conn->getAll("SELECT std_reg.student_registration_id,std_ins.student_institution_details_id,std_det.student_details_id,std_bank_det.student_bank_details_id,std_reg.phone_number,std_reg.email_id,md.m_degree_id,m_deg_sub.m_subject_id,std_ins.date_of_admission,std_ins.emis_id,std_reg.isactive FROM student_registration AS std_reg LEFT JOIN student_details AS std_det ON std_reg.student_registration_id = std_det.student_registration_id LEFT JOIN student_institution_details AS std_ins ON std_reg.student_registration_id = std_ins.student_registration_id LEFT JOIN student_bank_details AS std_bank_det ON std_reg.student_registration_id = std_bank_det.student_registration_id LEFT JOIN m_degree md ON std_ins.m_degree_id=md.m_degree_id LEFT JOIN m_degree_subject AS m_deg_sub ON std_ins.m_subject_id = m_deg_sub.m_subject_id where std_reg.student_registration_id ='$id' and std_reg.is_deleted=0");
        return $result;
    }

    public function getStudentDetailsByID($id) {

        //echo "select * from student_registration where student_registration_id='$id' where is_deleted=0";
        $result = $this->conn->getRow("select * from student_registration where student_registration_id='$id' and is_deleted=0");
        return $result;
    }

    public function getStudentInstitutionDetailsByID($id) {

        $result = $this->conn->getRow("select * from student_institution_details where student_registration_id='$id' and is_deleted=0");
        return $result;
    }

    public function getStudentPersonalDetailsByID($id) {

        $result = $this->conn->getRow("select * from student_details where student_registration_id='$id' and is_deleted=0");
        return $result;
    }

    public function getStudentBankDetailsByID($id) {

        $result = $this->conn->getRow("select * from student_bank_details where student_registration_id='$id' and is_deleted=0");
        return $result;
    }

    public function getStudentEMISAadharregistered($emis, $aadhar) {
        $where = '';
        if ($emis != '' && $aadhar != '') {
            $where = " (emis_id='$emis' or aadhaar_no = '$aadhar') ";
        } else if ($emis == '' and $aadhar != '') {
            $where = " aadhaar_no = '$aadhar' ";
        }
        $result = $this->conn->getRow("select * from student_details where $where and is_deleted=0");
        return $result;
    }

    public function getStudentStudentDetailsByID($id) {

        $result = $this->conn->getRow("select * from student_details where student_registration_id='$id' and is_deleted=0");
        return $result;
    }

    public function UpdateJsonfield($key, $table_name, $json_value) {

        $SQL = "UPDATE $table_name SET `access_detail`='$json_value' WHERE  `user_login_id`='$key' and is_deleted=0";

        $result_update = $this->conn->execute($SQL);
        if ($result_update) {

            return true;
        } else {

            return false;
        }
    }

    //user registration
    public function registerNewUser($values) {

        $query_sql = "insert into user_login (m_user_type_id,email_id,pass_word,mobile_number,created_by,is_active)  values(?,?,?,?,?,?) ";
        $qry_exec = $this->conn->Execute($query_sql, $values);

        if ($qry_exec) {
            return $this->conn->insert_Id();
        } else {

            return true;
        }
    }

    //user registration
    //verify  institution email already exist
    public function checkInstitutionsEmailExist($email, $userid) {

        $result = false;
        $result = $this->conn->getRow("select * from user_login where email_id = '$email' and user_login_id !='$userid'  and is_deleted=0");
        return $result;
    }

    //verify institution email already exist
    //verify institution mobile no already exist
    public function checkInstitutionsmobileExist($mobileno, $userid) {
        $result = false;
        $result = $this->conn->getRow("select * from user_login where mobile_number = '$mobileno' and user_login_id !='$userid' and is_deleted=0");

        return $result;
    }

    //verify institution mobile no already exist
    //verify institution mobile no already exist
    public function updateInstitutionNewPassword($table, $records, $where) {
        $result = false;
        $result = $this->conn->autoExecute($table, $records, 'UPDATE', $where);
        return $result;
    }

    //verify institution mobile no already exist
    //update institution details 
    public function updateInstitutionDetails($table, $records, $where) {
        $result = false;
        $result = $this->conn->autoExecute($table, $records, 'UPDATE', $where);
        return $result;
    }

    //update institution details 


    public function updateUserLogin($m_user_type, $username, $password, $user_id) {

        $query_sql = $this->conn->execute("insert into user_login (m_user_type_id,email_id,pass_word,created_by)  values('$m_user_type','$username','$password','$user_id') ");

        if ($query_sql) {

            return $this->conn->insert_Id();
        } else {

            return false;
        }
    }

    public function registerInstituteName($district, $institution_name, $user_id, $dot_institution_type_id) {



        $query_sql = $this->conn->execute('insert into m_institution (m_district_id,institution_name,created_by,m_institution_type_id)  values("' . $district . '","' . $institution_name . '","' . $user_id . '","' . $dot_institution_type_id . '")');

        if ($query_sql) {

            return $this->conn->insert_Id();
        } else {

            return false;
        }
    }

    public function createUsernamePassword($usertype, $prefix_username, $password, $dot_institution_type_id, $autopassword, $institution_id) {


        $query_sql = $this->conn->execute("insert into user_login  (m_user_type_id,lusername,pass_word,created_by,temp_password,m_institution_id)  values ( '$usertype','$prefix_username','$password',$dot_institution_type_id,'$autopassword','$institution_id') ");

        if ($query_sql) {

            return $this->conn->insert_Id();
        } else {

            return false;
        }
    }

    public function createPrefixUsername($m_institute_type_id) {

        $query_sql = $this->conn->getRow("select CONCAT(institution_prefix,LPAD(prefix_serial+1, 4, '0')) AS lusername  from m_institution_type where m_institution_type_id = '$m_institute_type_id'  and is_deleted=0");

        if ($query_sql) {

            return $query_sql;
        } else {

            return false;
        }
    }

    public function checkPrefixExist($prefix_username) {

        $query_sql = $this->conn->getAll("select * from user_login  where lusername = '$prefix_username'   and is_deleted=0");

        if ($query_sql) {

            return $query_sql;
        } else {

            return false;
        }
    }

    public function updatePrefixSerial($m_institution_type) {

        $query_sql = $this->conn->execute("update m_institution_type set prefix_serial = prefix_serial+1 where m_institution_type_id = '$m_institution_type'");
        if ($query_sql) {

            return $query_sql;
        } else {

            return false;
        }
    }

    //getting list of institution by institution type id old 
    public function instituteRegisterListDot($user_id, $m_institute_type, $user_type) {
        $result = false;

        //echo "SELECT  *,a.updated_on as updated_on FROM user_login a  JOIN  m_institution b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON b.m_district_id = c.m_district_id  WHERE a.created_by = '$user_id'  a.m_user_type_id ='$user_type' AND b.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";
        //echo "SELECT  *,a.updated_on as updated_on FROM user_login a  JOIN  m_institution b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON b.m_district_id = c.m_district_id  WHERE  a.m_user_type_id ='$user_type' AND b.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";
        // echo "SELECT  *,a.updated_on as updated_on FROM  m_institution  a left JOIN  user_login b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON a.m_district_id = c.m_district_id  WHERE  b.m_user_type_id ='$user_type' AND a.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";

        $result = $this->conn->getAll("SELECT *,UPPER(a.institution_name) as institution_name, a.m_institution_id as m_institution_id,b.updated_on as last_updated_on FROM m_institution a left JOIN user_login b ON a.m_institution_id = b.m_institution_id left JOIN m_district c ON a.m_district_id = c.m_district_id WHERE  a.m_institution_type_id = '" . $m_institute_type . "' AND a.is_deleted = '0'   order by b.updated_on desc ");

        return $result;
    }

    //getting list of institution by institution type id old


    public function instituteRegisterListDotByDistrict($user_id, $district_id, $user_type) {
        $result = false;

        //echo "SELECT  *,a.updated_on as updated_on FROM user_login a  JOIN  m_institution b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON b.m_district_id = c.m_district_id  WHERE a.created_by = '$user_id'  a.m_user_type_id ='$user_type' AND b.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";
        //echo "SELECT  *,a.updated_on as updated_on FROM user_login a  JOIN  m_institution b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON b.m_district_id = c.m_district_id  WHERE  a.m_user_type_id ='$user_type' AND b.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";
        // echo "SELECT  *,a.updated_on as updated_on FROM  m_institution  a left JOIN  user_login b ON a.m_institution_id = b.m_institution_id  JOIN m_district c ON a.m_district_id = c.m_district_id  WHERE  b.m_user_type_id ='$user_type' AND a.m_institution_type_id = '$m_institute_type' AND a.is_deleted = '0' AND b.is_deleted = '0' order by a.updated_on desc ";

        $result = $this->conn->getAll("SELECT *,UPPER(a.institution_name) as institution_name, a.m_institution_id as m_institution_id,b.updated_on as last_updated_on,a.m_institution_type_id as institution_type_id FROM m_institution a left JOIN user_login b ON a.m_institution_id = b.m_institution_id left JOIN m_district c ON a.m_district_id = c.m_district_id WHERE  a.m_district_id = '" . $district_id . "' AND a.is_deleted = '0'   order by b.updated_on desc ");

        //echo "SELECT *,a.m_institution_id as m_institution_id,b.updated_on as last_updated_on,a.m_institution_type_id as institution_type_id FROM m_institution a left JOIN user_login b ON a.m_institution_id = b.m_institution_id left JOIN m_district c ON a.m_district_id = c.m_district_id WHERE  a.m_district_id = '".$district_id."' AND a.is_deleted = '0'   order by b.updated_on desc ";




        return $result;
    }

    function UpdateNPCICount($student_registration_id, $updated_by) {
        $cur_date = date("Y-m-d H:i:s");
        $SQL = "UPDATE student_institution_details SET npci_fetch_count = npci_fetch_count+1,npci_fetch_date = '{$cur_date}',npci_status_verified_by='{$updated_by}' "
                . "WHERE student_registration_id = '{$student_registration_id}' and is_deleted=0";
        $result_update = $this->conn->execute($SQL);
        if ($result_update) {
            return true;
        } else {
            return false;
        }
    }

    // Added By Arul 17-11-2022 Starts Here

    function submitLog($log_type, $log) {

        $table = 'student_registration_log';
        $record = array();
        $record["log_from"] = $log_type;
        $record["log_query"] = $log . " " . SERNAME;
        $record["created_by"] = $_SESSION['user_details']['user_id'];

        $this->conn->autoExecute($table, $record, 'INSERT');
    }

    function SchoolAPILog($param) {

        $SQL = "SELECT * FROM school_api_log WHERE school_api_log_id=-1";
        $fileds = $this->conn->execute($SQL);
        $InsertSQL = $this->conn->getInsertSql($fileds, $param);
        //print($InsertSQL);
        $this->conn->execute($InsertSQL);
        return $last_id = $this->conn->insert_Id();
    }

    // Added By Arul 17-11-2022 Ends Here
}

//class ending
