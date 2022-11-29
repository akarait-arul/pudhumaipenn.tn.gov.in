<?php

include_once("./functions/fn_dashboard.php");
$m_institution_type_id = implode(",", $_SESSION['user_details']['m_institution_type_id']);
if (is_array($_SESSION['user_details']['district'])) {
    $m_district_id = implode(",", $_SESSION['user_details']['district']);
} else {
    $m_district_id = $_SESSION['user_details']['district'];
}
$param['m_institution_type_id'] = $m_institution_type_id;
$param['m_district_id'] = $m_district_id;

switch ($_SESSION['user_details']['user_type']) {
    case 30: //Department HOD
        $data_instituion = InstitutionTypeWise($param);
        $data_district = DistrictWise($param);
        $bar_district_data = getdbdistrictbyinstypebar($m_institution_type_id);
        $bar_district_heading = "Total Application Vs Total Approval Pending [District Wise] As On ". date('d-M-Y');
        if(count($bar_district_data) > 0) {
            $bar_district_data = json_encode($bar_district_data,true);
        } else {
            $bar_district_data = false;
        }
        require_once 'dashboard_other_ins_card.php';
        require_once 'dashboard_graph_district_bar.php';
        require_once 'dashboard_other_districtwise.php';
        //require_once 'dashboard_other_inswise.php';
        break;
    case 40: //e District Managers
        $data_instituion = InstitutionTypeWise($param);
        $data_district = DistrictWise($param);
        $pie_data = getdbinstypebydistrictPie($m_district_id);
        if(count($pie_data) > 0) {
            $pie_data = json_encode($pie_data,true);
        } else {
            $pie_data = false;
        }
        require_once 'dashboard_other_distict_card.php';
        require_once 'dashboard_graph_ins_pie.php';
        require_once 'dashboard_other_inswise.php';
        /*
        require_once 'dashboard_other_districtwise.php';
         * 
         */
        break;
    case 50: //District Collector
        $data_instituion = InstitutionTypeWise($param);
        $data_district = DistrictWise($param);
        $pie_data = getdbinstypebydistrictPie($m_district_id);
        if(count($pie_data) > 0) {
            $pie_data = json_encode($pie_data,true);
        } else {
            $pie_data = false;
        }
        require_once 'dashboard_other_distict_card.php';
        require_once 'dashboard_graph_ins_pie.php';
        require_once 'dashboard_other_inswise.php';
        break;
    case 10: // Executive
        $data_instituion = InstitutionTypeWise($param);
        $data_district = DistrictWise($param);
        require_once 'dashboard_other_all_card.php';
        
        /*
        $bar_district_data = getdbAllbarByDistrict();
        $bar_district_heading = "Total Application Vs Total Approval Pending [District Wise] As On ". date('d-M-Y');
        if(count($bar_district_data) > 0) {
            $bar_district_data = json_encode($bar_district_data,true);
        } else {
            $bar_district_data = false;
        } */
        require_once 'dashboard_graph_district_bar.php';
        require_once 'dashboard_other_districtwise.php';
        /*
        $bar_inst_data = getdbAllbarByInsType();
        $bar_inst_heading = "Total Application Vs Total Approval Pending [Institution Type Wise] As On ". date('d-M-Y');
        if(count($bar_inst_data) > 0) {
            $bar_inst_data = json_encode($bar_inst_data,true);
        } else {
            $bar_inst_data = false;
        }*/
        require_once 'dashboard_graph_inst_bar.php';
        require_once 'dashboard_other_inswise.php';
        break;
    case 100:
        $data_instituion = InstitutionTypeWise($param);
        $data_district = DistrictWise($param);
        require_once 'dashboard_other_districtwise.php';
        require_once 'dashboard_other_inswise.php';
        break;
}
?>