<?php
?>
<div class="comment-reply-container-cg control-group">
    <form class="form-horizontal comment-reply-form" comment_id="<?php echo $this->comment_id?>" parent="<?php echo $this->parent ?>" method="post" action="<?php echo URL?>comment/xhrSubmitComment">
        <textarea name="comment" rows="5" placeholder="Add a comment!"></textarea>
        <input name="article_id" type="hidden" value="<?php echo $this->article_id ?>">
        <input name="parent" type="hidden" value="<?php echo $this->parent ?>">
        <button class="btn">Add Comment</button>
    </form>
</div>
