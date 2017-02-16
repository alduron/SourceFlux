<div class="row center">
    <div class="container">
        <div class=" span4 offset4 account-create-contrainer">
            <h3>Create Account</h3>
            <form id="account-form-create" class="form-horizontal" method="post" action="<?php echo URL; ?>account/validateData" >
                <div id="account-create-username-cg" class="control-group">
                    <input type="text" id="account-create-username" name="username" placeholder="Username">
                </div>
                <div id="account-create-email-cg" class="control-group">
                    <input type="text" id="account-create-email" name="email_primary" placeholder="Email">
                </div>
                <div id="account-create-confirm-email-cg" class="control-group">
                    <input type="text" id="account-create-confirm-email" name="email_secondary" placeholder="Confirm Email">
                </div>
                <div id="account-create-password-cg" class="control-group">
                    <input type="password" id="account-create-password" name="password_primary" placeholder="Password">
                </div>
                <div id="account-create-confirm-password-cg" class="control-group">
                    <input type="password" id="account-create-confirm-password" name="password_secondary" placeholder="Confirm Password">
                </div>
                <button class="btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>