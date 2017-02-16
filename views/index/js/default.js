$(window).load(function() {
    var siteRoot = 'http://' + document.location.hostname + '/';

    var feed1 = 1;
    var feed2 = 2;
    var feedS = 3;

    var NUFCheck = $('.feed-background-result-nuf').length;
    var UFCheck = $('.feed-background-result-uf').length;

    if (NUFCheck > 0) {
        loadNUFTiles(feed1);
        loadNUFTiles(feed2);
        loadNUFTiles(feedS);
    }

    if (UFCheck > 0) {
        loadUFTiles(feed1);
        loadUFTiles(feed2);
        loadUFTiles(feedS);
        update(1);
        update(2);
    }

    function update(feed) {
        $.post('filter/xhrLoadTags', {
            feed: feed
        }, function(r) {
            $('#feed' + feed + '-tag-table').html(r);
        });
    }

    function loadUFTiles(feed) {
        if (feed == 3) {
            var url = siteRoot + 'sitefeed/xhrLoadDefaultTiles';
            var height = $(".feed-site-background-result").height();
        } else {
            var url = siteRoot + 'userfeed/xhrLoadDefaultTiles';
            var height = $('.feed-background-result-uf').height();
        }

        $.post(url, {
            feed: feed,
            height: height
        }, function(o) {
            if (feed == 3) {
                $('#accordion3').html(o);
            } else {
                $('#accordion' + feed).html(o);
            }
        });
    }

    function loadNUFTiles(feed) {
        if (feed == 3) {
            var url = 'sitefeed/xhrLoadDefaultTiles';
            var height = $(".feed-site-background-result").height();
            var data = '&feed=' + feed + '&height=' + height + '&feed=' + feed;
        } else {
            var url = siteRoot + 'nonuserfeed/xhrRunSelector';
            var height = $(".feed-background-result-nuf").height();
            var data = $('#NUF-selector-' + feed).serialize() + '&height=' + height + '&feed=' + feed;
        }

        $.post(url, data, function(o) {
            if (feed == 3) {
                $('#accordion3').html(o);
            } else {
                $('#accordion' + feed).html(o);
            }
        });
    }

});

$(document).ready(function() {
    

    

    
    function enableElementError(element) {
        $(element + '-cg').addClass('warning');
    }

    function disableElementError(element) {
        $(element + '-cg').removeClass('warning');
    }
//    var siteRoot = 'http://' + document.location.hostname + '/';
//
//    $('.UF-filter-form-tag').on('submit', function(e) {
//        e.preventDefault();
//        disableElementError('#filter-tag-input');
//
//        var url = siteRoot + 'account/xhrValidateReset';
//        var tag = $(this).val();
//        var feed = $(this).attr('feed');
//
//        $.post(url, {
//            tag: tag,
//            feed: feed
//        }, function(o) {
//            if (o.isValid === false) {
//                enableElementError('#filter-tag-input');
//            }
//        }, 'json');
//    });
//
//    function enableElementError(element) {
//        $(element + '-cg').addClass('warning');
//    }
//
//    function disableElementError(element) {
//        $(element + '-cg').removeClass('warning');
//    }
});


