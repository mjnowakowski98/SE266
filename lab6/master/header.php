<?php
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbfunctions.php");

    $user = $_SESSION['userId'] ?? NULL;

    $action = $_GET['action'] ?? NULL;
    $prevPage = $_SERVER['PHP_SELF'];
    $isAdminPage = $isAdminPage ?? NULL;

    switch($action) {
        case 'logout':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/logout.php");
            break;
        case 'signUp':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/signup.php");
            break;
        case 'signIn':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            break;
        default:
            if(!$user && $isAdminPage)
                include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            break;
    }
?>

<section id="header">
    <h1>Trader Dan's Space Parts Emporium</h1>
</section>

<section id="nav">
    <p style="display:inline">-------Filler, nav will be flushed out later-------
        -------------------------------------------------------------------------
        -------------------------------------------------------------------------
    </p>

    <?php
        $doc = new DOMDocument();

        if($user) {
            $userInfo = getUserInfo($user);
            echo "Welcome, " . $userInfo['first_name'] . ' ' . $userInfo['last_name'];
            $doc->appendChild($doc->createElement('br'));

            if($userInfo['is_admin']) {
                $adminPage = $doc->createElement('a');
                $adminPage->appendChild($doc->createTextNode('Admin panel'));
                $adminPage->setAttribute('href', "http://" . $_SERVER['SERVER_NAME'] . "/lab6/admin/index.php");
                $doc->appendChild($adminPage);

                $doc->appendChild($doc->createTextNode(' | '));
            }

            $logout = $doc->createElement("a");
            $logout->appendChild($doc->createTextNode("Logout"));
            $logout->setAttribute("href", "?action=logout");
            $doc->appendChild($logout);
        } else {
            $signIn = $doc->createElement("a");
            $signIn->appendChild($doc->createTextNode("Sign In"));
            $signIn->setAttribute("href", "?action=signIn");
            $doc->appendChild($signIn);

            $doc->appendChild($doc->createTextNode(' | '));

            $signUp = $doc->createElement("a");
            $signUp->appendChild($doc->createTextNode("Sign Up"));
            $signUp->setAttribute("href", "?action=signUp");
            $doc->appendChild($signUp);
        }

        echo $doc->saveHTML();      
    ?>
</section>
<hr>