<?php

namespace Objects;

class urlObject {

    //VARIABLES
    private $url = '';
    private $hasController;
    private $controllerCall = '';
    private $hasFunction;
    private $functionCall = '';
    private $hasParameters = '';
    private $numParameters = 0;
    private $parameters = array();

    //REQUIRED
    public function __construct($rawURL) {
        if ($rawURL === '::DEFAULT::') {
            $this->loadDefaults();
        } else {
            $cleanURL = $this->formatURL($rawURL);
            $this->processURL($cleanURL);
        }
    }

    //FUNCTIONAL

    private function processURL($url) {
        if (!empty($url[0])) {
            $this->controllerCall = $url[0];
            $this->hasController = TRUE;
        }

        if (empty($url[1])) {
            $this->hasFunction = FALSE;
        } else {
            $this->functionCall = $url[1];
            $this->hasFunction = TRUE;
        }
        if (!empty($url[2])) {
            $parameters = array();
            foreach ($url as $key => $value) {
                if ($key >= 2) {
                    $parameters[] = $value;
                    $this->numParameters = ++$this->numParameters;
                }
                $this->parameterArray = $parameters;
            }
            $this->parameters = $this->createParameterString($parameters);
            $this->hasParameters = TRUE;
        } else {
            $this->hasParameters = FALSE;
        }
    }

    //CHECKS
    //GETTERS

    public function hasController() {
        return $this->hasController;
    }

    public function hasFunction() {
        return $this->hasFunction;
    }

    public function hasParameters() {
        return $this->hasParameters;
    }

    public function parameterCount() {
        return $this->numParameters;
    }

    public function getControllerName() {
        return $this->controllerCall;
    }

    public function getFunctionName() {
        return $this->functionCall;
    }

    public function getNumParameters() {
        return $this->numParameters;
    }

    public function getParameterString() {
        return $this->parameters;
    }

    public function getParameterArray() {
        return $this->parameterArray;
    }

    //SETTERS

    private function formatURL($rawURL) {
        $trimmedURL = rtrim($rawURL, '/');
        $url = explode('/', $trimmedURL);
        if ((isset($url[0]) && !is_string($url[0])) || (isset($url[1]) && !is_string($url[1]))) {
            $error = new Error();
            $error->setError('Bad URL!');
            $error->index();
        }
        return $url;
    }

    private function loadDefaults() {
        $this->controllerCall = 'index';
        $this->hasController = TRUE;
        $this->hasFunction = FALSE;
        $this->hasParameters = FALSE;
        $this->numParameters = 0;
    }

    private function createParameterString($parameters) {
        $parameterString = '';
        foreach ($parameters as $key => $value) {
            $parameterString = $parameterString . $value . ',';
        }
        $string = rtrim($parameterString, ',');
        return $string;
    }

    public function printMe() {
        print_r($this);
    }

}

?>
