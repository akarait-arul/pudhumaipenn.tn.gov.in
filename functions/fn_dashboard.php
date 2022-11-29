<?php

include_once("./Config/db_connect.php");
$db = new DBConfig();
$conn = $db->dbConnection();

function getInstituionType() {
    global $conn;
    $sql = 'SELECT m_institution_type_id,institution_type FROM m_institution_type WHERE is_deleted = 0';
    $result = $conn->getAssoc($sql);
    return $result;
}

function getDistrict() {
    global $conn;
    $sql = 'select district_code,district_name from m_district where is_deleted=0 and m_state_id=33 order by district_name asc';
    $result = $conn->getAssoc($sql);
    return $result;
}

function InstitutionTypeWise($param = false) {
    global $conn;
    $where_ins = "";
    $where_dis = "";
    if ($param) {

        if (strtolower($param['m_institution_type_id']) != "all") {
            $where_ins = " AND m_institution_type_id IN (" . $param['m_institution_type_id'] . ")";
        }
        if (strtolower($param['m_district_id']) != "all") {
            $where_dis = " AND mi.m_district_id IN (" . $param['m_district_id'] . ")";
        }
    }
    $sql = 'SELECT mit.m_institution_type_id, institution_type,
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_dis . ') AS "Total No of Institutions",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_institution_type_id = mit.m_institution_type_id AND m_user_type_id = 31 AND email_id IS NOT NULL and mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_dis . ') AS "No of Institutions logged in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_institution_type_id = mit.m_institution_type_id AND email_id IS NULL AND m_user_type_id = 31 and mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_dis . ') AS "No of Institutions not logged in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id and mi.is_deleted = 0 ' . $where_dis . ') AS "Total Application Received",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 and mi.is_deleted = 0 ' . $where_dis . ') AS "Application auto-approved for all stages",
                0 as "Total Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND npci_status = 1 and mi.is_deleted = 0 ' . $where_dis . ') AS "Only School Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) and mi.is_deleted = 0 ' . $where_dis . ') AS "Only Bank Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL) and mi.is_deleted = 0 ' . $where_dis . ') AS "Both School and Bank Pending"
                FROM m_institution_type mit WHERE m_institution_type_id < 14 ' . $where_ins . ' ORDER BY institution_type';
    //echo $sql;
    //die;
    $result = $conn->getAssoc($sql);

    return $result;
}

function DistrictWise($param = false) {
    global $conn;

    $where_ins = "";
    $where_dis = "";
    if ($param) {
        if (strtolower($param['m_institution_type_id']) != "all") {
            $where_ins = " AND mi.m_institution_type_id IN (" . $param['m_institution_type_id'] . ")";
        }

        if (strtolower($param['m_district_id']) != "all") {
            $where_dis = " WHERE m_district_id IN (" . $param['m_district_id'] . ")";
        }
    }

    $sql = 'SELECT md.m_district_id,district_name,
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_ins . ') AS "Total No of Institutions",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_district_id = md.m_district_id AND m_user_type_id = 31 AND email_id IS NOT NULL AND mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_ins . ') AS "No of Institutions logged in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE mi.m_district_id = md.m_district_id AND email_id IS NULL AND m_user_type_id = 31  AND mi.is_deleted = 0 AND ul.is_deleted=0 ' . $where_ins . ') AS "No of Institutions not logged in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id  AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1  AND mi.is_deleted = 0' . $where_ins . ') AS "Application auto-approved for all stages",
                0 as "Total Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted = 0' . $where_ins . ') AS "Only School Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL)  AND mi.is_deleted = 0' . $where_ins . ') AS "Only Bank Pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL)  AND mi.is_deleted = 0' . $where_ins . ') AS "Both School and Bank Pending"
                FROM m_district md ' . $where_dis . ' ORDER BY district_name';
    $result = $conn->getAssoc($sql);

    return $result;
}

