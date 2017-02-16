<?php
if ($this->sourceObjs[0]->hasLink()) {
    foreach ($this->sourceObjs as $source) {
        ?>

        <tr id="<?php echo $source->getUniqueID() ?>">
            <td>
                <div class="overflow-x">
                    <?php echo $source->getDisplayName(); ?>
                </div>
            </td>
            <td>
                <div class="overflow-x">
                    <a href="<?php echo $source->getLink() ?>"><?php echo $source->getLink() ?></a>
                </div>
            </td>
            <td>
                <div class="center">
                    <i  id="<?php echo $source->getUniqueID() ?>" data-toggle="tooltip" data-placement="top" data-original-title="Remove" class="icon-trash source-list-remove"></i>
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
            <div id="source-input-display-cg" class="control-group control-group-margin">
                <input id="source-input-display" class="span" type="text" maxlength="25" placeholder="Display">
            </div>
        </td>
        <td>
            <div id="source-input-link-cg" class="control-group control-group-margin">
                <input id="source-input-link" class="span" type="text" maxlength="1000" placeholder="Link">
            </div>
        </td>
        <td>
            <div class="center">
                <i id="source-input-add" data-toggle="tooltip" data-placement="top" data-original-title="Add" class="icon-ok"></i>
            </div>
        </td>
    </tr>
</div>