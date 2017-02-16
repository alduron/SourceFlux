<?php

namespace Objects;

class ArticleObject {

//Variables
    private $article_id;
    private $title;
    private $tldr;
    private $date;
    private $content;
    private $author_id;
    private $author_name;
    private $num_comments;
    private $num_views;
    private $upVotes;
    private $downVotes;
    private $rating;
    private $tagArray;
    private $sourceArray;

//REQUIRED
    function __construct($objectData = '::DEFAULT::', $tagArray=NULL, $sourceArray = NULL) {
        if ($objectData === '::DEFAULT::') {
            $this->constructEmpty();
        } else if($tagArray ===NULL) {
            $this->build($objectData);
        } else {
            $this->build($objectData, $tagArray, $sourceArray);
        }
    }

    //FUNCTIONAL
    public function printMe() {
        
    }

    //CHECKS
    //GETTERS

    public function getTitle() {
        return $this->title;
    }

    public function getTldr() {
        return $this->tldr;
    }

    public function getDate() {
        return $this->date;
    }

    public function getContent() {
        return $this->content;
    }

    public function getArticleID() {
        return $this->article_id;
    }

    public function getAuthorID() {
        return $this->author_id;
    }

    public function getAuthorName() {
        return $this->author_name;
    }

    public function getNumComments() {
        return $this->num_comments;
    }

    public function getNumViews() {
        return $this->num_views;
    }

    public function getUpVotes() {
        return $this->upVotes;
    }

    public function getDownVotes() {
        return $this->downVotes;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getTagNames() {
        return $this->tagArray;
    }
    
    public function getSourceArray(){
        return $this->sourceArray;
    }

    //SETTERS
    
    private function build($objectData, $tagArray = NULL, $sourceArray = NULL){
        $this->article_id = $objectData['article_id'];
        $this->author_id = $objectData['user_id'];
        $this->author_name = $objectData['username'];
        $this->content = $objectData['content'];
        $this->date = $objectData['datetime'];
        $this->downVotes = $objectData['downvotes'];
        $this->num_comments = $objectData['num_comments'];
        $this->num_views = $objectData['num_views'];
        $this->rating = $objectData['rating'];
        $this->title = $objectData['title'];
        $this->tldr = $objectData['tldr'];
        $this->upVotes = $objectData['upvotes'];
        
        if($tagArray != NULL){
            $this->addTags($tagArray);
        }
        
        if($sourceArray != NULL){
            $this->addSources($sourceArray);
        }
    }
    
    public function addTags($tagArray) {
        $this->tagArray = $tagArray;
    }
    
    public function addSources($sourceArray){
        $this->sourceArray = $sourceArray;
    }

}

?>
