<?php
	function getRows() {
		// Select all the rows as an associative array and return
		global $db;
		$stmt = $db->prepare("SELECT * FROM demo");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	function savePerson($db, $fName, $lName, $age) {
		$sql = "INSERT INTO demo (fName, lName, age) VALUES (:fName, :lName, :age)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':fName', $fName);
		$stmt->bindParam(':lName', $lName);
		$stmt->bindParam(':age', $age, PDO::PARAM_INT);
		$stmt->execute();
	}
?>