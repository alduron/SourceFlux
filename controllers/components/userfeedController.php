<?php

namespace Controllers;

use Services\CallerSerivice;

class UserFeedController {

    //REQUIRED

    function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];
        if (!isset($data['feed'])) {
            $this->feed = $_POST['feed'];
        } else {
            $this->feed = $data['feed'];
        }

        $this->tileh = CallerSerivice::callClass('tiler', 'controller',NULL,array('view'=>  $this->view));
        
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function display() {
        $this->view->feed = $this->feed;
        $this->view->render('feeds/uf', TRUE);
    }

    //CHECKS
    //GETTERS

    public function xhrLoadDefaultTiles() {
        $tileObjArray = $this->model->xhrLoadDefaultTiles();
        $this->tileh->display($tileObjArray, $this->feed);
    }

    public function xhrAdvancePage() {
        $tileObjArray = $this->model->xhrAdvancePage();
        $this->tileh->display($tileObjArray);
    }
//
//    public function xhrReversePage() {
//        $tileData = $this->model->xhrReversePage();
//        $this->tileh->display($tileData);
//    }

    //SETTERS
}

?>