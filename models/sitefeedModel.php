<?php

namespace Models;

use Services\MapperService;
use Services\Factory\DomainObjectFactory;

class SiteFeedModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('sitefeed');
    }

    //FUNCTIONAL

    private function parseResults($artIDs, $numResults) {
        $searchResults = array();
        $sliced = array_slice($artIDs, 0, $numResults, TRUE);
        $endID = end($sliced);
        if (!empty($endID)) {
            $this->mapper->setFeedSetting($this->feed, 'last_article', $endID['article_id']);
        }

        foreach ($sliced as $artID) {
            $searchResults[] = DomainObjectFactory::getObject('tile', $this->mapper->getTileDataByID($artID['article_id']));
        }
        return $searchResults;
    }

    //CHECKS

    private function hasResults($artIDs) {
        if (!empty($artIDs)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //GETTERS

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

    public function xhrLoadDefaultTiles() {
        $numResults = 50;
        $this->feed = $this->getFeed();

        $systemDefaultUserObject = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUserName(USER_SITE_FEED));

        $tagData = $this->mapper->getSystemTagsList($systemDefaultUserObject->getUserID());
        $systemDefaultUserObject->setTagLists($tagData);
        $parsedTags = $systemDefaultUserObject->getTagList(3);

        $artIDs = $this->mapper->searchDefaultArticlesByTagIDs($parsedTags);
        $searchResults = $this->parseResults($artIDs, $numResults);

        return $searchResults;
    }

    public function xhrAdvancePage() {
        $numResults = 50;
        $this->feed = $this->getFeed();
        $last_article = $this->getLastArticle($this->feed);

        $systemDefaultUserObject = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUserName(USER_SITE_FEED));
        $tagData = $this->mapper->getSystemTagsList($systemDefaultUserObject->getUserID());
        $systemDefaultUserObject->setTagLists($tagData);
        $tagIDs = $systemDefaultUserObject->getTagList($this->feed);
        $artIDs = $this->mapper->searchMoreArticlesByTagIDs($tagIDs, $last_article);

        $searchResults = $this->parseResults($artIDs, $numResults);

        return $searchResults;
    }

    //SETTERS
    public function setDefaults() {
        $this->mapper->setDefaults();
    }

}

?>