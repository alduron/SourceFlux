<div id="logging">
    <div id="logging_user_control">
        Welcome, <?php echo $_SESSION['username']; ?> !
        <a href="<?php echo URL; ?>">Home</a>
        <a href="<?php echo URL; ?>dashboard">Profile</a>
        <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
    </div>
    <div id="post_news">
        <form id="post_news_form" action="<?php echo URL;?>post/create" method="post">
            <input type="submit" name="submit" value="New Post"></input>
        </form>
    </div>
</div>