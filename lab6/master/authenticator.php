<h1>Authentication Page</h1>
<hr>
<h3>Some information</h3>

<?php
    session_start();

    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbfunctions.php");

    $prevPage = $_POST['prevPage'] ?? NULL;
    $sender = $_POST['sender'] ?? NULL;

    $email = $_POST['email'] ?? NULL;
    $pass1 = $_POST['pass'] ?? NULL;
    $pass2 = $_POST['pass2'] ?? NULL;
    if($pass1 === $pass2) $passHash = password_hash($pass1, PASSWORD_DEFAULT);
    else {
        header("Location: $prevPage?action=$sender");
    }

    $guess = $_POST['pass'] ?? NULL;
    $isAdmin = $_POST['isAdmin'] ?? 0;
    $fName = $_POST['fName'] ?? NULL;
    $lName = $_POST['lName'] ?? NULL;

    echo "Sender: " . $sender . "<br>";

    switch($sender) {
        case "signIn":
            $userId = validateUser($email, $guess);
            $_SESSION['userId'] = $userId;
            var_dump($_SESSION['userId']);
            break;
        case "signUp":
            // TODO:
            // Check admin -> validate admin
            addUser($email, $passHash, $isAdmin, $fName, $lName);
            // Switch active user
            break;
        case "logout":
            $_SESSION['userId'] = NULL; // Null active user
            break;
        default: // Generic in case of direct connection
            break;
    }       

    $doc = new DOMDocument();
    $link = $doc->createElement("a");
    $link->appendChild($doc->createTextNode("Return to: " . $prevPage));
    $link->setAttribute("href", $prevPage . '?');
    $doc->appendChild($link);

    echo $doc->saveHTML();

    // Uncomment to prevent auto-redirection
    //return 0;

    if($prevPage) {
        header("Location: $prevPage?");
        exit;
    } else {
        header("Location: " .$_SERVER['DOCUMENT_ROOT'] . "/lab6/index.php?");
        exit;
    }
?>