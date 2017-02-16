<?php

namespace Controllers;

use Services\CallerSerivice;

class MailController {

    //REQUIRED

    function __construct() {
        $this->model = CallerSerivice::callClass('mail', 'model');
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function buildMail() {
        $this->model->buildMail();
    }

    //CHECKS
    //GETTERS
    //SETTERS

    public function sendVerification($userObj) {
        $this->model->buildVerificationMail($userObj);
        $this->model->sendEmail();
    }

    public function sendPasswordReset($userObj) {
        $this->model->buildPasswordReset($userObj);
        $this->model->sendEmail();
    }

}

?>
