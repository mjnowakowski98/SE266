<?php
	echo "Test1";
	
	include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/dbfunctions.php");
	
	$try = $_POST['try'] ?? false;
	$employeeId = $_POST['employeeId'] ?? NULL;
	
	if($try) {
		if(verifyAdmin($employeeId)) {
			$_SESSION['verifiedAdmin'] = true;
			echo "Verified";
		}
		else {
			$_SESSION['verifiedAdmin'] = false;
			echo "Failed";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Validate</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<form action="#" method="POST">
			<input type="hidden" name="try" value="true">
			
			<label>EID: <input type="text" name="employeeId"></label>
			<input type="submit">
		</form>
	</body>
</html>