<!--
    SE266.05 Lab 3
    Matthew Nowakowski
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lab 3</title>
        <link href="./master.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Corporations App</h1>
        </header>
        <hr>
        <?php
            function outCorpList() {
                $corporations = getRows();
                include_once("corporations.php");
            }

           require_once("dbcontroller.php");
           require_once("dbfunctions.php");
           if(array_key_exists('action', $_REQUEST)) {
               $action = $_REQUEST['action'];
               if(array_key_exists('corpId', $_REQUEST)) $corpId = $_REQUEST['corpId'];
               switch($action) {
                    case "Read":
                        $corp = getCorp($corpId);
                        include_once("showCorp.php");
                        break;
                    case "Update":
                        $corp = getCorp($corpId);
                        $mode = "Save";
                        include_once("corpForm.php");
                        break;
                    case "Save":
                        $count = updateCorp($corpId);
                        echo "$count rows affected.";

                        $mode = "Save";
                        $corp = getCorp($corpId);
                        include_once("corpForm.php");
                        break;
                    case "Delete":
                        $count = deleteCorp($corpId);
                        echo "$count rows affected <hr>";
                        outCorpList();
                        break;
                    case "Create":
                        $mode = "Add";
                        include_once("corpForm.php");
                        break;
                    case "Add":
                        $mode = "Add";
                        $corpName = $_REQUEST['corpName'];
                        $incDt = $_REQUEST['incDt'];
                        $email = $_REQUEST['email'];
                        $zip = $_REQUEST['zipcode'];
                        $owner = $_REQUEST['owner'];
                        $phone = $_REQUEST['phone'];
                        $count = addCorp($corpName, $incDt, $email, $zip, $owner, $phone);
                        echo "$count rows affected";
                        include_once("corpForm.php");
                        break;
                    default:
                        outCorpList();
                        break;
               }
            } else {
                outCorpList();
            }
        ?>
    </body>
</html>