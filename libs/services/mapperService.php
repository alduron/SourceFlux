<?php

namespace Services;

use Services\IncluderService;
use Services\CallerSerivice;

class MapperService {

    //REQUIRED
    function __construct() {
        
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS

    public function getMapper($name) {
        IncluderService::requireFile('mapper', 'lib');
        $mapper = CallerSerivice::callClass($name, 'mapper');
        return $mapper;
    }

    //SETTERS
}

?>