function GetInstitutionDetailList($param = false) {
    global $conn;
    $where_ins = "";
    $where_dis = "";
    if ($param) {

        $m_institution_type_id = base64_decode($param['m_institution_type_id']);
        $m_district_id = base64_decode($param['m_district_id']);
        $callfor = base64_decode($param['callfor']);
        //echo $param['callfor'];die;
        if ($callfor == 'Total No of Institutions') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }

            //echo  $where_ins;
            //die;
        } else if ($callfor == 'No of Institutions logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NOT NULL ";
            } else if (strtolower($m_institution_type_id) == "all") {
                $where_ins = " AND ul.email_id IS NOT NULL ";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.is_deleted=0 AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NOT NULL ";
            } else if (strtolower($m_district_id) == "all") {
                $where_dis = " AND ul.email_id IS NOT NULL ";
            }
        } else if ($callfor == 'No of Institutions not logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NULL ";
            } else if (strtolower($m_institution_type_id) == "all") {
                $where_ins = " AND ul.email_id IS NULL ";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NULL ";
            } else if (strtolower($m_district_id) == "all") {
                $where_dis = " AND ul.email_id IS NULL ";
            }
        } else {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") ";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }
        }
    }

    $sql = 'SELECT mi.m_institution_id,md.district_name,UPPER(TRIM(mi.institution_name)) as institution_name,mit.institution_type,mi.contact_person,ul.email_id,ul.mobile_number,ul.lusername, 
        (SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND mi.is_deleted = 0) AS total_app_recd,
        ((SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND mi.is_deleted = 0) - (SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND sid.is_deleted = 0 AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted = 0)) as total_pending,
        (SELECT COUNT(*) FROM student_institution_details sid  WHERE sid.m_institution_id = mi.m_institution_id and emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted = 0) AS app_auto_approved,
        (SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted = 0 ' . $where_ins . ') AS only_school_pending,
        (SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted = 0 ' . $where_ins . ') AS only_bank_pending,
        (SELECT COUNT(*) FROM student_institution_details sid WHERE sid.m_institution_id = mi.m_institution_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL)  AND mi.is_deleted = 0 ' . $where_ins . ') AS both_bank_school_pending
        FROM user_login ul
        INNER JOIN m_institution mi USING (m_institution_id)
        INNER JOIN m_institution_type mit ON mit.m_institution_type_id = mi.m_institution_type_id
        INNER JOIN m_district md ON md.m_district_id = mi.m_district_id								
        WHERE ul.m_user_type_id = 31 ' . $where_ins . ' ' . $where_dis . '
             AND ul.is_deleted=0 AND mi.is_deleted=0 ORDER BY total_app_recd';

    $result = $conn->getAll($sql);

    return $result;
}

function GetInstitutionDetailsCount($param) {

    global $conn;
    $where_ins = "";
    $where_dis = "";
    $m_institution_type_id = base64_decode($param['m_institution_type_id']);
    $m_district_id = base64_decode($param['m_district_id']);
    $callfor = base64_decode($param['callfor']);
    if ($param) {

        if ($callfor == 'Total No of Institutions') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }
        } else if (trim($callfor) == 'No of Institutions logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NOT NULL ";
            } else if (strtolower($m_institution_type_id) == "all") {
                $where_ins = " AND ul.email_id IS NOT NULL ";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NOT NULL ";
            } else if (strtolower($m_district_id) == "all") {
                $where_dis = " AND ul.email_id IS NOT NULL ";
            }
        } else if ($callfor == 'No of Institutions not logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NULL ";
            } else if (strtolower($m_institution_type_id) == "all") {
                $where_ins = " AND ul.email_id IS NULL ";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NULL ";
            } else if (strtolower($m_district_id) == "all") {
                $where_dis = " AND ul.email_id IS NULL ";
            }
        } else {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }
        }
    }

    $sql = 'SELECT institution_type,COUNT(*) AS inst_count FROM user_login ul
                INNER JOIN m_institution mi USING (m_institution_id)
                INNER JOIN m_institution_type mit ON mit.m_institution_type_id = mi.m_institution_type_id
                INNER JOIN m_district md ON md.m_district_id = mi.m_district_id								
                WHERE ul.m_user_type_id = 31 AND ul.is_deleted=0 AND mi.is_deleted=0 ' . $where_ins . ' ' . $where_dis . '
                GROUP BY mit.m_institution_type_id
                ORDER BY COUNT(*) DESC';

    $result = $conn->getAssoc($sql);

    return $result;
}

