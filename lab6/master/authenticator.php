<?php
    $sender = $_POST['sender'] ?? NULL;
    switch($sender) {
        case "logout":
            echo "Logout fire";
            break;
        case "signIn":
            echo "Sign In fire";
            break;
        case "signUp":
            echo "Sign Up Fire";
            break;
    }
?>