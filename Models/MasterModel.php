<?php

include_once("./Config/db_connect.php");

class MasterModel {

    public function __construct() {

        $db = new DBConfig();
        $conn = $db->dbConnection();
        $this->conn = $conn;
    }

    ####################

    // Get School Name By id
    public function GetSchoolName($school_id) {

        $result = $this->conn->getRow("select school_name from m_school where udise_code ='$school_id' and is_deleted=0");
        //print("select school_name from m_school where udise_code ='$school_id' and is_deleted=0");
        //var_dump($result);
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    // Get Religion By Religion ID
    public function GetReligionByID($religion_id) {

        $result = $this->conn->getRow("select religion from m_religion where m_religion_id ='$religion_id' and is_deleted=0");
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    // Get Community By Religion ID
    public function GetCommunityByID($religion_id, $community_id) {

        $result = $this->conn->getRow("select community_name from m_community where religion_id ='$religion_id' and m_community_id='$community_id' and is_deleted=0");
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    // Get WelfarestudentRegisterList
    public function WelfarestudentRegisterList() {

        // if($res!='' && $res!=0){

        $result = $this->conn->getAll("SELECT std_reg.student_name,std_reg.phone_number,std_reg.email_id,std_det.emis_id,std_det.aadhaar_no FROM student_institution_details AS std_ins JOIN student_registration AS std_reg ON std_ins.student_registration_id = std_reg.student_registration_id JOIN student_details AS std_det ON std_det.student_registration_id = std_reg.student_registration_id  where emis_id_verified='Y' AND aadhaar_ekyc_status=1 AND npci_status=1 and is_deleted=0");

        //echo "SELECT std_reg.student_name,std_reg.phone_number,std_reg.email_id,std_ins.emis_id_verified,std_ins.aadhaar_ekyc_status,std_ins.npci_status,std_det.emis_id,std_det.aadhaar_no FROM student_institution_details AS std_ins JOIN student_registration AS std_reg ON std_ins.student_registration_id = std_reg.student_registration_id JOIN student_details AS std_det ON std_det.student_registration_id = std_reg.student_registration_id  where emis_id_verified='Y' AND aadhaar_ekyc_status=1 AND npci_status=1";
        //}

        return $result;
    }

    // get institution list by  multiple  institution id
    public function GetAvailableDegreeSubject($institution_id) {

        $result = $this->conn->getRow("select * from m_institution where m_institution_id in($institution_id) and is_deleted=0 ");
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    // get institution list by  multiple  institution id

    public function GetDegreeByID($m_degree_id) {

        $List = implode(', ', $m_degree_id);
        $result = $this->conn->getAll("select * from m_degree where m_degree_id in ($List) and is_deleted=0 order by degree");
        //print($result);
        return $result;
    }

    public function GetInstitutionSubjectByID($m_subject_id) {

        $List = implode(', ', $m_subject_id);
        $result = $this->conn->getAll("select * from m_degree_subject where m_subject_id in ($List) and is_deleted=0 order by subject");
        return $result;
    }

    //get subject by insitution

    public function mDegree($m_institution_id) {

        $result = $this->conn->getAll("select * from m_degree where m_institution_id='$m_institution_id' and is_deleted=0");
        //print_r("select * from m_degree where m_institution_id='$m_institution_id' and is_deleted=0");
        return $result;
    }

    #################

    // Get All Year Of Completion
    public function GetReason($reason_flag) {

        $result = $this->conn->getAll("select reason,m_reason_id from m_reason where reason_flag='$reason_flag' and is_deleted=0 order by m_reason_id asc");
        // print("select reason,m_reason_id from m_reason where reason_flag='$reason_flag' and is_deleted=0 order by m_reason_id asc") ;
        return $result;
    }

    // Get All Year Of Completion
    public function mYearofStudy($subject) {

        $result = $this->conn->getAll("select year_of_study from m_degree_subject where m_subject_id = $subject and is_deleted=0 order by m_subject_id asc");
        return $result;
    }

    // Get All Year Of Completion
    public function mSchoolYear($year_of_completion) {

        $result = $this->conn->getAll("select m_year_of_completion_id,year_of_completion from m_year_of_completion where m_year_of_completion_id < $year_of_completion and is_deleted=0 order by m_year_of_completion_id desc");
        return $result;
    }

    public function mCommunity($religion) {

        $result = $this->conn->getAll("select m_community_id,community_name from m_community where religion_id=$religion and is_deleted=0 order by m_community_id asc");
        //var_dump("select m_community_id,community_name from m_community where religion_id=$religion and is_deleted=0 order by m_community_id asc");
        return $result;
    }

    // Get All Year Of Completion
    public function mReligion() {

        $result = $this->conn->getAll("select m_religion_id,religion from m_religion where is_deleted=0 order by m_religion_id asc");
        return $result;
    }

    // Get All Year Of Completion
    public function mYearOfCompletion($current_year) {

        $result = $this->conn->getAll("select m_year_of_completion_id,year_of_completion from m_year_of_completion where m_year_of_completion_id < $current_year and is_deleted = 0 order by m_year_of_completion_id desc");
        return $result;
    }

    // Get All Year Of Completion
    public function mYearOfSchoolCompletion($current_year) {

        $result = $this->conn->getAll("select m_year_of_completion_id,year_of_completion from m_year_of_completion where m_year_of_completion_id <= $current_year and is_deleted = 0 order by m_year_of_completion_id desc");
        //print("select m_year_of_completion_id,year_of_completion from m_year_of_completion where m_year_of_completion_id < $current_year and is_deleted = 0 order by m_year_of_completion_id desc");
        return $result;
    }

    // Get All Year Of Completion
    public function mAcademicYear($year_of_completion) {

        $result = $this->conn->getAll("select m_year_of_completion_id,year_of_completion from m_year_of_completion where m_year_of_completion_id > $year_of_completion and is_deleted=0 order by m_year_of_completion_id asc");
        return $result;
    }

    public function mDistrict() {

        $result = $this->conn->getAll("select district_code,district_name from m_district where is_deleted=0 and m_state_id=33 order by district_name asc");
        return $result;
    }

    public function mInstitutionType($institution_ids) {

        if ($institution_ids) {


            $result = $this->conn->getAll("select * from m_institution_type where is_deleted=0  and m_institution_type_id in ($institution_ids)");
        } else {

            $result = $this->conn->getAll("select * from m_institution_type where is_deleted=0");
        }


        return $result;
    }

    //get list of institution by institution type id  or  list of institution  by institution type id and district
    public function mInstitutionMapping($m_district_id, $m_institution_type_id) {


        if ($m_district_id == 'all') {

            $result = $this->conn->getAll("select * from m_institution where m_institution_type_id ='$m_institution_type_id' and is_deleted=0 order by institution_name");
            return $result;
        } else {


            $result = $this->conn->getAll("select * from m_institution where m_district_id = '$m_district_id' and m_institution_type_id = '$m_institution_type_id' and is_deleted=0 order by institution_name");
            return $result;
        }
    }

    //get list of institution by institution type id  or  list of institution  by institution type id and district
    // Get all Institution  or get all institution by multiple district
    public function mInstitution($m_district_id) {

        if ($m_district_id == 'all') {

            $result = $this->conn->getAll("select m_institution_id,institution_name from m_institution where   is_deleted=0 order by institution_name");
        } else {

            //echo "select m_institution_id,institution_name from m_institution where m_district_id='$m_district_id' and is_deleted=0 order by institution_name";
            $result = $this->conn->getAll("select m_institution_id,institution_name from m_institution where m_district_id in ('$m_district_id') and is_deleted=0 order by institution_name");
        }

        return $result;
    }

    // Get all Institution  or get all institution by multiple district
    //get  single institution by institution id
    public function getInsituteWiseSubject($institution_id) {

        $result = $this->conn->getRow("select * from m_institution where m_institution_id ='$institution_id' and is_deleted=0 ");
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    //get  single institution by institution id
    //get institution with district  by institution id
    public function institutionDetailsById($institution_id) {


        $result = $this->conn->getRow("select * from m_institution a  JOIN m_district b on a.m_district_id = b.m_district_id where m_institution_id ='$institution_id' AND a.is_deleted= '0' AND b.is_deleted= '0' ");
        if (!$result) {

            $result = false;
        }
        return $result;
    }

    //get institution with district  by institution id



    public function mDegreeSubject($m_degree_id) {

        $result = $this->conn->getAll("select * from m_degree_subject where m_degree_id = '$m_degree_id' and is_deleted=0");
        return $result;
    }

    public function mUserTypesList() {

        $result = $this->conn->getAll("select * from m_user_type where  m_user_type_id !='1000' and is_deleted=0 order by m_user_type_id");
        return $result;
    }

    public function mUserTypeDetails($typeid) {

        $result = $this->conn->getRow("select * from m_user_type where  m_user_type_id  = '" . $typeid . "'  and is_deleted=0 order by m_user_type_id");
        return $result;
    }

    public function mDistrictSchool() {

        $result = $this->conn->getAll("SELECT DISTINCT(district) FROM m_school WHERE is_deleted=0 ORDER BY district asc");
        return $result;
    }

    public function mSchoolDistrictSchool($district) {

        $result = $this->conn->getAll("SELECT udise_code,school_name FROM m_school WHERE district='$district' and management_type='Government' and category_group!='Primary School' and school_type!='Boys' and is_deleted=0 ORDER BY school_name asc");
        return $result;
    }

    public function GetSchoolDistrictList() {

        $result = $this->conn->getAll("select distinct(district) from m_school where is_deleted=0  and management_type='Government' and category_group!='Primary School' and school_type!='Boys'  order by district asc");

        return $result;
    }

    public function GetSchoolBlock($district_name) {

        $result = $this->conn->getAll(" select distinct(block) from m_school WHERE   district IN ('" . $district_name . "')   and management_type='Government' and category_group!='Primary School' and school_type!='Boys'  and is_deleted=0      order BY block    ");
        return $result;
    }

    public function getSchoolNames($block_names, $type) {

        if ($type == '1') {

            $result = $this->conn->getAll(" select trim(school_name) as school_name,udise_code from m_school WHERE   district IN ('" . $block_names . "')  and management_type='Government' and category_group!='Primary School' and school_type!='Boys' and is_deleted=0 order BY trim(school_name)    ");
        } else {

            $result = $this->conn->getAll(" select trim(school_name) as school_name,udise_code from m_school WHERE   block IN ('" . $block_names . "')  and management_type='Government' and category_group!='Primary School' and school_type!='Boys' and is_deleted=0      order BY trim(school_name) ");
        }

        return $result;
    }

    function getDegreeAndSubject($subjectcodes) {
        $result = false;

        $sql_query = $this->conn->getAll("SELECT DISTINCT(m_degree_id) as degree_id ,GROUP_CONCAT(m_subject_id)  as subject_id FROM m_degree_subject  WHERE m_subject_id in ($subjectcodes) and is_deleted=0 group BY m_degree_id   ");

        if ($sql_query) {


            return $result = $sql_query;
        }
        return $result;
    }

    public function updateCourseMapping($institution_id, $table_name, $subjects_degress_json) {
        $userid = $_SESSION['user_details']['user_id'];

        //echo "UPDATE $table_name SET `available_degree_subject`='$subjects_degress_json' WHERE  `m_institution_id`='$institution_id'";
        $SQL = "UPDATE $table_name SET `available_degree_subject`='$subjects_degress_json' , updated_on = now(),updated_by = '$userid'   WHERE  `m_institution_id`='$institution_id'";

        $result_update = $this->conn->execute($SQL);
        if ($result_update) {

            return true;
        } else {

            return false;
        }
    }

    //check institution name exist by name and district
    public function checkInstituteNameExist($institute_name, $district_id) {

        $result = false;
        //$sql_query =  $this->conn->getAll("select * from m_institution where institution_name = '$institute_name' and m_district_id ='$district_id' and is_deleted=0  ");
        $sql_query = $this->conn->getAll('select * from m_institution where institution_name = "' . $institute_name . '" and m_district_id = "' . $district_id . '" and is_deleted=0  ');

        $result = $sql_query;

        return $result;
    }

    //check institution name exist by name and district
    //check mobile otp limit exceeded
    public function checkLockedMobile($mobileno, $type) {

        $result = false;
        if ($type == 1) {

            $sql_query = $this->conn->getRow('select  count(*) as mobile_count from otp_verification where phone_no = "' . $mobileno . '" and is_deleted= "0" AND expiry >=( NOW() - INTERVAL 1 HOUR ) ');
        } else {

            $sql_query = $this->conn->getRow('select  count(*) as mobile_count from otp_verification where emis_no = "' . $mobileno . '" and is_deleted= "0" AND expiry >=( NOW() - INTERVAL 1 HOUR ) ');
        }

        $result = $sql_query;

        return $result;
    }

    //check mobile otp limit exceeded
    // Added By Arul 22-11-2022 Starts Here
    function getBank() {

        $sql_query = $this->conn->getAll('select * from m_bank where is_deleted=0  ');
        $result = $sql_query;
        return $result;
    }

    function getBranch($district, $bank) {
        $sql_query = $this->conn->getAll('select * from m_bank_branch where m_district_id = ' . $district . ' and m_bank_id = ' . $bank . ' and is_deleted=0 order by branch_name asc');
        $result = $sql_query;
        return $result;
    }

    function getBranchDetails($branch) {
        $sql_query = $this->conn->getAll('select * from m_bank_branch where m_bank_branch_id = ' . $branch . ' and is_deleted=0');
        $result = $sql_query;
        return $result;
    }

    function VerifyBankDetails($records) {

        $sql = "SELECT * FROM student_bank_proposed WHERE student_registration_id = {$records['student_registration_id']}";
        $rs = $this->conn->execute($sql);
        if (!$rs->NumRows()) {
            $SQL = "SELECT * FROM student_bank_proposed WHERE student_bank_proposed_id=-1";
            $studentRecord = $this->conn->execute($SQL);
            $SQL = $this->conn->getInsertSql($studentRecord, $records);
            //print($SQL);
            $qry_result = $this->conn->execute($SQL);
        }

        return $this->conn->insert_Id();
    }

    // Added By Arul 22 -11-2022 Ends Here
}

//class ending
