<?php
    require_once("db.php");
    require_once("dbfunctions.php");
    $options = getSiteList();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 5 - List</title>
        <meta charset="UTF-8">
        <link href="master.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapper">
            <?php include_once("header.html"); ?>

            <form action="#" method="GET">
                <select name="siteID">
                    <option value>Choose a site</option>
                    <?php
                        $doc = new DOMDocument();
                        foreach($options as $site) {
                            $newOption = $doc->createElement("option");
                            $newOption->setAttribute("value", $site['site_id']);
                            $newOption->appendChild($doc->createTextNode($site['site']));
                            $doc->appendChild($newOption);
                        }
                        echo $doc->saveHTML();
                    ?>
                </select>
                <input type="submit">
            </form>

            <?php
                if(array_key_exists('siteID', $_REQUEST)) {
                    $siteID = $_REQUEST['siteID'];
                    $siteLinks = getSiteLinks($siteID);
                    $siteInfo = getListingInfo($siteID);

                    echo "Displaying " . count($siteLinks) . " links for site: " . $siteInfo['site'] . " created: " . $siteInfo['date'];

                    $doc = new DOMDocument();
                    foreach($siteLinks as $link) {
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