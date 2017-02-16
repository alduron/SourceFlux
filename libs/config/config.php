<?php

namespace Booting\Config;

//site database information
define('DB_HOST', 'localhost');
define('DB_USER','root');
//define('DB_PASS', 'cakemysqllibdi');
define('DB_PASS', '');
define('DB_NAME', 'newwiki');

//site default users
define('USER_FEED_DEFAULTS', '!!_feed_defaults');
define('USER_SITE_FEED', '!!_site_feed');

//variables
define('WEBSITE_NAME','Nibbler');
define('SLOGAN','Your quick, accurate news source.');

//Folders
define('URL', 'http://localhost/');
//define('URL', 'http://198.199.122.147/');
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('PUBLIC_FILES',URL.'public/');
define('CSS_FILES', PUBLIC_FILES.'css/');
define('IMAGE_FILES', PUBLIC_FILES.'img/');
define('JQUERY_FILES', PUBLIC_FILES.'js/');
define('CONTROLLERS',ROOT.'controllers/');
define('LIBS',ROOT.'libs/');
define('VIEWS', ROOT.'views/');
define('VIEW_TYPES', VIEWS . 'types/');
define('JSVIEWS',URL.'views/');
define('MODELS', ROOT.'models/');
define('INTERFACES', VIEWS.'interface/');
define('DAOS', LIBS.'DAO/');
define('PAGE_CONTROLLERS', CONTROLLERS.'pages/');
define('PAGE_HELPERS',CONTROLLERS.'helpers/');
define('PAGE_COMPONENETS', CONTROLLERS.'components/');
define('OBJECTS', LIBS.'objects/');
define('DATA_MAPPERS', ROOT.'mappers/');
define('SERVICES',LIBS.'services/');
define('FACTORIES',LIBS.'factories/');
define('PHP_INCLUDES',LIBS.'includes/');
define('PHPMAILER', PHP_INCLUDES.'PHPMailer/');
define('HTTP_TEMPLATES', VIEWS.'templates/');


//Files
define('ERROR_SERVICE', SERVICES.'errorService.php');
define('BOOT', LIBS . 'Bootstrap.php');
define('HEADER', VIEWS . 'header.php');
define('CSS', CSS_FILES.'style.css');
define('TB_CSS',CSS_FILES.'tbStyle.css');
define('T_BOOT_CSS', CSS_FILES.'bootstrap.css');
define('T_BOOT_MINI_CSS', CSS_FILES.'bootstrap.min.css');
define('T_BOOT_RESPOND_CSS', CSS_FILES.'bootstrap-responsive.css');
define('T_BOOT_RESPOND_MIN_CSS', CSS_FILES.'bootstrap-responsive.min.css');
define('JQUERY', JQUERY_FILES.'jquery.js');
define('TB_JQUERY', JQUERY_FILES.'formatHelper.js');
define('T_BOOT_JS', JQUERY_FILES.'bootstrap.js');
define('T_BOOT_MIN_JS', JQUERY_FILES.'bootstrap.min.js');
define('FOOTER' , VIEWS . 'footer.php');
define('DOMAIN_OBJECT_FACTORY', FACTORIES.'DomainObjectFactory.php');
define('INCLUDER',SERVICES.'includerService.php');
define('CALLER',SERVICES.'callerService.php');
define ('MAILER',PHPMAILER.'class.phpmailer.php');
define('SMTP', PHPMAILER.'class.smtp.php');


//Messages
define('ERROR_NO_ARTICLES', 'Whoops! No articles were found.');
define('ERROR_DEFAULT', 'There has been an error! ');
define('ERROR_LOCATE_PAGE', 'We cannot locate that page.');
define('ERROR_SELECT_ARTICLE', 'You need to select an article to view.');
?>