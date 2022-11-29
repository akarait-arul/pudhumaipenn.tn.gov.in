
/* $.ajaxSetup({ 'global': true });
 $(document).ready(function() {
 $(document).ajaxStart(function() {
 $('.loader').show();
 });
 $(document).ajaxStop(function() {
 $('.loader').hide();
 });
 $(document).ajaxError(function() {
 $('.loader').hide();
 });
 }); */

//Document Ready Function
$(document).ready(function () {

    //GetSchoolDistrictList();			
    GetReligion();
    getInstitutionType();
    getDistrictFromSchoolMaster();
    GetDegree();
    getAcademicYear();
    getYearOfCompletion();
});

// Check Student EMIS Details
function SubmitStudentEMIS() {

    var emis_id = $("#emis_id").val();
    if (emis_id !== '') {

        $.ajax({

            method: "POST",
            url: "ajax.php",
            data: {
                emis_id: emis_id,
                type: 'GetStudentEMIS'
            },
            beforeSend: function () {
                $('.loader').preloader({
                    text: 'Processing Please Wait.'
                });
            },
            success: function (response) {

                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200) {

                    /* $("form#form_student_details :input").each(function () {
                     $($(this)).attr("style", "pointer-events: none;");
                     }) */

                    $("#content-student-details").removeClass("col-md-12 mb-3 mt-3 d-none").addClass("col-md-12 mb-3 mt-3 d-block");
                    $("#button_student_details_confirm").removeClass("row d-none").addClass("row d-block");
                    $("#reset_form").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");

                    if (resdata['emis_data']['community'] != '') {
                        $("#community").val('');
                        GetCommunity(resdata['emis_data']['religion'], resdata['emis_data']['community']);
                    }

                    $.each(resdata['emis_data'], function (index, value) {

                        if (index == 'religion') {

                            $('#' + index).val(value);

                        } else if (index == 'community') {

                            //$('#'+index).val(value);								

                        } else {

                            $('#' + index).val(value);
                        }

                    });



                } else if (resdata['error_code'] == 400) {

                    $("#content-student-details").removeClass("col-md-12 mb-3 mt-3 d-block").addClass("col-md-12 mb-3 mt-3 d-none");
                    $("#button_student_details_confirm").removeClass("row d-block").addClass("row d-none");
                    $("#reset_form").removeClass("card mb-3 d-block").addClass("card mb-3 d-none");
                    $('#form_student_details')[0].reset();

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                    $("#emis_id").focus()
                }

            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

                $('.loader').preloader('remove');

            }

        });

    } else {

        $("#content-student-details").removeClass("col-md-12 mb-3 mt-3 d-block").addClass("col-md-12 mb-3 mt-3 d-none");
        $("#button_student_details_confirm").removeClass("row d-block").addClass("row d-none");
        $("#reset_form").removeClass("card mb-3 d-block").addClass("card mb-3 d-none");
        Swal.fire({
            icon: 'info',
            html: 'Please enter student EMIS ID'
        })

    }

}

function callback(div_id) {

    $('html, body').animate({
        scrollTop: $(div_id).offset().top
    }, 200);
    return false;

}

$('#emis_id').on('keyup change', function () {

    if (!$('#emis_id').is('[readonly]')) {
        $("#content-student-details").removeClass("col-md-12 mb-3 mt-3 d-block").addClass("col-md-12 mb-3 mt-3 d-none");
        $("#button_student_details_confirm").removeClass("row d-block").addClass("row d-none");
        $("#reset_form").removeClass("card mb-3 d-block").addClass("card mb-3 d-none");
        $('#form_student_details')[0].reset();
    }



});

function ResetApplication() {

    Swal.fire({
        icon: 'info',
        html: "Saved Data will lost when you reset apllication. Please confirm ?",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok',
        showCancelButton: true,
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            DeleteTempAadhar();
            setTimeout(function () {
                location.reload();
            }, 800);
        }
    })

}

