<div id="dimmer"></div>

<section id="logoutForm" class="dimmerOverlay">
    <form action="/lab6/master/authenticator.php" method="POST">
        <h3 class="formCenter">Logout?</h3>

        <hr>
        <div class="formCenter">
            <input class="formBtn" type="submit" value="Yes">
            <button class="formBtn" type="button"><a href="<?php echo $prevPage; ?>">No</a></button>

            <input type="hidden" name="prevPage" value="<?php echo $prevPage; ?>">
            <input type="hidden" name="sender" value="logout">
        </div>
    </form>
</section>