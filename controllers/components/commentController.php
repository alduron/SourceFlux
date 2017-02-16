<?php

namespace Controllers;

class CommentController {

    //REQUIRED
    public function __construct($data) {

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

    private function getCommentIDs($article_id = NULL) {
        if ($article_id === NULL) {
            $commentArray = $this->model->getAllComments();
        } else {
            $commentArray = $this->model->getArticleComments($article_id);
        }

        return $commentIDs;
    }

    public function getDefaultComments() {
        
    }

    public function xhrLoadComments() {
        $id = $_POST['id'];
        $commentObjectArray = $this->model->loadComments($id);
        $this->displayComments($commentObjectArray);
    }

    public function xhrGetReplyForm() {
        $this->view->comment_id = $_POST['comment_id'];
        $this->view->parent = $_POST['comment_id'];
        $this->view->article_id = $_POST['article_id'];
        $this->view->render('messages/reply', TRUE);
    }

    //SETTERS

    public function xhrSubmitComment() {
        $commentObjectArray = $this->model->xhrSubmitComment();
        if ($commentObjectArray['isValid']) {
            $this->displayComments($commentObjectArray);
        } else {
            $return['isValid'] = $commentObjectArray['isValid'];
            $this->view->printData(json_encode($return));
        }
    }

    function formatArray($array, $type = 0) {
        foreach ($array as $parent) {
            if ($parent['CHILDREN'] == NULL) {
                $this->view->type = 1;
                $this->view->typeString = 'child';
            } else {
                $this->view->type = 0;
                $this->view->typeString = 'parent';
            }
            $this->view->parent = $parent;
            $this->view->render('messages/commentbody', TRUE);

            if ($parent['CHILDREN'] != NULL) {
                foreach ($parent['CHILDREN'] as $childArray) {
                    $this->formatArray($childArray, $type);
                }
            }
            $this->view->render('messages/commentclose', TRUE);
        }
    }

    private function displayComments($commentObjectArray) {
        if ($commentObjectArray['isValid']) {
            $data = $commentObjectArray['data'];
            foreach ($data as $comment) {
                    $this->formatArray($comment);
            }
        } else {
            $this->view->render('messages/commentnone', TRUE);
        }
    }

}
?>