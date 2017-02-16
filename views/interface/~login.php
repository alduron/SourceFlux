<div id="logging">
    <form id="login_form" action="<?php echo URL; ?>login/xhrValidate" method="post">

        <label></label><input type="text" name="username" value="Username" size="15"/>
        <label></label><input type="password" name="password" value="Password" size="15"/>
        <label/><input type="submit"/>
    </form>
        <div id="logging_links">  <a href="<?php echo URL?>account/reset">Forgot Password</a>
    <a href="<?php echo URL?>account/create">Sign Up</a></div>
    <div id="logging_error_box">
    </div>
</div>