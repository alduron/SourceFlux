<?php

namespace Objects;

class SourceObject {

//VARIABLES
    private $source_id;
    private $display_name;
    private $link;
    private $article_id;
    private $hasLink;
    private $unique_id;

//REQUIRED

    function __construct($objectData) {
        if ($objectData !== '::DEFAULT::') {
            $this->hasLink = TRUE;
            $this->source_id = $objectData['article_sources_id'];
            $this->display_name = $objectData['display_name'];
            $this->link = $this->formatLink($objectData['link']);
            $this->article_id = $objectData['article_id'];
            $this->unique_id = $this->createUniqueID();
        } else {
            $this->hasLink = FALSE;
        }
    }

//FUNCTIONAL

    private function formatLink($rawLink) {
        if (strpos($rawLink, 'http://') !== FALSE || strpos($rawLink, 'https://') !== FALSE) {
            return $rawLink;
        } else {
            return 'http://' . $rawLink;
        }
    }
    
    
    private function createUniqueID() {
        return md5($this->display_name . $this->link);
    }

//CHECKS

    public function hasLink() {
        return $this->hasLink;
    }

//GETTERS

    public function getarticleID() {
        return $this->article_id;
    }

    public function getDisplayName() {
        return $this->display_name;
    }

    public function getLink() {
        return $this->link;
    }

    public function getSourceID() {
        return $this->source_id;
    }
    
    public function getUniqueID(){
        return $this->unique_id;
    }

//SETTERS

    public function build($display_name, $link) {
        $this->hasLink = TRUE;
        $this->display_name = $display_name;
        $this->link = $this->formatLink($link);
        $this->unique_id = $this->createUniqueID();
    }

}

?>
