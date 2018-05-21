<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbcontroller.php");

    function validateUser($email, $guess) {
        global $db;
        try {
            $sql  = "SELECT user_id, password ";
            $sql .= "FROM users ";
            $sql .= "WHERE email = :email;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($results);
            
            if(password_verify($guess, $results['password']))
                $user = $results['user_id'];
            else $user = NULL;

            return $user;

        } catch(PDOException $e) { die("Failed to validate user info"); }
    }

    function getUserInfo($id) {
        global $db;
        try {
            $sql  = "SELECT * ";
            $sql .= "FROM userinfo ";
            $sql .= "WHERE user_id = :uId;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':uId', $id);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;

        } catch(PDOException $e) { die("Failed to retrieve user information"); }
    }

    function addUser($email, $hash, $isAdmin, $fName = NULL, $lName = NULL) {
        global $db;
        try {
            $sql  = "INSERT INTO `users` (email, password, created) ";
            $sql .= "VALUES (:email, :hash, NOW());";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();

            $stmt->debugDumpParams();

            if(!$stmt->rowCount()) die("Cannot add user to db");

            $newId = $db->lastInsertId();
            $sql = '';
            $sql  = "INSERT INTO `userinfo` ";
            $sql .= "VALUES (:id, :firstName, :lastName, :isAdmin);";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $newId);
            $stmt->bindParam(':firstName', $fName);
            $stmt->bindParam(':lastName', $lName);
            $stmt->bindParam(':isAdmin', $isAdmin);
            $stmt->execute();

            if(!$stmt->rowCount()) {
                removeRowById($newId);
                die("Failed to add user information");
            }

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to create user"); }
    }

    function verifyAdmin($adminId) {
		$allow = false;
		
		global $db;
		$sql  = "SELECT admin_id, can_register ";
		$sql .= "FROM `admins` ";
		$sql .= "WHERE admin_id = :adminId;";
		
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':adminId', $adminId);
		$stmt->execute();
		
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		if($results && $results['can_register'])
			$allow = true;
		
		return $allow;
    }

    function removeRowById($id) {
        global $db;
        try {
            $sql  = "DELETE FROM `users` WHERE user_id = :id;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sql = "DELETE FROM `userinfo` WHERE user_id = :id;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e) { die("Failed to remove row"); }
    }

    function getProductList() {
        try {
            global $db;

            $sql  = "SELECT product_id, product, image ";
            $sql .= "FROM `products`;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) { die("Failed to get product listings"); };
    }
?>