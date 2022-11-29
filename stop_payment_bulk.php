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
								<h5 class="mb-0"  >  Stop Payment ( Bulk )</h5>								 
							</div>
							
						</div>
					</div>
					
					<div class="card-body   bg-light">

						<div class="tab-content  ">
							
							<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="">
								
								<div class="tab-pane preview-tab-pane active mt-4" role="tabpanel" aria-labelledby="tab-dom-13b9089c-cd1b-4371-96a9-627d68adcd04" id="dom-13b9089c-cd1b-4371-96a9-627d68adcd04">

									<div class="table-responsive scrollbar">
										<table class="table table-hover table-striped overflow-hidden" id="student_reg_table"  >
											<thead>
												<tr>
													 
													<th scope="col">Student Name</th>
													<th scope="col">EMIS No.</th>
													<th scope="col">Aadhaar No.</th>
													<th scope="col">Reg Date</th>
													<th scope="col">Degree</th>
													<th scope="col">Subject</th>
													<th scope="col">Year of Stuyd</th>
													<th scope="col">Reason</th>
													 
												</tr>
												 
					
											</thead>
											<tbody>
												<tr class="align-middle">
													<td > Ricky Antony  </td>
													<td  >  1234568456  </td>
													<td  >   123654987123 </td>
													<td  > 12-12-2022 </td>
													 
													<td  >  B.B.A </td>
													<td  >  Economics </td>
													<td   >  2018  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
												<tr class="align-middle">
													<td  >Anna </td>
													<td  >  54125632578  </td>
													<td  >    123654987123  </td>
													<td  > 12-12-2022  </td>
													<td  >  B.C.A </td>
													<td  >  Computer Application </td>
													<td   >  2018  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
												<tr class="align-middle">
													<td  > Ricky Antony  </td>
													<td  >  63258741258963  </td>
													<td  >2392239223922392  </td>
													<td   > 12-05-2022 </td>
													<td  >  B.A </td>
													<td  >  English </td>
													<td   >  2019  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
												<tr class="align-middle">
													<td  >  Emily  </td>
													<td  >  123456789  </td>
													<td  >   741852963021   </td>
													 <td   > 12-05-2022 </td>
													<td  >  B.Sc </td>
													<td  >  Maths </td>
													<td   >  2021  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
												<tr class="align-middle">
													<td  > Emily  </td>
													<td  >  123456789  </td>
													<td  >    235689784512  </td>
													 
													<td   > 12-05-2022 </td>
													<td  >  B.Sc </td>
													<td  >  chemistry </td>
													<td   >  2019  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
					
												<tr class="align-middle">
													<td  >   Antony  </td>
													<td  >  123456789  </td>
													<td  >    235689784512  </td>
													<td   > 13-05-2022 </td>
													<td  >  B.B.A </td>
													<td  >  Economics </td>
													<td   >  2022  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
												<tr class="align-middle">
													<td  > Oscar </td>
													<td  >  123456789  </td>
													<td  >    235689784512  </td>
													<td   > 13-05-2022 </td>
													<td  >  B.B.A </td>
													<td  >  Economics </td>
													<td   >  2022  </td>
                                                    <td>
                                                        <select class="form-select" id="degree" required="">
                                                            <option selected="" disabled="" value="">Choose Reason</option>
                                                            <option value="1"> Reason 1 Test  </option>
                                                            <option value="2"> Reason 2 Test </option>
                                                            <option value="3"> Reason 3 Test </option>
                                                            <option value="3"> Reason 4 Test </option>
                                                        </select>
                                                    </td>
												</tr>
					
												 
											</tbody>
										</table>
									</div>
									<button class="btn btn-primary" type="buttom" id="otp_validation" style="float: right;">Submit</button>
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
  </body>
 </html>
          

