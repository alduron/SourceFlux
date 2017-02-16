<div id="feed<?php echo $this->feed; ?>-control" class="feed-child-absolute">
    <div class="filter-background-control">
        <div id="filter-tag-input-<?php echo $this->feed ?>-cg" class="control-group control-group-margin center">
            <form id="UF-tag-input-<?php echo $this->feed; ?>" class="UF-filter-form-tag" action="<?php echo URL; ?>filter/xhrSetTag">
                <input class="filter-tag-input" id="filter-tag-input<?php echo $this->feed ?>" name="tag_<?php echo $this->feed ?>" feed="<?php echo $this->feed ?>" type="text" placeholder="Tag Name" autocomplete="off" data-provide="typeahead" data-items="4" data-source="[&quot;Test&quot;,&quot;Short&quot;,&quot;Long&quot;,&quot;Nibbler&quot;]">

                <button class="btn">Add</button>
            </form>
        </div>
    </div>
    <div class="filter-toggle-container">
        <div id="feed<?php echo $this->feed; ?>-filter" class="filter">
            <div class="filter-select-bar">
                <label class="checkbox">
                    <input class="UF-filter-box-selectall"id="UF-filter-box-selectall-<?php echo $this->feed; ?>" type="checkbox"> Select All
                </label>

            </div>
            <div class="filter-background-result">
                <div id="feed-table-container">
                    <table class="table table-striped filter-tbody-fix">
                        <tbody id="feed<?php echo $this->feed; ?>-tag-table">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="filter-control-container container-fluid center">
                <form class="span4" id="UF-filter-control-save-<?php echo $this->feed; ?>" action="filter/xhrSaveTags"> 
                    <button class="btn disabled">Save</button>
                </form>
                <form class="span4" id="UF-filter-control-remove-<?php echo $this->feed; ?>" action="filter/xhrRemoveTags"> 
                    <button class="btn">Remove</button>
                </form>
                <form class="span4" id="UF-filter-control-share-<?php echo $this->feed; ?>" action="filter/xhrShareTags"> 
                    <button class="btn disabled">Share</button>
                </form>
            </div>
        </div>
        <div class="filter-background-toggle center filter-text" feed="<?php echo $this->feed; ?>">
            <i class="icon-chevron-down"></i>Advanced Filters <i class="icon-chevron-down"></i>
        </div>
    </div>
</div>



<div class="feed-background-result-uf" id="feed-background-result-uf-<?php echo $this->feed ?>">
    <div class="tile-container">
        <div class="accordion" id="accordion<?php echo $this->feed; ?>">
        </div>
    </div>

</div>