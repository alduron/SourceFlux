<div class="NUF_controller" id="NUF_controller_<?php echo $this->feed; ?>">
    I want to view: <?php echo $this->feed; ?>
    <form id="NUF_selector_<?php print_r($this->feed); ?>" action="<?php echo URL; ?>nonuserfeed/xhrRunSelector" method="post">
        <select  name="selected">
            <?php echo($this->selectorOptions) ?>
        </select>
        <input name="feed" type="text" hidden="true" value="<?php echo $this->feed; ?>"/>
        <input type="submit" value="Go"/>
    </form>
</div>
<div class="NUF_results" id="NUF_results_<?php echo $this->feed; ?>">

</div>
<div class="NUF_page" id="NUF_page_<?php echo $this->feed; ?>">
    <a id="NUF_results_reverse_<?php echo $this->feed; ?>" href="">Previous</a>
    <a id="NUF_results_advance_<?php echo $this->feed; ?>" href="">Next</a>
</div>