//get institution type																																				
function GetCommunity(idreligion, _setvalue) {

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {

            type: 'GetCommunity',
            religion: idreligion

        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#community').empty().append();
                $('#community')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Community'));
                $.each(resdata['error_msg'], function (index, value) {
                    if (_setvalue > 0 && value['m_community_id'] == _setvalue) {
                        $('#community')
                                .append($("<option></option>")
                                        .attr("value", value['m_community_id'])
                                        .attr("selected", true)
                                        .text(value['community_name']));
                    } else {

                        $('#community')
                                .append($("<option></option>")
                                        .attr("value", value['m_community_id'])
                                        .text(value['community_name']));
                    }
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

//Function Confirm Student EMIS Details
function ConfirmStudentDetails(verify_status) {

    if (verify_status == true) {

        //Validate Student Name
        if ($("#student_name_emis").val() != '') {

            // Validate Student Date Of Birth
            if ($("#date_of_birth").val() != '') {

                if ($("#religion").val() != '') {

                    if ($("#community").val() != '') {

                        if ($("#gender").val() != '') {

                            if ($("#mother_name").val() != '') {

                                if ($("#father_name").val() != '') {

                                    if ($("#parent_mobile").val() != '') {

                                        Swal.fire({
                                            icon: 'info',
                                            html: 'Do you want to confirm and continue ?',
                                            showCancelButton: true,
                                            confirmButtonText: 'YES',
                                            allowOutsideClick: false,
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {

                                                $("#div_student_aadhar").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                                                $('#form_student_emis_details input').attr('readonly', 'readonly');
                                                $("#emis_valid_button").addClass("d-none");
                                                $("#button_student_details_confirm").removeClass("row d-block").addClass("row d-none");
                                                $("#student_details_verified").removeClass("d-none").addClass("d-block");
                                                $("#aadhaar_refrence_msg").removeClass("d-none").addClass("d-block").html("Please Enter the Student Aadhaar Number");
                                                $("#reset_form").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                                                $("form#form_student_emi1s_details :input").each(function () {
                                                    $($(this)).attr("style", "pointer-events: none;");
                                                })
                                                $("form#form_student_details :input").each(function () {
                                                    $($(this)).attr("style", "pointer-events: none;");
                                                })
                                                callback("#div_student_aadhar");
                                            }

                                        })


                                    } else {

                                        Swal.fire({
                                            icon: 'info',
                                            html: 'Enter Enter Parent Mobile Number'
                                        })


                                    }


                                } else {

                                    Swal.fire({
                                        icon: 'info',
                                        html: 'Enter Enter Student Father Name'
                                    })

                                }


                            } else {

                                Swal.fire({
                                    icon: 'info',
                                    html: 'Enter Enter Student Mother Name'
                                })

                            }

                        } else {

                            Swal.fire({
                                icon: 'info',
                                html: 'Enter Select Student Gender'
                            })

                        }


                    } else {

                        Swal.fire({
                            icon: 'info',
                            html: 'Enter Select Student Community'
                        })

                    }


                } else {

                    Swal.fire({
                        icon: 'info',
                        html: 'Enter Select Student Religion'
                    })

                }

            } else {

                Swal.fire({
                    icon: 'info',
                    html: 'Enter Select Student Date of Birth'
                })

            }


        } else {

            Swal.fire({
                icon: 'info',
                html: 'Enter Student Name'
            })
            $('#student_name_emis').focus();

        }

    } else {

        $("#div_student_aadhar").removeClass("card mb-3 d-block").addClass("card mb-3 d-none");
        Swal.fire({
            icon: 'info',
            html: "Please contact helpdesk to resolve your issues. <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    location.reload();
                }, 100);
            }
        })

    }

}

function ValidateStudenteKYC() {

    $("#ekyc_aadhar_details").removeClass("row d-block").addClass("row d-none");
    var aadhaar_no = $("#aadhaar_no_2").val();
    var aadhaar_no_mask = $("#aadhaar_no_mask").val();
    if (aadhaar_no != '' && aadhaar_no.length == 12) {

        if (aadhaar_no_mask == aadhaar_no) {

            eKYC_aadharvalidate();

        } else if (aadhaar_no_mask != aadhaar_no) {

            if (aadhaar_no_mask != 0) {

                //if emis and aadhar are not same		
                Swal.fire({
                    icon: 'info',
                    html: 'Entered Aadhaar number is not same with the EMIS Aadhaar Number.<br> Do you want to confirm and continue ?',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                }).then((result) => {
                    if (result.isConfirmed) {
                        eKYC_aadharvalidate();
                    }
                })

            } else if (aadhaar_no_mask == 0) {

                eKYC_aadharvalidate();

            }

        }

    } else {

        Swal.fire({
            icon: 'info',
            html: 'Please enter valid Aadhaar Number'
        })

    }

}

function eKYC_aadharvalidate() {


    var aadhaar_no = $("#aadhaar_no_2").val();
    var aadhaar_no_emis = $("#aadhaar_no_mask").val();
    var emis_validation_flag = $("#emis_validation_flag").val();
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            emis_validation_flag: emis_validation_flag,
            aadhaar_no: aadhaar_no,
            aadhaar_no_emis: aadhaar_no_emis,
            type: 'GetAadhaarDetails'
        },
        beforeSend: function () {
            $('.loader').preloader({
                text: 'Processing Please Wait.'
            });
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_status'] == true) {

                $("#aadhaar_token").val(resdata['aadhaar_trns_code']);
                $("#aadhaar_otp_mobile_number").html(resdata['aadhar_mobile']);
                $('#aadhaar_otp').val('');
                $('#aadhaar_otp_modal').modal('show');
                //timeraadhar(600);
                newtimeraadhar();

            } else if (resdata['error_code'] == 400) {

                Swal.fire({
                    icon: 'info',
                    html: resdata['error_msg']
                })

            } else if (resdata['error_code'] == 112) {

                Swal.fire({
                    icon: 'info',
                    html: "Aadhaar number does not have both email and mobile. Link your mobile number and email to your Aadhaar number",
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function () {
                            location.reload();
                        }, 100);
                    }
                })


            }

        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

            $('.loader').preloader('remove');

        }

    });

}

$("#ekyc_OTP_close").click(function (e) {
    clearInterval(aadhar_interval);
    aadhaar_otp_int = "10:00";
});

$("#sms_otp_close").click(function (e) {
    clearInterval(sms_interval);
    sms_otp_int = "10:00";
});

//Submit aadhar Validation OTP      
$("#form_aadhaar_otp").submit(function (e) {

    clearInterval(aadhar_interval);
    aadhaar_otp_int = "10:00";

    var aadhaar_no = $("#aadhaar_no_2").val();
    var aadhaar_token = $("#aadhaar_token").val();
    var aadhaar_otp = $("#aadhaar_otp").val();
    if (aadhaar_no != '' && aadhaar_token != '' && aadhaar_otp != '') {

        $.ajax({

            method: "POST",
            url: "ajax.php",
            data: {

                aadhaar_otp: aadhaar_otp,
                aadhaar_no: aadhaar_no,
                aadhaar_token: aadhaar_token,
                type: 'ValidateAadhaarDetails'

            },
            beforeSend: function () {

                $('#aadhaar_otp').prop('readonly', true);
                $("#ekyc_button_validate").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
                $("#ekyc_button_loading").removeClass("btn btn-primary d-none").addClass("btn btn-primary d-block");

            },
            success: function (response) {

                resdata = $.parseJSON(response);
                if (resdata['resp_code'] == 'y' && resdata['error_status'] == true) {

                    Swal.fire({
                        icon: 'success',
                        html: resdata['error_msg']
                    })

                    $("#aadhr_name").html(resdata.aadhar_details.name);
                    var gender = resdata.aadhar_details.gender;
                    var gender_name = 'Female';
                    if (gender == 'M') {
                        var gender_name = 'Male'
                    }

                    $("#aadhar_verified").val(resdata['aadhar_verified']);
                    $("#aadhr_gender").html(gender_name);
                    $("#aadhr_dob").html(resdata.aadhar_details.dob);
                    var address = resdata.aadhar_details.houseno + ',' + resdata.aadhar_details.street + ', ' + resdata.aadhar_details.nagarname + ',' + resdata.aadhar_details.areaname + ',' + resdata.aadhar_details.pincode + ',' + resdata.aadhar_details.district + ',' + resdata.aadhar_details.state + ',' + resdata.aadhar_details.country;
                    $("#aadhr_address").html(address);
                    var baseStr64 = resdata.aadhar_details.photo;
                    document.getElementById("aadhr_img").setAttribute('src', "data:image/jpg;base64," + baseStr64);
                    $('#aadhaar_otp_modal').modal('hide');
                    $("#ekyc_aadhar_details").removeClass("row d-none").addClass("row d-block");
                    callback("#ekyc_aadhar_details");

                } else if (resdata['resp_code'] == 'n' && resdata['error_status'] == false) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })
                    $('#aadhaar_otp_modal').modal('hide');
                    $("#aadhaar_token").val('');
                    $("#aadhaar_otp").val('');

                }

            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

                $('#aadhaar_otp').prop('readonly', false);
                $("#ekyc_button_validate").removeClass("btn btn-primary d-none").addClass("btn btn-primary");
                $("#ekyc_button_loading").removeClass("btn btn-primary d-block").addClass("btn btn-primary d-none");

            }

        });

    }

    e.preventDefault();

});

