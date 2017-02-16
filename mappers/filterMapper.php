<?php

namespace Mappers;

use Libs\MapperLib;
use Services\SessionService;

class FilterMapper extends MapperLib {

    //REQURIED
    function __construct() {
        parent::__construct();
    }

    //FUNCTIONAL
    //CHECKS

    public function checkForStoredTags($user_id, $feed) {
        return $this->userDB->checkForStoredTags($user_id, $feed);
    }

    public function checkTagByString($tag_name) {
        return $this->tagDB->checkTagByString($tag_name);
    }

    public function checkForTagByUserIDAndTagString($user_id, $tag_name) {
        return $this->userDB->checkForTagByUserIDAndTagString($user_id, $tag_name);
    }

    public function filterTagsExist($feed) {
        return SessionService::filterTagsExist($feed);
    }

    //GETTERS

    public function getFilterTags($feed) {
        return SessionService::getFilterTags($feed);
    }

    public function getUsersTagsByIDAndFeed($user_id, $feed) {
        return $this->userDB->getUsersTagsByIDAndFeed($user_id, $feed);
    }

    public function getTagIDByString($tag) {
        return $this->tagDB->getTagIDByString($tag);
    }

    public function get($value) {
        return SessionService::get($value);
    }

    //SETTERS

    public function setFilterTag($feed, $string, $id) {
        SessionService::setFilterTag($feed, $string, $id);
    }

    public function filterTagExists($feed, $tag_id) {
        return SessionService::filterTagExists($feed, $tag_id);
    }

    public function setFeedSetting($feed, $position, $value) {
        SessionService::setFeedSetting($feed, $position, $value);
    }

    public function setUserTag($user_id, $tag_id, $feed) {
        $this->userDB->setUserTag($user_id, $tag_id, $feed);
    }

    public function removeFilterTag($feed, $tag_id) {
        SessionService::removeFilterTag($feed, $tag_id);
    }

}

?>
