<p>
<div class="comment-container comment-<?php echo $this->typeString ?>">
    <div class="comment-author" id="<?php echo $this->parent['DATA']->getAuthorID() ?>"> <?php $this->parent['DATA']->getAuthorID() ?></div>
    <div class="comment-content"><?php echo $this->parent['DATA']->getContent() ?></div>
    <div class="comment-controller">
        <i class="icon-user"></i> <?php echo $this->parent['DATA']->getUsername(); ?> | <i class="icon-time"></i> <?php echo $this->parent['DATA']->getDate() ?> | <a class="comment-reply" article_id="<?php echo $this->parent['DATA']->getArticleID() ?>" parent="<?php echo $this->parent['DATA']->getParent() ?>" comment_id="<?php echo $this->parent['DATA']->getCommentMessageID() ?>" action="<?php echo URL ?>comment/xhrGetReplyForm" href="#">Reply</a>
    </div>
    <div class="comment-results" id="comment-results-<?php echo $this->parent['DATA']->getCommentMessageID() ?>"></div>
    <div class="comment-children">
