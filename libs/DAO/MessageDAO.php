<?php

namespace Daos;

use PDO;

class MessageDAO {

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

    public function checkForChildren($article_id) {
        $childCheckH = $this->db->prepare("
          select comment_message_id,message_id
          FROM comment_messages
          WHERE parent_id = :article_id
        ");
        $childCheckH->execute(array(':article_id' => $article_id));
        $count = $childCheckH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //GETTERS

    public function getIDsByTimeDescending() {
        $timeIDH = $this->db->prepare("
            SELECT comment_messages.comment_message_id
            FROM comment_messages 
            INNER JOIN messages ON comment_messages.message_id = messages.message_id
            ORDER BY messages.datetime DESC");
        $timeIDH->execute(array(':article_id' => $article_id));
        $timeIDH->setFetchMode(PDO::FETCH_ASSOC);
        $timeIDs = $timeIDH->fetch();
        return $timeIDs;
    }

    public function getParentIDsForArticle($article_id) {
        $parentIDH = $this->db->prepare("
            SELECT comment_messages.comment_message_id, comment_messages.message_id
            FROM comment_messages
            WHERE article_id = :article_id AND parent_id IS NULL");
        $parentIDH->execute(array(':article_id' => $article_id));
        $parentIDH->setFetchMode(PDO::FETCH_ASSOC);
        $parentIDs = $parentIDH->fetchAll();
        return $parentIDs;
    }

    public function getCommentsForArticle($article_id) {
        $commentH = $this->db->prepare("
            SELECT
                comment_messages.comment_message_id, 
                comment_messages.message_id, 
                comment_messages.article_id, 
                comment_messages.from_user_id, 
                comment_messages.parent_id, 
                messages.content, 
                messages.datetime, 
                messages.rating
            FROM comment_messages RIGHT JOIN messages on comment_messages.message_id = messages.message_id
            WHERE article_id = :article_id
            ORDER BY comment_messages.parent_id");
        $commentH->execute(array(':article_id' => $article_id));
        $commentH->setFetchMode(PDO::FETCH_ASSOC);
        $commentIDs = $commentH->fetchAll();
        return $commentIDs;
    }

    public function getParentCommentsForArticleBeforeID($article_id, $comment_message_id) {
        $commentH = $this->db->prepare("
            SELECT
                users.username,
                comment_messages.comment_message_id, 
                comment_messages.message_id, 
                comment_messages.article_id, 
                comment_messages.from_user_id, 
                comment_messages.parent_id, 
                messages.content, 
                messages.datetime, 
                messages.rating
                FROM comment_messages 
                RIGHT JOIN messages on comment_messages.message_id = messages.message_id 
                INNER JOIN users ON users.user_id = comment_messages.from_user_id
                WHERE comment_messages.article_id = :article_id AND comment_messages.parent_id IS NULL AND comment_messages.comment_message_id < :comment_message_id
                ORDER BY comment_messages.parent_id
                LIMIT 10");
        $commentH->execute(array(':article_id' => $article_id, ':comment_message_id' => $comment_message_id));
        $commentH->setFetchMode(PDO::FETCH_ASSOC);
        $commentIDs = $commentH->fetchAll();
        return $commentIDs;
    }

    public function getParentCommentsForArticleAfterID($article_id, $comment_message_id) {
        $commentH = $this->db->prepare("
            SELECT
            users.username,
                comment_messages.comment_message_id, 
                comment_messages.message_id, 
                comment_messages.article_id, 
                comment_messages.from_user_id, 
                comment_messages.parent_id, 
                messages.content, 
                messages.datetime, 
                messages.rating
            FROM comment_messages RIGHT JOIN messages on comment_messages.message_id = messages.message_id INNER JOIN users ON users.username = comment_messages.from_user_id
            WHERE comment_messages.article_id = :article_id AND comment_messages.parent_id IS NULL AND comment_messages.comment_message_id > :comment_message_id
            ORDER BY comment_messages.parent_id
            LIMIT 10");
        $commentH->execute(array(':article_id' => $article_id, ':comment_message_id' => $comment_message_id));
        $commentH->setFetchMode(PDO::FETCH_ASSOC);
        $commentIDs = $commentH->fetchAll();
        return $commentIDs;
    }

    public function getParentCommentsForArticle($article_id) {
        $commentH = $this->db->prepare("
            SELECT
            users.username,
                comment_messages.comment_message_id, 
                comment_messages.message_id, 
                comment_messages.article_id, 
                comment_messages.from_user_id, 
                comment_messages.parent_id, 
                messages.content, 
                messages.datetime, 
                messages.rating
            FROM comment_messages RIGHT JOIN messages on comment_messages.message_id = messages.message_id INNER JOIN users ON users.user_id = comment_messages.from_user_id
            WHERE comment_messages.article_id = :article_id AND comment_messages.parent_id IS NULL
            ORDER BY comment_messages.parent_id
            LIMIT 10");
        $commentH->execute(array(':article_id' => $article_id));
        $commentH->setFetchMode(PDO::FETCH_ASSOC);
        $commentIDs = $commentH->fetchAll();
        return $commentIDs;
    }

    public function getChildCommentsForParent($parent_id) {
        $commentH = $this->db->prepare("
            SELECT
            users.username,
                comment_messages.comment_message_id, 
                comment_messages.message_id, 
                comment_messages.article_id, 
                comment_messages.from_user_id, 
                comment_messages.parent_id, 
                messages.content, 
                messages.datetime, 
                messages.rating
            FROM comment_messages RIGHT JOIN messages on comment_messages.message_id = messages.message_id INNER JOIN users ON users.user_id = comment_messages.from_user_id
            WHERE parent_id = :parent_id
            ORDER BY comment_messages.parent_id");
        $commentH->execute(array(':parent_id' => $parent_id));
        $commentH->setFetchMode(PDO::FETCH_ASSOC);
        $commentIDs = $commentH->fetchAll();
        return $commentIDs;
    }

    public function getChildIDsForParent($parent_id) {
        $childIDH - $this->db->prepare("
            SELECT comment_message.message_id
            FROM commment_messages
            WHERE parent_id = :parent_id");
        $childIDH->execute(array(':article_id' => $article_id));
        $childIDH->setFetchMode(PDO::FETCH_ASSOC);
        $childIDs = $childIDH->fetchAll();
        return $childIDs;
    }

    public function getCommentDataByID($commentID) {
        $comDataH = $this->db->prepare("
            SELECT 
            users.username,
            comment_messages.comment_message_id, 
            comment_messages.message_id, 
            comment_messages.article_id, 
            comment_messages.from_user_id, 
            comment_messages.parent_id, 
            messages.content, 
            messages.datetime, 
            messages.rating
            FROM messages 
            INNER JOIN comment_messages ON messages.message_id = comment_messages.message_id
            INNER JOIN users ON users.user_id = comment_messages.from_user_id
            WHERE comment_message_id = :comment_id");
        $comDataH->execute(array(':comment_id' => $commentID));
        $comDataH->setFetchMode(PDO::FETCH_ASSOC);
        $comData = $comDataH->fetch();
        return $comData;
    }

    public function getUserMessageByID($userMessageID) {
        $userMessageDataH = $this->db->prepare("
            SELECT messages.content, messages.datetime, messages.rating
            FROM messages, user_messages
            WHERE user_messages.user_message_id = :user_message_id");
        $userMessageDataH->execute(array(':user_message_id' => $commentID));
        $userMessageDataH->setFetchMode(PDO::FETCH_ASSOC);
        $userMessageData = $userMessageDataH->fetch();
        return $userMessageData;
    }

    //SETTERS

    public function setCommentMessage($user_id, $message_id, $parent, $article_id) {
        //print_r($user_id . $message_id . $parent . $article_id);
        $insertDataH = $this->db->prepare("
            INSERT INTO comment_messages (message_id,article_id,from_user_id,parent_id) 
            VALUES (:message_id,:article_id,:from_user_id,:parent_id)");
        if ($parent == NULL) {
            $insertDataH->execute(array(':message_id' => $message_id, ':article_id' => $article_id, ':from_user_id' => $user_id, ':parent_id' => NULL));
        } else {

            $insertDataH->execute(array(':message_id' => $message_id, ':article_id' => $article_id, ':from_user_id' => $user_id, ':parent_id' => $parent));
        }

        $commentMessageID = $this->db->lastInsertID();
        return $commentMessageID;
    }

    public function setMessage($title, $content) {
        $rating = 0;
        $insertDataH = $this->db->prepare("
            INSERT INTO messages (title,content,rating,datetime) 
            VALUES (:title,:content,:rating,NOW())");
        $insertDataH->execute(array(':title' => $title, ':content' => $content, ':rating' => $rating));
        $messageID = $this->db->lastInsertID();
        return $messageID;
    }

}

?>