function GetDistrictDetailsCount($param) {

    global $conn;
    $where_ins = "";
    $where_dis = "";
    if ($param) {

        $m_institution_type_id = base64_decode($param['m_institution_type_id']);
        $m_district_id = base64_decode($param['m_district_id']);
        $callfor = base64_decode($param['callfor']);

        if ($callfor == 'Total No of Institutions') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }
        } else if ($callfor == 'No of Institutions logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NOT NULL AND ul.mobile_number IS NOT null";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NOT NULL AND ul.mobile_number IS NOT null ";
            }
        } else if ($callfor == 'No of Institutions not logged in') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NULL AND ul.mobile_number IS null";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") AND ul.email_id IS NULL AND ul.mobile_number IS null ";
            }
        } else {
            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }
        }
    }

    $sql = 'SELECT md.district_name,count(mi.institution_name) FROM user_login ul
                INNER JOIN m_institution mi USING (m_institution_id)
                INNER JOIN m_institution_type mit ON mit.m_institution_type_id = mi.m_institution_type_id
                INNER JOIN m_district md ON md.m_district_id = mi.m_district_id								
                WHERE ul.m_user_type_id = 31 AND ul.is_deleted=0 AND mi.is_deleted = 0 ' . $where_ins . ' ' . $where_dis . '
                GROUP BY md.m_district_id
                ORDER BY count(mi.institution_name) DESC';

    $result = $conn->getAssoc($sql);

    return $result;
}

function GetApplicationInstDetailsCount($param) {

    global $conn;
    $where_ins = "";
    $where_dis = "";
    $qry_count = "";
    if ($param) {

        $m_institution_type_id = base64_decode($param['m_institution_type_id']);
        $m_district_id = base64_decode($param['m_district_id']);
        $callfor = base64_decode($param['callfor']);
        //echo $param['callfor'];die;
        if ($callfor == 'Total Application Received') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ")";
            }

            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted=0' . $where_dis . ') AS `Total Application Received`';
        } else if ($callfor == 'Application auto-approved for all stages') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }

            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted = 0 ' . $where_dis . ') AS `Total Application Received`';
        } else if ($callfor == 'Total Pending Application') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }

            $qry_count = '((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted = 0 ' . $where_dis . ') - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted = 0' . $where_dis . ' AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1)) AS `Total Application Received`';
        } else if ($callfor == 'Only School Pending') {
            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted = 0 ' . $where_dis . ') AS `Total Application Received`';
        } else if ($callfor == 'Only Bank Pending') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }

            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted = 0 ' . $where_dis . ') AS `Total Application Received`';
        } else if ($callfor == 'Both School and Bank Pending') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND m_institution_type_id IN (" . $m_institution_type_id . ")";
            }

            if (strtolower($m_district_id) != "all") {
                $where_dis = " AND mi.m_district_id IN (" . $m_district_id . ") ";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted = 0 ' . $where_dis . ') AS `Total Application Received`';
        }
    }

    $sql = 'SELECT tar.institution_type, tar.`Total Application Received` FROM (SELECT institution_type,' . $qry_count . ' FROM m_institution_type mit WHERE m_institution_type_id < 14 ' . $where_ins . ' ) tar ORDER BY `Total Application Received` DESC';

    $result = $conn->getAssoc($sql);

    return $result;
}

