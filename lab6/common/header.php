<section id="header">
    <h1>Trader Dan's Space Parts Emporium</h1>
</section>

<section id="nav">
    <?php
        $doc = new DOMDocument();

        if($user) {
            echo "Welcome, " . $userInfo['first_name'] . ' ' . $userInfo['last_name'];
            $doc->appendChild($doc->createElement('br'));

            if($userInfo['admin_id']) {
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