<?php

namespace Models;

use Services\InputService;
use Services\MapperService;

class LoginModel {

    //VARIABLES

    private $mapper;

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('login');
        $this->input = new InputService();
    }

    //FUNCTIONAL

    public function xhrValidate() {
        $isValid = TRUE;
        if ($this->input->checkUsername($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $isValid = FALSE;
        }

        if ($this->input->checkPassword($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $isValid = FALSE;
        }

        if ($isValid === TRUE) {
            $userExists = $this->mapper->userCheck($username);

            if ($userExists == TRUE) {

                $validated = $this->mapper->validateCredentials($username, $password);

                if ($validated == TRUE) {
                    $userdata = $this->mapper->getUserDataByCredentials($username, $password);
                    $login = true;
                    $this->mapper->setSessionData($username, $userdata);
                    $this->mapper->setDefaults();
                } else {
                    $login = false;
                }
            } else {
                $login = false;
            }
        } else {
            $login = FALSE;
        }
        $data = array('login' => $login);
        return json_encode($data);
    }

    //CHECKS
    //GETTERS
    //SETTERS
}

?>
