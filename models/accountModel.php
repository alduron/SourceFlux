<?php

namespace Models;

use Services\MapperService;
use Services\CallerSerivice;
use Services\Factory\DomainObjectFactory;
use Services\InputService;

class AccountModel {

    //REQURIED

    function __construct() {
        $this->mapper = MapperService::getMapper('account');
        $this->input = new InputService();
    }

    //FUNCTIONAL
    //CHECKS

    public function verify($verification_number, $username) {
        $userObj = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUsername($username));
        if ($userObj->getVerificationNum() == $verification_number) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function xhrValidateData() {
        $isValid = TRUE;
        $created = FALSE;

        if ($this->input->checkUsername($_POST['username'])) {
            $username = $_POST['username'];
            $result = $this->checkAvailability($username);

            if ($result == FALSE) {
                $validUser = TRUE;
            } else {
                $isValid = FALSE;
                $validUser = FALSE;
            }
        } else {
            $isValid = FALSE;
            $validUser = FALSE;
        }

        if ($this->input->checkEmail($_POST['email'])) {
            $validEmail = TRUE;
            $email = $_POST['email'];
        } else {
            $isValid = FALSE;
            $validEmail = FALSE;
        }

        if ($this->input->checkEmail($_POST['confirmemail'])) {
            $validConfirmEmail = TRUE;
            $confirmEmail = $_POST['confirmemail'];
        } else {
            $isValid = FALSE;
            $validConfirmEmail = FALSE;
        }

        if ($this->input->checkPassword($_POST['password'])) {
            $validPassword = TRUE;
            $password = $_POST['password'];
        } else {
            $isValid = FALSE;
            $validPassword = FALSE;
        }

        if ($this->input->checkPassword($_POST['confirmpassword'])) {
            $validConfirmPassword = TRUE;
            $confirmPassword = $_POST['confirmpassword'];
        } else {
            $isValid = FALSE;
            $validConfirmPassword = FALSE;
        }

        if (!empty($email) && !empty($confirmEmail)) {
            if ($email !== $confirmEmail) {
                $isValid = FALSE;
                $validEmail = FALSE;
                $validConfirmEmail = FALSE;
            }
        } else {
            $isValid = FALSE;
            $validEmail = FALSE;
            $validConfirmEmail = FALSE;
        }

        if (!empty($password) && !empty($confirmPassword)) {
            if ($password !== $confirmPassword) {
                $isValid = FALSE;
                $validPassword = FALSE;
                $validConfirmPassword = FALSE;
            }
        } else {
            $isValid = FALSE;
            $validPassword = FALSE;
            $validConfirmPassword = FALSE;
        }
        
        if ($validUser === TRUE && $isValid === TRUE) {
            if (($isValid) && ($validEmail) && ($validConfirmEmail) && ($validPassword) && ($validConfirmPassword)) {
                $path = 'account/emailsent';
                $userData['username'] = $username;
                $userData['email'] = $email;
                $userData['password'] = $password;
                $this->createUser($userData);
                $this->success($userData['username']);
                $created = TRUE;
            } else {
                $path = '';
            }
        } else {
            $path = '';
        }

        $return = array('created' => $created, 'path' => $path, 'isValid' => $isValid, 'username' => $validUser, 'email' => $validEmail, 'confirmemail' => $validConfirmEmail, 'password' => $validEmail, 'password' => $validPassword, 'confirmpassword' => $validConfirmPassword);
        return $return;
    }

    public function xhrValidateReset() {
        $isValid = TRUE;

        if ($this->input->checkUsername($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $isValid = FALSE;
        }

        if ($this->input->checkEmail($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $isValid = FALSE;
        }

        if ($isValid) {
            $result = $this->checkAvailability($username);
            if ($result == TRUE) {
                $userObj = $this->getUserObj($username);
                if ($userObj->getEmail() === $email) {
                    $this->createPasswordAuthentication($userObj);
                    $mailer = CallerSerivice::callClass('mail', 'controller');
                    $mailer->sendPasswordReset($userObj);
                    $path = 'account/emailsent';
                } else {
                    $isValid = FALSE;
                    $path = FALSE;
                }
            } else {
                $isValid = FALSE;
                $path = FALSE;
            }
        } else {
            $path = FALSE;
        }

        $return = array('path' => $path, 'isValid' => $isValid);
        return $return;
    }

    public function xhrChangePassword() {
        $isValid = TRUE;

        if ($this->input->checkPassword($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $isValid = FALSE;
        }

        if ($this->input->checkPassword($_POST['confirmpassword'])) {
            $confirmpassword = $_POST['confirmpassword'];
        } else {
            $isValid = FALSE;
        }

        if ($this->input->checkUsername($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $isValid = FALSE;
        }

        if ($this->input->checkAuth($_POST['passwordauth'])) {
            $passwordauth = $_POST['passwordauth'];
        } else {
            $isValid = FALSE;
        }

        if ($isValid) {
            if ($password === $confirmpassword) {
                $userObj = $this->getUserObj($username);
                $password_authentication = $this->getPasswordAuthentication($userObj);
                $userObj->setPasswordAuthentication($password_authentication);

                if ($passwordauth === $userObj->getPasswordAuthentication()) {
                    $this->updatePassword($userObj, md5($password));
                    $this->removeAuthentication($userObj);
                } else {
                    $isValid = FALSE;
                }
            } else {
                $isValid = FALSE;
            }
        }
        $return = array('isValid' => $isValid);
        return $return;
    }

    public function checkAvailability($username) {
        return $this->mapper->checkAvailability($username);
    }

    //GETTERS

    public function getUserObj($username) {
        $userObj = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUsername($username));
        return $userObj;
    }

    public function getPasswordAuthentication($userObj) {
        return $this->mapper->getPasswordAuthentication($userObj);
    }

    //SETTERS

    private function success($username) {
        $userObj = $this->getUserObj($username);
        $mailer = CallerSerivice::callClass('mail', 'controller');
        $mailer->sendVerification($userObj);
    }

    public function createUser($userData) {
        $userData['verification_number'] = md5(\date('Y-m-d H:i:s') . $userData['email'] . $userData['username']);
        $userData['password'] = md5($userData['password']);
        $this->mapper->createNewUser($userData);
    }

    public function setUserVerified($username) {
        $this->mapper->setVerified($username);
    }

    public function createPasswordAuthentication($userObj) {
        $passwordAuthentication = md5($userObj->getUsername() . $userObj->getEmail() . \date('Y-m-d H:i:s'));
        $userObj->setPasswordAuthentication($passwordAuthentication);
        $this->mapper->createPasswordAuthentication($userObj);
    }

    public function updatePassword($userObj, $password) {
        $this->mapper->updatePassword($userObj, $password);
    }

    public function removeAuthentication($userObj) {
        $this->mapper->removeAuthentication($userObj);
    }

}

?>
