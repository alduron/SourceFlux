<div class="UF_controller" id="UF_controller_<?php echo $this->feed; ?>">
    <form id="UF_tag_input_<?php echo $this->feed; ?>" action="<?php echo URL; ?>filter/xhrSetTag">
        <input name="tag_<?php echo $this->feed; ?>" type="text" value="Enter Tags" size="30"></input>
        <input name="feed" type="text" hidden="true" value="<?php echo $this->feed; ?>"/>
        <input name="submit" action="submit" type="submit"></input>
        <div class="UF_filter_toggle" id="UF_filter_toggle_<?php echo $this->feed; ?>">
            Advanced Filters
        </div>
    </form>
    <div class="UF_filter_box" id="UF_filter_box_<?php echo $this->feed; ?>">
        <input class="UF_filter_box_selectall" id="UF_filter_box_selectall_<?php echo $this->feed; ?>"type="checkbox"></input>
        <div class="UF_filter_results" id="UF_filter_results_<?php echo $this->feed; ?>">

        </div>
        <div class="UF_filter_control" id="UF_filter_control_<?php echo $this->feed; ?>">
            <form id="UF_filter_control_save_<?php echo $this->feed;?>" action="filter/xhrSaveTags"> 
                <input name="submit" action="submit" type="submit" value="Save"></input>
            </form>
            <form id="UF_filter_control_remove_<?php echo $this->feed;?>" action="filter/xhrRemoveTags"> 
                <input name="submit" action="submit" type="submit" value="Remove"></input>
            </form>
            <form id="UF_filter_control_share_<?php echo $this->feed;?>" action="filter/xhrShareTags"> 
                <input name="submit" action="submit" type="submit" value="Share"></input>
            </form>
        </div>
    </div>
</div>
<div class="UF_results" id="UF_results_<?php echo $this->feed; ?>"></div>
<div class="UF_page">
    <a id="UF_results_reverse_<?php echo $this->feed;?>" href="">Previous</a>
    <a id="UF_results_advance_<?php echo $this->feed;?>" href="">Next</a>
</div>