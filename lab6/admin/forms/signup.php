<?php
    // To access admin signup-> go to any restricted page while logged out (docroot - /lab6/admin/index.php) -> page will show auth prompt, click sign up
    // Already created admin accout -> email: admin@traderdans.net pass: Qwaszx4321
    // Admin table entry must be inserted to db manually, where admin_id is a 128 uuid expressed in base 16 (32 chars - 1 nibble/char)

    // Output errors
    $msg = array();

    $err = filter_input(INPUT_GET, 'err', FILTER_SANITIZE_STRING) ?? NULL;
    if($err) {
        $returnQS = 'action=signUp';
        if($err === 'email_already_registered') $msg[] = "Email is already taken";
        if($err === 'pwd_no_match') $msg[] = "Passwords do not match";

        include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/msgbox.php");
    }

    $email = $_SESSION['lastFormInfo']['email'] ?? NULL;
    $fName = $_SESSION['lastFormInfo']['fName'] ?? NULL;
    $lName = $_SESSION['lastFormInfo']['lName'] ?? NULL;
?>

<div id="dimmer"></div>

<section id="adminSignupForm" class="dimmerOverlay">
    <form action="/lab6/master/authenticator.php" method="POST">
        <h3 class="formCenter">Admin Sign Up</h3>

        <hr>
		<label>EID: <input class="txtBox" type="text" name="employeeId" required></label>
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
        <input type="hidden" name="sender" value="adminSignUp">
    </form>
</section>