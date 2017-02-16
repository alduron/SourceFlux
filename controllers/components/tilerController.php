<?php

namespace Controllers;

use Services\ErrorService;

class TilerController {

    //REQUIRED

    function __construct($data) {
        $this->view = $data['view'];
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function display($tileObjArray, $feed = false) {
        if (empty($tileObjArray)) {
            ErrorService::show('No results found with tags.');
            exit();
        }
        if ($feed == false) {
            $this->view->feed = 3;
        } else {
            $this->view->feed = $feed;
        }
        $this->view->tileObjArray = $tileObjArray;
        $this->view->render('tile/tile', true);
    }

    //CHECKS
    //GETTERS
    //SETTERS
}

?>