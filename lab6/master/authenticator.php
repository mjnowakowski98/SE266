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

    // Validate passwords typed correct if signUp (hacky because no JS allowed)
    if($pass1 === $pass2) $passHash = password_hash($pass1, PASSWORD_DEFAULT);
    else if($pass1 !== $pass2 && $pass2) {
        header("Location: $prevPage?action=signUp&err=pwd_no_match");
        exit;
    }

    // Extended sign up info
    $fName = $_POST['fName'] ?? NULL; // First name
    $lName = $_POST['lName'] ?? NULL; // Last Name

    $_SESSION['lastFormInfo'] = [ // Used to re-populate form data
        'email' => $email,
        'fName' => $fName,
        'lName' => $lName
    ];

    // Decide authentication action based on sending form
    switch($sender) {
        case "signIn":
            $userId = validateUser($email, $pass1); // Confirm user information
            if(!$userId) { // On fail, return with error
                // Return with error
                header("Location: $prevPage?action=$sender&err=login_invalid");
                exit;
            }

            // On success
            $_SESSION['userId'] = $userId; // Set active user
            break;
        case "signUp":
            // Add non-admin user, set active user
            $userId = addUser($email, $passHash, $fName, $lName, NULL);
            $_SESSION['userId'] = $userId;
            break;

        case "adminSignUp":
            $adminId = $_POST['employeeId'] ?? NULL; // Get EID from form
            if(verifyAdmin($adminId)) { // If valid employee
                $userId = addUser($email, $passHash, $fName, $lName, $adminId); // Add admin user
                updateAdminStatus($adminId, $userId); // Link user to admin table, disable registration

                $_SESSION['userId'] = $userId; // Set active user
            } else {
                // If invalid employee, return with error
                header("Location: $prevPage?action=$sender&err=admin_id_invalid");
                exit;
            }
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

    // Success redirects
    if($prevPage) {
        header("Location: $prevPage?");
        exit;
    } else { // Or index if that's missing for whatever reason
        header("Location: /lab6/index.php?");
        exit;
    }
?>