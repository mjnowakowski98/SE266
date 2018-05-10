<?php
    if(session_name() == 'genericSession') {
        $mode = 'anonymous';
    }
?>


<div id="dimmer"></div>

<section id="signupForm" class="dimmerOverlay">
    <form action="#" method="POST">
        <label>User ID: <input class="txtBox" type="text" name="uName"></label>
        <label>Password: <input class="txtBox" type="text" name="pass"></label>
        <label>Password (repeat): <input class="txtBox" type="text" name="p2"></label>
        <label>First name: <input class="txtBox" type="text" name="fName"></label>
        <label>Last name: <input class="txtBox" type="text" name="lName"></label>
        <label>Email: <input class="txtBox" type="text" name="email"></label>
        <p class="formCenter">Administrator:</p>
        <div class="formCenter">
            <label><input type="radio" name="isAdmin" value="false"> No</label>
            <label><input type="radio" name="isAdmin" value="true"> Yes</label>
        </div>

        <hr>
        <div class="formCenter">
            <input class="formBtn" type="submit">
            <input class="formBtn" type="reset">
        </div>
    </form>
</section>