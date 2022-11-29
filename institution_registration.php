<?php
    // Start the session
    session_start();
    print_r($_SESSION['user_details']['m_institution_type_id']);
    if(!isset($_SESSION['user_details']['user_type']) and empty($_SESSION['user_details']['user_type']) and !isset($_SESSION['user_details']['user_id'])  and empty($_SESSION['user_details']['user_id'])){
        header('Location: index.php');
    } 
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('header_script.php') ?>
</head>

<body>
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		
        <div class="col-8 align-self-center loader"></div>
		<div class="container-fluid" data-layout="container">
			<?php include('sideNav.php') ?>
			<div class="content">
				<?php include('topnav.php') ?>
				<!-- Student Registration Starts Here -->
				<div class="card mb-3" id="div_student_registration">
					<div class="card-header">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0" data-anchor="data-anchor">Institution Registration</h5>
							</div>
							<div class="col-auto ms-auto">
								<a href="institution_register_list.php"><button type="button" class="btn btn-primary"> Back to Registered Institution </button></a>
							</div>
						</div>
					</div>
					<div class="card-body bg-light">
						<div class="tab-content">
							<div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
								
                                <form class="row g-3 needs-validation" id="institution_register" name="institution_register" novalidate autocomplete="off">
									<div class="col-md-4 col-auto">
										<label class="form-label" for="phone_no">Email ID *</label>
										<div class="input-group">
                                            <input class="form-control" type="text" id="email_id" name="email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
											<span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
											<div class="invalid-feedback text-left">Please Enter Student Name</div>
										</div>
									</div>
									<div class="col-md-4 col-auto">
										<label class="form-label" for="phone_no"> Mobile Number *</label>
										<div class="input-group">
											<input class="form-control" id="phone_number" name="phone_number" pattern="^[6-9]\d{9}$" type="text" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
											<span class="input-group-text"><i class="fas fa-mobile-alt"></i> </span>
											<div class="invalid-feedback text-left"> Please Enter Mobile Number </div>
										</div>										
									</div>
									<div class="col-md-4 col-auto">
										<label class="form-label" for="user_email"> Contact Person *</label>
										<div class="input-group">
                                            <input class="form-control" type="text" id="contact_person" name="contact_person" pattern="^[A-Za-z ]{1,32}$" required />
                                            <span class="input-group-text"> <i class="fas fa-male"></i> </span>
											<div class="invalid-feedback text-left"> Please Enter Email ID </div>
										</div>
									</div>
                                    <div class="col-md-4 col-auto">
										<label class="form-label" for="user_email">District *</label>
										<div class="input-group">
                                            <select class="form-select" id="m_district_code" name="m_district_code" required>
                                            </select>
                                            <div class="invalid-feedback text-left"> Please Enter Email ID </div>
										</div>
									</div>                                    
                                    <div class="col-md-8 col-auto">
										<label class="form-label" for="user_email">Institution *</label>
										<div class="input-group">
                                            <select class="form-select" id="m_institution_id" name="m_institution_id" required></select>
                                            <div class="invalid-feedback text-left"> Please Enter Email ID </div>
										</div>
									</div>
                                    <div class="col-md-4 col-auto">
										<label class="form-label" for="user_email">Address  *</label>
										<div class="input-group">
                                            <input class="form-control" type="text" id="address" name="address" required />                                            
											<div class="invalid-feedback text-left"> Please Enter Email ID </div>
										</div>
									</div>
                                    <div class="col-md-4 col-auto">
										<label class="form-label" for="user_email">Pincode  *</label>
										<div class="input-group">
                                            <input class="form-control" type="text" id="pincode" name="pincode" pattern="^[0-9]\d{5}$" required />
                                            <div class="invalid-feedback text-left"> Please Enter Email ID </div>
										</div>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-md-end">
										<button class="btn btn-primary" id="otp_validation" type="buttom">Submit Registration</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
				<!-- Student Registration Ends Here -->
                
				<footer class="footer">
					<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
						<div class="col-12 col-sm-auto text-center">
							<p class="mb-0 text-600">Akara Research & Technologies Pvt Ltd <span class="d-none d-sm-inline-block">|</span><br class="d-sm-none">
								2022 &copy;</p>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<!-- ===============================================-->
		<!--    End of Main Content-->
		<!-- ===============================================-->

		<?php include('footer_script.php') ?>

	</main>

	<script>

        ///
        $(document).ready(function() {
            getDistrict();  
        });

        // Institution Registration Get District
        function getDistrict() {

            $.ajax({

                method: "POST",
                url: "ajax.php",
                data: {
                    type: 'GetDistrict'
                },
                beforeSend: function() {
                    $('.loader').preloader({
                    text: 'Loading Please Wait ....'
                    });
                },            
                success: function(response) {
                    
                    $('.loader').preloader('remove');
                    resdata = $.parseJSON(response);
                    if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                    $('#m_district_code').empty().append();
                    $('#m_district_code')
                        .append($("<option></option>")
                        .attr("value", '')
                        .text('Select District'));
                    $.each(resdata['error_msg'], function(index, value) {
                        $('#m_district_code')
                        .append($("<option></option>")
                            .attr("value", value['district_code'])
                            .text(value['district_name']));
                    });

                    } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                    Swal.fire(resdata['error_msg'])

                    }

                }

            });

        }

        //OnChange Get Institution Based On District Code
        $("#m_district_code").change(function(e) { 

            var district = $("#m_district_code").val();
            if (district && district != 0) {            
                $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {
                        district: district,
                        type: 'GetInstitutions'
                    },
                    beforeSend: function() {
                        $('.loader').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                            $('#m_institution_id').empty().append();
                            $('#m_institution_id')
                            .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Institution'));
                            $.each(resdata['error_msg'], function(index, value) {
                            $('#m_institution_id')
                                .append($("<option></option>")
                                .attr("value", value['m_institution_id'])
                                .text(value['institution_name']));
                            });

                        } else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

                            Swal.fire({
                            title: 'Message',
                            text: resdata['error_msg']
                            })

                        }
                    }
                });
            }

        });

        // Student Registration Submit OTP Form

        $("#institution_register").submit(function(e) {

            var formdata = $("#institution_register").serializeArray();
            if (formdata) {
            $.ajax({

                method: "POST",
                url: "ajax.php",
                data: {
                    formdata: formdata,
                    type: 'InstitutionRegister'
                },
                beforeSend: function() {
                    $('.loader').preloader({
                        text: 'Loading Please Wait ....'
                    });
                },
                success: function(response) {
                    $('.loader').preloader('remove');
                    resdata = $.parseJSON(response);
                    if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                        $('#tmp_otp_msg').html(resdata['error_msg']);
                        $('#otp_modal').modal('show');
                    } else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {
                        Swal.fire({
                            title: 'Alert',
                            text: resdata['error_msg']
                        })
                    }
                }

            });

            }

            e.preventDefault();

        });

        // Submit OTP 

        $("#submit_otp").submit(function(e) {

            var formdata = $("#institution_register").serializeArray();
            var otp_number = $("#first").val() + $("#second").val() + $("#third").val() + $("#fourth").val() + $("#fifth").val() + $("#sixth").val();
            if (formdata != '' && otp_number.length == 6) {

            $.ajax({

                method: "POST",
                url: "ajax.php",
                data: {

                formdata: formdata,
                otp_number: otp_number,
                type: 'SubmitInstitutionOTP'

                },
                beforeSend: function() {
                $('.loader_modal').preloader({
                    text: 'Loading Please Wait ....'
                });
                },
                complete: function() {
                $('.loader_modal').preloader('remove');
                },
                success: function(response) {

                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                    $('#otp_modal').modal('hide');
                    Swal.fire({
                    icon: 'success',
                    title: "Success Message",
                    text: resdata['error_msg'],
                    type: "success"
                    }).then(function() {
                    location.reload();
                    });

                } else if (resdata['error_code'] >= 400 && resdata['error_msg'] != 0) {

                    Swal.fire({
                    icon: 'error',
                    title: 'Alert',
                    text: resdata['error_msg']
                    })
                    Swal.fire({
                    icon: 'error',
                    title: "Alert Message",
                    text: resdata['error_msg'],
                    type: "success"
                    }).then(function() {

                    $('#otp_modal').modal('show');

                    });




                }

                }

            });

            }

            e.preventDefault();

        });

        ////






















		

		

		

		

		

		

		






		
	</script>

</body>

</html>