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
								<h5 class="mb-0"  >   Stop Payment (Individual)  </h5>
								 
							</div>
							 
						</div>
					</div>
					
					<div class="card-body pt-0  bg-light">

						<div class="tab-content mt-3 ">
							
							<form class="row   mb-3" novalidate="" id="">
								
								<div class="col-md-4 col-auto">
									<label class="form-label" for="inputEmail4"> EMIS Number </label>
									<input class="form-control" id="phone_no" type="number" required="">
									<div class="invalid-feedback text-left">
										Please Enter EMIS Number
									</div>
								</div>
								<div class="col-md-3 col-auto">
									<label class="form-label" for="inputEmail4"> Phone Number </label>
									<input class="form-control" id="phone_no" type="number" required="">
									<div class="invalid-feedback text-left">
										Please Enter Phone Number
									</div>
								</div>
								<div class="col-md-4 align-self-end">
									<button class="btn btn-primary" type="buttom" id="otp_validation">Search</button>
								</div>
							</form>
							
						</div>
						<div class="border-bottom"></div>
						<div class="row tab-content mt-3 ">
							
							<div class="col-md-6  ">
								<div class="col  ">
									<label class="form-label" for="inputEmail4"> Student Name </label>
									<input class="form-control" id="phone_no" type="text" required="">
									<div class="invalid-feedback text-left">
										Please Enter Student Name
									</div>
								</div>

								

								<div class="col   ">
									<label class="form-label" for="inputEmail4"> Degree  </label>
									<input class="form-control" id="phone_no" type="text" required="">
									<div class="invalid-feedback text-left">
										Please Enter Degree
									</div>
								</div>

								
								<div class="col   ">
									<label class="form-label" for="inputEmail4"> Subject  </label>
									<input class="form-control" id="phone_no" type="text" required="">
									<div class="invalid-feedback text-left">
										Please Enter Subject
									</div>
								</div>

							</div>  

							<div class="col-md-6  ">

								<div class="col  ">
									<label class="form-label" for="inputAddress"> Reason </label>
									<select class="form-select" id="district" required="">
									<option selected="" disabled="" value=""> Choose Type </option>
									<option value="1"> Not Applicables </option>
									<option value="2">  Others   </option>
									
									
									</select>
									<div class="invalid-feedback text-left">
									Please Select Reason
									</div>
								</div>



								<div class="form-floating mt-3">
									 
									<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
									<label for="floatingTextarea">Remarks </label>
								</div>

							</div>

						 

								<div class="col-md-4  "> </div>	
								<div class="col-md-4  mt-3"> 

									<button class="btn btn-primary" type="buttom" id="otp_validation">Stop Payment</button>

								</div>	
								<div class="col-md-4  "> </div>				 
							
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
          

