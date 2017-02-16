<?php

namespace Controllers;

use Services\InputService;

Class ValidationController {
    
    //REQUIRED

    function __construct() {
        
    }

    public function index() {
        header('location: ' . URL);
        exit();
    }
    
    //FUNCTIONAL
    //CHECKS

    public function xhrFieldCheck($type,$data) {
        $validater = new InputService();
        return $validater->{'check'.$type}($data);
    }
    
    //GETTERS
    //SETTERS

}

?>
