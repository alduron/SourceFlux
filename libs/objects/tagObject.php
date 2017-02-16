<?php

namespace Objects;

class TagObject {

//VARIABLES
    private $tag_name;
    private $tag_id;
    private $hasTag;

//REQUIRED

    function __construct($objectData) {
        if ($objectData !== '::DEFAULT::') {
            $this->hasTag = TRUE;
            $this->tag_id = $objectData['tag_id'];
            $this->tag_name = $objectData['tag_name'];
        } else {
            $this->hasTag = FALSE;
        }
    }

//FUNCTIONAL
//CHECKS

    public function hasTag() {
        return $this->hasTag;
    }

//GETTERS

    public function getTagID() {
        return $this->tag_id;
    }

    public function getTagName() {
        return $this->tag_name;
    }

//SETTERS

    public function build($tag_name) {
        $this->hasTag = TRUE;
        $this->tag_name = $tag_name;
    }

}

?>
