<?php

namespace Mappers;

use Libs\MapperLib;
use Services\SessionService;

class CommentMapper extends MapperLib {

    //REQUIRED

    function __construct() {
        parent::__construct();
        //$this->messageDB = new MessageDAO($db);
        //$this->userDB = new UserDAO($db);
    }

    //FUNCTIONAL    
    //CHECKS    

    public function checkForChildren($id) {
        return $this->messageDB->checkForChildren($id);
    }

    //GETTERS

    public function get($id) {
        $commentData = $this->messageDB->getCommentDataByID($id);
        //print_r($commentData);
        return $commentData;
    }

    public function getChildren($parentID) {
        $childIDs = $this->messageDB->getChildIDsForParent($parentID);
        return $childIDs;
    }

    public function getUserID() {
        return SessionService::get('user_id');
    }

    public function getParentCommentsForArticle($article_id) {
        return $this->messageDB->getParentCommentsForArticle($article_id);
    }

    public function getChildCommentsForParent($parent_id) {
        return $this->messageDB->getChildCommentsForParent($parent_id);
    }

    public function getCommentDataByID($commentMessageID) {
        return $this->messageDB->getCommentDataByID($commentMessageID);
    }

    //SETTERS

    public function saveComment($user_id, $comment, $parent, $article_id) {
        $message_id = $this->messageDB->setMessage(NULL, $comment);
        $commentMessageID = $this->messageDB->setCommentMessage($user_id, $message_id, $parent, $article_id);
        return $commentMessageID;
    }
    
    public function incrementComments($article_id){
        $this->articleDB->incrementComments($article_id);
    }

}

?>
