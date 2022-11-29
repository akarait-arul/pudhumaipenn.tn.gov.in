<br/>
<div class="container-fluid" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
        <script src="assets/highchart/highcharts.js" type="text/javascript"></script>
        <script src="assets/highchart/exporting.js" type="text/javascript"></script>
        <script src="assets/highchart/export-data.js" type="text/javascript"></script>
        <script src="assets/highchart/accessibility.js" type="text/javascript"></script>
        <script src="assets/highchart/barchart_int.js" type="text/javascript"></script>
        <div class="col-lg-12 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div data-html2canvas-ignore="true" class="card-header card-title mb-0 d-none d-lg-block d-xl-block">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="inst-bar-order-by-flow" id="inst-bar-order-by-flow-asc" value="asc" autocomplete="off" onclick="institutionTypeBarchart();" checked>
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-flow-asc">Ascending</label>

                        <input type="radio" class="btn-check" name="inst-bar-order-by-flow" id="inst-bar-order-by-flow-desc" value="desc" autocomplete="off" onclick="institutionTypeBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-flow-desc">Descending</label>
                    </div>
                    <div class="btn-group float-right" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="inst-bar-order-by" id="inst-bar-order-by-district" value="institution_type" autocomplete="off" onclick="institutionTypeBarchart();" checked >
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-district" >Institution Type</label>

                        <input type="radio" class="btn-check" name="inst-bar-order-by" id="inst-bar-order-by-total-appl" value="total_app_recd" autocomplete="off" onclick="institutionTypeBarchart();" >
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-total-appl">Total Application</label>

                        <input type="radio" class="btn-check" name="inst-bar-order-by" id="inst-bar-order-by-total-appl-pending" value="total_pending"  autocomplete="off" onclick="institutionTypeBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-total-appl-pending">Total Approval Pending</label>

                        <input type="radio" class="btn-check" name="inst-bar-order-by" id="inst-bar-order-by-total-auto-approved" value="total_app_auto_app_allstage" autocomplete="off" onclick="institutionTypeBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="inst-bar-order-by-total-auto-approved">Total Auto Approved</label>
                    </div>
                </div>
                <!--<h5 class="card-header card-title d-none">Total Application Vs Total Approval Pending<small>   (District wise)</small></h5>-->
                <div class="card-body h-100 pe-0">
                    <figure class="highcharts-figure">
                        <div id="registration-chart-inst" style="padding-right: 20px;"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="assets/highchart/barchart.css" rel="stylesheet" type="text/css"/>
<script>
    /*
     var bar_inst_data = <?php echo $bar_inst_data; ?>;
     var bar_data_inst_heading = '<?php echo $bar_inst_heading; ?>';
     generateColoumChartinst(bar_inst_data, bar_data_inst_heading);
     */
    var bar_data_heading = "Total Application Vs Total Approval Pending [Institution Type Wise] As On <?php echo date('d-M-Y'); ?>";
    $(document).ready(function () {

        institutionTypeBarchart();



    });

    function institutionTypeBarchart() {

        var order_checked = $('input[name=inst-bar-order-by-flow]:checked');
        var order_by = order_checked[0].value;
        var callfor_checked = $('input[name=inst-bar-order-by]:checked');
        var callfor = callfor_checked[0].value;
        $.ajax({

            method: "POST",
            url: "ajax.php",
            data: {

                type: 'GetApplCountInstBarChart',
                callfor: callfor,
                order_by: order_by,
                user_id: 10

            },
            success: function (response) {
                resdata = $.parseJSON(response);
                generateColoumChartinst(resdata, bar_data_heading);

            }

        });

    }

</script>