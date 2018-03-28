<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>SE266 Nowakowski L1</title>
	</head>
	<body>
		<?php
			echo '<table> <tbody>';
			
			// Generate Rows
			for ($i = 0; $i < 10; $i++) {
				echo '<tr>';
				
				// Generate columns
				for($j = 0; $j < 10; $j++) {
					$colRed = dechex(mt_rand(0,255));
					$colGreen = dechex(mt_rand(0,255));
					$colBlue = dechex(mt_rand(0,255));
					$color = "$colRed$colGreen$colBlue";
					
					echo "<td style=\"background-color:#$color;\">$color";
					echo "<br><span style=\"color:#ffffff;\">$color</span></td>";
				}
				
				echo '</tr>';
			}
			
			echo '</tbody> </table>';
		?>
	</body>
</html>