<?php
foreach ($this->tileObjArray as $tileObj) {
    ?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle  title-font-size" data-toggle="collapse" data-parent="#accordion<?php echo $this->feed ?>" href="#feed<?php echo $this->feed ?>collapse<?php echo $tileObj->getArticleID() ?>">
                <b><?php echo $tileObj->getTitle() ?></b>
            </a>
        </div>
        <div id="feed<?php echo $this->feed ?>collapse<?php echo $tileObj->getArticleID() ?>" class="accordion-body collapse">
            <div class="accordion-inner">                         
                <div class="row-fluid">
                    <div class="tile-tldr">
                        <p><?php echo $tileObj->getTldr() ?></p>
                        <div class="row-fluid center">
                            <p> <b><a href="<?php echo URL . 'article/view/' . $tileObj->getCleanURL() . '&id=' . $tileObj->getArticleID() ?>">Read more...</a></b></p>
                        </div>
                    </div>
                </div>
                <div class="row-fluid tile-data-padding center">
                    <div class="tile-votes span3">
                        <i class="icon-thumbs-up"></i>(<?php echo $tileObj->getUpVotes() ?> | <?php echo $tileObj->getDownVotes() ?>)                                                      
                    </div>
                    <div class="tile-comments span3">
                        <i class="icon-comment"></i> <?php echo $tileObj->getNumComments() ?>
                    </div>

                    <div class="tile-age span3">
                        <i class="icon-time"></i> <?php echo $tileObj->getTimeDispNum() ?><grey> <?php echo $tileObj->getTimeDispSuffix() ?></grey>
                    </div>
                    <div class="tile-author span3">
                        <i class="icon-user"></i> <?php echo $tileObj->getAuthorName() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>