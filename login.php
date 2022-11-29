<?php

session_start();


if (!empty($_SESSION['user_details']['user_id'])  and isset($_SESSION['user_details']['user_id'])) {

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

  <script src="./assets/js/validation.js"></script>
  <!--               loader links    -->


  <!-- Custom Files Include Ends Here -->
  <style>
    .error_field {

      border-color: #e63757 !important;
      padding-right: calc(1.5em + 0.625rem);
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e63757'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e63757' stroke='none'/%3e%3c/svg%3e") !important;

      background-repeat: no-repeat;
      background-position: right calc(0.375em + 0.15625rem) center;
      background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);


    }
  </style>

</head>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid text-center">
      <div class="col-8 align-self-center loader"></div>
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
      <div class="row flex-center g-0">
        <div class="col-lg-10 col-xxl-8 py-3 position-relative">
          <div class="  overflow-hidden z-index-1">
            <div class="card-body p-0">
              <div class="row g-0 h-100">
                <!-- <div class="col-md-7 text-center bg-card-gradient">
                  <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                    <div class="bg-holder bg-auth-card-shape" style="background-image:url(./assets/img/icons/spot-illustrations/half-circle.png);"></div>
                     /.bg-holder 
                    <div class="z-index-1 position-relative">
                      <h4 class="link-light mb-4 font-Times New Roman-Serif fs-2 d-inline-block fw-bolder">PUDHUMAI PENN SCHEME</h4>
                      </a>
                      <p class="opacity-100 text-white font-Times New Roman-Serif text-justify" style="font-size:larger;">The Government of TamilNadu has launched Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme to enhance the enrolment ratio of girls from Government schools to Higher Education Institutions. Through this scheme, the financial assistance of Rs. 1000/month will be provided to the girls till their completion of UG degree/Diploma/ITI/any other recognized course. The incentive amount under this scheme will be disbursed directly into the student’s Bank Account.</p>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-3 d-flex flex-center">
                </div>
                <div class="col-md-6 mt-2 mb-2 card d-flex flex-center">
                  <div class="p-4 p-md-5 flex-grow-1">
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <h3> <?php echo $login_for;  ?> Login</h3>
                      </div>
                      <div class="invalid-feedback fs-1" id="common_errorfield"> </div>
                    </div>
                    <form class="row g-3 needs-validation" id="login_form" name="loggin_form" novalidate autocomplete="off">

                      <input type="hidden" name="type_id" id="type_id" value="<?php echo $m_user_type_id;  ?>">

                      <div class="mb-3 position-relative">
					  
                        <?php
                        if ($m_user_type_id == base64_encode(31) || $m_user_type_id == base64_encode(30)) {
                        
						echo '<div class="d-flex justify-content-between">
								<label class="form-label" for="user_name">User Name *</label>
							</div>
							<input class="form-control" id="user_name" name="user_name" type="text" value="" oncopy="return false" onpaste="return false" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 64) || (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" maxlength="128" minlength="5" required />
							<div class="invalid-feedback text-right" id="username_error"> Please enter the USER ID provided to your institute.</div>';				   

                        }  else if($m_user_type_id == base64_encode(32)) {
						
							echo '<div class="d-flex justify-content-between">
									<label class="form-label" for="mobile_no">Mobile Number *</label>
									</div>';
							echo '<input class="form-control" id="mobile_no" name="mobile_no" type="text" value="" minlength="10" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required style="background-image: none !important;"/>';
							echo '<div class="invalid-feedback text-right" id="mobile_error"> Please enter the Mobile Number provided during scholarship registration.</div>';
							
						} else {                        
						
							echo '<div class="d-flex justify-content-between">
									<label class="form-label" for="user_name">User Name *</label>
								</div>
								<input class="form-control email_validation" id="user_name" name="user_name" type="email" oncopy="return false" onpaste="return false" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 64) || (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" value="" required />
								<div class="invalid-feedback text-right" id="username_error"> Please enter the USER ID provided to your institute.</div>';
							
                        }


                        ?>                     

                      </div>

                      <?php
						if($m_user_type_id == base64_encode(32)){
							
							echo '<div class="mb-3 position-relative">
								<div class="d-flex justify-content-between">
									<label class="form-label" for="user_name">Email ID *</label>
								</div>
								<input class="form-control email_validation" id="email_id" name="email_id" type="email" oncopy="return false" onpaste="return false" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 64) || (event.charCode == 46) || (event.charCode >= 48 && event.charCode <= 57)" value="" required style="background-image: none !important;"/>
								<div class="invalid-feedback text-right" id="email_error"> Please enter the EMAIL ID provided during scholarship registration.</div>
							  </div>';
									  
						}else{
							
							echo '<div class="mb-3 position-relative">
									<div class="d-flex justify-content-between">
									  <label class="form-label" for="user_passcode">Password *</label>
									</div>
									<input class="form-control"   value="" name="user_passcode" id="user_passcode" type="password" required maxlength="16" minlength="8" oncopy="return false" onpaste="return false" />
									<!--  <input class="form-control" minlength="8" maxlength="12" value="" name="user_passcode" id="user_passcode" type="password" required /> -->
									<div class="invalid-feedback" id="password_error"> Please enter the PASSWORD provided to your institute.</div>
								 </div>';							
						}
						?>


                      <div class="row flex-between-center">
                        <div class="col-auto">
                          <div class="form-check mb-0 d-none"><input class="form-check-input" type="checkbox" id="card-checkbox" checked="checked" /><label class="form-check-label mb-0" for="card-checkbox">Remember me</label></div>
                        </div>

                        <div class="col-auto  "> 
