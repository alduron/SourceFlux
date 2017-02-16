<?php
if ($this->tagObjs[0]->hasTag()) {
    foreach ($this->tagObjs as $tagObj) {
        ?>
        <tr id="<?php echo $tagObj->getTagName() ?>">
            <td>
                <?php echo $tagObj->getTagName() ?>
            </td>
            <td>
                <div class="center">
                    <i id="<?php echo $tagObj->getTagName() ?>" data-toggle="tooltip" data-placement="top" data-original-title="Remove" class="icon-trash tag-list-remove"></i>
                </div>
            </td>
        </tr>
        <?php
    }
}
?>
<div class="tr-radius">
    <tr>
        <td>
            <div id="tag-input-name-cg" class="control-group control-group-margin">
                <input id="tag-input-name" autocomplete="off" data-provide="typeahead" data-items="5" data-source="" class="span tag-input-keyup" type="text" maxlength="25" placeholder="Tag Name">
            </div>
        </td>
        <td>
            <div class="center">
                <i id="tag-input-add" data-toggle="tooltip" data-placement="top" data-original-title="Add" class="icon-ok"></i>
            </div>
        </td>
    </tr>
</div>