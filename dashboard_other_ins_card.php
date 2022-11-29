<?php
$db_card_details = getDashboardInstitutionCard($param);
?>
<div class="container-fluid" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
        <div class="row  g-3 mb-3 mt-0">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header card-title text-center">Application Status as on <?php echo date('d-M-Y'); ?></h5>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header card-title">Total application</h5>
                    <div class="card-body">
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
                            //echo (int) $total_application_received != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total Application Received') . '">' . $total_application_received . '<a></td>' : '<td class="text-center">' . $total_application_received . '</td>';

                            echo $db_card_details['total_app_recd'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total Application Received') . '">' . number_format($db_card_details['total_app_recd']) . '</a>' : 0;
                            ?>
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
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
                            echo $db_card_details['total_app_auto_app_allstage'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Application auto-approved for all stages') . '">' . number_format($db_card_details['total_app_auto_app_allstage']) . '</a>' : 0;

                            // echo (isset($db_card_details['total_app_auto_app_allstage']) ? number_format($db_card_details['total_app_auto_app_allstage']) : 0);
                            ?>
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
                    <h5 class="card-header card-title text-center">Application Approval Pending Details</h5>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header card-title">Total</h5>
                    <div class="card-body">
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
                            //echo (isset($db_card_details['total_pending']) ? number_format($db_card_details['total_pending']) : 0);
                            echo $db_card_details['total_pending'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total Pending Application') . '">' . number_format($db_card_details['total_pending']) . '</a>' : 0;
                            ?>
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
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
                            //echo (isset($db_card_details['total_only_school_pending']) ? number_format($db_card_details['total_only_school_pending']) : 0);
                            echo $db_card_details['total_only_school_pending'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Only School Pending') . '">' . number_format($db_card_details['total_only_school_pending']) . '</a>' : 0;
                            ?>
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
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
                            //echo (isset($db_card_details['total_only_bank_pending']) ? number_format($db_card_details['total_only_bank_pending']) : 0); 
                            echo $db_card_details['total_only_bank_pending'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Only Bank Pending') . '">' . number_format($db_card_details['total_only_bank_pending']) . '</a>' : 0;
                            ?>
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
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
//echo (isset($db_card_details['total_school_bank_pending']) ? number_format($db_card_details['total_school_bank_pending']) : 0); 
                            echo $db_card_details['total_school_bank_pending'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Both School and Bank Pending') . '">' . number_format($db_card_details['total_school_bank_pending']) . '</a>' : 0;
                            ?>
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
                    <h5 class="card-header card-title text-center">Institutions</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header card-title">Total No of Institutions</h5>
                    <div class="card-body">
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
// echo (isset($db_card_details['total_inst']) ? number_format($db_card_details['total_inst']) : 0);
                            echo (int) $db_card_details['total_inst'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total No of Institutions') . '">' . number_format($db_card_details['total_inst']) . '</a>' : 0;
                            ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header card-title">No of Institutions logged in</h5>
                    <div class="card-body">
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
//echo (isset($db_card_details['total_inst_logged_in']) ? number_format($db_card_details['total_inst_logged_in']) : 0); 
                            echo (int) $db_card_details['total_inst_logged_in'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('No of Institutions logged in') . '">' . number_format($db_card_details['total_inst_logged_in']) . '</a>' : 0;
                            ?>
                        </div>
                    </div>
                    <div class="card-footer m-0 text-right d-none">
                        <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                        <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header card-title">No of Institutions not logged in</h5>
                    <div class="card-body">
                        <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            <?php
//echo (isset($db_card_details['total_inst_not_logged_in']) ? number_format($db_card_details['total_inst_not_logged_in']) : 0); 
                            echo (int) $db_card_details['total_inst_not_logged_in'] != 0 ? '<a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&dist_name=' . base64_encode('All') . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('No of Institutions not logged in') . '">' . number_format($db_card_details['total_inst_not_logged_in']) . '</a>' : 0;
                            ?>
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
        /*
         $(document).ready(function () {
         
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
         }, 5);
         }
         
         for (j = 0; j < countersQuantity; j++) {
         count(0, counter[j], j);
         }
         });
         */
    </script>
</div>