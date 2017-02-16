<?php

namespace Services;

class SessionService {

    //REQUIRED

    public static function init() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['loggedIn'])) {
            $_SESSION['loggedIn'] = false;
        }
    }

    //FUNCTIONAL

    public static function destroy() {
        //unset($_SESSION stuff
        session_destroy();
    }

    //CHECKS

    public static function keyExists($key) {
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function feedSettingKeyExists($feed, $key) {
        if (isset($_SESSION['feed_' . $feed . '_settings'][$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function filterTagsExist($feed) {
        if (isset($_SESSION['filter_' . $feed . '_tags'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function filterTagExists($feed, $tag_id) {
        $ids = SessionService::getFilterTagIDs($feed);
        if (in_array($tag_id, $ids) == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //GETTERS

    public static function get($key) {
        return $_SESSION[$key];
    }

    public static function getNewArticleTags() {
        if (SessionService::keyExists('newArticleTags') == true) {
            return $_SESSION['newArticleTags'];
        } else {
            return FALSE;
        }
    }
    
    public static function getNewArticleSources(){
        if(SessionService::keyExists('newArticleSources') == true){
            return $_SESSION['newArticleSources'];
        } else {
            return FALSE;
        }
    }

    public static function getFeedSetting($feed, $key) {
        return $_SESSION['feed_' . $feed . '_settings'][$key];
    }

    public static function getFilterTagIDs($feed) {
        $ids = array();
        foreach ($_SESSION['filter_' . $feed . '_tags'] as $tag_array) {
            $ids[] = $tag_array['tag_id'];
        }

        return $ids;
    }

    public static function getFilterTagStrings($feed) {
        $strings = array();
        foreach ($_SESSION['filter_' . $feed . '_tags'] as $tag) {
            $strings[] = $tag['tag_name'];
        }
        return $strings;
    }

    public static function getFilterTags($feed) {
        return $_SESSION['filter_' . $feed . '_tags'];
    }

    //SETTERS

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function setNest($key, $value) {
        $_SESSION[$key][] = $value;
    }

    public static function setFilterTag($feed, $string, $id) {
        $array = array('tag_name' => $string, 'tag_id' => $id);
        $_SESSION['filter_' . $feed . '_tags'][] = $array;
    }

    public static function setNewArticleTag($tagObj) {
        if (!in_array($tagObj->getTagName(), $_SESSION['newArticleTags'])) {
            $_SESSION['newArticleTags'][$tagObj->getTagName()] = array('name'=>$tagObj->getTagName());
        }
    }
    
    public static function setNewArticleSource($sourceObj){
        if(!in_array($sourceObj->getUniqueID(), $_SESSION['newArticleSources'])){
            $_SESSION['newArticleSources'][$sourceObj->getUniqueID()] = array('display'=>$sourceObj->getDisplayName(), 'link'=> $sourceObj->getLink(), 'uniqueID'=>$sourceObj->getUniqueID());
        }
    }

    public static function clearNewArticleTags() {
        if (SessionService::keyExists('newArticleTags') == true) {
            unset($_SESSION['newArticleTags']);
        }
    }
    
    public static function clearNewArticleSources(){
        if(SessionService::keyExists('newArticleSources') == TRUE){
            unset($_SESSION['newArticleSources']);
        }
    }

    public static function removeNewArticleTag($value) {
        if (SessionService::keyExists('newArticleTags') == true) {
            unset($_SESSION['newArticleTags'][$value]);
        }
    }
    
    public static function removeNewArticleSource($uniqueID){
        if(SessionService::keyExists('newArticleSources') == TRUE && isset($_SESSION['newArticleSources'][$uniqueID])){
            unset($_SESSION['newArticleSources'][$uniqueID]);
        }
    }

    public static function removeFilterTag($feed, $tag_id) {
        if (SessionService::keyExists('filter_' . $feed . '_tags') == true) {
            foreach ($_SESSION['filter_' . $feed . '_tags'] as $tag_index => $tag_info) {
                if ($tag_info['tag_id'] == $tag_id) {
                    unset($_SESSION['filter_' . $feed . '_tags'][$tag_index]);
                }
            }
        }
        if (empty($_SESSION['filter_' . $feed . '_tags'])) {
            unset($_SESSION['filter_' . $feed . '_tags']);
        }
    }

    public static function setFeedSetting($feed, $key, $value) {
        $_SESSION['feed_' . $feed . '_settings'][$key] = $value;
    }

}

?>
