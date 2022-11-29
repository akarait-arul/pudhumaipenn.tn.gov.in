<?php
// Start the session
session_start();
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
    <div class="container-fluid" data-layout="container"> <?php include('sideNav.php') ?> <div class="content"> <?php include('topnav.php') ?>
    
        <div id="emis_tableview" class="table-responsive scrollbar  ">
          <table class="table table-hover table-striped overflow-hidden" id="student_reg_table">
            <thead>
              <tr style="background-color: #2c7be5;color: white;">
                <th scope="col"> User Name</th>
                <th scope="col"> Password Status </th>
                <th scope="col"> Date </th>
                <th scope="col"> Mobile </th>
                <th scope="col"> Contact Person </th>
              </tr>
            </thead>
            <tbody id="emis_search_records"></tbody>
          </table>
        </div>
        <script></script>
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