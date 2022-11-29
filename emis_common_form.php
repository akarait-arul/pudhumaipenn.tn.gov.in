 
 

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
  <form class="mb-3  needs-validation" novalidate id="emis_search" autocomplete="off">
    <div class="row mb-3">
      <div class="col-md-3 ">
        <label class="form-label" for="district_list">District *</label>
        <select class="form-select" id="district_list" required onchange="getSchoolBlock(this)">



        </select>
        <div class="invalid-feedback text-left"> Please select the District </div>
      </div>

      <div class="col-md-3 ">
        <label class="form-label" for="district-block">Block </label>
        <select class="form-select" id="district-block" onchange="getSchoolNames(this)">
          <option disabled selected value=""> Choose Block </option>

        </select>
        <div class="invalid-feedback text-left"> Please select the Block </div>
      </div>

      <div class="col-md-6 ">
        <label class="form-label" for="school_id"> Last studied School *</label>
        <select class="form-select" id="school_id" name="school_id" required="">
          <option disabled selected value=""> Choose School </option>

        </select>
        <div class="invalid-feedback text-left"> Please select the school </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 ">
        <label class="form-label" for="aadharcard">Aadhar Number </label>
        <input class="form-control" maxlength="12" minlength="12" id="aadharcard" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        <div class="invalid-feedback text-left"> Please Enter valid Aadhar Number </div>
      </div>


      <div class="col-md-3 ">
        <label class="form-label" for="student_name">Student Name </label>
        <input class="form-control" id="student_name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
        <div class="invalid-feedback text-left"> Please Enter Student Name </div>
      </div>

      <div class="col-md-3">
        <label class="form-label" for="student_dob"> Date of Birth *</label>
        <div class="input-group dob_calendar">

          <input class="form-control  " id="student_dob" name="student_dob" type="text" required>
          <span id="calendaricon" class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
          <div class="invalid-feedback text-left" id="dob_errmsg">
            Please select Date of Birth
          </div>
        </div>

      </div>





      <div class="col-md-3 align-self-center p-3">
        <button class="btn btn-primary   mt-3" type="submit" name="submit">Search</button>
        <a class="btn btn-primary mt-3" onclick="apiFormCLear()">Clear</a>

      </div>
    </div>
  </form>
</div>




<div id="emis_tableview" class="table-responsive scrollbar  d-none">
  <table class="table table-hover table-striped overflow-hidden" id="student_reg_table">
    <thead>
      <tr style="background-color: #2c7be5;color: white;">

        <th scope="col"> S.No. </th>
        <th scope="col"> EMIS ID </th>
        <th scope="col"> Student Name </th>
        <th scope="col"> Class </th>
        <th scope="col"> Section </th>
        <th scope="col"> Date of Birth </th>
        <th scope="col"> Father's Name </th>
        <th scope="col"> Mother's Name </th>
        <th scope="col"> Guardian Name </th>


      </tr>
    </thead>
    <tbody id="emis_search_records">





    </tbody>
  </table>
</div>
 


