<?php
	$doc = new DOMDocument('1.0', 'UTF-8');
	$table = $doc->createElement('table');
	$tableBody = $doc->createElement('tbody');

	// Generate table rows
	for($i = 0; $i < 10; $i++) {
		$newRow = $doc->createElement('tr');

		// Generate table columns
		for($j = 0; $j < 10; $j++) {
			$red = dechex(mt_rand(00,255));
			$green = dechex(mt_rand(0,255));
			$blue = dechex(mt_rand(0,255));
			$color = "#$red$green$blue";
			
			$newCol = $doc->createElement('td');
			$newCol->setAttribute('style',"background-color:$color;");
			$newCol->appendChild($doc->createTextNode($color));
			$newCol->appendChild($doc->createElement('br'));

			$newSpan = $doc->createElement('span');
			$newSpan->setAttribute('style',"color:ffffff;");
			$newSpan->appendChild($doc->createTextNode($color));
			
			$newCol->appendChild($newSpan);
			$newRow->appendChild($newCol);
		}
		$tableBody->appendChild($newRow);
	}

	// Append elements to DOM
	$table->appendChild($tableBody);
	$doc->appendChild($table);
	echo $doc->saveXML();
?>
