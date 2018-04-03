<?php
    function getCorp($corpId) {
        global $db;
        $sql = "SELECT * FROM corps WHERE id = :corpId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':corpId', $corpId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results[0];
    }

    function addCorp() {
        
    }

    function getRows() {
        global $db;
        $sql = "SELECT * FROM corps";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
?>