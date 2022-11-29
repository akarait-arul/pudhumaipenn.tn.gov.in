<?php
include "valid_login.php";

$sessionsame = $sessioncontroller->deleteSessionUserLogout();

if ($sessionsame) {

    $_SESSION['user_details'] = '';
	unset($_SESSION);
	unset($_POST);
    session_unset();
    session_destroy();

    header("Location: index.php");
    die();  
 

} else {

    header("Location: dashboard.php");

}

?>
