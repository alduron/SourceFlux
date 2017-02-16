<?php

namespace Models;

use Services\SessionService;
use Services\MapperService;
use Services\InputService;
use Services\Factory\DomainObjectFactory;

class FilterModel {

    //REQUIRED

    function __construct() {
        $this->mapper = MapperService::getMapper('filter');
        $this->input = new InputService();
    }

    //FUNCTIONAL
    //CHECKS

    private function checkForStoredTags($user_id, $feed) {
        $result = $this->mapper->checkForStoredTags($user_id, $feed);
        return $result;
    }

    public function checkTag($tag_name) {
        $result = $this->mapper->checkTagByString($tag_name);
        return $result;
    }

    private function userHasTag($tag_name_a, $user_id) {
        $tag_name = $tag_name_a['tag_name'];
        $result = $this->mapper->checkForTagByUserIDAndTagString($user_id, $tag_name);

        return $result;
    }

    //GETTERS

    public function xhrLoadTags() {
        $feed = $this->getFeed();
        $user_id = SessionService::get('user_id');
        $tagObjectArray = array();

        if ($this->mapper->filterTagsExist($feed) == FALSE) {
            if ($this->checkForStoredTags($user_id, $feed) == TRUE) {
                $data = $this->tagsFromDB($user_id, $feed);
            } else {
                $data = NULL;
            }
        } else {
            $data = $this->mapper->getFilterTags($feed);
        }

        if ($data != NULL) {
            foreach ($data as $tagData) {
                $tagObjectArray[] = DomainObjectFactory::getObject('tag', $tagData);
            }
        } else {
            $tagObjectArray[] = DomainObjectFactory::getObject('tag', $data);
        }

        return $tagObjectArray;
    }

    private function tagsFromDB($user_id, $feed) {
        $data = $this->mapper->getUsersTagsByIDAndFeed($user_id, $feed);

        foreach ($data as $data) {
            $this->mapper->setFilterTag($feed, $string, $id);
        }

        return $data;
    }

    public function getFeed() {
        $feed = $_POST['feed'];
        return $feed;
    }

    //SETTERS


    function xhrSetTag() {
        $isValid = true;
        $return = array();

        if ($this->input->checkFeed($this->getFeed())) {
            $feed = $this->getFeed();
        } else {
            $isValid = false;
        }

        if ($this->input->checkTag($_POST['tag_' . $feed])) {
            $tag = $_POST['tag_' . $feed];
        } else {
            $isValid = false;
        }

        if ($isValid == true) {
            if ($this->checkTag($tag) == true) {
                $tag_id = $this->mapper->getTagIDByString($tag);
                if ($this->mapper->filterTagsExist($feed) == TRUE) {
                    if ($this->mapper->filterTagExists($feed, $tag_id) == FALSE) {
                        $this->mapper->setFilterTag($feed, $tag, $tag_id);
                    }
                } else {
                    $this->mapper->setFilterTag($feed, $tag, $tag_id);
                }
                $this->mapper->setFeedSetting($feed, 'first_article', 0);
                $this->mapper->setFeedSetting($feed, 'last_article', 0);
            } else {
                $isValid = false;
            }
        }
        
        $return['isValid'] = $isValid;
        return json_encode($return);
    }

    public function xhrSaveTags() {
        $user_id = $this->mapper->get('user_id');
        $feed = $this->getFeed();
        $tags = $this->mapper->get('feed_tags_' . $feed);


        foreach ($tags as $tag) {
            if ($this->userHasTag($tag, $user_id) == false) {
                $tag_name = $tag['tag_name'];
                $tag_id = $this->mapper->getTagIDByString($tag_name);

                $this->mapper->setUserTag($user_id, $tag_id, $feed);
            }
        }
    }

    public function xhrRemoveTags() {
        $feed = $this->getFeed();
        if (isset($_POST['tags'])) {
            $rTags = $_POST['tags'];

            foreach ($rTags as $tag_id) {
                if ($this->mapper->filterTagExists($feed, $tag_id) == TRUE) {
                    $this->mapper->removeFilterTag($feed, $tag_id);
                }
            }

            //TODO::WRITE CODE TO DELETE FEED TAG LIST FROM THE USER TAGS DATABASE (FILTERMODEL.PHP)
            $this->mapper->setFeedSetting($feed, 'last_article', 0);
        }
    }

}

?>
