<?php

namespace Mappers;

use Services\SessionService;
use Libs\MapperLib;

class SiteFeedMapper extends MapperLib {

    //REQUIRED

    function __construct() {
        parent::__construct();
    }

    //FUNCTIONAL
    //CHECKS

    public function filterTagsExist($feed) {
        return SessionService::filterTagsExist($feed);
    }

    //GETTERS

    public function getTileDataByID($artID) {
        return $this->articleDB->getTileDataByID($artID);
    }

    public function getFilterTags($feed) {
        return SessionService::getFilterTags($feed);
    }

    public function getTagIDByString($tagName) {
        return $this->tagDB->getTagIDByString($tagName);
    }

    public function searchDefaultArticlesByTagIDs($tagIDs) {
        return $this->tagDB->searchDefaultArticlesByTagIDs($tagIDs);
    }

    public function reSearchPageByTagIDs($tagIDs, $first_article) {
        return $this->tagDB->reSearchPageByTagIDs($tagIDs, $first_article);
    }

    public function searchMoreArticlesByTagIDs($tagIDs, $last_article) {
        return $this->tagDB->searchMoreArticlesByTagIDs($tagIDs, $last_article);
    }

    public function searchPrevArticlesByTagIDs($tagIDs, $first_article) {
        return $this->tagDB->searchPrevArticlesByTagIDs($tagIDs, $first_article);
    }

    public function getFeedSetting($feed, $element) {
        return SessionService::getFeedSetting($feed, $element);
    }

    public function getSystemTagsList($userID) {
        return $this->userDB->getSystemTagsByUserID($userID);
    }

    public function getUserDataByUserName($userName) {
        return $this->userDB->getUserDataByUserName($userName);
    }

    //SETTERS

    public function setDefaults() {
        $feed = 3;
        if ((SessionService::feedSettingKeyExists($feed, 'last_article') == false)) {
            SessionService::setFeedSetting($feed, 'last_article', 0);
        }
    }

    public function setFeedSetting($feed, $element, $data) {
        SessionService::setFeedSetting($feed, $element, $data);
    }

}

?>
