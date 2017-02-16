<?php

namespace Views;

class webView {

    private $js = array();
    private $css = array();

    //REQUIRED

    function __construct() {

        //Required JS assets
        $this->setJS(JQUERY);

        $this->setJS(T_BOOT_JS);
        $this->setJS(TB_JQUERY);

        //Required CSS assets
        $this->setCSS(T_BOOT_CSS);
        $this->setCSS(TB_CSS);
        $this->setCSS(T_BOOT_RESPOND_CSS);
    }

    //FUNCTIONAL
    //accept the name of the page that needs to be rendered, an option to remove header and footer, and a message used by the error controller
    public function render($name, $noInclude = false, $msg = false) {

        if ($noInclude == true) {

            if ($msg == false) {
                require(VIEWS . $name . '.php');
            } else {
                $this->msg = $msg;
                require(VIEWS . $name . '.php');
            }
        } else {
            if ($msg == false) {
                require HEADER;

                require(VIEWS . $name . '.php');

                require FOOTER;
            } else {
                $this->msg = $msg;
                require HEADER;

                require(VIEWS . $name . '.php');

                require FOOTER;
            }
        }
    }

    public function echoData($data) {
        echo($data);
    }

    public function printData($data) {
        print_r($data);
    }

    //CHECKS
    //GETTERS

    public function getCSS() {
        return $this->css;
    }

    public function getJS() {
        return $this->js;
    }

    //SETTERS

    public function setJS($file) {
        $this->js[] = $file;
    }

    public function setCSS($file) {
        $this->css[] = $file;
    }

}

?>
