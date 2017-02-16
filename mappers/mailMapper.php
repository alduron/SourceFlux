<?php

namespace Mappers;
use Libs\MapperLib;

class MailMapper extends MapperLib{
    
    //REQUIRED
    
    function __construct() {
        parent::__construct();
    }
    
    //FUNCTIONAL
    //CHECKS
    //GETTERS
    
    public function getUserData(){
        return $this->userDB->getUserDataByUsername('alduron');
    }
    
    //SETTERS
}
?>