function ConfirmEKYC(verify_status) {

    if (verify_status == true) {

        Swal.fire({

            icon: 'info',
            html: 'Do you want to confirm and continue ?',
            showCancelButton: true,
            confirmButtonText: 'Confirm',

        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                $("#aadhaar_number_validation").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
                $("#div_student_ekyc_with_button").removeClass("col-md-12").addClass("col-md-12 d-none");
                $("#div_student_ekyc_verified").removeClass("d-none").addClass("d-block");
                $('#form_aadhaar_validation input').attr('readonly', 'readonly');
                $("#bank_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");

                var aadhaar_no = $("#aadhaar_no_2").val();
                $("#aadhaar_no_bank").val(aadhaar_no);
            }

        })

    } else {

        Swal.fire({
            icon: 'info',
            html: "Please contact helpdesk to resolve your issues <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                DeleteTempAadhar();
                setTimeout(function () {
                    location.reload();
                }, 800);
            }
        })

    }

}

function ValidateNPCI() {

    var aadhaar_no_ekyc = $("#aadhaar_no_2").val();
    var aadhaar_no_npci = $("#aadhaar_no_bank").val();

    if (aadhaar_no_ekyc != '' && aadhaar_no_npci != '' && aadhaar_no_ekyc == aadhaar_no_npci) {

        $.ajax({

            method: "POST",
            url: "ajax.php",
            data: {
                aadhaar_no: aadhaar_no_npci,
                type: 'GetBankDetails'
            },
            beforeSend: function () {
                $('.loader').preloader({
                    text: 'Processing Please Wait..'
                });
            },
            success: function (response) {

                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                    $("#div_validate_bank").removeClass("d-none mt-5").addClass("d-block mt-5");
                    $("#bank_verified").val(resdata['bank_verified']);
                    $("#bank_verified_msg").val(resdata['error_msg']);
                    $("#bank_name").val(resdata['bankName']);
                    $("#status").val(resdata['status']);
                    $("#div_student_bank_verified").removeClass("d-none").addClass("d-block");
                    $("#div_student_bank_verified").html(resdata['error_msg']);
                    $("#div_college_details").removeClass("d-none").addClass("d-block");
                    $("#bank_aadhaar_validation").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
                    callback("#div_college_details");

                } else if (resdata['error_code'] == 201) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                    $("#bank_verified").val(resdata['bank_verified']);
                    $("#div_student_bank_verified").removeClass("d-none").addClass("d-block");
                    $("#div_student_bank_verified").html(resdata['error_msg']);
                    $("#bank_aadhaar_validation").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
                    $("#div_college_details").removeClass("d-none").addClass("d-block");
                    callback("#div_college_details");

                } else if (resdata['error_code'] == 400) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                } else if (resdata['error_code'] == 401) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg'],
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setTimeout(function () {
                                location.reload();
                            }, 800);
                        }
                    })

                }

            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('.loader').preloader('remove');
            }

        });

    } else {

        Swal.fire({
            icon: 'info',
            html: 'Incorrect Aadhaar entered in ekYC and Bank'
        })

    }



}

// Get Degree Based On Institution
function GetDegree() {

    //alert('in');
    var institution_id = $("#m_institution_id").val();
    var m_institution_type_id = $("#m_institution_type_id").val();
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            institution_id: institution_id,
            m_institution_type_id: m_institution_type_id,
            type: 'GetAvailableDegreeSubject'
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#m_degree_id').empty().append();
                $('#m_degree_id')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Degree'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#m_degree_id')
                            .append($("<option></option>")
                                    .attr("value", value['m_degree_id'])
                                    .text(value['degree']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

function GetSubjectByInstitution() {

    var degree = $("#m_degree_id").val();
    var m_institution_id = $("#m_institution_id").val();
    var m_institution_type_id = $("#m_institution_type_id").val();
    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            m_institution_id: m_institution_id,
            degree: degree,
            type: 'GetSubjectByInstitution'
        },
        beforeSend: function () {
            $('.loader').preloader({
                text: 'Processing Please Wait.'
            });
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#subject').empty().append();
                $('#subject')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Subject'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#subject')
                            .append($("<option></option>")
                                    .attr("value", value['m_subject_id'])
                                    .text(value['subject'] + ' ( ' + value['year_of_study'] + ' Years)'));
                });

            }
        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

            $('.loader').preloader('remove');

        }
    });


}

