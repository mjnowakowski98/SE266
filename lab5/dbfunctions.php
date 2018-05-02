<?php
    function getSiteList() {

    }

    function addSite($siteName, $siteLinks) {
        global $db;
        try {
            $sql = "INSERT INTO sites (site, date) VALUES (:siteName, NOW());";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':siteName', $siteName);
            $success = $stmt->execute();

            $sql = "SELECT site_id FROM sites ORDER BY site_id DESC LIMIT 1;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $newID = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $e)  { die("Failed to add site"); }
    }
?>