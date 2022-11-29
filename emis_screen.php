<?php

session_start();

//var_dump($_COOKIE['username']);
//unset($_COOKIE[$cookie_name]); 

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
  <title> Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - College Login </title>

  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicons/favicon.ico">
  <link rel="manifest" href="./assets/img/favicons/manifest.json">
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

  <link href="vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />

  <script src="assets/js/flatpickr.js"></script>

  <script src="./vendors/preloader/js/jquery.preloader.min.js"></script>
  <link rel="stylesheet" href="./vendors/preloader/css/preloader.css">
  <!-- Custom Files Include Ends Here -->



  <script>
    (function() {

      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })

    })()
  </script>
</head>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid text-center">
      <div class="row align-items-center">
        <div class="col-4 text-start">
          <img src="assets/img/logos/ex-cm-kalaignar.jpg" class="img-fluid logo rounded-circle float-start">
        </div>
        <div class="col-4 text-center">
          <img src="assets/img/logos/tamilnadu_logo.png" class="img-fluid">
        </div>
        <div class="col-4 text-end">
          <img src="assets/img/logos/hon-cm-mkstalin.jpg" class="img-fluid logo rounded-circle float-end">
        </div>
      </div>
      <div class="row ">
        <div class="col-md-12">
          <h4 class="sub-heading">
            <small>
              Government Of Tamil Nadu
            </small>
          </h4>
          <h3 class="main-heading text-sm-center">
            Department of Social Welfare and Women Empowerment</h3>
        </div>
      </div>

       <div class="container">
        <div class="row">
          <div class="col"></div>
          <div class="col-md-auto">
            <div class="card" style="width: 20rem;">
            <a href="assets/img/emis/sslc.PNG" trget="_blank">
              <img src="assets/img/emis/sslc.PNG" class="img-fluid rounded-start" alt="..." style="width:300px; height:auto;">
            </a>
              <div class="card-body">
                <h5 class="card-title">Secondary School Leaving Certificate EMIS ID</h5>
                <p class="card-text">Find your SSLC EMIS ID below as highlighted in the image.</p>
               <!--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#know_your_emis"> Know your EMIS </button> -->

              </div>
            </div>
          </div>
          <div class="col-md-auto">
            <div class="card" style="width: 20rem;">
            <a href="assets/img/emis/HSE.PNG" target="_blank">
              <img src="assets/img/emis/HSE.PNG" class="img-fluid rounded-start" alt="..." style="width:300px; height:auto;">
            </a>
              <div class="card-body">
                <h5 class="card-title">Higher Secondary Education EMIS ID</h5>
                <p class="card-text">Find your HSE EMIS ID below as highlighted in the image.</p>
              <!--   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#know_your_emis"> Know your EMIS </button> -->

              </div>
            </div>
          </div>
          <div class="col"></div>
        </div>
        <div class="row mt-3">
          <div class="col-md-5"></div>
          <div class="col-md-2">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#know_your_emis"> Know your EMIS </button>
        
          </div>
          <div class="col-md-5"></div>
          <div class="mb-3">
           <a href="index.php" class="form-check-label mb-0" role="button"> Back to Home Page </a>         
          </div>

        </div>
      </div> 


      

    </div>



  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->



  <!--Modal Start-->

  <div class="modal fade" id="know_your_emis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title" id="staticBackdropLabel"> Know Your EMIS ID </h5>
          
        </div>
        <div class="modal-body ">

           
        <?php include "emis_common_form.php";    ?>
           




        </div>
        <div class="modal-footer"  >
            

          <button type="button" class="btn btn-secondary text-end" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!--Modal End-->


  <!--Include Script-->







  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="./vendors/popper/popper.min.js"></script>
  <script src="./vendors/bootstrap/bootstrap.min.js"></script>
  <script src="./vendors/anchorjs/anchor.min.js"></script>
  <script src="./vendors/is/is.min.js"></script>
  <script src="./vendors/fontawesome/all.min.js"></script>
  <script src="./vendors/lodash/lodash.min.js"></script>
  <script src="./vendors/polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
  <script src="./vendors/list.js/list.min.js"></script>
  <script src="./assets/js/theme.js"></script>



  <script>
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {

          $("#dob_errmsg").hide();

          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();

            if (!$("#student_dob").val()) {
              $("#dob_errmsg").show();
            }

          } else {

            if ($("#student_dob").val()) {

              event.preventDefault();
              event.stopPropagation();

              getEmisDetails();

            } else {



              event.preventDefault();
              event.stopPropagation();

              $("#dob_errmsg").show();

            }




          }

          form.classList.add('was-validated')
        }, false)
      })
    })()



     

    
  </script>


</body>

</html>