function GetApplicationDistDetailsCount($param) {

    global $conn;
    $where_ins = "";
    $where_dis = "";
    $qry_count = "";
    if ($param) {

        $m_institution_type_id = base64_decode($param['m_institution_type_id']);
        $m_district_id = base64_decode($param['m_district_id']);
        $callfor = base64_decode($param['callfor']);
        //echo $param['callfor'];die;
        if ($callfor == 'Total Application Received') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }

            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received"';
        } else if ($callfor == 'Application auto-approved for all stages') {

            if (strtolower($m_institution_type_id) != "all") {
                // $where_ins = "AND mi.is_deleted=0 AND mi.m_institution_type_id IN (" . $m_institution_type_id . ") AND ul.email_id IS NOT NULL AND ul.mobile_number IS NOT null AND ul.is_deleted=0";
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }

            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received"';
        } else if ($callfor == 'Total Pending Application') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }

            $qry_count = '((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted = 0' . $where_ins . ') - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted = 0' . $where_ins . ' AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1)) as total_pending';
        } else if ($callfor == 'Only School Pending') {
            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }
            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received"';
        } else if ($callfor == 'Only Bank Pending') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }

            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received"';
        } else if ($callfor == 'Both School and Bank Pending') {

            if (strtolower($m_institution_type_id) != "all") {
                $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";
            }

            if (strtolower($m_district_id) != "all") {
                $where_dis = " where m_district_id IN (" . $m_district_id . ")";
            }
            $qry_count = '(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted = 0' . $where_ins . ') AS "Total Application Received"';
        }
    }
    $sql = 'SELECT district_name,' . $qry_count . ' FROM m_district md  ' . $where_dis . ' ORDER BY "Total Application Received" DESC';

    //echo $sql;
    $result = $conn->getAssoc($sql);

    return $result;
}

function getDashboardInstitution($m_institution_id) {
    global $conn;
    $sql = "SELECT 
(SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id} AND sid.is_deleted = 0) AS total_app_recd,
(SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id} AND sid.is_deleted = 0 AND emis_id_verified = 'Y' AND aadhaar_ekyc_status = 1 AND npci_status = 1 ) AS total_app_auto_app_allstage,
((SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id} AND sid.is_deleted = 0) - (SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id} AND sid.is_deleted = 0 AND emis_id_verified = 'Y' AND aadhaar_ekyc_status = 1 AND npci_status = 1)) as total_pending,
(SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id}  AND sid.is_deleted = 0 AND emis_id_verified = 'N' AND npci_status = 1) AS total_only_school_pending,
(SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id}  AND sid.is_deleted = 0 AND emis_id_verified = 'Y' AND (npci_status = 0 OR npci_status IS NULL)) AS total_only_bank_pending,
(SELECT COUNT(*) FROM student_institution_details sid WHERE m_institution_id = {$m_institution_id}  AND sid.is_deleted = 0 AND emis_id_verified = 'N' AND (npci_status = 0 OR npci_status IS NULL)) AS total_school_bank_pending";
    $result = $conn->getRow($sql);
    return $result;
}

function getdbinstypebydistrictPie($m_district_id) {
    global $conn;
    $sql = "SELECT institution_type as `name`, count(*) as y, institution_type as drilldown FROM student_institution_details sid "
            . "INNER JOIN m_institution mi USING (m_institution_id) "
            . "INNER JOIN m_institution_type mit ON mit.m_institution_type_id =  mi.m_institution_type_id "
            . "WHERE m_district_id = {$m_district_id} AND sid.is_deleted = 0 AND mi.is_deleted=0 GROUP BY mi.m_institution_type_id ORDER BY institution_type";

    $result = $conn->getAll($sql);
    return $result;
}

function getdbdistrictbyinstypebar($m_institution_type_id) {
    global $conn;

    $where_ins = " AND mi.m_institution_type_id IN (" . $m_institution_type_id . ")";

    $sql = 'SELECT md.m_district_id,0 as "sl_no", district_name,
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_app_recd",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_app_auto_app_allstage",
                ((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted=0 ' . $where_ins . ') - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0' . $where_ins . ')) as "total_pending"
                FROM m_district md ORDER BY district_name';
    $result = $conn->getAll($sql);

    return $result;
}

