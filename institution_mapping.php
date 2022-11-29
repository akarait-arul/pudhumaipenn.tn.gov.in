<?php //include_once('./valid_login.php'); ?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Scholarship</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    
    <script src="vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <link href="./vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" id="custom-css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
    
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
 	  <div class="container-fluid" data-layout="container">
 		<script>
 		var isFluid = JSON.parse(localStorage.getItem('isFluid'));
 		if(isFluid) {
 			var container = document.querySelector('[data-layout]');
 			container.classList.remove('container');
 			container.classList.add('container-fluid');
 		}
 		</script>
 		<nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-vibrant" style="display: none;">
 			<script>
 			var navbarStyle = localStorage.getItem("navbarStyle");
 			if(navbarStyle && navbarStyle !== 'transparent') {
 				document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
 			}
 			</script>
 			<div class="d-flex align-items-center">
 				<div class="toggle-icon-wrapper">
 					<button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
 				</div><a class="navbar-brand" href="index.html">
 					<div class="d-flex align-items-center py-3"><img class="me-2" src="assets\img\logos\tamilnadu_logo.png" alt="" width="40" /><span class="font-sans-serif">
 							<h6>Government of <br>TamilNadu</h6>
 						</span></div>
 				</a>
 			</div>
 			<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
 				<div class="navbar-vertical-content scrollbar">
 					<ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
 						<li class="nav-item">
 							<ul class="nav collapse show" id="dashboard">
 								<a class="nav-link" href="#" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
 												<path fill="currentColor" d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path>
 											</svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com -->
 										</span>
 										<span class="nav-link-text ps-1">DASHBOARD</span>
 									</div>
 								</a>
 								<!-- parent pages-->
 								<a class="nav-link" href="#" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fa fa-users" aria-hidden="true"></i>
 										</span>
 										<span class="nav-link-text ps-1">Student Details</span>
 									</div>
 								</a>
 								<a class="nav-link" href="student_registration.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fas fa-file-invoice"></i>
 										</span>
 										<span class="nav-link-text ps-1">Student Registration</span>
 									</div>
 								</a>
 								<a class="nav-link" href="student_register_list.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fa fa-history" aria-hidden="true"></i>
 										</span>
 										<span class="nav-link-text ps-1">Registration History</span>
 									</div>
 								</a>
 								<a class="nav-link" href="welfare_view_student.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fa fa-building" aria-hidden="true"></i>
 										</span>
 										<span class="nav-link-text ps-1">Welfare Department</span>
 									</div>
 								</a>
 								<a class="nav-link" href="college_view_registration.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fas fa-street-view"></i>
 										</span>
 										<span class="nav-link-text ps-1">View Registration Details</span>
 									</div>
 								</a>
 								<a class="nav-link" href="attendance_verification.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fas fa-user-check"></i>
 										</span>
 										<span class="nav-link-text ps-1">Attendance Verification</span>
 									</div>
 								</a>
 								<a class="nav-link" href="stop_payment_bulk.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fas fa-credit-card"></i>
 										</span>
 										<span class="nav-link-text ps-1">Stop Payment Bulk</span>
 									</div>
 								</a>
 								<a class="nav-link" href="stop_payment_individual.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class="fas fa-credit-card"></i>
 										</span>
 										<span class="nav-link-text ps-1">Stop Payment individual</span>
 									</div>
 								</a>
 								<a class="nav-link" href="index.php" role="button" data-bs-toggle="" aria-expanded="false">
 									<div class="d-flex align-items-center">
 										<span class="nav-link-icon">
 											<i class='fas fa-sign-out-alt fa-lg'></i>
 										</span>
 										<span class="nav-link-text ps-1">Logout</span>
 									</div>
 								</a>
 							</ul>
 						</li>
 					</ul>
 				</div>
 			</div>
 		</nav>
 		<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-xl" style="display: none;">
 			<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
 			<a class="navbar-brand me-1 me-sm-3" href="index.html">
 				<div class="d-flex align-items-center"><img class="me-2" src="assets\img\logos\tamilnadu_logo.png" alt="" width="40" /><span class="font-sans-serif">
 						<h6>Government of <br>TamilNadu</h6>
 					</span></div>
 			</a>
 			<div class="collapse navbar-collapse scrollbar" id="navbarStandard">
 			</div>
 			<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
 				<li class="nav-item dropdown">
 					<a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
 					<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
 						<div class="card card-notification shadow-none">
 							<div class="card-header">
 								<div class="row justify-content-between align-items-center">
 									<div class="col-auto">
 										<h6 class="card-header-title mb-0">Notifications</h6>
 									</div>
 									<div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
 								</div>
 							</div>
 							<div class="scrollbar-overlay" style="max-height:19rem">
 								<div class="list-group list-group-flush fw-normal fs--1">
 									<div class="list-group-title border-bottom">NEW</div>
 									<div class="list-group-item">
 										<a class="notification notification-flush notification-unread" href="#!">
 											<div class="notification-avatar">
 												<div class="avatar avatar-2xl me-3">
 													<img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="" />
 												</div>
 											</div>
 											<div class="notification-body">
 												<p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
 												<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
 											</div>
 										</a>
 									</div>
 									<div class="list-group-item">
 										<a class="notification notification-flush notification-unread" href="#!">
 											<div class="notification-avatar">
 												<div class="avatar avatar-2xl me-3">
 													<div class="avatar-name rounded-circle"><span>AB</span></div>
 												</div>
 											</div>
 											<div class="notification-body">
 												<p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
 												<span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
 											</div>
 										</a>
 									</div>
 									<div class="list-group-title border-bottom">EARLIER</div>
 									<div class="list-group-item">
 										<a class="notification notification-flush" href="#!">
 											<div class="notification-avatar">
 												<div class="avatar avatar-2xl me-3">
 													<img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="" />
 												</div>
 											</div>
 											<div class="notification-body">
 												<p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
 												<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
 											</div>
 										</a>
 									</div>
 									<div class="list-group-item">
 										<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
 											<div class="notification-avatar">
 												<div class="avatar avatar-xl me-3">
 													<img class="rounded-circle" src="assets/img/logos/oxford.png" alt="" />
 												</div>
 											</div>
 											<div class="notification-body">
 												<p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
 												<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
 											</div>
 										</a>
 									</div>
 									<div class="list-group-item">
 										<a class="border-bottom-0 notification notification-flush" href="#!">
 											<div class="notification-avatar">
 												<div class="avatar avatar-xl me-3">
 													<img class="rounded-circle" src="assets/img/team/10.jpg" alt="" />
 												</div>
 											</div>
 											<div class="notification-body">
 												<p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
 												<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>
 											</div>
 										</a>
 									</div>
 								</div>
 							</div>
 							<div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
 						</div>
 					</div>
 				</li>
 				<li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						<div class="avatar avatar-xl">
 							<img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
 						</div>
 					</a>
 					<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
 						<div class="bg-white dark__bg-1000 rounded-2 py-2">
 							<a class="dropdown-item" href="pages/user/settings.html">Settings</a>
 							<a class="dropdown-item" href="logout.php">Logout</a>
 						</div>
 					</div>
 				</li>
 			</ul>
 		</nav>
 		<div class="content">
 			<div class="col-8 align-self-center loader"></div>
 			<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
 				<div class="col text-center nav-item">
 					<h4>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme</h4>
 				</div>
 				<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
 					<li class="nav-item dropdown">
 						<a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
 						<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
 							<div class="card card-notification shadow-none">
 								<div class="card-header">
 									<div class="row justify-content-between align-items-center">
 										<div class="col-auto">
 											<h6 class="card-header-title mb-0">Notifications</h6>
 										</div>
 										<div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
 									</div>
 								</div>
 								<div class="scrollbar-overlay" style="max-height:19rem">
 									<div class="list-group list-group-flush fw-normal fs--1">
 										<div class="list-group-title border-bottom">NEW</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush notification-unread" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush notification-unread" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<div class="avatar-name rounded-circle"><span>AB</span></div>
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
 													<span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-title border-bottom">EARLIER</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-xl me-3">
 														<img class="rounded-circle" src="assets/img/logos/oxford.png" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="border-bottom-0 notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-xl me-3">
 														<img class="rounded-circle" src="assets/img/team/10.jpg" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>
 												</div>
 											</a>
 										</div>
 									</div>
 								</div>
 								<div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
 							</div>
 						</div>
 					</li>
 					<li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 							<div class="avatar avatar-xl">
 								<img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
 							</div>
 						</a>
 						<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
 							<div class="bg-white dark__bg-1000 rounded-2 py-2">
 								<a class="dropdown-item" href="pages/user/settings.html">Settings</a>
 								<a class="dropdown-item" href="logout.php">Logout</a>
 							</div>
 						</div>
 					</li>
 				</ul>
 			</nav>
 			<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
 				<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
 					<li class="nav-item dropdown">
 						<a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
 						<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
 							<div class="card card-notification shadow-none">
 								<div class="card-header">
 									<div class="row justify-content-between align-items-center">
 										<div class="col-auto">
 											<h6 class="card-header-title mb-0">Notifications</h6>
 										</div>
 										<div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
 									</div>
 								</div>
 								<div class="scrollbar-overlay" style="max-height:19rem">
 									<div class="list-group list-group-flush fw-normal fs--1">
 										<div class="list-group-title border-bottom">NEW</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush notification-unread" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush notification-unread" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<div class="avatar-name rounded-circle"><span>AB</span></div>
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
 													<span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-title border-bottom">EARLIER</div>
 										<div class="list-group-item">
 											<a class="notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-2xl me-3">
 														<img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-xl me-3">
 														<img class="rounded-circle" src="assets/img/logos/oxford.png" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
 												</div>
 											</a>
 										</div>
 										<div class="list-group-item">
 											<a class="border-bottom-0 notification notification-flush" href="#!">
 												<div class="notification-avatar">
 													<div class="avatar avatar-xl me-3">
 														<img class="rounded-circle" src="assets/img/team/10.jpg" alt="" />
 													</div>
 												</div>
 												<div class="notification-body">
 													<p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
 													<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>
 												</div>
 											</a>
 										</div>
 									</div>
 								</div>
 								<div class="card-footer text-center border-top"><a class="card-link d-block" href="app/social/notifications.html">View all</a></div>
 							</div>
 						</div>
 					</li>
 					<li class="nav-item dropdown">
 						<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
 							<div class="bg-white dark__bg-1000 rounded-2 py-2">
 								<a class="dropdown-item" href="pages/user/settings.html">Settings</a>
 								<a class="dropdown-item" href="logout.php">Logout</a>
 							</div>
 						</div>
 					</li>
 				</ul>
 			</nav>
 			<script>
 			var navbarPosition = localStorage.getItem('navbarPosition');
 			var navbarVertical = document.querySelector('.navbar-vertical');
 			var navbarTopVertical = document.querySelector('.content .navbar-top');
 			var navbarTop = document.querySelector('[data-layout] .navbar-top');
 			var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');
 			if(navbarPosition === 'top') {
 				navbarTop.removeAttribute('style');
 				navbarTopVertical.remove(navbarTopVertical);
 				navbarVertical.remove(navbarVertical);
 				navbarTopCombo.remove(navbarTopCombo);
 			} else if(navbarPosition === 'combo') {
 				navbarVertical.removeAttribute('style');
 				navbarTopCombo.removeAttribute('style');
 				navbarTop.remove(navbarTop);
 				navbarTopVertical.remove(navbarTopVertical);
 			} else {
 				navbarVertical.removeAttribute('style');
 				navbarTopVertical.removeAttribute('style');
 				navbarTop.remove(navbarTop);
 				navbarTopCombo.remove(navbarTopCombo);
 			}
 			</script>

 			
 			 

 			 
 
 			<footer class="footer">
 				<div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
 					<div class="col-12 col-sm-auto text-center">
 						<p class="mb-0 text-600">Akara Research & Technologies Pvt Ltd <span class="d-none d-sm-inline-block">|</span><br class="d-sm-none"> 2022 &copy;</p>
 					</div>
 				</div>
 			</footer>
      			
			 
			 
				<!-- ======================   popup for selecting the institution    =========================-->		

			<div class="modal fade " id="institution_mapping" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl mt-6"  style="max-width: 80%;" role="document">
					<div class="modal-content border-0">
						<div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
							<button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
						
						</div>
						<div class="modal-body p-0  pb-5">
							<div class="bg-light rounded-top-lg pt-3  ps-4 pe-6">
								<h4 class="mb-1" id="staticBackdropLabel"> Add Available Courses </h4>
								<p class="fs--2 mb-0">Added by <a class="link-600 fw-semi-bold" href="#">User</a></p>
							</div>
							<div class="pt-1 px-5 pb-2">
								<div class="row ">
									
									<form class="row g-3 needs-validation " novalidate="">
										
										<div class="col-md-4">
											<label class="form-label" for="district_list"> Institution Type </label>
											<select class="form-select" id="district_list" required=""   >
											<option value=""> Select Institution Type </option>
												<option value="1"> Arts and Science College   </option>
												<option value="2"> Engineering College </option>
												<option value="3"> Medical science  </option>
												<option value="3"> Medical science  </option>
												 

											</select>

											<div class="invalid-feedback">Please select a valid Institution Type.</div>
										</div>
										<div class="col-md-4">
											<label class="form-label" for="institution_list"> Select Department  </label>
											<select class="form-select" id="institution_list" required="">

											</select>

											<div class="invalid-feedback">Please select a valid Department.</div>
										</div>
										<div class="col-md-4">
											<label class="form-label" for="institution_list"> Select Course   </label>
											<select class="form-select" id="institution_list" required="">
											 
											</select>

											<div class="invalid-feedback">Please select a valid Department.</div>
										</div>

										 
										


										 
										<div class="col-12"><button class="btn btn-primary" type="submit">Submit form</button></div>
									</form>	


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- =====================  popup for selecting the institution ==========================-->

	<div class="dropdown-divider"></div>		  
			 

       

      <!-- ===============================================-->
 			<!--    End of Main Content-->
 			<!-- ===============================================-->
      <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/popper/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/anchorjs/anchor.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="vendors/echarts/echarts.min.js"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/list.js/list.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="./vendors/dropzone/dropzone.min.js"></script>
    <script src="./vendors/prism/prism.js"></script>
    <script src="./assets/js/flatpickr.js"></script>    
    
    <!-- Include Javascript Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">    

    <script src="./vendors/preloader/js/jquery.preloader.min.js"></script>
    <link rel="stylesheet" href="./vendors/preloader/css/preloader.css">

    <script>
      
		 

		 
		  

		 
     
       

       

       

	$(document).ready(function () {

		$('#institution_mapping').modal('show');	

		getDistrict();
		getInstitution();
			 

	});

      /* (function () {

        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            } else {
              
              	event.preventDefault();
			  	 
            }

            form.classList.add('was-validated')
          }, false)
        })

      })() */

	
	  
	function getInstitution() {




		$.ajax({  

			method:"POST",
			async : true,
			url:"ajax.php",
			data:{
				type:'GetInstitutions'
			},
			success:function(response){
			
				resdata = $.parseJSON(response);            
				if(resdata['error_code']==200 && resdata['error_msg']!=0){

					$('#institution_list').empty().append();
					$('#institution_list').append($("<option></option>").attr("value", '').text('Select Institution')); 
					$.each(resdata['error_msg'], function(index, value) {
              	    	$('#institution_list').append( $("<option></option>").attr("value", value['district_code']).text(value['district_name']) ); 
              		});
				}

			}              
		});


	}

       
        

    function getDistrict()  {

        $.ajax({  

          	method:"POST",
          	url:"ajax.php",
			 
			crossDomain: true,
          	data:{
            	type:'GetDistrict'
          	},
          	success:function(response){
            
            	resdata = $.parseJSON(response);            
            	if(resdata['error_code']==200 && resdata['error_msg']!=0){

              		$('#district_list').empty().append();
              		$('#district_list').append($("<option></option>").attr("value", '').text('Select District'));
					$.each(resdata['error_msg'], function(index, value) {
              	    	$('#district_list').append( $("<option></option>").attr("value", value['district_code']).text(value['district_name']) ); 
              		});

           		}

          }              
        });

     
    }

       

       
            
    
    </script>
    
  </body>
</html>