//Function Year of School Completion
function getYearOfCompletion() {

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'YearOfCompletion'
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            // console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#school_completion_on').empty().append();
                $('#school_completion_on')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Year of School Completion'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#school_completion_on')
                            .append($("<option></option>")
                                    .attr("value", value['m_year_of_completion_id'])
                                    .text(value['year_of_completion']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

function SubmitCollegeDetails(verify_status) {

    var phone_number = $("#phone_number").val();
    var email_id = $("#email_id").val();
    var m_degree_id = $("#m_degree_id").val();
    var subject = $("#subject").val();
    var school_completion_on = $("#school_completion_on").val();
    var academic_year = $("#academic_year").val();
    var date_of_admission = $("#date_of_admission").val();

    if (verify_status == true) {


        if (phone_number != '') {

            if (email_id != '') {

                if (m_degree_id != '') {


                    if (subject != '') {

                        if (school_completion_on != '') {

                            if (academic_year != '') {

                                if (date_of_admission != '') {

                                    Swal.fire({

                                        icon: 'info',
                                        html: 'Do you want to confirm and continue ?',
                                        showCancelButton: true,
                                        confirmButtonText: 'Confirm',

                                    }).then((result) => {

                                        if (result.isConfirmed) {
                                            ValidateInstitutionDetails();
                                        }

                                    })


                                } else {

                                    Swal.fire({
                                        icon: 'info',
                                        html: "Please select date of admission"
                                    })

                                    $("#date_of_admission").focus();
                                }

                            } else {

                                Swal.fire({
                                    icon: 'info',
                                    html: "Please select school completion on"
                                })
                                $("#academic_year").focus();


                            }


                        } else {

                            Swal.fire({
                                icon: 'info',
                                html: "Please select school completion on"
                            })

                            $("#school_completion_on").focus();
                        }


                    } else {

                        Swal.fire({
                            icon: 'info',
                            html: "Please select subject"
                        })

                        $("#school_completion_on").focus();

                    }


                } else {


                    Swal.fire({
                        icon: 'info',
                        html: "Please select degree"
                    })

                    $("#m_degree_id").focus();

                }


            } else {

                Swal.fire({
                    icon: 'info',
                    html: "Please Enter Email ID"
                })

                $("#email_id").focus();

            }


        } else {

            Swal.fire({
                icon: 'info',
                html: "Please Enter Mobile Number",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#phone_number").focus();
                }
            })





        }


    } else {

        Swal.fire({
            icon: 'info',
            html: "Please contact helpdesk to resolve your issues <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                DeleteTempAadhar();
                setTimeout(function () {
                    location.reload();
                }, 800);
            }
        })

    }

}

function ValidateInstitutionDetails() {

    var emis_id = $("#emis_id").val();
    var formdata_institution_details = $("#form_college_details").serializeArray();

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {

            emis_id: emis_id,
            form_data: formdata_institution_details,
            type: 'ValidateInstitutionDetails'
        },
        beforeSend: function () {
            $('.loader').preloader({
                text: 'Processing Please Wait ..'
            });
        },
        success: function (response) {

            $('.loader').preloader('remove');
            resdata = $.parseJSON(response);
            if (resdata['error_status'] == true && resdata['error_code'] == 200) {

                $("#school_eligibility").val(resdata['school_eligibility']);
                $("#validation").val(resdata['validation']);
                if (resdata['validation'] == "Valid") {

                    $("#terms_bank_name").html($("#div_student_bank_verified").text());
                    $("#terms_student_name").html($("#student_name_emis").val());
                    $("#terms_condition_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                    $("#div_student_institution_button").removeClass("col-md-12 d-block").addClass("col-md-12 d-none");
                    $("#div_student_institution_details_verified").removeClass("d-none").addClass("d-block");
                    $("form#form_college_details :input").each(function () {
                        $($(this)).attr("style", "pointer-events: none;");
                    });
                    callback("#terms_condition_details");


                } else if (resdata['validation'] == "Invalid") {

                    getYearOfCompletionSchool();

                    $("#div_school_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                    $("#div_student_institution_button").removeClass("col-md-12 d-block").addClass("col-md-12 d-none");
                    $("#div_student_institution_details_verified").removeClass("d-none").addClass("d-block");

                    //$("#form_college_details :input").prop("disabled", true);
                    $('#form_college_details input').attr('readonly', 'readonly');

                    if (resdata['school_eligibility'] == "8") {

                        $("#sixth_std_form,#seventh_std_form,#eight_std_form").removeClass("d-none");
                        $("#ninth_std_form,#tenth_std_form,#eleventh_std_form,#twelveth_std_form").addClass("d-none");
                        $("#copy_details_ug").addClass("row mb-3 d-none");
                        $("#copy_details_diploma").addClass("row mb-3 d-none");
                        $("#copy_details_iti").addClass("row mb-3 d-block");


                    } else if (resdata['school_eligibility'] == "10") {

                        $("#sixth_std_form,#seventh_std_form,#eight_std_form,#ninth_std_form,#tenth_std_form").removeClass("d-none");
                        $("#eleventh_std_form,#twelveth_std_form").addClass("d-none");
                        $("#copy_details_ug").addClass("row mb-3 d-none");
                        $("#copy_details_diploma").addClass("row mb-3 d-block");
                        $("#copy_details_iti").addClass("row mb-3 d-none");

                    } else if (resdata['school_eligibility'] == "12") {

                        $("#sixth_std_form,#seventh_std_form,#eight_std_form,#ninth_std_form,#tenth_std_form,#eleventh_std_form,#twelveth_std_form").removeClass("d-none");
                        $("#copy_details_ug").addClass("row mb-3 d-block");
                        $("#copy_details_diploma").addClass("row mb-3 d-none");
                        $("#copy_details_iti").addClass("row mb-3 d-none");
                    }

                    callback("#div_school_details");

                }


            } else if (resdata['error_status'] == false && resdata['error_code'] == 400) {

                Swal.fire({
                    icon: 'info',
                    html: resdata['error_msg']
                })


            } else if (resdata['error_status'] == false && resdata['error_code'] == 410) {


                Swal.fire({

                    icon: 'info',
                    html: resdata['error_msg'],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'

                }).then((result) => {

                    if (result.isConfirmed) {
                        setTimeout(function () {
                            location.reload();
                        }, 800);
                    }

                })

            }

        }

    });

}

