<?php

include_once("./Config/db_connect.php");
class WelfareModel
{

    public function __construct()
    {

        $db = new DBConfig();
        $conn = $db->dbConnection();
        $this->conn = $conn;
    }





    public  function getWelfareStudentListByType($filterwhere, $type)
    {


        $result = false;


        if ($type == '1') {
            //approved
            $qry_exec =   $this->conn->getAll("SELECT a.student_registration_no,b.student_registration_id,b.student_name,c.emis_id,b.phone_number,b.email_id,c.aadhaar_no,d.institution_name,f.degree,g.subject,a.reg_date  from student_institution_details a JOIN student_registration b  ON a.student_registration_id = b.student_registration_id   JOIN student_details c ON  a.student_registration_id = c.student_registration_id   JOIN  m_institution d on   a.m_institution_id = d.m_institution_id  JOIN m_district e ON d.m_district_id = e.m_district_id  JOIN m_degree f ON a.m_degree_id = f.m_degree_id JOIN m_degree_subject g ON a.m_subject_id = g.m_subject_id    WHERE a.emis_id_validation= 'Y'  AND emis_id_verified = 'y' AND a.aadhaar_ekyc_status ='1' AND a.npci_status = '1' AND a.is_deleted= '0'  and a.sw_status =  '1' "   . $filterwhere);
        } else if ($type == '2') {
            //pending

            // echo "SELECT b.student_registration_id,b.student_name,c.emis_id,b.phone_number,b.email_id,c.aadhaar_no,d.institution_name,f.degree,g.subject,a.reg_date  from student_institution_details a JOIN student_registration b  ON a.student_registration_id = b.student_registration_id   JOIN student_details c ON  a.student_registration_id = c.student_registration_id   JOIN  m_institution d on   a.m_institution_id = d.m_institution_id  JOIN m_district e ON d.m_district_id = e.m_district_id  JOIN m_degree f ON a.m_degree_id = f.m_degree_id JOIN m_degree_subject g ON a.m_subject_id = g.m_subject_id WHERE a.emis_id_validation= 'Y'  AND emis_id_verified = 'Y' AND a.aadhaar_ekyc_status ='1' AND a.npci_status = '1' AND a.is_deleted= '0' and a.sw_status =  '0' " . $filterwhere;

            $qry_exec =   $this->conn->getAll("SELECT a.student_registration_no,b.student_registration_id,b.student_name,c.emis_id,b.phone_number,b.email_id,c.aadhaar_no,d.institution_name,f.degree,g.subject,a.reg_date  from student_institution_details a JOIN student_registration b  ON a.student_registration_id = b.student_registration_id   JOIN student_details c ON  a.student_registration_id = c.student_registration_id   JOIN  m_institution d on   a.m_institution_id = d.m_institution_id  JOIN m_district e ON d.m_district_id = e.m_district_id  JOIN m_degree f ON a.m_degree_id = f.m_degree_id JOIN m_degree_subject g ON a.m_subject_id = g.m_subject_id WHERE a.emis_id_validation= 'Y'  AND emis_id_verified = 'Y' AND a.aadhaar_ekyc_status ='1' AND a.npci_status = '1' AND a.is_deleted= '0' and a.sw_status =  '0' " . $filterwhere);
        } else if ($type == '3') {
            //rejected

            $qry_exec =   $this->conn->getAll("SELECT a.student_registration_no,b.student_registration_id,b.student_name,c.emis_id,b.phone_number,b.email_id,c.aadhaar_no,d.institution_name,f.degree,g.subject,h.reject_reason,a.reg_date  from student_institution_details a JOIN student_registration b  ON a.student_registration_id = b.student_registration_id   JOIN student_details c ON  a.student_registration_id = c.student_registration_id   JOIN  m_institution d on   a.m_institution_id = d.m_institution_id  JOIN m_district e ON d.m_district_id = e.m_district_id  JOIN m_degree f ON a.m_degree_id = f.m_degree_id JOIN m_degree_subject g ON a.m_subject_id = g.m_subject_id JOIN  m_application_reject_reason h ON  h.m_reject_reason_id = a.sw_m_reason_id   WHERE a.emis_id_validation= 'Y'  AND emis_id_verified = 'y' AND a.aadhaar_ekyc_status ='1' AND a.npci_status = '1' AND a.is_deleted= '0' and a.sw_status =  '2' " . $filterwhere);
        }



        if ($qry_exec) {

            $result =  $qry_exec;
        }


        return $result;
    }



    public function GetWelfareInstitutionTypeByDistrictID($district_id)
    {


        $result = false;


        $qry_exec =   $this->conn->getAll("select DISTINCT(a.m_institution_type_id),b.institution_type from student_institution_details a JOIN m_institution_type b  ON a.m_institution_type_id = b.m_institution_type_id JOIN  m_institution c on   a.m_institution_id = c.m_institution_id  JOIN m_district d ON c.m_district_id = d.m_district_id  WHERE d.m_district_id IN   ('" . $district_id . "')  ");
        if ($qry_exec) {

            $result = $qry_exec;
        }

        return $result;
    }


    public function acceptStudent($table, $records, $where)
    {

        //var_dump($table);

        $result = false;
        $result = $this->conn->autoExecute($table, $records, 'UPDATE', $where);
        return $result;
    }

    public function getRejectResonsList()
    {


        $result = false;


        $qry_exec =   $this->conn->getAll(" select * from m_application_reject_reason where is_deleted = '0'");
        if ($qry_exec) {

            $result = $qry_exec;
        }

        return $result;
    }
} //class ends