function getDashboardDistrictCard($param = false) {
    global $conn;

    $where_ins = "";
    $where_dis = "";
    if ($param) {
        if (strtolower($param['m_institution_type_id']) != "all") {
            $where_ins = " AND mi.m_institution_type_id IN (" . $param['m_institution_type_id'] . ")";
        }

        if (strtolower($param['m_district_id']) != "all") {
            $where_dis = " WHERE m_district_id IN (" . $param['m_district_id'] . ")";
        }
    }
    $sql = 'SELECT md.m_district_id,0 as "sl_no", district_name,
                (SELECT COUNT(*) FROM m_institution mi WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted = 0 ' . $where_ins . ') AS "total_inst",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login USING (m_institution_id) WHERE mi.m_district_id = md.m_district_id AND m_user_type_id = 31 AND email_id IS NOT NULL  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_inst_logged_in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login USING (m_institution_id) WHERE mi.m_district_id = md.m_district_id AND email_id IS NULL AND m_user_type_id = 31  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_inst_not_logged_in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_app_recd",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_app_auto_app_allstage",
                ((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND mi.is_deleted=0 ' . $where_ins . ') - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0 ' . $where_ins . ')) as "total_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND npci_status = 1  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_only_school_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL)  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_only_bank_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_district_id = md.m_district_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL)  AND mi.is_deleted=0 ' . $where_ins . ') AS "total_school_bank_pending"
                FROM m_district md ' . $where_dis . ' ORDER BY district_name';
    $result = $conn->getRow($sql);

    return $result;
}

function getDashboardInstitutionCard($param = false) {
    global $conn;
    $where_ins = "";
    $where_dis = "";
    if ($param) {

        if (strtolower($param['m_institution_type_id']) != "all") {
            $where_ins = " AND m_institution_type_id IN (" . $param['m_institution_type_id'] . ")";
        }
        if (strtolower($param['m_district_id']) != "all") {
            $where_dis = " AND mi.m_district_id IN (" . $param['m_district_id'] . ")";
        }
    }
    $sql = 'SELECT mit.m_institution_type_id,0 as "sl_no", institution_type,
                (SELECT COUNT(*) FROM m_institution mi WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted = 0 ' . $where_dis . ') AS "total_inst",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login USING (m_institution_id) WHERE mi.m_institution_type_id = mit.m_institution_type_id AND m_user_type_id = 31 AND email_id IS NOT NULL AND mi.is_deleted=0 ' . $where_dis . ') AS "total_inst_logged_in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login USING (m_institution_id) WHERE mi.m_institution_type_id = mit.m_institution_type_id AND email_id IS NULL AND m_user_type_id = 31 AND mi.is_deleted=0 ' . $where_dis . ') AS "total_inst_not_logged_in",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted=0 ' . $where_dis . ') AS "total_app_recd",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0 ' . $where_dis . ') AS "total_app_auto_app_allstage",
                ((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted=0 ' . $where_dis . ') - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0 ' . $where_dis . ')) as "total_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted=0 ' . $where_dis . ') AS "total_only_school_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted=0 ' . $where_dis . ') AS "total_only_bank_pending",
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL) AND mi.is_deleted=0 ' . $where_dis . ') AS "total_school_bank_pending"
                FROM m_institution_type mit WHERE m_institution_type_id < 14 ' . $where_ins . ' ORDER BY institution_type';
    $result = $conn->getRow($sql);

    return $result;
}

