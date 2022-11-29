<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme</title>

        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->

        <link href="./assets/css/theme.min.css" rel="stylesheet" id="style-default">

        <!-- ===============================================-->
        <!--    CDN-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"   crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./vendors/preloader/css/preloader.css">
        <script src="./vendors/preloader/js/jquery.preloader.min.js"></script>


    </head>
    <body>
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
            <div class="col-8 align-self-center loader"></div>
            <div class="container-fluid" data-layout="container">
                <div class="content">  
                    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
                        <div class="col text-center nav-item .d-md-none .d-lg-block">
                            <h4>Moovalur Ramamirtham Ammaiyar Higher Education Assurance Scheme</h4>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">

                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <a class="dropdown-item" href="#"></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="card mb-3 ">
                        <div class="card-header border-bottom">
                            <div class="row flex-between-end">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <h5 class="mb-0" id="followers">Scholarship Application Details</h5>								
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <h5>Application refrence No. <span id="student_registration_no"></span> </h5>	
                                    </div>
                                    <?php
                                    if (isset($_GET['from']) != 'dash') {
                                        if ($_SESSION['user_details']['user_type'] == 31) {
                                            echo '<div class="col-auto ms-auto"><a class="btn btn-warning" title="Redirect to student scholarship list" href="./student_register_list.php"> Back To List </a></div>';
                                        } else if ($_SESSION['user_details']['user_type'] == 20) {
                                            echo '<div class="col-auto ms-auto"><a class="btn btn-warning" title="Redirect to student scholarship list" href="./welfare_view_student.php"> Back To List </a></div>';
                                        } else {
                                            echo '<div class="col-auto ms-auto"><a class="btn btn-warning" title="Redirect to student scholarship list" href="./logout.php">Logout </a></div>';
                                        }
                                    }
                                    ?>

                                </div>                                
                            </div>
                        </div>            
                        <!--Student Details Start -->
                        <div class="row">
                            <div class="col-6">
                                <div class="card mb-3" id="student_details">
                                    <div class="card-header">
                                        <div class="row flex-between-end">
                                            <div class="col-auto align-self-center">
                                                <h5 class="mb-0" data-anchor="data-anchor">Student Details</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-light">
                                        <div class="tab-content">
                                            <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a">
                                                <form class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label " for="inputCity">
                                                            <span class="fw-bold">Student Name</span><br/>
                                                            <span id="student_name_emis"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity">
                                                            <span class="fw-bold">Date of Birth</span>
                                                            <br/>
                                                            <span id="date_of_birth"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity">
                                                            <span class="fw-bold">Gender</span>
                                                            <br/><span id="gender"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity"><span class="fw-bold">Aadhaar Number</span>  <br/><span id="aadhaar_no"></span></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity"><span class="fw-bold">EMIS ID</span>  <br/><span id="emis_id"></span></label>
                                                    </div>						  
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity"><span class="fw-bold">Religion</span> <br/><span id="religion"></span></label>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity"><span class="fw-bold">Community</span>  <br/><span id="community"></span></label>

                                                    </div>


                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity"><span class="fw-bold">Mother's Name</span> <br/><span id="mother_name"></span></label>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity">
                                                            <span class="fw-bold">Father's Name</span>  <br/>
                                                            <span id="father_name"></span>
                                                        </label>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity">
                                                            <span class="fw-bold">Parent Mobile Number</span> <br/>
                                                            <span id="parents_mobile"></span>
                                                        </label>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label" for="inputCity">
                                                            <span class="fw-bold">Guardian Name</span> <br/>
                                                            <span id="gender"></span>
                                                        </label>

                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Student Details End -->
                            <!--College Details Starts -->
                            <div class="col-6">
                                <div class="card mb-3" id="college_details">
                                    <div class="card-header">
                                        <div class="row flex-between-end">
                                            <div class="col-auto align-self-center">
                                                <h5 class="mb-0" data-anchor="data-anchor">College Details</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-light">
                                        <div class="tab-content">
                                            <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a">
                                                <form class="row g-3 needs-validation" novalidate id="form_college_details">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Institution Type</span>  <br/><span id="m_institution_type"></span></label>
                                                                </td>
                                                                <td colspan='3'>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Institution Name</span>  <br/><span id="m_institution_id"></span></label>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Degree</span>  <br/><span id="m_degree_id"></span></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Subject</span>  <br/><span id="m_subject_id"></span></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Year Of School Completion</span>  <br/><span id="school_complition_on"></span></label>
                                                                </td>
                                                                <td rowspan="3" style="text-align: center;padding: 0px;vertical-align: middle;">
                                                                    <img id="aadhaar_photo" class="center-block" alt="photo" src="" style="width:72%;">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Academic year</span>  <br/><span id="academic_year"></span></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Date of Admission</span>  <br/><span id="date_of_admission"></span></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-label" for="inputCity"><span class="fw-bold">Year of Study</span>  <br/><span id="year_of_study"></span></label>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--College Details End -->
                        <!--School details Start -->
                        <div class="card mb-3" id="student_school_details">
                            <div class="card-header">
                                <div class="row flex-between-end">
                                    <div class="col-auto align-self-center">
                                        <h5 class="mb-0" data-anchor="data-anchor">School Details</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-light">
                                <div class="tab-content">
                                    <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a">
                                        <form class="row g-3">
                                            <table class="table table-hover table-striped overflow-hidden" id="student_reg_table">
                                                <thead>
                                                    <tr style="background-color: #2c7be5;color: white;">
                                                        <th scope="col">Class</th>
                                                        <th scope="col">District</th>
                                                        <th scope="col"> School name</th>
                                                        <th scope="col"> Year of study </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="row_12th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">XII</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_12th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_12th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_12th"></span></label>
                                                        </td>              
                                                    </tr>
                                                    <tr id="row_11th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">XI</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_11th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_11th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_11th"></span></label>
                                                        </td>              
                                                    </tr>
                                                    <tr id="row_10th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">X</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_10th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_10th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_10th"></span></label>
                                                        </td>

                                                    </tr>
                                                    <tr id="row_9th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">IX</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_9th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_9th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_9th"></span></label>
                                                        </td>              
                                                    </tr>
                                                    <tr id="row_8th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">VIII</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_8th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_8th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_8th"></span></label>
                                                        </td>              
                                                    </tr>

                                                    <tr id="row_7th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">VII</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_7th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_7th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_7th"></span></label>
                                                        </td>              
                                                    </tr>
                                                    <tr id="row_6th">
                                                        <td>
                                                            <label class="form-label " for="inputAddress">VI</label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="district_6th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="school_6th"></span></label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label " for="inputAddress"><span id="year_of_study_6th"></span></label>
                                                        </td>              
                                                    </tr>

                                                </tbody>
                                            </table>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--School Details End -->
                    <!--Bank Details Start-->
                    <div class="card mb-3" id="bank_details">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0" data-anchor="data-anchor">Bank Details</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="tab-content" id="bank_details_with_bank">
                                <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputCity"><span class="fw-bold">Bank Name</span>  <br/><span id="bank_name"></span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputCity"><span class="fw-bold">Status</span>  <br/><span id="status"></span></label>
                                        </div>
                                    </div>					  			  
                                </div>				  
                            </div>
                            <?php
                            if ($_SESSION['user_details']['user_type'] == 31) {
                                echo '<div class="col-md-3 align-self-center" id="npci_valid_button">
									<button class="btn btn-primary" type="submit" onclick="UpdateStudentBankDetails()">Bank Validation</button>
								</div>';
                            }
                            ?>
                            <p id="bank_details_without_bank"></p>
                        </div>
                    </div>
                    <!--Bank Details End -->
                    <!-- Registration Starts  -->
                    <div class="card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between">
                            <h5 class="mb-0">Registration History</h5>
                        </div>
                        <div class="card-body fs--1">
                            <div class="row">
                                <div class="col-md-3 h-100">
                                    <div class="d-flex btn-reveal-trigger">
                                        <div class="calendar">
                                            <i class="fa fa-calendar" aria-hidden="true" style="font-size:45px;color: #2c7be5;"></i>                
                                        </div>
                                        <div class="flex-1 position-relative ps-3">
                                            <h6 class="fs-0 mb-0">
                                                <a href="#">Aadhaar Details</a>
                                            </h6>
                                            <p class="text-1000 mb-0">Aadhaar Verified : <b><span id="aadhaar_ekyc_status"></span></b>
                                            </p>
                                            <p class="text-1000 mb-0">Aadhaar Verified on : <b><span id="aadhaar_verified_on"></span></b>
                                            </p>

                                            <div class="border-bottom border-dashed my-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 h-100">
                                    <div class="d-flex btn-reveal-trigger">
                                        <div class="calendar">
                                            <i class="fa fa-calendar" aria-hidden="true" style="font-size:45px;color: #2c7be5;"></i>   
                                        </div>
                                        <div class="flex-1 position-relative ps-3">
                                            <h6 class="fs-0 mb-0">
                                                <a href="#">School Status</a>
                                            </h6>
                                            <p class="text-1000 mb-0">School Verified : <b><span id="emis_id_verified"></span></b>
                                            </p>
                                            <p class="text-1000 mb-0">Verified Verified on : <b><span id="emis_id_verified_on"></span></b>
                                            </p>

                                            <div class="border-bottom border-dashed my-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 h-100">
                                    <div class="d-flex btn-reveal-trigger">
                                        <div class="calendar">
                                            <i class="fa fa-calendar" aria-hidden="true" style="font-size:45px;color: #2c7be5;"></i>   
                                        </div>
                                        <div class="flex-1 position-relative ps-3">
                                            <h6 class="fs-0 mb-0">
                                                <a href="#">Bank Details</a>
                                            </h6>
                                            <p class="text-1000 mb-0">Bank Verified : <b><span id="npci_status"></span></b>
                                            </p>
                                            <p class="text-1000 mb-0">Bank Verified on : <b><span id="npci_status_verified_on"></span></b>
                                            </p>

                                            <div class="border-bottom border-dashed my-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 h-100">
                                    <div class="d-flex btn-reveal-trigger">
                                        <div class="calendar">
                                            <i class="fa fa-calendar" aria-hidden="true" style="font-size:45px;color: #2c7be5;"></i>   
                                        </div>
                                        <div class="flex-1 position-relative ps-3">
                                            <h6 class="fs-0 mb-0">
                                                <a href="#">Social Welfare</a>
                                            </h6>
                                            <p class="text-1000 mb-0">Social welfare Verified : <b><span id="sw_status"></span></b>
                                            </p>
                                            <p class="text-1000 mb-0">Social welfare Verified on : <b><span id="sw_date"></span></b>
                                            </p>                        
                                            <div class="border-bottom border-dashed my-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Student Registration Ends -->
                </div>
            </div>
        </div> 
        <footer class="footer">
            <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 text-600">Designed and deveoloped by TNeGA <span class="d-none d-sm-inline-block">|</span><br class="d-sm-none"> &copy; <?php echo date("Y"); ?></p>
                </div>
            </div>
        </footer>
        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================--> 

        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <script src="./vendors/bootstrap/bootstrap.min.js"></script>
        <script src="./vendors/fontawesome/all.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">

        <script>
            $(document).ready(function () {

                GetStudentProfile();

            });

            function GetURLParameter(sParam)
            {
                var sPageURL = window.location.search.substring(1);
                var sURLVariables = sPageURL.split('&');
                for (var i = 0; i < sURLVariables.length; i++)
                {
                    var sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] == sParam)
                    {
                        return sParameterName[1];
                    }
                }
            }

            function UpdateStudentBankDetails() {

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'UpdateStudentBankDetails',
                        student_reg_id: GetURLParameter('id'),
                        user_id : '<?php echo base64_encode($_SESSION['user_details']['user_id']); ?>',
                    },
                    beforeSend: function () {
                        $('.loader').preloader({
                            text: 'Processing Please Wait.'
                        });
                    },
                    success: function (response) {

                        resdata = $.parseJSON(response);
                        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                            Swal.fire({
                                icon: 'info',
                                html: resdata['error_msg'],
                                confirmButtonText: 'YES',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.close();
                                }

                            })


                        } else if (resdata['error_code'] == 201 && resdata['error_status'] == false) {

                            Swal.fire({
                                icon: 'info',
                                html: resdata['error_msg'],
                                confirmButtonText: 'YES',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.close();
                                }

                            })

                        } else if (resdata['error_code'] == 400 && resdata['error_status'] == false) {

                            Swal.fire({
                                icon: 'info',
                                html: resdata['error_msg'],
                                confirmButtonText: 'YES',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.close();
                                }

                            })

                        } else if (resdata['error_code'] == 401 && resdata['error_status'] == false) {

                            Swal.fire({
                                icon: 'info',
                                html: resdata['error_msg'],
                                confirmButtonText: 'YES',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.close();
                                }

                            })

                        }

                    }, complete: function () {

                        $('.loader').preloader('remove');

                    }

                });

            }

            function GetStudentProfile() {

                $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'GetStudentProfile',
                        student_reg_id: GetURLParameter('id'),
                    },
                    beforeSend: function () {
                        $('.loader').preloader({
                            text: 'Processing Please Wait.'
                        });
                    },
                    success: function (response) {

                        resdata = $.parseJSON(response);
                        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {


                            if (resdata['data']['student_name']) {

                                $("#student_name_emis").html(resdata['data']['student_name']);
                                $("#student_registration_no").html(resdata['data']['student_registration_no']);

                            }

                            if (resdata['data']['date_of_birth']) {

                                $("#date_of_birth").html(resdata['data']['date_of_birth_conversion']);

                            }

                            if (resdata['data']['gender']) {

                                if (resdata['data']['gender'] == 1) {

                                    $("#gender").html('Female');

                                }

                            }

                            if (resdata['data']['aadhar_number_masking']) {

                                $("#aadhaar_no").html(resdata['data']['aadhar_number_masking']);

                            }

                            if (resdata['data']['emis_id']) {

                                $("#emis_id").html(resdata['data']['emis_id']);

                            }

                            if (resdata['data']['father_name']) {

                                $("#father_name").html(resdata['data']['father_name']);

                            }

                            if (resdata['data']['mother_name']) {

                                $("#mother_name").html(resdata['data']['mother_name']);

                            }

                            if (resdata['data']['parents_mobile']) {

                                $("#parents_mobile").html(resdata['data']['parents_mobile']);

                            }

                            if (resdata['data']['guardian_name']) {

                                $("#guardian_name").html(resdata['data']['guardian_name']);

                            }

                            if (resdata['data']['religion_name']) {

                                $("#religion").html(resdata['data']['religion_name']);

                            }

                            if (resdata['data']['community_name']) {

                                $("#community").html(resdata['data']['community_name']);

                            }


                            $("#m_degree_id").html(resdata['data']['degree']);
                            $("#m_subject_id").html(resdata['data']['subject']);
                            $("#school_complition_on").html(resdata['data']['school_comp_on']);
                            $("#academic_year").html(resdata['data']['academic_year']);
                            $("#date_of_admission").html(resdata['data']['date_of_admission_conversion']);
                            $("#year_of_study").html(resdata['data']['year_of_study']);
                            $("#m_institution_type").html(resdata['data']['institution_type']);
                            $("#m_institution_id").html(resdata['data']['institution_name']);

                            var baseStr64 = resdata['data']['aadhaar_photo'];
                            document.getElementById("aadhaar_photo").setAttribute('src', "data:image/jpg;base64," + baseStr64);

                            // Append School Details
                            // 12th Standard Course Mapping	
                            if (resdata['data']['district_12th'] != null && resdata['data']['district_12th'] != 0 && resdata['data']['year_of_study_12th'] != null && resdata['data']['school_12th'] != null) {

                                $("#district_12th").html(resdata['data']['district_12th']);
                                $("#year_of_study_12th").html(resdata['data']['year_of_study_12th']);
                                $("#school_12th").html(resdata['data']['school_name_12th']);

                            } else {

                                $("#row_12th").addClass("d-none");
                            }

                            // 11th Standard Course Mapping
                            if (resdata['data']['district_11th'] != null && resdata['data']['district_11th'] != 0 && resdata['data']['year_of_study_11th'] != null && resdata['data']['school_11th'] != null) {

                                $("#district_11th").html(resdata['data']['district_11th']);
                                $("#year_of_study_11th").html(resdata['data']['year_of_study_11th']);
                                $("#school_11th").html(resdata['data']['school_name_11th']);

                            } else {

                                $("#row_11th").addClass("d-none");
                            }

                            // 10th Standard Course Mapping
                            if (resdata['data']['district_10th'] != null && resdata['data']['district_10th'] != 0 && resdata['data']['year_of_study_10th'] != null && resdata['data']['school_10th'] != null) {

                                $("#district_10th").html(resdata['data']['district_10th']);
                                $("#year_of_study_10th").html(resdata['data']['year_of_study_10th']);
                                $("#school_10th").html(resdata['data']['school_name_10th']);

                            } else {

                                $("#row_10th").addClass("d-none");
                            }

                            // 9th Standard Course Mapping
                            if (resdata['data']['district_9th'] != null && resdata['data']['district_9th'] != 0 && resdata['data']['year_of_study_9th'] != null && resdata['data']['school_9th'] != null) {

                                $("#district_9th").html(resdata['data']['district_9th']);
                                $("#year_of_study_9th").html(resdata['data']['year_of_study_9th']);
                                $("#school_9th").html(resdata['data']['school_name_9th']);

                            } else {

                                $("#row_9th").addClass("d-none");
                            }

                            // 8th Standard Course Mapping
                            if (resdata['data']['district_8th'] != null && resdata['data']['district_8th'] != 0 && resdata['data']['year_of_study_8th'] != null && resdata['data']['school_8th'] != null) {

                                $("#district_8th").html(resdata['data']['district_6th']);
                                $("#year_of_study_8th").html(resdata['data']['year_of_study_8th']);
                                $("#school_8th").html(resdata['data']['school_name_8th']);

                            } else {

                                $("#row_8th").addClass("d-none");
                            }

                            if (resdata['data']['district_7th'] != null && resdata['data']['district_7th'] != 0 && resdata['data']['year_of_study_7th'] != null && resdata['data']['school_7th'] != null) {

                                $("#district_7th").html(resdata['data']['district_7th']);
                                $("#year_of_study_7th").html(resdata['data']['year_of_study_7th']);
                                $("#school_7th").html(resdata['data']['school_name_7th']);

                            } else {

                                $("#row_7th").addClass("d-none");
                            }

                            if (resdata['data']['district_6th'] != null && resdata['data']['district_6th'] != 0 && resdata['data']['year_of_study_6th'] != null && resdata['data']['school_6th'] != null) {

                                $("#district_6th").html(resdata['data']['district_6th']);
                                $("#year_of_study_6th").html(resdata['data']['year_of_study_6th']);
                                $("#school_6th").html(resdata['data']['school_name_6th']);

                            } else {

                                $("#row_6th").addClass("d-none");
                                $("#student_school_details").addClass("card mb-3 d-none");
                            }


                            // Bank Details Verify
                            if (resdata['data']['bank_name'] != null && resdata['data']['bank_name'] != '') {

                                $("#bank_details_with_bank").addClass("tab-content d-block");
                                $("#bank_details_without_bank").addClass("d-none");

                                $("#bank_name").html(resdata['data']['bank_name']);
                                $("#status").html(resdata['data']['bank_status']);

                            } else {

                                $("#bank_details_with_bank").addClass("tab-content d-none");
                                $("#bank_details_without_bank").addClass("d-block");
                                $("#bank_details_without_bank").html('Bank details yet to verified');

                            }


                            // Verify eKYC Details
                            if (resdata['data']['aadhaar_ekyc_status'] == 1) {

                                $("#aadhaar_ekyc_status").html('Yes');
                                $("#aadhaar_verified_on").html(resdata['data']['aadhaar_ekyc_verified_on_conversion']);

                            } else {

                                $("#aadhaar_ekyc_status").html('No');
                                $("#aadhaar_verified_on").html();

                            }

                            // Verify School Status					
                            if (resdata['data']['emis_id_verified'] == 'Y') {

                                $("#emis_id_verified").html('Yes');
                                $("#emis_id_verified_on").html(resdata['data']['emis_id_verified_on_conversion']);

                            } else {

                                $("#emis_id_verified").html('No');
                                $("#emis_id_verified_on").html();

                            }

                            // Verify Bank Status					
                            if (resdata['data']['npci_status'] == 1) {

                                $("#npci_status").html('Yes');
                                $("#npci_status_verified_on").html(resdata['data']['npci_status_verified_on_conversion']);
                                $("#npci_valid_button").addClass("col-md-3 align-self-center d-none");

                            } else {

                                $("#npci_status").html('No');
                                $("#npci_status_verified_on").html('');

                            }

                            // Verify Social Welfare Status
                            if (resdata['data']['sw_status'] == 1) {

                                $("#sw_status").html('Yes');
                                $("#sw_date").html(resdata['data']['sw_date_conversion']);

                            } else {

                                $("#sw_status").html('No');
                                $("#sw_date").html('');

                            }

                        } else if (resdata['error_code'] == 400 && resdata['error_status'] == false) {

                            Swal.fire({
                                icon: 'info',
                                html: 'Student Details Not Found',
                                confirmButtonText: 'YES',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.close();
                                }

                            })

                        }
                    },
                    complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

                        $('.loader').preloader('remove');

                    }
                });

            }
        </script>
    </main>
</body>
</html>