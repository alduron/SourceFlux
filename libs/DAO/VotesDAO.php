<?php

namespace Daos;

use PDO;

class VotesDAO {
    
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

    public function checkForUserVote($userID, $articleID, $vote) {
        $voteCheckH = $this->db->prepare("
            SELECT user_votes_id
            FROM user_votes
            WHERE user_id = :user_id AND article_id = :article_id AND vote = :vote");
        $voteCheckH->execute(array(':article_id' => $articleID, ':user_id' => $userID,':vote'=>$vote));
        $count = $voteCheckH->rowCount();
        if ($count > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    //GETTERS

    public function getUserUpvotes($userID) {
        
    }

    public function getUserDownvotes($userID) {
        
    }
    
    //SETTERS

    public function setUserVote($userID, $articleID, $vote) {
        $voteAddH = $this->db->prepare("
            INSERT INTO user_votes(user_id,article_id,vote)
            VALUES (:user_id,:article_id,:vote)");
        $voteAddH->execute(array(':user_id' => $userID, ':article_id' => $articleID, ':vote' => $vote));
        return $this->checkForUserVote($userID, $articleID, $vote);
    }

    public function updateUserVote($userID, $articleID, $vote) {
        $voteAddH = $this->db->prepare("
                UPDATE user_votes
                SET vote = :vote
                WHERE user_id = :user_id AND article_id = :article_id");
        $voteAddH->execute(array(':user_id' => $userID, ':article_id' => $articleID, ':vote' => $vote));
        return $this->checkForUserVote($userID, $articleID,$vote);
    }

    private function removeUserVote($userID, $articleID) {
        $voteAddH = $this->db->prepare("
                DELETE 
                FROM user_votes
                WHERE user_id = :user_id AND article_id = :article_id");
        $voteAddH->execute(array(':user_id' => $userID, ':article_id' => $articleID));
        return $this->checkForUserVote($userID, $articleID,$vote);
    }

}

?>
