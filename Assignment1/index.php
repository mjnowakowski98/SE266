<?php header("Content-type:text/css");
	
?>

<?php
	$doc = new DOMDocument('1.0', 'UTF-8');
	$table = $doc->createElement('table');
	$tableBody = $doc->createElement('tbody');

	for($i = 0; $i < 10; $i++) {
		$newRow = $doc->createElement('tr');
		for($j = 0; $j < 10; $j++) {
			$red = dechex(mt_rand(0,255));
			$green = dechex(mt_rand(0,255));
			$blue = dechex(mt_rand(0,255));
			$color = "$red$green$blue";
			
			$newCol = $doc->createElement('td');
			$newCol->appendChild($doc->createTextNode($color));
			$newRow->appendChild($newCol);
		}
		$tableBody->appendChild($newRow);
	}

	$table->appendChild($tableBody);
	$doc->appendChild($table);
	echo $doc->saveXML();
?>
