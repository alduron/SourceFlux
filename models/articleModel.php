<?php

namespace Models;

use Services\MapperService;
use Services\SessionService;
use Services\Factory\DomainObjectFactory;

class ArticleModel {

    //REQUIRED
    function __construct() {
        $this->mapper = MapperService::getMapper('article');
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS

    public function getArticleData() {
        $articleInfo = $_GET['id'];

        $articleData = $this->mapper->getData($articleInfo);
        $this->mapper->incrementViews($articleInfo);
        $tagData = $this->mapper->getTagArray($articleInfo);
        $sourceArray = $this->mapper->getSourceArray($articleInfo);

        if (empty($articleData)) {
            $articleData = '!NULL!';
        } else {
            $articleData = DomainObjectFactory::getObject('article', $articleData);
            $articleData->addTags($tagData);
            $articleData->addSources($sourceArray);
        }
        return $articleData;
    }

    public function addCommentIDs($articleData) {
        $parentIDs = $this->mapper->getArtComments($articleData['article_id']);
        $articleData['parent_ids'] = $parentIDs;
        return $articleData;
    }

    //SETTERS

    public function xhrUpvote($articleID) {
        $userObj = $this->mapper->getUserData(SessionService::get('username'));
        $result = $this->mapper->setUpvote($userObj->getUserID(), $articleID);
    }

    public function xhrDownvote($articleID) {
        $userObj = $this->mapper->getUserData(SessionService::get('username'));
        $result = $this->mapper->setDownvote($userObj->getUserID(), $articleID);
    }

}

?>