function getDashboardAllCard() {
    global $conn;

    $sql = 'SELECT 
(SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE m_user_type_id = 31 AND ul.is_deleted = 0 and mi.is_deleted=0) AS total_inst,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE m_user_type_id = 31 AND ul.is_deleted = 0 AND email_id IS NOT NULL AND mi.is_deleted=0) AS total_inst_logged_in,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN user_login ul USING (m_institution_id) WHERE ul.is_deleted = 0 AND email_id IS NULL AND m_user_type_id = 31 AND mi.is_deleted=0) AS total_inst_not_logged_in,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.is_deleted=0) AS total_app_recd,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0) AS total_app_auto_app_allstage,
((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.is_deleted=0) - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0 )) as total_pending,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND emis_id_verified = "N" AND npci_status = 1 AND mi.is_deleted=0 ) AS total_only_school_pending,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL ) AND mi.is_deleted=0) AS total_only_bank_pending,
(SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL ) AND mi.is_deleted=0) AS total_school_bank_pending';
    $result = $conn->getRow($sql);

    return $result;
}

function getdbAllbarByDistrict($param=false) {
    global $conn;
    
    $order_by = '';
    if (isset($param)) {

        //Order By Count
        $order_by = '';
        if (isset($param['order_by'])) {

            $order_by = " {$param['callfor']} {$param['order_by']} ";
        }
    }
    
    $sql = 'SELECT md.m_district_id,0 as "sl_no", district_name,
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_district_id = md.m_district_id AND mi.is_deleted=0 ) AS total_app_recd,
                (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0) AS total_app_auto_app_allstage,
                ((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_district_id = md.m_district_id AND mi.is_deleted=0) - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_district_id = md.m_district_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0)) as total_pending
                FROM m_district md ORDER BY ' . $order_by . '';
    $result = $conn->getAll($sql);
    
    //die;
    return $result;
}

function getdbAllbarByInsType($param=false) {
    global $conn;
    
     $order_by = '';
    if (isset($param)) {

        //Order By Count
        $order_by = '';
        if (isset($param['order_by'])) {

            $order_by = " {$param['callfor']} {$param['order_by']} ";
        }
    }
    
    $sql = 'SELECT mit.m_institution_type_id, institution_type,
            (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted=0) AS total_app_recd,
            (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0) AS total_app_auto_app_allstage,
            ((SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_institution_type_id = mit.m_institution_type_id AND mi.is_deleted=0) - (SELECT COUNT(*) FROM m_institution mi INNER JOIN student_institution_details sid ON sid.m_institution_id = mi.m_institution_id WHERE sid.is_deleted = 0 AND mi.m_institution_type_id = mit.m_institution_type_id AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND mi.is_deleted=0)) as total_pending
            FROM m_institution_type mit WHERE m_institution_type_id < 14 ORDER BY ' . $order_by . '';
    $result = $conn->getAll($sql);

    return $result;
}

function getBankNotApprovedList($limit = 10) {
    global $conn;
    /*
      $sql = "SELECT sid.student_institution_details_id, sid.student_registration_id, sd.aadhaar_no,sr.phone_number
      FROM student_institution_details sid
      INNER JOIN student_details sd USING (student_registration_id)
      INNER JOIN student_registration sr USING (student_registration_id)
      WHERE sr.is_deleted = 0 AND (npci_status = 0 OR npci_status IS NULL or npci_status = '')
      AND sid.npci_fetch_count < 3 AND (sid.npci_fetch_date >= (NOW() - INTERVAL 48 HOUR) OR sid.npci_fetch_date IS NULL)
      ORDER BY sid.student_institution_details_id LIMIT 10";
     * 
     */
    $sql = "SELECT sid.student_institution_details_id, sid.student_registration_id, sd.aadhaar_no,sr.phone_number, sid.npci_fetch_count, sid.npci_fetch_date
            FROM student_institution_details sid 
            INNER JOIN student_details sd USING (student_registration_id) 
            INNER JOIN student_registration sr USING (student_registration_id) 
            WHERE sr.is_deleted = 0 AND (npci_status = 0 OR npci_status IS NULL or npci_status = '') 
            AND sid.npci_fetch_count < 3 AND ((sid.npci_fetch_date + INTERVAL 48 HOUR) < NOW() OR sid.npci_fetch_date IS NULL)
            ORDER BY sid.npci_fetch_count, sid.student_institution_details_id LIMIT {$limit}";

    $result = $conn->getAssoc($sql);
    return $result;
}

