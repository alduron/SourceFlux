<?php

namespace Objects;

class TileObject {

//Variables
    private $article_id;
    private $title;
    private $tldr;
    private $date;
    private $author_id;
    private $author_name;
    private $num_comments;
    private $upVotes;
    private $downVotes;
    private $rating;
    private $cleanURL;
    private $timeDispNum;
    private $timeDispSuffix;

//REQUIRED
    function __construct($objectData = NULL) {
        if ($objectData === NULL) {
            $this->constructEmpty();
        } else {
            $this->build($objectData);
        }
    }

    //FUNCTIONAL
    public function printMe() {
        
    }

    private function cleanURL() {
        $this->cleanURL = str_replace(' ', '-', $this->title);
    }

    //CHECKS
    //GETTERS

    public function getTitle() {
        return $this->title;
    }

    public function getTldr() {
        return $this->tldr;
    }

    public function getDate() {
        return $this->date;
    }

    public function getArticleID() {
        return $this->article_id;
    }

    public function getAuthorID() {
        return $this->author_id;
    }

    public function getAuthorName() {
        return $this->author_name;
    }

    public function getNumComments() {
        return $this->num_comments;
    }

    public function getUpVotes() {
        return $this->upVotes;
    }

    public function getDownVotes() {
        return $this->downVotes;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getCleanURL() {
        return $this->cleanURL;
    }

    public function getTimeDispNum() {
        return $this->timeDispNum;
    }

    public function getTimeDispSuffix() {
        return $this->timeDispSuffix;
    }

    //SETTERS

    private function build($objectData) {
        $this->article_id = $objectData['article_id'];
        $this->author_id = $objectData['user_id'];
        $this->author_name = $objectData['username'];
        $this->date = $objectData['datetime'];
        $this->downVotes = $objectData['downvotes'];
        $this->num_comments = $objectData['num_comments'];
        $this->rating = $objectData['rating'];
        $this->title = $objectData['title'];
        $this->tldr = $objectData['tldr'];
        $this->upVotes = $objectData['upvotes'];
        $this->cleanURL();
        $time = strtotime($this->date);
        $display = explode(' ', $this->humanTiming($time));
        $this->timeDispNum = $display[0];
        $this->timeDispSuffix = $display[1];
    }

    function humanTiming($time) {

        $time = time() - $time; // to get the time since that moment

        $tokens = array(
            31536000 => 'yr',
            2592000 => 'mon',
            604800 => 'wk',
            86400 => 'day',
            3600 => 'hr',
            60 => 'min',
            1 => 'sec'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }

}
?>

