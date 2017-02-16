<?php

namespace Services;

use Exception;

class IncluderService {

    //REQUIRED

    function __construct() {
        
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS
    public function requireFile($name, $type) {
        $suffix = $name . ucfirst($type) . '.php';
        switch ($type) {
            case 'object':
                $path = OBJECTS . $suffix;
                break;
            case 'lib':
                $path = LIBS . $suffix;
                break;
            case 'mapper':
                $path = DATA_MAPPERS . $suffix;
                break;
            case 'DAO':
                $path = DAOS . $suffix;
                break;
            case 'service':
                $path = SERVICES . $suffix;
                break;
            case 'factory':
                $path = FACTORIES . $suffix;
                break;
            case 'model':
                $path = MODELS . $suffix;
                break;
            case 'view':
                $path = VIEW_TYPES . $suffix;
                break;
            case 'controller':
                $path = PAGE_CONTROLLERS . $suffix;
                if (!file_exists($path)) {
                    $path = PAGE_COMPONENETS . $suffix;
                }
                break;
            case 'boot':
                $path = BOOT;
                break;
            default :
                throw new Exception('No case exists for the given type ' . ucfirst($type));
        }
        if (file_exists($path)) {
            require_once $path;
        } else {
            throw new Exception('The file required for ' . ucfirst($name) . ' (PATH:' . $path . ' FILE:' . $suffix . ') cannot be found!');
        }
    }

    //SETTERS
}

?>
