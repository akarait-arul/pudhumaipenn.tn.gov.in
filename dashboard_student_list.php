<?php
/* echo'<pre>';
  print_r($_SERVER);
  echo $_SERVER['HTTP_REFERER']; */
ini_set('max_execution_time', 0);
include "valid_login.php";
include_once("./functions/fn_dashboard.php");

if (isset($_GET['inst_id']) && isset($_GET['callfor'])) {

    $institution_id = base64_decode($_GET['inst_id']);
    $callfor = base64_decode($_GET['callfor']);
    $param['institution_id'] = $_GET['inst_id'];
    $param['callfor'] = $_GET['callfor'];
    $title = base64_decode($_GET['callfor']);
    $dis_url = '';
    if (isset($_GET['dist'])) {
        $param['dist'] = $_GET['dist'];
        $dis_url = '&dist=' . $_GET['dist'];
    }

    $inst_url = '';
    $inst_type_url = '';
    if (isset($_GET['inst_type'])) {
        $param['inst_type'] = $_GET['inst_type'];
        $inst_type_url = '&inst_type=' . $_GET['inst_type'];
    }

    if (isset($_GET['inst_name']) && $_GET['inst_name'] != null) {
        $title .= ' [ ' . base64_decode($_GET['inst_name']) . ' ]';
    }
    $excel_url = '?inst_name=' . $_GET['inst_name'] . '&inst_id=' . $_GET['inst_id'] . '&callfor=' . $_GET['callfor'] . $dis_url . $inst_type_url;

    $getstudentlist = getStudentList($param);
    //$url = 'dist='.$_GET['dist'].'&inst_type='.$_GET['inst_type'].'&callfor='.$_GET['callfor'];
}
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include('header_script.php') ?>
        <!-- ===============================================-->
        <!--    CDN-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom_res.css" rel="stylesheet" type="text/css"/>
        <script>
            $(document).ready(function () {
                $('#reportTable').DataTable({
                    "dom": '<"top">frt<"bottom"lip><"clear">',
                    paging: true,
                    ordering: true,
                    info: true,
                    lengthMenu: [10, 25, 50, 100, 'All']
                });
            });
        </script>
    </head>

    <body>
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
            <div class="container-fluid" id="dashboard-ins" data-layout="container">
                <?php
                if ($_SESSION['user_details']['user_type'] == 10) {
                    include('topnav_10.php');
                } else {
                    include('sideNav.php');
                }
                ?>
                <div class="content">
                    <?php
                    if ($_SESSION['user_details']['user_type'] != 10) {
                        include('topnav.php');
                    }
                    ?>
                    <div class="col-12 mt-1">
                        <div class="card">
                            <h5 class="card-header card-title text-center">Pudhumai Penn Scheme - Application Status as on <?php echo date('d-M-Y'); ?> <br/> 
                                <span style="color:blue;"><?php echo $title; ?></span></h5>
                        </div>
                    </div>




                    <div class="card mt-0">

                        <div id="table-dbinswise">

                            <div class="table-responsive scrollbar">
                                                <div class="text-right back-to-dash-button">
                                                    <a id="href_excel" href="download_excel_student_list.php<?php echo $excel_url; ?>"><span class="fas fa-file-excel text-warning fs-3 ms-1" data-fa-transform="down-1"></span></a>
                                                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary btn-sm">Back To Dashboard </a>
                                                </div>
                                <table id="reportTable" class="table2excel table table-bordered table-striped fs--1 mb-0">

                                    <thead>                                        
                                        <tr class="bg-primary text-light">

                                            <th class="align-middle text-center">Sl No</th>
                                            <th scope="col">Application #</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Mobile #</th>
                                            <th scope="col">Email ID</th>													
                                            <th scope="col">EMIS #</th>
                                            <th scope="col">Aadhaar #</th>
                                            <th scope="col">Reg Date</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col" class="">View</th>                                                              

                                        </tr>

                                    </thead>

                                    <tbody class="list">

                                            <?php
                                            //echo'<pre>';     print_r($getstudentlist);
                                            $sno = 1;
                                            foreach ($getstudentlist as $key => $value) {

                                                $encrypt_reg_id = encryptValue($key);
                                                /*
                                                  $aadhaarnosplit = str_split($value['aadhaar_no'], 8);
                                                  $aadhaarno_lastfour = $aadhaarnosplit[1];
                                                  $aadhaar_mask = 'XXXXXXXX' . $aadhaarno_lastfour;
                                                 */
                                                // Date COnversion
                                                /* $result1 = date('d-m-Y', strtotime($value['reg_date']));
                                                  $date = DateTime::createFromFormat('d-m-Y', $result1);
                                                  $result_date = $date->format('d-M-Y');
                                                 * 
                                                 */
                                                $emis_id = $value['emis_id'] == 0 ? 'No EMIS' : $value['emis_id'];
                                                echo '<tr>
                                                        <td class="align-middle">' . $sno . '</td>
                                                        <td class="align-middle">' . $value['student_registration_no'] . '</td>
                                                        <td class="align-middle">' . $value['student_name'] . '</td> 
                                                        <td class="align-middle">' . $value['phone_number'] . '</td>
                                                        <td class="align-middle">' . $value['email_id'] . '</td>
                                                        <td class="align-middle text-start">' . $emis_id . '</td>                                    
                                                        <td class="align-middle text-start">' . $value['aadhaar_no'] . '</td>
                                                        <td class="align-middle text-start">' . $value['reg_date'] . '</td>
                                                        <td class="align-middle text-start">' . $value['degree'] . '</td>
                                                        <td class="align-middle text-start">' . $value['subject'] . '</td>
                                                        <td><a href="student_profile.php?id=' . $encrypt_reg_id . '&from=dash" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                                    </tr>';

                                                $sno++;
                                            }
                                            ?>  

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php include('footer1.php'); ?>

                    <!-- ===============================================-->
                    <!--    End of Main Content-->
                    <!-- ===============================================-->
                    <?php include('footer_script.php') ?>
                </div>
        </main>
    </body>
</html>