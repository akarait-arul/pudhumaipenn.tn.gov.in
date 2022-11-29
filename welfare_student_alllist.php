<?php
// Start the session
session_start();
//print_r($_SESSION);
//echo $_SESSION['user_details']['user_type'];
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
		<div class="container-fluid" data-layout="container">        
			<?php include('sideNav.php') ?>
			<div class="content">
				<?php include('topnav.php') ?>
                <div class="card mb-3 ">
					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0"> List of Students Registered</h5>								 
							</div>
							<?php 
								if($_SESSION['user_details']['user_type']==31){			

							?>
							<div class="col-auto ms-auto">                 
								<a href="scholarship_registration.php"><button class="btn btn-outline-primary me-1 mb-1" type="button">Scholarship Registration</button></a>
							</div>
							<?php
							
							}

							?>
						</div>
					</div>
					
					<div class="card-body bg-light">

						<div class="tab-content">
							
							<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="">
								
								<!--<form class="row g-3 needs-validation   mb-3" novalidate="" id="student_registration">

									<div class="col-md-3 col-auto ">
										<label class="form-label" for="inputEmail4"> EMIS Number </label>
										<input class="form-control" id="phone_no" type="number" required="">
										<div class="invalid-feedback text-left">
											Please Enter EMIS Number
										</div>
									</div>
									<div class="col-md-3 col-auto">
										<label class="form-label" for="inputAddress">Degree </label>
										<select class="form-select" id="degree" required="">
										  <option selected="" disabled="" value="">Choose Degree</option>
										  <option value="1">B.Sc</option>
										  <option value="2">B.E</option>
										  <option value="3">Diploma</option>
										  <option value="3">ITI</option>
										</select>
										<div class="invalid-feedback text-left">
										  Please Select Degree
										</div>
									</div>									
									<div class="col-md-3 col-auto">
										<label class="form-label" for="inputAddress"> Subject  </label>
										<select class="form-select" id="degree" required="">
										  <option selected="" disabled="" value="">Choose Subject</option>
										  <option value="1"> Computer Science  </option>
										  <option value="2"> Maths </option>
										  <option value="3"> Economics </option>
										  <option value="3"> 2016 </option>
										</select>
										<div class="invalid-feedback text-left">
										  Please Select Subject
										</div>
									</div>
									 
								</form>

								<div class="border-bottom">
								</div>-->



								<div class="tab-pane preview-tab-pane active mt-4" role="tabpanel" aria-labelledby="tab-dom-13b9089c-cd1b-4371-96a9-627d68adcd04" id="dom-13b9089c-cd1b-4371-96a9-627d68adcd04">

									<div class="table-responsive scrollbar">
										<table class="table cell-border table-striped overflow-hidden" id="table_student_register_list"  >
											<thead>
												<tr>
													
													<th scope="col">Student Name</th>
													<th scope="col">Phone Number</th>
													<th scope="col">Email ID</th>													
													<th scope="col">EMIS No</th>
													<th scope="col">Aadhaar No</th>
													<th scope="col">Reg Date</th>
													<th scope="col">Department</th>
													<th scope="col">Subject</th>
													<!-- <th scope="col" class="">Action</th> -->
													 
												</tr>
												 
					
											</thead>
											<tbody>
					
												 
											</tbody>
										</table>
									</div>
								</div>


							</div>

						</div>

						 
					</div>
				</div>

			<?php
			include('footer1.php')
			?>


	


	<!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->
	
    <script>
		
		$(document).ready(function () {
			
			$.fn.dataTable.render.moment = function ( from, to, locale ) {
				// Argument shifting
				if ( arguments.length === 1 ) {
					locale = 'en';
					to = from;
					from = 'YYYY-MM-DD';
				}
				else if ( arguments.length === 2 ) {
					locale = 'en';
				}
			
				return function ( d, type, row ) {
					if (! d) {
						return type === 'sort' || type === 'type' ? 0 : d;
					}
			
					var m = window.moment( d, from, locale, true );
			
					// Order and type get a number value from Moment, everything else
					// sees the rendered value
					return m.format( type === 'sort' || type === 'type' ? 'x' : to );
				};
			};

			$.ajax({

				type:"POST",
				url:"./ajax.php",
				data:{
					type:'studentRegisterList',							
				},
				success:function(response){				
					var resdata = $.parseJSON(response);
					$('#table_student_register_list').dataTable({
						dom: 'Bfrtip',
						buttons: [
							{ 
								extend: 'excel',
								title: '',
								style: 'background-color:blue;',
								exportOptions: {
									columns: [0,1,2,3,4,5,6,7,8]
								} 
							},

						],
						initComplete: function () {
							var btns = $('.dt-button');
							btns.addClass('btn btn-success btn-sm');
							btns.removeClass('dt-button');

						},
						responsive: true,
						columnDefs: [
							{ responsivePriority: 10001, targets: 4 },
							{ responsivePriority: 10001, targets: 2 },
							{ responsivePriority: 10001, targets: 6 },
						],
						"bDestroy": true,
						data: resdata['data'],
						"columns": [
							{ "data": 'phone_number' },
							{ "data": 'email_id' },
							{ "data": 'student_name_emis' },
							{ "data": 'emis_id' },
							{ "data": 'aadhaar_no' },
							{ "data": 'date_of_admission'},
							{ "data": 'degree' },
							{ "data": 'subject' }
							/* {
								data: null,
								'render': function (data, type, row) {
									return '<i id="' + row.student_registration_id +'" onclick="editClick(this)" class="fas fa-edit"></i>';							
								}
							} */ 						
						],
						"language": {
							"emptyTable": "No Records to display"
						}
					});
					
				}

			});

			/* $.ajax({
				method: "POST",
				url: "./ajax.php",
				data: {					
					type: 'studentRegisterList'
				},
				success: function(response) {
					resdata = JSON.parse(response);
					console.log(resdata);
					$('#table_student_register_list').DataTable( {
						data: resdata,
						columns: [
							{ "data": 'phone_number' },
							{ "data": 'email_id' },
							{ "data": 'student_name_emis' },
							{ "data": 'emis_id' },
							{ "data": 'aadhaar_no' },
							{ "data": 'date_of_admission' },
							{ "data": 'degree' },
							{ "data": 'subject' }/*,
							{
								data: null,
								'render': function (data, type, row) {
									return '<i id="' + row.student_registration_id +'" onclick="editClick(this)" class="fas fa-edit"></i>';							
								}
							} 
						],
					} );

				}
			});
			 */

			
			
			

			$('#table_student_register_list').on('click', 'td.editor-edit', function (e) {
				
				var table = $('#table_student_register_list').DataTable();
				var id = table.row( this ).id();
 
 				Swal.fire({
					title: 'Are you sure?',
					text: "You want to complete the application !!!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
					}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire(
						'Edit',
						'Your file has been edit.',
						'success'
						)
					}
				})
				e.preventDefault();
		

			});

		});

		function editClick(id){

			var rowID = $(id).attr('id');
			Swal.fire({
				title: 'Are you sure?',
				text: "You want to complete the application !!!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
				}).then((result) => {
				if (result.isConfirmed) {
					
					window.location.href = "./student_registration.php?id=" + rowID;					
				
				}
			})

			e.preventDefault();	

		}
	</script>
    <?php include('footer_script.php') ?>
	
	</main>
  </body>
 </html>
          

