<div class="container">
    <div class="row">
        <div id="article-info" article="<?php echo $this->articleData->getArticleID() ?>"></div>
        <div class="span3 text-left">
            <div class="nav nav-list article-control-format">
                <div class="">
                    <i class="icon-user"></i> <?php echo $this->articleData->getAuthorName() ?>
                </div>
                <div class="">
                    <i class="icon-time"></i> <?php echo $this->articleData->getDate() ?>
                </div>
                <div class="">
                    <i class="icon-eye-open"></i> <?php echo $this->articleData->getNumViews() ?>
                </div>
                <div class="">
                    <i class="icon-comment"></i> <?php echo $this->articleData->getNumComments() ?>
                </div>
                <div class="">
                    <i class="icon-thumbs-up"></i> ( <upcolor><?php echo $this->articleData->getUpvotes() ?></upcolor> | <downcolor><?php echo $this->articleData->getDownvotes() ?></downcolor> )
                </div>

                <div class="article-voting">
                    <div class="article-voting-up"><i id="article-voting-up-icon" class="icon-chevron-up"></i>Like</div>
                    <div class="article-voting-down"><i id="article-voting-down-icon" class="icon-chevron-down"></i>Dislike</div>
                </div>
            </div>
        </div>

        <div class="span9 center">
            <div class="article-container-title">
                <h2><?php echo $this->articleData->getTitle(); ?></h2>
            </div> 

            <div class="text-left">
                <p><?php echo $this->articleData->getContent() ?></p>
            </div>

            <div class="text-left">
                <h4>TL;DR </h4><p><?php echo $this->articleData->getTldr(); ?></p>
            </div>

            <div class="row">
                <div class="span5">
                    <h5>Sources</h5>
                    <?php
                    $sources = $this->articleData->getSourceArray();

                    foreach ($sources as $source) {
                        ?>
                        <div class="article-source" id="<?php echo $source['article_sources_id'] ?>"><a href="<?php echo $source['link'] ?>"><?php echo $source['display_name'] ?></a></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="span4">
                    <h5>Tags</h5>
                    <?php
                    $tagNames = $this->articleData->getTagNames();

                    foreach ($tagNames as $name) {
                        echo $name['tag_name'] . ' ';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="span9 offset3">
            <div id="article-container-comments" value="<?php echo URL . 'comment/xhrLoadComments' ?>">
                <div id="article-container-comment-results">
                    <h4>No Comments</h4>
                </div>
                <div id="article-container-comment-controller">
<!--                    <div id="article_cont_com_control_more" action="<?php echo URL . 'comment/xhrLoadMore' ?>">MORE<?php ?>
                    </div>-->
                </div>
                <?php $this->render('messages/reply', true); ?>
            </div>
        </div>
    </div>
</div>


