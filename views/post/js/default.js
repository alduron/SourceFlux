$(document).ready(function() {

    var siteRoot = 'http://' + document.location.hostname + '/';

    $('.icon-ok').tooltip();
    $('.icon-trash').tooltip();
    updateSources();
    updateTags();


//    $(document.body).on('keydown', '#tag-input-name', function(e) {
//        var url = siteRoot + 'post/xhrSearchTags';
//        var c = String.fromCharCode(e.which);
//        var term = $('#tag-input-name').val() + c;
//        $.post(url, {
//            search_term: term
//        }, function(o) {
//            var list = $.parseJSON(o);
//            $('#tag-input-name').attr('data-source', o);
//        });
//    });

    $('.post-source-list').on('click', '.source-list-remove', function() {
        var url = siteRoot + 'post/xhrRemoveSource';
        var uniqueID = $(this).attr('id');
        $.post(url, {
            uniqueID: uniqueID
        }, function() {
            updateSources();
        });
    });

    $('.post-tag-list').on('click', '.tag-list-remove', function() {
        var url = siteRoot + 'post/xhrRemoveTag';
        var tagName = $(this).attr('id');
        $.post(url, {
            tag_name: tagName
        }, function() {
            updateTags();
        });
    });

    $('.post-source-list').on('click', '#source-input-add', function() {
        var url = siteRoot + 'post/xhrAddSource';
        var display = $('#source-input-display').val();
        var link = $('#source-input-link').val();

        $.post(url, {
            link: link,
            display: display
        }, function(o) {
            updateSources();

            setTimeout(function() {
                if (o.display === true || o.link === true) {

                } else {
                    if (o.display === false) {
                        enableElementError('#source-input-display');
                    }
                    if (o.link === false) {
                        enableElementError('#source-input-link');
                    }
                }
            }, 40);
        }, 'json');
    });

    $('.post-tag-list').on('click', '#tag-input-add', function() {
        var url = siteRoot + 'post/xhrAddTag';
        var tagName = $('#tag-input-name').val();

        $.post(url, {
            tag_name: tagName
        }, function(o) {
            updateTags();

            setTimeout(function() {
                if (o.result === false) {
                    enableElementError('#tag-input-name');
                }
            }, 40);
        }, 'json');
    });

    $('#post-form-build').on('submit', function(o) {
        o.preventDefault();
        disableElementError('#post-input-title');
        disableElementError('#post-input-body');
        disableElementError('#post-input-tldr');
        disableElementError('#tag-input-name');

        var url = siteRoot + 'post/xhrSubmit';
        var title = $('#post-input-title').val();
        var body = $('#post-input-body').val();
        var tldr = $('#post-input-tldr').val();

        $.post(url, {
            title: title,
            body: body,
            tldr: tldr
        }, function(o) {
            if (o.title === false) {
                enableElementError('#post-input-title');
            }
            if (o.body === false) {
                enableElementError('#post-input-body');
            }
            if (o.tldr === false) {
                enableElementError('#post-input-tldr');
            }
            if (o.tags === false) {
                enableElementError('#tag-input-name');
            }
            if (o.isurl === true) {
                var str = o.url;
                var data = str.replace("\\", "");
                window.location = data;
            }

        }, 'json');
    });

    function ValidURL(str) {
        var pattern = new RegExp('^(https?:\/\/)?' + // protocol
                '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|' + // domain name
                '((\d{1,3}\.){3}\d{1,3}))' + // OR ip (v4) address
                '(\:\d+)?(\/[-a-z\d%_.~+]*)*' + // port and path
                '(\?[;&a-z\d%_.~+=-]*)?' + // query string
                '(\#[-a-z\d_]*)?$', 'i'); // fragment locater
        if (!pattern.test(str)) {
            alert("Please enter a valid URL.");
            return false;
        } else {
            return true;
        }
    }

    function enableElementError(element) {
        $(element + '-cg').addClass('warning');
    }

    function disableElementError(element) {
        $(element + '-cg').removeClass('warning');
    }

    function updateSources() {
        var url = siteRoot + 'post/xhrLoadSources';
        $.post(url, {}, function(o) {
            $('#source-container').html(o);
        });
    }

    function updateTags() {
        var url = siteRoot + 'post/xhrLoadTags';
        $.post(url, {}, function(o) {
            $('#tag-container').html(o);
        });
    }
});

$(function() {



});

