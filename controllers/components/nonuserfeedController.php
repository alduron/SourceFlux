<?php

namespace Controllers;

use Services\CallerSerivice;

class NonUserFeedController {

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
        $this->view->groupObjArray = $this->model->getGroupArray();
        $this->view->render('feeds/nuf', TRUE);
    }

    public function xhrRunSelector() {
        $tileObjArray = $this->model->xhrRunSelector();
        $this->tileh->display($tileObjArray, $this->feed);
    }

    //CHECKS
    //GETTERS

    public function xhrGetArticles() {
        $this->model->xhrGetArticles();
    }

    public function xhrAdvancePage() {
        $tileData = $this->model->xhrAdvancePage();
        $this->tileh->display($tileData);
    }

    public function xhrReversePage() {
        $tileData = $this->model->xhrReversePage();
        $this->tileh->display($tileData);
    }

    //SETTERS
}

?>
