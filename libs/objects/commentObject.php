<?php

namespace Objects;

class CommentObject {

    //VARIABLES
    private $message_id;
    private $comment_message_id;
    private $article_id;
    private $content;
    private $author_id;
    private $username;
    private $datetime;
    private $rating;
    private $hasChildren;
    private $childrenIDs;
    private $parent;
    private $isChild;
    private $isSaved;

    //REQUIRED

    public function __construct($objectData = NULL) {
        if ($objectData === NULL) {
            $this->constructEmpty();
        } else {
            $this->build($objectData);
        }
    }

    //FUNCTIONAL

    public function printMe() {
        print_r($this->message_id);
        print_r($this->datetime);
    }

    //CHECKS   

    public function hasChildren() {
        return $this->hasChildren;
    }

    //GETTERS

    public function getAuthorID() {
        return $this->author_id;
    }

    public function getTitle() {
        
    }

    public function getMessageID() {
        return $this->message_id;
    }

    public function getCommentMessageID() {
        return $this->comment_message_id;
    }

    public function getArticleID() {
        return $this->article_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getParent() {
        return $this->parent;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getDate(){
        return $this->datetime;
    }

    //SETTERS

    private function build($objectData) {
        $this->message_id = $objectData['message_id'];
        $this->comment_message_id = $objectData['comment_message_id'];
        $this->article_id = $objectData['article_id'];
        $this->content = $objectData['content'];
        $this->author_id = $objectData['from_user_id'];
        $this->username = $objectData['username'];
        if ($objectData['parent_id'] != NULL) {
            $this->parent = $objectData['parent_id'];
            $this->isChild = TRUE;
        } else {
            $this->parent = 'NULL';
            $this->isChild = FALSE;
        }

        $this->datetime = $objectData['datetime'];
        $this->rating = $objectData['rating'];
        $this->isSaved = TRUE;
    }

    public function setChildren($childrenArray) {
        foreach ($childrenArray as $child) {
            $this->childrenIDs[] = $child['comment_message_id'];
        }
        $this->hasChildren = TRUE;
    }

    public function setHasChildren($result) {
        if ($result == TRUE) {
            $this->hasChildren = TRUE;
        } else {
            $this->hasChildren = FALSE;
        }
    }

    private function constructEmpty() {
        $this->isSaved = FALSE;
    }

}

?>