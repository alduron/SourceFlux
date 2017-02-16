<?php

namespace Services;

class InputService {

    //VARIABLES

    private $errorMessages;

    //REQUIRED

    function __construct() {
        $this->errorMessages = array();
    }

    //FUNCTIONAL
    //CHECKS

    private function checkBasics($type, $minLength, $maxLength, $data) {
        $type = 'is_' . $type;
        $length = strlen($data);
        $isValid = TRUE;

        if (!$type($data)) {
            $this->addError('Input resolved to wrong type');
            $isValid = FALSE;
        } else {
            if (empty($data) && $data !== 0) {
                $this->addError('Input resolved to empty');
                $isValid = FALSE;
            } else {
                if (($length < $minLength) || ($length > $maxLength)) {
                    $this->addError('Input does not meet required size');
                    $isValid = FALSE;
                }
            }
        }
        return $isValid;
    }

    public function checkUsername($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 3, 25, $data)) {
            if (!preg_match('/^[a-z\d_]{2,25}$/i', $data)) {
                $this->addError('Username includes illegal character(s)');
                $isValid = FALSE;
            }
        } else {
            $isValid = FALSE;
        }

        return $isValid;
    }

    public function checkEmail($data) {
        $this->clearErrors();
        $isValid = true;
        if ($this->checkBasics('string', 7, 325, $data)) {
            $atIndex = strrpos($data, "@");
            if (is_bool($atIndex) && !$atIndex) {
                $this->addError('Email has no @ symbol');
                $isValid = false;
            } else {
                $domain = substr($data, $atIndex + 1);
                $local = substr($data, 0, $atIndex);
                $localLen = strlen($local);
                $domainLen = strlen($domain);
                if ($localLen < 1 || $localLen > 64) {
                    // local part length exceeded
                    $this->addError('The user does not meet required size');
                    $isValid = false;
                } else if ($domainLen < 1 || $domainLen > 255) {
                    // domain part length exceeded
                    $this->addError('The domain does not meet required size');
                    $isValid = false;
                } else if ($local[0] == '.' || $local[$localLen - 1] == '.') {
                    // local part starts or ends with '.'
                    $this->addError('The user starts or ends with "."');
                    $isValid = false;
                } else if (preg_match('/\\.\\./', $local)) {
                    // local part has two consecutive dots
                    $this->addError('The user has too many "."');
                    $isValid = false;
                } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
                    // character not valid in domain part
                    $this->addError('The domain resolved illegal characters');
                    $isValid = false;
                } else if (preg_match('/\\.\\./', $domain)) {
                    // domain part has two consecutive dots
                    $this->addError('The domain has too many "."');
                    $isValid = false;
                } else if
                (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
                    // character not valid in local part unless 
                    // local part is quoted
                    if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
                        $this->addError('The user contains illegal character(s)');
                        $isValid = false;
                    }
                }
                if ($isValid && !(checkdnsrr($domain, "MX") ||
                        \checkdnsrr($domain, "A"))) {
                    // domain not found in DNS
                    $this->addError('The domain cannot be resolved');
                    $isValid = false;
                }
            }
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkText($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 10000, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkPassword($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 4, 25, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }

        return $isValid;
    }

    public function checkTag($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 2, 25, $data)) {
            if (preg_match('/[^A-Za-z0-9]/i', $data)) {
                $this->addError('Input contains illegal character(s)');
                $isValid = FALSE;
            }
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkArticleID($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 11, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkTitle($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 2, 50, $data)) {
            if (preg_match('/[^A-Za-z0-9]\s/i', $data)) {
                $this->addError('Input contains illegal character(s)');
                $isValid = FALSE;
            }
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkTLDR($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 2, 60, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkContent($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 10000, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkParentID($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 11, $data) || $this->checkBasics('string', 4, 4, $data)) {
            if (preg_match('/[^A-Za-z0-9]/i', $data)) {
                $this->addError('Parent_ID contains illegal character(s)');
                $isValid = FALSE;
            }
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkMessage($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 10000, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkFeed($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 4, 4, $data) || $this->checkBasics('numeric', 1, 1, $data)) {
            if ($data !== '1' && $data !== '2' && $data !== 'site') {
                $this->addError('Input contains illegal character(s)');
                $isValid = FALSE;
            }
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkDisplayName($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 1, 25, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    public function checkLink($data) {
        $this->clearErrors();
        $isValid = TRUE;
        if (!$this->checkBasics('string', 1, 1000, $data)) {
            $isValid = FALSE;
        }
        return $isValid;
    }
    
    public function checkAuth($data){
        $this->clearErrors();
        $isValid = TRUE;
        if ($this->checkBasics('string', 32, 32, $data)) {
            //additional checks
        } else {
            $isValid = FALSE;
        }
        return $isValid;
    }

    //GETTERS

    public function getErrorMessages() {
        return $this->errorMessages;
    }

    //SETTERS

    private function clearErrors() {
        $this->errorMessages = array();
    }

    public function addError($message) {
        $this->errorMessages[] = $message;
    }

}
?>