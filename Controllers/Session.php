<?php
//session_start();


include 'Models/SessionModel.php';

class Session
{

    function __construct()
    {

        $this->session_model = new SessionModel();
    }

    public function sessionActiveCheck()
    {

        $result['msg'] = '';
        $result['error_code'] = 400;
        $result['error_field'] = false;


        $userid = isset($_SESSION['user_details']['user_id']) ? trim($_SESSION['user_details']['user_id'])  : '';

        if (!$userid) {

            $result['msg'] = 'Due to inactivity. You will be logged out.';
        } else {


            $hashval = session_id();
            //var_dump($hashval);
            $getlastlogin = $this->session_model->sessionValidCheck($userid, $hashval);
            //var_dump($getlastlogin);
            $recordcount  = count($getlastlogin) ?  true : false;


            //var_dump($getlastlogin);
            if ($recordcount) {

                $result['error_code'] = 200;
                $result['error_field'] = true;
            } else {

                $result['error_code'] = 400;
                $result['error_field'] = false;
            }
        }

        return $result;
    }


    public function sameSessionCheck()
    {


        $result['msg'] = '';
        $result['error_code'] = 400;
        $result['error_field'] = false;

        $userid = $_SESSION['user_details']['user_id']  ? $_SESSION['user_details']['user_id']   : '';
        if (!$userid) {

            $result['msg'] = 'Unable to fetch user details';
            $result['error_code'] = 400;
            $result['error_field'] = false;
        } else {


            $dbsessiondetails = $this->session_model->checksessionexist($userid);
            $dbsessionid = $dbsessiondetails['session_hashval'];
            $currentsessionid = session_id();

            if ($dbsessionid ==  $currentsessionid) {

                $result['msg'] = '';
                $result['error_code'] = 200;
                $result['error_field'] = true;
            } else {

                $result['msg'] = '';
                $result['error_code'] = 400;
                $result['error_field'] = false;
            }
        }



        return $result;
    }


    public function checksessionexist()
    {


        $result['msg'] = '';
        $result['error_code'] = 400;
        $result['error_field'] = false;

        $userid = trim($_SESSION['user_details']['user_id']);

        if (!$userid) {

            $result['msg'] = 'Unable to fetch user details.';
        } else {

            $sessionexist = $this->session_model->checksessionexist($userid);
            $recordcount  = count($sessionexist) ? true   : false;
            if ($recordcount) {

                $result['error_code'] = 400;
                $result['error_field'] = false;
            } else {

                $result['msg'] = 'Unable to current user details';
            }
        }


        return $result;
    }

    public function updateLastLoginTime()
    {

        $result['msg'] = '';
        $result['error_code'] = 400;
        $result['error_field'] = false;

        $userid = $_SESSION['user_details']['user_id'];
        $sessionid = session_id();


        if (!$userid) {

            $result['error_code'] = 400;
            $result['error_field'] = false;
        } else if (!$sessionid) {

            $result['error_code'] = 400;
            $result['error_field'] = false;
        } else {


            $tablename = 'user_login_session';
            $timenow = time();

            $records['last_logintime'] = $timenow;

            $where = "user_login_id =  '" . $userid . "' and session_hashval ='" . $sessionid . "'  ";


            $updatelogintime = $this->session_model->updateLastLoginTime($tablename, $records, $where);
            //var_dump($updatelogintime);
            if ($updatelogintime) {

                $result['error_code'] = 200;
                $result['error_field'] = true;
            } else {

                $result['error_code'] = 400;
                $result['error_field'] = true;
            }
        }


        return $result;
    }


/*    public function deleteSessionUserLogout()
    {

        $result = false;
        $userid = $_SESSION['user_details']['user_id'];
        if (!$userid) {
        } else {

            $sessionexist = $this->session_model->deleteSessionUserLogout($userid);
            if ($sessionexist) {

                $result = true;
            }
        }


        return $result;
    }*/

public function deleteSessionUserLogout()
    {
        $result = false;
        
		if(isset($_SESSION['user_details']['user_id'])){
			$userid = $_SESSION['user_details']['user_id'];
			$sessionexist = $this->session_model->deleteSessionUserLogout($userid);
            if ($sessionexist) {

                $result = true;
            }
			
		}
		
        return $result;
    }
}
