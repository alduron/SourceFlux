<?php

namespace Mappers;

use Libs\MapperLib;
use Services\SessionService;

class UserFeedMapper extends MapperLib {

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

    public function searchMoreArticlesByTagIDs($tagIDs, $last_article) {
        return $this->tagDB->searchMoreArticlesByTagIDs($tagIDs, $last_article);
    }

    public function reSearchPageByTagIDs($tagIDs, $first_article) {
        return $this->tagDB->reSearchPageByTagIDs($tagIDs, $first_article);
    }

    public function searchNextArticlesByTagIDs($tagIDs, $last_article) {
        return $this->tagDB->searchNextArticlesByTagIDs($tagIDs, $last_article);
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

    public function setFeedSetting($feed, $element, $data) {
        SessionService::setFeedSetting($feed, $element, $data);
    }

}

?>