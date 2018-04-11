<?php
    function getCorp($corpId) {
        try {
            global $db;
            $sql = "SELECT * FROM corps WHERE id = :corpId;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':corpId', $corpId);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results[0];
        } catch(PDOException $e) { die("Failed to get corp information with Id: $corpId"); }
    }

    function updateCorp($corpId) {
        try {
            global $db;
            $sql = "UPDATE `corps`
                SET corp = :corp, incorp_dt = :incDt, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone
                WHERE id = :corpId;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':corpId', $_REQUEST['corpId']);
            $stmt->bindParam(':corp',$_REQUEST['corpName'], PDO::PARAM_STR);
            $stmt->bindParam(':incDt', $_REQUEST['incDt'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_REQUEST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':zipcode', $_REQUEST['zipcode'], PDO::PARAM_STR);
            $stmt->bindParam(':owner', $_REQUEST['owner'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $_REQUEST['phone'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) { die("Failed to update corp with Id: $corpId"); }
    }

    function deleteCorp($corpId) {
        try {
            global $db;
            $sql = "DELETE FROM corps WHERE id = :corpId;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('corpId', $corpId);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) { die("Failed to delete record wih Id: $corpId"); }
    }

    function addCorp($corpName, $incDt, $email, $zip, $owner, $phone) {
        try {
            global $db;
            $sql = "INSERT INTO corps (corp, incorp_dt, email, zipcode, owner, phone) VALUES (:corp, :incDt, :email, :zipcode, :owner, :phone);";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':corp', $corpName);
            $stmt->bindParam(':incDt', $incDt);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':zipcode', $zip);
            $stmt->bindParam(':owner', $owner);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) { die("Failed to add corp: $corpName"); }
    }

    function getRows() {
        try {
            global $db;
            $sql = "SELECT * FROM corps";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) { die("Failed to retrieve list of corporations"); }
    }
?>