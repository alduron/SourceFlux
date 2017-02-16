<?php

namespace Mappers;

use Libs\MapperLib;

class AccountMapper extends MapperLib {

    //REQUIRED
    function __construct() {
        parent::__construct();
    }

    //FUNCTIONAL
    //CHECKS

    public function checkAvailability($username) {
        return $this->userDB->checkForUserByUsername($username);
    }

    //GETTERS

    public function getUserDataByUsername($username) {
        return $this->userDB->getUserDataByUserName($username);
    }

    public function getPasswordAuthentication($userObj) {
        $authenticationArray = $this->userDB->getPasswordAuthentication($userObj->getUsername());
        $authentication = $authenticationArray[0]['password_authentication'];
        return $authentication;
    }

    //SETTERS

    public function createNewUser($userData) {
        $this->userDB->createUser($userData['username'], $userData['password'], $userData['verification_number'], $userData['email']);
    }

    public function setVerified($username) {
        $this->userDB->setUserVerified($username);
        $this->userDB->nullVerificationNumber($username);
    }

    public function createPasswordAuthentication($userObj) {
        $this->userDB->createPasswordAuthentication($userObj->getUsername(), $userObj->getPasswordAuthentication());
    }

    public function updatePassword($userObj, $password) {
        $this->userDB->updatePassword($userObj->getUsername(), $password);
    }

    public function removeAuthentication($userObj) {
        $this->userDB->removeAuthentication($userObj->getUsername());
    }

}

?>
