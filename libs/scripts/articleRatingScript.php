<?php

include '../config/config.php';
include '../databaseLib.php';

use Libs\DatabaseLib;

class articleRatingScript {

    function __construct() {
        
    }

    public function runScript() {
        $db = $this->connectDB();
        $articles = $this->getArticles($db);
        $ratings = $this->rateArticles($articles);
        $this->insertRatings($ratings, $db);
    }

    private function insertRatings($ratings, $db) {
        foreach ($ratings as $rating) {
            $ratingH = $db->prepare('
            UPDATE articles
            SET rating = :rating
            WHERE article_id = :article_id');
            $ratingH->execute(array(':rating' => $rating['rating'], ':article_id' => $rating['article_id']));
        }
    }

    private function rateArticles($articles) {
        $ratings = array();
        foreach ($articles as $article) {
            $id = $article['article_id'];
            $unixtime = strtotime($article['datetime']);
            $articleAge = $this->getArticleAge($unixtime);
            $inDays = $this->getDays($articleAge);
            $score = $this->calcScore($article['upvotes'], $article['downvotes']);
            $rating = $this->calcRating($articleAge, $score, $inDays);
            $packArt = array('article_id' => $id, 'rating' => $rating);
            $ratings[] = $packArt;
        }

        return $ratings;
    }

    private function connectDB() {
        return new DatabaseLib();
    }

    private function getArticles($db) {
        $articlesH = $db->prepare('
        SELECT article_id,upvotes,downvotes,datetime
        FROM articles');
        $articlesH->execute();
        $articlesH->setFetchMode(PDO::FETCH_ASSOC);
        $articles = $articlesH->fetchAll();
        return $articles;
    }

    private function getArticleAge($date) {
        $epoch = time();
        return $epoch - $date;
    }

    private function getDays($articleAge) {
        $inDays = $articleAge / 86400;
        if ($inDays < 1) {
            return 1;
        } else {
            return floor($inDays);
        }
    }

    private function calcRating($articleAge, $score, $days) {
        return $score / ($articleAge * $days);
    }

    private function calcScore($upvotes, $downvotes) {
        $score = (($upvotes + 1.9208) / ($upvotes + $downvotes) - 1.96 * sqrt(($upvotes * $downvotes) /
                        ($upvotes + $downvotes) + 0.9604) /
                ($upvotes + $downvotes)) /
                (1 + 3.8416 / ($upvotes + $downvotes));
        return $score;
    }

    public function displayResult($ratings) {
        echo '<div id="container" style="">';
        foreach ($ratings as $rating) {
            echo '<div id="' . $rating['article_id'] . '" style="float:left;position:relative;width:50px;height:' . $rating['rating'] * 100000000 . 'px; background-color:black;"></div>';
        }
        echo '</div>';
    }

    public function getRatings($db) {
        $ratingH = $db->prepare('
        SELECT article_id,rating
        FROM articles
        ORDER BY rating ASC');
        $ratingH->execute();
        $ratingH->setFetchMode(PDO::FETCH_ASSOC);
        $ratings = $ratingH->fetchAll();
        return $ratings;
    }

}

$rating = new articleRatingScript();
$rating->runScript();

?>
