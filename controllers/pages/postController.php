<?php

namespace Controllers;

use Services\SessionService;

class PostController {

    //REQUIRED

    function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];

        $logged = SessionService::get('loggedIn');

        if ($logged == false) {
            $this->index();
            exit();
        }
        $this->view->setJS(JSVIEWS . 'interface/js/topnav.js');
        $jspath = JSVIEWS . 'post/js/default.js';
        $this->view->setJS($jspath);
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }

    //FUNCTIONAL

    public function create() {
        $this->view->render('post/index');
    }

    //CHECKS
    //GETTERS

    public function xhrSearchTags() {
        $data = $this->model->xhrSearchTags();
        $this->view->printData($data);
    }

    //SETTERS

    public function submitArticle() {
        $title = $this->model->submitArticle();
        $article = str_replace(' ', '-', $title);
        header('location: ' . URL . 'article/view/' . $article);
    }

    public function xhrAddTagToDB() {
        $result = $this->model->xhrAddTagToDB();
        $this->view->echoData($result);
    }

    public function xhrAddTag() {
        $this->view->printData($this->model->xhrAddTag());
    }

    public function xhrRemoveTagFromSession() {
        $this->model->xhrRemoveTagFromSession();
    }

    public function xhrClearNewArticleTags() {
        $this->model->xhrClearNewArticleTags();
    }

    public function xhrAddSource() {
        $this->view->printData($this->model->xhrAddSource());
    }

    public function xhrRemoveSource() {
        $this->model->xhrRemoveSource();
    }

    public function xhrRemoveTag() {
        $this->model->xhrRemoveTag();
    }

    public function xhrLoadSources() {
        $this->view->sourceObjs = $this->model->xhrLoadSources();
        $this->view->render('post/sourcerows', true);
    }

    public function xhrLoadTags() {
        $this->view->tagObjs = $this->model->xhrLoadTags();
        $this->view->render('post/tagrows', true);
    }

    public function xhrSubmit() {
        $result = $this->model->xhrSubmit();
        $this->view->printData($result);
    }

}

?>
