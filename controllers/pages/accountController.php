<?php

namespace Controllers;

use Services\CallerSerivice;

class AccountController {

    //REQUIRED

    function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];

        $jspath1 = JSVIEWS . 'interface/js/topnav.js';
        $this->view->setJS($jspath1);
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function emailSent() {
        $this->view->render('account/emailsent');
    }

    public function create() {
        $this->view->setJS(JSVIEWS . 'account/js/create.js');
        $this->view->render('account/create');
    }

    private function failure() {
        echo 'failed';
    }

    public function reset() {
        $this->view->setJS(JSVIEWS . 'account/js/reset.js');
        $this->view->render('account/reset');
    }

    public function sendEmail() {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $result = $this->checkAvailability($username);
        if ($result == TRUE) {
            $userObj = $this->model->getUserObj($username);
            if ($userObj->getEmail() === $email) {
                $this->model->createPasswordAuthentication($userObj);
                $mailer = CallerSerivice::callClass('mail', 'controller');
                $mailer->sendPasswordReset($userObj);
                $this->view->render('account/emailsent');
            } else {
                $this->view->render('account/verifyfailed');
            }
        } else {
            $this->view->render('account/verifyfailed');
        }
    }

    public function resetPassword($authentication, $username) {
        $this->view->setJS(JSVIEWS . 'account/js/resetpassword.js');
        $userObj = $this->model->getUserObj($username);
        $password_authentication = $this->model->getPasswordAuthentication($userObj);
        $userObj->setPasswordAuthentication($password_authentication);

        if ($authentication === $userObj->getPasswordAuthentication()) {
            $this->view->passwordAuthentication = $authentication;
            $this->view->username = $userObj->getUsername();
            $this->view->render('account/resetform');
        } else {
            $this->view->render('account/verifyfailed');
        }
    }

    //CHECKS

    public function xhrValidateData() {
        $return = $this->model->xhrValidateData();
        $this->view->printData(json_encode($return));
    }

    public function xhrValidateReset() {
        $return = $this->model->xhrValidateReset();
        $this->view->printData(json_encode($return));
    }
    
    public function xhrValidatePassword(){
        $return = $this->model->xhrValidateReset();
        $this->view->printData(json_encode($return));
    }

    public function checkAvailability($username = FALSE) {
        if ($username == FALSE) {
            echo '3';
            $this->failure();
        } else {
            return $this->model->checkAvailability($username);
        }
    }

    public function verify($verification_number, $username) {
        $result = $this->model->verify($verification_number, $username);

        if ($result == TRUE) {
            //auto login
            $this->model->setUserVerified($username);
            header('location: ' . URL);
            exit();
        } else {
            $this->view->render('account/verifyfailed');
        }
    }

    //GETTERS
    //SETTERS


    public function xhrChangePassword() {
        $return = $this->model->xhrChangePassword();
        $this->view->printData(json_encode($return));
    }

}

?>
