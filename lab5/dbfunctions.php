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
            var_dump($newID[0]['site_id']);
            
            foreach($siteLinks as $link) {
                if(!preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $link)) continue;

                $sql = "INSERT INTO sitelinks (site_id, link) VALUES (:id, :link)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $newID[0]['site_id'], PDO::PARAM_INT);
                $stmt->bindParam(':link', $link);
                $stmt->execute();
                var_dump($stmt->rowCount());
            }
            
        } catch (PDOException $e)  { die("Failed to add site"); }
    }
?>