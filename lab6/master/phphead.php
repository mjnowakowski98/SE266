<?php // Initializes page information and authentication

    // Start session for current page
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbfunctions.php"); // Setup database functions

    // Check if page is defined as admin only
    $isAdminPage = $isAdminPage ?? NULL;

    // Get user if any
    $user = $_SESSION['userId'] ?? NULL;
    if($user) {
        $userInfo = getUserInfo($user); // If user exists get more info

        // This is not the administrative page you are looking for
        if($isAdminPage && !$userInfo['admin_id']) {
            header("Location: HTTP/1.1 404 Not Found");
            exit; // Side note: The url left in the browser is shady, different from an actual RNF
        }
    }

    // (Consider moving back to header.php)
    // Setup page behavior
    $action = $_GET['action'] ?? NULL;
    $prevPage = $_SERVER['PHP_SELF'];

    switch($action) {
        case 'logout': // Use form to logout to post sender to /master/authenticator.php
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/logout.php");
            break;
        case 'signUp':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/forms/signup.php");
            break;
        case 'adminSignUp':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/admin/forms/signup.php");
            break;
        case 'signIn':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            break;
        default: // If no user logged in, no valid action and page is admin only...
            if(!$user && $isAdminPage) // ... Show sign in
                include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            break;
    }
?>