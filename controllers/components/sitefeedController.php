<?php

namespace Controllers;

use Services\CallerSerivice;

class SiteFeedController {

    //REQUIRED

    function __construct($data) {

        $this->model = $data['model'];
        $this->view = $data['view'];

        $this->tileh = CallerSerivice::callClass('tiler', 'controller',NULL,array('view'=>  $this->view));
        
        $this->model->setDefaults();
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function display() {
        $this->view->render('feeds/sf', TRUE);
    }

    //CHECKS
    //GETTERS

    public function xhrLoadDefaultTiles() {
        $tileObjArray = $this->model->xhrLoadDefaultTiles();
        $this->tileh->display($tileObjArray);
    }

    public function xhrAdvancePage() {
        $tileObjArray = $this->model->xhrAdvancePage();
        $this->tileh->display($tileObjArray);
    }

    //SETTERS
}
?>