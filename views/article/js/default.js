
$(document).ready(function() {

    loadComments();

    function loadComments() {
        var url = $('#article-container-comments').attr('value');
        var id = $("#article-info").attr('article');

        $.post(url, {
            id: id
        }, function(o) {
            $('#article-container-comment-results').html(o);
        });
    }

});


$(function() {
    var siteRoot = 'http://' + document.location.hostname + '/';


    $('#article-container-comments').on('click','.comment-reply', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var article_id = $(this).attr('article_id');
        var comment_id = $(this).attr('comment_id');
        var parent = $(this).attr('parent');

        $.post(url, {
            comment_id: comment_id,
            parent: parent,
            article_id: article_id
        }, function(o) {
            $('#comment-results-' + comment_id).html(o);
        });
    });


    $('#article-container-comments').on('submit','.comment-reply-form', function(e) {
        e.preventDefault();
        var parent = $(this).attr('parent');
        var comment_id = $(this).attr('comment_id');
        var data = $(this).serialize();
        var url = $(this).attr('action');
        if ((typeof parent === 'undefined') || (parent == "")) {
            $.post(url,
                data
                , function(o) {
                    if(typeof o.isValid !== 'undefined' && o.isValid === false){
                        enableElementError('.comment-reply-container'); 
                    } else {
                        $('#article-container-comment-results').append(o);
                    }
                },'json');
        } else {
            $.post(url,
                data
                , function(o) {
                    if(typeof o.isValid !== 'undefined' && o.isValid === false){
                        enableElementError('.comment-reply-container');
                    } else {
                        $('#comment-results-' + comment_id).html(o);
                    }
                },'json');
        }
    });


    $('.article-voting-down').on('click', function(e) {
        var url = siteRoot + 'article/xhrDownvote';
        var articleID = ($('#article-info').attr('article'));
        $.post(url, {
            articleID: articleID
        }, function(o) {
            $('#article-voting-up-icon').removeClass('icon-chevron-right');
            $('#article-voting-up-icon').addClass('icon-chevron-up');
            $('#article-voting-down-icon').removeClass('icon-chevron-down');
            $('#article-voting-down-icon').addClass('icon-chevron-right');
        });
    });


    $('.article-voting-up').on('click', function(e) {
        var url = siteRoot + 'article/xhrUpvote';
        var articleID = ($('#article-info').attr('article'));
        $.post(url, {
            articleID: articleID
        }, function(o) {
            $('#article-voting-up-icon').removeClass('icon-chevron-up');
            $('#article-voting-up-icon').addClass('icon-chevron-right');
            $('#article-voting-down-icon').removeClass('icon-chevron-right');
            $('#article-voting-down-icon').addClass('icon-chevron-down');
        });
    });
    
    function enableElementError(element) {
        $(element + '-cg').addClass('warning');
    }

    function disableElementError(element) {
        $(element + '-cg').removeClass('warning');
    }
});

