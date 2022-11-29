<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once './libraries/vendor/autoload.php';
require_once './Config/config.php';

class Mailer
{

    function __construct()
    {

        $this->validation = new validation();
        $this->registration_modal = new RegistrationModel();
        $this->master_modal = new MasterModel();
    }

    // Generate OTP Number and Insert On Table
    public function GenerateOTP() {

        $result = [];
        $otp = rand(100000, 999999);
        if (isset($otp) && $otp != 0 && strlen($otp) == 6) {			
			$result['error_msg'] = $otp;
			$result['error_code'] = '200';
			$result['error_status'] = true;        
        } else {
			$result['error_msg'] = 'Problem On Send OTP Message';
			$result['error_code'] = '400';
			$result['error_status'] = false;
		}

        return $result;
    
	}


    public function sentEmail()
    {

        return true;
    }

    public function sentSMS()
    {

        return true;
    }

    public function SendEmail($mail_fileds)
    {

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = false;               //Enable verbose debug output
            $mail->isSMTP();                                     //Send using SMTP
            $mail->Host       = MAIL_HOST;                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                            //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                   //SMTP username
            $mail->Password   = MAIL_PASSWORD;                   //SMTP password
            //$mail->SMTPSecure = MAIL_SMTPSECURE;                 //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
                )
            );
            //Recipients
            $mail->setFrom('arulmurugan.e@akara.co.in', 'Moovalur Project Admin');
            $mail->addAddress($mail_fileds['to_email_id'], $mail_fileds['to_email_id']);     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mail_fileds['email_subject'];
            $mail->Body    = $mail_fileds['email_body'];
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            $result = true;
        } catch (Exception $e) {

            $result = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $result;
    }
}