$(function() {
    
    var siteRoot = 'http://' + document.location.hostname + '/';

    $('.tag-chkbx-1').on('click', function() {
        $('#UF-filter-box-selectall-1').attr('checked', false);
    });

    $('.tag-chkbx-2').on('click', function() {
        $('#UF-filter-box-selectall-2').attr('checked', false);
    });


    $('#UF-filter-box-selectall-1').click(function() {
        if ($(this).is(':checked')) {
            $('input:checkbox.tag-chkbx-1').each(function() {
                $(this).attr('checked', true);
            });
        } else {
            $('input:checkbox.tag-chkbx-1').each(function() {
                $(this).attr('checked', false);
            });
        }
    });

    $('#UF-filter-box-selectall-2').click(function() {
        if ($(this).is(':checked')) {
            $('input:checkbox.tag-chkbx-2').each(function() {
                $(this).attr('checked', true);
            });
        } else {
            $('input:checkbox.tag-chkbx-2').each(function() {
                $(this).attr('checked', false);
            });
        }
    });

    $('#NUF-selector-1').submit(function() {
        var url = $(this).attr('action');
        var height = $(".feed-background-result-nuf").height();
        var data = $(this).serialize() + '&height=' + height + '&feed=' + 1;

        $.post(url, data, function(o) {
            $('#accordion1').html(o);
        });


        return false;
    });

    $('#NUF-selector-2').submit(function() {
        var url = $(this).attr('action');
        var height = $(".feed-background-result-nuf").height();
        var data = $(this).serialize() + '&height=' + height + '&feed=' + 2;

        $.post(url, data, function(o) {
            $('#accordion2').html(o);
        });


        return false;
    });

    $('#UF-tag-input-1').on('submit',function(o) {
        o.preventDefault();
        $('#UF-filter-box-selectall-1').attr('checked', false);
        var url = siteRoot + 'filter/xhrSetTag';
        var feed = 1;
        var data = $(this).serialize() + '&feed=' + feed;
        $('#filter-tag-input' + feed).val('');

        $.post(url, data, function(o) {
            if(o.isValid){
                disableElementError('#filter-tag-input-' + feed);
                update(feed);
                loadDefaultTiles(feed);
            } else {
                enableElementError('#filter-tag-input-' + feed);
            }

        }, 'json');

        return false;
    });

    $('#UF-tag-input-2').on('submit',function(o) {
        o.preventDefault();
        $('#UF-filter-box-selectall-2').attr('checked', false);
        var url = siteRoot + 'filter/xhrSetTag';
        var feed = 2;
        var data = $(this).serialize() + '&feed=' + feed;
        $('#filter-tag-input' + feed).val('');

        $.post(url, data, function(o) {
            if(o.isValid){
                disableElementError('#filter-tag-input-' + feed);
                update(feed);
                loadDefaultTiles(feed);
            } else {
                enableElementError('#filter-tag-input-' + feed);
            }

        }, 'json');

        return false;
    });

    $('#UF-filter-control-save-1').submit(function() {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var feed = 1;

        $.post(url, data, function() {
            update(feed);
        });


        return false;
    });

    $('#UF-filter-control-remove-1').submit(function() {
        $('#UF-filter-box-selectall-1').attr('checked', false);
        var url = $(this).attr('action');
        var tags = $('input:checkbox:checked.tag-chkbx-1').map(function() {
            return this.value;
        }).get();
        var feed = 1;

        $.post(url, {
            tags: tags,
            feed: feed
        }, function() {
            update(feed);
            loadDefaultTiles(feed);
        });


        return false;
    });

    $('#UF-filter-control-remove-2').submit(function() {
        $('#UF-filter-box-selectall-2').attr('checked', false);
        var url = $(this).attr('action');
        var tags = $('input:checkbox:checked.tag-chkbx-2').map(function() {
            return this.value;
        }).get();
        var feed = 2;

        $.post(url, {
            tags: tags,
            feed: feed
        }, function() {
            update(feed);
            loadDefaultTiles(feed);
        });


        return false;
    });

    $('#UF-filter-control-save-2').submit(function() {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var feed = 2;

        $.post(url, data, function() {
            update(feed);
        });


        return false;
    });

    $('#feed-background-result-uf-1').bind('scroll', function()
    {
        if ($(this).scrollTop() +
            $(this).innerHeight()
            >= $(this)[0].scrollHeight)
            {
            var feed = 1;
            var url = 'userfeed/xhrAdvancePage';
            loadTiles(url, feed);
        }
    });

    $('#feed-background-result-uf-2').bind('scroll', function()
    {
        if ($(this).scrollTop() +
            $(this).innerHeight()
            >= $(this)[0].scrollHeight)
            {
            var feed = 2;
            var url = 'userfeed/xhrAdvancePage';
            loadTiles(url, feed);
        }
    });

    $('#feed-background-result-nuf-1').bind('scroll', function()
    {
        if ($(this).scrollTop() +
            $(this).innerHeight()
            >= $(this)[0].scrollHeight)
            {
            var feed = 1;
            var url = 'nonuserfeed/xhrAdvancePage';
            loadNUFTiles(url, feed);
        }
    });

    $('#feed-background-result-nuf-2').bind('scroll', function()
    {
        if ($(this).scrollTop() +
            $(this).innerHeight()
            >= $(this)[0].scrollHeight)
            {
            var feed = 2;
            var url = 'nonuserfeed/xhrAdvancePage';
            loadNUFTiles(url, feed);
        }
    });

    $('.feed-site-background-result').bind('scroll', function()
    {
        if ($(this).scrollTop() +
            $(this).innerHeight()
            >= $(this)[0].scrollHeight)
            {
            var feed = 3;
            var url = 'sitefeed/xhrAdvancePage';
            loadTiles(url, feed);
        }
    });

    //    $('#NUF-results-advance-1').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 1;
    //        var url = 'nonuserfeed/xhrAdvancePage';
    //        loadNUFTiles(url, feed);
    //    });
    //
    //    $('#NUF-results-reverse-1').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 1;
    //        var url = 'nonuserfeed/xhrReversePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#NUF-results-advance-2').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 2;
    //        var url = 'nonuserfeed/xhrAdvancePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#NUF-results-reverse-2').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 2;
    //        var url = 'nonuserfeed/xhrReversePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#UF-results-advance-1').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 1;
    //        var url = 'userfeed/xhrAdvancePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#UF-results-reverse-1').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 1;
    //        var url = 'userfeed/xhrReversePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#UF-results-advance-2').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 2;
    //        var url = 'userfeed/xhrAdvancePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#UF-results-reverse-2').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 2;
    //        var url = 'userfeed/xhrReversePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#SF-results-advance').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 3;
    //        var url = 'sitefeed/xhrAdvancePage';
    //        loadTiles(url, feed);
    //    });
    //
    //    $('#SF-results-reverse').live("click", function(e) {
    //        e.preventDefault();
    //        var feed = 3;
    //        var url = 'sitefeed/xhrReversePage';
    //        loadTiles(url, feed);
    //    });

    function enableElementError(element) {
        $(element + '-cg').addClass('warning');
    }

    function disableElementError(element) {
        $(element + '-cg').removeClass('warning');
    }

    function update(feed) {
        $.post('filter/xhrLoadTags', {
            feed: feed
        }, function(r) {
            $('#feed' + feed + '-tag-table').html(r);
        });
    }

    function loadNUFTiles(url, feed) {
        var height = $(".feed-background-result-nuf").height();
        var data = $('#NUF-selector-' + feed).serialize() + '&height=' + height + '&feed=' + feed;

        $.post(url, data, function(o) {
            if (o === 'No results found with tags.') {
            } else {
                $('#accordion' + feed).append(o);
            }
        });
    }

    function loadDefaultTiles(feed) {
        if (feed == 1 || feed == 2) {
            var url = 'userfeed/xhrLoadDefaultTiles';

            if ($('.feed-background-result-uf').length) {
                var height = $('.feed-background-result-uf').height();
            } else {
                var height = $('.feed-background-result-nuf').height();
            }
        } else {
            var url = 'sitefeed/xhrLoadDefaultTiles';
            var height = $(".feed-site-background-result").height();
        }

        $.post(url, {
            feed: feed,
            height: height
        }, function(o) {
            if (feed == 1 || feed == 2) {
                $('#accordion' + feed).html(o);
            }
            else {
                $("#accordion3").html(o);
            }
        });
    }

    function loadTiles(url, feed) {
        if ((feed == 1) || (feed == 2)) {
            if ($('.feed-background-result-uf').length) {
                var height = $('.feed-background-result-uf').height();
            } else {
                var height = $('.feed-background-result-nuf').height();
            }
        } else {
            var height = $(".feed-site-background-result").height();
        }

        $.post(url, {
            feed: feed,
            height: height
        }, function(o) {
            if (o === 'No results found with tags.') {
            } else {
                if (feed == 3) {
                    $('#accordion3').append(o);
                } else {
                    $('#accordion' + feed).append(o);
                }
            }

        });

    //loadDefaultTiles(feed);

    }

    var doit;
    $(window).resize(function() {
        clearTimeout(doit);
        doit = setTimeout(function() {
            resizedw();
        }, 100);

    });

    function resizedw() {
        if ($('.feed-background-result-uf').length) {
            var url = 'userfeed/xhrAdvancePage';
            loadTiles(url, 1);
            loadTiles(url, 2);
        } else {
            var url = 'nonuserfeed/xhrAdvancePage';
            loadNUFTiles(url, 1);
            loadNUFTiles(url, 2);
        }

        var sfUrl = 'sitefeed/xhrAdvancePage';

        loadTiles(sfUrl, 3);
    }
});

