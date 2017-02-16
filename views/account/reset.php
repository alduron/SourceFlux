<div class="row">
    <div class="container">
        <div class="span4 offset4 account-reset-container center">
            <h3>Reset Password</h3>
            <form id="account-form-reset" class="form-horizontal" method="post" action="<?php echo URL; ?>account/xhrValidateReset" >
                <div id="account-reset-username-cg" class="control-group">
                    <input type="text" id="account-reset-username" name="username" placeholder="Username" maxlength="25">
                </div>
                <div id="account-reset-email-cg" class="control-group">
                    <input type="text" id="account-reset-email" name="email" placeholder="Email" maxlength="325">
                </div>
                <button class="btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>