<?php
namespace Libs;

use Services\CallerSerivice;

class MapperLib{
    
    //REQUIRED
    
    function __construct() {
        $db = CallerSerivice::callClass('database','lib');
        $passDB = array('db'=>$db);
        $this->articleDB = CallerSerivice::callClass('Article','DAO',null,$passDB);
        $this->messageDB = CallerSerivice::callClass('Message','DAO',null,$passDB);
        $this->tagDB = CallerSerivice::callClass('Tag','DAO',null,$passDB);
        $this->userDB = CallerSerivice::callClass('User','DAO',null,$passDB);
        $this->groupDB = CallerSerivice::callClass('Group','DAO',null,$passDB);
        $this->voteDB = CallerSerivice::callClass('Votes','DAO',null,$passDB);
        $this->sourceDB = CallerSerivice::callClass('Source','DAO',null, $passDB);
    }
    
    //FUNCTIONAL
    //CHECKS
    //GETTERS
    //SETTERS
}
?>
