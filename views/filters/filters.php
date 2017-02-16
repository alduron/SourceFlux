<?php
if ($this->tagObjects[0]->hasTag() == FALSE) {
    echo'<tr><th>Please add tags!</th></tr>';
} else {
    foreach ($this->tagObjects as $tagObject) {
        ?>
        <tr>
            <th><input class="tag-chkbx-<?php echo $this->feed?>" value="<?php echo $tagObject->getTagID() ?>" type="checkbox"></th>
            <th><?php echo $tagObject->getTagName() ?></th>
        </tr>
        <?php
    }
}
?>
