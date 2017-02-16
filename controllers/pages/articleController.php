<?php

namespace Controllers;

use Services\SessionService;
use Services\ErrorService;

class ArticleController {

    //REQUIRED

    function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];
        
        //leave this for validations later
        $logged = SessionService::get('loggedIn');

        $this->view->setJS(JSVIEWS . 'article/js/default.js');
        $this->view->setJS(JSVIEWS.'interface/js/topnav.js');
    }

    public function index() {
        $error = new Error();
        $error->setError(ERROR_SELECT_ARTICLE, FALSE);
        $error->index();
    }

    //FUNCTIONAL

    public function view() {
        $articleData = $this->model->getArticleData();
        if ($articleData == '!NULL!') {
            $this->error(ERROR_NO_ARTICLES, FALSE);
        }
        $this->view->articleData = $articleData;
        $this->view->article_id = $articleData->getArticleID();
        $this->view->parent = null;
        if (!isset($this->comment_id)) {
            $this->view->comment_id = null;
        }
        $this->view->render('article/index');
    }

    private function error($msg, $hideFrame) {
        ErrorService::show($msg);
    }

    //CHECKS
    //GETTERS
    //SETTERS

    public function xhrUpvote() {
        $articleID = $_POST['articleID'];
        $result = $this->model->xhrUpvote($articleID);
    }

    public function xhrDownvote() {
        $articleID = $_POST['articleID'];
        $result = $this->model->xhrDownvote($articleID);
    }

}

?>
