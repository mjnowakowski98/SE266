<?php
    require_once("db.php");
    require_once("dbfunctions.php");

    $options = getSiteList();
    var_dump($options);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 5 - List</title>
        <meta charset="UTF-8">
    </head>

    <body>
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
                        
                        echo $doc->saveHTML();
                    }   
                ?>
            </select>
        </form>
    </body>
</html>