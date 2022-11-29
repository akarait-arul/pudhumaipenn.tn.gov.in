	<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
		<div class="col text-center nav-item .d-md-none .d-lg-block">
			<h4>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme </h4>
			<h5 id="current_user_heading"  class="">    </h5>
		</div>
		<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggle-icon">
				<span class="toggle-line"></span>
			</span>
		</button>
		<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
			<li class="nav-item dropdown">

				<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
					<div class="card card-notification shadow-none">
						<div class="card-header">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h6 class="card-header-title mb-0">Notifications</h6>
								</div>
								<div class="col-auto ps-0 ps-sm-3">
									<a class="card-link fw-normal" href="#">Mark all as read</a>
								</div>
							</div>
						</div>
						<div class="scrollbar-overlay" style="max-height:19rem">
							<div class="list-group list-group-flush fw-normal fs--1">
								<div class="list-group-title border-bottom">NEW</div>
								<div class="list-group-item">
									<a class="notification notification-flush notification-unread" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-2xl me-3">
												<img class="rounded-circle" src="./assets/img/team/1-thumb.png" alt="" />
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1">
												<strong>Emma Watson</strong> replied to your comment : "Hello world 😍"
											</p>
											<span class="notification-time">
												<span class="me-2" role="img" aria-label="Emoji">💬</span>Just now </span>
										</div>
									</a>
								</div>
								<div class="list-group-item">
									<a class="notification notification-flush notification-unread" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-2xl me-3">
												<div class="avatar-name rounded-circle">
													<span>AB</span>
												</div>
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1">
												<strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status
											</p>
											<span class="notification-time">
												<span class="me-2 fab fa-gratipay text-danger"></span>9hr </span>
										</div>
									</a>
								</div>
								<div class="list-group-title border-bottom">EARLIER</div>
								<div class="list-group-item">
									<a class="notification notification-flush" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-2xl me-3">
												<img class="rounded-circle" src="./assets/img/icons/weather-sm.jpg" alt="" />
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
											<span class="notification-time">
												<span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d </span>
										</div>
									</a>
								</div>
								<div class="list-group-item">
									<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-xl me-3">
												<img class="rounded-circle" src="./assets/img/logos/oxford.png" alt="" />
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1">
												<strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"
											</p>
											<span class="notification-time">
												<span class="me-2" role="img" aria-label="Emoji">✌️</span>1w </span>
										</div>
									</a>
								</div>
								<div class="list-group-item">
									<a class="border-bottom-0 notification notification-flush" href="#!">
										<div class="notification-avatar">
											<div class="avatar avatar-xl me-3">
												<img class="rounded-circle" src="./assets/img/team/10.jpg" alt="" />
											</div>
										</div>
										<div class="notification-body">
											<p class="mb-1">
												<strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund
											</p>
											<span class="notification-time">
												<span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d </span>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="card-footer text-center border-top">
							<a class="card-link d-block" href="#">View all</a>
						</div>
					</div>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="avatar avatar-xl">
						<img class="rounded-circle" src="./assets/img/team/avatar.png" alt="" />
					</div>
				</a>
				<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
					<div class="bg-white dark__bg-1000 rounded-2 py-2">
						<a class="dropdown-item" href="#">

							<?php echo isset($_SESSION['user_details']['email_id']) ? $_SESSION['user_details']['email_id'] : ''  ?>

						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
				</div>
			</li>
		</ul>
	</nav>
	<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
		<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggle-icon">
				<span class="toggle-line"></span>
			</span>
		</button>
		<a class="navbar-brand me-1 me-sm-3" href="./index-2.html">
			<div class="d-flex align-items-center">
				<img class="me-2" src="./assets/img/logos/tamilnadu_logo.png" alt="" width="40" />
				<span class="font-sans-serif">Government of <br>TamilNadu </span>
			</div>
		</a>
		<div class="collapse navbar-collapse scrollbar" id="navbarStandard">
			<ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dashboards">Dashboard</a>
					<div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="dashboards">
						<div class="bg-white dark__bg-1000 rounded-3 py-2">
							<a class="dropdown-item link-600 fw-medium" href="./index-2.html">Default</a>
							<a class="dropdown-item link-600 fw-medium" href="./dashboard/analytics.html">Analytics</a>
							<a class="dropdown-item link-600 fw-medium" href="./dashboard/crm.html">CRM</a>
							<a class="dropdown-item link-600 fw-medium" href="./dashboard/e-commerce.html">E commerce</a>
							<a class="dropdown-item link-600 fw-medium" href="./dashboard/project-management.html">Management</a>
							<a class="dropdown-item link-600 fw-medium" href="./dashboard/saas.html">SaaS</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

			<li class="nav-item dropdown">
				<a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="avatar avatar-xl">
						<img class="rounded-circle" src="./assets/img/team/3-thumb.png" alt="" />
					</div>
				</a>
				<div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
					<div class="bg-white dark__bg-1000 rounded-2 py-2">
						<a class="dropdown-item" href="#">Profile &amp; account</a>

						<a class="dropdown-item" href="index.php">Logout</a>
					</div>
				</div>
			</li>
		</ul>
	</nav>

	<script>
		//var navbarPosition = localStorage.getItem('navbarPosition');
		//var navbarVertical = document.querySelector('.navbar-vertical');
		//var navbarTopVertical = document.querySelector('.content .navbar-top');
		var navbarTop = document.querySelector('[data-layout] .navbar-top');
		var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

		//navbarVertical.removeAttribute('style');
		//navbarTopVertical.removeAttribute('style');
		navbarTop.remove(navbarTop);
		navbarTopCombo.remove(navbarTopCombo);



		
		$(document).ready(function() {

<?php  
	if($_SESSION['user_details']['user_type'] == '31'){

?>
			getInstitutionList();
<?php
	}

?>

		});

		//get institution name list
		function getInstitutionList() {

			<?php

				//var_dump($_SESSION['']['']);

			if ($_SESSION['user_details']['user_type'] == '30') {

				$district_instiid =  'all';
				 

			} else if ($_SESSION['user_details']['user_type'] == '31') {

				$district_instiid =   is_array($_SESSION['user_details']['institution_id']) ?  $_SESSION['user_details']['institution_id'][0] : '';
			} else if($_SESSION['user_details']['user_type'] == '20'){

				$district_instiid =  'all';
			}
			?>


			//getting disctrict

			var district_instiid = '<?php echo  isset($district_instiid)   ?   trim($district_instiid) : '';	?>';
			$.ajax({

				method: "POST",
				url: "ajax.php",
				data: {
					type: 'getInstitutionbyusertype',
					district: district_instiid


				},
				beforeSend: function() {
					$('.course_loader').preloader({
						text: 'processing please Wait ....'
					});
				},
				success: function(response) {

					$('.course_loader').preloader('remove');

					resdata = $.parseJSON(response);
					if (resdata['error_code'] == 200 && resdata['error_status']) {

						 
						$("#current_user_heading").html('[ <span  style="color:#64a6ff"> '+resdata.error_msg.institution_name+' </span> ]');


					} else if (resdata['error_code'] == 400 && !resdata['error_status']) {

						Swal.fire(resdata['error_msg'])

					}

				}

			});
		}
		//get institution name list
	</script>