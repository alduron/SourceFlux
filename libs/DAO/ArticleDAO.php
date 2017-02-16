<?php

namespace Daos;

use PDO;

class ArticleDAO {

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
    //GETTERS

    public function getArtRating() {
        
    }

    public function getArtTitle() {
        
    }

    public function getArtTldr() {
        
    }

    public function getArtContent() {
        
    }

    public function getArtDateTime() {
        
    }

    public function getArtNumViews() {
        
    }

    public function getArtNumComments() {
        
    }

    public function getArtAuthor() {
        
    }

    public function getArtDataByID($articleID) {
        $artDataH = $this->db->prepare("
             SELECT article_id, articles.user_id, users.username, rating, title, tldr, content, datetime, downvotes, upvotes, num_views, num_comments
            FROM articles
            INNER JOIN users ON articles.user_id = users.user_id
            WHERE article_id = :article_id");
        $artDataH->execute(array(':article_id' => $articleID));
        $artDataH->setFetchMode(PDO::FETCH_ASSOC);
        $artData = $artDataH->fetch();
        return $artData;
    }

    public function getArtDataByString($articleString) {
        $artDataH = $this->db->prepare("
            SELECT article_id, articles.user_id, users.username, rating, title, tldr, content, datetime, downvotes, upvotes, num_views, num_comments
            FROM articles
            INNER JOIN users ON articles.user_id = users.user_id
            WHERE title = :article_string");
        $artDataH->execute(array(':article_string' => $articleString));
        $artDataH->setFetchMode(PDO::FETCH_ASSOC);
        $artData = $artDataH->fetch();
        return $artData;
    }

    public function getTileDataByID($articleID) {
        $tileDataH = $this->db->prepare("
            SELECT articles.article_id,articles.title,articles.tldr,articles.num_comments,articles.datetime,articles.upvotes,articles.downvotes,articles.rating,users.username,users.user_id
            FROM articles
            INNER JOIN users ON articles.user_id = users.user_id
            WHERE articles.article_id = :target_article");
        $tileDataH->execute(array(':target_article' => $articleID));
        $tileDataH->setFetchMode(PDO::FETCH_ASSOC);
        $tileData = $tileDataH->fetch();
        return $tileData;
    }

    //SETTERS

    public function setArtRating() {
        
    }

    public function setArtTitle() {
        
    }

    public function setArtTldr() {
        
    }

    public function setArtContent() {
        
    }

    public function setArtDateTime() {
        
    }

    public function setArtNumViews() {
        
    }

    public function setArtNumComments() {
        
    }

    public function setArtAuthor() {
        
    }

    public function setArticle($pageData) {
        $rating = 0;
        $insertDataH = $this->db->prepare("
            INSERT INTO articles (title,content,tldr,user_id,rating,datetime) 
            VALUES (:title,:body,:tldr,:user_id,$rating,NOW())");
        $insertDataH->execute(array(':title' => $pageData['title'], ':body' => $pageData['body'], ':tldr' => $pageData['tldr'], ':user_id' => $_SESSION['user_id']));
        $newArtID = $this->db->lastInsertID();
        return $newArtID;
    }
    
    public function incrementViews($articleID){
        $viewH = $this->db->prepare("
            UPDATE articles 
            SET num_views = num_views + 1
            WHERE article_id = :article_id");
        $viewH->execute(array(':article_id' => $articleID));
    }
    
    public function incrementComments($articleID){
        $viewH = $this->db->prepare("
            UPDATE articles 
            SET num_comments = num_comments + 1
            WHERE article_id = :article_id");
        $viewH->execute(array(':article_id' => $articleID));
    }

    public function upVote($articleID) {
        $voteH = $this->db->prepare("
            UPDATE articles 
            SET upvotes = upvotes + 1
            WHERE article_id = :article_id");
        $voteH->execute(array(':article_id' => $articleID));
    }

    public function downVote($articleID) {
        $voteH = $this->db->prepare("
            UPDATE articles 
            SET downvotes = downvotes + 1
            WHERE article_id = :article_id");
        $voteH->execute(array(':article_id' => $articleID));
    }

    public function removeUpVote($articleID) {
        $voteH = $this->db->prepare("
            UPDATE articles 
            SET upvotes = upvotes - 1
            WHERE article_id = :article_id");
        $voteH->execute(array(':article_id' => $articleID));
    }

    public function removeDownVote($articleID) {
        $voteH = $this->db->prepare("
            UPDATE articles 
            SET downvotes = downvotes - 1
            WHERE article_id = :article_id");
        $voteH->execute(array(':article_id' => $articleID));
    }

}

?>
