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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
	<div class="col-8 align-self-center loader"></div>
		<div class="container-fluid" data-layout="container">
			<?php include('sideNav.php') ?>
			<div class="content">
				<?php include('topnav.php') ?>



				<div class="card mb-3 ">
					<div class="card-header border-bottom">
						<div class="row flex-between-end">
							<div class="col-auto align-self-center">
								<h5 class="mb-0"> EMIS </h5>

							</div>

						</div>
					</div>

					<div class="card-body pt-0  bg-light">


						 

							<?php include "emis_common_form.php";    ?>


						 

						
						 


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
		 




		//validation form 
		(() => {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			const forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.from(forms).forEach(form => {
				form.addEventListener('submit', event => {

					$("#dob_errmsg").hide();
					if (!form.checkValidity()) {

						event.preventDefault();
						event.stopPropagation();

						if (!$("#student_dob").val()) {
							$("#dob_errmsg").show();
						}


					} else {

						if ($("#student_dob").val()) { 

							event.preventDefault();
							event.stopPropagation();



							getEmisDetails();

						} else {

							event.preventDefault();
							event.stopPropagation();
							$("#dob_errmsg").show()
						}




					}

					form.classList.add('was-validated')
				}, false)
			})
		})()


		//validation form



		 
	</script>


</body>

</html>