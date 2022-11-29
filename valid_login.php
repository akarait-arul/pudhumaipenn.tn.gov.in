<?php

session_start();
ob_start();

//print_r($_SESSION);

include 'Controllers/Session.php';

$sessioncontroller = new Session;

$sessionsame = $sessioncontroller->sameSessionCheck();
//var_dump($sessionsame);

if ((!isset($_SESSION['user_details']['user_type']) and empty($_SESSION['user_details']['user_type'])  and !isset($_SESSION['user_details']['user_id'])  and empty($_SESSION['user_details']['user_id']))  or  $sessionsame['error_code'] == '400') {


  session_unset();
  session_destroy();
  header('Location: index.php');

  
} else {


  $checkactive = $sessioncontroller->sessionActiveCheck();

  //var_dump($checkactive);

  if ($checkactive['error_code'] == '200') {


    $update_logintime =   $sessioncontroller->updateLastLoginTime();

    //var_dump($update_logintime);



  } else {

    session_unset();
    session_destroy();
    //print_r($_SESSION);

    header('Location: index.php');
  }
}
