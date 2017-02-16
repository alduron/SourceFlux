<?php

namespace Controllers;

use Services\SessionService;
use Services\CallerSerivice;

class IndexController {

    //REQUIRED

    public function __construct($data) {
        $this->model = $data['model'];
        $this->view = $data['view'];
        $this->view->setJS(JSVIEWS . 'interface/js/topnav.js');
        $this->view->setJS(JSVIEWS . 'index/js/default.js');
    }

    public function index() {
        $data['view'] = $this->view;
        
        if (SessionService::get('loggedIn') == false) {
            $data['model'] = CallerSerivice::callClass('nonuserfeed', 'model');
            $data['feed'] = 1;
            $this->model->setDefaults();
            $this->nuf1 = CallerSerivice::callClass('nonuserfeed', 'controller', NULL, $data);
            $this->view->nuf1 = $this->nuf1;

            $data['feed'] = 2;
            $this->nuf2 = CallerSerivice::callClass('nonuserfeed', 'controller', NULL, $data);
            $this->view->nuf2 = $this->nuf2;
        }
        if (SessionService::get('loggedIn') == true) {
            $data['model'] = CallerSerivice::callClass('userfeed', 'model');
            $data['feed'] = 1;
            $this->uf1 = CallerSerivice::callClass('userfeed', 'controller', NULL, $data);
            $this->view->uf1 = $this->uf1;

            $data['feed'] = 2;
            $this->uf2 = CallerSerivice::callClass('userfeed', 'controller', NULL, $data);
            $this->view->uf2 = $this->uf2;
        }

        $sfData['view'] = $this->view;
        $sfData['model'] = CallerSerivice::callClass('sitefeed','model');
        $this->sf = CallerSerivice::callClass('sitefeed', 'controller',NULL,$sfData);
        $this->view->sf = $this->sf;
        
        $this->view->render('index/index');
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS
    //SETTERS
}
?>