<?php
// Start the session

 
include 'valid_login.php';
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

	<style>
		.swal2-title {

			font-size: 20px !important;
		}


		.datata_td {

			font-size: 26px;
		}
	</style>
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



				<div class="card mb-3 ">
					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0">Institution Creation</h5>

							</div>

						</div>
					</div>

					<div class="card-body pt-0  bg-light">
						<input type="hidden" id="institution_type_id" value="<?php echo isset($_SESSION['user_details']['m_institution_type_id'][0]) ? trim($_SESSION['user_details']['m_institution_type_id'][0])  : '';  ?>">
						<div class="card-body bg-light  px-5  py-3">
							<div class="col-8 align-self-center loader_emis"></div>
							<form class="mb-3  needs-validation" novalidate id="emis_search" autocomplete="off">
								<div class="row mb-3">

									<div class="col-md-4 ">
										<label class="form-label" for="institution_type">Institution Type *</label>
										<select class="form-select" id="institution_type" required>

										</select>
										<div class="invalid-feedback text-left"> Please select the Institution Type </div>
									</div>

									<div class="col-md-3 ">
										<label class="form-label" for="district_list">District *</label>
										<select class="form-select" id="district_list" required>
											<option value="603"> chennai </option>
										</select>
										<div class="invalid-feedback text-left"> Please select the District </div>
									</div>





									<div class="col-md-4 ">
										<label class="form-label" for="institution">Institution Name *</label>
										<input class="form-control  " id="new_institute" type="text" onpaste="return false" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 39)  " required>
										<div class="invalid-feedback text-left"> Please Enter Institution</div>
									</div>

									<!-- <div id="register_username" class="col-md-4 d-none">
										<label class="form-label" for="user_id">User Id</label>
										<input class="form-control" id="user_id" type="text" required>

									</div>



									<div id="register_password" class="col-md-4 d-none">
										<label class="form-label" for="password">Password</label>
										<input class="form-control" id="password" type="text" required>
										<div class="invalid-feedback text-left"> Please Enter Password </div>
									</div> -->



									<div class="col-md-1 align-self-end">
										<button class="btn btn-primary" id="aadhaar_number_validation" type="submit">Register </button>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>

				<?php
				include('footer1.php')
				?>


				<!-- ===============================================-->
				<!--    End of Main Content-->
				<!-- ===============================================-->


				<?php include('footer_script.php') ?>

	</main>




</body>
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

					//formsubmit();

				} else {


					formsubmit();

					event.preventDefault();
					event.stopPropagation();

				}

				form.classList.add('was-validated')
			}, false)
		})
	})()


	$(document).ready(function() {

		getinstitution_type();
		getdistrict();



	});

	function getinstitution_type() {

		var institution_type = $("#institution_type_id").val();


		$.ajax({

			method: "POST",
			url: "ajax.php",
			data: {

				type: 'GetInsitutionType',
				optionhtml_template: '0',
				institution_id: institution_type

			},
			success: function(response) {

				resdata = $.parseJSON(response);
				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					//$("#institution_type").html(resdata.error_msg);

					$('#institution_type').empty().append();
					//$('#institution_type').append($("<option></option>").attr("value", '').text('Select district'));
					$.each(resdata['error_msg'], function(index, value) {

						$('#institution_type').append($("<option></option>").attr("value", value['m_institution_type_id']).text(value['institution_type']));
					});


				} else {

					Swal.fire({
						text: resdata.error_msg,
						icon: "warning",
						showConfirmButton: true

					})

				}
			}
		});


	}


	function getdistrict() {

		var district = '<?php isset($_SESSION['user_details']['institution_id'][0]) ? trim($_SESSION['user_details']['institution_id'][0])  : '';  ?>';
		$.ajax({

			method: "POST",
			url: "ajax.php",
			data: {

				type: 'GetDistrict'

			},
			success: function(response) {

				resdata = $.parseJSON(response);
				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					$('#district_list').empty().append();
					$('#district_list').append($("<option></option>").attr("value", '').text('Select district'));
					$.each(resdata['error_msg'], function(index, value) {
						$('#district_list')
							.append($("<option></option>").attr("value", value['district_code']).text(value['district_name']));
					});

				} else {

					Swal.fire({
						text: resdata.error_msg,
						icon: "warning",
						showConfirmButton: true

					})

				}
			}
		});


	}


	function formsubmit() {

		var insitution_id = $("#district_list").val();

		if ($("#institution_type_id").val() == 'all') {
			var insitution_id = $("#institution_type").val();

		}

		$.ajax({

			method: "POST",
			url: "ajax.php",
			data: {

				type: 'insertNewInstitutionbydot',
				district_list: insitution_id,
				institute_name: $("#new_institute").val(),
				username: $("#user_id").val(),
				password: $("#password").val()
			},

			success: function(response) {

				resdata = $.parseJSON(response);
				if (resdata.error_code == '200') {



					Swal.fire({
						title: resdata.error_msg,
						html: resdata.username_table,
						icon: "success",
						allowOutsideClick: false,
						showDenyButton: true,

						confirmButtonText: 'Add New Institution',
						denyButtonText: `Go to Institution Register List`,
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						if (result.isConfirmed) {
							location.reload();
						} else if (result.isDenied) {
							window.location.href = "institution_list_dot.php";
						}
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
	}
</script>

</html>