$(document).ready(function() {
    
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        disableElementError('#login-input');

        var url = $(this).attr('action');
        var username = $('#login-username').val();
        var password = $('#login-password').val();

        $.post(url, {
            username: username,
            password: password
        }, function(o) {
            if (o.login === false) {
                enableElementError('#login-input');
            } else {
                window.location.reload();
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

$(function() {
});