<?php
                          if($m_user_type_id == base64_encode(31) ){
?>
                          <a class="fs--1" href="pinstitution.php">Forgot Password?</a>
<?php
                          } else if($m_user_type_id == base64_encode(30)) {
?>
                         <a class="fs--1" href="pdepartment.php">Forgot Password?</a>


<?php
                          } else if($m_user_type_id == base64_encode(20)){
?>
                           <a class="fs--1" href="pwelfare.php">Forgot Password?</a>

<?php
                          }
?>
                             
                        
                        </div>
                      </div>

                      <?php
							if($m_user_type_id == base64_encode(32)){
								
								echo'<div class="mb-2">
									<button class="btn btn-primary d-block w-100 mt-3" id="studentlogin_submit" type="submit" name="submit" onclick="StudentLogin()"> Log In
									  <span class="spinner-grow spinner-grow-sm visually-hidden" id="loader_img" role="status" aria-hidden="true"></span>
									  <span class="visually-hidden" id="loader_text">Loading...</span>
									</button>
								</div>';
								
							}else{
								
								echo'<div class="mb-2">
									<button class="btn btn-primary d-block w-100 mt-3" id="login_submit" type="submit" name="submit" onclick="logincheck()"> Log In
									  <span class="spinner-grow spinner-grow-sm visually-hidden" id="loader_img" role="status" aria-hidden="true"></span>
									  <span class="visually-hidden" id="loader_text">Loading...</span>
									</button>
								</div>';
								
							}
					  ?>

                      <!--
                      <div class="mb-1"> <a href="institution_register.php">
                          <button class="btn btn-primary d-block w-100 mt-1" type="button" name="button">Institution Registration</button></a>
                      </div>
					  -->

                      <div class="mb-1">
                        <a href="index.php" class="btn btn-warning form-check-label mb-0" role="button">Back to Home</a>

                      </div>

                      <!-- <div class="mb-1"><a href="emis_screen.php">
                          <button class="btn btn-primary d-block w-100 mt-1" type="button" name="button">Click here to find EMIS ID</button></a>
                      </div> -->
                      <!-- <div class="col-auto"><a class="fs--1" href="emis_screen.php">Click here to find EMIS ID</a></div> -->
                    </form>
                  </div>

                </div>
                <div class="col-md-3 d-flex flex-center">
                </div>


              </div>


            </div>
          </div>
        </div>
      </div>
	<div class="modal fade" id="otp_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 class="modal-title text-center text-2xl" id="staticBackdropLabel"> Student Profile Registration </h5>
				</div>
				<form class="row-auto g-3 needs-validation" id="submit_otp" name="submit_otp" novalidate="" autocomplete="off">
					<div class="modal-body" style="padding:0px;">
						<div class="container mx-auto">
							<div class="flex flex-col mt-4 text-center">
								<span> Please enter the OTP sent to the Mobile Number </span>
								<span> <span class="font-bold" id="mobile_number_mask">+91 ********** </span> for registration.</span>

							</div>
							<div class="container height-100 d-flex justify-content-center align-items-center">
								<div class="position-relative max-w-sm mx-auto md:max-w-lg mx-auto">
									<div id="otp" class="flex flex-row justify-center text-center px-2 mt-3">
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="first" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="second" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="third" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="fourth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="fifth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
										<input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="sixth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
									</div>
								</div>
							</div>
						</div>
						<div class="text-center mt-3" id="div_resendotp">
							<div class="row">
								<div class="fw-bold">Time left : <span id="timer"></span></div>
							</div>
							<div class="row mt-3">
								<div class="col-md-8">
									<span class="d-block mobile-text fw-bolder" id="resend"></span>
								</div>
								<div class="col-md-4">
									<button id="regenerateOTP" class="btn btn-warning btn_shadow d-none">Resend OTP </button>
								</div>
							</div>
							<!-- <span class="d-block mobile-text fw-bolder" id="countdown"></span>
							<span class="d-block mobile-text fw-bolder" id="resend"></span> -->
						</div>
						<div class="modal-footer mt-3">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" id="otp_button_validate">Submit</button>
							<button class="btn btn-primary d-none" type="button" id="otp_button_loading" disabled>
							  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
							  Processing...
							</button>						
						</div>
				</form>
			</div>
		</div>
		</div>
	</div>
	<!-- OTP Modal For Registration Ends Here -->
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

          } else {

            event.preventDefault();
            event.stopPropagation();
            //logincheck();
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()

	document.addEventListener("DOMContentLoaded", function(event) {

			function OTPInput() {
				const inputs = document.querySelectorAll('#otp > *[id]');
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
			OTPInput();

		});


	let timerOn = true;
		function timer(remaining) {

			var m = Math.floor(remaining / 60);
			var s = remaining % 60;

			m = m < 10 ? '0' + m : m;
			s = s < 10 ? '0' + s : s;
			document.getElementById('timer').innerHTML = m + ':' + s;
			remaining -= 1;

			if (remaining >= 0 && timerOn) {
				setTimeout(function() {
					timer(remaining);
				}, 1000);
				$("#regenerateOTP").removeClass("btn btn-warning btn_shadow d-block").addClass("btn btn-warning btn_shadow d-none");
				document.getElementById("resend").innerHTML = ``;
				return;
			}

			if (!timerOn) {
				// Do validate stuff here
				return;
			}

			$("#regenerateOTP").removeClass("btn btn-warning btn_shadow d-none").addClass("btn btn-warning btn_shadow d-block");
			document.getElementById("resend").innerHTML = `Didn't receive the OTP?`;
			// Do timeout stuff here
			//alert('Timeout for otp');
		}
		
		function StudentLogin(){
			
			if($("#mobile_no").val() ==""){
				
				Swal.fire({
				  html: 'Please enter the Mobile Number provided during scholarship registration.',
				  icon: "warning",
				  showConfirmButton: false
				})
				
			}else if($("#email_id").val() ==""){
				
				Swal.fire({
				  html: 'Please enter the EMAIL ID provided during scholarship registration.',
				  icon: "warning",
				  showConfirmButton: false
				})
				
			}else if($("#type_id").val() == ""){
				
				Swal.fire({
				  html: 'User Type is Empty',
				  icon: "warning",
				  showConfirmButton: false
				})

			}else{
				
				$("#mobile_error,#email_error").css("display", "none");
				$("#user_name,#user_passcode").removeClass('error_field');
				$("#password_errmsg,#username_errmsg,#common_errorfield").html(' ');

			    var data_form = {

					mobile_no: $("#mobile_no").val(),
					email_id: $("#email_id").val(),
					user_type: $("#type_id").val(),
					type: 'StudentLogin',

				};
				
				$.ajax({

					url: 'ajax.php',
					method: "POST",
					data: data_form,
					beforeSend: function() {
					  $('.loader').preloader({
						text: 'processing Please Wait ....'
					  });
					},
					success: function(data) {

					  $('.loader').preloader('remove');
					  var result = JSON.parse(data);
						
					  if (result.error_code == '200') {

							//clearInterval(startTimer);                
							timer(600);
							const mask = (cc, num = 4, mask = '*') => `${cc}`.slice(-num).padStart(`${cc}`.length, mask);
							// Call function without giving value of n
							$("#mobile_number_mask").html(mask($("#mobile_no").val()));
							$('#tmp_otp_msg').html(result.error_msg);
							$('#otp_modal').modal('show');
							$('#submit_otp')[0].reset();

					  } else if (result.error_code == '400') {

						Swal.fire({
							icon: 'info',
							html: result.error_msg
						})
						
					  }


					}


				});
				
				
			}
		}
	// Student Registration Submit OTP Form     
	$("#submit_otp").submit(function (e) {
		
		var phone_no = $("#mobile_no").val();
		var user_email = $("#email_id").val();
		var otp_number = $("#first").val() + $("#second").val() + $("#third").val() + $("#fourth").val() + $("#fifth").val() + $("#sixth").val()

		if (phone_no != '' && user_email != '' && otp_number != '') {        
			
			$.ajax({				
				method: "POST",
				url: "ajax.php",
				data: {                
					phone_no: phone_no,
					user_email: user_email,
					otp_number: otp_number,
					type: 'SubmitStudentOTP'
				},
				beforeSend: function () {               
				   $("#otp_button_validate").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
				   $("#otp_button_loading").removeClass("btn btn-primary d-none").addClass("btn btn-primary d-block");				
				},
				success: function (response) {
					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
						$('#otp_modal').modal('hide');
						location.href = resdata['error_msg'];
						
					} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {
						
						$("#otp_button_validate").removeClass("btn btn-primary d-none").addClass("btn btn-primary");
						$("#otp_button_loading").removeClass("btn btn-primary d-block").addClass("btn btn-primary d-none");
					
						$('#submit_otp')[0].reset();
						$("#otp_number").focus();
						Swal.fire({
							icon: 'info',
							html: resdata['error_msg']
						})
						$('#otp_modal').modal('show');

					} else if (resdata['error_code'] == 401 && resdata['error_msg'] != 0) {

						$('#submit_otp')[0].reset();
						Swal.fire({
							title: 'Message',
							html: resdata['error_msg']
						})
						$('#otp_modal').modal('hide');
						
					
					}

				},
				complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
					
				   $("#otp_button_validate").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
				   $("#otp_button_loading").removeClass("btn btn-primary d-block").addClass("btn btn-primary d-none");
					
				}
			});
		
		}
		
		e.preventDefault();
	
	});
    function logincheck() {

      $("#username_error,#password_error").css("display", "none");
      $("#user_name,#user_passcode").removeClass('error_field');
      $("#password_errmsg,#username_errmsg,#common_errorfield").html(' ');

      var password = btoa($("#user_passcode").val());
      var username = btoa($("#user_name").val());
      var data_form = {

        ussrname: username,
        passcode: password,
        user_type: $("#type_id").val(),
        type: 'UserLogin',

      };


      $.ajax({

        url: 'ajax.php',
        method: "POST",
        data: data_form,
        beforeSend: function() {

          $('.loader').preloader({
            text: 'processing Please Wait ....'
          });



        },
        success: function(data) {

          $('.loader').preloader('remove');
          var result = JSON.parse(data);

          if (result.error_code == '400') {




            if (result.error_field == 'username_errmsg') {
              $("#user_name").addClass('error_field');
              $("#username_error").css("display", "block");

            } else if (result.error_field == 'password_errmsg') {
              $("#user_passcode").addClass('error_field');
              $("#password_error").css("display", "block");
            } else if (result.error_field == 'common_errorfield') {


            }



            Swal.fire({



              html: result.msg,
              icon: "warning",
              showConfirmButton: true

            })


          } else if (result.error_code == '200') {


            Swal.fire({



              html: result.msg,
              icon: "success",
              showConfirmButton: false

            })

            setTimeout(function() {

              window.location = "dashboard.php";

            }, 800);


            
          }


        }


      });
    } //logincheck
  </script>

</body>

</html>