function SubmitSchoolDetails(verify_status) {

    var school_eligibility = $("#school_eligibility").val();
    var validation = $("#validation").val();
    var result = false;
    if (verify_status == true) {

        if (validation == 'Invalid' && school_eligibility == '12') {

            if ($("#district_12th").val() != '' && $("#school_12th").val() != '' && $("#year_of_study_12th").val() != '') {

                if ($("#district_11th").val() != '' && $("#school_11th").val() != '' && $("#year_of_study_11th").val() != '' && $("#group_11th").val() != '' && $("#medium_11th").val() != '') {

                    if ($("#district_10th").val() != '' && $("#school_10th").val() != '' && $("#year_of_study_10th").val() != '') {

                        if ($("#district_9th").val() != '' && $("#school_9th").val() != '' && $("#year_of_study_9th").val() != '') {

                            if ($("#district_8th").val() != '' && $("#school_8th").val() != '' && $("#year_of_study_8th").val() != '') {

                                if ($("#district_7th").val() != '' && $("#school_7th").val() != '' && $("#year_of_study_7th").val() != '') {

                                    if ($("#district_6th").val() != '' && $("#school_6th").val() != '' && $("#year_of_study_6th").val() != '') {

                                        result = true;

                                    } else {

                                        Swal.fire({
                                            icon: 'info',
                                            html: 'Please enter class VI details'
                                        })
                                        result = false;
                                    }

                                } else {

                                    Swal.fire({
                                        icon: 'info',
                                        html: 'Please enter class VII details'
                                    })
                                    result = false;
                                }

                            } else {

                                Swal.fire({
                                    icon: 'info',
                                    html: 'Please enter class VIII details'
                                })
                                result = false;
                            }


                        } else {

                            Swal.fire({
                                icon: 'info',
                                html: 'Please enter class IX details'
                            })
                            result = false;
                        }

                    } else {

                        Swal.fire({
                            icon: 'info',
                            html: 'Please enter class X details'
                        })
                        result = false;
                    }

                } else {

                    Swal.fire({
                        icon: 'info',
                        html: 'Please enter class XI details'
                    })
                    result = false;
                }

            } else {

                Swal.fire({
                    icon: 'info',
                    html: 'Please enter class XII details'
                })

                result = false;

            }

        } else if (validation == 'Invalid' && school_eligibility == '10') {

            if ($("#district_10th").val() != '' && $("#school_10th").val() != '' && $("#year_of_study_10th").val() != '') {

                if ($("#district_9th").val() != '' && $("#school_9th").val() != '' && $("#year_of_study_9th").val() != '') {

                    if ($("#district_8th").val() != '' && $("#school_8th").val() != '' && $("#year_of_study_8th").val() != '') {

                        if ($("#district_7th").val() != '' && $("#school_7th").val() != '' && $("#year_of_study_7th").val() != '') {

                            if ($("#district_6th").val() != '' && $("#school_6th").val() != '' && $("#year_of_study_6th").val() != '') {

                                result = true;

                            } else {

                                Swal.fire({
                                    icon: 'info',
                                    html: 'Please enter class VI details'
                                })
                                result = false;
                            }

                        } else {

                            Swal.fire({
                                icon: 'info',
                                html: 'Please enter class VII details'
                            })
                            result = false;
                        }

                    } else {

                        Swal.fire({
                            icon: 'info',
                            html: 'Please enter class VIII details'
                        })
                        result = false;
                    }


                } else {

                    Swal.fire({
                        icon: 'info',
                        html: 'Please enter class IX details'
                    })
                    result = false;
                }

            } else {

                Swal.fire({
                    icon: 'info',
                    html: 'Please enter class X details'
                })
                result = false;
            }

        } else if (validation == 'Invalid' && school_eligibility == '8') {

            if ($("#district_8th").val() != '' && $("#school_8th").val() != '' && $("#year_of_study_8th").val() != '') {

                if ($("#district_7th").val() != '' && $("#school_7th").val() != '' && $("#year_of_study_7th").val() != '') {

                    if ($("#district_6th").val() != '' && $("#school_6th").val() != '' && $("#year_of_study_6th").val() != '') {

                        result = true;

                    } else {

                        Swal.fire({
                            icon: 'info',
                            html: 'Please enter class VI details'
                        })
                        result = false;
                    }

                } else {

                    Swal.fire({
                        icon: 'info',
                        html: 'Please enter class VII details'
                    })
                    result = false;
                }

            } else {

                Swal.fire({
                    icon: 'info',
                    html: 'Please enter class VIII details'
                })
                result = false;
            }

        }

        if (result == true) {

            Swal.fire({

                icon: 'info',
                html: 'Do you want to confirm and continue ?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',

            }).then((result) => {

                if (result.isConfirmed) {
                    $("#terms_bank_name").html($("#div_student_bank_verified").html());
                    $("#terms_student_name").html($("#student_name_emis").val());
                    $("#terms_condition_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                    $("#div_student_school_details_button").removeClass("col-md-12 d-block").addClass("col-md-12 d-none");
                    $("#div_student_school_details_verified").removeClass("d-none").addClass("d-block");
                    //$("#form_student_school_details :input").prop("disabled", true);
                    //$('#form_student_school_details input').attr('readonly', 'readonly');
                    $("form#form_student_school_details :input").each(function () {
                        //var input = $(this); // This is the jquery object of the input, do what you will
                        $($(this)).attr("style", "pointer-events: none;");

                    })

                    //$("#terms_condition_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                    callback("#terms_condition_details");
                    //"#div_school_details"
                }

            })

        }

    } else {

        Swal.fire({
            icon: 'info',
            html: "Please contact helpdesk to resolve your issues <br/> Contact : 9150056809, 9150056805, 9150056801, 9150056810 <br/> Email:mraheas@gmail.com",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                DeleteTempAadhar();
                setTimeout(function () {
                    location.reload();
                }, 800);
            }
        })

    }

}

