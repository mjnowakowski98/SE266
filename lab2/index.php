<!--
    SE266.05 Lab 2
    Matthew Nowakowski
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lab 2</title>
        <link href="./master.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Corporations App</h1>
        </header>
        <hr>
        <?php
           require_once("dbcontroller.php");
           require_once("dbfunctions.php");
           if(array_key_exists('action', $_REQUEST)) {
               $action = $_REQUEST['action'];
               if(array_key_exists('corpId', $_REQUEST) )$corpId = $_REQUEST['corpId'];
               switch($action) {
                    case "Read":
                        $corp = getCorp($corpId);
                        include_once("showCorp.php");
                        break;
                    case "Create":
                        include_once("corpForm.php");
                        break;
                    case "Add":
                        $corpName = $_REQUEST['corpName'];
                        $incDt = $_REQUEST['incDt'];
                        $email = $_REQUEST['email'];
                        $zip = $_REQUEST['zipcode'];
                        $owner = $_REQUEST['owner'];
                        $phone = $_REQUEST['phone'];
                        $count = addCorp($corpName, $incDt, $email, $zip, $owner, $phone);
                        var_dump($count);
                        //include_once("feedback.php");
                        break;
               }
            } else {
                $corporations = getRows();
                include_once("corporations.php");
            }
        ?>
    </body>
</html>