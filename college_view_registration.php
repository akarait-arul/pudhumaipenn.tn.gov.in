<?php
// Start the session
session_start();
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
								<h5 class="mb-0" data-anchor="data-anchor"> College - View Registration Details </h5>
								 
							</div>
							 
						</div>
					</div>
					
					<div class="card-body pt-0 bg-light ">

						<div class="tab-content mt-3">
							<div class=" col-md-12 border-bottom mb-3">


								<form class="row ms-3 mb-5 " novalidate="" id="">
									
									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputAddress"> Department </label>
										<select class="form-select" id="district" required="">
										<option selected="" disabled="" value=""> Choose Type </option>
										<option value="1"> Computer Science  </option>
										<option value="2">  ITI  </option>
										 
										
										</select>
										<div class="invalid-feedback text-left">
										Please Select Department
										</div>
									</div>

									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputAddress"> District </label>
										<select class="form-select" id="district" required="">
										<option selected="" disabled="" value=""> Choose Type </option>
										<option value="1"> Ariyalur </option>
										<option value="2"> Chennai  </option>
										<option value="3"> Kancheepuram </option>
										
										</select>
										<div class="invalid-feedback text-left">
										Please Select District
										</div>
									</div>
									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputAddress"> Institution Type </label>
										<select class="form-select" id="degree" required="">
										<option selected="" disabled="" value=""> Choose Type</option>
										<option value="1"> Government </option>
										<option value="2"> Private  </option>
										<option value="3"> Gov. aided private </option>
										
										</select>
										<div class="invalid-feedback text-left">
										Please Select Institution Type
										</div>
									</div>
									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputAddress"> Institution </label>
										<select class="form-select" id="degree" required="">
										<option selected="" disabled="" value=""> Choose Type</option>
										<option value="1"> Anna University </option>
										<option value="2"> Saveetha University  </option>
										 
										</select>
										<div class="invalid-feedback text-left">
										Please Select Institution
										</div>
									</div>
									<div class="col-md-4 col-auto">
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
									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputAddress"> Year of Stuyd  </label>
										<select class="form-select" id="degree" required="">
										<option selected="" disabled="" value="">Choose Year</option>
										<option value="1"> 2018 </option>
										<option value="2"> 2019 </option>
										<option value="3"> 2017 </option>
										<option value="3"> 2016 </option>
										</select>
										<div class="invalid-feedback text-left">
										Please Select Year
										</div>
									</div>

									<div class="col-md-4 col-auto">
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

									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputEmail4"> EMIS Number </label>
										<input class="form-control" id="phone_no" type="number" required="">
										<div class="invalid-feedback text-left">
											Please Enter EMIS Number
										</div>
									</div>

									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputEmail4"> Aadhaar No. </label>
										<input class="form-control" id="phone_no" type="number" required="">
										<div class="invalid-feedback text-left">
											Please Enter EMIS Number
										</div>
									</div>

									<div class="col-md-4 col-auto">
										<label class="form-label" for="inputEmail4"> Reg date </label>
										<input class="form-control" id="phone_no" type="date" required="">
										<div class="invalid-feedback text-left">
											Please Enter EMIS Number
										</div>
									</div>
									
		
								</form>
							</div>
							
							 
							 


							<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-13b9089c-cd1b-4371-96a9-627d68adcd04" id="dom-13b9089c-cd1b-4371-96a9-627d68adcd04">

								
								 
								<div class="  row-cols-1 ms-2 mb-1 ms-3">
									<div class="col fs-1 mb-1"> District : District 1 </div>
									<div class="col fs-1"> College : College 1 </div>
									 
								</div>

								<div class="table-responsive scrollbar">
									<table class="table table-hover table-striped overflow-hidden" id="student_reg_table"  >
										<thead>
											<tr>
												<th scope="col"> Student Name</th>
												<th scope="col">EMIS No.</th>
												<th scope="col">Aadhaar No.</th>
												<th scope="col">Reg Date</th>
												<th scope="col">EMIS Validation </th>
												<th scope="col"> Aadhaar Validation </th>
												<th scope="col"> Bank Validation </th>
											</tr>
											 

										</thead>
										<tbody>
											<tr class="align-middle">
												<td > Ricky Antony  </td>
												<td  >  88896547  </td>
												<td  >   256345217458 </td>
												<td  > 12-12-2022 </td>
												 
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>  </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>  </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>     </td>
											</tr>
											<tr class="align-middle">
												<td  >Anna </td>
												<td  >  36951753  </td>
												<td  >    856987454521  </td>
												<td  > 12-12-2022  </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>  </td>
												<td  > <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span> </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>   </td>
											</tr>
											<tr class="align-middle">
												<td  > Ricky Antony  </td>
												<td  >  65485275  </td>
												<td  > 528147963120  </td>
												<td   > 12-05-2022 </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>  </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>  </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>  </td>
											</tr>
											<tr class="align-middle">
												<td  >  Emily  </td>
												<td  >  74185296  </td>
												<td  >   231564897321   </td>
											 	<td   > 12-05-2022 </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success"> Failed <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span> </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>  </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>  </td>
											</tr>
											<tr class="align-middle">
												<td  > Emily  </td>
												<td  >  23654166  </td>
												<td  >    753951842685  </td>
												 
												<td   > 12-05-2022 </td>
												<td  > <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span> </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>  </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success"> Failed <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>   </td>
											</tr>

											<tr class="align-middle">
												<td  >   Antony  </td>
												<td  >  32659874  </td>
												<td  >    524789632150  </td>
												<td   > 13-05-2022 </td>
												<td  > <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>  </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>  </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-success"> Failed <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>   </td>
											</tr>
											<tr class="align-middle">
												<td  > Oscar </td>
												<td  >  25874136  </td>
												<td  >    632154879632  </td>
												<td   > 13-05-2022 </td>
												<td  > <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span> </td>
												<td  >  <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span> </td>
												<td   >  <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>   </td>
											</tr>

											 
										</tbody>
									</table>
								</div>
							</div>

							
						</div>
						<div class="row col-md-12">

							<div class="col">  	</div>
							<div class="col"> 
								<div class=" row-cols-1 ">
									<div class="col fs-1">Total EMIS Validation<br>Successful:<br>Failure:</div>
									
									<div class="col fs-1">Total Aadhaar Validation<br>Successful:<br>Failure:</div>
									
									<div class="col fs-1">Total Bank Validation<br>successful:<br>Failure: </div>
									
								</div>
								
							</div> 
							<div class="col">  	</div> 
							
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
  </body>
 </html>
          

