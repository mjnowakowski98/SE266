<?php
    if(array_key_exists('crawlUrl', $_REQUEST))
        $strInput =  $_REQUEST['crawlUrl'];
    else $strInput = NULL;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 5 - DB Entry</title>
        <meta charset="UTF-8">
        <link href="master.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
        <?php include_once("header.html"); ?>
            <?php
                require_once("db.php");
                require_once("dbfunctions.php");

                if(array_key_exists('crawlUrl', $_REQUEST))
                    $strInput = $_REQUEST['crawlUrl'];
                else $strInput = NULL;
            ?>

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

                    $newSite = addSite($_REQUEST['crawlUrl'], $linkList);
                    outputNewSite($newSite);
                }
            ?>

            <form action="index.php" method="GET">
                <input type="text" name="crawlUrl" value="<?php echo $strInput?>">
                <input type="submit">
            </form>

            <?php
                function outputNewSite($site) {
                    echo $site['rowCount'] . " rows affected.";
                    echo "Displaying record for site: " . $site['siteInfo']['site'] . " created: " . $site['siteInfo']['date'];

                    $doc = new DOMDocument();
                    foreach($site['siteLinks'] as $link) {
                        $newP = $doc->createElement("p");
                        $newLink = $doc->createElement("a");
                        $newLink->setAttribute("href", $link['link']);
                        $newLink->appendChild($doc->createTextNode($link['link']));
                        $newP->appendChild($newLink);
                        $doc->appendChild($newP);
                    }
                    echo $doc->saveHTML();
                }
            ?>

            <?php include_once("footer.html"); ?>
        </div>
    </body>
</html>