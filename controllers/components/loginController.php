<?php

namespace Controllers;

class LoginController {

    //REQUIRED
    function __construct($data) {

        $this->model = $data['model'];
        $this->view = $data['view'];
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function xhrValidate() {
        $data = $this->model->xhrValidate();
        $this->view->printData($data);
    }

    //CHECKS
    //GETTERS
    //SETTERS
}

?>
