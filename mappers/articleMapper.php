<?php

namespace Mappers;

use Libs\MapperLib;
use Services\Factory\DomainObjectFactory;

class ArticleMapper extends MapperLib {

    //REQUIRED

    function __construct() {
        parent::__construct();
    }

    //FUNCTIONAL
    //CHECKS    
    //GETTERS
    public function checkForUserVote($userID, $articleID) {
        return $this->voteDB->checkForUserVote($userID, $articleID);
    }

    public function getUserData($username) {
        $factory = New DomainObjectFactory();
        return $factory->getObject('user', $this->userDB->getUserDataByUserName($username));
    }

    public function getArtDataByString($searchString) {
        return $this->articleDB->getArtDataByString($searchString);
    }

    public function getData($article_id) {
        return $this->articleDB->getArtDataByID($article_id);
    }

    public function getArtComments($article_id) {
        $comments = $this->messageDB->getParentIDsForArticle($article_id);
        return $comments;
    }
    
    public function getTagArray($article_id){
        return $this->tagDB->getArticleTagsByID($article_id);
    }
    
    public function getSourceArray($article_id){
        return $this->sourceDB->getSources($article_id);
    }

    //SETTERS

    public function setUpvote($userID, $articleID) {
        if ($this->voteDB->checkForUserVote($userID, $articleID, 2) == TRUE) {
            $this->articleDB->removeDownVote($articleID);
            $this->articleDB->upVote($articleID);
            return $this->voteDB->updateUserVote($userID, $articleID, 1);
        } else {
            if ($this->voteDB->checkForUserVote($userID, $articleID, 1) == TRUE) {
                return FALSE;
            } else {
                $this->articleDB->upVote($articleID);
                return $this->voteDB->setUserVote($userID, $articleID, 1);
            }
        }
    }

    public function setDownvote($userID, $articleID) {
        if ($this->voteDB->checkForUserVote($userID, $articleID, 1) == TRUE) {
            $this->articleDB->removeUpvote($articleID);
            $this->articleDB->downVote($articleID);
            return $this->voteDB->updateUserVote($userID, $articleID, 2);
        } else {
            if ($this->voteDB->checkForUserVote($userID, $articleID, 2) == true) {
                return FALSE;
            } else {
                $this->articleDB->downVote($articleID);
                return $this->voteDB->setUserVote($userID, $articleID, 2);
            }
        }
    }

    public function incrementViews($article_id) {
        $this->articleDB->incrementViews($article_id);
    }

}

?>
