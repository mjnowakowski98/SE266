<?php
	$doc = new DOMDocument('1.0', 'UTF-8');
	$table = $doc->createElement('table');
	$tableBody = $doc->createElement('tbody');

	for($i = 0; $i < 10; $i++) {
		$newRow = $doc->createElement('tr');
		for($j = 0; $j < 10; $j++) {
			}
	}

	$table->appendChild($tableBody);
	$doc->appendChild($table);
?>
