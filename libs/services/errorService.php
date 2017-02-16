<?php

namespace Services;

use Services\CallerSerivice;

class ErrorService {

    //REQUIRED

    function __construct() {
        
    }

    public function index() {
        if (!isset($this->msg)) {
            $this->msg = ERROR_LOCATE_PAGE;
        }
        $this->view->render('error/index', false, $this->msg);
    }

    //FUNCTIONAL

    public function show($msg) {
        $view = CallerSerivice::callClass('web', 'view');
        if (!isset($msg)) {
            $msg = ERROR_DEFAULT;
        }
        $view->render('error/show', TRUE, $msg);
    }

    public function showMinimal() {
        print_r($this->msg);
    }

    //CHECKS
    //GETTERS
    //SETTERS

    public function setError($msg) {
        $this->msg = $msg;
    }

}

?>
