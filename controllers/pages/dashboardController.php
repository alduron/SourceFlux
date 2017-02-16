<?php

namespace Controllers;

use Services\SessionService;

class DashboardController {

    //REQUIRED

    function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];
        $logged = SessionService::get('loggedIn');

        if ($logged == false) {
            header('location: ../index');
            exit();
        }
        $this->view->setJS(JSVIEWS . 'interface/js/topnav.js');
        $jspath = JSVIEWS . 'dashboard/js/default.js';
        $this->view->setJS($jspath);
    }

    public function index() {
        $this->view->render('dashboard/index');
    }

    //FUNCTIONAL

    public function logout() {
        SessionService::destroy();
        header('location: ' . URL);
        exit;
    }

    //CHECKS
    //GETTERS
    //SETTERS

    public function xhrInsert() {
        $data = $this->model->xhrInsert();
        $this->view->echoData($data);
    }

}

?>
