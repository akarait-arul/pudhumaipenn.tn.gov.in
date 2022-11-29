<?php




include_once("./Config/db_connect.php");


 

class SessionModel {    
    
    public function __construct(){
        
        $db = new DBConfig();
        $conn = $db->dbConnection();
        $this->conn = $conn;
       
    } 

    public function addUserSession($table_name, $records){

        $sql_query =false;
        $sql_query =  $this->conn->autoExecute($table_name,$records,"INSERT");
        

        return  $sql_query; 



    }

    //valid session check for inactivity
    public function sessionValidCheck($userid,$sessionid ){

        $sql_query = false;
        //echo "SELECT *   FROM user_login_session WHERE user_login_id = '".$userid."'  and session_hashval = '".$sessionid." ' and   last_logintime >= (NOW() - INTERVAL 5 MINUTE)";

        $sql_query =  $this->conn->getAll("SELECT *   FROM user_login_session WHERE user_login_id = '".$userid."'  and session_hashval = '".$sessionid." ' and   last_logintime >= (NOW() - INTERVAL 1 HOUR)");



        
        return  $sql_query;
    }
    //valid session check for inactivity


    public function checksessionexist($userid){

        $sql_query =false;
       // echo "SELECT *   FROM user_login_session WHERE user_login_id = '".$userid."' ";
        $sql_query =  $this->conn->getRow("SELECT *   FROM user_login_session WHERE user_login_id = '".$userid."' ");
        return  $sql_query; 



    }


    public function updateLastLoginTime($table,$record,$where ){

        $sql_query = false;
        $sql_query =  $this->conn->autoExecute($table,$record,'UPDATE',$where);
        
        return  $sql_query;
    }



    public function deleteSessionUserLogout($userid){
        $result  = false;
        
        $sql_query =  $this->conn->Execute("delete from user_login_session where user_login_id = '".$userid."' ");
        if($sql_query){

            $result  = true;
        }

        return  $result;


    }
 


    

}