//Get Year Of Completion
function getYearOfCompletionSchool() {
    var school_completion_on = $("#school_completion_on").val();

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'YearOfSchoolCompletion',
            school_completion_on: school_completion_on
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            //console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#year_of_study_6th,#year_of_study_7th,#year_of_study_8th,#year_of_study_9th,#year_of_study_10th,#year_of_study_11th,#year_of_study_12th').empty().append();
                $('#year_of_study_6th,#year_of_study_7th,#year_of_study_8th,#year_of_study_9th,#year_of_study_10th,#year_of_study_11th,#year_of_study_12th')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Year'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#year_of_study_6th,#year_of_study_7th,#year_of_study_8th,#year_of_study_9th,#year_of_study_10th,#year_of_study_11th,#year_of_study_12th')
                            .append($("<option></option>")
                                    .attr("value", value['m_year_of_completion_id'])
                                    .text(value['year_of_completion']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

$("#submit_application").submit(function (e) {
    
    var type = $("input[type='checkbox'][name='checkbox_agree']:checked").is(":checked");
    if (type == true) {

        var mobile_number = $("#phone_number").val();
        var email_id = $("#email_id").val();
        var student_name_emis = $("#student_name_emis").val();
        if (mobile_number != '' && email_id != '' && student_name_emis != '') {

            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: {
                    mobile_number: mobile_number,
                    email_id: email_id,
                    student_name: student_name_emis,
                    type: 'SubmitStudentRegistration'
                },
                beforeSend: function () {
                    /*  $('#loader').preloader({
                     text: 'Sending OTP Please Wait.'
                     });
                     */

                    $("#application_button_validate").removeClass("btn btn-primary").addClass("btn btn-primary d-none");
                    $("#application_button_loading").removeClass("btn btn-primary d-none").addClass("btn btn-primary d-block");

                },
                success: function (response) {

                    resdata = $.parseJSON(response);
                    if (resdata['error_code'] == 200) {
                        
                        // Added By Arul 
                        clearInterval(sms_interval);
                        aadhaar_otp_int = "10:00";
                        newtimersms();
                        
                        const mask = (cc, num = 4, mask = '*') => `${cc}`.slice(-num).padStart(`${cc}`.length, mask);
                        // Call function without giving value of n
                        $("#mobile_number_mask").html(mask(mobile_number));
                        $('#tmp_otp_msg').html(resdata['error_msg']);
                        $('#otp_modal').modal('show');
                        $('#submit_otp')[0].reset();

                    } else if (resdata['error_code'] == 405) {

                        Swal.fire({
                            icon: 'info',
                            html: resdata['error_msg']
                        })

                    } else if (resdata['error_code'] == 400) {

                        Swal.fire({
                            icon: 'info',
                            html: resdata['error_msg']
                        })

                    }

                }, complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    //$('#loader').preloader('remove');
                    $("#application_button_validate").removeClass("btn btn-primary d-none").addClass("btn btn-primary");
                    $("#application_button_loading").removeClass("btn btn-primary d-block").addClass("btn btn-primary d-none");
                }

            });

        } else {

            Swal.fire({
                icon: 'info',
                html: 'Mobile number or Email ID empty'
            })


        }
        e.preventDefault();

    } else {

        Swal.fire({
            icon: 'info',
            html: 'Please read and agree terms and conditions.'
        })

    }
    e.preventDefault();

});

// Student Registration Submit OTP Form     
$("#submit_otp").submit(function (e) {
    
    var form_student_emis_details = $("#form_student_emis_details").serializeArray();
    var form_student_details = $("#form_student_details").serializeArray();
    var form_aadhaar_validation = $("#form_aadhaar_validation").serializeArray();
    console.log(form_aadhaar_validation);
    var form_aadhaar_bank_details = $("#form_aadhaar_bank_details").serializeArray();
    var form_college_details = $("#form_college_details").serializeArray();
    var form_student_school_details = $("#form_student_school_details").serializeArray();
    var submit_application = $("#submit_application").serializeArray();

    var phone_no = $("#phone_number").val();
    var student_name = $("#student_name_emis").val();
    var user_email = $("#email_id").val();
    var user_id = $("#user_id").val(); // Added By Arul 24-11-2022
    var otp_number = $("#first").val() + $("#second").val() + $("#third").val() + $("#fourth").val() + $("#fifth").val() + $("#sixth").val()

    if (phone_no != '' && user_email != '' && otp_number != '' && form_submit_type != '' && otp_number.length == 6) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                form_student_emis_details: form_student_emis_details,
                form_student_details: form_student_details,
                form_aadhaar_validation: form_aadhaar_validation,
                form_aadhaar_bank_details: form_aadhaar_bank_details,
                form_college_details: form_college_details,
                form_student_school_details: form_student_school_details,
                submit_application: submit_application,
                student_name: student_name,
                phone_no: phone_no,
                user_email: user_email,
                otp_number: otp_number,
                type: 'SubmitOTP',
                user_id:user_id
            },
            beforeSend: function () {

                $("#otp_button_validate").addClass("d-none");
                $("#otp_button_loading").removeClass("d-none").addClass("d-block");

            },
            success: function (response) {

                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                    $('#otp_modal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        html: resdata['error_msg'],
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(true);
                        }
                    })

                } else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

                    $("#otp_button_validate").removeClass("d-none");
                    $("#otp_button_loading").removeClass("d-block").addClass("d-none");

                    $('#submit_otp')[0].reset();
                    $("#otp_number").focus();
                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })
                    $('#otp_modal').modal('show');

                } else if (resdata['error_code'] == 401 && resdata['error_msg'] != 0) {

                    $('#submit_otp')[0].reset();
                    Swal.fire({
                        title: 'Message',
                        html: resdata['error_msg']
                    })
                    $('#otp_modal').modal('hide');


                }

            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.

                $("#otp_button_loading").removeClass("d-block").addClass("d-none");

            }
        });
    }
    e.preventDefault();
});

$('#regenerateOTP').on('click', function () {

    //timer(180);
    var mobile_number = $("#phone_number").val();
    if (mobile_number != '') {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                form_data: formdata,
                type: 'ResendOTP'
            },
            beforeSend: function () {
                $('.loader').preloader({
                    text: 'Sending OTP Please Wait..'
                });
            },
            success: function (response) {

                $('.loader').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200) {

                    $('#otp_modal').modal('show');
                    timer(180);

                } else if (resdata['error_code'] >= 400) {

                    // $('#form_student_registration')[0].reset();

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                }

            }
        });
    }


});

