<?php
    function getSiteList() { // Get a list of all known sites (sites)
        global $db;
        try {
            $sql = "SELECT site_id, site FROM sites ORDER BY date;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) { die("Failed to retrieve site list from db"); }
    }

    function getSiteLinks($siteID) { // Get a list of all links with a matching site id (sitelinks)
        global $db;
        try {
            $sql = "SELECT site_id, link FROM sitelinks WHERE site_id = :siteID;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteID', $siteID);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results; // Returns array of links, each link is assoc array -> site_id (parent entity key), link (link address)
        } catch(PDOException $e) { die("Failed to retrieve links for site"); }
    }

    function getListingInfo($siteID) { // Get extended information about an existing site (sites)
        global $db;
        try {
            $sql = "SELECT site, date FROM sites WHERE site_id = :siteID;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteID', $siteID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result; // Returns a single site, assoc array-> site (site name), date (date/time added)
        } catch(PDOException $e) { die("Failed to retrive site name for id: $siteID"); }
    }

    function addSite($siteName, $siteLinks) { // Add a site to the db (sites, sitelinks)
        global $db;
        try {
            $sql = "INSERT INTO sites (site, date) VALUES (:siteName, NOW());";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteName', $siteName);
            $success = $stmt->execute(); // Create a new site listing (sites)

            $newID = $db->lastInsertId(); // Get site_id from new row (AUTO INCREMENT value)
            
            // Add links to table sitelinks
            foreach($siteLinks as $link) {
                // Validate link text (assume some mmbs occurred somewhere else)
                if(!preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $link)) {
                    echo "Failed to insert $link to db: Invalid";
                    continue; // Try next link on page if invalid
                }

                $sql = "INSERT INTO sitelinks VALUES (:id, :link)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $newID, PDO::PARAM_INT);
                $stmt->bindParam(':link', $link);
                $stmt->execute(); // Insert link into table, marked with matching id
            }

            $newSite = [ // Create an array with operation details
                "siteID" => $newID,
                "rowCount" => $stmt->rowCount(),
                "siteInfo" => getListingInfo($newID),
                "siteLinks" => getSiteLinks($newID)
            ];

            return $newSite; // Return details about insert operation
            
        } catch (PDOException $e)  { die("Failed to add site"); }
    }
?>