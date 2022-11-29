   <nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-vibrant">
   	<div class="d-flex align-items-center">
   		<div class="toggle-icon-wrapper">
   			<button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
   				<span class="navbar-toggle-icon">
   					<span class="toggle-line"></span>
   				</span>
   			</button>
   		</div>
   		<a class="navbar-brand" href="#">
   			<div class="d-flex align-items-center py-3">
   				<img class="me-2" src="assets\img\logos\tamilnadu_logo.png" alt="" width="40">
   				<span class="font-sans-serif">
   					<h6>Government of <br>TamilNadu </h6>
   				</span>
   			</div>
   		</a>
   	</div>
   	<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
   		<div class="navbar-vertical-content scrollbar">
   			<ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
   				<li class="nav-item">
   					<ul class="nav collapse" id="dashboard">
   						<li class="nav-item">
   							<a class="nav-link" href="./index-2.html" data-bs-toggle="" aria-expanded="false">
   								<div class="d-flex align-items-center">
   									<span class="nav-link-text ps-1">Default</span>
   								</div>
   							</a>
   							<!-- more inner pages-->
   						</li>
   					</ul>
   				</li>
   				<li class="nav-item">
   					<!-- parent pages-->
   					<a class="nav-link" href="dashboard.php" role="button" data-bs-toggle="" aria-expanded="false">
   						<div class="d-flex align-items-center">
   							<span class="nav-link-icon">
   								<svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
   									<path fill="currentColor" d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path>
   								</svg>
   								<!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com -->
   							</span>
   							<span class="nav-link-text ps-1">DASHBOARD</span>
   						</div>
   					</a>
   					<!-- parent pages-->

						<?php

						if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 31) {

						?>

   						<a class="nav-link" href="student_register_list.php" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fa fa-users" aria-hidden="true"></i>
   								</span>
   								<span class="nav-link-text ps-1">Scholarship Registration</span>
   							</div>
   						</a>
   						<a class="nav-link" href="course_mapping.php" role="button" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fas fa-clipboard-list"></i>
   								</span>
   								<span class="nav-link-text ps-1"> Courses </span>
   							</div>
   						</a>

   					<?php

						}

						?>
   					<?php

						if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 30 || isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 40) {

						?>

   						<a class="nav-link" href="institution_list_dot.php" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fa fa-users" aria-hidden="true"></i>
   								</span>
   								<span class="nav-link-text ps-1">Institution Registered List </span>
   							</div>
   						</a>





   					<?php

						}

						?>
   					<!--<a class="nav-link" href="college_view_registration.php" data-bs-toggle="" aria-expanded="false">
    								<div class="d-flex align-items-center">
    									<span class="nav-link-icon">
    										<i class="fas fa-street-view"></i>
    									</span>
    									<span class="nav-link-text ps-1">View Registration Details</span>
    								</div>
    					</a>

						 <a class="nav-link" href="attendance_verification.php" data-bs-toggle="" aria-expanded="false">
    								<div class="d-flex align-items-center">
    									<span class="nav-link-icon">
    										<i class="fas fa-user-check"></i>
    									</span>
    									<span class="nav-link-text ps-1">Attendance Verification</span>
    								</div>
    					</a> -->

   					<!-- <a class="nav-link" href="stop_payment_bulk.php" data-bs-toggle="" aria-expanded="false">
    								<div class="d-flex align-items-center">
    									<span class="nav-link-icon">
    										<i class="fas fa-credit-card"></i>
    									</span>
    									<span class="nav-link-text ps-1">Stop Payment Bulk</span>
    								</div>
    					</a> -->

   					<!-- <a class="nav-link" href="stop_payment_individual.php" data-bs-toggle="" aria-expanded="false">
    								<div class="d-flex align-items-center">
    									<span class="nav-link-icon">
    										<i class="fas fa-credit-card"></i>
    									</span>
    									<span class="nav-link-text ps-1">Stop Payment Individual</span>
    								</div>
    					</a> -->

   					<?php

						/* if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 40) { */

						?>

   						<!--<a class="nav-link" href="institution_register_list.php" role="button" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fas fa-clipboard-list"></i>
   								</span>
   								<span class="nav-link-text ps-1"> Registered Institutes</span>
   							</div>
   						</a>-->

   					<?php

						/* } */

						?>

   					<?php

						if (isset($_SESSION['user_details']['user_type']) && $_SESSION['user_details']['user_type'] == 20) {

						?>

   						<a class="nav-link" href="welfare_view_student.php" role="button" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fas fa-clipboard-list"></i>
   								</span>
   								<span class="nav-link-text ps-1"> Registered Students List </span>
   							</div>
   						</a>

   					<?php

						}

						?>

   					<?php

						if (isset($_SESSION['user_details']['user_type']) && ($_SESSION['user_details']['user_type'] == '31'  or $_SESSION['user_details']['user_type'] == '40' ) ) {

						?>
   						<a class="nav-link" href="emis.php" role="button" data-bs-toggle="" aria-expanded="false">
   							<div class="d-flex align-items-center">
   								<span class="nav-link-icon">
   									<i class="fas fa-search"></i>
   								</span>
   								<span class="nav-link-text ps-1"> Know Your EMIS</span>
   							</div>
   						</a>

   					<?php

						}

						?>

   					<!--    					<a class="nav-link" href="logout.php" role="button" data-bs-toggle="" aria-expanded="false">
   						<div class="d-flex align-items-center">
   							<span class="nav-link-icon">
   								<i class='fas fa-sign-out-alt fa-lg'></i>
   							</span>
   							<span class="nav-link-text ps-1">Logout</span>
   						</div>
   					</a> -->

   				</li>
   		</div>

   		<!-- <div class="footer">
   			<div class="card shadow-none">
   				<div class="card-body alert mb-0" role="alert">
   					<div class="text-center">
   						<div class="avatar avatar-xl">
   							<img class="rounded-circle" src="./assets/img/team/avatar.png" alt="">
   						</div>
   						<p class="fs--2 mt-2">
   							<?php
								//echo  isset($_SESSION['user_details']['email_id']) ?  trim($_SESSION['user_details']['email_id'])   :   '';


								?>






   						</p>
   						<div class="d-grid">
   							<a class="btn btn-sm btn-primary" href="logout.php" target="_blank">Logout</a>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div> -->

   	</div>
   </nav>



   <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-xl">
   	<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation">
   		<span class="navbar-toggle-icon">
   			<span class="toggle-line"></span>
   		</span>
   	</button>
   	<a class="navbar-brand me-1 me-sm-3" href="./index-2.html">
   		<div class="d-flex align-items-center">
   			<img class="me-2" src="./assets/img/logos/tamilnadu_logo.png" alt="" width="40" />
   			<span class="font-sans-serif">Governmaent of <br>TamilNadu </span>
   		</div>
   	</a>
   	<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

   		<li class="nav-item dropdown">
   			<a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   				<div class="avatar avatar-xl">
   					<img class="rounded-circle" src="./assets/img/team/avatar.png" alt="" />
   				</div>
   			</a>
   			<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
   				<div class="bg-white dark__bg-1000 rounded-2 py-2">
   					<a class="dropdown-item" href="#">Profile &amp; account</a>
   					<a class="dropdown-item" href="logout.php">Logout</a>
   				</div>
   			</div>
   		</li>
   	</ul>
   </nav>