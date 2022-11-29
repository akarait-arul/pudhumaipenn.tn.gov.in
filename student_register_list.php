<?php
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
								<strong style="margin-right:10px;">Scholarship Registration</strong>
								<a class="btn btn-outline-primary me-1 mb-1" href="scholarship_registration.php" title="Scholarship Registration">With EMIS</a>
								<a class="btn btn-outline-primary me-1 mb-1" href="scholarship_registration_noemis.php" title="Non EMIS Scholarship Registration">Without EMIS</a>
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



								<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-13b9089c-cd1b-4371-96a9-627d68adcd04" id="dom-13b9089c-cd1b-4371-96a9-627d68adcd04">
									<div class="table-responsive scrollbar">
										<table class="cell-border" style="width:100%;font-size:12px" id="table_student_register_list">
											<thead class="thead-style">
												<tr>													
													<th scope="col">Application #</th>
													<th scope="col">Student Name</th>
													<th scope="col">Mobile #</th>
													<th scope="col">Email ID</th>													
													<th scope="col">EMIS #</th>
													<th scope="col">Aadhar #</th>
													<th scope="col">Reg Date</th>
													<th scope="col">Department</th>
													<th scope="col">Subject</th>
                                                                                                        <th scope="col">View</th>
                                                                                                        <th scope="col">Bank</th>

												</tr>				
											</thead>
											<tbody></tbody>
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
	

                    <?php include('footer_script.php') ?>

                    </main>
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
                                                //"ordering": false,
						"columns": [
							{ "data": 'student_registration_no' },
							{ "data": 'student_name_emis' },
							{ "data": 'phone_number' },
							{ "data": 'email_id' },							
							{
								data : null,
								'render': function(data,type,row){
									if(row.emis_id == 0){
										
										return '---';
									
									}else{
										
										return row.emis_id;
									}
								}
							},
                            {"data": 'aadhaar_no'},
                            {"data": 'reg_date'},
                            {"data": 'degree'},
                            {"data": 'subject'},
							{
								data: null, className: 'text-center vertical-middle',
								'render': function (data, type, row) {
                                                    return '<i id="' + row.student_registration_id + '" onclick="editClick(this)" class="fa fa-eye "></i>';
                                                }
                                            },
                                            {
                                                data: null, className: 'text-center vertical-middle',
                                                'render': function (data, type, row) {
                                                    if (row.update_flag_bank == 'Y') {
                                                        var _student_details = "Student Name : " + row.student_name_emis + '<br/>Application No : ' + row.student_registration_no;
                                                        //return '<i id="' + row.student_registration_id + '" onclick="UpdateBank("' + JSON.stringify(row) + '")" class="fas fa-university"></i>';
                                                        return `<i id="${row.student_registration_id}" onclick='UpdateBank("${row.student_registration_id}","${_student_details}");' class="cursor-pointer fas fa-university"></i>`;
                                                    } else if (row.update_flag_bank == 'N') {
                                                        return '<i class="cursor-pointer fas fa-check"></i>`';
                                                    } else if (row.update_flag_bank == 'P') {
                                                        return '<b>' + row.proposed_bank + '</b>';
                                                    }
								}
							} 						
						],
						"language": {
							"emptyTable": "No Records to display"
						},
                                                "order": []
					});
					
				}

			});

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
                                });
				e.preventDefault();
		

			});

		});

		function editClick(id){

			var rowID = $(id).attr('id');
			Swal.fire({
				text: "You want to view Scholarship Application Details ?",
				icon: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
				}).then((result) => {
				if (result.isConfirmed) {
                                    window.open("./student_profile.php?id=" + rowID, "_self");
                                }
                            });
				}

                        function UpdateBank(id, studentdetails) {

                            var rowID = id;
                            Swal.fire({
                                html: "Do you want to enter proposed bank for <br/><b>" + studentdetails +"</b> ?",
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#student_reg_id').val(rowID);
                                    $('#bank_verify_request').modal('show');
                                    $("#bank_verify")[0].reset();
                                    $("#branch_details").html('');
                                    //window.open("./student_profile.php?id=" + rowID, "_self");
                                }
                            });
		}
	</script>
	
                    <!-- Know Your EMIS Modal -->
                    <div class="modal fade" id="bank_verify_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"> Enter Proposed Bank Details </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <?php include "updatebankdetails.php" ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Know Your EMIS Search Modal -->

  </body>
 </html>
          

