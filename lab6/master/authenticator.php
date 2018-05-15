<?php
    session_start();

    $prevPage = $_POST['prevPage'] ?? NULL;
    $sender = $_POST['sender'] ?? NULL;

    switch($sender) {
        case "logout":
            echo "Logout fire";
            $_SESSION['userId'] = NULL;
            break;
        case "signIn":
            echo "Sign In fire";
            $_SESSION['userId'] = "GenericUser";
            break;
        case "signUp":
            echo "Sign Up Fire";
            break;
    }

    if($prevPage) {
        header("Location: $prevPage");
        exit;
    } else {
        header("Location: " .$_SERVER['DOCUMENT_ROOT'] . "/lab6/index.php");
    }
?>