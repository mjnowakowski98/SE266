<section id="header">
    <h1>(TMP) Shopping cart project</h1>

    <?php
        session_start();
        $user = $_SESSION['userId'] ?? NULL;

        $doc = new DOMDocument();

        if($user) {
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

<?php
    $action = $_GET['action'] ?? NULL;
    $prevPage = $_SERVER['PHP_SELF'];

    switch($action) {
        case 'logout':
            if(!$_SESSION['userId']) break;
            echo "LOGOUT ACTION";

            $url = "http://" . $_SERVER['SERVER_NAME'] . "/lab6/master/authenticator.php";
            $curlHandle = curl_init($url); // Get handle to curl object
            curl_setopt($curlHandle, CURLOPT_POST, TRUE);

            $postData = [
                'sender'=>'logout',
                'prevPage'=>$prevPage,
                'sessionId'=>session_id()
            ];
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postData);

            session_write_close();
            curl_exec($curlHandle); // Execute curl

            // Output curl errors if any
            if($errno = curl_errno($curlHandle)) {
                $error_message = curl_strerror($errno);
                echo "cURL error ({$errno}):\n {$error_message}";
            }

            curl_close($curlHandle); // Close object handle and return memory
            break;
        case 'signUp':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/signup.php");
            break;
        case 'signIn':
            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
            break;
        default:
            break;
    }
?>