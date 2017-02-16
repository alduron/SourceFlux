$(window).ready(function() {

    setFeedHeight('feed1');
    setFeedHeight('feed2');
    setFeedHeight('feed3');
    setResultHeight(45, 30, 7);

    $('#feed1-filter').hide();
    $('#feed2-filter').hide();
    $('#feed3-filter').hide();

    function setResultHeight(controlHeight, toggleHeight, pagerHeight) {
        var height = $('.feed').height() - controlHeight - toggleHeight - pagerHeight;
        var height2 = $('.feed').height() - pagerHeight - 40;
        $('.feed-border').height(height);
        $('.feed-background-result-uf').height(height);
        $('.feed-site-background-result').height(height2);
        $('.feed-background-result-nuf').height(height2);
    }

    function setFeedHeight(feed) {
        var height = $(window).height() - 50;
        $('#' + feed).height(height);
    }

    function toggleFilter(feed) {
        $('#feed' + feed + '-filter').slideToggle('slow');
    }

    $('.filter-background-toggle').on('click', function() {
        var feed = $(this).attr('feed');
        toggleFilter(feed);
    });

    $('.filter-site-background-toggle').on('click', function() {
        var feed = $(this).attr('feed');
        toggleFilter(feed);
    });

    if ($(this).width() >= 768) {
        $('#feed1-control').prependTo('#feed1-container');
        $('#feed1-control').addClass('feed-child-absolute');
    }

    if ($(this).width() < 768) {
        $('#feed1-control').appendTo('#nav-control');
        $('#feed1-control').removeClass('feed-child-absolute');
        
    }

    if ($(this).width() >= 980) {
        $('#feed1').removeClass('span6');
        $('#feed3').removeClass('span6');
        $('#feed1').addClass('span4');
        $('#feed3').addClass('span4');
    }

    if ($(this).width() < 980 && $(this).width() >= 768) {
        $('#feed1').removeClass('span4');
        $('#feed3').removeClass('span4');
        $('#feed1').addClass('span6');
        $('#feed3').addClass('span6');
    }
});

$(window).resize(function() {

    setResultHeight(45, 30, 7);

    if ($(this).width() >= 768) {
        $('#feed1-control').prependTo('#feed1-container');
        $('#feed1-control').addClass('feed-child-absolute');

    }

    if ($(this).width() < 768) {
        $('#feed1-control').appendTo('#nav-control');
        $('#feed1-control').removeClass('feed-child-absolute');
    }

    if ($(this).width() >= 980 && $(this).height() >= 0) {
        $('#feed1').removeClass('span6');
        $('#feed3').removeClass('span6');
        $('#feed1').addClass('span4');
        $('#feed3').addClass('span4');

        setFeedHeight('feed1', 50);
        setFeedHeight('feed2', 50);
        setFeedHeight('feed3', 50);
    }

    if ($(this).width() < 980 && $(this).width() >= 768 && $(this).height() >= 0) {
        $('#feed1').removeClass('span4');
        $('#feed3').removeClass('span4');
        $('#feed1').addClass('span6');
        $('#feed3').addClass('span6');

        setFeedHeight('feed1', 62);
        setFeedHeight('feed2', 62);
        setFeedHeight('feed3', 62);
    }

    if ($(this).width() <= 768 && $(this).height() >= 0) {
        setFeedHeight('feed1', 62);
        setFeedHeight('feed2', 62);
        setFeedHeight('feed3', 62);
    }

    function setFeedHeight(feed, bottomMargin) {
        var height = $(window).height() - bottomMargin;
        $('#' + feed).height(height);
    }

    function setResultHeight(controlHeight, toggleHeight, pagerHeight) {
        var height = $('.feed').height() - controlHeight - toggleHeight - pagerHeight;
        var height2 = $('.feed').height() - pagerHeight - 40;
        $('.feed-border').height(height);
        $('.feed-background-result-uf').height(height);
        $('.feed-site-background-result').height(height2);
        $('.feed-background-result-nuf').height(height2);
    }
});


