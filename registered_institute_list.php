<?php
// Start the session
session_start();
if( !isset($_SESSION['user_details']['user_type']) and empty($_SESSION['user_details']['user_type'])  and !isset($_SESSION['user_details']['user_id'])  and empty($_SESSION['user_details']['user_id']) ){
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

        <!-- ===============================================-->
    <!--    CDN-->
    <!-- ===============================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"   crossorigin="anonymous" referrerpolicy="no-referrer" />

		
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
								<h5 class="mb-0"> List of Institution Registered </h5>								 
							</div>
							<?php 
							if($_SESSION['user_details']['user_type']==40){
							?>
							<div class="col-auto ms-auto">                 
								<a href="institution_registration.php"><button class="btn btn-outline-primary me-1 mb-1" type="button">Institution Register</button></a>
							</div>
							<?php							
							}
							?>							
						</div>
					</div>
					
					<div class="card-body bg-light">

						<div class="tab-content">
							
							<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="">
								
								<div class="tab-pane preview-tab-pane active mt-4" role="tabpanel" aria-labelledby="tab-dom-13b9089c-cd1b-4371-96a9-627d68adcd04" id="dom-13b9089c-cd1b-4371-96a9-627d68adcd04">

									<div class="table-responsive scrollbar">
										
                                        <table class="table cell-border table-striped overflow-hidden" id="table_institution_register_list"  >
											<thead>
												<tr>

													<th scope="col">Institution Name</th>
													<th scope="col">District</th>
													<th scope="col">Contact Person</th>
													<th scope="col">Email Id</th>
													<th scope="col">Mobile No</th>
													<th scope="col">Address</th>
													<th scope="col">Pincode</th>
													<!--<th scope="col">Action</th>-->
													 
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
                
				<footer class="footer">
					<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
					<div class="col-12 col-sm-auto text-center">
						<p class="mb-0 text-600">Akara Research & Technologies Pvt Ltd <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2022 &copy;</p>
					</div>
					</div>
				</footer>



	<!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->
	
    
    <?php include('footer_script.php') ?>
	
	</main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"  ></script>

	<script>
		
		$(document).ready(function () {
			
			$.ajax({

				type:"POST",
				url:"./ajax.php",
				data:{
					type:'registeredInstituteListdot',							
				},
				success:function(response){				
					var resdata = $.parseJSON(response);
					$('#table_institution_register_list').dataTable({
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
							{ data: 'institution_name' },
							{ data: 'district_name' },
							{ data: 'contact_person' },
							{ data: 'email_id' },
							{ data: 'mobile_number' },
							{ data: 'address' },
							{ data: 'pincode' },
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
			
			/* $('#table_institution_register_list').DataTable({
				processing: false,
				serverSide: false,
				ajax: {
					method:'POST',
					url: './ajax.php',
					data:{
						type: 'InstitutionRegisterList'
					}					
				},
				columns: [
					{ data: 'institution_name' },
					{ data: 'district_name' },
					{ data: 'contact_person' },
					{ data: 'email_id' },
					{ data: 'mobile_number' },
					{ data: 'address' },
					{ data: 'pincode' },
					{
						data: null,
						'render': function (data, type, row) {
							return '<i id="' + row.institution_register_id +'" onclick="editClick(this)" class="fas fa-check-circle fa-lg" title="Approve"></i>';							
						}
					}
				],
				"language": {
							"emptyTable": "No Records to display"
						}
			});		
 */
			/* $('#table_institution_register_list').on('click', 'td.editor-edit', function (e) {
				
				var table = $('#table_institution_register_list').DataTable();
				var id = table.row( this ).id();
                
                Swal.fire({
					title: 'Do you want to save the changes?',
					showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Save',
					denyButtonText: `Don't save`,
					}).then((result) => {
					//Read more about isConfirmed, isDenied below
					if (result.isConfirmed) {
						Swal.fire('Saved!', '', 'success')
					} else if (result.isDenied) {
						Swal.fire('Changes are not saved', '', 'info')
					}
					})

				//e.preventDefault();		

			}); */

		});

		function editClick(id)	{

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

		function verifyInstitution(id){

			if(id !='' && id !=0){

				$.ajax({
                  
					method:"POST",
					url:"ajax.php",
					data:{
						id:id,
						type:'verifyInstitution'				
					},
					success:function(response){
  
						resdata = $.parseJSON(response);
						if(resdata['error_code']==200){
						
							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							}) 
							location.reload();
	
						}else if(resdata['error_code']==400){
							
							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							}) 
	
						}else if(resdata['error_code']==405){
							
							Swal.fire({
								title: 'Message',
								text: resdata['error_msg']
							})         
						
						}
  
				  	}
				  
			  	});

			}

		}
		
	</script>


  </body>
 </html>
          

