<?php
include_once("./functions/fn_dashboard.php");
$m_institution_id = implode(",", $_SESSION['user_details']['institution_id']);
$db_card_details = getDashboardInstitution($m_institution_id);
$institution_id = $_SESSION['user_details']['institution_id'][0];
$institution_name = '';
?>
<div class="container-fluid" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
        <div class="row  g-3 mb-3 mt-0">
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header card-title">Total application</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int) $db_card_details['total_app_recd'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Total Application Received') . '">'. $db_card_details['total_app_recd'] .'</a>' : 0 ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header card-title">Total approved for all stages</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int) $db_card_details['total_app_auto_app_allstage'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Application auto-approved for all stages') . '">'. $db_card_details['total_app_auto_app_allstage'].'</a>' : 0 ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header card-title text-center">Application Pending Details</h5>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header card-title">Total</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int) $db_card_details['total_pending'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Total Pending Application') . '">'. $db_card_details['total_pending'].'</a>' : 0 ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header card-title">Only School</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int) $db_card_details['total_only_school_pending'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Only School Pending') . '">'. $db_card_details['total_only_school_pending'].'</a>' : 0  ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header card-title">Only Bank</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int)$db_card_details['total_only_bank_pending'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Only Bank Pending') . '">'. $db_card_details['total_only_bank_pending'].'</a>' : 0 ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header card-title">Both School & Bank</h5>
                    <div class="card-body">
                        <div class="display-4 fs-3 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php echo (int)$db_card_details['total_school_bank_pending'] !=0 ? '<a href="dashboard_student_list.php?inst_name='. base64_encode($institution_name).'&inst_id=' . base64_encode($institution_id).'&callfor=' . base64_encode('Both School and Bank Pending') . '">'. $db_card_details['total_school_bank_pending'] .'</a>' : 0 ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        /*$(document).ready(function () {

            var counters = $(".count");
            var countersQuantity = counters.length;
            var counter = [];

            for (i = 0; i < countersQuantity; i++) {
                counter[i] = parseInt(counters[i].innerHTML);
            }

            var count = function (start, value, id) {
                var localStart = start;
                setInterval(function () {
                    if (localStart < value) {
                        localStart++;
                        counters[id].innerHTML = localStart;
                    }
                }, 10);
            }

            for (j = 0; j < countersQuantity; j++) {
                count(0, counter[j], j);
            }
        });*/
    </script>
    <?php /*
    <!--highchart-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <div class="row">
        <div class="col-lg-6 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h5 class="mb-0">Registration</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 pe-0">
                    <figure class="highcharts-figure">
                        <div id="registration-chart"></div>
                    </figure>
                </div>
            </div>
        </div>
        <link href="assets/highchart/barchart.css" rel="stylesheet" type="text/css"/>
        <script src="assets/highchart/barchart.js" type="text/javascript"></script>
        <!--pie chart-->
        <div class="col-lg-6 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h5 class="mb-0">Pie chart</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 pe-0">
                    <figure class="highcharts-figure1">
                        <div id="container1"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <link href="assets/highchart/piechart.css" rel="stylesheet" type="text/css"/>
    <script src="assets/highchart/piechart.js" type="text/javascript"></script>
    <!--pie chart-->
    <!--highchart-->
    <!--tabel-->
    <div id="table-dbdistrictwise">
        <div class="table-responsive scrollbar">
            <table class="table table-bordered table-striped fs--1 mb-0">
                <thead>
                    <tr>
                        <th colspan='11' class="h5 align-middle text-center">Pudhumai Penn Scheme - Application Status as on <?php echo date('d-M-Y'); ?> <br /> District Wise 
                            <div class="float-right">
                                <span class="fas fa-file-excel text-warning fs-3 ms-1 cursor-pointer" data-fa-transform="down-1"></span>
                                <span class="fas fa-file-pdf text-success fs-3 ms-1 cursor-pointer" data-fa-transform="down-1"></span>
                            </div>
                        </th>
                    </tr>
                    <tr class="bg-primary text-light">
                        <th class="align-middle text-center" rowspan="2">SI No</th>
                        <th class="align-middle text-center" rowspan="2">District</th>
                        <th class="align-middle text-center" rowspan="2">Total No of Institutions</th>
                        <th class="align-middle text-center" rowspan="2">No of Institutions logged in</th>
                        <th class="align-middle text-center" rowspan="2">No of Institutions not logged in</th>
                        <th class="align-middle text-center" rowspan="2">Total Application Received</th>
                        <th class="align-middle text-center" rowspan="2">Application auto-approved for all stages</th>
                        <th colspan='4' class="align-middle text-center">Application Pending Details</th>
                    </tr>
                    <tr class="bg-primary text-light">
                        <th class="align-middle text-center">Total Pending</th>
                        <th class="align-middle text-center">Only School Pending</th>
                        <th class="align-middle text-center">Only Bank Pending</th>
                        <th class="align-middle text-center">Both School and Bank Pending</th>
                    </tr>
                    <tr class="fw-bold align-middle text-center">
                        <th>(1)</th>
                        <th>(2)</th>
                        <th>(3)</th>
                        <th>(4)</th>
                        <th>(5)</th>
                        <th>(6)</th>
                        <th>(7)</th>
                        <th>(8) = (6) - (7)</th>
                        <th>(9)</th>
                        <th>(10)</th>
                        <th>(11)</th>
                    </tr>
                </thead>
                <tbody class="list">
                </tbody>
            </table><!-- comment -->
        </div>
    </div>
    */ ?>
</div>