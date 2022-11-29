<?php
session_start();
class validation
{

	function removeSpecialCharacter($inputvalue){
		
		if(isset($inputvalue)){

			$res = preg_replace('/[^A-Za-z ]/','',$inputvalue);
			
		}
		
		return $res;
	}

    function encryptValue($inputvalue)
    {

        if (isset($inputvalue) && !empty($inputvalue)) {

            $privateKey     = 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
            $secretKey         = '81335c7dbb5ef5fb839060'; // user define secret key
            $encryptMethod  = "AES-256-CBC";

            $key = hash('sha256', $privateKey);
            $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
            $result = openssl_encrypt($inputvalue, $encryptMethod, $key, 0, $ivalue);
            $output = base64_encode($result);  // output is a encripted value

        } else {

            $output = false;
        }

        return $output;
    }


    function getUserIP()
    {
        $ip = '';
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    function decryptValue($inputvalue)
    {

        if (isset($inputvalue) && !empty($inputvalue)) {

            $privateKey = 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
            $secretKey     = '81335c7dbb5ef5fb839060'; // user define secret key
            $encryptMethod  = "AES-256-CBC";
            $key    = hash('sha256', $privateKey);
            $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
            $output = openssl_decrypt(base64_decode(trim($inputvalue)), $encryptMethod, $key, 0, $ivalue);
        } else {

            $output = false;
        }

        return $output;
    }

    function numbersonly($inputvalue)
    {

        $result  =  false;
        if (isset($inputvalue) && !empty($inputvalue)) {
            $result = ctype_digit($inputvalue) ? true : false;;
        }
        return $result;
    }

    function dateConversion($value)
    {

        if (isset($value) && !empty(trim($value))) {
            //$result = date('d-m-Y', strtotime($value));
            $date = DateTime::createFromFormat('d-m-Y', $value);
            $result = $date->format('Y-m-d');
        }

        return $result;
    }

    function dateConvert($value)
    {

        if (isset($value) && !empty(trim($value))) {
            $result1 = date('d-m-Y', strtotime($value));
            $date = DateTime::createFromFormat('d-m-Y', $result1);
            $result = $date->format('d-m-Y');
        }

        return $date;
    }

    function dateFormateUserView($value)
    {

        $result = false;
        if (isset($value) and !empty($value)) {



            $dateconv  = date("d-M-Y", strtotime($value));
            $date_obj = DateTime::createFromFormat('d-M-Y', $dateconv);
            if ($date_obj) {

                $result = $date_obj->format('d-M-Y');
            }
        }

        return $result;
    }

    function dateFormatDB($value)
    {

        $result = false;
        if (isset($value) and !empty($value)) {



            $dateconv  = date("Y-m-d", strtotime($value));
            $date_obj = DateTime::createFromFormat('Y-m-d', $dateconv);
            if ($date_obj) {

                $result = $date_obj->format('Y-m-d');
            }
        }

        return $result;
    }

    function apiDateValidation($value)
    {

        if ($value) {

            $dt = explode("T", $value);
            $extr_dt = $dt[0] ? $dt[0]  : '';
            $result  = $extr_dt ?  implode("-", array_reverse(explode("-", $dt[0]))) : '';
        } else {

            $result  = false;
        }

        return $result;
    }

    function emptyCheck($value)
    {

        $result =  false;
        if (isset($value) && !empty(trim($value))) {
            $result =  true;
        }
        return $result;
    }

    function pincodeValidation($inputvalue)
    {

        $result =  false;
        //$pattern = '/^[0-9]\d{5}$/';
        $pattern = '^[6][0-9]{5}$';

        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }
        return $result;
    }

    public function addressValidation($inputvalue)
    {

        $result =  false;
        $pattern = "/^([a-zA-Z0-9' ]+)$/";
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result = true;
        }
        return $result;
    }

    function nameValidation($inputvalue)
    {

        $result =  false;
        $pattern = "/^([a-zA-Z' ]+)$/";
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result = true;
        }
        return $result;
    }

    function usernameValidation($inputvalue)
    {

        $result =  false;
        //alphanumeric 
        $pattern = '/^[a-zA-Z0-9]{4,10}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }
        return $result;
    }

    function userPasswordcheck($inputvalue)
    {

        $result =  false;
        //password validation
        $pattern = '/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%&*_-]).{8,16}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }

        return $result;
    }

    function emailValidation($inputvalue)
    {

        $result =  false;
        //email validation
        $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }

        return $result;
    }

    function mobileValidation($inputvalue)
    {

        $result =  false;
        //mobile validation
        $pattern = '/^[6-9]\d{9}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }

        return $result;
    }


    function stringOnly($inputvalue)
    {

        $result =  false;
        //mobile validation
        $pattern = '/^[6-9]\d{9}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {
            $result =  true;
        }

        return $result;
    }


    function emisValidation($inputvalue)
    {

        $result = false;
        $pattern = '/^\d{16,19}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {

            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }


    function aadhaarValidation($inputvalue)
    {

        $result = false;
        $pattern = '/^\d{12}$/';
        if (isset($inputvalue) && !empty(trim($inputvalue)) && preg_match($pattern, $inputvalue)) {

            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }



    function generate_string($strength)
    {

        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*_';
        $input_length = strlen($input);
        $random_string = '';




        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }


        return $random_string;
    }


    function random_strings($length_of_string)
    {


        // sha1 the timestamps and returns substring
        // of specified length
        return substr(sha1(time()), 0, $length_of_string);
    }

    function saltGeneration($inputvalue)
    {

        $result = false;

        if (trim($inputvalue)) {

            //half of the length
            $length = $inputvalue;
            $bytes = random_bytes($length);
            $result = bin2hex($bytes);
        }

        return trim($result);
    }

    function randomPasswordGenerator()
    {

        $password = ''; 
        $passwordSets = ['1234567890', '%&@*#', 'ABCDEFGHJKLMNPQRSTUVWXYZ', 'abcdefghjkmnpqrstuvwxyz'];

        //Get random character from the array
        foreach ($passwordSets as $passwordSet) {
            $password .= $passwordSet[array_rand(str_split($passwordSet))];
        }

        // 8 is the length of password we want
        while (strlen($password) < 8) {
            $randomSet = $passwordSets[array_rand($passwordSets)];
            $password .= $randomSet[array_rand(str_split($randomSet))];
        }




        return  $password;
    }

    function passwordGenerator($inutvalue, $salting)
    {

        $hashed_val = false;
        if (trim($inutvalue) and  trim($salting)) {

            $logn_pwd = $inutvalue;
            $random_char = $salting;
            $hashed_val = crypt($logn_pwd, '$2a$07$' . $random_char);
        }
        return trim($hashed_val);
    }


    function passwordValidation($password, $dbpassword)
    {

        $returnval = false;
        if (trim($password) and  trim($dbpassword)) {

            if (password_verify($password, $dbpassword)) {

                $returnval = true;
            }
        }
        return trim($returnval);
    }

    function aadhaarmasking($aadhaarno)
    {

        $returnval = false;
        if (trim($aadhaarno) and  trim($aadhaarno)) {
            $aadhaarnosplit = str_split($aadhaarno, 8);
            $aadhaarno_lastfour = $aadhaarnosplit[1];
            $returnval = 'XXXXXXXX' . $aadhaarno_lastfour;
        }
        return trim($returnval);
    }
}
