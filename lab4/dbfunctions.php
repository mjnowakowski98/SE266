<?php
    // Read information on selected corporation
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

    // Update information for existing corporations
    function updateCorp($corpId) {
        try {
            global $db;
            $sql = "UPDATE `corps`
                SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone
                WHERE id = :corpId;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':corpId', $_REQUEST['corpId']);
            $stmt->bindParam(':corp',$_REQUEST['corpName'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_REQUEST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':zipcode', $_REQUEST['zipcode'], PDO::PARAM_STR);
            $stmt->bindParam(':owner', $_REQUEST['owner'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $_REQUEST['phone'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) { die("Failed to update corp with Id: $corpId"); }
    }

    // Delete corporation from database
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

    // Add corporation to database
    function addCorp($corpName, $incDt, $email, $zip, $owner, $phone) {
        try {
            global $db;
            $sql = "INSERT INTO corps (corp, incorp_dt, email, zipcode, owner, phone) VALUES (:corp, now(), :email, :zipcode, :owner, :phone);";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':corp', $corpName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':zipcode', $zip);
            $stmt->bindParam(':owner', $owner);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) { die("Failed to add corp: $corpName"); }
    }

    // Get only id and name - prevents unnecessary calls to database
    function getRows($sortCol = NULL, $sortDir = NULL, $searchCol = NULL, $searchTerm = NULL) {
        try {
            global $db;
            $sql = "SELECT id, corp FROM corps";
            if($searchCol)  { // Check if a column to seach was specified
                // Unless I was doing something wrong this does prevent basic injection
                // Not sure if function of the string being sanitized or PDO though
                // Tested using the query: ?searchCol=id%20=1;%20INSERT%20INTO%20corps%20(corp,%20incorp_dt,%20email,%20zipcode,%20owner,%20phone)%20VALUES%20(injectTest,%20now(),%20qw@er.net,%2078965,%20scriptkiddie,%207897897896);--&searchTerm=auctor
                // Failed to insert row, only returned record with id of 1
                $searchCol = filter_var($searchCol, FILTER_SANITIZE_STRING);
                $sql .= " WHERE $searchCol LIKE CONCAT('%',:searchTerm,'%')"; // Append where clause to query
                // Use concat to prevent bindParam messing up
            }
            if($sortCol) { // Check if sorting column was specified
                $sortCol = filter_var($sortCol, FILTER_SANITIZE_STRING);
                $sql .= " ORDER BY $sortCol ";
                if($sortDir === 'DESC') $sql .= 'DESC'; // Specify descending order if selected, ascending is default
            }
            $sql .= ';';

            // Prepare sql string
            $stmt = $db->prepare($sql);
            if($searchCol) // bind parameters from user input
                $stmt->bindParam(':searchTerm', $searchTerm);
            if($sortCol)
                $stmt->bindParam(':sortDir', $sortDir);

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) { die("Failed to retrieve list of corporations"); }
    }

    // Get information on columns in table
    // Works with MariaDB, may not work with other DBMS
    function getColumnInfo() {
        try {
            global $db;
            $sql = "SHOW COLUMNS FROM corps;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) { die("Cannot figure out table format"); }
    }
?>