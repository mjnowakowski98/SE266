<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Lab 1</title>
	</head>
	<body>
		<?php
			$doc = new DOMDocument(); // Create new DOM Object

			// Create base table elements
			$table = $doc->createElement('table');
			$tableBody = $doc->createElement('tbody');

			// Generate table rows
			for($i = 0; $i < 10; $i++) {
				$newRow = $doc->createElement('tr'); // Create new row
			
				// Generate table columns
				for($j = 0; $j < 10; $j++) {
					// Generate/combine RGB values
					$red = dechex(mt_rand(00,255));
					$green = dechex(mt_rand(0,255));
					$blue = dechex(mt_rand(0,255));
					$color = "#$red$green$blue";

					// Create new column in row
					$newCol = $doc->createElement('td');
					$newCol->setAttribute('style',"background-color:$color;"); // Change css color
					$newCol->appendChild($doc->createTextNode($color)); // Output text in black
					$newCol->appendChild($doc->createElement('br')); // Add line break
				
					$newSpan = $doc->createElement('span'); // Create new span
					$newSpan->setAttribute('style',"color:ffffff;");
					$newSpan->appendChild($doc->createTextNode($color)); // To output text in white
				
					// Append span/col to row
					$newCol->appendChild($newSpan);
					$newRow->appendChild($newCol);
				}
				$tableBody->appendChild($newRow); // append row to tbody
			}
		
			// Append elements to DOM body
			$table->appendChild($tableBody);
			$doc->appendChild($table);
			echo $doc->saveXML();
		?>
	<body>
</html>