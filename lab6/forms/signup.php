<?php
    $msg = array();

    $err = filter_input(INPUT_GET, 'err', FILTER_SANITIZE_STRING) ?? NULL;
    if($err) { // Output errors returned from authenticator
        $returnQS = 'action=signUp';
        if($err === 'email_already_registered') $msg[] = "Email is already taken";
        if($err === 'pwd_no_match') $msg[] = "Passwords do not match";

        include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/msgbox.php");
    }

    // Get info to re-populate form
    $email = $_SESSION['lastFormInfo']['email'] ?? NULL;
    $fName = $_SESSION['lastFormInfo']['fName'] ?? NULL;
    $lName = $_SESSION['lastFormInfo']['lName'] ?? NULL;
?>

<!-- Blank div to create a page fancy dimmer effect, with no js -->
<div id="dimmer"></div>

<section id="signupForm" class="dimmerOverlay">
    <form action="/lab6/master/authenticator.php" method="POST">
        <h3 class="formCenter">Sign Up</h3>

        <hr>
        <label>Email: <input class="txtBox" type="text" name="email" value="<?php echo $email ?>" required></label>
        <label>Password: <input class="txtBox" type="password" name="pass" required></label>
        <label>Password (repeat): <input class="txtBox" type="password" name="pass2" required></label>
        <label>First name: <input class="txtBox" type="text" name="fName" value="<?php echo $fName ?>" required></label>
        <label>Last name: <input class="txtBox" type="text" name="lName" value="<?php echo $lName ?>" required></label>

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