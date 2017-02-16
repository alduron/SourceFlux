<?php

namespace Controllers;

class FilterController {

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
    //CHECKS
    //GETTERS

    public function xhrLoadTags() {
        $this->view->tagObjects = $this->model->xhrLoadTags();
        $this->view->feed = $_POST['feed'];
        $this->view->render('filters/filters', true);
    }

    //SETTERS

    public function xhrSetTag() {
        $result = $this->model->xhrSetTag();
        $this->view->printData($result);
    }

    public function xhrSaveTags() {
        $return = $this->model->xhrSaveTags();
        $this->view->printData($return);
    }

    public function xhrRemoveTags() {
        $this->model->xhrRemoveTags();
    }

}

?>