<?php // Define user input string if submitted
    if(array_key_exists('crawlUrl', $_REQUEST)) // Check if exists
        $strInput =  $_REQUEST['crawlUrl']; // Set if true
    else $strInput = NULL; // Define as NULL otherwise
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
            <!-- Include master page header -->
            <?php include_once("header.html"); ?>

            <?php // Include database access functions
                require_once("db.php");
                require_once("dbfunctions.php");

                // Check if string is valid
                if(!preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $strInput))
                    echo 'Please enter a valid URL'; // Display error if not or empty
                else {
                    // Get hypertext of entered url
                    $curlHandle = curl_init($strInput); // Get handle to curl object
                    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE); // Setup return to string instead of direct to stdout
                    $curlData = curl_exec($curlHandle); // Execute curl
                    curl_close($curlHandle); // Close object handle and return memory

                    require_once("scrapper.php"); // Inlude scrapper functions
                    $linkList = findLinks($curlData); // Crawl page for links

                    $newSite = addSite($_REQUEST['crawlUrl'], $linkList); // Add site to db and get operation returns
                    outputNewSite($newSite); // Output operation data
                }
            ?>

            <!-- Form to get url from user -->
            <form action="index.php" method="GET">
                <input class="dbEntry" type="text" name="crawlUrl" value="<?php echo $strInput?>">
                <br>
                <input class="dbEntryBtn" type="submit">
                <input class= "dbEntryBtn" type="reset">
            </form>

            <?php // Output data about db add operation
                function outputNewSite($site) {
                    echo $site['rowCount'] . " rows affected. "; // Display affected rows, should be 1
                    echo "Displaying record for site: " . $site['siteInfo']['site'] . " created: " . $site['siteInfo']['date'];

                    // Output list of links
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

            <!-- Include master page footer -->
            <?php include_once("footer.html"); ?>
        </div>
    </body>
</html>