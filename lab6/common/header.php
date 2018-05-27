<?php
    // Setup page behavior
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    if(!$isAdminPage && !$requireUser) $prevPage = $_SERVER['PHP_SELF'];
    else $prevPage = "/lab6/index.php";

    switch($action) {
        case 'logout': // Use form to logout to post sender to /master/authenticator.php
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/logout.php");
            break;

        case 'signUp':
            if(!$isAdminPage)
                include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/forms/signup.php");
            else
                include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/admin/forms/signup.php");

            if($isAdminPage || $requireUser) exit;
            break;

        case 'signIn':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            if($isAdminPage || $requireUser) exit;
            break;

        default:
            // If no user logged in, no valid action and bad login...
            if(!$user && ($isAdminPage || $requireUser))  { // ... Show sign in
                include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
                exit; // Make the rest of the page useless, otherwise one could pickup sign-in-be-gone from inspect element
            }
            break;
    }
?>

<section id="header">
    <h1>Trader Dan's Space Parts Emporium</h1>
</section>

<section id="nav">
    <?php
        $doc = new DOMDocument();

        if($user) {
            echo "Welcome, " . $userInfo['first_name'] . ' ' . $userInfo['last_name'];
            $doc->appendChild($doc->createElement('br'));
        }

        $index = $doc->createElement("a");
        $index->appendChild($doc->createTextNode("Index"));
        $index->setAttribute('href', "/lab6/index.php");
        $doc->appendChild($index);

        $doc->appendChild($doc->createTextNode(' | '));

        if($_SERVER['QUERY_STRING'])
            $oldQS = '&' . $_SERVER['QUERY_STRING'];
        else $oldQS = NULL;

        if($user) {
            if($userInfo['admin_id']) {
                $adminPage = $doc->createElement('a');
                $adminPage->appendChild($doc->createTextNode('Admin panel'));
                $adminPage->setAttribute('href', "/lab6/admin/index.php");
                $doc->appendChild($adminPage);

                $doc->appendChild($doc->createTextNode(' | '));
            } else {
                $cart = $doc->createElement("a");
                $cart->appendChild($doc->createTextNode("Your cart"));
                $cart->setAttribute('href', "/lab6/cart.php");
                $doc->appendChild($cart);

                $doc->appendChild($doc->createTextNode(' | '));
            }

            $logout = $doc->createElement("a");
            $logout->appendChild($doc->createTextNode("Logout"));
            $logout->setAttribute("href", "?action=logout" . $oldQS);
            $doc->appendChild($logout);
        } else {
            $signIn = $doc->createElement("a");
            $signIn->appendChild($doc->createTextNode("Sign In"));
            $signIn->setAttribute("href", "?action=signIn" . $oldQS);
            $doc->appendChild($signIn);

            $doc->appendChild($doc->createTextNode(' | '));

            $signUp = $doc->createElement("a");
            $signUp->appendChild($doc->createTextNode("Sign Up"));
            $signUp->setAttribute("href", "?action=signUp" . $oldQS);
            $doc->appendChild($signUp);
        }

        echo $doc->saveHTML();      
    ?>
</section>
<hr>