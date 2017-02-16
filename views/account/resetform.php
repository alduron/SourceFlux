<div class="row">
    <div class="container">
        <div class="span4 offset4 account-resetform-container center">
        <h3>Select New Password</h3>
        <form id="account-form-password-reset" class="form-horizontal" method="post" action="<?php echo URL; ?>account/xhrChangePassword" >
            <div id="account-reset-password-cg" class="control-group">
                <input type="password" id="account-reset-password" name="password" placeholder="Password" maxlength="25">
            </div>
            <div id="account-reset-confirm-password-cg" class="control-group">
                <input id="account-reset-confirm-password" type="password" name="confirmpassword" placeholder="Confirm Password" maxlength="25">
            </div>
            <input id="account-reset-username" name="username" type="hidden" value="<?php echo $this->username?>">
            <input id="account-reset-password-auth" name="password-authentication" type="hidden" value="<?php echo $this->passwordAuthentication?>">
            <button class="btn" type="submit">Submit</button>
        </form>
        </div>
    </div>
</div>