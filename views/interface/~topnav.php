<div id="site_name">
    <ban><a href="<?php echo URL;?>" style="text-decoration: none;"> <?php echo WEBSITE_NAME?></a></ban>
</div><!--end #site_name-->

<!--<div id="slogan">
    <h3><?php echo SLOGAN; ?></h3>
</div>end #slogan -->

<div id="users">

    <?php
    use Services\SessionService;
    
    if (SessionService::get('loggedIn') == false) {
        require INTERFACES.'login.php';
    }

    if (SessionService::get('loggedIn') == true) {
        require INTERFACES.'user.php';
    }
    ?>

</div><!--end #users-->