function encryptValue($inputvalue) {

    if (isset($inputvalue) && !empty($inputvalue)) {

        $privateKey = 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
        $secretKey = '81335c7dbb5ef5fb839060'; // user define secret key
        $encryptMethod = "AES-256-CBC";

        $key = hash('sha256', $privateKey);
        $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
        $result = openssl_encrypt($inputvalue, $encryptMethod, $key, 0, $ivalue);
        $output = base64_encode($result);  // output is a encripted value
    } else {

        $output = false;
    }

    return $output;
}

function getStudentList($param = false) {

    global $conn;
    $where = "";
    $where_ins = "";
    $where_dis = "";
    $where_inst_type = "";

    $institution_id = base64_decode($param['institution_id']);
    if (strtolower($institution_id) != 'all') {
        $where_ins = " AND sid.m_institution_id=$institution_id";
    }

    if (isset($param['dist'])) {
        $district = base64_decode($param['dist']);
        if (strtolower($district) != 'all') {
            $where_dis = " AND mi.m_district_id=$district ";
        }
    }


    if (isset($param['inst_type'])) {
        $inst_type = base64_decode($param['inst_type']);
        if (strtolower($inst_type) != 'all') {
            $where_inst_type = " AND mit.m_institution_type_id=$inst_type ";
        }
    }


    $callfor = base64_decode($param['callfor']);
    //echo $param['callfor'];die;
    if ($callfor == 'Total Application Received') {

        $where = " ";
    } else if ($callfor == 'Application auto-approved for all stages') {

        $where = ' AND emis_id_verified = "Y" AND aadhaar_ekyc_status = 1 AND npci_status = 1 AND sid.is_deleted=0 AND mi.is_deleted=0';
    } else if ($callfor == 'Total Pending Application') {

        $where = ' AND  (npci_status = 0 OR npci_status IS NULL OR sid.emis_id_verified="N") AND sid.is_deleted=0 AND mi.is_deleted=0';
    } else if ($callfor == 'Only School Pending') {
        $where = ' AND emis_id_verified = "N" AND npci_status = 1';
    } else if ($callfor == 'Only Bank Pending') {

        $where = ' AND emis_id_verified = "Y" AND (npci_status = 0 OR npci_status IS NULL) AND sid.is_deleted=0 AND mi.is_deleted=0';
    } else if ($callfor == 'Both School and Bank Pending') {

        $where = ' AND emis_id_verified = "N" AND (npci_status = 0 OR npci_status IS NULL) AND sid.is_deleted=0 AND mi.is_deleted=0';
    }

    $sql = 'SELECT sid.student_registration_id,sid.student_registration_no,sr.student_name,sr.phone_number,sr.email_id,sd.emis_id,CONCAT("XXXXXXXX",LEFT(sd.aadhaar_no, 4)) AS aadhaar_no,DATE_FORMAT(sid.reg_date, "%d-%b-%Y") AS reg_date,md.degree,mds.subject FROM  student_institution_details sid 
                    INNER JOIN student_details sd USING(student_registration_id)
                    INNER JOIN student_registration sr USING (student_registration_id)
                    INNER JOIN m_institution mi USING (m_institution_id) 
                    INNER JOIN m_institution_type mit ON sid.m_institution_type_id = mit.m_institution_type_id
                    INNER JOIN m_degree md ON sid.m_degree_id=md.m_degree_id
                    INNER JOIN m_degree_subject mds ON sid.m_subject_id = mds.m_subject_id
                    WHERE sid.is_deleted=0 AND mi.is_deleted=0 ' . $where_ins . ' ' . $where_dis . ' ' . $where_inst_type . '   ' . $where . '';
//die;
    $result = $conn->getAssoc($sql);
    return $result;
}

//IMPORTANT
//Need to change the dashboard to fetch from readonly DB