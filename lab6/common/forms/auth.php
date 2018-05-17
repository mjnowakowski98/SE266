<?php
    $isAdminPage = $isAdminPage ?? NULL;
    if($isAdminPage) $prevPage = "/lab6/index.php";
?>

<div id="dimmer"></div>

<section id="authForm" class="dimmerOverlay">
    <form action="/lab6/master/authenticator.php" method="POST">
        <h3 class="formCenter">Sign In</h3>

        <hr>
        <label>User ID: <input class="txtBox" type="text" name="userId"></label>
        <label>Password: <input class="txtBox" type="text" name="pass"></label>

        <hr>
        <div class="formCenter">
            <input class="formBtn" type="submit">
            <input class="formBtn" type="reset">
            <button class="formBtn" type="button"><a href="<?php echo $prevPage; ?>">Cancel</a></button>
            <button class="formBtn" type="button"><a href="?action=signUp">Sign Up</a></button>
        </div>

        <input type="hidden" name="prevPage" value="<?php echo $prevPage; ?>">
        <input type="hidden" name="sender" value="signIn">
    </form>
</section>