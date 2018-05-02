<?php
    if(array_key_exists('crawlUrl', $_REQUEST))
        $strInput =  $_REQUEST['crawlUrl'];
    else $strInput = NULL;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 5</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="wrapper">
            <nav>
                <a href="./index.php">Site Entry</a> |
                <a href="./list.php">Site Listing</a>
            </nav>

            <header>
                <h1>Sites Application</h1>
            </header>

            <?php
                require_once("db.php");
                require_once("dbfunctions.php");

                if(array_key_exists('action', $_REQUEST)) {
                    $action = $_REQUEST['action'];
                    switch($action) {
                        case 'Submit':
                            $strInput = $_REQUEST['crawlUrl'];
                            break;
                    }
                }
            ?>

            <form action="index.php" method="GET">
                <input type="text" name="crawlUrl" value="<?php echo $strInput?>">
                <input type="submit" name="action" value="Submit">
            </form>

            <?php
                if(!preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $strInput))
                    echo 'Please enter a valid URL';
                else {
                    $curlHandle = curl_init($strInput);
                    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
                    $curlData = curl_exec($curlHandle);
                    curl_close($curlHandle);

                    require_once("scrapper.php");
                    $linkList = findLinks($curlData);

                    addSite($_REQUEST['crawlUrl'], $linkList);
                }
            ?>
        </div>
    </body>
</html>