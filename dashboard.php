<?php
// Start the session
ini_set('max_execution_time', 0);

include "valid_login.php";

//var_dump($_SESSION['user_details']['email_id']);
//print_r($_SESSION);
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
        <link rel="stylesheet" href="assets/css/custom_res.css?v=<?php echo time(); ?> " />

        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                margin: 0;
            }


            .error_field {

                border-color: #e63757 !important;
                padding-right: calc(1.5em + 0.625rem);
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e63757'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e63757' stroke='none'/%3e%3c/svg%3e") !important;

                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.15625rem) center;
                background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);


            }

            .email_otpval,
            .mobile_otpval {

                background-image: none;


            }

            .verified_field {
                border-color: #00d27a;
                padding-right: calc(1.5em + 0.625rem);
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2300d27a' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.15625rem) center;
                background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);
            }

            .pdf_visible tr th {

                vertical-align: middle ! important;
            }

            .pdf_visible .tablesorter-header {
                background-image: none;
            }
        </style>
    </head>

    <body id="pdfbody">
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main user-type-id-10" id="top">
            <div class="container-fluid" data-layout="container">
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
                    <!-- Div Sudent Registration Starts Here -->
                    <div class="card mt-2">

                        <?php
                        if ($_SESSION['user_details']['user_type'] == 31) {
                            include("dashboard_ins.php");
                        } else {
                            include("dashboard_other.php");
                        }
                        ?>
                    </div>

                    <?php
                    include('footer1.php')
                    ?>

                    <!-- ===============================================-->
                    <!--    End of Main Content-->
                    <!-- ===============================================-->
                    <?php include('footer_script.php') ?>
                    </main>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    </body>
                    <script src="assets/jsPDF/dist/jspdf.umd.js"></script>
                    <script src="assets/jsPDF/html2canvas/html2canvas.js"></script>
                    <script>
                        window.jsPDF = window.jspdf.jsPDF;

                        // Convert HTML content to PDF




                        function downloadPDF() {

                            $(".pdf_visible").removeClass("d-none");

                            $(".pdf_hide").addClass("d-none");


                            $(".highcharts-button-symbol").addClass("d-none");



                            var element = document.getElementById("pdfbody");


                            html2canvas(element, {
                                logging: false,
                                useCORS: true
                            }).then(function (canvas) {
                                var pdf = new jsPDF('p', 'mm', 'a4'); //A4 paper, portrait
                                var ctx = canvas.getContext('2d'),
                                        a4w = 200,
                                        a4h = 275, //A4 size, 210mm x 297mm, 10 mm margin on each side, display area 190x277
                                        imgHeight = Math.floor(a4h * canvas.width / a4w), //Convert pixel height of one page image to A4 display scale
                                        renderedHeight = 0;

                                while (renderedHeight < canvas.height) {
                                    var page = document.createElement("canvas");
                                    page.width = canvas.width;
                                    page.height = Math.min(imgHeight, canvas.height - renderedHeight);

                                    page.getContext('2d').putImageData(ctx.getImageData(0, renderedHeight, canvas.width, Math.min(imgHeight, canvas.height - renderedHeight)), 0, 0);
                                    //Add an image to the page with a 10 mm / 20 mm margin
                                    pdf.addImage(page.toDataURL('image/jpeg', 1.0), 'JPEG', 6, 6, a4w, Math.min(a4h, a4w * page.height / page.width));

                                    renderedHeight += imgHeight;
                                    if (renderedHeight < canvas.height)
                                        pdf.addPage(); //Add an empty page if there is more to follow
                                    //delete page;
                                }

                                var todaydate_obj = new Date();
                                var hours = todaydate_obj.getHours();

                                var ampm = hours >= 12 ? 'pm' : 'am';

                                var datevalue = ('0' + todaydate_obj.getDate()).slice(-2) + todaydate_obj.toLocaleString('en-US', {
                                    month: 'short'
                                }).toUpperCase() + todaydate_obj.getFullYear() + '_' + ('0' + todaydate_obj.getHours()).slice(-2) + ('0' + todaydate_obj.getMinutes()).slice(-2) + ampm;



                                pdf.save('PPS_dashboard_ason_' + datevalue + '.pdf');


                            });


                            $(".pdf_visible").addClass("d-none");
                            $(".pdf_hide").removeClass("d-none");
                            $(".highcharts-button-symbol").removeClass("d-none");




                        }
                    </script>

                    </html>