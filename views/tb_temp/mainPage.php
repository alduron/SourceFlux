<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://localhost/public/js/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/public/js/bootstrap.js"></script>
        <script type="text/javascript" src="http://localhost/public/js/formatHelper.js"></script>

        <link rel="stylesheet" type="text/css" href="http://localhost/public/css/bootstrap.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="http://localhost/public/css/tbStyle.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="http://localhost/public/css/bootstrap-responsive.css"/>

        <meta http-equiv="content -type" content="text/html;charset=utf-8" />

        <meta name="description" content="" />

        <meta name="keywords" content="" />

        <meta name="author" content="" />

    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><i class="icon-align-justify"></i></button>
                    <a class="brand" href="#">Nibbler</a>
                    <div id="nav-menu" class="nav-collapse collapse">
                        <?php require '../interface/user.php'; ?>
                        <div class="row-fluid">
                            <div id="nav-control" class="nav-collapse collapse">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="container-fluid">
                <div id="feed1" class="span4 feed feed-parent-relative">
                    <div id="feed1-container" class="feed-border feed-parent-relative">
                        <div class="row-fluid">
                            <div id="feed1-control" class="feed-child-absolute">
                                <div class="filter-background-control">
                                    <div class="center">
                                        <input class="filter-tag-input" type="text" placeholder="Tag Name" autocomplete="off" data-provide="typeahead" data-items="4" data-source="[&quot;Test&quot;,&quot;Short&quot;,&quot;Long&quot;,&quot;Nibbler&quot;]">

                                        <button class="btn">Add</button>
                                    </div>
                                </div>
                                <div class="filter-toggle-container">
                                    <div id="feed1-filter" class="filter">
                                        <div class="filter-select-bar">
                                            <label class="checkbox">
                                                <input type="checkbox"> Select All
                                            </label>

                                        </div>
                                        <div class="filter-background-result">
                                            <div class="">
                                                <table class="table table-striped filter-tbody-fix">
                                                    <tbody>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                        <tr>
                                                            <th><input type="checkbox"></th>
                                                            <th>Tags</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="filter-control-container container-fluid center">
                                            <button class="btn">Save</button>
                                            <button class="btn">Remove</button>
                                            <button class="btn">Share</button>
                                        </div>
                                    </div>
                                    <div class="filter-background-toggle center filter-text" feed="1">
                                        <i class="icon-arrow-down"></i>Advanced Filters <i class="icon-arrow-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="feed-background-result">
                                <div class="tile-container">
                                    <div class="accordion" id="accordion1">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle  title-font-size" data-toggle="collapse" data-parent="#accordion1" href="#f1collapse1">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f1collapse1" class="accordion-body collapse">
                                                <div class="accordion-inner">                         
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle title-font-size" data-toggle="collapse" data-parent="#accordion1" href="#f1collapse2">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f1collapse2" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-background-control">
                                <div class="container-fluid">
                                    <div class="feed-control-prev span6 center">
                                        <a href="#" class="icon-chevron-left"></a>
                                    </div>
                                    <div class="feed-control-next span6 center">
                                        <a href="#" class="icon-chevron-right"></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="feed2" class="span4 feed feed-parent-relative hidden-tablet hidden-phone">
                    <div id="feed1-container" class="feed-border feed-parent-relative">
                        <div class="row-fluid">
                            <div id="feed1-control" class="feed-child-absolute">
                                <div class="filter-background-control">
                                    <div class="filter-control-select-fix center">
                                        <select>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>

                                        <button class="btn">Go</button>
                                    </div>
                                </div>
                            </div>
                            <div class="feed-background-result-nuf">
                                <div class="tile-container">
                                    <div class="accordion" id="accordion2">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle  title-font-size" data-toggle="collapse" data-parent="#accordion2" href="#f2collapse1">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f2collapse1" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle title-font-size" data-toggle="collapse" data-parent="#accordion2" href="#f2collapse2">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f2collapse2" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-background-control">
                                <div class="container-fluid">
                                    <div class="feed-control-prev span6 center">
                                        <a href="#" class="icon-chevron-left"></a>
                                    </div>
                                    <div class="feed-control-next span6 center">
                                        <a href="#" class="icon-chevron-right"></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="feed3" class="span4 feed-site feed-parent-relative hidden-phone">
                    <div id="feed1-container" class="feed-border feed-parent-relative">
                        <div class="row-fluid">  
                            <div class="feed-site-title center">
                                <h4>Nibbler Feed</h4>
                            </div>
                            <div class="feed-site-background-result">
                                <div class="tile-container">
                                    <div class="accordion" id="accordion3">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle  title-font-size" data-toggle="collapse" data-parent="#accordion3" href="#f3collapse1">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f3collapse1" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle title-font-size" data-toggle="collapse" data-parent="#accordion3" href="#f3collapse2">
                                                    <b>This is a title that clocks in at a maximum of 70 characters of text!!</b>
                                                </a>
                                            </div>
                                            <div id="f3collapse2" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <div class="row-fluid">
                                                        <div class="tile-tldr">
                                                            <p>This is the TL;DR section that clocks in at a maximum of 140 characters. If you can't get your point across in this plus the Title, fuck ya.</p>
                                                            <div class="row-fluid center">
                                                                <p> <b><a href="#">Read more...</a></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid tile-data-padding center">
                                                        <div class="tile-votes span3">
                                                            <i class="icon-thumbs-up"></i>(12|200)                                                      
                                                        </div>
                                                        <div class="tile-comments span3">
                                                            <i class="icon-comment"></i> 230
                                                        </div>

                                                        <div class="tile-age span3">
                                                            <i class="icon-time"></i> 53<grey> min</grey>
                                                        </div>
                                                        <div class="tile-author span3">
                                                            <i class="icon-user"></i> Alduron
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-site-background-control">
                                <div class="container-fluid">
                                    <div class="feed-control-prev span6 center">
                                        <a href="#" class="icon-chevron-left"></a>
                                    </div>
                                    <div class="feed-control-next span6 center">
                                        <a href="#" class="icon-chevron-right"></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
