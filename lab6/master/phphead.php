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

        // This is not the page you are looking for
        if($isAdminPage && !$userInfo['admin_id']) {
            header("Location: /lab6/index.php");
            exit;
        }
    }
?>