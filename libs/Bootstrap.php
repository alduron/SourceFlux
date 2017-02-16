<?php

namespace Booting;

use Services\IncluderService;
use Services\Factory\DomainObjectFactory;
use Services\SessionService;
use Services\CallerSerivice;
use Exception;

class Bootstrap {

    //REQUIRED

    function __construct() {
        try {
            IncluderService::requireFile('database','lib');
            IncluderService::requireFile('session','service');
            IncluderService::requireFile('DomainObject', 'factory');
            IncluderService::requireFile('mapper','service');
            IncluderService::requireFile('director', 'service');
            IncluderService::requireFile('input','service');
            SessionService::init();
            if (isset($_GET['url'])) {
                $urlObj = DomainObjectFactory::getObject('url', $_GET['url']);
            } else {
                $urlObj = DomainObjectFactory::getObject('url');
            }
            $director = CallerSerivice::callClass('director','service');
            $director->direct($urlObj);
        } catch (Exception $e) {
            $message = 'Caught Exception '. $e->getMessage().' thrown in '. $e->getFile(). ' on line '. $e->getLine(). ' TRACE: ';
            print_r ($message. $e->getTrace());
        }
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS
    //SETTERS
}

?>