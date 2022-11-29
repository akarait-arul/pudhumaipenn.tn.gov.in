<?php
// Start the session
 
include "valid_login.php";
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



</head>

<body>
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<div class="col-8 align-self-center loader"></div>
		<div class="col-8 align-self-center loader_filter"></div>
		<div class="container-fluid" data-layout="container">
			<?php include('sideNav.php') ?>
			<div class="content">
				<?php include('topnav.php') ?>
				<div class="card mb-3 ">

					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0">List of students registered</h5>
							</div>
						</div>
					</div>



					<div class="card-body bg-light">

						<!-- search filer options -->
						<form class="row g-3 needs-validation" novalidate="" id="student_registration">
							<input type="hidden" id="m_district_id" name="m_district_id" value="<?php echo $_SESSION['user_details']['district'] ?>" />
							<div class="col-md-3 mb-3">
								<label class="form-label" for="inputAddress">Institution Type</label>
								<select class="form-select" onchange="getWelfareinstitutionList(this)" id="instiution_type" required="">

								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label" for="inputAddress">Institution </label>
								<select class="form-select" onchange="getWelfareCourseList(this)" id="institution_list" required="">
									<option value=""> All </option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label" for="inputAddress">Course</label>
								<select class="form-select" onchange="getWelfareSubjectList(this)" id="course" required="">
									<option value="">All</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label" for="inputAddress"> Subject </label>
								<select class="form-select" id="subject" required="">
									<option value=""> All </option>
								</select>
							</div>


							<div class="col-md-3 mb-3">
								<label class="form-label" for="filter_dates">Select From to Date Range</label>
								<div class="input-group">
									
									<input class="form-control datetimepicker" id="filter_dates" type="text" placeholder="dd-M-Y to dd-M-Y" data-options='{"mode":"range","dateFormat":"d-M-y"}' />
									<!-- <div class=" btn btn-primary  input-group-text" id="dateclear"> clear </div> -->
								</div>
							</div>





							<div class="col-md-3 align-self-end  mb-4">
								<button class="btn btn-primary mt-4" type="button" onclick="getFilterResults()">Search</button>
								<a class="btn btn-primary mt-4" onclick="getDefaultRecords()">Clear</a>
							</div>
						</form>
						<!-- search filer options -->



						<div class="tab-content mt-5">

							<div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin-bottom:-30px;">
								<button id="acceptall" onclick="acceptall_students()" class="btn btn-success align-end d-none" type="button"> <i class="fas fa-check"></i> Approve (<span id="selectcount"> </span>) </button>
							</div>

							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item"><a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="tab-home" aria-selected="true">Pending</a></li>
								<li class="nav-item"><a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="tab-profile" aria-selected="false">Approved</a></li>
								<li class="nav-item"><a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#not_approved" role="tab" aria-controls="tab-profile" aria-selected="false">Rejected </a></li>
							</ul>

							<div class="tab-content border-x border-bottom p-3" id="myTabContent">

								<!-- pending list -->
								<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">



									<div class="table-responsive scrollbar">
										<table class="table table-bordered table-striped overflow-hidden" id="table_student_register_list">
											<thead class="bg-200 text-black">
												<tr>
													<th scope="col">
														<div class="form-check  "><input class="form-check-input" type="checkbox" id="checkall" data-bulk-select-row="data-bulk-select-row" /> </div>
													</th>
													<th scope="col">Application #</th>
													<th scope="col">Student Name</th>
													<th scope="col">EMIS</th>
													<th scope="col">Mobile Number</th>
													<th scope="col">Email</th>
													<th scope="col">Aadhaar</th>
													<th scope="col">Institution</th>
													<th scope="col">Degree</th>
													<th scope="col">Subject</th>
													<th scope="col" class=""></th>
													<th scope="col" class="">Action</th>
												</tr>
											</thead>
											<tbody id="pending_tbody">



											</tbody>
										</table>
									</div>

								</div>
								<!-- pending list -->


								<!-- approved list -->
								<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="contact-tab">
									<div class="table-responsive scrollbar">


										<table class="table cell-border table-striped overflow-hidden" id="table_student_register_list">
											<thead class="bg-200 text-black">
												<tr>
													<th scope="col">Application #</th>
													<th scope="col">Student Name</th>
													<th scope="col">EMIS</th>
													<th scope="col">Mobile Number</th>
													<th scope="col">Email</th>
													<th scope="col">Aadhaar</th>
													<th scope="col">Institution</th>
													<th scope="col">Degree</th>
													<th scope="col">Subject</th>
													<th scope="col" class=""></th>

												</tr>
											</thead>
											<tbody id="approved_tbody">



											</tbody>
										</table>


									</div>
								</div>
								<!-- approved list -->

								<!-- not approved list -->
								<div class="tab-pane fade" id="not_approved" role="tabpanel" aria-labelledby="contact-tab">
									<div class="table-responsive scrollbar">
										<table class="table cell-border table-striped overflow-hidden" id="table_student_register_list">
											<thead class="bg-200 text-black">
												<tr>
													<th scope="col">Application #</th>
													<th scope="col">Student Name</th>
													<th scope="col">EMIS</th>
													<th scope="col">Mobile Number</th>
													<th scope="col">Email</th>
													<th scope="col">Aadhaar</th>
													<th scope="col">Institution</th>
													<th scope="col">Degree</th>
													<th scope="col">Subject</th>
													<th scope="col">Rejected Reason</th>
													<th scope="col" class=""></th>

												</tr>
											</thead>
											<tbody id="rejected_tbody">



											</tbody>
										</table>
									</div>





								</div>
								<!--not approved list -->




							</div>


						</div>


					</div>
				</div>




				<!-- reject reason Modal -->
				<div class="modal fade" id="rejectreson" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="staticBackdropLabel"> Reject Reasons </h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<form class="row g-3 needs-validation" novalidate="">

									<div class="col-md-5 mb-3  ps-3">
										<input type="hidden" id="student_uniqid">
										<label class="form-label" for="inputAddress"> Reason Type</label>
										<select class="form-select" id="reason_list" required="">

										</select>
									</div>



								</form>

							</div>
							<div class="modal-footer">

								<button type="button" onclick="reject_student()" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</div>
				<!-- reject reason Modal -->


				<?php
				include('footer1.php')
				?>
			</div>
		</div>

		<!-- ===============================================-->
		<!--    End of Main Content-->
		<!-- ===============================================-->

		<?php include('footer_script.php') ?>

	</main>
	<script src="./assets/js/welfare.js"></script>
</body>

</html>