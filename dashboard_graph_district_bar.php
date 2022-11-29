<div class="container-fluid" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
        <script src="assets/highchart/highcharts.js" type="text/javascript"></script>
        <script src="assets/highchart/exporting.js" type="text/javascript"></script>
        <script src="assets/highchart/export-data.js" type="text/javascript"></script>
        <script src="assets/highchart/accessibility.js" type="text/javascript"></script>
        <script src="assets/highchart/barchart.js" type="text/javascript"></script>
        <div class="col-lg-12 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <?php
                if ($_SESSION['user_details']['user_type'] == 10) {
                ?>
                <div data-html2canvas-ignore="true" class="card-header card-title mb-0 d-none d-lg-block d-xl-block">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by-flow" id="dist-bar-order-by-flow-asc" value="asc" autocomplete="off" onclick="districtBarchart();" checked>
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-flow-asc">Ascending</label>

                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by-flow" id="dist-bar-order-by-flow-desc" value="desc" autocomplete="off" onclick="districtBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-flow-desc">Descending</label>
                    </div>
                    <div class="btn-group float-right" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by" id="dist-bar-order-by-district" value="district_name" autocomplete="off" onclick="districtBarchart();" checked >
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-district" >District</label>

                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by" id="dist-bar-order-by-total-appl" value="total_app_recd" autocomplete="off" onclick="districtBarchart();" >
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-total-appl">Total Application</label>

                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by" id="dist-bar-order-by-total-appl-pending" value="total_pending"  autocomplete="off" onclick="districtBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-total-appl-pending">Total Approval Pending</label>

                        <input type="radio" class="btn-check districtBarchart" name="dist-bar-order-by" id="dist-bar-order-by-total-auto-approved" value="total_app_auto_app_allstage" autocomplete="off" onclick="districtBarchart();">
                        <label class="btn btn-outline-primary btn-sm" for="dist-bar-order-by-total-auto-approved">Total Auto Approved</label>
                    </div>
                </div>
                <?php } ?>
                <!--<h5 class="card-header card-title">Total Application Vs Total Approval Pending<small>   (District wise)</small></h5>-->
                <div class="card-body h-100 pe-0">
                    <figure class="highcharts-figure">
                        <div id="registration-chart" style="padding-right: 20px;"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="assets/highchart/barchart.css" rel="stylesheet" type="text/css"/>

<?php
if ($_SESSION['user_details']['user_type'] == 10) {
    ?>
    <script>
        var bar_data_heading_dist = "Total Application Vs Total Approval Pending [District Wise] As On <?php echo date('d-M-Y'); ?>";
        $(document).ready(function () {

            districtBarchart();



        });

        function districtBarchart() {

            var order_checked = $('input[name=dist-bar-order-by-flow]:checked');
            var order_by = order_checked[0].value;
            var callfor_checked = $('input[name=dist-bar-order-by]:checked');
            var callfor = callfor_checked[0].value;
            $.ajax({

                method: "POST",
                url: "ajax.php",
                data: {

                    type: 'GetApplCountDistrictBarChart',
                    callfor: callfor,
                    order_by: order_by,
                    user_id: 10

                },
                success: function (response) {
                    console.log(response);
                    resdata = $.parseJSON(response);
                    generateColoumChart(resdata, bar_data_heading_dist);

                }

            });

        }
    </script>    
    <?php
} else {
    ?>

    <script>

        var bar_data = <?php echo $bar_district_data; ?>;
        var bar_data_heading_dist = '<?php echo $bar_district_heading; ?>';
        generateColoumChart(bar_data, bar_data_heading_dist);

    </script>
    <?php
}
?>
