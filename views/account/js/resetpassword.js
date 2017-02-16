$(document).ready(function() {

    var siteRoot = 'http://' + document.location.hostname + '/';

    $('#account-form-password-reset').on('submit', function(e) {
        e.preventDefault();
        disableElementError('#account-reset-password');
        disableElementError('#account-reset-confirm-password');

        var url = siteRoot + 'account/xhrChangePassword';
        var password = $('#account-reset-password').val();
        var confirmpassword = $('#account-reset-confirm-password').val();
        var username = $('#account-reset-username').val();
        var passwordauth = $('#account-reset-password-auth').val();

        $.post(url, {
            password:password,
            confirmpassword:confirmpassword,
            username:username,
            passwordauth:passwordauth
        }, function(o) {
            if (o.isValid === false) {
                enableElementError('#account-reset-password');
                enableElementError('#account-reset-confirm-password');
            } else {
                window.location = siteRoot;
            }
        }, 'json');
    });

    function enableElementError(element) {
        $(element + '-cg').addClass('warning');
    }

    function disableElementError(element) {
        $(element + '-cg').removeClass('warning');
    }

});

