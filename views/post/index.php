<div class="container">
    <div class="row">
        <div class="span12 post-create-cotainer">
            <form id="post-form-build" class="form-horizontal" method="post" action="<?php echo URL; ?>post/submitArticle" >
                <div id="post-input-title-cg" class="control-group center row">
                    <div class="span8 offset2">
                        <h4>Article Title</h4>
                        <p><grey>Write a maximum of 70 characters for the title. Make sure it's catchy enough to draw attention!</grey></p>
                        <input id="post-input-title" class="span8" type="text" name="title" placeholder="Article Title" maxlength="70">
                    </div>
                </div>
                <div id="post-input-body-cg" class="control-group center row">
                    <div class="span8 offset2">
                        <h4>Article Body</h4>
                        <p><grey>Write the content of your article. Place all relevant information in the box below.</grey></p>
                        <textarea id="post-input-body" class="span8 no-resize" name="body" rows="15" placeholder="Article Body" maxlength="20000"></textarea>
                    </div>
                </div>
                <div id="post-input-tldr-cg" class="control-group center row">
                    <div class="span8 offset2">
                        <h4>TL;DR</h4>
                        <p><grey>Write a quick summary of your article in 140 characters or less.</grey></p>
                        <textarea id="post-input-tldr" class="span8 no-resize" name="tldr" row="3" placeholder="Article TL;DR" maxlength="140"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="control-group center">
                        <div class="span8 offset2 post-tag-editor">
                            <h4 class="center">Tag Manager</h4>
                            <p><grey>Add tags to your article. These tags will be used for searching, so make sure you add relevant tags!</grey></p>
                            <div class="post-tag-list">
                                <table class="table table-striped table-fix">
                                    <thead class="head-color">
                                        <tr>
                                            <th>Tag Name</th>
                                            <th>Control</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tag-container" class="row-fluid post-tag-result">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tag_search_list_element noblur"></div>
                            <div class="add_tags_to_article" id="add_tags_to_article"></div>
                        </div>
                    </div>
                    <div class="control-group center">
                        <div class="span8 offset2 post-source-editor">
                            <h4 class="center">Source Manager</h4>
                            <p><grey>Here you can add links to source material you may have used when creating your article.</grey></p>
                            <div class="post-source-list">
                                <table class="table table-striped table-fix">
                                    <thead class="head-color">
                                        <tr>
                                            <th>Display</th>
                                            <th>Link</th>
                                            <th>Control</th>
                                        </tr>
                                    </thead>
                                    <tbody id="source-container" class="row-fluid">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span8 offset2">
                            <button class="btn pull-right" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

