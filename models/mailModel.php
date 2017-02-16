<?php

namespace Models;

use Services\MapperService;

class MailModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('mail');
        require_once MAILER;
        require_once SMTP;
        $this->mail = new \PHPMailer;

        $this->mail->IsSMTP();
        //$mail->SMTPDebug = 2;                                   
        $this->mail->Host = 'smtp.gmail.com';                         // Specify main and backup server
        $this->mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $this->mail->Username = 'admin@digitalinjections.com';        // SMTP username
        $this->mail->Password = '!!_SYSTEM_LOGIN';                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                              // Enable encryption, 'ssl' also accepted
        $this->mail->Port = 465;
        $this->mail->From = 'admin@digitalinjections.com';
        $this->mail->FromName = WEBSITE_NAME;
        $this->mail->IsHTML(true);
    }

    //FUNCTIONAL

    public function sendEmail() {
        if (!$this->mail->Send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
            exit;
        }
    }

    //GETTERS

    public function getUserData() {
        return $this->mapper->getUserData();
    }

    //SETTERS

    public function buildVerificationMail($userObj) {
        $message = file_get_contents(HTTP_TEMPLATES . 'verification.html');
        $message = str_replace('%%url%%', URL, $message);
        $message = str_replace('%%website_name%%', WEBSITE_NAME, $message);
        $message = str_replace('%%username%%', $userObj->getUsername(), $message);
        $message = str_replace('%%verification_number%%', $userObj->getVerificationNum(), $message);
        $this->mail->AddAddress($userObj->getEmail(), $userObj->getUsername());

        $this->mail->Subject = 'Please verify your email address';
        $this->mail->Body = $message;
    }

    public function buildPasswordReset($userObj) {
        $message = file_get_contents(HTTP_TEMPLATES . 'password_reset.html');
        $message = str_replace('%%url%%', URL, $message);
        $message = str_replace('%%username%%', $userObj->getUsername(), $message);
        $message = str_replace('%%password_authentication%%', $userObj->getPasswordAuthentication(), $message);
        $this->mail->AddAddress($userObj->getEmail(), $userObj->getUsername());

        $this->mail->Subject = 'Password Reset Request';
        $this->mail->Body = $message;
    }

}

?>