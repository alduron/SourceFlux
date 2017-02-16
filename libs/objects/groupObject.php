<?php

namespace Objects;

class GroupObject {

    //VARIABLES
    private $group_name;
    private $group_id;

    //REQUIRED

    function __construct($objectData) {
            $this->group_id = $objectData['feed_group_id'];
            $this->group_name = $objectData['name'];
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS

    public function getGroupID() {
        return $this->group_id;
    }

    public function getGroupName() {
        return $this->group_name;
    }

    //SETTERS
}

?>
