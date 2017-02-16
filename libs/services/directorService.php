<?php

namespace Services;

use Services\CallerSerivice;
use Exception;

class DirectorService {

    //REQUIRED

    function __construct() {
        
    }

    //FUNCTIONAL

    public function direct($url, $data = NULL) {
        $model = self::createModel($url);
        $view = self::createView($url);
        if ($data === NULL) {
            $controller = self::createController($url, $model, $view);
        } else {
            $controller = self::createController($url, $model, $view, $data);
        }

        if ($url->hasFunction()) {
            if (method_exists($controller, $url->getFunctionName())) {
                $funcName = $url->getFunctionName();
                if ($url->hasParameters()) {
                    call_user_func_array(array($controller, $funcName), $url->getParameterArray());
                    //$controller->{$funcName}($url->getParameterString());
                } else {
                    $controller->{$funcName}();
                }
            } else {
                throw new Exception('The specified function ' . $url->getFunctionName() . ' does not exist!');
            }
        } else {
            $controller->index();
        }
    }

    private function createController($url, $model, $view, $data = NULL) {
        if ($url->hasController()) {
            if ($data === NULL) {
                $controller = CallerSerivice::callClass($url->getControllerName(), 'controller', NULL, array('model' => $model, 'view' => $view));
            } else {
                $controller = CallerSerivice::callClass($url->getControllerName(), 'controller', NULL, array('model' => $model, 'view' => $view, 'data' => $data));
            }
            return $controller;
        } else {
            throw new Exception('Unknown Controller!');
        }
    }

    private function createModel($url) {
        return CallerSerivice::callClass($url->getControllerName(), 'model');
    }

    private function createView($url) {
        return CallerSerivice::callClass('web', 'view');
    }

    //CHECKS
    //GETTERS
    //SETTERS
}

?>
