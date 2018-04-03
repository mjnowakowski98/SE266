<!--
    SE266.05 Lab 2
    Matthew Nowakowski
-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab 2</title>
        <link href="./master.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Corporations App</h1>
        </header>

        <?php
           require_once("dbcontroller.php");
           require_once("dbfunctions.php");
           if($_REQUEST) {
               $action = $_REQUEST['action'];
               $corpId = $_REQUEST['corpId'];
               switch($action) {
                    case "Read":
                        $corp = showCorp($corpId);
                        include_once("corporateInfo.php");
                        break;
                    case "Update":
                        break;
                    case "Save":
                        break;
                    case "Delete":
                        break;
                    case "Add":
                        break;
               }
            } else {
                $corporations = getRows();
                include_once("corporations.php");
            }

        ?>
    </body>
</html>