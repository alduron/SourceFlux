<?php

namespace Services\Factory;

use Services\CallerSerivice;

class DomainObjectFactory {

//REQUIRED

    function __construct() {
    }

//FUNCTIONAL
//CHECKS
//GETTERS

    public function getObject($type, $data = NULL) {
        
        if ($data === NULL) {
            $data = '::DEFAULT::';
        }
        $class = CallerSerivice::callClass($type, 'object', NULL, $data);
        return $class;
    }

}

?>
