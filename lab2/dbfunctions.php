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

    function addCorp($corpName, $incDt, $email, $zip, $owner, $phone) {
        global $db;
        $sql = "INSERT INTO corps (corp, incorp_dt, email, zipcode, owner, phone) VALUES (:corp, :incDt, :email, :zipcode, :owner, :phone)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':corp', $corpName);
        $stmt->bindParam(':incDt', $incDt);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':zipcode', $zip);
        $stmt->bindParam(':owner', $owner);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->rowCount();
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