<!DOCTYPE html>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php

    use Services\SessionService;

    $css = $this->getCSS();

    if (!empty($css)) {
        foreach ($css as $css) {
            echo ' <link rel="stylesheet" type="text/css" href="' . $css . '" media="screen" />';
        }
    }
    ?>

    <meta http-equiv="content -type" content="text/html;charset=utf-8" />

    <meta name="description" content="" />

    <meta name="keywords" content="" />

    <meta name="author" content="" />

    <title><?php echo WEBSITE_NAME; ?></title>

</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><i class="icon-align-justify"></i></button>
                <a class="brand" href="<?php echo URL; ?>"><?php echo WEBSITE_NAME; ?></a>
                <div id="nav-menu" class="nav-collapse collapse">
                    <?php
                    if (SessionService::get('loggedIn') == false) {
                        require INTERFACES . 'login.php';
                    }

                    if (SessionService::get('loggedIn') == true) {
                        require INTERFACES . 'user.php';
                    }
                    ?>
                    <div class="row-fluid">
                        <div id="nav-control" class="nav-collapse collapse">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

