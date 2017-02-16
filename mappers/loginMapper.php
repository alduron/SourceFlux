<?php

namespace Mappers;

use Libs\MapperLib;
use Services\SessionService;

class LoginMapper extends MapperLib {
    
    //REQUIRED

    function __construct() {
        parent::__construct();
    }
    
    //FUNCTIONAL
    //CHECKS

    public function userCheck($username) {
        $result = $this->userDB->checkForUserByUsername($username);
        return $result;
    }

    public function validateCredentials($username, $password) {
        return $this->userDB->validateCredentials($username, $password);
    }
    
    //GETTERS

    public function getUserDataByCredentials($username, $password) {
        return $this->userDB->getUserDataByCredentials($username, $password);
    }
    
    //SETTERS

    public function setSessionData($username, $userdata) {
        SessionService::set('loggedIn', true);
        SessionService::set('username', $username);
        SessionService::set('user_id', $userdata['user_id']);
    }

    public function setDefaults() {
        $feeds = array(1, 2);
        foreach ($feeds as $feed) {
            if ((SessionService::feedSettingKeyExists($feed, 'last_article') == false)) {
                SessionService::setFeedSetting($feed, 'last_article', 0);
            }
        }
    }
}

?>