//Get Academic Year
function getAcademicYear() {

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {

            type: 'AcademicYear',
            school_completion_on: $("#school_completion_on").val()

        },
        beforeSend: function () {
            $('.loader-college_details').preloader({
                text: 'Processing Please Wait..'
            });
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#academic_year').empty().append();
                $('#academic_year')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Academic Year'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#academic_year')
                            .append($("<option></option>")
                                    .attr("value", value['m_year_of_completion_id'])
                                    .text(value['year_of_completion']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }, complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
            $('.loader-college_details').preloader('remove');
        }

    });

}

function GetReason(reason_div, reason_id, reason_flag) {

    Swal.fire({
        icon: 'info',
        html: 'Select the reason listed below'
    })

    $("#" + reason_div).removeClass("d-none").addClass("d-block");
    $("#" + reason_id).attr("required", "true");
    //console.log("#"+reason_div);
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'GetReason',
            reason_flag: reason_flag
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            //console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $("#" + reason_id).empty().append();
                $("#" + reason_id)
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Reason'));
                $.each(resdata['error_msg'], function (index, value) {
                    //console.log(value['m_reason_id']);
                    $("#" + reason_id)
                            .append($("<option></option>")
                                    .attr("value", value['m_reason_id'])
                                    .text(value['reason']));
                });

            }

        }

    });

}

////////////////////////////////////////////////////////////////////

// Function Date Of Admission 
function ChangeDateofAdmission() {

    var academic_year = $("#academic_year").val();
    var min = new Date(parseInt(academic_year), 05, 01);
    var max = new Date((parseInt(academic_year) + 1), 04, 31);
    $("#date_of_admission").flatpickr({

        dateFormat: "d-M-Y",
        maxDate: max,
        minDate: min

    });

}

// Function Get Year Of Study
function YearofStudy() {

    var subject = $("#subject").val();
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            subject: subject,
            type: 'Yearofstudy'
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#year_of_study').empty().append();
                $('#year_of_study').append($("<option></option>").attr("value", '').text('Select Year Of Study'));
                for (let i = 1; i <= resdata['error_msg']; i++) {
                    if (i == 1) {
                        val = 'I Year';
                    } else if (i == 2) {
                        val = 'II Year';
                    } else if (i == 3) {
                        val = 'III Year';
                    } else if (i == 4) {
                        val = 'IV Year';
                    } else if (i == 5) {
                        val = 'V Year';
                    } else if (i == 6) {
                        val = 'VI Year';
                    }
                    $('#year_of_study')
                            .append($("<option></option>")
                                    .attr("value", i)
                                    .text(val));
                }

            }
        }

    });

}

// School Completion Year
function changeDate(id, value) {

    // console.log(id);
    // console.log(value);
    var year_of_completion = $("#school_completion_on").val();
    var res = id.split("_");
    var split_id = res[3].replace("th", '');
    var new_school_id = parseInt(split_id) - 1;
    var school_id = "#year_of_study_" + new_school_id + "th";
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {

            type: 'SchoolYear',
            last_school_year: value

        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $(school_id).empty().append();
                $(school_id)
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select year of study'));
                $.each(resdata['error_msg'], function (index, value) {
                    $(school_id)
                            .append($("<option></option>")
                                    .attr("value", value['m_year_of_completion_id'])
                                    .text(value['year_of_completion']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

// Function School Year of Study
function MaskCharacter(str, mask, n = 1) {
    return ('' + str).slice(0, -n)
            .replace(/./g, mask) +
            ('' + str).slice(-n);

}

//get institution type
function getInstitutionType() {

    //getting institutiontype
    // var institution_ids = '<?php echo  isset($_SESSION['user_details']['m_institution_type_id']) ?  $_SESSION['user_details']['m_institution_type_id'][0] : 'all';	?>';
    var institution_ids = '';
    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'GetInsitutionType',
            institution_id: institution_ids

        },
        beforeSend: function () {
            $('.loader').preloader({
                text: 'Loading Please Wait ....'
            });
        },
        success: function (response) {

            $('.loader').preloader('remove');
            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#m_institution_type_id').empty().append();
                $('#m_institution_type_id').append($("<option></option>").attr("value", '').text('Select Institute Type'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#m_institution_type_id').append($("<option></option>").attr("value", value['m_institution_type_id']).text(value['institution_type']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });


}

$('#religion').change(function () {
    GetCommunity($(this).val(), 0);
});

//Get Degree
function GetReligion() {

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'GetReligion'
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#religion').empty().append();
                $('#religion')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select Religion'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#religion')
                            .append($("<option></option>")
                                    .attr("value", value['m_religion_id'])
                                    .text(value['religion']));
                });

            } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                Swal.fire(resdata['error_msg'])

            }

        }

    });

}

function copy_district(id) {
    var new_id = id - 1;
    var type = $("input[type='checkbox'][name='check_district_" + id + "']:checked").is(":checked");
    if (type == true) {

        var district_value = $("#district_" + id + "th").val();
        var school_value = $("#school_" + id + "th").val();
        for (i = id; i >= 6; i--) {
            var district_id = "#district_" + i + "th";
            var school_id = "#school_" + i + "th";
            $(district_id).val($("#district_" + id + "th").val());
            copy_school(school_id, district_value, school_value);
        }

        var year = $("#year_of_study_" + id + "th").val();
        for (i = id, y = 1; i >= 6, y <= 6; i--, y++) {
            var year_id = "#year_of_study_" + (id - y) + "th";
            $(year_id).val(year - y);
        }

        //Bind School
        //copy_school(district_id,id,value);

    } else {

        for (i = id - 1; i >= 6; i--) {

            var district_id = "#district_" + i + "th";
            $(district_id).val('');

        }

        for (i = id - 1; i >= 6; i--) {
            var district_id = "#school_" + i + "th";
            $(district_id).val('');

        }

        for (i = id - 1; i >= 6; i--) {
            var district_id = "#year_of_study_" + i + "th";
            $(district_id).val('');

        }
    }


}

