<?php

namespace Objects;

class UserObject {

    private $userID;
    private $uniqueIdent;
    private $username;
    private $email;
    private $loggedIn;
    private $role;
    private $joinDate;
    private $verified;
    private $verificationNum;
    private $passwordAuthentication;
    private $tagList1;
    private $tagList2;
    private $tagList3;

    public function __construct($userData) {
        $this->userID = $userData[0]['user_id'];
        $this->username = $userData[0]['username'];
        $this->email = $userData[0]['email'];
        if ($userData[0]['verified'] == 1) {
            $this->verified = TRUE;
        } else {
            $this->verificationNum = $userData[0]['verification_number'];
            $this->verified = FALSE;
        }
        $this->joinDate = $userData[0]['join_date'];
        $this->role = $userData[0]['role'];
    }

    public function setUniqueIdent($ident) {
        $this->uniqueIdent = $ident;
    }

    public function setTagLists($tagData) {
        $feed1 = array();
        $feed2 = array();
        $feed3 = array();
        forEach ($tagData as $row) {
            if ($row ['feed'] == 1) {
                $feed1[] = $row['tag_id'];
            } elseif ($row['feed'] == 2) {
                $feed2[] = $row['tag_id'];
            } elseif ($row['feed'] == 3) {
                $feed3[] = $row['tag_id'];
            }
        }
        $this->tagList1 = $feed1;
        $this->tagList2 = $feed2;
        $this->tagList3 = $feed3;
    }

    public function setValidated() {
        
    }
    
    public function setPasswordAuthentication($passwordAuthentication){
        $this->passwordAuthentication = $passwordAuthentication;
    }

    public function getTagList($number) {
        $tagListName = 'tagList' . $number;
        return $this->{$tagListName};
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getUniqueIdent() {
        return $this->uniqueIdent;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function checkLoggedIn() {
        return $this->loggedIn;
    }

    public function getRole() {
        return $this->role;
    }

    public function getJoinDate() {
        return $this->joinDate;
    }

    public function checkVerified() {
        return $this->verified;
    }

    public function getVerificationNum() {
        return $this->verificationNum;
    }
    
    public function getPasswordAuthentication(){
        return $this->passwordAuthentication;
    }

}

?>
