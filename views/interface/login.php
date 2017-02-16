<div class="navbar-form interface pull-right">
    <form id="login-form" action="<?php echo URL; ?>login/xhrValidate" method="post">
        <div id="login-input-cg" class="control-group control-group-margin">
            <input id="login-username" type="text" class="span2 input-small" name="username" placeholder="Username">
            <div class="input-append">
                <input id="login-password" type="password" class="span2 input-small" name="password" placeholder="Password">
                <div class="btn-group">
                    <button type="submit" class="btn">Sign in</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="">Accounts
                            <li class="caret"></li>
                        </span>
                    </button>
                    <ul class="pull-right dropdown-menu">
                        <li>
                            <a href="<?php echo URL ?>account/create">Create Account</a>
                        </li>
                        <li>
                            <a href="<?php echo URL ?>account/reset">Forgot Password?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

</div>
