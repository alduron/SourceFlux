<?php

namespace Services;
use Services\IncluderService;
use Exception;

class CallerSerivice {
    
    //REQUIRED

    function __construct() {
    }
    
    //FUNCTIONAL

    public function callClass($name, $type, $namespace = NULL, $data = NULL) {
            IncluderService::requireFile($name, $type);
            if ($namespace === NULL) {
                $namespace = $type . 's';
            }
            if ($type == 'boot') {
                $className = $name;
            } else {
                $className = $name . ucfirst($type);
            }

            $class = '\\' . ucfirst($namespace) . '\\' . $className;

            if ($data === NULL) {
                if(class_exists($class)){
                    return new $class();
                } else {
                    throw new Exception('Class "'. $class . '()" cannot be called.');
                }
            } else {
                if(class_exists($class)){
                    return new $class($data);
                } else {
                    throw new Exception('Class "'. $class .'($data)" cannot be called.');
                }
            }

    }
    
    //CHECKS
    //GETTERS
    //SETTERS
}

?>