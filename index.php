<?php
session_start();
 
if( isset($_SESSION['user_details']['user_type']) and !empty($_SESSION['user_details']['user_type'])  and isset($_SESSION['user_details']['user_id'])  and !empty($_SESSION['user_details']['user_id']) ){

  header('Location: dashboard.php');

}  


?>



<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - College Login</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="./assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="./assets/js/config.js"></script>
    <script src="./vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="./assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <!-- Custom Files Include Starts Here -->
    <link rel='stylesheet' href="./assets/css/custom.css" rel="stylesheet" id="user-style-default">
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" rel="stylesheet" id="user-style-default">
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" id="user-style-default">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!--             sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">
    <!--             sweet alert  -->
    <!--               loader links     -->
    <script src="./vendors/preloader/js/jquery.preloader.min.js"></script>
    <link rel="stylesheet" href="./vendors/preloader/css/preloader.css">
    <!--               loader links    -->
    <!-- Custom Files Include Ends Here -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <style>
      .scolar-home-image{
        /* The image used */
        /* background-image: url("./assets/img/index_bg/bg.jpg"); */
        /* Full height */
      
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      

      .student-login-icon-link {
        pointer-events: auto;
        text-decoration: none !important;
      }
      .home-content-login {
        display: none;
      }
      .footer-login {
        display: block;
      }
      .carousel-item img {
        width: 100%;
      }

      @media only screen and (max-width: 600px) {
        #bg_img {
          width: 100%;
          height: 100%;
        }
      }
      @media only screen and (min-width: 992px) {
        .carosael-item-bg-1 {
          background-image: url("./assets/img/index_bg/bg.jpg");
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        .carosael-item-bg-2 {
          background-image: url("./assets/img/index_bg/bg.jpg");
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        .carosael-item-bg-3 {
          background-image: url("./assets/img/index_bg/bg.jpg");
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        .carousel-item img {
          display: none !important;
        }
      }
      @media only screen and (min-width: 1500px) {
        .scolar-home-image {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 60%;
        }
        .scolar-home-content {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 40%;
        }
        .home-content-login {
          display: block;
        }
        .footer-login {
          display: none;
        }
    }
    @media only screen and (min-width: 1902px) {
        .scolar-home-image {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 70%;
        }
        .scolar-home-content {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 30%;
        }
    }

    </style>
  </head>
  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <div class="container-fluid">

    
      <div class="row">
      
        <div class="col-lg-6 scolar-home-image">
        <!-- <img id="bg_img" src="./assets/img/index_bg/bg.jpg" class="img-fluid"></img> -->

        <!--Carousel-->
          <div id="carouselExampleInterval" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
              <div class="carousel-item active h-100 carosael-item-bg-1" data-bs-interval="10000">
                <img src="./assets/img/index_bg/bg.jpg " class="d-block" alt="#">
              </div>
              <div class="carousel-item h-100 carosael-item-bg-2" data-bs-interval="2000">
                <img src="./assets/img/index_bg/bg.jpg" class="d-block" alt="#">
              </div>
              <div class="carousel-item h-100 carosael-item-bg-3">
                <img src="./assets/img/index_bg/bg.jpg" class="d-block" alt="#">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        <!--Carousel-->
        </div>


        <div class="col-lg-6 scolar-home-content">
          <!--EMIS START-->
            <div class="d-grid pt-5 text-center d-none">
              <a href="emis_screen.php">
                <button class="btn  fw-bold" style="background: linear-gradient( 180deg, #032a5eeb 0%, rgb(5 128 174 / 65%) 100% );color: white;color: white;" type="button">Know Your EMIS ID</button>
              </a>
            </div>
          <!--EMIS END-->

          <!--CARD-->
            <div class="card text-center mt-3" style="background-color: #ddf3fe;">
              <div class="card-header" style=" padding-bottom: 5px;background-color:#2c7be5;padding-top: 5px;height: 42px;">
                <h4 class="link-light mb-4 font-Times New Roman-Serif fs-2 d-inline-block">Pudhumai Penn Scheme</h4>
              </div>
              <div class="card-body">
                <p class="opacity-100 text-black font-Times New Roman-Serif text-justify fs-1">The Government of TamilNadu has launched Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme to enhance the enrolment ratio of girls from Government schools to Higher Education Institutions. Through this scheme, the financial assistance of Rs. 1000/month will be provided to the girls till their completion of UG degree/Diploma/ITI/any other recognized course. The incentive amount under this scheme will be disbursed directly into the student’s Bank Account.</p>
              </div>
              <!-- <div class="card-footer text-muted"></div> -->
            </div>
          <!--CARD-->


          <!--LOGIN-->

          <div class="card text-center mt-3 home-content-login" style="background-color: #ddf3fe;">
                  <div class="card-header" style="padding-bottom: 5px;background-color:#2c7be5;padding-top: 5px;height: 42px;">
                    <h4 class="link-light mb-4 font-Times New Roman-Serif fs-2 d-inline-block ">Login</h4>
                  </div>
                  <div class="card-body" style="padding-top: 25px;">
                    <div class="row set-space-row icon-login justify-content-center" id="show_LOGIN_OPTIONS">
                    
                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-3 p-0" style="border-right: 1px solid;">
                        <div class="row set-space-row icon-login justify-content-center">
                          <a href="linstitution.php" style="pointer-events: auto;text-decoration: none !important;" class="student-login-icon-link">
                            <div class="student-login-icon-div cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="College Login">
                              <img src="assets/img/icons/login/college.png" class="rounded mx-auto d-block pe-0" style=" height:90px;">
                              <h6 class="fs-1" style="margin-top: 15px;">Institution / College</h6>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-4 p-0" style="border-right: 1px solid;">
                        <div class="row set-space-row icon-login justify-content-center">
                          <a href="ldepartment.php" style="pointer-events: auto;text-decoration: none !important;" class="student-login-icon-link pe-0">
                            <div class="student-login-icon-div cursor-pointer start-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Officers Login">
                              <img src="assets/img/icons/login/professor.png" class="img-fluid student-login-icon " style=" height:90px;">
                              <h6 class="fs-1" style="margin-top: 15px;">Department</h6>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-5 ">
                        <div class="row set-space-row icon-login justify-content-center">
                          <a href="lwelfare.php" class="student-login-icon-link pe-0">
                            <div class="student-login-icon-div cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Social Welfare Dept. Login">
                              <img src="assets/img/icons/login/welfare.png" class="img-fluid student-login-icon" style="height:90px">
                              <h6 class="fs-1" style="margin-top: 15px;">Social Welfare Department</h6>
                            </div>
                          </a>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <!--    <div class="card-footer text-muted"></div> -->
                </div>
          <!--LOGIN-->


          
        </div>

      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="footer-login">
        <!--LOGIN-->

        <div class="card text-center mt-3" style="background-color: #ddf3fe;">
          <div class="card-header" style="padding-bottom: 5px;background-color:#2c7be5;padding-top: 5px;height: 42px;">
            <h4 class="link-light mb-4 font-Times New Roman-Serif fs-2 d-inline-block ">Login</h4>
          </div>
          <div class="card-body" style="padding-top: 25px;">
            <div class="row set-space-row icon-login justify-content-center" id="show_LOGIN_OPTIONS">
            
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-3 p-0" style="border-right: 1px solid;">
                <div class="row set-space-row icon-login justify-content-center">
                  <a href="linstitution.php" style="pointer-events: auto;text-decoration: none !important;" class="student-login-icon-link">
                    <div class="student-login-icon-div cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="College Login">
                      <img src="assets/img/icons/login/college.png" class="rounded mx-auto d-block pe-0" style=" height:90px;">
                      <h6 class="fs-1" style="margin-top: 15px;">Institutes / College</h6>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-4 p-0" style="border-right: 1px solid;">
                <div class="row set-space-row icon-login justify-content-center">
                  <a href="ldepartment.php" style="pointer-events: auto;text-decoration: none !important;" class="student-login-icon-link pe-0">
                    <div class="student-login-icon-div cursor-pointer start-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Officers Login">
                      <img src="assets/img/icons/login/professor.png" class="img-fluid student-login-icon " style=" height:90px;">
                      <h6 class="fs-1" style="margin-top: 15px;">Department</h6>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 show-hide-text-5 ">
                <div class="row set-space-row icon-login justify-content-center">
                  <a href="lwelfare.php" class="student-login-icon-link pe-0">
                    <div class="student-login-icon-div cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Social Welfare Dept. Login">
                      <img src="assets/img/icons/login/welfare.png" class="img-fluid student-login-icon" style="height:90px">
                      <h6 class="fs-1" style="margin-top: 15px;">Social Welfare Department</h6>
                    </div>
                  </a>
                </div>
              </div>
              
            </div>
          </div>
          <!--    <div class="card-footer text-muted"></div> -->
        </div>
        <!--LOGIN-->
      </div>
        <!--footer-->
        <footer class="mt-3 mb-3">
          <div class="text-center">
            <a class="text-reset fw-bold" href="#">Designed and Developed by TNeGA <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> &copy; <?php echo date("Y"); ?></p></a>
          </div>
        </footer>
        <!--footer-->
      </div>
    </div>
    
     <?php @require_once("Config/sname.php"); ?>    
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
  </body>
</html>
