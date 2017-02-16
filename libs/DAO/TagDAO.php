<?php

namespace Daos;

use PDO;

class TagDAO {

    //REQUIRED

    public function __construct($data) {
        if (is_array($data)) {
            $this->db = $data['db'];
        } else {
            $this->db = $data;
        }
    }

    //FUNCTIONAL

    private function trimTags($tag_ids) {
        $tag_list = '';
        foreach ($tag_ids as $tag) {

            $tag_list = ($tag_list . $tag . ",");
        }
        $tag_list = rtrim($tag_list, ',');

        return $tag_list;
    }

    //CHECKS

    public function checkTagByString($tag_name) {
        $sth = $this->db->prepare("
            SELECT tag_id 
            FROM tags 
            WHERE tag_name = :tag");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array('tag' => $tag_name));

        $count = $sth->rowCount();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    //GETTERS

    public function getTagIDByString($tag_name) {
        $tag_sth = $this->db->prepare("
            SELECT tag_id 
            FROM tags 
            WHERE tag_name = :tag");
        $tag_sth->execute(array(':tag' => $tag_name));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetch();
        $tag_id = $data['tag_id'];

        return $tag_id;
    }

    public function getTagsLike($search_term) {
        $search_term = "%".$search_term."%";
        $tag_sth = $this->db->prepare("
            SELECT tag_name
            FROM tags 
            WHERE tag_name LIKE :tag
            LIMIT 10");
        $tag_sth->execute(array(':tag' => $search_term));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function searchDefaultArticlesByTagIDs($tag_ids) {
        $tag_list = $this->trimTags($tag_ids);

        $sql = "SELECT art.article_id, art.rating, Count(at.article_id) AS common_tags
                    FROM article_tags AS at 
                    INNER JOIN articles AS art ON at.article_id = art.article_id
                    WHERE at.tag_id IN (%s)
                    GROUP BY at.article_id
                    ORDER BY art.rating DESC,common_tags DESC
                    LIMIT 100";
        $sql = sprintf($sql, $tag_list);
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute();
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function searchMoreArticlesByTagIDs($tag_ids, $last_article) {
        $tag_list = $this->trimTags($tag_ids);

        $sql = "SELECT art.article_id, art.rating, Count(at.article_id) AS common_tags
                    FROM article_tags AS at 
                    INNER JOIN articles AS art ON at.article_id = art.article_id
                    WHERE at.tag_id IN (%s) AND art.rating < (SELECT rating FROM articles WHERE article_id = :last_article)
                    GROUP BY at.article_id
                    ORDER BY art.rating DESC, common_tags DESC
                    LIMIT 100";
        $sql = sprintf($sql, $tag_list);
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute(array(':last_article' => $last_article));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function reSearchPageByTagIDs($tag_ids, $first_article) {
        $tag_list = $this->trimTags($tag_ids);

        $sql = "CALL sp_reSearchDefaultArticles(:tag_list, :first_article)";
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute(array(':tag_list' => $tag_list, ':first_article' => $first_article));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function searchNextArticlesByTagIDs($tag_ids, $last_article) {
        $tag_list = $this->trimTags($tag_ids);

        $sql = "CALL sp_searchNextArticles(%s, :last_article)";
        $sql = sprintf($sql, $tag_list);
        print_r($sql);
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute(array(':last_article' => $last_article));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function searchPrevArticlesByTagIDs($tag_ids, $first_article) {
        $tag_list = $this->trimTags($tag_ids);

        $sql = "CALL sp_searchPrevArticles(:tag_list, :first_article)";
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute(array(':tag_list' => $tag_list, ':first_article' => $first_article));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    public function searchArticlesByTagIDs($tag_ids, $last_article = 0) {
        $tag_list = $this->trimTags($tag_ids);
        if ($last_article == 0) {
            $sql = "CALL sp_searchDefaultArticles(:tag_list)";
            $tag_sth = $this->db->prepare($sql);
            $tag_sth->execute(array(':tag_list' => $tag_list));
            $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
            $data = $tag_sth->fetchAll();
        } else {
            $sql = "CALL sp_searchNextArticles(:tag_list, :last_article)";
            $tag_sth = $this->db->prepare($sql);
            $tag_sth->execute(array(':tag_list' => $tag_list, ':last_article' => $last_article));
            $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
            $data = $tag_sth->fetchAll();
        }
        return $data;
    }

    public function getArticleTagsByID($article_id){
        $sql = "
            SELECT tag_name
            FROM article_tags
            INNER JOIN tags ON article_tags.tag_id = tags.tag_id
            WHERE article_id = :article_id";
        $tag_sth = $this->db->prepare($sql);
        $tag_sth->execute(array(':article_id' => $article_id));
        $tag_sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $tag_sth->fetchAll();

        return $data;
    }

    //SETTERS

    public function attachTagToArt($tag_name, $article_id) {
        $tag_id = $this->getTagIDByString($tag_name);
        $insertDataH = $this->db->prepare("
            INSERT INTO article_tags (tag_id, article_id) 
            VALUES (:tag_id, :article_id)");
        $insertDataH->execute(array(':tag_id' => $tag_id, ":article_id" => $article_id));
    }

    public function addTagByString($tag_name) {
        $insertDataH = $this->db->prepare("
            INSERT INTO tags (tag_name)
            VALUES(:tag_name)");
        $insertDataH->execute(array(':tag_name' => $tag_name));
    }

}

//NOTES
//
//
////This was the SQl used to create the stored procedure sp_reSearchDefaultArticles()
//
//
//DROP PROCEDURE IF EXISTS sp_reSearchDefaultArticles;
//
//DELIMITER $$
//CREATE PROCEDURE sp_reSearchDefaultArticles(IN tagList VARCHAR(255), IN firstArticle INT(10))
//BEGIN
//
//DROP TABLE IF EXISTS at_results;
//
//SET @sql1 = CONCAT('
//CREATE TEMPORARY TABLE at_results (
//id INTEGER(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//article_id INTEGER(10) NOT NULL,
//datetime DATETIME NOT NULL,
//common_tags INTEGER NOT NULL)
//SELECT at.article_id, art.datetime, Count(at.article_id) AS common_tags
//FROM article_tags AS at 
//INNER JOIN articles AS art ON at.article_id = art.article_id
//WHERE at.tag_id IN (', tagList ,')
//GROUP BY at.article_id
//ORDER BY common_tags DESC, art.datetime DESC;');
//
//SET @sql2 = '
//DROP TABLE IF EXISTS at_article;';
//
//SET @sql3 = CONCAT('
//CREATE TEMPORARY TABLE at_article
//SELECT id
//FROM at_results
//WHERE article_id = ', firstArticle, ';');
//
//SET @sql4 = 'SELECT article_id
//FROM at_results, at_article
//WHERE at_results.id >= at_article.id;';
//
//PREPARE stmt FROM @sql1;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql2;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql3;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql4;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//END $$
//DELIMITER ;
//
//
//This was the SQl used to create the stored procedure sp_searchPrevArticles()
//
//DROP PROCEDURE IF EXISTS sp_searchPrevArticles;
//
//DELIMITER $$
//CREATE PROCEDURE sp_searchPrevArticles(IN tagList VARCHAR(255), IN firstArticle INT(10))
//BEGIN
//
//SET @sql1 = CONCAT('
//CREATE TEMPORARY TABLE at_results (
//id INTEGER(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//article_id INTEGER(10) NOT NULL,
//datetime DATETIME NOT NULL,
//common_tags INTEGER NOT NULL)
//SELECT at.article_id, art.datetime, Count(at.article_id) AS common_tags
//FROM article_tags AS at 
//INNER JOIN articles AS art ON at.article_id = art.article_id
//WHERE at.tag_id IN (', tagList ,')
//GROUP BY at.article_id
//ORDER BY common_tags DESC, art.datetime DESC;');
//
//SET @sql2 = CONCAT('
//CREATE TEMPORARY TABLE at_article
//SELECT id
//FROM at_results
//WHERE article_id = ', firstArticle, ';');
//
//SET @sql3 = '
//SELECT article_id
//FROM at_results, at_article
//WHERE at_results.id < at_article.id
//ORDER BY at_results.id DESC;';
//
//PREPARE stmt FROM @sql1;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql2;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql3;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//END $$
//DELIMITER ;
//
//
//This was the SQL used to create the Stores Procedure sp_searchNextArticles()
//
//
//DROP PROCEDURE IF EXISTS sp_searchNextArticles;
//
//
//
//
//This was the SQL used to create the Stores Procedure sp_searchStartArticles()
//
//
//DROP PROCEDURE IF EXISTS sp_searchStartArticles;
//
//DELIMITER $$
//CREATE PROCEDURE sp_searchStartArticles(IN tagList VARCHAR(255), IN lastArticle INT(10))
//BEGIN
//        
//SET @sql1 = 'DROP TABLE IF EXISTS at_results;';
//
//SET @sql2 = CONCAT('
//CREATE TEMPORARY TABLE at_results (
//id INTEGER(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//article_id INTEGER(10) NOT NULL,
//datetime DATETIME NOT NULL,
//common_tags INTEGER NOT NULL)
//SELECT at.article_id, art.datetime, Count(at.article_id) AS common_tags
//FROM article_tags AS at 
//INNER JOIN articles AS art ON at.article_id = art.article_id
//WHERE at.tag_id IN (', tagList ,')
//GROUP BY at.article_id
//ORDER BY common_tags DESC, art.rating DESC;');
//
//
//
//SET @sql3 = CONCAT('
//    CREATE TEMPORARY TABLE at_article
//SELECT id
//FROM at_results
//WHERE article_id = ', lastArticle, ';');
//
//SET @sql4 = '
//SELECT article_id
//FROM at_article';
//      
//PREPARE stmt FROM @sql1;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql2;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql3;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql4;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//
//
//END $$
//DELIMITER ;
//
//
//DROP PROCEDURE IF EXISTS sp_searchDefaultArticles;
//
//DELIMITER $$
//CREATE PROCEDURE sp_searchDefaultArticles(IN tagList VARCHAR(255))
//BEGIN
//
//SET @sql1 = 'DROP TABLE IF EXISTS at_results;';
//
//SET @sql2 = CONCAT('CREATE TEMPORARY TABLE at_results (
//id INTEGER(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//article_id INTEGER(10) NOT NULL,
//datetime DATETIME NOT NULL,
//common_tags INTEGER NOT NULL)
//SELECT at.article_id, art.datetime, Count(at.article_id) AS common_tags
//FROM article_tags AS at 
//INNER JOIN articles AS art ON at.article_id = art.article_id
//WHERE at.tag_id IN (', tagList ,')
//GROUP BY at.article_id
//ORDER BY common_tags DESC, art.rating DESC;');
//
//SET @sql3 = 'SELECT article_id
//FROM at_results;';
//        
//PREPARE stmt FROM @sql1;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql2;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql3;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//END $$
//DELIMITER ;
//This is the SQL used to create SP_SEARCHMOREARTICLES()
//DROP PROCEDURE IF EXISTS sp_searchMoreArticles;
//DELIMITER $$
//CREATE PROCEDURE sp_searchMoreArticles(IN tagList VARCHAR(255), IN lastArticle INT(10))
//BEGIN
//
//SET @sql1 = CONCAT('
//CREATE TEMPORARY TABLE at_results (
//id INTEGER(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//article_id INTEGER(10) NOT NULL,
//datetime DATETIME NOT NULL,
//common_tags INTEGER NOT NULL)
//SELECT at.article_id, art.datetime, Count(at.article_id) AS common_tags
//FROM article_tags AS at 
//INNER JOIN articles AS art ON at.article_id = art.article_id
//WHERE at.tag_id IN (', tagList ,')
//GROUP BY at.article_id
//ORDER BY common_tags DESC, art.rating DESC;');
//
//SET @sql2 = CONCAT('
//CREATE TEMPORARY TABLE at_article
//SELECT id
//FROM at_results
//WHERE article_id = ', lastArticle, ';');
//
//SET @sql3 = '
//SELECT article_id
//FROM at_results, at_article
//WHERE at_results.id > at_article.id
//ORDER BY at_results.id DESC;';
//
//PREPARE stmt FROM @sql1;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql2;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//PREPARE stmt FROM @sql3;
//EXECUTE stmt;
//DEALLOCATE PREPARE stmt;
//
//END $$
//DELIMITER ;
?>
