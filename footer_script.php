    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="./vendors/popper/popper.min.js"></script>
    <script src="./vendors/bootstrap/bootstrap.min.js"></script>
    <script src="./vendors/anchorjs/anchor.min.js"></script>
    <script src="./vendors/is/is.min.js"></script>
    <script src="./vendors/dropzone/dropzone.min.js"></script>
    <script src="./vendors/prism/prism.js"></script>
    <script src="./vendors/fontawesome/all.min.js"></script>
    <script src="./vendors/lodash/lodash.min.js"></script>
    <!--  <script src="././polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script> -->
    <script src="./vendors/list.js/list.min.js"></script>
    <script src="./assets/js/theme.js"></script>


    <!-- Include Javascript Files -->

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">
    
    <script src="assets/js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="assets/js/custom.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    
    <!--    modal  modal-lg   -->
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }


        .error_field {

            border-color: #e63757 !important;
            padding-right: calc(1.5em + 0.625rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e63757'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e63757' stroke='none'/%3e%3c/svg%3e") !important;

            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.15625rem) center;
            background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);


        }

        .email_otpval,
        .mobile_otpval {

            background-image: none;


        }

        .verified_field {
            border-color: #00d27a;
            padding-right: calc(1.5em + 0.625rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2300d27a' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.15625rem) center;
            background-size: calc(0.75em + 0.3125rem) calc(0.75em + 0.3125rem);
        }
    </style>
    <div class="modal fade" id="password_reset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header p-2">

                    <h4 class="fs--3" id="popupheading_text"> Register your profile details </h4>
                    <p class="fs-2 tex-center"> </p>

                    <a href="logout.php" id="logoutbutton" class="btn btn-primary form-check-label mb-0 btn-sm" role="button"> Logout </a>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="col-8 align-self-center loader_firstimelogin"></div>
                    <input type="hidden" id="updatfrm">

                    <?php

                    $usertypeid =   isset($_SESSION['user_details']['user_type']) ? trim($_SESSION['user_details']['user_type']) : '';
                    if ($usertypeid == '31') {

                    ?>



                        <form class="needs-validation" id="institution_register" name="institution_register" novalidate="" autocomplete="off">
                            <h4 class="text-center mb-2" id="logged_institute_name" style="color:#64a6ff;"> </h4>


                            <div class="row gx-2 mb-3">
                                <div class="  col-sm-6">

                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="card-password"> Username <span style="color:red">*</span></label>
                                    </div>
                                    <input class="form-control" type="text" id="username" name="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="" disabled>
                                    <div class="invalid-feedback text-justify"> please enter username </div>
                                </div>



                                <div class="row col-md-6">

                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" id="newemaillabel" for="card-password"> Email ID / username ( communication mail) <span style="color:red">*</span> </label>
                                    </div>
                                    <input class="form-control " type="text" id="institution_email" onpaste="return false" name="institution_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
                                    <div class="invalid-feedback text-justify" id="emailid_error"> Please Enter Email Id </div>
                                    <input type="hidden" id="email_validated">



                                </div>

                            </div>



                            <!-- geeting email verify -->

                            <!-- geeting mobile verify -->
                            <div class="row gx-2 mb-3">

                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="card-password"> Mobile Number <span style="color:red">*</span></label>
                                    </div>
                                    <input class="form-control" type="text" minlength="10" onpaste="return false" maxlength="10" id="institution_mobile" name="institution_mobile" onkeypress="return event.charCode >= 48 && event.charCode <= 57" pattern="^[6-9]\d{9}$" required="">
                                    <input type="hidden" id="mobile_validated">
                                    <div class="invalid-feedback text-justify" id="mobileno_error"> Please Enter mobile number. </div>
                                </div>

                                <div class="row  col-md-6 d-none" id="mobile_otp_div" style="height: 65px;">

                                    <label class="form-label" for="card-password"> Please Enter OTP sent to your mobile number. <span style="color:red">*</span>
                                        <span class="px-2"> Time left : <span id="mobile_timer" style="color:red"> </span></span>
                                    </label>
                                    <div class="col  px-2">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile1" name="email_id" required>

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile2" name="email_id" required>

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile3" name="email_id" required>

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile4" name="email_id" required>

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile5" name="email_id" required>

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval tex-center" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile6" name="email_id" required>

                                    </div>

                                    <div class="invalid-feedback text-justify" id="mobileotp_error"> Please Enter OTP </div>

                                </div>

                                <div id="mobile_otp_button" class="  col-md-2">

                                    <button type="button" id="editmailormobile" onclick="editmail_or_mobile()" class="btn btn-primary d-none  mt-4"> Edit mobile or email. </button>
                                    <button type="button" id="sendmobile_OTP" onclick="sendOTPmobileinstitute()" class="btn btn-primary   mt-4">Send OTP </button>
                                    <button type="button" id="verifymobile_OTP" onclick="verifyOTPmobileinstitute()" class=" btn btn-primary d-none mt-4"> Verify OTP </button>
                                    <button type="button" id="resetmobile_OTP" onclick="reset_OTP(2)" class=" btn btn-primary d-none mt-4"> Reset mobile number </button>
                                    <button type="button" id="resendmobile_OTP" onclick="resend_OTP(2)" class=" btn btn-primary d-none mt-4"> Resend OTP </button>

                                </div>

                            </div>
                            <!-- geeting mobile verify -->

                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-password">Contact Person <span style="color:red">*</span> </label>
                                    </div>
                                    <input class="form-control" type="text" id="contact_person" oncopy="return false" onpaste="return false" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 46) " name="contact_person" pattern="^[A-Za-z ]{1,32}$" required="">
                                    <div class="invalid-feedback text-justify" id="contact_error"> Please Enter Contact Person</div>
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-name"> Institution Type <span style="color:red">*</span> </label>
                                    </div>

                                    <ul class="list-group list-group-flush " id="m_institution_type_id">




                                    </ul>


                                </div>
                            </div>

                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-confirm-password">District <span style="color:red">*</span></label>
                                    </div>
                                    <ul class="list-group list-group-flush" id="m_district_code"></ul>
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="floatingTextarea"> Address </label>
                                    <textarea class="form-control" oncopy="return false" onpaste="return false" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 44) || (event.charCode == 58) || (event.charCode > 47 && event.charCode < 58) || (event.charCode == 35) || (event.charCode == 47) " id="address" name="address"></textarea>
                                </div>
                            </div>


                            <div class="row gx-2">

                                <div class="mb-3 col-sm-6">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="card-password">Pincode </label>
                                    </div>
                                    <input class="form-control" type="text" id="pincode" maxlength="6" oncopy="return false" onpaste="return false" minlength="6" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="pincode" pattern="^[6][0-9]{5}$" required="">
                                    <div class="invalid-feedback text-justify" id="pincode_error"> Please enter valid Pincode</div>
                                </div>
                            </div>

                            <div class="row gx-2 border-top mt-2   mb-2">


                                <div class="col-sm-6 mt-3">

                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-name" id="newpass_label"> New Password <span style="color:red">*</span> </label>
                                    </div>

                                    <input class="form-control" type="password" id="new_password" name="new_password" oncopy="return false" onpaste="return false" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" required="">
                                    <div class="invalid-feedback text-justify" id="newpass_error"> please enter password</div>
                                </div>

                                <div class="  col-sm-6 mt-3">
                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-name" id="confirmpass_label"> Confirm New Password <span style="color:red">*</span> </label>
                                    </div>

                                    <input class="form-control" type="password" id="confirm_password" oncopy="return false" onpaste="return false" name="confirm_password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" required="">
                                    <div class="invalid-feedback text-justify" id="confirmpass_error"> please enter password</div>
                                </div>
                                <span style="color:#f18d8d">Password must be 8-16 characters long must contain at least one lower case letter,one upper case letter,one digit,<br/>one special character ( !@#$%&*_- ) </span>

                            </div>

                            <div class="row gx-2">

                                <div class="mb-3 col-sm-6 mt-3">
                                    <button class="btn btn-primary d-block" id="formsubmitbtn" type="submit" name="submit">Register</button>

                                    <button class="btn btn-primary d-block text-center d-none" id="formsubmitbutton" type="button" onclick="updateProfileDetails()" name="submit"> Update </button>
                                </div>

                            </div>
                        </form>
                    <?php


                    } else if ($usertypeid != '31') {

                    ?>

                        <form class="needs-validation" id="institution_register" name="institution_register" novalidate="" autocomplete="off">
                            <h3 class="text-center mb-2" id="logged_institute_name"> </h3>


                            <div class="row gx-2">

                                <div class="mb-3 col-sm-6">

                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-password"> Current Username <span style="color:red">*</span></label>
                                    </div>
                                    <input class="form-control" type="text" id="username" name="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="" disabled>
                                    <div class="invalid-feedback text-justify"> please enter username </div>


                                </div>

                                <div class="  col-md-6">
                                    <div class="d-flex  ">
                                        <label class="form-label" id="newemaillabel" for="card-password"> Email ID / username <span style="color:red">*</span> ( communication mail) </label>
                                    </div>
                                    <input class="form-control " type="text" id="institution_email" onpaste="return false" name="institution_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
                                    <div class="invalid-feedback text-justify" id="emailid_error"> Please Enter Email Id </div>
                                    <input type="hidden" id="email_validated">
                                </div>
                            </div>




                            <!-- geeting mobile verify -->
                            <div class="row gx-2 mb-3">

                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="card-password"> Mobile Number <span style="color:red">*</span></label>
                                    </div>
                                    <input class="form-control" type="text" minlength="10" onpaste="return false" maxlength="10" id="institution_mobile" name="institution_mobile" onkeypress="return event.charCode >= 48 && event.charCode <= 57" pattern="^[6-9]\d{9}$" required="">
                                    <input type="hidden" id="mobile_validated">
                                    <div class="invalid-feedback text-justify" id="mobileno_error"> Please Enter mobile number. </div>
                                </div>

                                <div class="row  col-md-6 d-none" id="mobile_otp_div" style="height: 65px;">

                                    <label class="form-label" for="card-password"> Please Enter OTP sent to your mobile number. <span style="color:red">*</span>
                                        <span class="px-2"> Time left : <span id="mobile_timer" style="color:red"> </span></span>
                                    </label>
                                    <div class="col  px-2">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile1" name="email_id">

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile2" name="email_id">

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile3" name="email_id">

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile4" name="email_id">

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile5" name="email_id">

                                    </div>
                                    <div class="col  px-1">

                                        <input class="form-control mobile_otpval" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" id="mobile6" name="email_id">

                                    </div>

                                    <div class="invalid-feedback text-justify" id="mobileotp_error"> Please Enter OTP </div>

                                </div>

                                <div id="mobile_otp_button" class="  col-md-2">
                                    <button type="button" id="editmailormobile" onclick="editmail_or_mobile()" class="btn btn-primary d-none  mt-4"> Edit mobile or email. </button>
                                    <button type="button" id="sendmobile_OTP" onclick="sendOTPmobileinstitute()" class="btn btn-primary   mt-4">Send OTP </button>
                                    <button type="button" id="verifymobile_OTP" onclick="verifyOTPmobileinstitute()" class=" btn btn-primary d-none mt-4"> Verify OTP </button>
                                    <button type="button" id="resetmobile_OTP" onclick="reset_OTP(2)" class=" btn btn-primary d-none mt-4"> Reset mobile number </button>
                                    <button type="button" id="resendmobile_OTP" onclick="resend_OTP(2)" class=" btn btn-primary d-none mt-4"> Resend OTP </button>

                                </div>

                            </div>
                            <!-- geeting mobile verify -->

                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <div class="d-flex  ">
                                        <label class="form-label" for="card-password">Contact Person <span style="color:red">*</span> </label>
                                    </div>
                                    <input class="form-control" type="text" id="contact_person" oncopy="return false" onpaste="return false" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 46) " name="contact_person" pattern="^[A-Za-z ]{1,32}$" required="">
                                    <div class="invalid-feedback text-justify" id="contact_error"> Please Enter Contact Person</div>
                                </div>

                                <?php
                                if ($usertype == '30') {
                                ?>
                                    <div class="mb-3 col-sm-6">
                                        <div class="d-flex  ">
                                            <label class="form-label" for="card-name"> Institution Type ( mapped ) <span style="color:red">*</span> </label>
                                        </div>
                                        <!--  <select class="form-select" id="institution_type" name="institution_type[]"   multiple="multiple"   required> -->

                                        <ul class="list-group list-group-flush" id="m_institution_type_id"></ul>

                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="mb-3 col-sm-6">
                                        <div class="d-flex  ">
                                            <label class="form-label" for="card-confirm-password">District ( mapped )<span style="color:red">*</span></label>
                                        </div>
                                        <ul class="list-group list-group-flush" id="m_district_code"></ul>

                                    </div>

                                <?php
                                }

                                ?>


                            </div>

                            <div class="row gx-2 border-top mt-2 mb-2">

                                <div class="row col-md-12  mb-2">

                                    <h5 id="change_password " class="text-center fs-1 mt-3 mb-2"> Change Password </h5>

                                    <div class="col-sm-6">

                                        <div class="d-flex  ">
                                            <label class="form-label" for="card-name" id="newpass_label"> New Password <span style="color:red">*</span> </label>
                                        </div>

                                        <input class="form-control" type="password" id="new_password" name="new_password" oncopy="return false" onpaste="return false" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" required="">
                                        <div class="invalid-feedback text-justify" id="newpass_error"> please enter password</div>
                                    </div>

                                    <div class="  col-sm-6">
                                        <div class="d-flex  ">
                                            <label class="form-label" for="card-name" id="confirmpass_label"> Confirm New Password <span style="color:red">*</span> </label>
                                        </div>

                                        <input class="form-control" type="password" id="confirm_password" oncopy="return false" onpaste="return false" name="confirm_password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" required="">
                                        <div class="invalid-feedback text-justify" id="confirmpass_error"> please enter password</div>
                                    </div>
                                    <span style="color:#f18d8d">Password must be 8-16 characters long must contain at least one lower case letter,one upper case letter,one digit,one special character ( !@#$%&*_- ) </span>

                                </div>

                            </div>



                            <div class="row gx-2">

                                <div class="col-md-12  mb-3 ">
                                    <button class="btn btn-primary d-block " id="formsubmitbtn" type="submit" name="submit">Register</button>
                                     
                                    <button class="btn btn-primary d-block   d-none" id="formsubmitbutton" type="button" onclick="updateProfileDetails()" name="submit"> Update </button>
                                </div>

                            </div>


                        </form>


                    <?php

                    }
                    ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-none" id="closebutton" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {


            //$('#password_reset').modal('show');

            <?php
            //var_dump($_SESSION['user_details']['user_id']);
            $usertype = $_SESSION['user_details']['user_type'];





            if ($usertype != '1000'  and $usertype != '100'  and $usertype != '10') {
            ?>
                check_first_login();

            <?php
            }
            ?>
        });


        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {




                    if (!form.checkValidity()) {

                        event.preventDefault();
                        event.stopPropagation();

                        <?php

                        $usertypes = array(20, 30, 40, 50);
                        if ($_SESSION['user_details']['user_type'] == '31') {

                        ?>
                            formsubmit();
                        <?php


                        } else if (in_array($_SESSION['user_details']['user_type'], $usertypes)) {

                        ?>
                            formsubmit1();
                        <?php
                        }

                        ?>

                    } else {

                        <?php
                        $usertypes = array(20, 30, 40, 50);
                        if ($_SESSION['user_details']['user_type'] == '31') {

                        ?>
                            formsubmit();
                        <?php
                        } else if (in_array($_SESSION['user_details']['user_type'], $usertypes)) {

                        ?>

                            formsubmit1();

                        <?php

                        }
                        ?>

                        event.preventDefault();
                        event.stopPropagation();

                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

        function remove_errors() {

            $("#newpass_error,#confirmpass_error,#emailid_error,#mobileno_error,#contact_error,#pincode_error").css("display", "none");
            $("#new_password,#confirm_password,#institution_email,#institution_mobile,#contact_person,#pincode,#email_first,#email_second,#email_third,#email_fourth,#email_fifth,#email_sixth,#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").removeClass("error_field");

            $("#email_first,#email_second,#email_third,#email_fourth,#email_fifth,#email_sixth,#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").css("background-image", "none");
            $("#email_first,#email_second,#email_third,#email_fourth,#email_fifth,#email_sixth,#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").css("border-color", "#d8e2ef");



        }

        function new_confirm_passwordcheck() {

            $("#confirmpass_error,#newpass_error").css("display:none");
            var equal_password = true;
            $("#confirmpass_error").css("display:none");
            $("#new_password,#confirm_password").removeClass("error_field");

            if ($("#new_password").val() != $("#confirm_password").val()) {

                $("#confirmpass_error").html("Confirm password is not same as new password");
                $("#confirmpass_error").css("display:block");
                $("#confirm_password").addClass("error_field");

                Swal.fire({
                    text: "New Password and Confirm password should be same",
                    icon: "warning",
                    showConfirmButton: true

                })

                var equal_password = false;

            } else if ($("#new_password").val() == '' || $("#confirm_password").val() == '') {

                var equal_password = false;
                $("#new_password,#confirm_password").addClass("error_field");

                $("#confirmpass_error,#newpass_error").css("display:block");

            }

            return equal_password;

        }

        document.addEventListener("DOMContentLoaded", function(event) {


            function email_OTPInput() {
                const inputs = document.querySelectorAll('.mobile_otpval');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode >= 48 && event.keyCode <= 57) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode >= 96 && event.keyCode <= 105) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode >= 65 && event.keyCode <= 90) {
                                return false;
                            }
                        }
                    });
                }
            }
            email_OTPInput();


            function OTPInput_mobile() {

                const inputs = document.querySelectorAll('.email_otpval');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode >= 48 && event.keyCode <= 57) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode >= 96 && event.keyCode <= 105) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode >= 65 && event.keyCode <= 90) {
                                return false;
                            }
                        }
                    });
                }
            }
            OTPInput_mobile();


        });


        /* ProgressCountdown(10, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => alert(`Page has started: ${value}.`));

    function ProgressCountdown(timeleft, bar, text) {
      return new Promise((resolve, reject) => {
        var countdownTimer = setInterval(() => {
          timeleft--;

          document.getElementById(bar).value = timeleft;
          document.getElementById(text).textContent = timeleft;

          if (timeleft <= 0) {
            clearInterval(countdownTimer);
            resolve(true);
          }
        }, 1000);
      });
    }
 */


        /* 
            let timerOn = true;

            function timer(remaining) {


              var m = Math.floor(remaining / 60);
              var s = remaining % 60;

              m = m < 10 ? '0' + m : m;
              s = s < 10 ? '0' + s : s;
              document.getElementById('email_timer').innerHTML = m + ':' + s;
              remaining -= 1;

              if (remaining >= 0 && timerOn) {
                setTimeout(function() {
                  timer(remaining);
                }, 1000);


                return;
              }

              if (!timerOn) {
                // Do validate stuff here
                return;
              }

              $("#resendemail_OTP").css("display", "block");
              $("#resendemail_OTP").removeClass("d-none");
              $("#sendemail_OTP,#verifyemail_OTP,#resetemail_OTP,#email_otp_div").addClass("d-none");


              // Do timeout stuff here
              //alert('Timeout for otp');
            }
             */

        let mobile_timersOn = true;

        function timer_mobile(remaining) {


            var m = Math.floor(remaining / 60);
            var s = remaining % 60;

            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('mobile_timer').innerHTML = m + ':' + s;
            remaining -= 1;

            if (remaining >= 0 && mobile_timersOn) {
                setTimeout(function() {
                    timer_mobile(remaining);
                }, 1000);


                return;
            }

            if (!mobile_timersOn) {
                // Do validate stuff here
                return;
            }

            $("#resendmobile_OTP").css("display", "block");

            $("#resendmobile_OTP").removeClass("d-none");
            $("#sendmobile_OTP,#verifymobile_OTP,#resetmobile_OTP,#mobile_otp_div").addClass("d-none");


            // Do timeout stuff here
            //alert('Timeout for otp');
        }


        //enabling pop if first time password not changed
        function check_first_login() {


            $.ajax({

                method: "POST",
                url: "ajax.php",
                data: {
                    type: 'checkFirstTimeLogin'

                },
                beforeSend: function() {
                    $('.loader_firstimelogin').preloader({
                        text: 'Loading Please Wait ....'
                    });
                },
                success: function(response) {
                    $('.loader_firstimelogin').preloader('remove');
                    resdata = $.parseJSON(response);
                    if (resdata.error_code == '200') {

                        if (resdata.error_msg.insti_loginfirst == 0) {

                            $('#password_reset').modal('show');
                        }


                        $("#logged_institute_name").html(resdata.error_msg.insti_name);
                        $("#contact_person").val(resdata.error_msg.contact_person);
                        $("#m_institution_type_id").html(resdata.error_msg.insti_type_name);
                        $("#m_district_code").html(resdata.error_msg.insti_disctrict);
                        $("#username").val(resdata.error_msg.insti_email);
                        $("#institution_mobile").val(resdata.error_msg.insti_phoneno);

                        if (resdata.error_msg.insti_phoneno) {

                            $("#mobile_validated").val(1);
                            $("#sendmobile_OTP").addClass("d-none");
                            $("#editmailormobile").removeClass("d-none");
                            $("#institution_email,#institution_mobile").attr("readonly", true);


                        }

                        $("#address").val(resdata.error_msg.insti_address);
                        $("#pincode").val(resdata.error_msg.insti_pincode);

                        $("#form_id").val(resdata.error_msg.user_id);



                    } else if (resdata.error_code == '400') {

                        Swal.fire({
                            text: resdata.error_msg,
                            icon: "warning",
                            showConfirmButton: true

                        })
                    }
                }
            });
        }
        // enabling pop if first time password not changed




        //institution email exist check

        $("#institution_email").blur(function(event) {


            if ($("#institution_email").val() && $("#mobile_validated").val() != '1' && $("#mobile_validated").val() == '') {

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'checkInstitutionEmailExist',
                        institution_email: $("#institution_email").val()
                    },

                    success: function(response) {

                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            $("#institution_email").removeClass("error_field");
                            $("#emailid_error").css("display", "none");

                            $("#email_validated").val('1');
                             

                        } else if (resdata.error_code == '400') {


                            $("#email_validated").val('');
                            $("#institution_email").addClass("error_field");

                            $("#emailid_error").html(resdata.error_msg);
                            $("#emailid_error").css("display", "block");

                            event.preventDefault();
                             
                             
                            /* Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            }) */
                        }
                    }
                });
            } else {

                if (!$("#updatfrm").val()) {

                    if ($("#institution_email").val() == '') {

                        $("#institution_email").addClass("error_field");

                    } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#institution_email").val())) {

                        $("#institution_email").addClass("error_field");

                    }
                } else {

                    if ($("#institution_email").val() == '') {

                        $("#institution_email").addClass("error_field");

                    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#institution_email").val()))) {

                        $("#institution_email").addClass("error_field");

                    }

                }


            }

        });
        //institution email exist check


        //institution mobile exist check

        $("#institution_mobile").blur(function(event) {


            if ($("#institution_mobile").val() && $("#mobile_validated").val() != '1' && $("#mobile_validated").val() == '' && $("#email_validated").val() != '' ) {

                $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'checkInstitutionmobileExist',
                        institution_mobile: $("#institution_mobile").val()
                    },

                    success: function(response) {

                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {


                            $("#institution_mobile").removeClass("error_field");
                            $("#mobileno_error").css("display", "none");
                            //$("#contact_person").focus();
                             

                        } else if (resdata.error_code == '400') {

                            $("#institution_mobile").addClass("error_field");
                            $("#mobileno_error").css("display", "block");
                            $("#mobileno_error").html(resdata.error_msg);

                            

                            Swal.fire({

                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true
                            });
                            event.preventDefault();

                            //$("#institution_mobile").focus();

                        }


                    }
                });

            } else {





                if (!$("#updatfrm").val()) {


                    if ($("#institution_mobile").val() == '') {

                        $("#institution_mobile").addClass("error_field");

                    }

                } else if ($("#institution_mobile").val()) {

                    if ($("#email_validated").val() == '') {

                        

                        event.preventDefault();
                    } else if ($("#institution_mobile").val().length != '10') {

                        $("#institution_mobile").addClass("error_field");
                    }

                } else if ($("#institution_mobile").val() == '') {

                    $("#institution_mobile").addClass("error_field");
                }


            }


        });
        //institution mobile exist check









        //send email OTP
        /* 
        function sendOTPemailinstitute() {


          remove_errors();

          $.ajax({

            method: "POST",
            url: "ajax.php",
            data: {
              type: 'sendOTPemailinstitute',
              email_id: $("#institution_email").val()
            },
            beforeSend: function() {
              $('.loader_firstimelogin').preloader({
                text: 'Loading Please Wait ....'
              });
            },
            success: function(response) {
              $('.loader_firstimelogin').preloader('remove');
              resdata = $.parseJSON(response);
              if (resdata.error_code == '200') {

                $("#institution_email").prop("readonly", true);

                Swal.fire({
                  text: resdata.error_msg,
                  icon: "info",
                  showConfirmButton: true

                })


                $("#email_otp_div").removeClass("d-none");
                $("#verifyemail_OTP").removeClass("d-none");
                $("#sendemail_OTP").addClass("d-none");

                timer(300);

              } else if (resdata.error_code == '400') {

                Swal.fire({
                  text: resdata.error_msg,
                  icon: "warning",
                  showConfirmButton: true

                })
              }
            }
          });


        } */


        //send email OTP


        //timer  on div


        //timer on div 




        //function ends verify email
        /* 
        function verifyOTPemailinstitute() {


          $("#email_first,#email_second,#email_third,#email_fourth,#email_fifth,#email_sixth").removeClass(".error_field");


          var value = $('.email_otpval').filter(function() {
            return this.value === '';
          });

          if (value.length == 0) {

            var emailOTp = $("#email_first").val() + $("#email_second").val() + $("#email_third").val() + $("#email_fourth").val() + $("#email_fifth").val() + $("#email_sixth").val();

            $.ajax({

              method: "POST",
              url: "ajax.php",
              data: {
                type: 'checkOTPemailinstitute',
                email_id: $("#institution_email").val(),
                OTp: emailOTp

              },
              beforeSend: function() {
                $('.loader_firstimelogin').preloader({
                  text: 'Loading Please Wait ....'
                });
              },
              success: function(response) {
                $('.loader_firstimelogin').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata.error_code == '200') {


                  $("#email_validated").val('1');

                  $("#email_otp_div").addClass("d-none");
                  $("#verifyemail_OTP").addClass("d-none");
                  $("#sendemail_OTP").addClass("d-none");
                  $("#resetemail_OTP").removeClass("d-none");
                  $("#institution_email").addClass("verified_field");
                  $("#email_otp_button").addClass("col-md-3").removeClass("col-md-2");



                } else if (resdata.error_code == '400') {

                  Swal.fire({
                    text: resdata.error_msg,
                    icon: "warning",
                    showConfirmButton: true

                  })
                }
              }
            });
          } else if (value.length > 0) {



            Swal.fire({
              text: 'OTP field is emtpy please check',
              icon: "warning",
              showConfirmButton: true

            })

            if ($("#email_first").val() == '') {



              $("#email_first").addClass("error_field");
              $("#email_first").focus();


            }
            if ($("#email_second").val() == '') {



              $("#email_second").addClass("error_field");
              $("#email_second").focus();


            }
            if ($("#email_third").val() == '') {



              $("#email_third").addClass("error_field");
              $("#email_third").focus();

            }
            if ($("#email_fourth").val() == '') {



              $("#email_fourth").addClass("error_field");
              $("#email_fourth").focus();

            }
            if ($("#email_fifth").val() == '') {



              $("#email_fifth").addClass("error_field");
              $("#email_fifth").focus();

            }

            if ($("#email_sixth").val() == '') {



              $("#email_sixth").addClass("error_field");
              $("#email_sixth").focus();
            }
          }
        } */


        //function ends verify email



        function reset_OTP(type) {


            remove_errors();

            var field = "a";
            if (type == 1) {

                $("#email_validated,#institution_email").val("");
                $("#institution_email").removeClass('verified_field');
                $("#institution_email").removeAttr('readonly');

                $("#sendemail_OTP").removeClass("d-none");
                $("#verifyemail_OTP,#resetemail_OTP,#email_otp_div").addClass("d-none");
                $("#email_first,#email_second,#email_third,#email_fourth,#email_fifth,#email_sixth").val("");
                $("#email_otp_button").addClass("col-md-2").removeClass("col-md-3");

            } else {
                $("#mobile_validated,#institution_mobile").val("");

                $("#institution_mobile").removeClass('verified_field');
                $("#institution_mobile").removeAttr('readonly');

                $("#sendmobile_OTP").removeClass("d-none");
                $("#verifymobile_OTP,#resetmobile_OTP,#mobile_otp_div").addClass("d-none");
                $("#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").val("");
                $("#email_otp_button").addClass("col-md-2").removeClass("col-md-3");


            }

        }

        //send email OTP
        function sendOTPmobileinstitute() {

            $("#institution_mobile").removeClass("error_field ");
            $("#mobileno_error").css("display", "none");

            if ($("#institution_mobile").val() != '' && $("#mobile_validated").val() != '1' && $("#email_validated").val() != ''   ) {

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'sendOTPmobileinstitute',
                        mobile_no: $("#institution_mobile").val()
                    },
                    beforeSend: function() {
                        $('.loader_firstimelogin').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader_firstimelogin').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            $("#institution_mobile").prop("readonly", true);

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "info",
                                showConfirmButton: true

                            })


                            $("#mobile_otp_div").removeClass("d-none");
                            $("#verifymobile_OTP").removeClass("d-none");
                            $("#sendmobile_OTP").addClass("d-none");

                            timer_mobile('300');
                        } else if (resdata.error_code == '400') {

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            })
                        }
                    }
                });
            } else {

                if($("#email_validated").val == ''){
                    $("#institution_email").addClass("error_field");

                }
                $("#institution_mobile").addClass("error_field");

            }

        }
        //send email OTP


        //function starts verify mobile
        function verifyOTPmobileinstitute() {

            $("#institution_mobile").removeClass("error_field ");
            $("#mobileno_error").css("display", "none");
            $("#mobile1,#mobile2,#mobile3,#mobile4,#mobile5,#mobile6").removeClass(".error_field");


            var value = $('.mobile_otpval').filter(function() {
                return this.value === '';
            });

            if (value.length == 0) {

                var mobileOTp = $("#mobile1").val() + $("#mobile2").val() + $("#mobile3").val() + $("#mobile4").val() + $("#mobile5").val() + $("#mobile6").val();

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {
                        type: 'checkOTPmobileinstitute',
                        mobileno: $("#institution_mobile").val(),
                        OTp: mobileOTp

                    },
                    beforeSend: function() {
                        $('.loader_firstimelogin').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader_firstimelogin').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            $("#mobile_validated").val('1');
                            $("#mobile_otp_div").addClass("d-none");
                            $("#verifymobile_OTP").addClass("d-none");
                            $("#sendmobile_OTP").addClass("d-none");
                            $("#resetmobile_OTP").removeClass("d-none");
                            $("#institution_mobile").addClass("verified_field");
                            $("#institution_mobile,#institution_email").attr("readonly", true);
                            $("#mobile_otp_button").addClass("col-md-3").removeClass("col-md-2");




                        } else if (resdata.error_code == '400') {

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            })
                        }
                    }
                });
            } else if (value.length > 0) {



                Swal.fire({
                    text: 'OTP field is emtpy please check',
                    icon: "warning",
                    showConfirmButton: true

                })

                if ($("#mobile1").val() == '') {



                    $("#mobile1").addClass("error_field");
                    $("#mobile1").focus();


                }
                if ($("#mobile2").val() == '') {



                    $("#mobile2").addClass("error_field");
                    $("#mobile2").focus();


                }
                if ($("#mobile3").val() == '') {



                    $("#mobile3").addClass("error_field");
                    $("#mobile3").focus();

                }
                if ($("#mobile4").val() == '') {



                    $("#mobile4").addClass("error_field");
                    $("#mobile4").focus();

                }
                if ($("#mobile5").val() == '') {



                    $("#mobile5").addClass("error_field");
                    $("#mobile5").focus();

                }

                if ($("#mobile6").val() == '') {



                    $("#mobile6").addClass("error_field");
                    $("#mobile6").focus();
                }
            }
        }
        //function ends verify mobile


        //resend otp
        function resend_OTP(value) {

            if (value == '1') {
                $("#resendemail_OTP").addClass("d-none");
                sendOTPemailinstitute();
            } else {
                $("#resendmobile_OTP").addClass("d-none");
                sendOTPmobileinstitute();
            }
        }
        //resend otp

        function editmail_or_mobile() {

            $("#institution_email,#institution_mobile").attr("readonly", false);
            $("#mobile_validated,#email_validated").val('');
            $("#editmailormobile").addClass("d-none");
            $("#sendmobile_OTP").removeClass("d-none");



            Swal.fire({
                text: "New username or mobile number will be updated by verifing your moblie number using OTP after completion.",
                icon: "info",
                showConfirmButton: true

            })


        }


        function get_userDetails() {

            $('#password_reset').modal('show');
            $("#logoutbutton").addClass("d-none");

            $("#updatfrm").val('1');
            $("#formsubmitbtn").addClass("d-none");
            $("#formsubmitbutton,#closebutton").removeClass("d-none");
            $("#confirmpass_label").html('Confirm New Password');
            $("#newpass_label").html('  New Password');
            $("#newemaillabel").html('New Username / Email  ');
            $("#popupheading_text").html('Update your Profile');




        }

        function updateProfileDetails() {


            $("#emailid_error,#mobileno_error,#newpass_error,#confirmpass_error,#contact_error").removeClass("");



            var address = $("#address").val() ? $("#address").val() : '';
            var pincode = $("#pincode").val() ? $("#pincode").val() : '';






            if ($("#institution_email").val() == '') {

                var email_mobile = true;

            } else if ($("#institution_email").val()) {

                if ($("#username").val() == $("#institution_email").val()) {

                    Swal.fire({
                        text: "New username will be updated by verifing your moblie number using OTP after completion.",
                        icon: "info",
                        showConfirmButton: true

                    })

                } else {

                    var email_mobile = $("#mobile_validated").val();

                }





            }

            if ($("#institution_mobile").val() != '') {

                var mobilevalidatin = $("#mobile_validated").val();

            } else {

                var mobilevalidatin = true;
            }
            //password validation for updation personal details

            //password validation for updation personal details
            if ($("#new_password").val() == '' && $("#confirm_password").val() == '') {

                equal_password = true;

            } else {

                var equal_password = true;
                if ($("#new_password").val() != $("#confirm_password").val()) {


                    $("#confirmpass_error").html("Confirm password is not same as new password");
                    $("#confirmpass_error").css("display:block");
                    $("#confirm_password").addClass("error_field");

                    Swal.fire({
                        text: "New Password and Confirm password should be same",
                        icon: "warning",
                        showConfirmButton: true

                    })

                    var equal_password = false;
                }
            }
            //password validation for updation personal details


            if (!email_mobile) {

                Swal.fire({
                    text: 'Mobile number is not validated. Please validate mobile number to proceed the update.',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#institution_mobile").addClass("error_field");
                $("#mobileno_error").css("display", "block");
                $("#mobileno_error").html('mobile number is not validated please validate.');


            } else if (!mobilevalidatin) {

                Swal.fire({
                    text: 'Mobile number is not validated. Please validate mobile number to proceed the update.',
                    icon: "warning",
                    showConfirmButton: true

                })
                $("#mobileno_error").css("display", "block");


            } else if (!equal_password) {



            } else if ($("#contact_person").val() == '') {

                Swal.fire({
                    text: 'Please enter contact person.',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#contact_error").css("display", "block");


            } else {


                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {

                        type: 'newinstitutiondetailsupdate',
                        updatetype: 2,
                        new_password: $("#new_password").val(),
                        confirm_password: $("#confirm_password").val(),
                        insti_email: $("#institution_email").val(),
                        insti_mobileno: $("#institution_mobile").val(),
                        insti_contact: $("#contact_person").val(),
                        insti_address: address,
                        insti_pincode: pincode


                    },
                    beforeSend: function() {
                        $('.loader_firstimelogin').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader_firstimelogin').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            Swal.fire({
                                html: resdata.error_msg,
                                icon: "info",
                                showConfirmButton: true

                            }).then(function() {

                                $('#password_reset').modal('hide');
                                if (resdata.major_update == '1') {

                                    window.location = "logout.php";

                                } else {

                                    location.reload();
                                }







                            });

                        } else if (resdata.error_code == '400') {

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            })
                        }
                    }
                });
            }
        }


        //function for other user login type 30,20,40,50
        function formsubmit1() {


            //removing error field

            $("#emailid_error,#mobileno_error").css("display", "none");
            $("#confirm_password,#institution_mobile,#institution_email").removeClass("error_field");


            //removing error field
            var password_valid = new_confirm_passwordcheck();

            if (!password_valid) {


            } else if ($("#institution_email").val == '') {


                Swal.fire({
                    text: 'Email is not validated. Please validate email to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#emailid_error").css("display", "block");
                $("#emailid_error").html('Email id is emtpy  please check.');

            } else if ($("#institution_mobile").val == '') {

                Swal.fire({
                    text: 'mobile number  is emtpy. Please check',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#mobileno_error").css("display", "block");
                $("#mobileno_error").html('mobile number is emtpy  please check.');


            } else if ($("#email_validated").val() == '') {

                Swal.fire({
                    text: 'Email is not validated. Please validate email to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#emailid_error").css("display", "block");
                $("#institution_email").addClass("error_field");
                $("#emailid_error").html('Email is not validated please validate.');


            } else if ($("#mobile_validated").val() == '') {

                Swal.fire({
                    text: 'Mobile number is not validated. Please validate mobile number to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })
                $("#institution_mobile").addClass("error_field");
                $("#mobileno_error").css("display", "block");
                $("#mobileno_error").html('mobile number is not validated please validate.');

            } else {

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {

                        type: 'newinstitutiondetailsupdate',
                        updatetype: 1,
                        new_password: $("#new_password").val(),
                        confirm_password: $("#confirm_password").val(),
                        insti_email: $("#institution_email").val(),
                        insti_mobileno: $("#institution_mobile").val(),
                        insti_contact: $("#contact_person").val(),
                        insti_address: '',
                        insti_pincode: ''


                    },
                    beforeSend: function() {
                        $('.loader_firstimelogin').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader_firstimelogin').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            Swal.fire({
                                html: resdata.error_msg,
                                icon: "info",
                                showConfirmButton: true

                            }).then(function() {

                                window.location.href = "logout.php";
                            });





                        } else if (resdata.error_code == '400') {

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            })
                        }
                    }
                });
            }
        }
        //function for other user login type 30,20,40,50





        //submiting form details
        function formsubmit() {

            //removing error field
            $("#address").css("background-image", "none");
            $("#address").css("background-image", "none");
            $("#emailid_error,#mobileno_error").css("display", "none");
            $("#confirm_password,#institution_mobile,#institution_email,#pincode").removeClass("error_field");

            //removing error field

            $("#pincode_error").css("display", "none");


            var password_valid = new_confirm_passwordcheck();
            var pincode_error = 1;
            if ($("#pincode").val() != '') {

                var pincode_field = $("#pincode").val();
                var pattern = /^[6][0-9]{5}$/;
                if (pattern.test(pincode_field) == true) {

                    var pincode_error = 1;

                } else {

                    var pincode_error = 0;
                }

            }



            if (!password_valid) {


            } else if ($("#institution_email").val == '') {


                Swal.fire({
                    text: 'Email is not validated. Please validate email to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#emailid_error").css("display", "block");
                $("#emailid_error").html('Email id is emtpy  please check.');

            } else if ($("#institution_mobile").val == '') {

                Swal.fire({
                    text: 'mobile number  is emtpy. Please check',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#mobileno_error").css("display", "block");
                $("#mobileno_error").html('mobile number is emtpy  please check.');


            } else if ($("#email_validated").val() == '') {

                Swal.fire({
                    text: 'Email is not validated. Please validate email to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })

                $("#emailid_error").css("display", "block");
                $("#institution_email").addClass("error_field");
                $("#emailid_error").html('Email is not validated please validate.');


            } else if ($("#mobile_validated").val() == '') {

                Swal.fire({
                    text: 'Mobile number is not validated. Please validate mobile number to proceed',
                    icon: "warning",
                    showConfirmButton: true

                })
                $("#institution_mobile").addClass("error_field");
                $("#mobileno_error").css("display", "block");
                $("#mobileno_error").html('mobile number is not validated please validate.');

            } else if (pincode_error) {

                $.ajax({

                    method: "POST",
                    url: "ajax.php",
                    data: {

                        type: 'newinstitutiondetailsupdate',
                        updatetype: 1,
                        new_password: $("#new_password").val(),
                        confirm_password: $("#confirm_password").val(),
                        insti_email: $("#institution_email").val(),
                        insti_mobileno: $("#institution_mobile").val(),
                        insti_contact: $("#contact_person").val(),
                        insti_address: $("#address").val(),
                        insti_pincode: $("#pincode").val()


                    },
                    beforeSend: function() {
                        $('.loader_firstimelogin').preloader({
                            text: 'Loading Please Wait ....'
                        });
                    },
                    success: function(response) {
                        $('.loader_firstimelogin').preloader('remove');
                        resdata = $.parseJSON(response);
                        if (resdata.error_code == '200') {

                            Swal.fire({
                                html: resdata.error_msg,
                                icon: "info",
                                showConfirmButton: true

                            }).then(function() {

                                window.location.href = "logout.php";
                            });





                        } else if (resdata.error_code == '400') {

                            Swal.fire({
                                text: resdata.error_msg,
                                icon: "warning",
                                showConfirmButton: true

                            })
                        }
                    }
                });
            } else {

                $("#pincode").addClass("error_field");
                $("#pincode").html('pincode is invalid');

            }


        }

        //submiting form details
    </script>