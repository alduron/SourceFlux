$(document).ready(function() {

    var siteRoot = 'http://' + document.location.hostname + '/';

    $('#account-form-create').on('submit', function(e) {
        e.preventDefault();
        disableElementError('#account-create-username');
        disableElementError('#account-create-email');
        disableElementError('#account-create-confirm-email');
        disableElementError('#account-create-password');
        disableElementError('#account-create-confirm-password');

        var url = siteRoot + 'account/xhrValidateData';
        var username = $('#account-create-username').val();
        var email = $('#account-create-email').val();
        var confirmemail = $('#account-create-confirm-email').val();
        var password = $('#account-create-password').val();
        var confirmpassword = $('#account-create-confirm-password').val();

        $.post(url, {
            username: username,
            email: email,
            confirmemail: confirmemail,
            password: password,
            confirmpassword: confirmpassword
        }, function(o) {
            if (o.isValid === false) {
                if (o.username === false) {
                    enableElementError('#account-create-username');
                }
                if (o.email === false) {
                    enableElementError('#account-create-email');
                }
                if (o.confirmemail === false) {
                    enableElementError('#account-create-confirm-email');
                }
                if (o.password === false) {
                    enableElementError('#account-create-password');
                }
                if (o.confirmpassword === false) {
                    enableElementError('#account-create-confirm-password');
                }
            }
            
            if(o.created === true && o.path !==false){
                var success = siteRoot + o.path;
                window.location = success;
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

