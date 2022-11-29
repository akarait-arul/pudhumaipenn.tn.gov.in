<?php
define("SERNAME", "APP1");
date_default_timezone_set('Asia/Kolkata');

// Include ADO DB 
include_once("./libraries/adodb5/adodb.inc.php");


// Database Connection 
class DBConfig {

    private $host ="localhost";
    private $db_username = "root";
    private $db_password = "";
    private $db_name = "pudhumaipenn";

    function dbConnection(){
       
      try {
        
          $driver = 'mysqli';

          $dsn_options='?persist=0&fetchmode=2';
          $dsn = "$driver://$this->db_username:$this->db_password@$this->host/$this->db_name$dsn_options";
          
          $conn = NewADOConnection($dsn);

    /*       if ($conn->isConnected())

            echo 'Connected';

          else

            echo 'Not Connected'; */

          return $conn;
        
      } catch(PDOException $e) {
          
        return $e->$conn->errorMsg();
    
      }

    
    }


}


?>
