<?php
// Start the session


include "valid_login.php";
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <?php include('header_script.php') ?>
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
      <div class="container-fluid" data-layout="container"> <?php include('sideNav.php') ?> <div class="content"> <?php include('topnav.php') ?> <div class="card mb-3 ">
            <div class="card-header border-bottom">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0">Social Welfare Department</h5>
                </div>
              </div>
            </div>
            <div class="card-body pt-0  bg-light">
              <div class="card-body bg-light  px-5  py-3">
                <div class="col-8 align-self-center loader_emis"></div>
                <form class="mb-3  needs-validation" novalidate id="emis_search" autocomplete="off">
                  <div class="row mb-3">
                    <!--District-->
                    <div class="mb-3 col-sm-4">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="card-confirm-password">District *</label>
                      </div>
                      <select class="form-select" id="m_district_code" name="m_district_code" required></select>
                      <div class="invalid-feedback text-justify"> Please Select District</div>
                    </div>
                    <!--District-->
                    <!--Institution Type-->
                    <div class="mb-3 col-sm-6">
                      <div class="d-flex  ">
                        <label class="form-label" for="card-name"> Institution Type * </label>
                      </div>
                      <!--  <select class="form-select" id="institution_type" name="institution_type[]"   multiple="multiple"   required> -->
                      <select class="form-select" id="m_institution_type_id" name="m_institution_type_id" required></select>
                      <div class="invalid-feedback text-justify"> Please Select Institution</div>
                    </div>
                    <!--Institution Type-->
                    <!--Institution-->
                    <div class="mb-3 col-sm-8">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="card-name">Institution *</label>
                      </div>
                      <select class="form-select" id="m_institution_id" name="m_institution_id" required></select>
                      <div class="invalid-feedback text-justify"> Please Select Institution</div>
                    </div>
                    <!--Institution-->
                  </div>
                </form>
              </div>
              <script>
                $(document).ready(function() {
                  getDistrict();
                  getInstitutionType()
                  //$('#m_institution_type_id').select2();
                });
                // Institution Registration Get District
                function getDistrict() {
                  $.ajax({
                        method: "POST",
                        url: "ajax.php",
                        data: {
                          type: 'GetDistrict'
                        },
                        beforeSend: function() {
                          $('.loader').preloader({
                            text: 'Loading Please Wait ....'
                          });
                        },
                        complete: function() {
                          $('.loader').preloader('remove');
                        },
                        success: function(response) {
                          resdata = $.parseJSON(response);
                          if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                            $('#m_district_code').empty().append();
                            $('#m_district_code').append($(" < option > < /option>").attr("value", '').text('Select District')); $.each(resdata['error_msg'], function(index, value) {
                                  $('#m_district_code').append($(" < option > < /option>").attr("value", value['district_code']).text(value['district_name']));
                                  });
                              }
                              else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                                Swal.fire(resdata['error_msg'])
                              }
                            }
                          });
                      }
                      //get institution type
                      function getInstitutionType() {
                        $.ajax({
                              method: "POST",
                              url: "ajax.php",
                              data: {
                                type: 'GetInsitutionType',
                                institution_id: "all"
                              },
                              beforeSend: function() {
                                $('.loader').preloader({
                                  text: 'Loading Please Wait ....'
                                });
                              },
                              success: function(response) {
                                  $('.loader').preloader('remove');
                                  resdata = $.parseJSON(response);
                                  if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                                    $('#m_institution_type_id').empty().append();
                                    $('#m_institution_type_id').append($(" < option > < /option>").attr("value", '').text('Select Institute Type'));
                                      $.each(resdata['error_msg'], function(index, value) {
                                          $('#m_institution_type_id').append($(" < option > < /option>").attr("value", value['m_institution_type_id']).text(value['institution_type']));
                                          });
                                        } else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                                          Swal.fire(resdata['error_msg'])
                                        }
                                      }
                                    });
                                  }
                                  //get institution type
                                  //OnChange Get Institution Based On District Code
                                  $("#m_district_code").change(function(e) {
                                        var district = $("#m_district_code").val();
                                        if (district && district != 0) {
                                          $.ajax({
                                              method: "POST",
                                              url: "ajax.php",
                                              data: {
                                                district: district,
                                                type: 'GetInstitutions'
                                              },
                                              success: function(response) {
                                                resdata = $.parseJSON(response);
                                                if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {
                                                  $('#m_institution_id').empty().append();
                                                  $('#m_institution_id').append($(" < option > < /option>").attr("value", '').text('Select Institution')); $.each(resdata['error_msg'], function(index, value) {
                                                        $('#m_institution_id').append($(" < option > < /option>").attr("value", value['m_institution_id']).text(value['institution_name']));
                                                        });
                                                    }
                                                    else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {
                                                      Swal.fire({
                                                        icon: 'error',
                                                        title: 'Alert',
                                                        text: resdata['error_msg']
                                                      })
                                                    }
                                                  }
                                                });
                                            }
                                          });
              </script>
            </div>
          </div>
          <footer class="footer">
            <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Akara Research & Technologies Pvt Ltd <span class="d-none d-sm-inline-block">| </span>
                  <br class="d-sm-none" /> 2022 &copy;
                </p>
              </div>
            </div>
          </footer>
          <!-- ===============================================-->
          <!--    End of Main Content-->
          <!-- ===============================================-->
          
          <?php include('footer_script.php') ?>
    </main>
    <script></script>
  </body>
</html>