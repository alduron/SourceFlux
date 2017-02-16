<?php

namespace Models;

use Services\MapperService;
use Services\Factory\DomainObjectFactory;
use Services\InputService;

class PostModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('post');
        $this->input = new InputService();
    }

    //FUNCTIONAL

    public function createSource($display_name = NULL, $link = NULL) {
        if ($display_name === NULL || $link === NULL) {
            $sourceObj = DomainObjectFactory::getObject('source');
        } else {
            $sourceObj = DomainObjectFactory::getObject('source');
            $sourceObj->build($display_name, $link);
        }
        return $sourceObj;
    }

    public function createTag($tag_name = NULL) {
        if ($tag_name === NULL) {
            $tagObj = DomainObjectFactory::getObject('tag');
        } else {
            $tagObj = DomainObjectFactory::getObject('tag');
            $tagObj->build($tag_name);
        }
        return $tagObj;
    }

    //CHECKS
    //GETTERS

    private function buildSubmitData() {
        //grab all the data from the submit post page and return assoc array
        $pageData['tldr'] = $_POST['tldr'];
        $pageData['body'] = $_POST['body'];
        $pageData['title'] = $_POST['title'];
        $tags = $this->mapper->getSessionTags();
        $sources = $this->mapper->getSessionSources();

        $tagObjs = array();
        foreach ($tags as $key => $value) {
            $tagObjs[] = $this->createTag($value['name']);
        }
        $pageData['tags'] = $tagObjs;

        $sourceObjs = array();
        foreach ($sources as $source) {
            $sourceObj = $this->createSource($source['display'], $source['link']);
            $sourceObjs[] = $sourceObj;
        }
        $pageData['sources'] = $sourceObjs;
        //get tags from session

        return $pageData;
    }

    public function xhrSearchTags() {
        if ($this->input->checkTag($_POST['search_term'])) {
            $search_term = $_POST['search_term'];
            $data = $this->mapper->getTagsLike($search_term);
            foreach ($data as $tag) {
                $results[] = $tag['tag_name'];
            }
        } else {
            $results = false;
        }

        return json_encode($results);
    }

    //SETTERS
//    public function submitArticle() {
//        //get data from getSubmitData and process it
//        $pageData = $this->getSubmitData();
//        $this->setArticle($pageData);
//        $this->mapper->clearNewArticleTags();
//        return $pageData['title'];
//    }
//    public function xhrAddTagToDB() {
//        //get tag from post and condition it
//
//        $result = $this->mapper->setTagInDB($tag_name);
//
//        $data = json_encode($result);
//        return $data;
//    }

    public function xhrRemoveTagFromSession() {
        $tag_name = $_POST['tag_name'];
        $value = ucfirst($tag_name);
        $this->mapper->removeNewArticleTag($value);
    }

    public function xhrClearNewArticleTags() {
        $this->mapper->clearNewArticleTags();
    }

    private function setArticle($pageData) {
        $articleID = $this->mapper->setArticle($pageData);
        $this->mapper->addArtIDToUser($articleID);
        $this->mapper->addTagsToTagsDB($pageData['tags']);
        $this->mapper->attachSourcestoArt($pageData['sources'], $articleID);
        $this->mapper->attachTagToArt($pageData['tags'], $articleID);
        return $articleID;
    }

    public function xhrSubmit() {
        $isValid = TRUE;
        $return = array();

        if (!$this->input->checkTitle($_POST['title'])) {
            $isValid = FALSE;
            $return['title'] = false;
        }

        if (!$this->input->checkContent($_POST['body'])) {
            $isValid = FALSE;
            $return['body'] = false;
        }

        if (!$this->input->checkTldr($_POST['tldr'])) {
            $isValid = FALSE;
            $return['tldr'] = false;
        }

        if (!$this->mapper->SessionHasTags()) {
            $isValid = FALSE;
            $return['tags'] = false;
        }

        if ($isValid === true) {
            $pageData = $this->buildSubmitData();
            $articleID = $this->setArticle($pageData);
            $articleTitle = str_replace(' ', '-', $pageData['title']);
            $return['isurl'] = TRUE;
            $return['url'] = URL . 'article/view/' . $articleTitle . '&id=' . $articleID;
            $this->mapper->clearNewArticleTags();
            $this->mapper->clearNewArticleSources();
        } 
        return json_encode($return);
    }

    public function xhrAddTag() {
        $isValid = TRUE;
        $return = array();

        if (!$this->input->checkTag($_POST['tag_name'])) {
            $isValid = FALSE;
            $return['result'] = FALSE;
        }

        if ($isValid) {
            $tag_name = ucfirst($_POST['tag_name']);
            $tagObj = $this->createTag($tag_name);
            $this->mapper->addTagToSession($tagObj);
            $return['result'] = TRUE;
        }
        $data = json_encode($return);
        return $data;
    }

    public function xhrAddSource() {
        $isValid = TRUE;
        $return = array();

        if (!$this->input->checkDisplayName($_POST['display'])) {
            $isValid = FALSE;
            $return['display'] = FALSE;
        }

        if (!$this->input->checkLink($_POST['link'])) {
            $isValid = FALSE;
            $return['link'] = FALSE;
        }

        if ($isValid) {
            $display_name = $_POST['display'];
            $link = $_POST['link'];
            $sourceObj = $this->createSource($display_name, $link);
            $this->mapper->addSourceToSession($sourceObj);
            $return['display'] = TRUE;
            $return['link'] = TRUE;
        }
        $data = json_encode($return);
        return $data;
    }

    public function xhrRemoveSource() {
        $uniqueID = $_POST['uniqueID'];
        $this->mapper->removeSourceFromSession($uniqueID);
    }

    public function xhrRemoveTag() {
        $tagName = $_POST['tag_name'];
        $this->mapper->removeTagFromSession($tagName);
    }

    public function xhrLoadSources() {
        $sourceObjs = array();
        $sources = $this->mapper->getSessionSources();
        if (!empty($sources)) {
            foreach ($sources as $source) {
                $sourceObjs[] = $this->createSource($source['display'], $source['link']);
            }
        } else {
            $sourceObjs[] = DomainObjectFactory::getObject('source');
        }
        return $sourceObjs;
    }

    public function xhrLoadTags() {
        $tagObjs = array();
        $tags = $this->mapper->getSessionTags();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $tagObjs[] = $this->createTag($tag['name']);
            }
        } else {
            $tagObjs[] = DomainObjectFactory::getObject('tag');
        }
        return $tagObjs;
    }

}

?>