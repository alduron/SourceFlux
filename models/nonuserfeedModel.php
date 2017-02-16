<?php

namespace Models;

use Services\MapperService;
use Services\Factory\DomainObjectFactory;

class NonUserFeedModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('nonuserfeed');
    }

    private function updateTags($selected) {
        $tagIDArray = $this->mapper->getGroupTags($selected);
        foreach ($tagIDArray as $tagID) {
            $tagIDs[] = $tagID['tag_id'];
        }

        return $tagIDs;
    }

    //FUNCTIONAL
    //CHECKS

    private function hasResults($artIDs) {
        if (!empty($artIDs)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //GETTERS

    function xhrRunSelector() {
        $numResults = 50;
        $selected = $_POST['selected'];
        $feed = $_POST['feed'];
        $tagIDArray = $this->mapper->getGroupTags($selected);
        foreach ($tagIDArray as $tagID) {
            $tagIDs[] = $tagID['tag_id'];
        }
        $searchResults = $this->xhrLoadDefaultTiles($tagIDs, $numResults, $feed);

        return $searchResults;
    }

    public function getGroupArray() {
        $groupData = $this->getSelectorOptions();
        $groupObjArray = array();
        foreach ($groupData as $group) {
            $groupObjArray[] = DomainObjectFactory::getObject('group', $group);
        }
        return $groupObjArray;
    }

    public function getSelectorOptions() {
        $groupList = $this->mapper->getGroupList();
        return $groupList;
    }

    private function parseResults($artIDs, $numResults, $reverse = false) {
        $searchResults = array();
        $artIDs = array_slice($artIDs, 0, $numResults, TRUE);
        $endID = end($artIDs);
        
        if (!empty($endID)) {
            $this->mapper->setFeedSetting($this->feed, 'last_article', $endID['article_id']);
        }

        foreach ($artIDs as $artID) {
            $searchResults[] = DomainObjectFactory::getObject('tile', $this->mapper->getTileDataByID($artID['article_id']));
        }
        return $searchResults;
    }

    private function getLastArticle($feed) {
        $last_article = $this->mapper->getFeedSetting($feed, 'last_article');
        return $last_article;
    }

    private function getFirstArticle($feed) {
        $first_article = $this->mapper->getFeedSetting($feed, 'first_article');
        return $first_article;
    }

    private function getFeed() {
        $feed = $_POST['feed'];
        return $feed;
    }

    public function xhrLoadDefaultTiles($tagIDs, $numResults, $feed) {
        $this->feed = $feed;
        $numResults = 50;

        if ($tagIDs !== FALSE) {
            $artIDs = $this->mapper->searchDefaultArticlesByTagIDs($tagIDs);
            $searchResults = $this->parseResults($artIDs, $numResults);
        } else {
            $systemDefaultUserObject = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUserName(USER_FEED_DEFAULTS));

            $tagData = $this->mapper->getSystemTagsList($systemDefaultUserObject->getUserID());
            $systemDefaultUserObject->setTagLists($tagData);

            $artIDs = $this->mapper->searchDefaultArticlesByTagIDs($systemDefaultUserObject->getTagList($this->feed));
            $searchResults = $this->parseResults($artIDs, $numResults);
        }

        return $searchResults;
    }

    public function xhrAdvancePage() {
        $numResults = 50;
        $selected = $_POST['selected'];
        $this->feed = $this->getFeed();
        $last_article = $this->getLastArticle($this->feed);
        $tagIDs = $this->updateTags($selected);

        $artIDs = $this->mapper->searchMoreArticlesByTagIDs($tagIDs, $last_article);
        $searchResults = $this->parseResults($artIDs, $numResults);

        return $searchResults;
    }

    public function xhrReversePage() {
        $numResults = floor($_POST['height'] / 81);
        $this->feed = $this->getFeed();
        $first_article = $this->getFirstArticle($this->feed);
        $searchResults = array();

        $systemDefaultUserObject = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUserName(USER_SITE_FEED));
        $tagData = $this->mapper->getSystemTagsList($systemDefaultUserObject->getUserID());
        $systemDefaultUserObject->setTagLists($tagData);
        $tagIDs = $systemDefaultUserObject->getTagList($this->feed);

        $artIDs = $this->mapper->searchPrevArticlesByTagIDs($tagIDs, $first_article);
        $searchResults = $this->parseResults($artIDs, $numResults, true);

        if ($this->hasResults($artIDs) == FALSE) {
            $artIDs = $this->mapper->reSearchPageByTagIDs($tagIDs, $first_article);
            $searchResults = $this->parseResults($artIDs, $numResults);
        }
        return $searchResults;
    }

    //SETTERS
    public function setDefaults() {
        $this->mapper->setDefaults();
    }

}

?>