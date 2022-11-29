<?php

session_start();





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
  <title>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme - Officer Login </title>

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


</head>
<style>
  .error_field {

    border-color: #e63757 !important;
    padding-right: calc(1.5em + 0.625rem);
    /* background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e63757'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e63757' stroke='none'/%3e%3c/svg%3e") !important; */

    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.15625rem) center;
    background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);


  }


  .mobile_otpval {

    padding-right: 16px;


  }
</style>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid text-center">
      <div class="col-8 align-self-center forgotpass_loader"></div>
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
          <h2 class="sub-heading ">

            Government of Tamil Nadu

          </h2>

        </div>
      </div>

      <div class="row flex-center py-6">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
          <div class="card">
            <div class="card-body p-4 p-sm-5">
              <h5 class="text-center mb-4"> <?php echo $login_for;  ?> Password Reset </h5>
              <form class="row g-3 needs-validation" id="forgot_password_form" name="forgot_password_form" novalidate autocomplete="off">

                <input type="hidden" name="type_id" id="type_id" value="<?php echo $m_user_type_id  ;  ?>">

                <div class="  position-relative">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="user_name"> Registered Email <span style="color:red"> * </span> </label>
                  </div>
                  <?php


                  if ($m_user_type_id == base64_encode(31)) {
                  ?>
                    <input class="form-control" id="user_name" name="user_name" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="text" value="" required />
                  <?php

                  } else {
                     
                  ?>
                    <input class="form-control email_validation" id="user_name" name="user_name" type="email" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 64) || (event.charCode == 46) || (event.charCode > 48 && event.charCode < 57)" value="" required />
                  <?php

                   
                  }


                  ?>

                  <div class="invalid-feedback text-right" id="username_error"> Please enter the USER ID provided to your institute.</div>

                </div>



                <div class="  position-relative">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="user_passcode">Registered Mobile <span style="color:red"> * </span></label>
                  </div>
                  <input class="form-control" value="" onpaste="return false" minlength="10" maxlength="10" id="institution_mobile" name="institution_mobile" onkeypress="return event.charCode >= 48 && event.charCode <= 57" pattern="^[6-9]\d{9}$" name="reg_mobile" id="reg_mobile" type="text" required />
                  <div class="invalid-feedback" id="mobile_error"> Please enter the registered mobile no. provided to your institute.</div>
                  <input type="hidden" id="mobile_validated">

                </div>

                <div id="newpassword" class="d-none  position-relative">
                  <input id="usrnaame" type="hidden">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="user_passcode"> New Password *</label>
                  </div>
                  <input class="form-control" type="password" id="new_passcode" name="new_passcode" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%&*_-]).{8,16}$" required="">

                  <!--  <input class="form-control" minlength="8" maxlength="12" value="" name="user_passcode" id="user_passcode" type="password" required /> -->

                  <div class="invalid-feedback" class="passwordnotmatch  " id="newpasserror"> Password are not same.please check.</div>

                </div>
                <div id="confirmpassword" class="d-none  position-relative">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="user_passcode">Confirm NewPassword *</label>
                  </div>
                  <input class="form-control" type="password" id="confirm_passcode" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%&*_-]).{8,16}$" onpaste="return false" name="confirm_passcode" required="">

                  <!--  <input class="form-control" minlength="8" maxlength="12" value="" name="user_passcode" id="user_passcode" type="password" required /> -->

                  <div class="invalid-feedback" class="passwordnotmatch  " id="confpasserror"> Password are not same.please check.</div>

                </div>

                <div class="mb-2">

                  <button class="btn btn-primary d-block w-100 mt-2" id="sendOTPMobile" type="submit" name="submitmobile"> Send OTP </button>
                  <button class="btn btn-primary d-block w-100 mt-2 d-none" id="password_submit" onclick="updatenewpassword() " type="button" name="submitreset"> Reset Password </button>
                </div>

                <!--
                      <div class="mb-1"> <a href="institution_register.php">
                          <button class="btn btn-primary d-block w-100 mt-1" type="button" name="button">Institution Registration</button></a>
                      </div>
					  -->

                <div class="mb-1">
                  <a href="index.php" class="btn btn-primary form-check-label mb-0" role="button"> Back to Home</a>

                </div>

                <!-- <div class="mb-1"><a href="emis_screen.php">
                          <button class="btn btn-primary d-block w-100 mt-1" type="button" name="button">Click here to find EMIS ID</button></a>
                      </div> -->
                <!-- <div class="col-auto"><a class="fs--1" href="emis_screen.php">Click here to find EMIS ID</a></div> -->
              </form>
            </div>
          </div>
        </div>
      </div>


    </div>
  </main><!-- ===============================================-->

  <!--    End of Main Content-->
  <!-- ===============================================-->

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="vendors/popper/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/anchorjs/anchor.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="vendors/lodash/lodash.min.js"></script>
  <script src="vendors/list.js/list.min.js"></script>
  <script src="assets/js/theme.js"></script>


  <!-- Button trigger modal -->

  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resetpasswordOTp">
    Launch static backdrop modal
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="resetpasswordOTp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-2" id="staticBackdropLabel"> OTP </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearuserfields()" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row  col-md-12 justify-content-center text-center" id="mobile_otp_div" style="height: 65px;">

            <label class="form-label" for="card-password"> Please Enter OTP sent to your mobile number. <span style="color:red">*</span>
              <span class="px-2"> Time left : <span id="mobile_timer" style="color:red"> </span></span>
            </label>
            <div class="col-md-1  px-2">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile1" name="email_id">

            </div>
            <div class="col-md-1  px-1">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile2" name="email_id">

            </div>
            <div class="col-md-1  px-1">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile3" name="email_id">

            </div>
            <div class="col-md-1  px-1">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile4" name="email_id">

            </div>
            <div class="col-md-1  px-1">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile5" name="email_id">

            </div>
            <div class="col-md-1  px-1">

              <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile6" name="email_id">

            </div>

            <div class="invalid-feedback text-justify" id="mobileotp_error"> Please Enter OTP </div>

          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="clearuserfields()" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="verifyOTPmobileinstitute()">Submit</button>

        </div>
      </div>
    </div>
  </div>





  <script>
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {




          if (!form.checkValidity()) {

            event.preventDefault();
            event.stopPropagation();

            resetpassword_OTP();

          } else {





            event.preventDefault();
            event.stopPropagation();



          }


          form.classList.add('was-validated')
        }, false)
      })
    })()




    $(document).ready(function() {


      //otpmobie next field enter

      function OTPInput_mobile() {
        const inputs = document.querySelectorAll('.mobile_otpval');
        for (let i = 0; i < inputs.length; i++) {
          inputs[i].addEventListener('keydown', function(event) {
            if (event.key === "Backspace") {
              inputs[i].value = '';
              if (i !== 0) inputs[i - 1].focus();
            } else {
              if (i === inputs.length - 1 && inputs[i].value !== '') {
                return true;
              } else if (event.keyCode >= 48 && event.keyCode <= 57) {
                inputs[i].value = event.key;
                if (i !== inputs.length - 1) inputs[i + 1].focus();
                event.preventDefault();
              } else if (event.keyCode >= 96 && event.keyCode <= 105) {
                inputs[i].value = event.key;
                if (i !== inputs.length - 1) inputs[i + 1].focus();
                event.preventDefault();
              } else if (event.keyCode >= 65 && event.keyCode <= 90) {
                return false;
              }
            }
          });
        }
      }
      OTPInput_mobile();

      //otpmobie next field enter







    });



    let timersOn = true;

    function timer_mobile(remaining) {



      var m = Math.floor(remaining / 60);
      var s = remaining % 60;

      m = m < 10 ? '0' + m : m;
      s = s < 10 ? '0' + s : s;
      document.getElementById('mobile_timer').innerHTML = m + ':' + s;
      remaining -= 1;

      if (remaining >= 0 && timersOn) {
        setTimeout(function() {
          timer_mobile(remaining);
        }, 1000);


        return;
      }

      if (!timersOn) {

        // Do validate stuff here
        return;
      }


      $('#resetpasswordOTp').modal('hide');
      clearuserfields();

      // Do timeout stuff here
      //alert('Timeout for otp');
    }





    function resetpassword_OTP() {

      //event.preventDefault();

      var email = $("#user_name").val();
      var mobile = $("#institution_mobile").val();
      var usertype =  $("#type_id").val();

      if (email && mobile) {
        $.ajax({

          method: "POST",
          url: "ajax.php",
          data: {
            type: 'checkValidUser',
            user_name: email,
            institution_mobile: mobile,
            usertype : usertype

          },
          beforeSend: function() {
            $('.forgotpass_loader').preloader({
              text: 'Loading Please Wait ....'
            });
          },
          success: function(response) {

            $('.forgotpass_loader').preloader('remove');

            var resdata = $.parseJSON(response);

            if (resdata.error_code == '200') {

              if (resdata.error_msg == '1') {

                $('#resetpasswordOTp').modal('show');
                //$("#mobileoptstatus").val(resdata.error_msg);
                $("#usrnaame").val(resdata.userid);

                $("#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").val('');
                $("#user_name,#institution_mobile").prop("readonly", true);

                timer_mobile('600');
                //$("#mobile_timer").html('');


              }

            } else if (resdata.error_code == '400') {


              Swal.fire({
                text: resdata.error_msg,
                icon: "warning",
                showConfirmButton: true

              })


            }
          }
        });
      }
    }
    //send mobile OTP


    function clearuserfields() {

      $("#user_name,#institution_mobile").prop("readonly", false);
      $("#mobileoptstatus").val('');
      $("#newpassword,#confirmpassword").addClass("d-none");
      $("#usrnaame").val('');

      //window.timer_mobile = function() {};
       


    }




    //function starts verify mobile
    function verifyOTPmobileinstitute() {



      $("#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").removeClass("error_field");

      


      var value = $('.mobile_otpval').filter(function() {
        return this.value === '';
      });

      if (value.length == 0) {

        var mobileOTp = $("#mobile1").val() + $("#mobile2").val() + $("#mobile3").val() + $("#mobile4").val() + $("#mobile5").val() + $("#mobile6").val();

        $.ajax({

          method: "POST",
          url: "ajax.php",
          data: {
            type: 'VerifyOTPmobile',
            mobileno: $("#institution_mobile").val(),
            OTp: mobileOTp

          },
          beforeSend: function() {
            $('.forgotpass_loader').preloader({
              text: 'Loading Please Wait ....'
            });
          },
          success: function(response) {
            $('.forgotpass_loader').preloader('remove');
            resdata = $.parseJSON(response);
            if (resdata.error_code == '200') {

              $("#mobile_validated").val('1');
              //$("#usrnaame").val(resdata.userid);


              $("#newpassword,#confirmpassword").removeClass("d-none");

              $('#resetpasswordOTp').modal('hide');
              $("#new_passcode,#confirm_passcode").css("border-color", "#d8e2ef");
              $("#new_passcode,#confirm_passcode").css("background-image", "none");
              $("#newpasserror,#confpasserror").addClass("d-none");
              $("#sendOTPMobile").addClass("d-none");
              $("#password_submit").removeClass("d-none");



              Swal.fire({
                text: resdata.error_msg,
                icon: "info",
                showConfirmButton: true

              })

            } else if (resdata.error_code == '400') {

              Swal.fire({
                text: resdata.error_msg,
                icon: "warning",
                showConfirmButton: true

              })
            }
          }
        });

      } else if (value.length > 0) {



        Swal.fire({
          text: 'OTP field is emtpy please check',
          icon: "warning",
          showConfirmButton: true

        })

        if ($("#mobile1").val() == '') {



          $("#mobile1").addClass("error_field");
          $("#mobile1").focus();


        }
        if ($("#mobile2").val() == '') {



          $("#mobile2").addClass("error_field");
          $("#mobile2").focus();


        }
        if ($("#mobile3").val() == '') {



          $("#mobile3").addClass("error_field");
          $("#mobile3").focus();

        }
        if ($("#mobile4").val() == '') {



          $("#mobile4").addClass("error_field");
          $("#mobile4").focus();

        }
        if ($("#mobile5").val() == '') {



          $("#mobile5").addClass("error_field");
          $("#mobile5").focus();

        }

        if ($("#mobile6").val() == '') {



          $("#mobile6").addClass("error_field");
          $("#mobile6").focus();
        }
      }
    }
    //function ends verify mobile

    //check password same
    function updatenewpassword() {

      $("#confpasserror,#newpasserror").addClass("d-none");
      $("#new_passcode,#confirm_passcode").removeClass("error_field");
      var newpass = $("#new_passcode").val();
      var confirmpass = $("#confirm_passcode").val();
      var userid = $("#usrnaame").val();
      if (!userid) {

        Swal.fire({

          text: 'Unable to fetch user details. Please contact admin.',
          icon: "warning",
          showConfirmButton: true

        })

      } else if ($("#mobile_validated").val() == '') {

        Swal.fire({

          text: 'Mobile no. is not  validated with OTP.',
          icon: "warning",
          showConfirmButton: true

        })

      } else if (newpass == '') {

        $("#new_passcode").addClass("error_field");

      } else if (confirmpass == '') {

        $("#confirm_passcode").addClass("error_field");
      } else if (newpass != confirmpass) {

        $("#confpasserror,#newpasserror").removeClass("d-none");
        $("#new_passcode,#confirm_passcode").addClass("error_field");
        $("#newpasserror,#confpasserror").css("display", "block");

      } else {

        $.ajax({

          method: "POST",
          url: "ajax.php",
          data: {

            type: 'newpasswordupdate',
            insti_email: $("#user_name").val(),
            insti_mobileno: $("#institution_mobile").val(),
            userid: userid,
            new_password: newpass,
            confirm_password: confirmpass

          },
          beforeSend: function() {
            $('.forgotpass_loader').preloader({
              text: 'Loading Please Wait ....'
            });
          },
          success: function(response) {
            $('.forgotpass_loader').preloader('remove');
            resdata = $.parseJSON(response);
            if (resdata.error_code == '200') {


              Swal.fire({
                html: resdata.error_msg,
                icon: "info",
                showConfirmButton: true

              }).then(function() {

                window.location.href = "index.php";
              });



            } else if (resdata.error_code == '400') {

              Swal.fire({
                text: resdata.error_msg,
                icon: "warning",
                showConfirmButton: true

              })
            }
          }
        });
      }





    }
  </script>
</body>

</html>