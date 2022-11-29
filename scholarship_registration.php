<?php
include "valid_login.php";
unset($_SESSION['student_details']);
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include('header_script.php') ?>
    </head>

    <body>
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
            <div class="col-12 align-self-center loader"></div>
            <div class="container-fluid" data-layout="container">

                <?php include('sideNav.php') ?>
                <div class="content">

                    <?php include('topnav.php') ?>


                    <!-- Student EMIS Starts Here -->
                    <div class="card mb-3" id="div_student_emis">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <?php
                                    if (isset($emis_validation) && $emis_validation == true) {

                                        echo '<h5 class="mb-0" id="followers">Student Details (Without EMIS)</h5>';
                                    } else {

                                        echo '<h5 class="mb-0" id="followers">Student Details</h5>';
                                    }
                                    ?>

                                </div>
                                <div class="col-auto ms-auto">
                                    <?php
                                    if (!isset($emis_validation)) {

                                        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#know_your_emis"> Know your EMIS </button>';
                                    }
                                    ?>
                                    <a class="btn btn-warning" title="Redirect to student scholarship list" href="./student_register_list.php"> Back To List </a>	
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">

                            <div class="tab-content">

                                <?php if (!isset($emis_validation)) { ?>
                                    <div class="row">
                                        <form autocomplete="off" class="row needs-validation" id="form_student_emis_details" name="form_student_emis_details" novalidate="">
                                            <div class="col-md-4">
                                                <label class="form-label" for="inputCity">EMIS ID *</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="emis_id" name="emis_id" required minlength="16" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" onkeypress="ChangeEMISID(this.value)" required>
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                    <div class="invalid-feedback text-left"> Please Enter the valid EMIS ID </div>
                                                </div>
                                                <label class="form-label px-2" for="phone_no"> Note: Enter the 16-19 digits EMIS ID</label>
                                            </div>
                                            <div class="col-md-4 align-self-center" id="emis_valid_button">
                                                <button class="btn btn-primary" type="submit" onclick="SubmitStudentEMIS()"> Fetch the student Details </button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>

                                <?php
                                if (isset($emis_validation) && $emis_validation == true) {



                                    echo '<div class="col-md-12 mb-3 d-block" id="content-student-details">';
                                } else {

                                    echo '<div class="col-md-12 mb-3 mt-3 d-none" id="content-student-details">';
                                }
                                ?>
                                <form autocomplete="off" class="row g-3 needs-validation" id="form_student_details" name="form_student_details" novalidate="" >

                                    <?php
                                    if (isset($emis_validation) && $emis_validation == true) {

                                        echo '<input class="form-control" id="emis_validation_flag" name="emis_validation_flag" value="true" type="hidden"/>';
                                    } else {

                                        echo '<input class="form-control" id="emis_validation_flag" name="emis_validation_flag" value="false" type="hidden"/>';
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Student Name *</label>
                                        <div class="input-group">
                                            <input class="form-control" name="student_name_emis" id="student_name_emis" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
                                            <span class="input-group-text"> <i class="fas fa-female"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Student Name </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Date of Birth *</label>
                                        <div class="input-group">
                                            <input class="form-control datetimepicker" name="date_of_birth" id="date_of_birth" type="text" data-options='{"disableMobile":true,"dateFormat":"Y-m-d","allowInput":true }' required>
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Date Of Birth</div>
                                        </div>
                                    </div>
                                    <input class="form-control" id="aadhaar_no_mask" name="aadhaar_no_mask" type="hidden"/>
                                    <?php
                                    /*
                                      <div class="col-md-4">

                                      <label class="form-label" for="inputCity">Aadhar Number *</label>
                                      <div class="input-group">
                                      <input class="form-control" id="aadhaar_no" name="aadhaar_no" type="text" minlength="12" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                      <input class="form-control" id="aadhaar_no_mask" name="aadhaar_no_mask" type="hidden" />
                                      <span class="input-group-text"> <i class="fas fa-id-card"></i> </span>
                                      <div class="invalid-feedback text-left"> Please Enter Aadhar Number</div>
                                      </div>
                                      </div>
                                     */
                                    ?>									
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Religion *</label>
                                        <select class="form-select" name="religion" id="religion" required>
                                            <option value="">Select Religion</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Enter Your Religion</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Community *</label>
                                        <select class="form-select" name="community" id="community" required>
                                            <option value="">Select Community</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Enter Your Community</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity"> Gender *</label>
                                        <select class="form-select" name="gender" id="gender" required readonly>
                                            <option value="1"> Female </option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select your Gender </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity"> Mother's Name *</label>
                                        <div class="input-group">
                                            <input class="form-control" id="mother_name" name="mother_name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
                                            <span class="input-group-text"> <i class="fas fa-female"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Mothers Name</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Father's Name *</label>
                                        <div class="input-group">
                                            <input class="form-control" id="father_name" name="father_name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
                                            <span class="input-group-text"> <i class="fas fa-male"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Father's Name</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Parent Mobile Number *</label>
                                        <div class="input-group">
                                            <input class="form-control" id="parent_mobile" name="parent_mobile" type="text" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                            <span class="input-group-text"> <i class="fas fa-mobile-alt"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Mobile Number</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputCity">Guardian Name</label>
                                        <div class="input-group">
                                            <input class="form-control" id="guardian_name" name="guardian_name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                                            <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="emis_verified" id="emis_verified" />
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo base64_encode($_SESSION['user_details']['user_id']); ?>" />




                                    <?php
                                    if (isset($emis_validation) && $emis_validation == true) {

                                        echo '<div class="row d-block" id="button_student_details_confirm">';
                                    } else {

                                        echo '<div class="row d-none" id="button_student_details_confirm">';
                                    }
                                    ?>
                                    <!--<div class="row d-none" id="button_student_details_confirm"> -->
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" id="div_student_details_button">
                                        <h5 class="align-self-end text-right">Please confirm the above details</h5>
                                        <button class="btn btn-primary" id="student_details_yes" type="button" onclick="ConfirmStudentDetails(true)">Yes</button>
                                        <button class="btn btn-danger" id="student_details_no" type="button" onclick="ConfirmStudentDetails(false)">No</button>
                                    </div>
                                </form>  
                            </div>

                            <span class="d-none" id="student_details_verified" style="text-align: end;">
                                <i class="fa fa-check"></i>&nbsp;&nbsp;<b style="color: green;font-size: 16px;">Student Details Verified Successfully</b>
                            </span>

                        </div>

                    </div>
                </div>
                <!-- College Details Div Ends Here -->

                <!-- Student eKYC Details Starts Here -->
                <div class="card mb-3 d-none" id="div_student_aadhar">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h5 class="mb-0" id="followers">eKYC Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
                                <form class="row g-3 needs-validation" id="form_aadhaar_validation" name="form_aadhaar_validation" novalidate="" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputCity">Aadhaar Number *</label>
                                            <div class="input-group">
                                                <input class="form-control" id="aadhaar_no_2" name="aadhaar_no_2" pattern="^[0-9]\d{11}$" type="text" minlength="12" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                                <span class="input-group-text"> <i class="fas fa-id-card"></i> </span>
                                                <div class="invalid-feedback text-left"> Please Enter Aadhaar Number </div>
                                                <label class="form-label px-2" for="phone_no" id="ekyc_aadhar_label"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-3 align-self-end">
                                            <label class="form-label" for="inputCity"></label>
                                            <button class="btn btn-primary" id="aadhaar_number_validation" type="submit" onclick="ValidateStudenteKYC()">eKYC Validation </button>
                                        </div>
                                        <p id="aadhaar_refrence_msg" class="d-none"></p>
                                    </div>
                                    <input type="hidden" id="aadhar_verified" name="aadhar_verified"/>
                                </form>
                                <div class="row d-none" id="ekyc_aadhar_details">

                                    <div class="col-md-12">
                                        <h5 class="  text-center mb-2" id="aadhaar_verify"> Aadhaar Details </h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="fw-bold">Name </td>
                                                <td colspan="3" id="aadhr_name"> </td>
                                                <td rowspan="3"> <img id="aadhr_img" alt="photo"> </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">DOB</td>
                                                <td id="aadhr_dob"> </td>
                                                <td class="fw-bold">Gender</td>
                                                <td id="aadhr_gender"> </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Address</td>
                                                <td colspan="2" id="aadhr_address"> </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-12" id="div_student_ekyc_with_button">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <h5 class="align-self-end text-right">Please confirm the above details</h6>
                                                <button class="btn btn-primary" id="student_bank_details_yes" type="submit" onclick="ConfirmEKYC(true)">Yes</button>
                                                <button class="btn btn-danger" id="student_bank_details_no" type="button" onclick="ConfirmEKYC(false)">No</button>
                                        </div>
                                    </div>

                                </div>
                                <span class="d-none" id="div_student_ekyc_verified" style="text-align: end;">
                                    <i class="fa fa-check"></i>&nbsp;&nbsp;<b style="color: green;font-size: 16px;">Student eKYC details verified successfully</b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- College Details Div Ends Here -->

                <!-- Student Bank Details OTP Starts Here -->
                <div class="card mb-3 d-none" id="bank_details">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Bank Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
                                <form class="row g-3 needs-validation" id="form_bank_validation" name="form_bank_validation" novalidate="" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputCity">Aadhaar Number *</label>
                                            <div class="input-group">
                                                <input class="form-control" id="aadhaar_no_bank" name="aadhaar_no_bank" pattern="^[0-9]\d{11}$" type="text" minlength="12" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                                                <span class="input-group-text"> <i class="fas fa-id-card"></i> </span>
                                                <div class="invalid-feedback text-left"> Please Enter Aadhaar Number </div>
                                                <label class="form-label px-2" for="phone_no" id="ekyc_aadhar_label"></label>
                                            </div>											
                                        </div>
                                        <div class="col-md-3 align-self-end">
                                            <label class="form-label" for="inputCity"></label>
                                            <button class="btn btn-primary" id="bank_aadhaar_validation" type="submit" onclick="ValidateNPCI()">Bank Validation</button>
                                        </div>									
                                    </div>
                                </form>
                                <div id="div_validate_bank" class="d-none">
                                    <form class="row g-3 needs-validation" id="form_aadhaar_bank_details" name="form_aadhaar_bank_details" novalidate="" readonly>
                                        <div class=" row col-md-12">
                                            <div class="col-md-4">
                                                <label class="form-label" for="inputCity">Bank Name</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="bank_name" name="bank_name" type="text" readonly />
                                                    <span class="input-group-text"> <i class="fas fa-university"></i> </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="inputCity">Status</label>
                                                <input class="form-control" id="status" name="status" type="text" readonly />
                                            </div>											
                                        </div>										
                                        <input type="hidden" name="bank_verified" id="bank_verified" />
                                        <input type="hidden" name="bank_verified_msg" id="bank_verified_msg" />									
                                    </form>
                                </div>
                                <span class="d-none" id="div_student_bank_verified" style="text-align: right;color: green;font-size: 15px;font-weight: 700;padding-top: 10px;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Bank Details Ends Here -->

                <!-- College Details Div Starts Here -->
                <div class="card mb-3 d-none" id="div_college_details">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Course Details </h5>
                                <span style="font-size: 14px;"> (Please provide the following details) </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
                                <form autocomplete="off" class="row g-3 needs-validation" id="form_college_details" name="form_college_details" novalidate>

                                    <input type="hidden" name="m_institution_id" id="m_institution_id" value="<?php echo $_SESSION['user_details']['institution_id'][0] ?>" />
                                    <input type="hidden" name="m_institution_type_id" id="m_institution_type_id" value="<?php echo $_SESSION['user_details']['m_institution_type_id'][0] ?>" />
                                    <input type="hidden" name="validation" id="validation"/>                                
                                    <input type="hidden" name="district_id" id="district_id" value="<?php echo $_SESSION['user_details']['district'][0] ?>" />                                
                                    <?php
                                    if (isset($emis_validation) && $emis_validation == true) {

                                        echo '<input class="form-control" id="emis_validation_flag_institution" name="emis_validation_flag_institution" value="true" type="hidden"/>';
                                    } else {

                                        echo '<input class="form-control" id="emis_validation_flag_institution" name="emis_validation_flag_institution" value="false" type="hidden"/>';
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <label class="form-label" for="phone_no"> Mobile Number *</label>
                                        <div class="input-group">
                                            <input class="form-control" id="phone_number" name="phone_number" pattern="^[6-9]\d{9}$" type="text" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i> </span>

                                            <div class="invalid-feedback text-left"> Please Enter Mobile Number </div>
                                        </div>
                                        <label class="form-label px-2" for="phone_no"> Note: Mobile Number will be used for future communication </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="user_email"> Email Id *</label>
                                        <div class="input-group">
                                            <input class="form-control" id="email_id" name="email_id" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" type="email" required>
                                            <span class="input-group-text"> <i class="fas fa-envelope-open"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Enter Email ID </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputAddress">Degree *</label>
                                        <select class="form-select" id="m_degree_id" name="m_degree_id" onchange="GetSubjectByInstitution()" required>
                                            <option value="">Select Degree</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select Degree </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputAddress">Subject *</label>
                                        <select class="form-select" name="subject" id="subject" onchange="YearofStudy();" required>
                                            <option value="">Select Subject</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select Subject </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputAddress">Year of School Completion*</label>
                                        <select class="form-select" name="school_completion_on" id="school_completion_on" onchange="getAcademicYear()" required>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select Year </div>
                                        <label class="form-label px-2" for="phone_no"> Note: Academic year of school completion </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputAddress">Academic Year*</label>
                                        <select class="form-select" name="academic_year" id="academic_year" onchange="ChangeDateofAdmission()" required>
                                            <option value="">Select Academic Year</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select Academic Year </div>
                                        <label class="form-label px-2" for="phone_no"> Note: Enter the year of admission with the current institution</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="datepicker">Date of Admission *</label>
                                        <div class="input-group">
                                            <input name="date_of_admission" class="form-control datetimepicker" data-options='{"disableMobile":true,"dateFormat":"d-M-Y","allowInput":true,"maxDate": "today"}' id="date_of_admission" placeholder="Select Date" required type="text">
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            <div class="invalid-feedback text-left"> Please Select Date of Admission </div>
                                            <label class="form-label px-2" for="phone_no"> Note: Enter the date of admission with the current institution</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="inputAddress">Year of Study *</label>
                                        <select class="form-select" name="year_of_study" id="year_of_study" required>
                                            <option value="">Select Year of Study</option>
                                        </select>
                                        <div class="invalid-feedback text-left"> Please Select Year of Study</div>
                                    </div>

                                    <div class="col-md-12 d-block" id="div_student_institution_button">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <h5 class="align-self-end text-right">Please confirm the above details</h6>
                                                <button class="btn btn-primary" id="student_college_details_yes" type="button" onclick="SubmitCollegeDetails(true)">Yes</button>
                                                <button class="btn btn-danger" id="student_college_details_no" type="button" onclick="SubmitCollegeDetails(false)">No</button>
                                        </div>
                                    </div>
                                    <span class="d-none" id="div_student_institution_details_verified" style="text-align: end;">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;<b style="color: green;font-size: 16px;">Student institution details confirmed successfully</b>
                                    </span>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- College Details Div Ends Here -->

                <!-- College Details Div Starts Here -->
                <div class="card mb-3 d-none" id="div_school_details">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">School Details </h5>
                                <span style="font-size: 14px;"> (Please provide the following details) </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div class="tab-content mt-3">
                                <form autocomplete="off" class="row g-3 needs-validation" id="form_student_school_details" name="form_student_school_details" novalidate="">
                                    <input type="hidden" name="school_eligibility" id="school_eligibility"/>
                                    <div class=" col-md-12 border-bottom mb-3">
                                        <!--12th-->
                                        <div class="row mb-3" id="twelveth_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class XII</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_12th" name="district_12th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_12th" name="school_12th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_12th" name="year_of_study_12th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                            <!--<div class="modal-footer"><button class="btn btn-primary" type="submit">Next</button></div>-->
                                        </div>
                                        <!--12th-->
                                        <div class="row mb-3" id="copy_details_ug">
                                            <div class="col-md-1 align-self-end text-right"></div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="check_district_12" name="check_district_12" type="checkbox" value="12" onclick="copy_district(this.value)" />
                                                    <label class="form-check-label" for="flexCheckChecked">Same as above</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--11th-->
                                        <div class="row mb-3" id="eleventh_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class XI</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_11th" name="district_11th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_11th" name="school_11th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_11th" name="year_of_study_11th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    <label class="form-label " for="inputAddress">Group Name</label>
                                                    <select class="form-select" id="group_11th" name="group_11th" required>
                                                        <option value=""> Choose Group </option>
                                                        <option value="1">Biology</option>
                                                        <option value="2">Commerce</option>
                                                        <option value="3">Computer Science </option>
                                                        <option value="4">Vocational</option>
                                                        <option value="5">Pure Science</option>
                                                    </select>
                                                    <div class="invalid-feedback text-left"> Please Select Group </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label " for="inputAddress">Medium</label>
                                                    <select class="form-select" id="medium_11th" name="medium_11th" required="">
                                                        <option value=""> Choose Medium </option>
                                                        <option value="1"> English </option>
                                                        <option value="2"> Tamil </option>
                                                    </select>
                                                    <div class="invalid-feedback text-left"> Please Select Medium </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--11th-->
                                        <!--10th-->
                                        <div class="row mb-3" id="tenth_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class X</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_10th" name="district_10th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_10th" name="school_10th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_10th" name="year_of_study_10th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                        </div>
                                        <!--10th-->
                                        <div class="row mb-3" id="copy_details_diploma">
                                            <div class="col-md-1 align-self-end text-right"></div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="check_district_10" name="check_district_10" type="checkbox" value="10" onclick="copy_district(this.value)" />
                                                    <label class="form-check-label" for="flexCheckChecked">Same as above</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--9th-->
                                        <div class="row mb-3" id="ninth_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class IX</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_9th" name="district_9th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_9th" name="school_9th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_9th" name="year_of_study_9th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                        </div>
                                        <!--9th-->
                                        <!--8th-->
                                        <div class="row mb-3" id="eight_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class VIII</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_8th" name="district_8th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_8th" name="school_8th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_8th" name="year_of_study_8th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                        </div>
                                        <!--8th-->
                                        <div class="row mb-3" id="copy_details_iti">
                                            <div class="col-md-1 align-self-end text-right"></div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="check_district_8" name="check_district_8" type="checkbox" value="8" onclick="copy_district(this.value)" />
                                                    <label class="form-check-label" for="flexCheckChecked">Same as above</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--7th-->
                                        <div class="row mb-3" id="seventh_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class VII</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_7th" name="district_7th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_7th" name="school_7th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_7th" name="year_of_study_7th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                        </div>
                                        <!--7th-->
                                        <!--6th-->
                                        <div class="row mb-3" id="sixth_std_form">
                                            <div class="col-md-1 align-self-end text-right">
                                                <label class="form-label " for="inputAddress">Class VI</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">District</label>
                                                <select class="form-select" id="district_6th" name="district_6th" onchange="getDistrictSchoolMaster(this.id, this.value)" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select District </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label " for="inputAddress">School Name</label>
                                                <select class="form-select" id="school_6th" name="school_6th" required>
                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select School </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label " for="inputAddress">Year of Study</label>
                                                <select class="form-select" id="year_of_study_6th" name="year_of_study_6th" onchange="changeDate(this.id, this.value)" required>

                                                </select>
                                                <div class="invalid-feedback text-left"> Please Select Year </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-2 align-self-end" id="emis_valid_button"><button class="btn btn-primary" type="submit" id="submit_school_details">Proceed</button></div> -->

                                    </div>

                                    <div class="col-md-12 d-block" id="div_student_school_details_button">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end" id="div_student_school_details_button">
                                            <h5 class="align-self-end text-right">Please confirm the above details</h6>
                                                <button class="btn btn-primary" id="student_school_details_yes" type="button" onclick="SubmitSchoolDetails(true)">Yes</button>
                                                <button class="btn btn-danger" id="student_school_details_no" type="button" onclick="SubmitSchoolDetails(false)">No</button>
                                        </div>
                                    </div>
                                    <span class="d-none" id="div_student_school_details_verified" style="text-align: end;">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;<b style="color: green;font-size: 16px;">Student school details confirmed successfully</b>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- College Details Div Ends Here -->

                <!-- Student Bank Details OTP Starts Here -->
                <div class="card mb-3 d-none" id="terms_condition_details">
                    <div class="col-12 align-self-center final_loader"></div>
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Acknowlegment</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
                                <div id="div_validate_bank">
                                    <form class="row g-3 needs-validation" id="submit_application" name="submit_application" novalidate="">
                                        <div class="row">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" id="checkbox_agree" name="checkbox_agree" required>												
                                                <label class="form-check-label mb-0" for="card-checkbox" id="terms_bank_name"></label>
                                                <label class="form-check-label mb-0" for="card-checkbox">If sanctioned, scholarship will be transferred to this bank account.</label>
                                                <label class="form-check-label mb-0" for="card-checkbox">By submitting and entering the OTP, <span id="terms_student_name"> </span> hereby give my consent to State government / TNEGA to use and share my Aadhar number or any other unique identifier with any state govt. and central govt. / quasi / private agencies and authorize TNEGA to obtain my demographic, financial, consumption, billing and other information from them for the sole purpose of establishing my bonafide for welfare schemes of Government of TN.</label>
                                                <div class="invalid-feedback text-left">Please provide consent for completing the scholarship application</div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                            <button type="submit" class="btn btn-primary" type="submit" id="application_button_validate">Submit Application</button>							
                                            <button class="btn btn-primary d-none" type="button" id="application_button_loading" disabled>
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Processing...
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Bank Details Ends Here -->

                <div class="card mb-3 d-none" id="reset_form">
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div aria-labelledby="tab-dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" class="tab-pane preview-tab-pane active" id="dom-8ffa5195-6f01-4071-8377-89e1e6415c7a" role="tabpanel">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-danger" type="reset" onclick="ResetApplication()">Reset Application</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ##################################################################### -->

                <?php
                include('footer1.php')
                ?>


            </div>

        </div>
        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->

        <!-- Aadhar OTP Modal Starts Here -->
        <div class="modal fade" id="aadhaar_otp_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">			
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center text-2xl font-bold" id="staticBackdropLabel"> eKYC Verification </h5>
                        <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <form class="row-auto needs-validation" id="form_aadhaar_otp" name="form_aadhaar_otp" novalidate="">
                        <input type="hidden" id="aadhaar_token" name="aadhaar_token" />
                        <div class="modal-body">
                            <div>
                                <div class="container">
                                    <div class="bg-white  rounded text-center">
                                        <div class="flex flex-col">
                                            <span> Enter the OTP received with the registered mobile number <span id="aadhaar_otp_mobile_number"> </span> linked to the Aadhaar</span>
                                        </div>
                                        <div class="container height-100 d-flex justify-content-center align-items-center">
                                            <div class="position-relative max-w-sm mx-auto md:max-w-lg mx-auto">
                                                <input class="form-control text-center" type="text" id="aadhaar_otp" name="aadhaar_otp" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="fw-bold">Time left : <span id="aadhartimer"> </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="ekyc_OTP_close">Close</button>
                            <button type="submit" class="btn btn-primary" id="ekyc_button_validate">Submit</button>

                            <button class="btn btn-primary d-none" type="button" id="ekyc_button_loading" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Processing...
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Aadhar OTP Modal Ends Here -->

        <div class="modal fade" id="otp_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center text-2xl" id="staticBackdropLabel"> Student Profile Registration </h5>
                    </div>
                    <form class="row-auto g-3 needs-validation" id="submit_otp" name="submit_otp" novalidate="" autocomplete="off">
                        <div class="modal-body" style="padding:0px;">
                            <div class="container mx-auto">
                                <div class="flex flex-col mt-4 text-center">
                                    <span> Please enter the OTP sent to the Mobile Number </span>
                                    <span> <span class="font-bold" id="mobile_number_mask">+91 ********** </span> for registration.</span>
                                    <span>
                                </div>
                                <div class="container height-100 d-flex justify-content-center align-items-center">
                                    <div class="position-relative max-w-sm mx-auto md:max-w-lg mx-auto">
                                        <div id="otp" class="flex flex-row justify-center text-center px-2 mt-3">
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="first" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="second" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="third" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="fourth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="fifth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                            <input class="m-2 border h-10 w-10 text-center form-control rounded fw-bolder" type="text" id="sixth" maxlength="1" required style="padding:0px; width: 65px;height: 44px;background-image: none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3" id="div_resendotp">
                                <div class="row">
                                    <div class="fw-bold">Time left : <span id="sms_timer"></span></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <span class="d-block mobile-text fw-bolder" id="resend"></span>
                                    </div>
                                    <!--<div class="col-md-4">
                                            <button id="regenerateOTP" class="btn btn-warning btn_shadow d-none">Resend OTP </button>
                                    </div>-->
                                </div>
                                <!-- <span class="d-block mobile-text fw-bolder" id="countdown"></span>
                                <span class="d-block mobile-text fw-bolder" id="resend"></span> -->
                            </div>
                            <div class="modal-footer mt-3">
                                <span>By giving the OTP I confirm that I have read consent on computer screen and consented</span>							
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="sms_otp_close">Close</button>
                                <button type="submit" class="btn btn-primary" id="otp_button_validate">Submit</button>
                                <button class="btn btn-primary d-none" type="button" id="otp_button_loading" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Processing...
                                </button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP Modal For Registration Ends Here -->

    <!-- OTP Modal For Modify Registration Starts Here -->
    <div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="otp_modal_modify" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify Login Details to Modify</h5>
                </div>
                <form class="row g-3 needs-validation" id="verify_student_details" name="verify_student_details" novalidate="">
                    <div class="modal-body">
                        <input id="form_submit_type" name="form_submit_type" type="hidden" value="1"> <input id="modify_student_reg_id" name="modify_student_reg_id" type="hidden">
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Mobile No *</label> <input class="form-control" id="modify_phone_number" name="modify_phone_number" pattern="^[6-9]\d{9}$" required="" type="text">
                            <div class="invalid-feedback text-left"> Please Enter Mobile No </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Email Id *</label> <input class="form-control" id="modify_email_id" name="modify_email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="" type="email">
                            <div class="invalid-feedback text-left"> Please Enter Email ID </div>
                        </div>
                        <div class="mb-3 d-none" id="modify_div_otp">
                            <label class="col-form-label" for="recipient-name">OTP *</label> <input class="form-control" id="modify_otp" name="modify_otp" pattern="^[0-9]\d{6}$" required="" type="text">
                            <div class="invalid-feedback text-left"> Please Enter OTP </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="modify_validate_footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button> <button class="btn btn-primary" type="submit">Validate</button>
                    </div>
                    <div class="modal-footer d-none" id="modify_verify_footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button> <button class="btn btn-primary" onclick="sumbitVerifyOTP();" type="submit">Verify OTP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- OTP Modal For Modify Registration Ends Here  -->

    <!-- Know Your EMIS Modal -->
    <div class="modal fade" id="know_your_emis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> Search EMIS Details </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <?php include "emis_common_form.php" ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Know Your EMIS Search Modal -->

    <?php include('footer_script.php') ?>

</main>
<script>
    $("#date_of_birth").flatpickr({
        dateFormat: "d-M-Y",
        maxDate: "<?php echo date('d/m/Y', strtotime('-5500 day')) ?>"
    });
    document.addEventListener("DOMContentLoaded", function (event) {

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > *[id]');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function (event) {
                    if (event.key === "Backspace") {
                        inputs[i].value = '';
                        if (i !== 0)
                            inputs[i - 1].focus();
                    } else {
                        if (i === inputs.length - 1 && inputs[i].value !== '') {
                            return true;
                        } else if (event.keyCode >= 48 && event.keyCode <= 57) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1)
                                inputs[i + 1].focus();
                            event.preventDefault();
                        } else if (event.keyCode >= 96 && event.keyCode <= 105) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1)
                                inputs[i + 1].focus();
                            event.preventDefault();
                        } else if (event.keyCode >= 65 && event.keyCode <= 90) {
                            return false;
                        }
                    }
                });
            }
        }
        OTPInput();

    });

    function disableResend() {
        $("#regenerateOTP").attr("disabled", true);
        timer(300);
        //$('.regenerateOTP').prop('disabled', true);
        setTimeout(function () {
            // enable click after 1 second
            $('#regenerateOTP').removeAttr("disabled");
            //$('.disable-btn').prop('disabled', false);
        }, 60000); // 1 second delay
    }

    /*
     let timerOn = true;
     function timer(remaining) {
     
     var m = Math.floor(remaining / 60);
     var s = remaining % 60;
     
     m = m < 10 ? '0' + m : m;
     s = s < 10 ? '0' + s : s;
     document.getElementById('timer').innerHTML = m + ':' + s;
     remaining -= 1;
     
     if (remaining >= 0 && timerOn) {
     setTimeout(function () {
     timer(remaining);
     }, 1000);
     $("#regenerateOTP").removeClass("btn btn-warning btn_shadow d-block").addClass("btn btn-warning btn_shadow d-none");
     document.getElementById("resend").innerHTML = ``;
     return;
     }
     
     if (!timerOn) {
     // Do validate stuff here
     return;
     }
     
     $("#regenerateOTP").removeClass("btn btn-warning btn_shadow d-none").addClass("btn btn-warning btn_shadow d-block");
     document.getElementById("resend").innerHTML = `Didn't receive the OTP?`;
     // Do timeout stuff here
     //alert('Timeout for otp');
     }
     //timer(300);
     
     let aadhartimerOn = true;
     function timeraadhar(remaining) {
     
     var m = Math.floor(remaining / 60);
     var s = remaining % 60;
     
     m = m < 10 ? '0' + m : m;
     s = s < 10 ? '0' + s : s;
     document.getElementById('aadhartimer').innerHTML = m + ':' + s;
     remaining -= 1;
     
     if (remaining >= 0 && aadhartimerOn) {
     setTimeout(function () {
     timeraadhar(remaining);
     }, 1000);
     return;
     }
     
     if (!aadhartimerOn) {
     // Do validate stuff here
     $('#aadhaar_otp_modal').modal('hide');
     return;
     }
     
     $("#regenerateOTP").removeClass("btn btn-warning btn_shadow d-none").addClass("btn btn-warning btn_shadow d-block");
     document.getElementById("resend").innerHTML = `Didn't receive the OTP?`;
     // Do timeout stuff here
     //alert('Timeout for otp');
     }
     */
    // SMS OTP
    var sms_otp_int = "10:00";
    var sms_interval = "";
    function newtimersms() {

        sms_interval = setInterval(function () {
            var timer = sms_otp_int.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $('#sms_timer').html(minutes + ':' + seconds);
            if (minutes < 0) {
                clearInterval(sms_interval);
                sms_otp_int = "10:00";
            }
            //check if both minutes and seconds are 0
            if ((seconds <= 0) && (minutes <= 0)) {
                clearInterval(sms_interval);
                sms_otp_int = "10:00";
                $('#otp_modal').modal('hide');
                return;
            }
            sms_otp_int = minutes + ':' + seconds;
        }, 1000);
    }

    // Aadhaar Timer
    var aadhaar_otp_int = "10:00";
    var aadhar_interval = "";
    function newtimeraadhar() {

        aadhar_interval = setInterval(function () {
            var timer = aadhaar_otp_int.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $('#aadhartimer').html(minutes + ':' + seconds);
            if (minutes < 0) {
                clearInterval(aadhar_interval);
                aadhaar_otp_int = "10:00";
            }
            //check if both minutes and seconds are 0
            if ((seconds <= 0) && (minutes <= 0)) {
                clearInterval(aadhar_interval);
                aadhaar_otp_int = "10:00";
                $('#aadhaar_otp_modal').modal('hide');
                return;
            }
            aadhaar_otp_int = minutes + ':' + seconds;
        }, 1000);
    }

</script>
<script src="./assets/js/student_registration.js"></script>
</body>

</html>