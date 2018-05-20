<?php
    // Some debug functions
    $stopExec = $_GET['debug'] ?? false;

    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbfunctions.php");

    // Get sending page info
    $prevPage = $_POST['prevPage'] ?? NULL;
    $sender = $_POST['sender'] ?? NULL; // Name of form that sent request

    // User info                        // Used by
    $email = $_POST['email'] ?? NULL;   // signIn, signUp
    $pass1 = $_POST['pass'] ?? NULL;    // signIn, signUp
    $pass2 = $_POST['pass2'] ?? NULL;   // signUp

    var_dump($pass2);

    // Validate passwords typed correct if signUp (hacky because no JS allowed)
    if($pass1 === $pass2) $passHash = password_hash($pass1, PASSWORD_DEFAULT);
    else if($pass1 !== $pass2 && $pass2) {
        header("Location: $prevPage?action=signUp&err=pwd_no_match");
        exit;
    }

    // Extended sign up info
    $isAdmin = $_POST['isAdmin'] ?? 0; // Whether user is trying to register administrator
    $fName = $_POST['fName'] ?? NULL; // First name (optional)
    $lName = $_POST['lName'] ?? NULL; // Last Name (optional)

    // Decide authentication action based on sending form
    switch($sender) {
        case "signIn":
            $userId = validateUser($email, $pass1);
            if(!$userId) {
                $_SESSION['lastFormInfo'] = [
                    'email' => $email;
                    'guess' => $pass1;
                ];
                header("Location: $prevPage?action=$sender&err=login_invalid");
                exit;
            }

            $_SESSION['userId'] = $userId;
            break;
        case "signUp":
            $verified = $_SESSION['verifiedAdmin'] ?? false;
            if($isAdmin) {
                if(!$verified) {
                    header("Location: /lab6/admin/forms/validateadmin.php");
                    exit;
                }


            }

            addUser($email, $passHash, $verified, $fName, $lName);

            // TODO:Switch active user
            break;
        case "logout":
            $_SESSION['userId'] = NULL; // Null active user
            break;
        default: // DEBUG
            $stopExec = true;
            break;
    }

    if($stopExec) { // No one should see this, hence echo is sloppy
        echo "sender: $sender <br>"; // Sending form
        echo "<a href='$prevPage'>prevPage: </a><br>"; // Page redirected from

        echo "<br>user id: " . $_SESSION['userId'] . '<br>'; // Id of logged in user

        echo "<br><a href='/lab6/index.php'>Return to index</a>";

        return 0;
    }

    // Redirect to previous page
    if($prevPage) {
        header("Location: $prevPage?");
        exit;
    } else { // Or index if that's missing for whatever reason
        header("Location: /lab6/index.php?");
        exit;
    }
?>