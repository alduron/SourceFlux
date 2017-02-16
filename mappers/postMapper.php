<?php

namespace Mappers;

use Services\SessionService;
use Libs\MapperLib;

class PostMapper extends MapperLib {

    //REQUIRED

    function __construct() {
        parent::__construct();
    }

    //FUNCTIONAL
    //CHECKS

    public function articleHasSources($article_id) {
        return $this->sourceDB->checkForSources($article_id);
    }

    public function tagExists($tag_name) {
        return $this->tagDB->checkTagByString($tag_name);
    }

    public function SessionHasTags() {
        $tags = SessionService::getNewArticleTags();
        if (empty($tags)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //GETTERS

    public function getSessionTags() {
        return SessionService::getNewArticleTags();
    }

    public function getTagsLike($search_term) {
        return $this->tagDB->getTagsLike($search_term);
    }

    public function getSourcesForArticle($article_id) {
        return $this->sourceDB->getSources($article_id);
    }

    public function getSessionSources() {
        return SessionService::getNewArticleSources();
    }

    //SETTERS

    public function setTagInDB($tag_name) {
        return $this->tagDB->setTagInDB($tag_name);
    }

    public function addTagToSession($tagObj) {
        SessionService::setNewArticleTag($tagObj);
    }

    public function removeTagFromSession($tag_name) {
        SessionService::removeNewArticleTag($tag_name);
    }

    public function clearNewArticleTags() {
        SessionService::clearNewArticleTags();
    }
    
    public function clearNewArticleSources(){
        SessionService::clearNewArticleSources();
    }

    public function setArticle($pageData) {
        return $this->articleDB->setArticle($pageData);
    }

    public function addArtIDToUser($articleID) {
        $this->userDB->addArtIDToUser($articleID);
    }

    public function attachTagToArt($tags, $id) {
        foreach ($tags as $tag) {
            $this->tagDB->attachTagToArt($tag->getTagName(), $id);
        }
    }

    public function attachSourcestoArt($sourceObjs, $articleID) {
        foreach ($sourceObjs as $sourceObj){
            $this->sourceDB->setSource($articleID, $sourceObj->getDisplayName(), $sourceObj->getLink());
        }
    }

    public function addTagsToTagsDB($tags) {
        foreach ($tags as $tag) {
            if (!$this->tagExists($tag->getTagName())) {
                $this->tagDB->addTagByString($tag->getTagName());
            }
        }
    }

    public function addSourceToSession($sourceObj) {
        SessionService::setNewArticleSource($sourceObj);
    }

    public function removeSourceFromSession($uniqueID) {
        SessionService::removeNewArticleSource($uniqueID);
    }

    public function addSourceToArticle($sourceObj) {
        return $this->sourceDB->setSource($sourceObj->getArticleID(), $sourceObj->getDisplayName(), $sourceObj->getLink());
    }

    public function removeSourceFromDB($sourceObj) {
        $this->sourceDB->removeSource($sourceObj->getArticleID(), $sourceObj->getSourceID());
    }

}

?>