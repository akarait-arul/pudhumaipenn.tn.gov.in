<?php
// Start the session
include "valid_login.php";
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


</head>

<body>
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<div class="col-8 align-self-center institution_loader"></div>
		<div class="container-fluid" data-layout="container">
			<?php include('sideNav.php') ?>
			<div class="content">
				<?php include('topnav.php') ?>

				<div class="card mb-3 ">
					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0"> List of Institutes Registered </h5>

							</div>
							<div class="col-auto ms-auto">
								<a href="instituion_creation.php"><button class="btn btn-outline-primary me-1 mb-1" type="button"> Institute Registration </button></a>
							</div>
						</div>
					</div>

					<div class="card-body pt-0  bg-light ">

						<div id="" class="table-responsive scrollbar  mt-3">
							<table class="table table-hover table-striped overflow-hidden" id="table_institution_register_list">
								<thead class="bg-200">
									<tr style="background-color: #2c7be5;color: white;">

										<th scope="col"> S. No. </th>
										<th scope="col"> Institute Name </th>
										<?php 
											$userid = isset($_SESSION['user_details']['user_type']) ? $_SESSION['user_details']['user_type']   : '';
											if($userid == '40'){


											 
										  ?>
										<th scope="col"> Institution Type </th>


										<?php   } ?>
										<th scope="col"> District </th>
										<th scope="col"> User Name</th>
										<th scope="col"> Password Status </th>
										<th scope="col"> Date </th>
										<th scope="col"> Mobile </th>
										<th scope="col"> Contact Person </th>
										<th scope="col"> Course Mapping </th>

										<!-- <th scope="col"> action </th> -->

									</tr>
								</thead>
								<tbody id="institution_registeredlist">



								</tbody>


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


	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function() {




			getInstitutionList();


			 

		});




		function getInstitutionList() {

			$.ajax({

				type: "POST",
				url: "./ajax.php",
				data: {
					type: 'instituteRegisterListDot',
				},

				success: function(response) {
					var resdata = $.parseJSON(response);

					if (resdata.error_code == '200') {

						$("#institution_registeredlist").html(resdata.error_msg);

						$('#table_institution_register_list').DataTable({
							lengthMenu: [
								[10, 25, 50, -1],
								[10, 25, 50, 'All'],
							],
						});

						$('#table_institution_register_list_filter label input').addClass("datatable_input");
						$(".datatable_input").attr("onpaste", "return false");



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


		$(document).on('keypress', '.datatable_input', function() {

			var regex = new RegExp("^[a-zA-Z0-9]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}

		});

		function editcollegecourse(value) {

			localStorage.setItem('course_instituteid', '');
			var inputValue = value;
			localStorage.setItem('course_instituteid', inputValue);
			location.href = 'course_mapping.php';
		}


		/* function editClick(id) {

			var rowID = $(id).attr('id');
			Swal.fire({

				title: 'Are you sure?',
				text: "You want to approve the application !!!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'

			}).then((result) => {

				if (result.isConfirmed) {
					verifyInstitution(rowID);
				}

			})

			e.preventDefault();

		}

		function verifyInstitution(id) {

			if (id != '' && id != 0) {

				$.ajax({

					method: "POST",
					url: "ajax.php",
					data: {
						id: id,
						type: 'verifyInstitution'
					},
					success: function(response) {

						resdata = $.parseJSON(response);
						if (resdata['error_code'] == 200) {

							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							})
							location.reload();

						} else if (resdata['error_code'] == 400) {

							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							})

						} else if (resdata['error_code'] == 405) {

							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							})

						}

					}

				});

			}

		} */
	</script>


</body>

</html>