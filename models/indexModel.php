<?php

namespace Models;

use Services\SessionService;

class IndexModel {
    
    //VARIABLES

    private $feedType;
    private $dataOnly;
    private $siteFeed;
    
    //REQUIRED
    function __construct() {
        $this->dataOnly = FALSE;
    }

    //FUNCTIONAL

    public function pageLoad() {
        if (SessionService::get('loggedIn') == false) {
            $this->feedType = 'nonUserFeed';
        }
        if (SessionService::get('loggedIn') == true) {
            $this->feedType = 'userFeed';
        }
        $this->siteFeed = TRUE;
    }

    //CHECKS

    public function isDataOnly() {
        return $this->dataOnly;
    }

    //GETTERS

    public function getFeedType() {
        return $this->feedType;
    }

    public function getFeed($feedNum) {
        if ($feedNum === '::SITE::') {
            return $this->siteFeed;
        } else {
            $feedName = 'feed' . $feedNum;
            return $this->$feedName;
        }
    }

    public function getDB() {
        return $this->db;
    }

    //SETTERS

    public function setFeed($feed, $feedData) {
        if ($feed === '::SITE::') {
            $this->siteFeed = $feedData;
        } else {
            $feedString = 'feed' . $feed;
            $this->$feedString = $feedData;
        }
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

