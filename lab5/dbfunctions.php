<?php
    function getSiteList() {
        global $db;
        try {
            $sql = "SELECT site_id, site FROM sites ORDER BY date;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) { die("Failed to retrieve site list from db"); }
    }

    function getSiteLinks($siteID) {
        global $db;
        try {
            $sql = "SELECT site_id, link FROM sitelinks WHERE site_id = :siteID;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteID', $siteID);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) { die("Failed to retrieve links for site"); }
    }

    function getListingInfo($siteID) {
        global $db;
        try {
            $sql = "SELECT site, date FROM sites WHERE site_id = :siteID;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteID', $siteID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) { die("Failed to retrive site name for id: $siteID"); }
    }

    function addSite($siteName, $siteLinks) {
        global $db;
        try {
            $sql = "INSERT INTO sites (site, date) VALUES (:siteName, NOW());";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteName', $siteName);
            $success = $stmt->execute();

            $newID = $db->lastInsertId();
            
            foreach($siteLinks as $link) {
                if(!preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $link)) {
                    echo "Failed to insert $link to db: Invalid";
                    continue;
                }

                $sql = "INSERT INTO sitelinks VALUES (:id, :link)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $newID, PDO::PARAM_INT);
                $stmt->bindParam(':link', $link);
                $stmt->execute();
            }

            $newSite = [
                "siteID" => $newID,
                "rowCount" => $stmt->rowCount(),
                "siteInfo" => getListingInfo($newID),
                "siteLinks" => getSiteLinks($newID)
            ];

            return $newSite;
            
        } catch (PDOException $e)  { die("Failed to add site"); }
    }
?>