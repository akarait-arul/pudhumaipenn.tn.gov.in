<?php
$db_card_details = getDashboardAllCard();
?>
<div class="container-fluid dashboard-other-all-card" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
        <div class="row  g-3 mb-3 mt-0">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header card-title text-center">Application Status as on <?php echo date('d-M-Y'); ?></h5>
                    <div data-html2canvas-ignore="true" class="refresh-page-time cursor-pointer d-none d-lg-block d-xl-block">
                        <i class="fas fa-solid fa-sync fa-spin" title="Dashboard will get refreshed"></i> <span class="pl-2 mr-5" id="refresh-reminnig-time"> </span>
                        <i  onclick="downloadPDF()"  class="fas fa-file-pdf text-danger fs-2"></i>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-1">
                <div class="card">
                    <h5 class="card-header card-title"><i class="fas fa-solid fa-sync fa-spin"></i> <span id="refresh-reminnig-time"> </span></h5>
                </div>
            </div>
            -->
            <div class="col-12">
                <div class="row application-status-card">
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Total application</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_app_recd']) ? number_format($db_card_details['total_app_recd']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title">Total approved for all stages</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_app_auto_app_allstage']) ? number_format($db_card_details['total_app_auto_app_allstage']) : 0); ?>
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
            
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header card-title text-center">Application Approval Pending Details</h5>
                </div>
            </div>

            <div class="col-12">
                <div class="row application-aproval-card">
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Total</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_pending']) ? number_format($db_card_details['total_pending']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Only School</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_only_school_pending']) ? number_format($db_card_details['total_only_school_pending']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Only Bank</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_only_bank_pending']) ? number_format($db_card_details['total_only_bank_pending']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Both School & Bank</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_school_bank_pending']) ? number_format($db_card_details['total_school_bank_pending']) : 0); ?>
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
            
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header card-title text-center">Institutions</h5>
                </div>
            </div>
            <div class="col-12">
                <div class="row instruction-status-card">
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">Total No of Institutions</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_inst']) ? number_format($db_card_details['total_inst']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">No of Institutions logged in</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_inst_logged_in']) ? number_format($db_card_details['total_inst_logged_in']) : 0); ?>
                            </div>
                        </div>
                        <div class="card-footer m-0 text-right d-none">
                            <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                            <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header card-title d-flex align-items-center h-100">No of Institutions not logged in</h5>
                        <div class="card-body">
                            <div class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                <?php echo (isset($db_card_details['total_inst_not_logged_in']) ? number_format($db_card_details['total_inst_not_logged_in']) : 0); ?>
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
    </div>
    <script>      
        $(document).ready(function () {
            var refresh_time_int = "5:00";
            var refresh_interval = "";

            refresh_interval = setInterval(function () {
              var timer = refresh_time_int.split(':');
              //by parsing integer, I avoid all extra string processing
              var minutes = parseInt(timer[0], 10);
              var seconds = parseInt(timer[1], 10);
              --seconds;
              minutes = (seconds < 0) ? --minutes : minutes;
              seconds = (seconds < 0) ? 59 : seconds;
              seconds = (seconds < 10) ? '0' + seconds : seconds;
              $('#refresh-reminnig-time').html('0' + minutes + ':' + seconds);
              if (minutes < 0) {
                      clearInterval(refresh_interval);
                      refresh_time_int = "5:00";
              }
              //check if both minutes and seconds are 0
              if ((seconds <= 0) && (minutes <= 0)) {
                      clearInterval(refresh_interval);
                      refresh_time_int = "5:00";
                      window.location.href = "dashboard.php";
              }
              refresh_time_int = minutes + ':' + seconds;
            }, 1000);
        });        
    </script>
</div>