<?php

namespace Models;

use Services\MapperService;
use Services\Factory\DomainObjectFactory;
use Services\InputService;

class CommentModel {

    //REQUIRED
    function __construct() {
        $this->input = new InputService();
        $this->mapper = MapperService::getMapper('comment');
    }

    //FUNCTIONAL

    private function nestComments($commentData) {
        $array = array();
        $commentArray = array();
        $childData = array();

        //Put database comments into an array of comment objects
        foreach ($commentData as $comment) {
            $commentArray[] = DomainObjectFactory::getObject('comment', $comment);
        }

        //step through comments and set array comment_id and data
        foreach ($commentArray as $comment) {
            $hasChildren = FALSE;
            //print_r( $comment->getCommentMessageID(). ' ');

            $childData = $this->mapper->getChildCommentsForParent($comment->getCommentMessageID());

            if (!empty($childData) || $childData != NULL) {
                $hasChildren = TRUE;
            }

            if ($hasChildren == TRUE) {
                $children = $this->nestComments($childData);
            } else {
                $children = NULL;
            }

            $array[] = array(
                'comment_id_' . $comment->getCommentMessageID() => array(
                    'COMMENT_ID' => $comment->getCommentMessageID(),
                    'DATA' => $comment,
                    'CHILDREN' => $children
                    ));
        }
        return $array;
    }

    //CHECKS
    //GETTERS

    public function loadComments($id) {
        $commentData = $this->mapper->getParentCommentsForArticle($id);
        $commentDataArray['data'] = $this->nestComments($commentData); 
        $commentDataArray['isValid'] = true;
        return $commentDataArray;
    }

    //SETTERS

    public function xhrSubmitComment() {
        $isValid = true;

        if ($this->input->checkMessage($_POST['comment'])) {
            $comment = $_POST['comment'];
        } else {
            $isValid = false;
        }
        if ($this->input->checkParentID($_POST['parent'])) {
            $parent = $_POST['parent'];
        } else {
            $isValid = false;
            $parent = NULL;
        }
        if ($this->input->checkArticleID($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        } else {
            $isValid = false;
        }

        if ($isValid) {
            $article_id = $_POST['article_id'];
            $user_id = $this->mapper->getUserID();
            $commentMessageID = $this->mapper->saveComment($user_id, $comment, $parent, $article_id);
            $this->mapper->incrementComments($article_id);
            $comment = $this->mapper->getCommentDataByID($commentMessageID);
            $commentArray[] = $comment;
            $commentDataArray['data'] = $this->nestComments($commentArray);
        }

        $commentDataArray['isValid'] = $isValid;
        return $commentDataArray;
    }

}

?>
