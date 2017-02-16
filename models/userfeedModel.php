<?php

namespace Models;

use Services\MapperService;
use Services\Factory\DomainObjectFactory;

class UserFeedModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('userfeed');
    }

    //FUNCTIONAL

    private function parseResults($artIDs, $numResults) {
        $searchResults = array();
        $sliced = array_slice($artIDs, 0, $numResults, TRUE);

        $endID = end($sliced);
        if (!empty($endID)) {
            $this->mapper->setFeedSetting($this->feed, 'last_article', $endID['article_id']);
        }

        foreach ($sliced as $art) {
            $searchResults[] = DomainObjectFactory::getObject('tile', $this->mapper->getTileDataByID($art['article_id']));
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

    private function updateTags($feed) {
        if ($this->mapper->filterTagsExist($feed) == TRUE) {
            $tagsList = $this->mapper->getFilterTags($feed);
            $tagIDs = array();

            foreach ($tagsList as $tag) {
                $tagIDs[] = $this->mapper->getTagIDByString($tag['tag_name']);
            }
        } else {
            $tagIDs = FALSE;
        }

        return $tagIDs;
    }

    private function getLastArticle($feed) {
        $last_article = $this->mapper->getFeedSetting($feed, 'last_article');
        return $last_article;
    }

//    private function getFirstArticle($feed) {
//        $first_article = $this->mapper->getFeedSetting($feed, 'first_article');
//        return $first_article;
//    }

    private function getFeed() {
        $feed = $_POST['feed'];
        return $feed;
    }

    public function xhrLoadDefaultTiles() {
        $numResults = 50;
        $this->feed = $this->getFeed();
        $tagIDs = $this->updateTags($this->feed);

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
        $this->feed = $this->getFeed();
        $last_article = $this->getLastArticle($this->feed);
        $searchResults = array();
        $tagIDs = $this->updateTags($this->feed);

        if ($tagIDs !== FALSE) {
            $artIDs = $this->mapper->searchMoreArticlesByTagIDs($tagIDs, $last_article);
            $searchResults = $this->parseResults($artIDs, $numResults);
        } else {
            $systemDefaultUserObject = DomainObjectFactory::getObject('user', $this->mapper->getUserDataByUserName(USER_FEED_DEFAULTS));

            $tagData = $this->mapper->getSystemTagsList($systemDefaultUserObject->getUserID());
            $systemDefaultUserObject->setTagLists($tagData);
            
            $artIDs = $this->mapper->searchMoreArticlesByTagIDs($systemDefaultUserObject->getTagList($this->feed), $last_article);

            $searchResults = $this->parseResults($artIDs, $numResults);
        }

        return $searchResults;
    }

    //SETTERS
}

?>