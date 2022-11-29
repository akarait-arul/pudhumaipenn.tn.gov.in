<div class="container-fluid" id="dashboard-ins" data-layout="container">
    <div class="row flex-between-center">
    <script src="assets/highchart/highcharts.js" type="text/javascript"></script>
    <script src="assets/highchart/exporting.js" type="text/javascript"></script>
    <script src="assets/highchart/export-data.js" type="text/javascript"></script>
    <script src="assets/highchart/accessibility.js" type="text/javascript"></script>
    <script src="assets/highchart/piechart.js" type="text/javascript"></script>
    <!--pie chart-->
    <div class="col-lg-12 ps-lg-2 mb-3">
        <div class="card h-lg-100">
            <h5 class="card-header card-title">Institution Type Wise</small></h5>
            <div class="card-body h-100 pe-0">
                <figure class="highcharts-figure1">
                    <div id="registration-pie"></div>
                </figure>
            </div>
        </div>
    </div>
    </div>
</div>
<link href="assets/highchart/piechart.css" rel="stylesheet" type="text/css"/>
<script>
    var pie_data = <?php echo $pie_data; ?>;
    generatePieChart(pie_data);
</script>