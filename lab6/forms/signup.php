<div id="dimmer"></div>

<section id="signupForm" class="dimmerOverlay">
    <form action="/lab6/master/authenticator.php" method="POST">
        <h3 class="formCenter">Sign Up</h3>

        <hr>
        <label>Email: <input class="txtBox" type="text" name="email" required></label>
        <label>Password: <input class="txtBox" type="password" name="pass" required></label>
        <label>Password (repeat): <input class="txtBox" type="password" name="pass2" required></label>
        <label>First name: <input class="txtBox" type="text" name="fName" required></label>
        <label>Last name: <input class="txtBox" type="text" name="lName" required></label>

        <hr>
        <div class="formCenter">
            <input class="formBtn" type="submit">
            <input class="formBtn" type="reset">
            <button class="formBtn" type="button"><a href="<?php echo $prevPage; ?>">Cancel</a></button>
            <button class="formBtn" type="button"><a href="?action=signIn">Sign In</a></button>
        </div>

        <input type="hidden" name="prevPage" value="<?php echo $prevPage; ?>">
        <input type="hidden" name="sender" value="signUp">
    </form>
</section>