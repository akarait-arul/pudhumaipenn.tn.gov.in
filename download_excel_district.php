<?php
ini_set('display_errors', 0);
include "valid_login.php";
include_once("./functions/fn_dashboard.php");
require_once('./libraries/PHPExcel/PHPExcel.php');
$m_institution_type_id = implode(",", $_SESSION['user_details']['m_institution_type_id']);
if(is_array($_SESSION['user_details']['district'])) {
    $m_district_id = implode(",", $_SESSION['user_details']['district']);
} else {
    $m_district_id = $_SESSION['user_details']['district'];
}
$param['m_institution_type_id'] = $m_institution_type_id;
$param['m_district_id'] = $m_district_id;
$data_district = DistrictWise($param);
$header = array("SI No","District","Total No of Institutions","No of Institutions logged in","No of Institutions not logged in","Total Application Received","Application auto-approved for all stages","Total Pending","Only School Pending","Only Bank Pending","Both School and Bank Pending");

/* $result_arr = [];
$i = 1;
foreach($data_instituion as $rkey => $rvalue){
    //$data_instituion[$rkey]['Total Pending'] += ((int)$rvalue['Total Application Received'] - (int)$rvalue['Application auto-approved for all stages']);
    $data_instituion[$rkey]['Total Pending'] += ((int)$rvalue['Total Application Received'] - (int)$rvalue['Application auto-approved for all stages']);
	$result_arr[$rkey]['Sl No'] = (string)$i++;
    foreach($rvalue as $k => $v){
        $result_arr[$rkey][$k] = $v;
    }
    
} */
/* print_r($data_instituion);
print_r($result_arr);
die; */
//


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->mergeCells('A1:K1')->setCellValue('A1', 'Pudhumai Penn Scheme - Application Status as on '.date('d-M-Y').' District Wise');

$objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getFill()->applyFromArray(array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'startcolor' => array(
		 'rgb' => '2c7be5'
	)
));

$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getFill()->applyFromArray(array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'startcolor' => array(
		 'rgb' => '2c7be5'
	)
));

$styleArray = array(
	'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'style' => PHPExcel_Style_Border::BORDER_THIN,
	'color' => array('rgb' => 'DDDDDD')
	),
	'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )	
);

$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
$objPHPExcel->getActiveSheet()->mergeCells('G2:K2')->setCellValue('G2', 'Application Pending Details');
$objPHPExcel->getActiveSheet()->getStyle('G2:K2')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('ffffff');
$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->fromArray(
    $header,  // The data to set
    NULL,        // Array values with this value will not be set
    'A3',true );
	
	
$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('ffffff');
$result_arr = array();
$total_arr = array();
$total_no_institution = 0;
$no_of_institutions_logged_in = 0;
$no_of_institutions__not_logged_in = 0;
$total_application_received = 0;
$application_auto_approved_all_stages = 0;
$total_pending = 0;
$pending = 0;
$only_school_pending = 0;
$only_bank_pending = 0;
$both_school_bank_pending = 0;
$sno=1;
foreach ($data_district as $key => $value) {
	$pending = ((int)$value['Total Application Received'] - (int)$value['Application auto-approved for all stages']);
	array_push($result_arr, array(
						
		"S No" => (string)$sno,
		"District" => $value['district_name'],
		"Total No of Institutions" => $value['Total No of Institutions'],
		"No of Institutions logged in"=> $value['No of Institutions logged in'],
		"No of Institutions not logged in"=> $value['No of Institutions not logged in'],
		"Total Application Received"=> $value['Total Application Received'],
		"Application auto-approved for all stages"=> $value['Application auto-approved for all stages'],
		"Total Pending"=>(string)$pending,
		"Only School Pending"=> $value['Only School Pending'],
		"Only Bank Pending"=> $value['Only Bank Pending'],
		"Both School and Bank Pending"=> $value['Both School and Bank Pending']		
	));
	
	$total_no_institution += (int)$value['Total No of Institutions'];
	$no_of_institutions_logged_in += (int)$value['No of Institutions logged in'];
	$no_of_institutions__not_logged_in += (int)$value['No of Institutions not logged in'];
	$total_application_received += (int)$value['Total Application Received'];
	$application_auto_approved_all_stages += (int)$value['Application auto-approved for all stages'];
	$total_pending += $pending;
	$only_school_pending += (int)$value['Only School Pending'];
	$only_bank_pending += (int)$value['Only Bank Pending'];
	$both_school_bank_pending += (int)$value['Both School and Bank Pending'];
$sno++;
}

$total_arr['total_no_institution'] = (string)$total_no_institution;
$total_arr['no_of_institutions_logged_in'] = (string)$no_of_institutions_logged_in;
$total_arr['no_of_institutions__not_logged_in'] = (string)$no_of_institutions__not_logged_in;
$total_arr['total_application_received'] = (string)$total_application_received;
$total_arr['application_auto_approved_all_stages'] = (string)$application_auto_approved_all_stages;
$total_arr['total_pending'] = (string)$total_pending;
$total_arr['only_school_pending'] = (string)$only_school_pending;
$total_arr['only_bank_pending'] = (string)$only_bank_pending;
$total_arr['both_school_bank_pending'] = (string)$both_school_bank_pending; 

$total_count_row = count($result_arr)+4;
//die;

$objPHPExcel->getActiveSheet()->fromArray(
    $result_arr,  // The data to set
    NULL,        // Array values with this value will not be set
    'A4' );
$objPHPExcel->getActiveSheet()->mergeCells('A'.$total_count_row.':B'.$total_count_row.'')->setCellValue('A'.$total_count_row.'', 'Total')->getStyle('A'.$total_count_row.'')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->fromArray(
    $total_arr,  // The data to set
    NULL,        // Array values with this value will not be set
    'C'.$total_count_row.'');

$objPHPExcel->getActiveSheet()->getStyle('A1:K42')->applyFromArray($styleArray);
	
// Set document properties
/* $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file"); */



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Institution Wise Report');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Pudhumai Penn Scheme - Application Status as on '.date('d-M-Y').' District Wise.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>