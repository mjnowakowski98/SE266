<?php
	foreach($people as $person) {
		echo "First name: " . $person['fName'] . "<br>";
		echo "Last name: " . $person['lName'] . "<br>";
		echo "Age: " . $person['age'] . "<br>";
		echo "<br>";
	}
?>

<form action="index.php" method="GET">
	<input type="submit" name="action" value="Add">
</form>