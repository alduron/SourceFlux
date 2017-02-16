<?php

namespace Daos;

use Services\SessionService;
use PDO;

class UserDAO {

    //REQUIRED

    public function __construct($data) {
        if (is_array($data)) {
            $this->db = $data['db'];
        } else {
            $this->db = $data;
        }
    }

    //FUNCTIONAL

    //CHECKS

    public function checkForUserByUsername($username) {
        $usernameh = $this->db->prepare("
            SELECT username FROM users 
            WHERE username = :username");
        $usernameh->execute(array(':username' => $username));

        $count = $usernameh->rowCount();
        if ($count > 0) {
            SessionService::set('loginExist', true);
            return true;
        } else {
            SessionService::set('loginExist', false);
            return false;
        }
    }

    public function getUserDataByCredentials($username, $password) {
        $sth = $this->db->prepare("
            SELECT user_id 
            FROM users 
            WHERE username = :username AND password = MD5(:password)");
        $sth->execute(array(':username' => $username, ':password' => $password));
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sth->fetch();

        return $data;
    }

    public function getUserDataByUserName($username) {
        $userH = $this->db->prepare("
            SELECT user_id,username,email,verification_number,verified,join_date,role
            FROM users
            WHERE username LIKE :username"
        );
        $userH->execute(array(':username' => $username));
        $userH->setFetchMode(PDO::FETCH_ASSOC);
        $data = $userH->fetchAll();

        return $data;
    }

    public function validateCredentials($username, $password) {
        $sth = $this->db->prepare("
            SELECT user_id 
            FROM users 
            WHERE username = :username AND password = MD5(:password)");
        $sth->execute(array(':username' => $username, ':password' => $password));

        $count = $sth->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkForTagByUserIDAndTagString($user_id, $tag_name) {
        $sth = $this->db->prepare("
            SELECT user_tags_id 
            FROM user_tags 
            INNER JOIN tags ON user_tags.tag_id = tags.tag_id 
            WHERE tags.tag_name = :tag_name AND user_tags.user_id = :user_id");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':tag_name' => $tag_name, ':user_id' => $user_id));

        $count = $sth->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkForStoredTags($user_id, $feed) {
        $sth = $this->db->prepare("
            SELECT user_tags_id 
            FROM user_tags 
            WHERE feed = :feed AND user_tags.user_id = :user_id");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':feed' => $feed, ':user_id' => $user_id));

        $count = $sth->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //GETTERS

    public function getSystemTagsByUserID($userID) {
        $tagH = $this->db->prepare('
            SELECT users.user_id, tag_id, feed
            FROM users INNER JOIN user_tags ON users.user_id = user_tags.user_id
            WHERE users.user_id = :user_id');
        $tagH->execute(array(':user_id' => $userID));
        $tagH->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tagH->fetchAll();

        return $data;
    }

    public function getUsersTagsByIDAndFeed($user_id, $feed) {
        $sth = $this->db->prepare('
            SELECT tag_id, tag_name 
            FROM user_tags 
            INNER JOIN tags ON user_tags.tag_id = tags.tag_id 
            WHERE user_id = :user_id AND feed = :feed');
        $sth->execute(array(':user_id' => $user_id, ':feed' => $feed));
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sth->fetchAll();

        return $data;
    }

    public function getPasswordAuthentication($username) {
        $sth = $this->db->prepare('
            SELECT password_authentication 
            FROM users
            WHERE username LIKE :username');
        $sth->execute(array(':username' => $username));
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sth->fetchAll();

        return $data;
    }

    //retrieve the username given the ID of the row
    public function getUsernameByID($id) {
        
    }

    //retrieve the user ID given the username
    public function getUserIDByUsername($username) {
        
    }

    //retrieve the users email by user ID
    public function getEmailByID($id) {
        
    }

    //retrieve the list of articles that the user has posted by user ID
    public function getUserArticlesByID($id) {
        
    }

    //SETTERS

    //set the username given a string
    public function setUsernameByString($username) {
        
    }

    public function setUserVerified($username) {
        $sth = $this->db->prepare("
            UPDATE users 
            SET verified = 1
            WHERE username = :username");
        $sth->execute(array(':username' => $username));
    }

    public function nullVerificationNumber($username) {
        $sth = $this->db->prepare("
            UPDATE users 
            SET verification_number = NULL
            WHERE username = :username");
        $sth->execute(array(':username' => $username));
    }

    public function setUserTag($user_id, $tag_id, $feed) {
        $sth = $this->db->prepare("
            INSERT INTO user_tags (user_id,tag_id,feed) 
            VALUES (:user_id,:tag_id,:feed)");
        $sth->execute(array(':user_id' => $user_id, ':tag_id' => $tag_id, ':feed' => $feed));
    }

    public function addArtIDToUser($newArtID) {
        $sth = $this->db->prepare("
            INSERT INTO user_articles (user_id,article_id) 
            VALUES (:user_id,:article_id)");
        $sth->execute(array(':user_id' => $_SESSION['user_id'], ':article_id' => $newArtID));
    }

    public function createUser($username, $password, $verification, $email) {
        $sth = $this->db->prepare("
            INSERT INTO users (role,verification_number,username,password,email,join_date) 
            VALUES ('user',:verification,:username,:password,:email,NOW())");
        $sth->execute(array(':verification' => $verification, ':username' => $username, ':password' => $password, ':email' => $email));
    }

    public function createPasswordAuthentication($username, $authentication) {
        $sth = $this->db->prepare("
            UPDATE users
            SET password_authentication = :password_authentication
            WHERE username = :username");
        $sth->execute(array(':password_authentication' => $authentication, ':username' => $username));
    }

    public function updatePassword($username, $password) {
        $sth = $this->db->prepare("
            UPDATE users
            SET password = :password
            WHERE username = :username");
        $sth->execute(array(':password' => $password, ':username' => $username));
    }

    /* UNSETTERS */

    public function removeTagsFromUser() {
        
    }

    public function removeAuthentication($username) {
        $sth = $this->db->prepare("
            UPDATE users
            SET password_authentication = NULL
            WHERE username = :username");
        $sth->execute(array(':username' => $username));
    }

}

?>