<script>
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

        } else {

          event.preventDefault();
          event.stopPropagation();
          getEmisDetails();
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()




  $(document).on('click', '.emisidcopy', function() {

    var emisid = $(this).text();
     

  });

  $(document).ready(function() {


    GetSchoolDistrictList();

    $("#dob_errmsg").addClass("d-none");



  });


  //modal close emtpy fields
  $('#know_your_emis').on('hidden.bs.modal', function() {

    apiFormCLear();

  });

  //modal close emtpy fields

  //clear form and details
  function apiFormCLear() {

    $("#emis_search").removeClass("was-validated");
    $("#emis_search").addClass('needs-validation');
    $("#emis_search_records").html(' ');
    document.getElementById("emis_search").reset();






  }
  //clear form and details



  //dob datepicker
  $("#student_dob").flatpickr({


    dateFormat: "d-M-Y",
    maxDate: "today",
    static: true

  });
  //dob datepicker


  //know your emis

  //geeting details in api
  function getEmisDetails() {

    if ($("#student_dob").val() != '') {

      $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {

          type: 'getSearchEmisDetails',
          aadharcard: $("#aadharcard").val(),
          student_name: $("#student_name").val(),
          student_dob: $("#student_dob").val(),
          school_id: $("#school_id").val(),
          user_type: "institute"
        },
        beforeSend: function() {

          $('.loader_emis').preloader({
            text: 'Loading Please Wait ....'
          });

        },
        success: function(response) {

          $('.loader_emis').preloader('remove');


          resdata = $.parseJSON(response);
          if (resdata.error_code == '200') {
            $("#emis_tableview").removeClass('d-none');
            $("#emis_search_records").html(resdata.records);


          }
        }
      });
    } else {

      $("#dob_errmsg").removeClass("d-none");

    }


  }
  //geeting details in api


  //getting district
  function GetSchoolDistrictList() {

    $.ajax({

      method: "POST",
      url: "ajax.php",

      crossDomain: true,
      data: {
        type: 'GetSchoolDistrictList'
      },
      beforeSend: function() {

        $('.loader_emis').preloader({
          text: 'Loading Please Wait ....'
        });

      },
      success: function(response) {

        $('.loader_emis').preloader('remove');

        resdata = $.parseJSON(response);
        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

          $('#district_list').empty().append();
          $('#district_list').append($("<option></option>").attr("value", '').text('Select District'));
          $.each(resdata['error_msg'], function(index, value) {
            $('#district_list').append($("<option></option>").attr("value", value['district']).text(value['district']));
          });

        }



      }
    });



  }
  //getting school district




  //getting block
  function getSchoolBlock(district_name) {

    var dist_name = district_name.value;


    $.ajax({

      method: "POST",
      url: "ajax.php",

      crossDomain: true,
      data: {
        type: 'GetSchoolBlock',
        district_name: dist_name

      },
      beforeSend: function() {

        $('.loader_emis').preloader({
          text: 'Loading Please Wait ....'
        });

      },
      success: function(response) {

        $('.loader_emis').preloader('remove');

        resdata = $.parseJSON(response);
        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

          $('#district-block').empty().append();
          $('#district-block').append($("<option></option>").attr("value", '').text('Select Block'));
          $.each(resdata['error_msg'], function(index, value) {
            $('#district-block').append($("<option></option>").attr("value", value['block']).text(value['block']));
          });

        }

        //get school names
        getSchoolNames();

      }
    });


  }
  //getting block




  //getting Sschool names
  function getSchoolNames(blockname) {

	//	console.log(blockname.value);
    if (typeof blockname !== 'undefined' && blockname.value !='') {
      var block_names = blockname.value ? blockname.value : '';
      var typeval = 2;

    } else {

      var block_names = $("#district_list").val() ? $("#district_list").val() : '';
      var typeval = 1;


    }
	


    $.ajax({

      method: "POST",
      url: "ajax.php",

      crossDomain: true,
      data: {
        type: 'getSchoolNames',
        block_name: block_names,
        recordtype: typeval

      },
      beforeSend: function() {

        $('.loader_emis').preloader({
          text: 'Loading Please Wait ....'
        });

      },
      success: function(response) {

        $('.loader_emis').preloader('remove');

        resdata = $.parseJSON(response);
        if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

          $('#school_id').empty().append();
          $('#school_id').append($("<option></option>").attr("value", '').text('Select School Name'));
          $.each(resdata['error_msg'], function(index, value) {
            $('#school_id').append($("<option></option>").attr("value", value['udise_code']).text(value['school_name']));
          });

          /* $("#school_id").select2({ 
            placeholder: "Select the subject "
          }); */

        }
      }
    });
  }
  //getting Sschool names





  //know your emis
</script>