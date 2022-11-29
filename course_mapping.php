<?php


include "valid_login.php";

//var_dump( isset($_SESSION['user_details']['user_type']) == '30'  );

//print_r($_SESSION);

$institution_type_id = isset($_SESSION['user_details']['m_institution_type_id']) ? $_SESSION['user_details']['m_institution_type_id'][0]  : '';
$instituteid =  '';
if (trim($_SESSION['user_details']['user_type']) == '31') {

	$instituteid = isset($_SESSION['user_details']['institution_id'][0]) ? $_SESSION['user_details']['institution_id'][0]  : '';

	//header('Location: dashboard.php');

}  

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


</head>

<body>
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<div class="col-8 align-self-center course_loader"></div>
		<div class="container-fluid" data-layout="container">
			<?php include('sideNav.php')
			?>
			<div class="content">
				<?php include('topnav.php')  ?>



				<div class="card mb-3 ">
					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
							<?php
							
							if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 31) {

						?>
								<h5 class="mb-0"> Courses </h5>
							<?php } else { ?>
							
							<h5 class="mb-0"> Course Mapping </h5>
							<?php } ?>

							</div>

						</div>
					</div>

					<div class="card-body pt-0  bg-light">
						
						<div class="row <?php echo ((isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 31) ? 'd-none':"");?>" >
							<form class="row g-3 needs-validation " novalidate="">
								<input type="hidden" id="instituteid" value="<?php echo $instituteid;  ?>">
								<input type="hidden" id="institution_type_id" value="<?php echo $institution_type_id;  ?>">

								<?php

								if ($_SESSION['user_details']['user_type'] == '30') {

								?>
									<div class="col-md-3">
										<label class="form-label" for="m_institution_id"> Institution Name </label>
										<select class="form-select" id="m_institution_id" onchange="getDegreebyInstitute(this)" required="">
											<option value=""> Select Institution Name </option>
										</select>

										<div class="invalid-feedback">Please select a valid Institution Type.</div>
									</div>
								<?php
								}


								?>


								<div class="col-md-2">
									<label class="form-label" for="m_degree_id"> Select Available Degree </label>
									<select class="form-select" id="m_degree_id" onchange="getSubject(this)" required="">
										<option> Select Degree </option>
									</select>

									<div class="invalid-feedback">Please select a valid Degree.</div>
								</div>

								<div class="col-md-6">
									<label class="form-label" for="subject"> Select Available Subject </label>

									<select class="form-select" id="subject" required="" multiple="multiple">
										<option> Select subject </option>
									</select>

									<div class="invalid-feedback">Please select a valid Subject.</div>
								</div>


								<div class="col-1 ">
									<button class="btn btn-primary mt-4" onclick="submitCourseMapping()" type="submit">Submit</button>


								</div>

							</form>
						</div>
						
						
						<div id="" class="table-responsive scrollbar  mt-3">
							<table class="table table-hover table-striped overflow-hidden" id="table_institution_register_list">
								<thead class="thead-style">
									<tr style="background-color: #2c7be5;color: white;">

										<th scope="col"> S. No. </th>
										<th scope="col"> Degree </th>
										<th scope="col"> Subjects </th>
										<?php
							
							if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] != 31) {

						?>
										<th scope="col"> Action </th>
							<?php } ?>

									</tr>
								</thead>
								<tbody id="course_list"> </tbody>


							</table>
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

	<script>
		//validation form 
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

					} else {

						event.preventDefault();
						//submitCourseMapping();


					}

					form.classList.add('was-validated')
				}, false)
			})
		})()


		//onready get id




		$(document).ready(function() {

			<?php
			if ($_SESSION['user_details']['user_type'] == '30' or  $_SESSION['user_details']['user_type'] ==  '40' ) {

			?>



				getInstitutionList();
				$("#instituteid").val(localStorage.getItem("course_instituteid"));


			<?php
			}
			
			

			?>



			getDegree();
			getAvailableSubjects();


			$('#subject').select2({

				placeholder: "Select the subject "

			});

		});


		function getAvailableSubjects() {

			var institutionid = $("#instituteid").val();



			if (institutionid != '') {

				$.ajax({

					method: "POST",
					url: "ajax.php",
					data: {
						type: 'getAvailableSubjects',
						instituteid: institutionid
					},
					beforeSend: function() {
						$('.course_loader').preloader({
							text: 'processing please Wait ....'
						});
					},
					success: function(response) {

						$('.course_loader').preloader('remove');

						resdata = $.parseJSON(response);
						if (resdata['error_code'] == 200 && resdata['error_status']) {

							$('#course_list').html(resdata.error_msg);


						} else if (resdata['error_code'] == 400 && !resdata['error_status']) {

							Swal.fire(resdata['error_msg'])

						}

					}

				});


			}
		}


		//get institution name list
		function getInstitutionList() {
			<?php


			?>
			//getting disctrict

			if ($("#instituteid").val()) {

				var district_instiid = $("#instituteid").val();

			}
			if (!district_instiid) {

				var district_instiid = localStorage.getItem("course_instituteid");
			}


			if(district_instiid){

				$.ajax({

					method: "POST",
					url: "ajax.php",
					data: {
						type: 'getInstitutionbyusertype',
						district: district_instiid,
						optionhtml_template: 1

					},
					beforeSend: function() {
						$('.course_loader').preloader({
							text: 'processing please Wait ....'
						});
					},
					success: function(response) {

						$('.course_loader').preloader('remove');

						resdata = $.parseJSON(response);
						if (resdata['error_code'] == 200 && resdata['error_status']) {

							$('#m_institution_id').html(' ');

							$('#m_institution_id').append(resdata.error_msg);

						} else if (resdata['error_code'] == 400 && !resdata['error_status']) {

							Swal.fire(resdata['error_msg'])

						}

					}

				});
			}


		}
		//get institution name list

		//





		//get degree by  institute
		function getDegree(instituteid) {
			
			var institute_type_id = $("#institution_type_id").val();

			if(institute_type_id == 'all'){

				var institute_type_id =  $("#instituteid").val();

			}


			$.ajax({

				method: "POST",
				url: "ajax.php",
				data: {
					institution_id: institute_type_id,
					type: 'getDegreeListByDot'
				},
				beforeSend: function() {
					$('.course_loader').preloader({
						text: 'processing please Wait ....'
					});
				},
				success: function(response) {

					$('.course_loader').preloader('remove');

					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						$('#m_degree_id').empty().append();
						$('#m_degree_id').append($("<option></option>").attr("value", '').text('Select Degree'));
						$.each(resdata['error_msg'], function(index, value) {
							$('#m_degree_id').append($("<option></option>").attr("value", value['m_degree_id']).text(value['degree']));
						});


					} else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						Swal.fire(resdata['error_msg'])

					}

					getAvailableSubjects();

				}

			});

		}
		//get degree by  institute





		//get degree subject
		function getSubject(degreeid) {



			if (Number.isInteger(parseInt(degreeid))) {
				var degree = degreeid;
				$("#m_degree_id").val(degree);

			} else {

				var degree = $("#m_degree_id").val();
			}


			var institutionid = $("#instituteid").val();
			if (degree && institutionid) {

				$.ajax({
					method: "POST",
					url: "ajax.php",
					data: {

						degree_id: degree,
						institution_id: institutionid,
						type: 'getInsituteWiseSubject'
					},
					beforeSend: function() {
						$('.course_loader').preloader({
							text: 'Loading subject Type please Wait ....'
						});
					},
					success: function(response) {
						$('.course_loader').preloader('remove');

						resdata = $.parseJSON(response);
						if (resdata.error_code == '200' && resdata.error_msg != 0) {

							$('#subject').empty().append();
							//$('#subject').append($("<option></option>").attr("value", '').text('Select Subject'));
							$.each(resdata['error_msg'], function(index, value) {
								$('#subject').append($("<option></option>").attr("value", value['m_subject_id']).text(value['subject']+' ( '+value['year_of_study']+' years )'));
							});

							$("#subject").select2("val", "");

							$('#subject').val(resdata.selected_subject).trigger('change');

						}
					}
				});
			} else {
				if(degree ==''){

					$('#subject').val('').trigger('change');
				}


			}

		}
		//get degree subject 


		//getting  all ready selected subject for institutes

		/* function get_institute_subjects(institutionid) {

			var institution_id = institutionid.value;

			$.ajax({

				method: "POST",
				url: "ajax.php",
				data: {
					institution_id: institution_id,
					type: 'getInsituteWiseSubject'
				},
				beforeSend: function() {
					$('.course_loader').preloader({
						text: 'processing please Wait ....'
					});
				},
				success: function(response) {

					$('.course_loader').preloader('remove');

					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						//alert(resdata.error_msg);
						$('#subject').val(resdata.error_msg).trigger('change');


					} else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						Swal.fire(resdata['error_msg'])

					}

				}

			});



		}
		//getting  all ready selected subject for institutes */


		//select all in course mapping
		$('#subject').on("select2-selecting", function(e) {
			console.log('Selecting');
		});

		//select all in course mapping

		//submit subjects and degree
		function submitCourseMapping() {

			event.preventDefault();

			if ($("#subject").val() == '') {
				var subject = '';

			} else {

				var subject = $("#subject").val();

			}

			$.ajax({
				method: "POST",
				url: "ajax.php",
				data: {

					institution_type_id: $("#institution_type_id").val(),
					m_institution_id: $("#instituteid").val(),
					subject: subject,
					degree_id: $("#m_degree_id").val(),

					type: 'CourseMapping'
				},
				beforeSend: function() {
					$('.course_loader').preloader({
						text: 'processing please Wait ....'
					});
				},
				success: function(response) {

					$('.course_loader').preloader('remove');

					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						Swal.fire({

							title: 'Message',

							text: resdata.msg,
							icon: "success",
							showConfirmButton: true,
							allowOutsideClick: false

						}).then(function() {

							window.location.reload();
						});



					} else if (resdata['error_code'] == 400 && !resdata['error_status']) {

						Swal.fire({

							title: 'Message',

							text: resdata.msg,
							icon: "warning",
							showConfirmButton: false

						})


					}
				}
			});
		} //submit subjects and degree








		//get degree type 
		/* function getDegreeWiseSubject(institution_type_id) {

			//var institution_type_id = institute_type.value;
			$.ajax({

				method: "POST",
				url: "ajax.php",
				data: {
					institution_type_id: institution_type_id,
					type: 'GetDegreeWiseSubject'
				},
				beforeSend: function() {
					$('.course_loader').preloader({
						text: 'processing please Wait ....'
					});
				},
				success: function(response) {

					$('.course_loader').preloader('remove');

					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						$('#subject').html(resdata.error_msg);


					} else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

						Swal.fire(resdata['error_msg'])

					}

				}

			});

		} */
	</script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>