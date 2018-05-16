<?php
    session_start();

    echo "Authenticating <br>";

    $prevPage = $_POST['prevPage'] ?? NULL;
    $sender = $_POST['sender'] ?? NULL;

    echo "Sender: " . $sender . "<br>";

    switch($sender) {
        case "signIn":
            $_SESSION['userId'] = "GenericUser";
            break;
        case "signUp":
            break;
        case "logout":
            $_SESSION['userId'] = NULL;
            break;
        default:
            break;
    }       

    $doc = new DOMDocument();
    $link = $doc->createElement("a");
    $link->appendChild($doc->createTextNode("Return to: " . $prevPage));
    $link->setAttribute("href", $prevPage . '?');
    $doc->appendChild($link);

    echo $doc->saveHTML();

    // Uncomment to prevent auto-redirection
    return 0;

    if($prevPage) {
        header("Location: $prevPage?");
        exit;
    } else {
        header("Location: " .$_SERVER['DOCUMENT_ROOT'] . "/lab6/index.php?");
        exit;
    }
?>