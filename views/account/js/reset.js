$(document).ready(function() {

    var siteRoot = 'http://' + document.location.hostname + '/';

    $('#account-form-reset').on('submit', function(e) {
        e.preventDefault();
        disableElementError('#account-reset-username');
        disableElementError('#account-reset-email');

        var url = siteRoot + 'account/xhrValidateReset';
        var username = $('#account-reset-username').val();
        var email = $('#account-reset-email').val();

        $.post(url, {
            username: username,
            email: email
        }, function(o) {
            if (o.isValid === false) {
                enableElementError('#account-reset-username');
                enableElementError('#account-reset-email');
            } else {
                window.location = siteRoot + 'account/emailsent';
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

