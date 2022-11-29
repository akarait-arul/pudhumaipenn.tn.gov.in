<?php

ini_set('memory_limit', '1024M');
ini_set('display_errors', 0);
include "valid_login.php";
include_once("./functions/fn_dashboard.php");
require_once('./libraries/PHPExcel/PHPExcel.php');
if (isset($_GET['inst_id']) && isset($_GET['callfor'])) {

    $institution_id = base64_decode($_GET['inst_id']);
    $callfor = base64_decode($_GET['callfor']);
    $param['institution_id'] = $_GET['inst_id'];
    $param['callfor'] = $_GET['callfor'];
    if (isset($_GET['dist'])) {
        $param['dist'] = $_GET['dist'];
    }

    if (isset($_GET['inst_type'])) {
        $param['inst_type'] = $_GET['inst_type'];
    }
    $title = base64_decode($_GET['callfor']);
    if (isset($_GET['inst_name']) && $_GET['inst_name'] != null) {
        $title .= ' [ ' . base64_decode($_GET['inst_name']) . ' ]';
    }
    $get_student_list = getStudentList($param);
}

$header = array("Sl No", "Application", "Student Name", "Mobile", "Email ID", "EMIS", "Aadhaar", "Reg Date", "Department", "Subject");

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
$objPHPExcel->getActiveSheet()->mergeCells('A1:J1')->setCellValue('A1', 'Pudhumai Penn Scheme - Application Status as on ' . date('d-M-Y') . ' - ' . $title . '');

$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => '2c7be5'
    ), 'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'ffffff'),
        'size' => 15,
        'name' => 'Verdana'
    )
));

$styleArray = array(
    'alignment' => array(
        //'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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

$objPHPExcel->getActiveSheet()->fromArray(
        $header, // The data to set
        NULL, // Array values with this value will not be set
        'A2', true);

$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true)
        ->setName('Verdana')
        ->setSize(10)
        ->getColor()->setRGB('ffffff');
$result_arr = array();
$sno = 1;

foreach ($get_student_list as $key => $value) {

    array_push($result_arr, array(
        "S No" => (string) $sno,
        "Student Registration No" => $value['student_registration_no'],
        "Student Name" => $value['student_name'],
        "Phone Number" => " " . $value['phone_number'],
        "Email ID" => $value['email_id'],
        "EMIS ID" => " " . $value['emis_id'],
        "Aadhaar No" => $value['aadhaar_no'],
        "Reg Date" => $value['reg_date'],
        "Degree" => $value['degree'],
        "Subject" => $value['subject']
    ));

    $sno++;
}


$total_count_row = count($result_arr) + 2;

$objPHPExcel->getActiveSheet()->fromArray(
        $result_arr, // The data to set
        NULL, // Array values with this value will not be set
        'A3');

// Set document properties
/* $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
  ->setLastModifiedBy("Maarten Balliauw")
  ->setTitle("Office 2007 XLSX Test Document")
  ->setSubject("Office 2007 XLSX Test Document")
  ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
  ->setKeywords("office 2007 openxml php")
  ->setCategory("Test result file");
 */

$objPHPExcel->getActiveSheet()->getStyle("A1:J{$total_count_row}")->applyFromArray($styleArray);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Institution Wise Report');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Pudhumai Penn Scheme - Application Status as on ' . date('d-M-Y') . ' Institution Wise.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>