<div id="feed<?php echo $this->feed; ?>-control" class="feed-child-absolute">
    <div class="filter-background-control">
        <div class="filter-control-select-fix center">
            <form id="NUF-selector-<?php print_r($this->feed); ?>" action="<?php echo URL; ?>nonuserfeed/xhrRunSelector" feed="1" method="post">
                <select name="selected">
                    <?php
                    foreach ($this->groupObjArray as $groupObj) {
                        echo '<option value="' . $groupObj->getGroupID() . '">' . $groupObj->getGroupName() . '</option>';
                    }
                    ?>
                </select>
                <button class="btn">Go</button>
            </form>
        </div>
    </div>
</div>



<div class="feed-background-result-nuf" id="feed-background-result-nuf-<?php echo $this->feed?>">
    <div class="tile-container">
        <div class="accordion" id="accordion<?php echo $this->feed; ?>">
        </div>
    </div>
</div>



<!--<div class="feed-background-control">
    <div class="container-fluid">
        <div id="NUF-results-advance-<?php echo $this->feed?>" class="feed-control-prev span6 center">
            <a href="#" class="icon-chevron-left"></a>
        </div>
        <div id="NUF-results-advance-<?php echo $this->feed ?>" class="feed-control-next span6 center">
            <a href="#" class="icon-chevron-right"></a>
        </div>

    </div>
</div>-->