<?php
    if(!isset($prevPage)) $prevPage = "#";
    $_SESSION['mode'] = 'admin';
?>

<div id="dimmer"></div>

<section id="signupForm" class="dimmerOverlay">
    <form action="/master/authenticator.php" method="POST">
        <h3 class="formCenter">Sign Up</h3>

        <hr>
        <label>Email: <input class="txtBox" type="text" name="email"></label>
        <label>User ID: <input class="txtBox" type="text" name="userId"></label>
        <label>Password: <input class="txtBox" type="text" name="pass"></label>
        <label>Password (repeat): <input class="txtBox" type="text" name="pass2"></label>
        <label>First name: <input class="txtBox" type="text" name="fName"></label>
        <label>Last name: <input class="txtBox" type="text" name="lName"></label>
        <p class="formCenter">Administrator:</p>
        <div class="formCenter">
            <label><input type="radio" name="isAdmin" value="false" checked> No</label>
            <label><input type="radio" name="isAdmin" value="true"> Yes</label>
        </div>

        <hr>
        <div class="formCenter">
            <input class="formBtn" type="submit">
            <input class="formBtn" type="reset">
            <button class="formBtn"><a href="<?php echo $prevPage; ?>">Cancel</a></button>
        </div>

        <input type="hidden" name="sender" value="signUp">
    </form>
</section>