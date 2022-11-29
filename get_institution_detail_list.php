<?php
include "valid_login.php";
include_once("./functions/fn_dashboard.php");
if (isset($_GET['dist']) && isset($_GET['inst_type']) && isset($_GET['callfor']) && isset($_GET['type'])) {

    $type = base64_decode($_GET['type']);
    $param['m_institution_type_id'] = $_GET['inst_type'];
    $param['m_district_id'] = $_GET['dist'];
    $param['callfor'] = $_GET['callfor'];
    $title = base64_decode($_GET['callfor']);
    if (isset($_GET['dist_name']) && $_GET['dist_name'] != null) {
        $title .= ' [ ' . base64_decode($_GET['dist_name']) . ' ]';
        $url = 'dist_name=' . $_GET['dist_name'] . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&callfor=' . $_GET['callfor'];
    }

    if (isset($_GET['inst_type_name']) && $_GET['inst_type_name'] != null) {
        $title .= ' [' . base64_decode($_GET['inst_type_name']) . ']';
        $url = 'inst_type_name=' . $_GET['inst_type_name'] . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&callfor=' . $_GET['callfor'];
    }
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
        <link rel="stylesheet" href="assets/css/custom_res.css?v=<?php echo time(); ?> "/>
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
                    <!-- Div Sudent Registration Starts Here -->
                    <?php
                    if (isset($_GET['dist_name']) != null) {
                        
                        $data_instituion = GetInstitutionDetailList($param);
                        if (trim($type) == 'inst') {
                            $data_institution_count = GetInstitutionDetailsCount($param);
                        } else if (trim($type) == 'appl') {
                            $data_institution_count = GetApplicationInstDetailsCount($param);                            
                        }        
                        include('districtwise_institution_detail.php');
                    } else if (isset($_GET['inst_type_name']) != null) {
                        $data_instituion = GetInstitutionDetailList($param);

                        if (trim($type) == 'inst') {
                            $data_institution_count = GetDistrictDetailsCount($param);
                        } else if (trim($type) == 'appl') {
                            $data_institution_count = GetApplicationDistDetailsCount($param);
                        } 
                        include('institution_typewise_detail.php');
                    }

                    include('footer1.php')
                    ?>

                    <!-- ===============================================-->
                    <!--    End of Main Content-->
                    <!-- ===============================================-->
                    <?php include('footer_script.php') ?>
                </div>
        </main>
    </body>
</html>