<?php

use Services\SessionService;
?>
<div class="row-fluid">
    <div class="container-fluid">
        <div id="feed1" class="span4 feed feed-parent-relative">
            <div id="feed1-container" class="feed-border feed-parent-relative">
                <div class="row-fluid">
                    <?php
                    if (SessionService::get('loggedIn') == true) {

                        $this->uf1->display();
                    } else {
                        $this->nuf1->display();
                    }
                    ?>
                </div>
            </div>
        </div>



        <div id="feed2" class="span4 feed feed-parent-relative hidden-tablet hidden-phone">
            <div id="feed2-container" class="feed-border feed-parent-relative">
                <div class="row-fluid">
                    <?php
                    if (SessionService::get('loggedIn') == true) {

                        $this->uf2->display();
                    } else {
                        $this->nuf2->display();
                    }
                    ?>
                </div>
            </div>
        </div>



        <div id="feed3" class="span4 feed-site feed-parent-relative hidden-phone">
            <div id="feed3-container" class="feed-border feed-parent-relative">
                <div class="row-fluid">
                    <?php $this->sf->display(); ?>
                </div>
            </div>
        </div>
    </div>
</div>