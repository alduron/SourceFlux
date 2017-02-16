<?php
if($this->data == 1)
{
    echo('Please add tags!');
} else {
?>


<div class="tag_container" value="<?php echo $this->data['tag_id']; ?>">
    <div class="result_chkbx">
        <input class="tag_chkbx_<?php echo $this->feed?>" value="<?php echo $this->data['tag_id']; ?>"type="checkbox"></input>
    </div>
    <div class="result_tag" value="<?php echo $this->data['tag_id']; ?>">

        <?php echo $this->data['tag_name']; ?>
    </div>
</div>
<?php
}
?>