<?php
	function getRows() {
		// Select all the rows as an associative array and return
		global $db;
		$stmt = $db->prepare("SELECT * FROM demo");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
?>