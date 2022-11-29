<?php




include_once("./Config/db_connect.php");

class LoginModel
{

    public function __construct()
    {

        $db = new DBConfig();
        $conn = $db->dbConnection();
        $this->conn = $conn;
    }


    public function Login($user_name, $user_type_id)
    {
        if($user_type_id == 30) {
            $exc_user_type_id = array(31, 20);
            $exc_user_type_id = implode(",", $exc_user_type_id);
            $sql = "select * from user_login where (email_id = '{$user_name}' or lusername = '{$user_name}' ) and m_user_type_id NOT IN ({$exc_user_type_id}) and is_deleted = '0' ";
            //$value = array($user_name, $user_name, $exc_user_type_id);
        } else {
            $sql = "select * from user_login where (email_id = '{$user_name}' or lusername = '{$user_name}' ) and m_user_type_id = ({$user_type_id}) and is_deleted = '0' ";
            //$value = array($user_name, $user_name, $user_type_id);
        }

        //$qry_exec = $this->conn->Execute($sql, $value);
        $qry_exec = $this->conn->Execute($sql);
        
        if ($qry_exec === false) {
        } else {

            $result['rows'] = $qry_exec->fetchRow();
            $result['no_rows'] = $qry_exec->rowCount();

            //$result =  $this->conn->getAssoc($sql);
        }


        return $result;
    }


    /* public function sessionValidCheck($userid)
    {


        $sql_query =  $this->conn->getAll("SELECT *   FROM user_login_session WHERE user_login_id = '" . $userid . "'  and  last_logintime >= (NOW() - INTERVAL 1 MINUTE)");

        return  $sql_query;
    } */


    public function checkAccountLock($user_name)
    {
        $value = array($user_name);
        $result = false;
        //$sql_query =  "select count(*) as login_count from user_login_history where (email_id = ? or lusername = ? )   and user_login_time >= (NOW() - INTERVAL 10 MINUTE";
        $sql_query =  "select count(*) as login_count from user_login_history where username = ? and user_login_time >= (NOW() - INTERVAL 10 MINUTE ) ";
        //var_dump($sql_query);
        $qry_exec = $this->conn->Execute($sql_query, $value);
        //var_dump($qry_exec);
        if ($qry_exec) {

            $result  = $qry_exec->fetchRow();
        }

        return  $result;
    }

    public function insertLoginHistory($username, $user_id, $clientip)
    {

        $result = false;
        $result = $this->conn->execute('INSERT INTO user_login_history (username,user_login_id,user_login_ip,user_login_time) value ("'.$username.'","'.$user_id.'","'.$clientip.'",now())');
        return $result ;
    }



    

    public function checkRegisteredMailMobile($username, $mobile, $usertype)
    {

        $result['no_rows'] = '';
        $result['rows'] = '';

        $sql = "select * from user_login where email_id = ? and m_user_type_id = ? and mobile_number =?  and is_deleted = '0' ";
        $value = array($username, $usertype, $mobile);
        $qry_exec = $this->conn->Execute($sql, $value);
        //var_dump($qry_exec);
        if ($qry_exec == false) {
            
        } else {

            $result['no_rows'] = $qry_exec->rowCount();
            $result['rows'] = $qry_exec->fetchRow();
        }
        return $result;
    }
    
}//class ending


?>