<?php
ini_set('display_errors', 0);
include "valid_login.php";
include_once("./functions/fn_dashboard.php");
require_once('./libraries/PHPExcel/PHPExcel.php');
if(isset($_GET['dist']) && isset($_GET['inst_type']) && isset($_GET['callfor'])){
	
	//echo $district = base64_decode($_GET['dist']); echo '<br/>';
	//echo $inst_type = base64_decode($_GET['inst_type']);
	//echo $callfor = base64_decode($_GET['callfor']);
    
	$param['m_institution_type_id'] = $_GET['inst_type'];
	$param['m_district_id'] = $_GET['dist'];
	$param['callfor'] = $_GET['callfor'];
        
        //die;
	$data_instituion = GetInstitutionDetailList($param);
        
	$title = base64_decode($_GET['callfor']);
	if(isset($_GET['dist_name']) && $_GET['dist_name']!=null){
		$title.= '( '.base64_decode($_GET['dist_name']) .' )';	
	}
	
	if(isset($_GET['inst_type_name']) && $_GET['inst_type_name']!=null){
		$title.= '('.base64_decode($_GET['inst_type_name']) .')';
	}
}

$header = array("SI No","Institution","Institution Type","District","Contact Person","Email","Mobile Number","Username","Total Application Received","Application auto-approved for all stages","Total Application Pending","Only School Pending","Only Bank Pending","Both School and Bank Pending");


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
$objPHPExcel->getActiveSheet()->mergeCells('A1:N1')->setCellValue('A1', 'Pudhumai Penn Scheme - Application Status as on '.date('d-M-Y').' - '.$title.'');


$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFill()->applyFromArray(array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'startcolor' => array(
        'rgb' => '2c7be5'
	),'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'ffffff'),
        'size'  => 15,
        'name'  => 'Verdana'
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
    $header,  // The data to set
    NULL,        // Array values with this value will not be set
    'A2',true );
	
$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('ffffff');
$result_arr = array();
$sno=1;	

foreach ($data_instituion as $key => $value) {
	
	array_push($result_arr, array(
						
		"S No" => (string)$sno,
		"Institution" => $value['institution_name'],
		"institution_type" => $value['institution_type'],
		"district_name" => $value['district_name'],
		"Contact Person" => $value['contact_person'],
		"Email Id"=> $value['email_id'],
		"Mobile No"=> $value['mobile_number'],
		"Username"=> $value['lusername'],		
		"Total Application Received"=> $value['total_app_recd'],		
		"Application Auto Approved"=> $value['app_auto_approved'],
                "Total Pending"=> $value['total_pending'],
                "Total School Pending"=> $value['only_school_pending'],
                "Total Bank Pending"=> $value['only_bank_pending'],
                "Both School and Bank Pending"=> $value['both_bank_school_pending'],	
	));
		
	$sno++;
}


$total_count_row = count($result_arr)+2;
//die;

$objPHPExcel->getActiveSheet()->fromArray(
    $result_arr,  // The data to set
    NULL,        // Array values with this value will not be set
    'A3' );
	
// Set document properties
/* $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 */
 
$objPHPExcel->getActiveSheet()->getStyle('A1:N'.$total_count_row.'')->applyFromArray($styleArray);
						
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Institution Wise Report');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Pudhumai Penn Scheme - Application Status as on '.date('d-M-Y').' Institution Wise.xls"');
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