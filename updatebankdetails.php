<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    #calendaricon {

        position: absolute;
        left: 188px;
        padding-bottom: 12px;
    }
</style>
<div class="card-body bg-light  px-5  py-3">
    <div class="col-8 align-self-center loader_emis"></div>
    <form class="mb-3  needs-validation" novalidate id="bank_verify" autocomplete="off">
        <div class="row mb-3">

            <div class="col-md-4 ">
                <input type="hidden" id="student_reg_id" name="student_reg_id"/>
                <label class="form-label" for="district_list">District *</label>
                <select class="form-select" id="district_code" required>

                </select>
                <div class="invalid-feedback text-left"> Please select the District </div>
            </div>

            <div class="col-md-4 ">
                <label class="form-label" for="bank">Bank *</label>
                <select class="form-select" id="bank" onchange="GetBranch(this.value)">
                    <option disabled selected value=""> Choose Bank </option>
                                        
                </select>
                <div class="invalid-feedback text-left"> Please select the Bank </div>
            </div>

            <div class="col-md-4 ">
                <label class="form-label" for="branch"> Branch *</label>
                <select class="form-select" id="branch" name="branch" required="" onchange="GetBranchDetails(this.value)">
                    <option disabled selected value=""> Choose Branch </option>

                </select>
                <div class="invalid-feedback text-left"> Please select the Branch </div>
            </div>           

        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label for="branch_details" class="form-label">Branch Details</label>
                <textarea class="form-control" id="branch_details" rows="3" readonly="readonly"></textarea>
            </div>
            <div class="col-md-3 align-self-center p-3">
                <button class="btn btn-primary   mt-3" type="button" name="submit" onclick="VerifyBankDetails()">Submit</button>
                <a class="btn btn-warning mt-3" onclick="apiFormCLear()">Clear</a>
            </div>
        </div>
        
    </form>
</div>

<script>
    $(document).ready(function () {
       $("#branch").val(); 
        apiFormCLear();
        GetBankDistrictList();
        GetBank();        
        $("#dob_errmsg").addClass("d-none");
    });

    function GetBankDistrictList() {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            crossDomain: true,
            data: {
                type: 'getBankDistrict'
            },
            beforeSend: function () {
                $('.loader_emis').preloader({
                    text: 'Loading Please Wait ....'
                });
            },
            success: function (response) {
                $('.loader_emis').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                    $('#district_code').empty().append();
                    $('#district_code').append($("<option></option>").attr("value", '').text('Select District'));
                    $.each(resdata['error_msg'], function (index, value) {
                        $('#district_code').append($("<option></option>").attr("value", value['district_code']).text(value['district_name']));
                    });
                }
            }
        });
    }

    function GetBank() {
        
        $.ajax({
            method: "POST",
            url: "ajax.php",
            crossDomain: true,
            data: {
                type: 'getBank'
            },
            beforeSend: function () {
                $('.loader_emis').preloader({
                    text: 'Loading Please Wait...'
                });
            },
            success: function (response) {
                $('.loader_emis').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                    $('#bank').empty().append();
                    $('#bank').append($("<option></option>").attr("value", '').text('Select Bank'));
                    $.each(resdata['error_msg'], function (index, value) {
                        $('#bank').append($("<option></option>").attr("value", value['m_bank_id']).text(value['bank_name']));
                    });
                }
            }
        });
    }

    function GetBranch(bank_id) {
        
        $('#branch').val('');
        $('#branch_details').html('');
        $.ajax({
            method: "POST",
            url: "ajax.php",
            crossDomain: true,
            data: {
                type: 'getBranch',
                district: $("#district_code").val(),
                bank: bank_id
            },
            beforeSend: function () {
                $('.loader_emis').preloader({
                    text: 'Loading Please Wait ....'
                });
            },
            success: function (response) {
                $('.loader_emis').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                    $('#branch').empty().append();
                    $('#branch').append($("<option></option>").attr("value", '').text('Select Branch'));
                    $.each(resdata['error_msg'], function (index, value) {
                        $('#branch').append($("<option></option>").attr("value", value['m_bank_branch_id']).text(value['branch_name']));
                    });
                }
            }
        });

    }   
     
    function GetBranchDetails(branch){
     
        $.ajax({
            method: "POST",
            url: "ajax.php",
            crossDomain: true,
            data: {
                type: 'getBranchDetails',
                branch: branch
            },
            beforeSend: function () {
                $('.loader_emis').preloader({
                    text: 'Loading Please Wait ....'
                });
            },
            success: function (response) {
                $('.loader_emis').preloader('remove');
                resdata = $.parseJSON(response);
                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                    console.log(resdata['error_msg'][0]['address']);
                    ifsccode = 'IFSC CODE : ' + resdata['error_msg'][0]['ifsc_code'];
                    address = 'Address : ' + resdata['error_msg'][0]['address'];
                    $("#branch_details").html(ifsccode + '\r\n' + address);
                }
            }
        });     
    
    }
    
    function VerifyBankDetails() {
        var branch = $("#branch").val();        
        if(branch !='' && branch != null){
            
            $.ajax({
                method: "POST",
                url: "ajax.php",
                crossDomain: true,
                data: {
                    type: 'VerifyBankDetails',
                    branch: $("#branch").val(),
                    student_reg_id: $("#student_reg_id").val()

                },
                beforeSend: function () {
                    $('.loader_emis').preloader({
                        text: 'Loading Please Wait ....'
                    });
                },
                success: function (response) {
                    $('.loader_emis').preloader('remove');
                    resdata = $.parseJSON(response);
                    if (resdata['error_code'] == 200 && resdata['error_status'] == true) {                        
                                               
                        Swal.fire({
                            icon: 'success',
                            html: "Proposed Bank Details Submitted Sucessfully",
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok',
                            showCancelButton: false,
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#bank_verify_request').modal('show');
                                setTimeout(function () {
                                    location.reload();
                                }, 800);
                            }
                        })
    
                    }else{
                        
                        Swal.fire({
                            icon: 'info',
                            html: 'Problem on submit Bank Verification Request'
                        })
                        
                    }
                }
            });
            
        } else { 
        
            Swal.fire({
                icon: 'info',
                html: 'Please Select Bank Details'
            })
        }
        

    }

    //clear form and details
    function apiFormCLear() {

        $("#bank_verify").removeClass("was-validated");
        $("#bank_verify").addClass('needs-validation');        
        $("#bank_verify")[0].reset();
        $("#branch_details").html('');
        $("#branch").val(); 
    }
    //clear form and details

</script>