function copy_school(school_id, district_value, school_value) {

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            district: district_value,
            type: 'GetDistrictSchoolFromSchoolMaster'
        }, beforeSend: function () {
            $('.loader').preloader({
                text: 'Loading Please Wait ....'
            });
        },
        success: function (response) {
            $('.loader').preloader('remove');
            resdata = $.parseJSON(response);
            //console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $(school_id).empty().append();
                $(school_id)
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select School'));
                $.each(resdata['error_msg'], function (index, value) {

                    if (school_value > 0 && value['udise_code'] == school_value) {

                        $(school_id)
                                .append($("<option></option>")
                                        .attr("value", value['udise_code'])
                                        .attr("selected", true)
                                        .text(value['school_name']));
                    } else {

                        $(school_id)
                                .append($("<option></option>")
                                        .attr("value", value['udise_code'])
                                        .text(value['school_name']));
                    }

                });

            }

        }
    });
}

function copy_year(id) {

    var type = $("input[type='checkbox'][name='check_year_" + id + "']:checked").is(":checked");
    if (type == true) {

        var year = $("#year_of_study_" + id + "th").val();
        // console.log(year);
        for (i = id, y = 1; i >= 6; i--, y--) {
            var district_id = "#year_of_study_" + i + "th";
            // console.log(year-y);
            $(district_id).val(year);
        }

    } else {

        for (i = id - 1; i >= 6; i--) {
            //console.log(i);
            var district_id = "#year_of_study_" + i + "th";
            //console.log(district_id);
            $(district_id).val('');

        }

    }

}

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



                    // getEmisDetails();

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

// Student Registration Form and send OTP Message to SMS
$("#form_student_school_details").submit(function (e) {

    var formdata = $("#form_student_school_details").serializeArray();
    if (formdata != '') {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                m_degree_id: $("#m_degree_id").val(),
                form_data: formdata,
                type: 'SubmitStudentSchoolDetails'
            },
            beforeSend: function () {
                $('.loader_school_details').preloader({
                    text: 'Processing Please Wait..'
                });
            },
            success: function (response) {

                $('.loader_school_details').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200) {
                    Swal.fire({
                        icon: 'success',
                        html: resdata['error_msg']
                    })
                    var aadhaar = $("#aadhaar_no").val();
                    $("#ekyc_aadhar_label").html("Please Enter the Aadhaar Number Given In EMIS Details(" + aadhaar + ")");
                    $("#ekyc_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");
                    $("#form_student_school_details :input").prop("disabled", true);
                    //$("#ekyc_details").attr("tabindex",-1).focus();
                    //$.scrollTo($('#ekyc_details'), 500);
                    $("#div_student_school_details_with_button").addClass("row d-none");
                    $("#div_student_school_details_verified").removeClass("d-none").addClass("d-block");


                } else if (resdata['error_code'] >= 400) {

                    Swal.fire({
                        icon: 'info',
                        html: resdata['error_msg']
                    })

                }

            }

        });
    }
    e.preventDefault();

});

//submit Bank Details      

function exefunction() {

    $('#form_student_details')[0].reset();
    $('#form_school_details')[0].reset();

    $("#form_student_details :input").each(function (index, elm) {
        //console.log(index);
    });
    var rpt_type = $("input[type='radio'][name='emis_radio']:checked").val();
    if (rpt_type == 1) {

        $("#emis_valid_input").removeClass("col-md-4 d-none").addClass("col-md-4 d-block");
        $("#emis_valid_button").removeClass("col-md-2 align-self-end d-none").addClass("col-md-2 align-self-end d-block");
        $("#student_details").removeClass("card mb-3 d-block").addClass("card mb-3 d-none");

    } else if (rpt_type == 2) {

        $("#emis_valid_input").removeClass("col-md-4 d-block").addClass("col-md-4 d-none");
        $("#emis_valid_button").removeClass("col-md-2 align-self-end d-block").addClass("col-md-2 align-self-end d-none");
        $("#student_details").removeClass("card mb-3 d-none").addClass("card mb-3 d-block");

    }

}

// Function Get School Master District
function getDistrictFromSchoolMaster() {

    $.ajax({

        method: "POST",
        url: "ajax.php",
        data: {
            type: 'GetDistrictFromSchoolMaster'
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            //  console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $('#district_6th,#district_7th,#district_8th,#district_9th,#district_10th,#district_11th,#district_12th').empty().append();
                $('#district_6th,#district_7th,#district_8th,#district_9th,#district_10th,#district_11th,#district_12th')
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select District'));
                $.each(resdata['error_msg'], function (index, value) {
                    $('#district_6th,#district_7th,#district_8th,#district_9th,#district_10th,#district_11th,#district_12th')
                            .append($("<option></option>")
                                    .attr("value", value['district'])
                                    .text(value['district']));
                });

            }

        }

    });


}

function getDistrictSchoolMaster(id, value) {

    var split_id = id.split('_');
    var school_id = "#school_" + split_id[1];
    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            district: value,
            type: 'GetDistrictSchoolFromSchoolMaster'
        },
        beforeSend: function () {
            $('.loader').preloader({
                text: 'Processing Please Wait..'
            });
        },
        success: function (response) {

            resdata = $.parseJSON(response);
            //console.log(resdata);
            if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

                $(school_id).empty().append();
                $(school_id)
                        .append($("<option></option>")
                                .attr("value", '')
                                .text('Select School'));
                $.each(resdata['error_msg'], function (index, value) {
                    $(school_id)
                            .append($("<option></option>")
                                    .attr("value", value['udise_code'])
                                    .text(value['school_name']));
                });

            }

        }, complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
            $('.loader').preloader('remove');
        }
    });


}

// Added BY Arul 25-11-2022
function DeleteTempAadhar() {

    var aadhaar_no = $("#aadhaar_no_2").val();
    if (aadhaar_no != '') {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                aadhaar_no: aadhaar_no,
                type: 'DeleteTempAadhar'
            },
            success: function (response) {
                resdata = $.parseJSON(response);

            }
        });
    }

}